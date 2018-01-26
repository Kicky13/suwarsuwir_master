<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Validasi extends Model
{
    protected $table = 'validasi';

    public function permintaan()
    {
        return $this->hasMany(Permintaan::class);
    }
}
