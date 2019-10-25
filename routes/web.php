<?php

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
    return view('welcome');
});

// middleware admin

Route::get('/admin/index','adminController@index')
        ->name('adminIndex');

Route::get('/pemohon/index','adminController@pemohonIndex')
        ->name('pemohonIndex');

Route::get('/jenisPelayanan/index','adminController@jenisPelayananIndex')
        ->name('jenisPelayananIndex');
Route::get('/jenisPelayanan/edit','adminController@jenisPelayananEdit')
        ->name('jenisPelayananEdit');

Route::get('/karyawan/index','adminController@karyawanIndex')
        ->name('karyawanIndex');
Route::get('/karyawan/edit','adminController@karyawanEdit')
        ->name('karyawanEdit');
Route::get('/karyawan/info','adminController@karyawanInfo')
        ->name('karyawanInfo');
        
// akhir middleware admin

//middleware customer

Route::get('/customer/index','customerController@index')
        ->name('customerIndex');
//
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
