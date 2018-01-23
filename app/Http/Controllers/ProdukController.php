<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProdukController extends Controller
{
    public function index()
    {
        if (Auth::user()->level_id == 1){
            $data = Produk::all();
            return view('produk.pimpinan.index', compact('data'));
        } elseif (Auth::user()->level_id == 4){
            $data = Produk::all();
            return view('produk.reseller.index', compact('data'));
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
        $data = Produk::find($id);
        return view('produk.pimpinan.update', compact('data'));
    }
    public function update(Request $request, $id)
    {
        Produk::find($id)->update($request->all());
        return redirect('/produk');
    }
}
