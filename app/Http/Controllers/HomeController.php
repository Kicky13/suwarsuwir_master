<?php

namespace App\Http\Controllers;

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
        if (Auth::user()->level_id == 1){
            return view('home.pimpinan');
        } elseif (Auth::user()->level_id == 2){
            return view('home.kasir');
        } elseif (Auth::user()->level_id == 4){
            return view('home.reseller');
        }
    }
}
