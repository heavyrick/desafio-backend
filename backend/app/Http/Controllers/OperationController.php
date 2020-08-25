<?php

namespace App\Http\Controllers;

use App\Http\Resources\OperationCollection;
use App\Models\Operation;
use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class OperationController extends Controller
{
    public function index()
    {
        try {
            $data =  Cache::remember('operations.all', config('app.cache_time'), function () {
                return Operation::all()->sortBy('name');
            });
            return new OperationCollection($data);
        } catch (ModelNotFoundException $e) {
            return $e->getMessage();
        }
    }
}
