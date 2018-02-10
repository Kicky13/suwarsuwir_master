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
        $produk = $request->produk_id;
        $date = Carbon::now(+7);
        $recent = Peramalan::where('produk_id', $produk)->whereBetween('tanggal_peramalan', [$date->startOfMonth(), $date->endOfMonth()]);
        if ($recent->count() == 0){
            $single = $this->single($produk);
            $double = $this->double($single, $produk);
            $triple = $this->triple($double, $produk);
            $total = collect([['at' => $triple['at1'], 'pe' => $triple['pe1']], ['at' => $triple['at2'], 'pe' => $triple['pe2']], ['at' => $triple['at3'], 'pe' => $triple['pe3']]]);
            $at = $total->max('at');
            $pe = $total->min('pe');
            Peramalan::create([
                'produk_id' => $produk,
                'nilai_aktual' => $triple['xt'],
                'nilai_single' => $triple['at1'],
                'nilai_double' => $triple['at2'],
                'nilai_triple' => $triple['at3'],
                'mape_single' => $triple['pe1'],
                'mape_double' => $triple['pe2'],
                'mape_triple' => $triple['pe3'],
                'nilai_hasil' => $at,
                'mape_hasil' => $pe
            ]);
            echo 'sukses';
        } else {
            echo 'exist';
        }
    }

    public function single($produk)
    {
        $date = Carbon::now(+7);
        $last = Carbon::now(+7)->subMonth(1);
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
        $last = Carbon::now(+7)->subMonth(1);
        $recent = Peramalan::where('produk_id', $produk)->whereBetween('tanggal_peramalan', [$last->startOfMonth(), $last->endOfMonth()]);
        if ($recent->count() == 0){
            $at2 = $data['xt'];
        } else {
            $at2 = 0;
        }
        $at = (2*$data['at1'])-$at2;
        $bt = (0.4/(1-0.4))*($data['at1']-$at2);
        $ftm = $at+$bt;
        if ($data['xt']-$ftm == 0){
            $pe = 0;
        } else {
            $pe = (abs($data['xt']-$ftm)/$data['xt'])*100;
        }
        $data->put('at2', $ftm);
        $data->put('pe2', $pe);
        return $data;
    }

    public function triple($data, $produk)
    {
        $last = Carbon::now(+7)->subMonth(1);
        $recent = Peramalan::where('produk_id', $produk)->whereBetween('tanggal_peramalan', [$last->startOfMonth(), $last->endOfMonth()]);
        if ($recent->count() == 0){
            $at3 = $data['xt'];
        } else {
            $at3 = 0;
        }
        $at = (3*$data['at1'])-(3*$data['at2'])+$at3;
        $bt = 0.4/(2*(1-0.4))*((6-(5*0.4)*$data['at1'])-(10-(8*0.4)*$data['at2'])+(4-(3*0.4)*$at3));
        $ct = pow(0.4, 2)/pow(1-0.4, 2)*($data['at1']-(2*$data['at2'])+$at3);
        $ftm = $at+$bt+(0.5*$ct);
        if ($data['xt']-$ftm == 0){
            $pe = 0;
        } else {
            $pe = (abs($data['xt']-$ftm)/$data['xt'])*100;
        }
        $data->put('at3', $ftm);
        $data->put('pe3', $pe);
        return $data;
    }
}
