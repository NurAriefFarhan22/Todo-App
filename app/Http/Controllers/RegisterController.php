<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterController extends Controller
{
    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => 'required',
           'password' => 'required',
        ]);

        $validateData['password'] = bcrypt($validateData['password']);

        User::create($validateData);

        // return back()->with('Berhasil', 'Register Berhasil!');
        return redirect('/login')->with('succcessRegister', 'Berhasil menambahkan akun');
    }
}
