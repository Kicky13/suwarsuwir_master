<?php

namespace App\Http\Controllers;

use App\Kasir;
use App\Pimpinan;
use App\Reseller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 1){
            return view('home.pimpinan');
        } elseif (Auth::user()->role_id == 2){
            return view('home.kasir');
        } elseif (Auth::user()->role_id == 3){
            return view('home.produksi');
        } else {
            return view('home.reseller');
        }
    }
}
