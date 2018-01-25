<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pimpinan extends Model
{
    protected $table = 'pimpinan';
    public $timestamps = false;
    protected $fillable = ['nama', 'alamat', 'email', 'users_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'users_id');
    }
}
