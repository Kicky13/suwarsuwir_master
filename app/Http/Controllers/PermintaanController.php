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
        if (Auth::user()->level_id == 1){
            echo 'None';
        } elseif (Auth::user()->level_id == 4){
            $id = DB::table('reseller')->where('users_id', Auth::id())->first()->id;
            $data = DetailPermintaan::with(['permintaan', 'produk'])->join('validasi', 'validasi.id', '=', 'detailpermintaan.validasi_id')->get();
            return view('permintaan.reseller.index', compact('data'));
        }
    }
    public function createView()
    {
        $reseller = DB::table('reseller')->where('users_id', Auth::id())->first()->id;
        $id = Permintaan::create(['reseller_id' => $reseller]);
        $data = Produk::all();
        return view('permintaan.reseller.create')->with(['data' => $data, 'id' => $id->id]);
    }
    public function create(Request $request)
    {
        DetailPermintaan::create($request->all());
        echo 'Sukses';
    }
}
