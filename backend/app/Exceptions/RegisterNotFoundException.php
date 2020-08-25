<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegisterNotFoundException extends Exception
{
  public function report()
  {
    \Log::debug('Register not found');
  }

  /*
    public function render($request, $exception)
    {
        return response()->json([
            'error' => 'Model ' . str_replace('App\\Model\\', '', $exception->getModel()) . ' não encontrado',
            'message' => $exception->getMessage()
        ], 404);
    }
    */

  public function render()
  {
    return ['message' => 'Registro não encontrado'];
  }
}
