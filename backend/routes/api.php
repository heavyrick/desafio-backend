<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
*/

// Auth
Route::post('register', 'AuthController@register');
Route::post('login', 'AuthController@login')->name('login');

// Rotas protegidas
Route::middleware('auth:api')->group(function () {

    Route::post('logout', 'AuthController@logout');

    // Users
    Route::resource('users', 'UserController');

    // Operations
    Route::get('operations', 'OperationController@index');

    // Account transactions
    Route::get('account_transactions/user', 'AccountTransactionController@listAccount');
    Route::get('account_transactions/totalizer/{user_id}', 'AccountTransactionController@totalizer');
    Route::get('account_transactions/report', 'AccountTransactionController@report');
    Route::post('account_transactions', 'AccountTransactionController@store');
    Route::delete('account_transactions/{id}/{user_id}', 'AccountTransactionController@destroy');
});

//
//
// Se nenhuma rota for encontrada, executa esta rota fallback
Route::fallback(function () {
    return response()->json([
        'message' => 'Recurso não encontrado. Entre em contato com o suporte através do email: suporte@email.com.br'
    ], 404);
});
