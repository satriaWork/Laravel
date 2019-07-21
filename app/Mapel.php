<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Mapel extends Model
{
    protected $table='Mapel';
    protected $fillable=['kode','nama','semester'];

    public function siswa(){
        return $this->belongsToMany(Siswa::class)->withPivot('nilai');//with povpt digunakan untuk mengambil nilai dari "nilai" pada tabel pivot(mapel_siswa) 
        //belongsToMany artinya satu mapel dapat dimiliki banyak siswa
    }

    public function guru(){
        return $this->belongsTo(guru::class);//belongsTo artinya satu mapel hanya dimiliki oleh satu guru
    }
}
