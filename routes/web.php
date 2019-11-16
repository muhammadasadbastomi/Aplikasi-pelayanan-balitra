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

Route::namespace('API')->prefix('api')->name('API.')->group(function(){
        Route::prefix('pelayanan')->name('pelayanan.')->group(function(){
                Route::get('', 'PelayananController@get')->name('get');
                Route::get('{uuid}', 'PelayananController@find')->name('find');
                Route::post('', 'PelayananController@create')->name('create');
                Route::put('{uuid}', 'PelayananController@update')->name('update');
                Route::delete('{uuid}', 'PelayananController@delete')->name('delete');
        });

        Route::prefix('karyawan')->name('karyawan.')->group(function(){
            Route::get('', 'KaryawanController@get')->name('get');
            Route::get('{uuid}', 'KaryawanController@find')->name('find');
            Route::post('', 'KaryawanController@create')->name('create');
            Route::put('{uuid}', 'KaryawanController@update')->name('update');
            Route::delete('{uuid}', 'KaryawanController@delete')->name('delete');

        Route::prefix('pelanggan')->name('pelanggan.')->group(function(){
            Route::get('', 'PelangganController@get')->name('get');
            Route::get('{uuid}', 'PelangganController@find')->name('find');
            Route::post('', 'PelangganController@create')->name('create');
    });
});

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
Route::get('/customer/pengujian','customerController@pengujianIndex')
        ->name('pengujianIndex');
//
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
