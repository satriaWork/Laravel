<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GuruController extends Controller
{
    public function profile($id){
        $guru=\App\guru::find($id);
        return view('guru.profile',['guru'=>$guru]);
    }
}
