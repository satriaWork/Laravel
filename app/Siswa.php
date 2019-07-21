<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $fillable = ['nama_depan', 'nama_belakang', 'jenis_kelamin', 'agama', 'alamat','avatar','user_id'];

    public function getAvatar(){
        if(!$this->avatar){
            return asset('images/default.jpg');
        }
        return asset('images/'.$this->avatar); 
    }
    
    //fungsi ini menunjukan relasi many to many antara tabel mapel dan siswa
    public function mapel(){
        return $this->belongsToMany(Mapel::class)->withPivot('nilai')->withTimeStamps();
        // withTimeStamps digunakan supaya timestaps/updated_at terisi didatabase otomatis
        //belongsToMany artinya satu siswa dapat memiliki banyak mapel

    }
}
