<?php

namespace App\Exceptions;

use Exception;

class InputErrorException extends Exception
{
  /*
    public function render($request, $exception)
    {
        return response()->json([
            'error' => 'Model ' . str_replace('App\\Model\\', '', $exception->getModel()) . ' não encontrado',
            'message' => $exception->getMessage()
        ], 404);
    }
    */

  public function render($request)
  {
    dd($request);
    return ['message' => 'Registro não encontrado'];
  }
}
