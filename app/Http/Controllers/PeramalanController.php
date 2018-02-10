<?php

namespace App\Http\Controllers;

use App\Peramalan;
use App\Permintaan;
use App\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PeramalanController extends Controller
{
    public function index()
    {
        $products = Produk::all();
        return view('peramalan.index', compact('products'));
    }

    public function requestHistory($produk)
    {
        $products = Produk::all();
        $no = 1;
        foreach ($products as $product) {
            echo '<tr>
                    <td>'.$no++.'</td>
                    <td>'.$product->nama_produk.'</td>
                    <td>'.$product->harga.'</td>
                    <td>'.$product->jumlah_produk.'</td>
                </tr>';
        }
    }

    public function ramal(Request $request)
    {
        $date = Carbon::now(+7);
        $produk = $request->produk_id;
        $single = $this->single($produk);
//        $double = $this->double($single, $produk);
//        $triple = $this->triple($double, $produk);
        echo $single;
    }

    public function single($produk)
    {
        $date = Carbon::now(+7);
        $last = $date->subMonth(1);
        $recent = Peramalan::where('produk_id', $produk)->whereBetween('tanggal_peramalan', [$last->startOfMonth(), $last->endOfMonth()]);
        $penjualan = DB::table('permintaan_produk as pp')->join('permintaan as p', 'p.id', '=', 'pp.permintaan_id')->where('validasi_id', '=', 3)->where('produk_id', '=', $produk)->whereYear('tanggal_terjual', '=', $date->year)->whereMonth('tanggal_terjual', '=', $date->month);
        $xt = $penjualan->sum('jumlah_permintaan');
        if ($recent->count() == 0){
            $at1 = $xt;
        } else {
            $at1 = 0;
        }
        if ($xt-$at1 == 0){
            $pe = 0;
        } else {
            $pe = (abs($xt - $at1)/$xt)*100;
        }
        $result = collect(['xt' => $xt, 'at1' => $at1, 'pe1' => $pe]);
        return $result;
    }

    public function double($data, $produk)
    {
        $date = Carbon::now(+7);
        $last = $date->subMonth(1);
        $recent = Peramalan::where('produk_id', $produk)->whereBetween('tanggal_peramalan', [$last->startOfMonth(), $last->endOfMonth()]);
        if ($recent->count() == 0){
            $at2 = $data['xt'];
        } else {
            $at2 = 0;
        }
        $at = (2*$data['at1'])-$at2;
        $bt = (0.4/(1-0.4))*($data['at1']-$at2);
        $ftm1 = $at+$bt;
        if ($data['xt']-$ftm1 == 0){
            $pe = 0;
        } else {
            $pe = (abs($data['xt']-$ftm1)/$data['xt'])*100;
        }
        $result = collect($data, ['at2' => $at2, 'at' => $at, 'bt' => $bt, 'pe2' => $pe]);
        $data->put('at2', $at2);
        $data->put('at', $at);
        $data->put('bt', $bt);
        $data->put('pe2', $pe);
        return $data;
    }

    public function triple()
    {

    }
}
