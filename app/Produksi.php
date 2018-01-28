<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'produksi';
    public $timestamps = false;

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'produksi_produk')->withPivot('jumlah_produksi', 'tanggal_kedaluwarsa');
    }
}
