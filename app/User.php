<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $primaryKey = 'id';
    use Notifiable;

    protected $fillable = [
        'nama', 'alamat', 'email', 'username', 'password', 'idLevel'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];
}
