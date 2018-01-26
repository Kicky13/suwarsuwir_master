<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    public $timestamps = false;
    protected $fillable = ['jumlah_permintaan', 'reseller_id'];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'detailpermintaan', 'permintaan_id', 'produk_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'reseller_id');
    }
    public function validasi()
    {
        return $this->belongsTo(Validasi::class);
    }
}
