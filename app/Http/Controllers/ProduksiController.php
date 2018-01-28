<?php

namespace App\Http\Controllers;

use App\Produk;
use App\Produksi;
use Carbon\Carbon;
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
    public function create(Request $request)
    {
        $today = Carbon::now(7);
        $exp = $today->addDay(90)->toDateString();
        $produksi = Produksi::find($request->produksi_id);
        $produksi->produk()->attach($request->produk_id, ['jumlah_produksi' => $request->jumlah_produksi, 'tanggal_kedaluwarsa' => $exp]);
        $produk = Produk::find($request->produk_id);
        $tambah = $produk->jumlah_produk + $request->jumlah_produksi;
        $produk->update(['jumlah_produk' => $tambah]);
        echo 'Sukses';
    }
}
