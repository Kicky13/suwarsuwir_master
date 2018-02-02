<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Peramalan extends Model
{
    protected $table = 'peramalan';
    public $timestamps = 'tanggal_peramalan';
}
