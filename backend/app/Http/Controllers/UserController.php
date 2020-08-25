<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use App\Services\UserService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\RegisterNotFoundException;
use App\Http\Requests\UserRequest;
use App\Constants\AppConstants;
use Exception;

class UserController extends Controller
{

	private $userService;
	private $User;

	public function __construct(UserService $userService, User $User)
	{
		$this->userService = $userService;
		$this->User = $User;
	}

	/**
	 * index
	 * Listar todos os dados de usuário / ordenado por data de cadastro (ordem: desc)
	 *
	 * @return void
	 */
	public function index()
	{
		try {
			return new UserCollection(User::all()->sortBy('created_at')->sortDesc());
		} catch (ModelNotFoundException $e) {
			return $e->getMessage();
		}
	}

	/**
	 * show
	 * Retornar um único registro por id
	 *
	 * @param [type] $id
	 * @return void
	 */
	public function show($id)
	{
		try {
			return new UserResource(User::findOrFail($id));
		} catch (Exception $e) {
			throw new RegisterNotFoundException($e);
		}
	}

	/**
	 * store
	 * Criar um novo registro
	 *
	 * @param UserRequest $request
	 * @return void
	 */
	public function store(UserRequest $request)
	{
		return response()->json(['message' => 'Para criar um usuário utilize o método - /register'], 400);
		/*
		try {
			if ($request->validator->fails()) {
				return response()->json(['message' => $request->validator->errors()->first()], 400);
			}

			$this->User::create($request->all());
			return response()->json(['message' => AppConstants::API_POST_SUCCESS], 201);
		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
		*/
	}

	/**
	 * update
	 * Atualizar registros
	 *
	 * @param UserRequest $request
	 * @param [type] $id
	 * @return void
	 */
	public function update(UserRequest $request, $id)
	{
		try {
			if ($request->validator->fails()) {
				return response()->json(['message' => $request->validator->errors()->first()], 400);
			}
			if (!$this->User::find($id)) {
				return response()->json(['message' => AppConstants::API_GET_ERROR_NOTFOUND], 400);
			}

			$this->User->where('id', $id)->update($request->all());
			return response()->json(['message' => AppConstants::API_PUT_SUCCESS], 201);
		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}

	/**
	 * destroy
	 * Excluir um registro
	 *
	 * @param [type] $id
	 * @return void
	 */
	public function destroy($id)
	{
		try {

			$user = $this->User::findOrfail($id);

			if ($this->userService->checkUserAccount($id)) {
				$user->delete();
				return response()->json(['message' => AppConstants::API_DELETE_SUCCESS], 201);
			} else {
				return response()->json(['message' => AppConstants::API_DELETE_ERROR_CHECK_ACCOUNT], 400);
			}
		} catch (Exception $e) {
			return response()->json(['message' => $e->getMessage()], 400);
		}
	}
}
