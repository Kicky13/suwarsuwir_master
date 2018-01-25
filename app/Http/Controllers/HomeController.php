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
        if (Pimpinan::where('users_id', '=', Auth::user()->id)->count() > 0){
            return view('home.pimpinan');
        } elseif (Reseller::where('users_id', '=', Auth::user()->id)->count() > 0){
            return view('home.reseller');
        } elseif (Kasir::where('users_id', '=', Auth::user()->id)->count() > 0){
            return view('home.kasir');
        }
    }
}
