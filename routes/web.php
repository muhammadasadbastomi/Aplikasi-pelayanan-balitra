<?php
Route::group(['middleware' => 'admin'], function() {
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
                Route::get('edit/{uuid}', 'PelayananController@findEdit')->name('findEdit');
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
        Route::prefix('permohonan')->name('permohonan.')->group(function(){
            Route::get('', 'PermohonanController@get')->name('get');
            Route::get('{uuid}', 'PermohonanController@find')->name('find');
            Route::post('', 'PermohonanController@create')->name('create');
            Route::put('{uuid}', 'PermohonanController@update')->name('update');
            Route::delete('{uuid}', 'PermohonanController@delete')->name('delete');
        });
        Route::prefix('permohonan_detail')->name('permohonan_detail.')->group(function(){
                Route::get('{uuid}', 'PermohonanController@permohonan_get')->name('get');
                Route::post('', 'PermohonanController@permohonan_create')->name('creritaeate');
                Route::delete('{uuid}', 'PermohonanController@permohonan_delete')->name('delete');
         });
        Route::prefix('berita')->name('berita.')->group(function(){
                Route::get('', 'BeritaController@get')->name('get');
                Route::get('{uuid}', 'BeritaController@find')->name('find');
                Route::post('', 'BeritaController@create')->name('create');
                Route::post('update/{uuid}', 'BeritaController@update')->name('update');
                Route::delete('{uuid}', 'BeritaController@delete')->name('delete');
                });
        Route::prefix('pengujian')->name('pengujian.')->group(function(){
                Route::get('', 'PengujianController@get')->name('get');
                Route::get('{uuid}', 'PengujianController@find')->name('find');
                Route::post('', 'PengujianController@create')->name('create');
                Route::post('update/{uuid}', 'PengujianController@update')->name('update');
                Route::delete('{uuid}', 'PengujianController@delete')->name('delete');
                });
   
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
Route::get('/karyawan/info','adminController@karyawanInfo')
        ->name('karyawanInfo');
//route berita
Route::get('/berita/index','adminController@beritaIndex')
        ->name('beritaIndex');
Route::get('/berita/depan','adminController@beritaDepan')
        ->name('beritaDepan');
Route::get('/berita/detail/{uuid}','adminController@beritaDetail')
        ->name('beritaDetail');
//route permohonan
Route::get('/permohonan/index','adminController@permohonanIndex')
        ->name('permohonanIndex');
Route::get('/permohonan/verifikasi/{uuid}','adminController@verifikasiPermohonan')
        ->name('verifikasiPermohonan');
Route::post('/permohonan/verifikasi/{uuid}','API\PengujianController@create')
        ->name('verifikasiPermohonanCreate');
Route::get('/permohonan/cetak','adminController@permohonanCetak')
        ->name('permohonanCetak');
        
});
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
Route::get('/permohonan/customer/index','customerController@permohonanCustomerIndex')
        ->name('permohonanCustomerIndex');
//

Route::get('/','adminController@depan')
        ->name('depan');

Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');
