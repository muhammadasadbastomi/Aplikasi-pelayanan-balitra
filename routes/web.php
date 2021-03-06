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
        Route::prefix('buah')->name('buah.')->group(function(){
                Route::get('', 'BuahController@get')->name('get');
                Route::get('{uuid}', 'BuahController@find')->name('find');
                Route::post('', 'BuahController@create')->name('create');
                Route::put('{uuid}', 'BuahController@update')->name('update');
                Route::delete('{uuid}', 'BuahController@delete')->name('delete');
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
        Route::prefix('customer')->name('customer.')->group(function(){
                Route::get('', 'CustomerController@get')->name('get');
                Route::get('{uuid}', 'CustomerController@find')->name('find');
                Route::delete('{uuid}', 'CustomerController@delete')->name('delete');
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
                Route::post('', 'PermohonanController@permohonan_create')->name('create');
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
                Route::put('{uuid}', 'PengujianController@update')->name('update');
                Route::delete('{uuid}', 'PengujianController@delete')->name('delete');
                });
   
});

// middleware admin

Route::get('/admin/index','adminController@index')
        ->name('adminIndex');

Route::get('/buah/index','adminController@buahIndex')
        ->name('buahIndex');
Route::get('/buah/cetak','adminController@buahCetak')
        ->name('buahCetak');

Route::get('/pemohon/index','adminController@pemohonIndex')
        ->name('pemohonIndex');
Route::get('/pemohon/cetak','adminController@pemohonCetak')
        ->name('pemohonCetak');
Route::get('/analisis/pemohon/cetak','adminController@analisisPemohon')
        ->name('analisisPemohon');

Route::get('/pelayanan/index','adminController@jenisPelayananIndex')
        ->name('pelayananIndex');
Route::get('/jenis_pelayanan/cetak','adminController@kategoriCetak')
        ->name('kategoriCetak');
Route::get('/pelayanan/cetak','adminController@pelayananCetak')
        ->name('pelayananCetak');
Route::get('/pelayanan/filter','adminController@pelayananFilter')
        ->name('pelayananFilter');
Route::post('/pelayanan/filter','adminController@pelayananFilterCetak')
        ->name('pelayananFilterCetak');

Route::get('/pengujian/cetak','adminController@pengujianCetak')
        ->name('pengujianCetak'); 
Route::get('/pengujian/filter','adminController@pengujianFilter')
        ->name('pengujianFilter');
Route::post('/pengujian/filter','adminController@pengujianFilterCetak')
        ->name('pengujianFilterCetak');  
Route::get('/nota/cetak/{id}','adminController@notaCetak')
        ->name('cetakNota');           

Route::get('/analisis/index','adminController@analisisIndex')
        ->name('analisisIndex');

Route::get('/karyawan/index','adminController@karyawanIndex')
        ->name('karyawanIndex');
Route::get('/karyawan/info','adminController@karyawanInfo')
        ->name('karyawanInfo');
Route::get('/karyawan/cetak','adminController@karyawanCetak')
        ->name('karyawanCetak');
//route berita
Route::get('/berita/index','adminController@beritaIndex')
        ->name('beritaIndex');
Route::get('/berita/cetak','adminController@beritaCetak')
        ->name('beritaCetak');
//route permohonan
Route::get('/permohonan/index','adminController@permohonanIndex')
        ->name('permohonanIndex');
Route::get('/permohonan/verifikasi/{uuid}','adminController@verifikasiPermohonan')
        ->name('verifikasiPermohonan');
Route::post('/permohonan/verifikasi/{uuid}','API\PengujianController@create')
        ->name('verifikasiPermohonanCreate');
Route::get('/permohonan/cetak','adminController@permohonanCetak')
        ->name('permohonanCetak');
Route::get('/permohonan/filter','adminController@permohonanFilter')
        ->name('permohonanFilter');
Route::post('/permohonan/filter','adminController@permohonanFilterCetak')
        ->name('permohonanFilterCetak');
Route::get('/permohonan/filter/waktu','adminController@permohonanFilterWaktu')
        ->name('permohonanFilterWaktu');
Route::post('/permohonan/filter/waktu','adminController@permohonanFilterWaktuCetak')
        ->name('permohonanFilterWaktuCetak');
Route::get('/analisis/permohonan','adminController@analisisPermohonan')
        ->name('analisisPermohonan');
//pengujian Index
Route::get('/pengujian/index','adminController@pengujianIndex')
        ->name('pengujianIndex');
Route::get('/pengujian/detail/{uuid}','adminController@pengujianDetail')
        ->name('pengujianDetail');
Route::get('/pengujian/edit/{uuid}','adminController@pengujianEdit')
        ->name('pengujianEdit');
Route::get('/analisis/pengujian','adminController@analisisPengujian')
        ->name('analisisPengujian');
