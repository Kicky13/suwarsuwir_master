<?php

namespace App\Http\Controllers;

use App\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('user.index', compact('users'));
    }

    public function createView()
    {
        $roles = Role::all();
        return view('user.create', compact('roles'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'email' => 'E-Mail',
            'username' => 'unique:users,username',
            'password' => 'min:6'
        ]);
        echo $request->role;
        User::create([
            'username' => $request->username,
            'password' => bcrypt($request->password),
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'role_id' => $request->role
        ]);
        return redirect('/user');
    }

    public function updateView($id)
    {
        $user = User::find($id);
        $roles = Role::all();
        return view('user.update')->with(['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, $id)
    {
        if ($request->password == '') {
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
