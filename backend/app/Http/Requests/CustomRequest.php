<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomRequest extends FormRequest
{
  public $validator = null;

  /**
   * failedValidation
   *
   * Sobrescrevendo o método, pois o efeito anterior, quando havia um erro enviava a request para a página inicial
   * Agora ela pode ser interceptada
   *
   * @param \Illuminate\Contracts\Validation\Validator $validator
   * @return void
   */
  protected function failedValidation(\Illuminate\Contracts\Validation\Validator $validator)
  {
    $this->validator = $validator;
  }
}