//pendapatan
Route::get('/pendapatan/data','adminController@pendapatanIndex')
        ->name('pendapatanIndex');
Route::get('/pendapatan/keseluruhan','adminController@pendapatanKeseluruhan')
        ->name('pendapatankeseluruhan');
Route::get('/pendapatan/filter','adminController@pendapatanFilterWaktu')
        ->name('pendapatanFilterWaktu');
Route::post('/pendapatan/filter','adminController@pendapatanFilterWaktuCetak')
        ->name('pendapatanFilterWaktuCetak');
Route::get('/pendapatan/filter/pelayanan','adminController@pendapatanFilterPelayanan')
        ->name('pendapatanFilterPelayanan');
Route::post('/pendapatan/filter/pelayanan','adminController@pendapatanFilterPelayananCetak')
        ->name('pendapatanFilterPelayananCetak');
});
// akhir middleware admin

//middleware customer
Route::namespace('API')->prefix('api')->name('API.')->group(function(){
        Route::prefix('permohonan-customer')->name('permohonan-customer.')->group(function(){
                Route::post('', 'PermohonanController@create')->name('create');
                Route::get('', 'PermohonanController@getByUser')->name('get');
                Route::get('{uuid}', 'PermohonanController@find')->name('find');
        });
        Route::prefix('pelayanan-customer')->name('pelayanan-customer.')->group(function(){
                Route::get('', 'PelayananController@get')->name('get');
                Route::get('{uuid}', 'PelayananController@find')->name('find');
                Route::get('edit/{uuid}', 'PelayananController@findEdit')->name('findEdit');
        });
        Route::prefix('jenis-customer')->name('jenis-customer.')->group(function(){
                Route::get('', 'JenisController@get')->name('get');
                Route::get('{uuid}', 'JenisController@find')->name('find');
        });
        Route::prefix('permohonan-detail-customer')->name('permohonan-detail-customer.')->group(function(){
                Route::get('{id}', 'PermohonanController@permohonan_get')->name('get');
                Route::post('', 'PermohonanController@permohonan_create')->name('create');
                Route::post('/permohonan/total', 'PermohonanController@permohonan_total_create')->name('total');
                Route::delete('{uuid}', 'PermohonanController@permohonan_delete')->name('delete');
         });
        Route::prefix('buah-customer')->name('buah-customer.')->group(function(){
                Route::get('', 'BuahController@get')->name('get');
                Route::get('{uuid}', 'BuahController@find')->name('find');
            });
        Route::prefix('pengujian-customer')->name('pengujian-customer.')->group(function(){
                Route::get('', 'PengujianController@getByCustomer')->name('getByCustomer');
                Route::get('{uuid}', 'PengujianController@find')->name('find');
                });


});

Route::get('/customer/index','customerController@index')
        ->name('customerIndex');
Route::get('/customer/profil/tambah','customerController@profil_tambah')
        ->name('profil_tambah');
Route::post('/customer/profil/tambah','customerController@profil_tambah_store')
        ->name('profil_tambah_store');
Route::put('/customer/profil/tambah','customerController@profil_update')
        ->name('profil_update');
Route::get('/customer/pengujian','customerController@pengujianCustomerIndex')
        ->name('customerPengujianIndex');
Route::get('/notif/index','customerController@notifIndex')
        ->name('notifIndex');
Route::get('/notif/detail/{id}','customerController@notifDetail')
        ->name('notifDetail');
Route::get('/permohonan/add/{uuid}','customerController@permohonanAdd')
        ->name('permohonanAdd');
Route::get('/permohonan/customer/index','customerController@permohonanIndex')
        ->name('permohonanCustomerIndex');
Route::get('/permohonan/customer/cetak','adminController@permohonanCustomerCetak')
        ->name('permohonanCustomerCetak');
Route::post('/permohonan/customer/total/create','API\permohonanController@permohonan_total_create')
        ->name('permohonanTotalCreate');
Route::get('/pengujian/customer/detail/{uuid}','customerController@pengujianCustomerDetail')
        ->name('pengujianCustomerDetail');
Route::get('/pengujian/customer/cetak','adminController@pengujianCustomerCetak')
        ->name('pengujianCustomerCetak');
Route::get('/nota/customer/cetak/{id}','adminController@detailPengujianCetak')
        ->name('cetakCustomerNota');
Route::get('/notif/cetak/{id}','adminController@notifCetak')
        ->name('notifCetak');    


//

Route::get('/','adminController@depan')
        ->name('depan');

Auth::routes();

Route::get('/home', 'DashboardController@index')->name('home');
Route::get('/berita/depan','adminController@beritaDepan')
        ->name('beritaDepan');
Route::get('/berita/detail/{uuid}','adminController@beritaDetail')
        ->name('beritaDetail');