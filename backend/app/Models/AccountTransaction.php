<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class AccountTransaction extends Model
{
    protected $table = 'account_transactions';

    protected $fillable = ['user_id', 'operation_id', 'value'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
