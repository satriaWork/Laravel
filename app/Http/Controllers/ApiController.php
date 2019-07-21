<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function editnilai(Request $request,$id){

        // $siswa= $request->all();
        $siswa=\App\Siswa::find($id);
        $siswa->mapel()->updateExistingPivot($request->pk,['nilai'=>$request->value]);// dalam parameter tersebut kita mengambil nilai mapel_id dengan perintah "$request->pk", menggunakan pk karena pk tersebut berisi mapel_id yang dikirim dari data-pk di profile.blade.php. 
        // sebelumnya kita sudah melihat keluaran dari $siswa= $request->all(); untuk mengetahui letak pk dan value dengan cara inspect element -> pilih network -> editnilai.
    }
}
