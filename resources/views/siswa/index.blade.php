@extends('layouts.master')
@section('content')
    <div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Data Siswa</h3>
                            <div class="right">
                                <button type="button" class="btn" data-toggle="modal" data-target="#exampleModal"><i class="lnr lnr-plus-circle"></i></button>
                            </div>
                        </div>
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nama Depan</th>
                                        <th>Nama Belakang</th>
                                        <th>Jenis Kelamin</th>
                                        <th>Agama</th>
                                        <th>Alamat</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                @foreach ($data_siswa as $siswa)
                                    <tr>
                                        <td><a href="/siswa/{{$siswa->id}}/profile" > {{$siswa->nama_depan}}</a></td>
                                        <td><a href="/siswa/{{$siswa->id}}/profile" > {{$siswa->nama_belakang}}</a></td>
                                        <td>{{$siswa->jenis_kelamin}}</td>
                                        <td>{{$siswa->agama}}</td>
                                        <td>{{$siswa->alamat}}</td>
                                        <td><a href="/siswa/{{$siswa->user_id}}/edit" class="btn btn-warning btn-sm" style="text-align:center;">Edit</a>
                                        <a href="#" class="btn btn-danger btn-sm delete" style="text-align:center;" siswa-id="{{$siswa->user_id}}" siswa-nama="{{$siswa->nama_depan}}">Delete</a></td>
                                        {{-- class delete diatas bukan nama CSS tapi class untuk jquery alert --}}
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/siswa/create" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <div class="form-group{{$errors->has('nama_depan') ? ' has-error' : ''}}">
                    {{--ini merupakan percabangan(if-else) versi laravel, $errors merupakan variabel yang disediakan oleh laravel apa bila terjadi error--}}
                    {{-- cara bacanya : apabila teclass="form-group{{$errors->has('nama_depan') ? ' has-error' : ''}}"rjadi error terhadap nama_dapan maka akan menampilkan "has-error" jika tidak ada error maka dikosongkan --}}
                    {{-- ? merupakan simbol untuk 'jika benar' --}}
                        <label for="exampleInputEmail1">Nama Depan</label>
                        <input name="nama_depan" type="text" class="form-control  " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama Depan" value="{{old('nama_depan')}}">{{--value=old() berfungsi untuk menampilkan isi kolom setelah terjadi error--}}
                        @if($errors->has('nama_depan'))
                            <span class="help-block">{{$errors->first('nama_depan')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('nama_belakang') ? ' has-error' : ''}}">
                        <label for="exampleInputEmail1">Nama Belakang</label>
                        <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nama Belakang" value="{{old('nama_belakang')}}">
                        @if($errors->has('nama_belakang'))
                            <span class="help-block">{{$errors->first('nama_belakang')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                            <label for="exampleInputEmail1">Email</label>
                            <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Email" value="{{old('email')}}">
                            @if($errors->has('email'))
                                <span class="help-block">{{$errors->first('email')}}</span>
                            @endif
                    </div>
                    <div class="form-group{{$errors->has('jenis_kelamin') ? ' has-error' : ''}}">
                        <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                        <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                            <option value="L" @if(old('jenis_kelamin')=='L') selected @endif>Laki-laki</option>
                            <option value="P" @if(old('jenis_kelamin')=='P') selected @endif>Perempuan</option>
                        </select>
                        @if($errors->has('jenis_kelamin'))
                            <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                        @endif
                    </div>
                    <div class="form-group{{$errors->has('agama') ? ' has-error' : ''}}">
                        <label for="exampleInputEmail1">Agama</label>
                        <input name="agama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Agama" value="{{old('agama')}}">
                        @if($errors->has('agama'))
                            <span class="help-block">{{$errors->first('agama')}}</span>
                        @endif
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Alamat</label>
                        <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{old('alamat')}}</textarea>{{--untuk text area old()-nya tidak menggunakan value--}}
                    </div>
                    <div class="form-group{{$errors->has('avatar') ? ' has-error' : ''}}" >
                        <label for="exampleFormControlTextarea1">Avatar</label>
                        <input type="file" name="avatar" class="form-control">
                        @if($errors->has('avatar'))
                            <span class="help-block">{{$errors->first('avatar')}}</span>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
            </div>
        </div>
@stop
@section('footer')
    <script>//sebelum menulis script, pasang dulu source javascriptnya di master
        $('.delete').click(function(){//jika class dengan nama delete di klik
            var siswa_id = $(this).attr('siswa-id');//mengambil atribut dari siswa-id
            var siswa_nama = $(this).attr('siswa-nama');
            swal({
            title: "Yakin?",
            text: "Data "+siswa_nama+" mau dihapus?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {//willdelet itu isinya "true"
                if (willDelete) {
                    window.location="/siswa/"+siswa_id+"/delete"
                } else {
                    swal("Your imaginary file is safe!");
                }
                });
        })
    </script>
@stop