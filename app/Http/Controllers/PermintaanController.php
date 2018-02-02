<?php

namespace App\Http\Controllers;

use App\DetailPermintaan;
use App\Permintaan;
use App\Produk;
use Carbon\Carbon;
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
            $orders = Permintaan::all();
            return view('permintaan.kasir.index', compact('orders'));
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
    public function detail($id)
    {
        if (Auth::user()->role_id == 2){
            $permintaan = Permintaan::find($id);
            return view('permintaan.kasir.item')->with(['items' => $permintaan->produk, 'id' => $id]);
        } elseif (Auth::user()->role_id == 4){
            $permintaan = Permintaan::find($id);
            return view('permintaan.reseller.item.index')->with(['items' => $permintaan->produk, 'id' => $id]);
        }
    }
    public function createItem($id)
    {
        $products = Produk::all();
        return view('permintaan.reseller.item.create')->with(['products' => $products, 'id' => $id]);
    }
    public function deleteItem($permintaan, $produk)
    {
        $id = Permintaan::find($permintaan);
        $id->produk()->detach($produk);
        return redirect('/permintaan/item/'.$permintaan);
    }
    public function validasi($id, $value)
    {
        $date = Carbon::now();
        Permintaan::where('id', $id)->update(['validasi_id' => $value, 'tanggal_terjual' => $date->toDateString()]);
        return redirect('/permintaan');
    }
}
