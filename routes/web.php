<?php
Route::namespace('API')->prefix('api')->name('API.')->group(function(){

        Route::prefix('jenis')->name('jenis.')->group(function(){
                Route::get('', 'JenisController@get')->name('get');
                Route::get('{uuid}', 'JenisController@find')->name('find');
                Route::post('', 'JenisController@create')->name('create');
                Route::put('{uuid}', 'JenisController@update')->name('update');
                Route::delete('{uuid}', 'JenisController@delete')->name('delete');
            });
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
        });
        Route::prefix('pelanggan')->name('pelanggan.')->group(function(){
            Route::get('', 'PelangganController@get')->name('get');
            Route::get('{uuid}', 'PelangganController@find')->name('find');
            Route::post('', 'PelangganController@create')->name('create');
            Route::put('{uuid}', 'PelangganController@update')->name('update');
            Route::delete('{uuid}', 'PelangganController@delete')->name('delete');
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

Route::get('/pelayanan/index','adminController@jenisPelayananIndex')
        ->name('pelayananIndex');
Route::get('/pelayanan/cetak','adminController@pelayananCetak')
        ->name('pelayananCetak');

Route::get('/analisis/index','adminController@analisisIndex')
        ->name('analisisIndex');

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
Route::get('/customer/profil/edit','customerController@profilEdit')
        ->name('profilEdit');
Route::get('/customer/pengujian','customerController@pengujianIndex')
        ->name('pengujianIndex');
Route::get('/notif/index','customerController@notifIndex')
        ->name('notifIndex');
Route::get('/notif/detail','customerController@notifDetail')
        ->name('notifDetail');
//
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
