<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccountTransactionRequest;
use App\Models\AccountTransaction;
use App\Http\Resources\AccountTransaction as AccountTransactionResource;
use App\Constants\AppConstants;
use App\Models\User;
use App\Services\AccountTransactionService;
use Exception;
use App\Helpers\Helper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AccountTransactionController extends Controller
{
	private $AccountTransaction;
	private $accountTransactionService;

	public function __construct(AccountTransaction $AccountTransaction, AccountTransactionService $accountTransactionService)
	{
		$this->AccountTransaction = $AccountTransaction;
		$this->accountTransactionService = $accountTransactionService;
	}

	/**
	 * store
	 * Adiciona uma movimentação
	 *
	 * @param AccountTransactionRequest $request
	 * @return void
	 */
	public function store(AccountTransactionRequest $request)
	{
		try {
			if ($request->validator->fails()) {
				return response()->json(['message' => $request->validator->errors()->first()], 400);
			}

			$this->AccountTransaction::create($request->all());
			return response()->json(['message' => AppConstants::API_POST_SUCCESS], 201);
		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}

	/**
	 * destroy
	 * Exclui uma movimentação
	 *
	 * @param [type] $id
	 * @param [type] $user_id
	 * @return void
	 */
	public function destroy($id, $user_id)
	{
		try {
			$affected_rows = $this->AccountTransaction->where(['id' => $id, 'user_id' => $user_id])->delete();

			if ($affected_rows) {
				return response()->json(['message' => AppConstants::API_DELETE_SUCCESS], 201);
			} else {
				return response()->json(['message' => AppConstants::API_DELETE_ERROR], 400);
			}
		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}

	/**
	 * listAccount
	 *
	 * Lista o usuário, se este possui movimentações, estas movimentações.
	 *
	 * @param [type] $id
	 * @return void
	 */
	public function listAccount()
	{
		$data = $this->accountTransactionService->listAccountsByUser();

		if (!is_null($data)) {
			return response()->json(['data' => $data], 200);
		} else {
			return response()->json(['message' => AppConstants::API_GET_ERROR_NOTFOUND], 400);
		}
	}

	/**
	 * report
	 *
	 * Relatório de movimentações
	 *
	 * @param Request $request
	 * @return void
	 */
	public function report(Request $request)
	{
		try {
			return $this->accountTransactionService->getReport($request->all());
		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}

	/**
	 * totalizer
	 * Retorna o saldo do usuário
	 *
	 * @param [type] $user_id
	 * @return void
	 */
	public function totalizer($user_id)
	{
		try {
			$data = $this->accountTransactionService->userAccountTotalizer($user_id);
			return response()->json(['data' => $data], 200);
		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}
}
