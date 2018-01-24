<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    protected $table = 'detailpermintaan';
    public $timestamps = false;
    protected $fillable = ['permintaan_id', 'produk_id', 'jumlah_permintaan'];

    public function permintaan()
    {
        return $this->belongsTo(Permintaan::class);
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class);
    }
}
