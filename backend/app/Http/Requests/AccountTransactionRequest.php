<?php

namespace App\Http\Requests;

use App\Constants\AppConstants;
use App\Http\Requests\CustomRequest;

class AccountTransactionRequest extends CustomRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        switch ($this->getMethod()) {
            case 'POST':
            case 'PUT':
                return [
                    'user_id'       =>  ['required'],
                    'operation_id'  =>  ['required'],
                    'value'         =>  ['numeric'],
                ];
            default:
                break;
        }
    }

    public function messages()
    {
        return [
            'required'  => AppConstants::FORMV_MESSAGE_REQUIRED,
            'numeric'   => AppConstants::FORMV_MESSAGE_NUMERIC
        ];
    }
}
