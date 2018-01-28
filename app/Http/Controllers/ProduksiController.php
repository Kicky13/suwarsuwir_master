<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Produksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProduksiController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1){
            $productions = Produksi::all();
            return view('produksi.pimpinan.index', compact('productions'));
        } elseif (Auth::user()->role_id == 3){
            $productions = Produksi::all();
            return view('produksi.produksi.index', compact('productions'));
        } else {
            return redirect('/logut');
        }
    }
    public function createView()
    {
        $id = Produksi::create();
        $products = Produk::all();
        return view('produksi.produksi.create')->with(['products' => $products, 'id' => $id->id]);
    }
}
