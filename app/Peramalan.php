<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peramalan extends Model
{
    protected $table = 'peramalan';
    public $timestamps = false;
    protected $fillable = ['produk_id', 'nilai_aktual', 'nilai_single', 'nilai_double', 'nilai_triple', 'mape_single', 'mape_double', 'mape_triple', 'nilai_hasil', 'mape_hasil'];

    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
