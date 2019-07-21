@extends('layouts.master')

@section('header')
<link href="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/css/bootstrap-editable.css" rel="stylesheet"/>
@stop

@section('content')
<div class="main">
    <!-- MAIN CONTENT -->
    <div class="main-content">
        <div class="container-fluid">
            <div class="panel panel-profile">
                <div class="clearfix">
                    <!-- LEFT COLUMN -->
                    <div class="profile-left">
                        <!-- PROFILE HEADER -->
                        <div class="profile-header">
                            <div class="overlay"></div>
                            <div class="profile-main">
                                <img src="{{$siswa->getAvatar()}}" class="img-circle" alt="Avatar">
                                <h3 class="name">{{$siswa->nama_depan}}</h3>
                                <span class="online-status status-available">Available</span>
                            </div>
                            <div class="profile-stat">
                                <div class="row">
                                    <div class="col-md-4 stat-item">
                                        {{$siswa->mapel->count()}} <span>Mata Pelajaran</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        15 <span>Awards</span>
                                    </div>
                                    <div class="col-md-4 stat-item">
                                        2174 <span>Points</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- END PROFILE HEADER -->
                        <!-- PROFILE DETAIL -->
                        <div class="profile-detail">
                            <div class="profile-info">
                                <h4 class="heading">Data Diri</h4>
                                <ul class="list-unstyled list-justify">
                                    <li>Jenis Kelamin 
                                        <span>
                                            @if($siswa->jenis_kelamin==="L")Laki-laki @else Permpuan @endif
                                        </span>
                                    </li>
                                    <li>Agama <span>{{ucfirst($siswa->agama)}}</span></li>
                                    <li>Alamat <span>{{ucfirst($siswa->alamat)}}</span></li>
                                </ul>
                            </div>
                            <div class="text-center"><a href="/siswa/{{$siswa->user_id}}/edit" class="btn btn-warning">Edit Profile</a></div>
                        </div> 
                        <!-- END PROFILE DETAIL -->
                    </div>
                    <!-- END LEFT COLUMN -->
                    <!-- RIGHT COLUMN -->
                    <div class="profile-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                            Tambah Nilai
                        </button>
                        <!-- TABBED CONTENT -->
                        <div class="tab-content">
                                <div class="panel">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Mata Pelajaran</h3>
                                    </div>
                                        <div class="panel-body">
                                            <table class="table table-striped">
                                                <thead>
                                                    <tr>
                                                        <th>Kode</th>
                                                        <th>Nama</th>
                                                        <th>Semester</th>
                                                        <th>Nilai</th>
                                                        <th>Guru</th>
                                                        <th>Aksi</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($siswa->mapel as $mapel)
                                                    <tr>
                                                        <td>{{$mapel->kode}}</td>
                                                        <td>{{$mapel->nama}}</td>
                                                        <td>{{$mapel->semester}}</td>
                                                        <td><a href="#" class="nilai" data-type="text" data-pk="{{$mapel->id}}" data-url="/api/siswa/{{$siswa->id}}/editnilai" data-title="Masukkan Nilai">{{$mapel->pivot->nilai}}</a></td>{{--pivot untuk mengambilnilai dari tabel pivot(mapel_siswa)--}}
                                                        {{-- karena script ajax maka data yang dikirim tedak ke route web.php, tapi ke api.php --}}
                                                        <td><a href="/guru/{{$mapel->guru->id}}/profile">{{$mapel->guru->nama}}</a></td>
                                                        <td><a href="#" class="btn btn-danger btn-sm delete" style="text-align:center;" siswa-id="{{$siswa->id}}" mapel-id="{{$mapel->id}}">Delete</a></td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                            
                        </div>
                        <!-- END TABBED CONTENT -->
                        <div class="panel">
                            <div id="chartNilai"></div>
                        </div>
                    </div>
                    <!-- END RIGHT COLUMN -->
                </div>
            </div>
        </div>
    </div> 
    <!-- END MAIN CONTENT -->
</div>



<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Tambah Nilai</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <form action="/siswa/{{$siswa->id}}/addnilai" method="POST" enctype="multipart/form-data">
                {{csrf_field()}}
                <div class="form-group">
                    <label for="mapel">Mata Pelajaran</label>
                    <select class="form-control" id="mapel" name="mapel">
                        @foreach($matapelajaran as $mp)
                            <option value="{{$mp->id}}">{{$mp->nama}}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group{{$errors->has('nilai') ? ' has-error' : ''}}">
                <label for="exampleInputEmail1">Nilai</label>
                <input name="nilai" type="text" class="form-control  " id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Masukkan Nilai" value="{{old('nilai')}}">{{--value=old() berfungsi untuk menampilkan isi kolom setelah terjadi error--}}
                @if($errors->has('nilai'))
                    <span class="help-block">{{$errors->first('nilai')}}</span>
                @endif
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Input</button>
                </div>
            </form>
        </div>
        </div>

        </div>
    </div>
    </div>
@stop 

{{-- karna $categories berbentuk array, maka dia tidak bisa ditampilkan menggunakan "{{}}",dia harus diubah ke json terlebih dahulu lalu ditampilkan dengan tag khusus "{!! !!}" --}}
@section('footer')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/x-editable/1.5.0/bootstrap3-editable/js/bootstrap-editable.min.js"></script>

    <script>
        Highcharts.chart('chartNilai', { //membuat chart di div dengan id chartNilai 
            chart: {
                type: 'column'
            },
            title: {
                text: 'Laporan Nilai Siswa'
            },
            xAxis: {
                categories: {!!json_encode($categories)!!}, 
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Nilai'
                }
            },
            tooltip: {
                headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                footerFormat: '</table>',
                shared: true,
                useHTML: true
            },
            plotOptions: {
                column: {
                    pointPadding: 0.2,
                    borderWidth: 0
                }
            },
            series: [{
                name: 'Nilai',
                data: {!!json_encode($data)!!}
            }]
        });


    // script untuk edit nilai menggunakan ajax
    $(document).ready(function() {
        $('.nilai').editable();
    });
    

//script untuk pop up delete
    $('.delete').click(function(){//jika class dengan nama delete di klik
        var siswa_id = $(this).attr('siswa-id');//mengambil atribut dari siswa-id
        var mapel_id = $(this).attr('mapel-id');
        swal({
            title: "Yakin?",
            text: "Data mau dihapus?",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willDelete) => {//willdelet itu isinya "true"
            if (willDelete) {
                window.location="/siswa/"+siswa_id+"/"+mapel_id+"/deletenilai"
            } else {
                swal("Your imaginary file is safe!");
            }
            });
    })

</script>
@stop