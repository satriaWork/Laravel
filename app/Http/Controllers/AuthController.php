<?php

namespace App\Http\Controllers;

use Auth;//class Auth bawaan dari laravel
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(){
        return view('auths.login');
    }

    public function postlogin(Request $request){
        if(Auth::attempt($request->only('email','password'))){
            return redirect('/dashboard');
        }        
        return redirect('/login')->with('gagal','Username atau Password salah');    
    }

    public function logout(){
        Auth::logout();
        return redirect('/login');
    }
}
