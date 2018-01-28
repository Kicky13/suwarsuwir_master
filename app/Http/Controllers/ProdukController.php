<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        if (Auth::user()->role_id == 1){
            $products = Produk::all();
            return view('produk.pimpinan.index', compact('products'));
        } elseif (Auth::user()->role_id == 2){
            $products = Produk::all();
            return view('produk.kasir.index', compact('products'));
        } elseif (Auth::user()->role_id == 3){
            $products = Produk::all();
            return view('produk.produksi.index', compact('products'));
        } elseif (Auth::user()->role_id == 4){
            $products = Produk::all();
            return view('produk.reseller.index', compact('products'));
        } else {
            return redirect('/login');
        }
    }
    public function createView()
    {
        return view('produk.pimpinan.create');
    }
    public function create(Request $request)
    {
        Produk::create($request->all());
        return redirect('/produk');
    }
    public function updateView($id)
    {
        $product = Produk::find($id);
        return view('produk.pimpinan.update', compact('product'));
    }
    public function update(Request $request, $id)
    {
        Produk::find($id)->update($request->all());
        return redirect('/produk');
    }
}
