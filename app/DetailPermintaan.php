<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DetailPermintaan extends Model
{
    protected $table = 'detailpermintaan';
    public $timestamps = false;
    protected $fillable = ['permintaan_id', 'produk_id', 'jumlah_permintaan'];

}
