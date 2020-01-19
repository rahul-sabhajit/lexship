<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class LocalUser extends Authenticatable
{
    protected $fillable = [
        'email', 'password', 'token',
    ];

    protected $hidden = [
        'password',
    ];
}
