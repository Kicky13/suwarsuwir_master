<?php

namespace App\Http\Controllers;

use App\Peramalan;
use App\Produk;
use Illuminate\Http\Request;

class PeramalanController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('peramalan.index', compact('products'));
    }
    public function requestHistory()
    {
        $forecasts = Peramalan::all();

    }
}
