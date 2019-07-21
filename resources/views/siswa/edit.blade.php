@extends('layouts.master')
@section('content')

<div class="main">
        <div class="main-content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                    <div class="panel">
                        <div class="panel-heading">
                            <h3 class="panel-title">Inputs</h3>
                        </div>
                        <div class="panel-body">
                            <form action="/siswa/{{$siswa->user_id}}/update" method="POST" enctype="multipart/form-data">{{-- enctype tersebut berfungsi supaya bisa upload gambar --}}
                                {{csrf_field()}}
                                <div class="form-group{{$errors->has('nama_depan') ? ' has-error' : ''}}">
                                    <label for="exampleInputEmail1" >Nama Depan</label>
                                    <input name="nama_depan" type="text" class="form-control  " id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$siswa->nama_depan}}">
                                    @if($errors->has('nama_depan'))
                                        <span class="help-block">{{$errors->first('nama_depan')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Nama Belakang</label>
                                    <input name="nama_belakang" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$siswa->nama_belakang}}">
                                </div>
                                <div class="form-group{{$errors->has('email') ? ' has-error' : ''}}">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input name="email" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$user->email}}">
                                    @if($errors->has('email'))
                                        <span class="help-block">{{$errors->first('email')}}</span>
                                    @endif
                                </div>
                                <div class="form-group{{$errors->has('jneis_kelamin') ? ' has-error' : ''}}">
                                    <label for="exampleFormControlSelect1">Jenis Kelamin</label>
                                    <select name="jenis_kelamin" class="form-control" id="exampleFormControlSelect1">
                                        <option value="L" @if($siswa->jenis_kelamin=="L") selected @endif>Laki-laki</option>
                                        <option value="P" @if($siswa->jenis_kelamin=="P") selected @endif>Perempuan</option>
                                    </select>
                                    @if($errors->has('jenis_kelamin'))
                                        <span class="help-block">{{$errors->first('jenis_kelamin')}}</span>
                                    @endif
                                </div>
                                <div class="form-group{{$errors->has('agama') ? ' has-error' : ''}}">
                                    <label for="exampleInputEmail1">Agama</label>
                                    <input name="agama" type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$siswa->agama}}">
                                    @if($errors->has('agama'))
                                        <span class="help-block">{{$errors->first('agama')}}</span>
                                    @endif
                                </div>
                                <div class="form-group{{$errors->has('alamat') ? ' has-error' : ''}}">
                                    <label for="exampleFormControlTextarea1">Alamat</label>
                                    <textarea name="alamat" class="form-control" id="exampleFormControlTextarea1" rows="3">{{$siswa->alamat}}</textarea>
                                    @if($errors->has('alamat'))
                                        <span class="help-block">{{$errors->first('alamat')}}</span>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlTextarea1">Avatar</label>
                                    <input type="file" name="avatar" class="form-control">
                                </div>
                                <div class="modal-footer">
                                        <button type="submit" class="btn btn-warning">Update</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
        </div>
</div>
@stop