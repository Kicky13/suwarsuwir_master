<?php

namespace App\Http\Controllers;

use App\Peramalan;
use App\Permintaan;
use App\Produk;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
    }

    public function single($produk)
    {
        $date = Carbon::now(+7);
        $cek = Peramalan::where('produk_id', $produk)->whereBetween('tanggal_peramalan', [$date->startOfMonth(), $date->endOfMonth()]);
        $tmp = $cek->toSql();
        if ($cek->count() == 0){
            $permintaan = Permintaan::all()->where('tanggal_terjual', '>=', $date->startOfMonth()->toDateString())->where('tanggal_terjual', '<=', $date->endOfMonth()->toDateString());
        } else {
            $permintaan = 0;
        }
        return $permintaan;
    }

    public function double()
    {

    }

    public function triple()
    {

    }
}
