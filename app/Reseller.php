<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $table = 'reseller';
    public $timestamps = false;
    protected $fillable = ['nama', 'alamat', 'email', 'users_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'users_id');
    }
}
