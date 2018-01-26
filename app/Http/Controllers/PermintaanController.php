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
        $reseller = Auth::id();
        $id = Permintaan::create(['reseller_id' => $reseller]);
        $products = Produk::all();
        return view('permintaan.reseller.create')->with(['products' => $products, 'id' => $id->id]);
    }
    public function create(Request $request)
    {
        $permintaan = Permintaan::find($request->permintaan_id);
        $produk = $request->produk_id;
        $permintaan->produk()->attach($produk, ['jumlah_permintaan' => $request->jumlah_permintaan]);
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
