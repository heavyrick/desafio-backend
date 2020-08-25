<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Models\AccountTransaction;
use Illuminate\Support\Facades\Cache;

class UserService
{
  /**
   * getAccountBalance
   *
   * Retorna o saldo do usuário
   *
   * @param [type] $id
   * @return void
   */
  public function getAccountBalance($id)
  {
    if (!Cache::has("users.getaccountbalance:{$id}")) {
      Cache::put("users.getaccountbalance:{$id}", DB::table('users')->where('id', '=', $id)->sum('account_balance'), config('app.cache_time'));
    }
    return Cache::get("users.getaccountbalance:{$id}");
  }

  /**
   * checkUserAccount
   *
   * Retorna falso se o saldo inicial for diferente de zero, e se o usuário possui alguma movimentação
   *
   * @param [type] $id
   * @return void
   */
  public function checkUserAccount($id)
  {
    if ($this->getAccountBalance($id) != 0) {
      return false;
    }

    if (AccountTransaction::where('user_id', '=', $id)->count() > 0) {
      return false;
    }

    return true;
  }
}
