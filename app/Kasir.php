<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    protected $table = 'kasir';
    public $timestamps = false;
    protected $fillable = ['nama', 'alamat', 'email', 'users_id'];

    public function user()
    {
        return $this->hasOne(User::class, 'users_id');
    }
}
