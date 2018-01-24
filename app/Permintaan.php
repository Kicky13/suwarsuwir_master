<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    public $timestamps = false;
    protected $fillable = ['reseller_id'];

    public function detailPermintaan()
    {
        return $this->hasMany(DetailPermintaan::class);
    }
}
