<?php

namespace App\Http\Requests;

use App\Constants\AppConstants;
use App\Http\Requests\CustomRequest;

class AuthRequest extends CustomRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name'      =>  ['required'],
            'email'     =>  ['required', 'email'],
            'password'  =>  ['required']
        ];
    }

    public function messages()
    {
        return [
            'required'          => AppConstants::FORMV_MESSAGE_REQUIRED,
            'email.email'       => AppConstants::FORMV_MESSAGE_EMAIL_INVALID
        ];
    }
}
