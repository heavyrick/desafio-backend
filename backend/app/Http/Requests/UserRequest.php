<?php

namespace App\Http\Requests;

use App\Constants\AppConstants;
use App\Http\Requests\CustomRequest;
use Carbon\Carbon;

class UserRequest extends CustomRequest
{
    /**
     * Autorizar a requisição
     *
     * @return void
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Regras de validação
     *
     * @return void
     */
    public function rules()
    {
        switch ($this->getMethod()) {
            case 'POST':
                return [
                    'name'      =>  ['required'],
                    'email'     =>  ['required', 'email'],
                    'birthday'  =>  ['date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
                    'status'    =>  ['boolean'],
                    'account_balance' => ['numeric'],
                    'password'  =>  ['required']
                ];
            case 'PUT':
                return [
                    'email'     =>  ['email'],
                    'birthday'  =>  ['date', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
                    'status'    =>  ['boolean'],
                    'account_balance' => ['numeric']
                ];
            default:
                break;
        }
    }

    /**
     * Mensagens a serem retornadas para cada regra
     *
     * @return void
     */
    public function messages()
    {
        return [
            'required'          => AppConstants::FORMV_MESSAGE_REQUIRED,
            'email.email'       => AppConstants::FORMV_MESSAGE_EMAIL_INVALID,
            'birthday.date'     => AppConstants::FORMV_MESSAGE_DATE_FORMAT,
            'birthday.before'   => AppConstants::FORMV_MESSAGE_AGE_INVALID,
            'status.boolean'    => AppConstants::FORMV_MESSAGE_BOOLEAN,
            'numeric'           => AppConstants::FORMV_MESSAGE_NUMERIC,
        ];
    }
}
