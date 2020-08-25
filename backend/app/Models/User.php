<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'birthday',
        'account_balance',
        'status',
        'password'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function account_transactions()
    {
        return $this->hasMany('App\Models\AccountTransaction');
    }
}
