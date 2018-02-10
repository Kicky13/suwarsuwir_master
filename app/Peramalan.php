<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peramalan extends Model
{
    protected $table = 'peramalan';
    public $timestamps = false;
    protected $fillable = ['produk_id', 'nilai_aktual', 'at1', 'at2', 'at3', 'ftm2', 'ftm3', 'pe1', 'pe2', 'pe3', 'nilai_hasil', 'mape_hasil'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
