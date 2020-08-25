<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use App\Helpers\Helper;
use App\Constants\AppConstants;
use Carbon\Carbon;
use App\Services\UserService;
use Illuminate\Support\Facades\Cache;
use App\Models\AccountTransaction;

class AccountTransactionService
{
  private $User;
  private $userService;
  private $AccountTransaction;

  public function __construct(UserService $userService, User $User, AccountTransaction $AccountTransaction)
  {
    $this->userService = $userService;
    $this->User = $User;
    $this->AccountTransaction = $AccountTransaction;
  }

  /**
   * listAccountsByUser
   * Retorna os usuários e suas movimentações, quando houver
   *
   * @param [type] $user_id
   * @return void
   */
  public function listAccountsByUser()
  {
    $rememberKey = Helper::urlRememberKey();
    return Cache::remember($rememberKey, config('app.cache_time'), function () {
      return $this->User::with('account_transactions')->paginate(5);
    });
  }

  /**
   * getReport
   *
   * Formatos (json / csv):
   *
   * Para retornar um formato csv é necessário a query string ?format=csv
   * Por padrão o formato retornado será json (ainda que haja erros ou nada seja especificado num primeiro momento)
   *
   * @param array $filters
   * @return void
   */
  public function getReport(array $filters = array())
  {
    $report_data = $this->getReportData($filters);

    if (isset($filters['format']) && $filters['format'] == 'csv') {
      $columns  = ['data', 'operacao', 'valor', 'usuario'];
      $csv_data = Helper::mountCsv($report_data, $columns);
      $headers  = Helper::headerCsv('movimentacoes');
      return response()->stream($csv_data, 200, $headers);
    } else {
      return response()->json(['data' => $report_data], 200);
    }
  }

  /**
   * getReportData
   *
   * Recebe os filtros de data e retorna os dados das movimentações
   *
   * Aqui foi pensado numa estrutura de tela com dois campos possíveis:
   * Um campo com o tipo de período a ser selecionado, se o valor selecionado for 'specific',
   * um segundo campo seria aberto com um datepicker, que tratado pelo front, enviaria apenas o mês e o ano no formato 'MM/YYYY'
   *
   * Se nenhum filtro for aplicado, ou um valor incorreto for colocado, todos os dados serão retornados
   *
   * @param array $filters
   * @return void
   */
  public function getReportData(array $filters = array())
  {
    $rememberKey = Helper::urlRememberKey();

    return Cache::remember($rememberKey, config('app.cache_time'), function () use ($filters) {
      $db_operation = DB::table('account_transactions AS a')
        ->select(
          DB::raw('DATE_FORMAT(a.created_at, "' . AppConstants::FORMAT_DATETIME_PTBR . '" ) AS "data"'),
          'o.name AS operacao',
          'a.value AS valor',
          DB::raw('CONCAT(u.name, " ", COALESCE(u.last_name, "")) AS "usuario"')
        )
        ->leftJoin('users AS u', 'u.id', '=', 'a.user_id')
        ->leftJoin('operations AS o', 'o.id', '=', 'a.operation_id');

      // Validar os filtros - se nenhum for passado retorna todos os dados de movimentação
      if (!is_null($filters) && isset($filters['filter'])) {
        if ($filters['filter'] == 'specific') { // Filtro de datas específico
          $this->_specificFilterReport($filters, $db_operation);
        } else { // Filtro de datas gerais
          $this->_generalFilterReport($filters, $db_operation);
        }
      }

      return $db_operation->orderBy('a.created_at', 'desc')->get();
    });
  }

  /**
   * userAccountTotalizer
   * Retorna a soma do saldo inicial do usuário com os valores das movimentações
   * = Saldo Inicial + Credito + Estorno - Debito
   *
   * @param [type] $user_id
   * @return void
   */
  public function userAccountTotalizer($user_id)
  {
    $this->User::findOrFail($user_id);

    $total =
      $this->userService->getAccountBalance($user_id) +
      $this->getTotalByUserOperation($user_id, 1) +
      $this->getTotalByUserOperation($user_id, 3) -
      $this->getTotalByUserOperation($user_id, 2);

    return [
      'total' => round($total, 2)
    ];
  }

  /**
   * getTotalByUserOperation
   * Retorna o total das movimentações de um usuário por operação
   *
   * @param [type] $user_id
   * @param [type] $operation_id
   * @return void
   */
  public function getTotalByUserOperation($user_id, $operation_id)
  {
    if (!Cache::has("account_transactions.account_total:{$user_id}-{$operation_id}")) {
      Cache::put(
        "account_transactions.account_total:{$user_id}-{$operation_id}",
        $this->AccountTransaction->where('user_id', $user_id)->where('operation_id', $operation_id)->sum('value'),
        config('app.cache_time')
      );
    }
    return (float) Cache::get("account_transactions.account_total:{$user_id}-{$operation_id}");
  }

  // ###############################################################################
  // Support functions
  // ###############################################################################

  /**
   * _filterReport
   * Recebe um valor especial do filtro para aplicar no query builder
   *
   * Valores do filtro:
   * - last_30_days
   * - last_7_days
   * - yesterday
   * - today
   *
   * @param [type] $filters
   * @param [type] $db_operation (Query Builder)
   * @return void
   */
  private function _generalFilterReport($filters, $db_operation)
  {
    switch ($filters['filter']) {
      case 'last_30_days': // últimos 30 dias
        $date_filter = Carbon::now()->subDays(30);
        break;
      case 'last_7_days': // últimos 7 dias
        $date_filter = Carbon::now()->subDays(7);
        break;
      case 'yesterday': // desde o dia de ontem
        $date_filter = Carbon::now()->yesterday();
        break;
      case 'today': // apenas do dia de hoje
        $date_filter = Carbon::now()->subDays(0);
        break;
      default: // qualquer data
        $date_filter = 0;
        break;
    }
    $db_operation->whereDate('a.created_at', '>=', $date_filter);
  }

  /**
   * _specificFilterReport
   * Recebe mês e ano como string, trata e seta o filtro no query builder
   *
   * @param [type] $filters
   * @param [type] $db_operation (Query Builder)
   * @return void
   */
  private function _specificFilterReport($filters, $db_operation)
  {
    if (!is_null($filters['date']) && isset($filters['date'])) {
      $date = explode('/', $filters['date']);
      $db_operation->whereMonth('a.created_at', $date[0]);
      $db_operation->whereYear('a.created_at', $date[1]);
    } else {
      return false;
    }
  }
}
