<?php

use App\Http\Controllers\SiswaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('home');
});

Route::get('/logout','AuthController@logout');
Route::post('/postlogin','AuthController@postlogin');
Route::get('/login','AuthController@login')->name('login');//jika ingin menggunakan middleware, maka Route ke halaman login harus diberi nama 'login'

Route::group(['middleware' => ['auth','checkRole:admin']], function () {//RouterGroup= semua route yang ada didalam group akan menggunakan middleware
    Route::get('/siswa', 'SiswaController@index');
    Route::post('/siswa/create', 'SiswaController@create');
    Route::get('/siswa/{user_id}/edit', 'SiswaController@edit');
    Route::post('/siswa/{user_id}/update', 'SiswaController@update');
    Route::get('/siswa/{user_id}/delete', 'SiswaController@delete');    
    Route::get('/siswa/{id}/profile','SiswaController@profile');
    Route::post('/siswa/{id}/addnilai','SiswaController@addnilai');
    Route::get('/siswa/{id}/{mapel_id}/deletenilai','SiswaController@deletenilai');
    Route::get('/guru/{id}/profile','GuruController@profile');
});

Route::group(['middleware' => ['auth','checkRole:admin,siswa']], function () {
    Route::get('/dashboard','DashboardController@index');//middleware berfungsi supaya user dapat mengakses halaman jika sudah login 
});
