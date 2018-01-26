<?php

namespace App\Http\Controllers;

use App\DetailPermintaan;
use App\Permintaan;
use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PermintaanController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1){
            echo 'None';
        } elseif (Auth::user()->role_id == 2){
            return view('permintaan.kasir.index');
        } elseif (Auth::user()->role_id == 4){
            $permintaan = Permintaan::all();
            return view('permintaan.reseller.index', compact('permintaan'));
        }
    }
    public function createView()
    {
        $products = Produk::all();
        return view('permintaan.reseller.create', compact('products'));
    }
    public function create(Request $request)
    {
        $id = Auth::id();
        $produk = Produk::find($request->produk_id);
        $produk->permintaan()->create([
            'jumlah_permintaan' => $request->jumlah_permintaan,
            'reseller_id' => $id
        ]);
        echo 'Sukses';
    }
    public function updateView($id)
    {
        $produk = Produk::all();
        $data = DetailPermintaan::find($id);
        return view('permintaan.reseller.update')->with(['produk' => $produk, 'data' => $data]);
    }
    public function update(Request $request, $id)
    {
        DetailPermintaan::find($id)->update(['produk_id' => $request->produk_id, 'jumlah_permintaan' => $request->jumlah_permintaan]);
        return view('/permintaan');
    }
}
