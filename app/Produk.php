<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    protected $table = 'produk';
    public $timestamps = false;
    protected $fillable = ['nama_produk', 'harga', 'jumlah_produk'];

    public function detailPermintaan()
    {
        return $this->hasMany(DetailPermintaan::class);
    }
}
