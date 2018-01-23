<?php

namespace App\Http\Controllers;

use App\Permintaan;
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
            $data = Permintaan::where('reseller_id', $id)->get();
            return view('permintaan.reseller.index', compact('data'));
        }
    }
}
