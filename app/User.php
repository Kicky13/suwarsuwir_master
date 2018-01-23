<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = [
        'nama', 'alamat', 'email', 'username', 'password', 'idLevel'
    ];

    protected $hidden = [
        'password', 'remember_token'
    ];

    public function level()
    {
        return $this->belongsTo(Level::class);
    }
}
