<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps = false;

    protected $fillable = ['username', 'password'];

    protected $hidden = ['password', 'remember_token'];

    public function reseller()
    {
        return $this->hasOne(Reseller::class);
    }
    public function pimpinan()
    {
        return $this->hasOne(Pimpinan::class);
    }
    public function kasir()
    {
        return $this->hasOne(Kasir::class);
    }
}
