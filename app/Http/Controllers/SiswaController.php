<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Siswa; 

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data_siswa = \App\Siswa::where('nama_depan', 'LIKE', '%'.$request->cari.'%')->get();
            if($data_siswa=='[]'){
                return redirect('/siswa')->with('gagal', 'data tidak ditemukan');
            }
        } else {
            $data_siswa = Siswa::all();// tidak menggunakan \App\Siswa karna diatas sudah menggunakan use App\Siswa
        }
        return view('siswa.index', ['data_siswa' => $data_siswa]);
    }


    public function create(Request $request)
    {   
        $this->validate($request,[
            'nama_depan'=>'required|min:3',
            'email'=>'required|email|unique:users',
            'jenis_kelamin'=>'required',
            'agama'=>'required',
            'avatar'=>'mimes:jpeg,png'
            ]);

        //insert ke table user
        $user=new \App\User;
        $user->role='siswa';
        $user->name=$request->nama_depan;
        $user->email=$request->email;
        $user->password=bcrypt('rahasia');
        $user->remember_token=str_random(60);
        $user->save();

        // insert ke table siswa
        $request->request->add(['user_id'=>$user->id]);
        $siswa=\App\Siswa::create($request->all());
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar=$request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }

        return redirect('/siswa')->with('sukses', 'data berhasil ditambahkan');
    }

    
    public function edit($user_id)
    {
        $siswa =\App\Siswa::where('user_id', $user_id)->get()->first();
        $user=\App\User::find($user_id);
        // dd($user);
        return view('siswa.edit', ['siswa' => $siswa, 'user'=>$user]);
    }

    public function update(Request $request, $user_id)
    {
        $siswa =\App\Siswa::where('user_id', $user_id)->get()->first();
        $data = request()->except(['_token','email']);//mengpdate semua data kecuali _token dan email(soalnya email mau dimasukin ke tabel user bukan tabel siswa)
        $siswa->update($data);
        if($request->hasFile('avatar')){
            $request->file('avatar')->move('images/',$request->file('avatar')->getClientOriginalName());
            $siswa->avatar=$request->file('avatar')->getClientOriginalName();
            $siswa->save();
        }
        
        $user =\App\User::find($user_id);
        $user->update([$user->name=$request->nama_depan, $user->email=$request->email]);

        $this->validate($request,[
            'nama_depan'=>'required|min:3',
            'jenis_kelamin'=>'required',
            'agama'=>'required',
            'avatar'=>'mimes:jpeg,png'
            ]);

        return redirect('/siswa')->with('sukses', 'data berhasil diupdate');
    }

    public function delete($user_id)
    {
        $siswa =\App\Siswa::where('user_id', $user_id)->delete();

        $user = \App\User::find($user_id);
        $user->delete();

        return redirect('/siswa')->with('sukses', 'data berhasil dihapus');
    }

    public function profile($id){
        $siswa=\App\Siswa::find($id);
        $matapelajaran=\App\Mapel::All();

        //menyiapkan data untuk chart
        $categories=[];
        $data=[];
        //perulangan untuk menampung semua nama matpel di array categories untuk dikirim ke chart
        foreach($matapelajaran as $mp){
            if($siswa->mapel()->where('mapel_id',$mp->id)->first()){
                $categories[]=$mp->nama;
                $data[]=$siswa->mapel()->where('mapel_id',$mp->id)->first()->pivot->nilai;//mengambil nilai pada tabel pivot(mapel_siswa)
            }
        }
        return view('siswa.profile',['siswa'=>$siswa,'matapelajaran'=>$matapelajaran,'categories'=>$categories,'data'=>$data]);
    }

    public function addnilai(Request $request,$id){
        $siswa=\App\Siswa::find($id);
        if($siswa->mapel()->where('mapel_id',$request->mapel)->exists()){//apakah ditabel pivot dengan id tersebut itu ada
            return redirect('siswa/'.$id.'/profile')->with('gagal','Data Mata Pelajaran sudah ada');
        }

        $siswa->mapel()->attach($request->mapel,['nilai'=>$request->nilai]);// attach merupakan memasukkan atau menambah data yang diambil dari database pivot(mapel_siswa) yaitu berupa "nilai"
        
        return redirect('siswa/'.$id.'/profile')->with('sukses','Data berhasil ditambahkan');
    }

    public function deletenilai($idsiswa,$idmapel){
        $siswa=\App\Siswa::find($idsiswa);
        $siswa->mapel()->detach($idmapel);// detach merupakan melepaskan pivot atau melepaskan data dari tabel pivot

        return redirect()->back()->with('sukses','Data nilai berhasil dihapus');//back() merupakan fungsi untuk kembali ke halaman itu lagi/ tidak pindah kehalaman lain/ tetap disitu.
    }


}
