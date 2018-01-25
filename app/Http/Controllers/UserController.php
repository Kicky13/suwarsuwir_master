<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $data = User::all();
//        dd($data);
        return view('user.index', compact('data'));
    }
    public function createView()
    {
        $level = DB::table('level')->get();
        return view('user.create', compact('level'));
    }
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'E-Mail',
            'username' => 'unique:users,username',
            'password' => 'min:6'
        ]);
        $id = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'level_id' => $request->level
        ]);
        if ($request->level == 4){
            DB::table('reseller')->insert(['idUser' => $id->id]);
            return redirect('/user');
        } else {
            return redirect('/user');
        }
    }
    public function updateView($id)
    {
        $data = User::find($id);
        $level = DB::table('level')->get();
        return view('user.update')->with(['data' => $data, 'level' => $level]);
    }
    public function update(Request $request, $id)
    {
        if ($request->password == ''){
            $request->validate([
                'email' => 'E-Mail'
            ]);
            User::find($id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email
            ]);
        } else {
            $request->validate([
                'email' => 'E-Mail',
                'password' => 'min:6'
            ]);
            User::find($id)->update([
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);
        }
        return redirect('/user');
    }
    public function destroy($id)
    {
        User::find($id)->delete();
        return redirect('/user');
    }
}
