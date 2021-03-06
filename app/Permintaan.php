<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Permintaan extends Model
{
    protected $table = 'permintaan';
    public $timestamps = false;
    protected $fillable = ['reseller_id'];

    public function produk()
    {
        return $this->belongsToMany(Produk::class, 'permintaan_produk')->withPivot('id', 'jumlah_permintaan');
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
