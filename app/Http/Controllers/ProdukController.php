<?php

namespace App\Http\Controllers;

use App\Produk;
use Illuminate\Http\Request;

class ProdukController extends Controller
{
    public function index()
    {
        $data = Produk::all();
        return view('produk.index', compact('data'));
    }
    public function createView()
    {
        return view('produk.create');
    }
    public function create(Request $request)
    {
        Produk::create($request->all());
        return redirect('/produk');
    }
    public function updateView($id)
    {
        $data = Produk::find($id)->first();
        return view('produk.update', compact('data'));
    }
    public function update(Request $request, $id)
    {
        Produk::find($id)->update($request->all());
        return redirect('/produk');
    }
}
