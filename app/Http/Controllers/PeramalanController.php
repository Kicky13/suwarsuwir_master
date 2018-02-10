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
        $forecasts = Peramalan::all()->where('produk_id', '=', $produk);
        $no = 1;
        foreach ($forecasts as $forecast) {
            echo '<tr>
                    <td>'.$no++.'</td>
                    <td>'.$forecast->produk['nama_produk'].'</td>
                    <td>'.$forecast->tanggal_peramalan.'</td>
                    <td>'.$forecast->nilai_aktual.'</td>
                    <td>'.$forecast->nilai_hasil.'</td>
                    <td>'.$forecast->mape_hasil.'</td>
                </tr>';
        }
    }

    public function ramal(Request $request)
    {
        $produk = $request->produk_id;
        $date = Carbon::now(+7);
        $recent = Peramalan::where('produk_id', $produk)->whereYear('tanggal_peramalan', $date->year)->whereMonth('tanggal_peramalan', $date->month);
        if ($recent->count() == 0){
            $single = $this->single($produk);
            $double = $this->double($single, $produk);
            $triple = $this->triple($double, $produk);
            $total = collect([['hasil' => $triple['at1'], 'pe' => $triple['pe1']], ['hasil' => $triple['ftm2'], 'pe' => $triple['pe2']], ['hasil' => $triple['ftm3'], 'pe' => $triple['pe3']]]);
            $at = $total->max('hasil');
            $pe = $total->min('pe');
            Peramalan::create([
                'produk_id' => $produk,
                'nilai_aktual' => $triple['xt'],
                'at1' => $triple['at1'],
                'at2' => $triple['at2'],
                'at3' => $triple['at3'],
                'ftm2' => $triple['ftm2'],
                'ftm3' => $triple['ftm3'],
                'pe1' => $triple['pe1'],
                'pe2' => $triple['pe2'],
                'pe3' => $triple['pe3'],
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
        $recent = Peramalan::where('produk_id', $produk)->whereYear('tanggal_peramalan', $last->year)->whereMonth('tanggal_peramalan', $last->month);
        $penjualan = DB::table('permintaan_produk as pp')->join('permintaan as p', 'p.id', '=', 'pp.permintaan_id')->where('validasi_id', '=', 3)->where('produk_id', '=', $produk)->whereYear('tanggal_terjual', '=', $date->year)->whereMonth('tanggal_terjual', '=', $date->month);
        $xt = $penjualan->sum('jumlah_permintaan');
        if ($recent->count() == 0){
            $at1 = $xt;
        } else {
            $before = $recent->get();
            $at1 = (0.4*$before[0]['nilai_aktual'])+((1-0.4)*$before[0]['at1']);
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
        $recent = Peramalan::where('produk_id', $produk)->whereYear('tanggal_peramalan', $last->year)->whereMonth('tanggal_peramalan', $last->month);
        if ($recent->count() == 0){
            $at2 = $data['xt'];
        } else {
            $before = $recent->get();
            $at2 = (0.4*$data['at1'])+((1-0.4)*$before[0]['at2']);
        }
        $at = (2*$data['at1'])-$at2;
        $bt = (0.4/(1-0.4))*($data['at1']-$at2);
        $ftm = $at+$bt;
        if ($data['xt']-$ftm == 0){
            $pe = 0;
        } else {
            $pe = (abs($data['xt']-$ftm)/$data['xt'])*100;
        }
        $data->put('at2', $at2);
        $data->put('pe2', $pe);
        $data->put('ftm2', $ftm);
        return $data;
    }

    public function triple($data, $produk)
    {
        $last = Carbon::now(+7)->subMonth(1);
        $recent = Peramalan::where('produk_id', $produk)->whereYear('tanggal_peramalan', $last->year)->whereMonth('tanggal_peramalan', $last->month);
        if ($recent->count() == 0){
            $at3 = $data['xt'];
        } else {
            $before = $recent->get();
            $at3 = (0.4*$data['at2'])+((1-0.4)*$before[0]['at3']);
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
        $data->put('at3', $at3);
        $data->put('pe3', $pe);
        $data->put('ftm3', $ftm);
        return $data;
    }
}
