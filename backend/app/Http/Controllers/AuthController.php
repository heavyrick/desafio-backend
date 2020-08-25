<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Constants\AppConstants;
use App\Http\Requests\UserRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    private $User;

    public function __construct(User $User)
    {
        $this->User = $User;
    }

    /**
     * register
     * Registra um novo usuário no sistema
     *
     * @param AuthRequest $request
     * @return void
     */
    public function register(UserRequest $request)
    {
        try {
            if ($request->validator->fails()) {
                return response()->json(['message' => $request->validator->errors()->first()], 400);
            }
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $this->User::create($input);

            return response()->json(['message' => AppConstants::API_REGISTER_SUCCESS], 201);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $TokenObj = Auth::user()->createToken('LaravelApp');
            $token = $TokenObj->accessToken;
            $TokenObj->token->expires_at = Carbon::now()->addHours(8); // validate do token: 8 Horas
            $TokenObj->token->save();

            return response()->json([
                'message'   => AppConstants::API_LOGIN_SUCCESS,
                'name'      => Auth::user()->name,
                'token'     => 'Bearer ' . $token
            ], 201);
        } else {
            return response()->json(['message' => AppConstants::API_LOGIN_ERROR], 400);
        }
    }

    /**
     * Logout
     *
     * @param Request $request
     * @return void
     */
    public function logout(Request $request)
    {
        try {
            $Token = $request->user()->token();
            $Token->revoke();
            return response()->json(['message'   => AppConstants::API_LOGOUT_SUCCESS], 200);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }
}
