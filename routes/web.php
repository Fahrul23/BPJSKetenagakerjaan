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

Route::middleware(['auth', 'cart'])->get('/', 'HomeController@index')->name('panel');

Route::middleware(['auth', 'cart'])->group(function () {

    Route::middleware('can:admin')->group(function () {
        // barang

        Route::prefix('barang')->name('barang.')->group(function () {

            Route::prefix('pinjam')->name('pinjam.')->group(function () {

                Route::get('/', 'BarangPinjamController@index')->name('index');
                Route::get('/tambah', 'BarangPinjamController@create')->name('tambah');
                Route::post('/tambah', 'BarangPinjamController@store');

                Route::get('/kembali/{id}', 'BarangPinjamController@restore')->name('kembali');
                Route::get('/riwayat', 'BarangPinjamController@riwayat')->name('riwayat');

                Route::post('/tambah/barang', 'BarangPinjamController@storeMoreItem')->name('tambah.item');

                Route::get('/show/{id}', 'BarangPinjamController@show')->name('show');
                Route::put('/show/{id}', 'BarangPinjamController@update');

                Route::put('/update/status', 'BarangPinjamController@updateStatus')->name('update.status');
                Route::delete('/delete/permanent', 'BarangPinjamController@destroy')->name('destroy');
                Route::delete('/delete/{id}', 'BarangPinjamController@delete')->name('delete');

                Route::delete('/delete/item/{id}', 'BarangPinjamController@deleteItem')->name('delete.item');
            });

            Route::prefix('ambil')->name('ambil.')->group(function () {

                Route::get('/', 'BarangAmbilController@index')->name('index');
                Route::get('/tambah', 'BarangAmbilController@create')->name('tambah');

                Route::get('/kembali/{id}', 'BarangAmbilController@restore')->name('kembali');
                Route::get('/riwayat', 'BarangAmbilController@riwayat')->name('riwayat');
                Route::get('/habis', 'BarangAmbilController@habis')->name('habis');

                Route::post('/tambah', 'BarangAmbilController@store');
                Route::get('/show/{id}', 'BarangAmbilController@show')->name('detail');
                Route::put('/show/{id}', 'BarangAmbilController@update')->name('update');
                Route::delete('/delete/permanent', 'BarangAmbilController@destroy')->name('destroy');
                Route::delete('/delete/{id}', 'BarangAmbilController@delete')->name('delete');
            });
        });

        // kategori
        Route::get('/kategori', 'KategoriController@index')->name('kategori');
        Route::get('/kategori_riwayat', 'KategoriController@riwayat')->name('kategori_riwayat');
        Route::view('/kategori/tambah', 'kategori_tambah')->name('kategori_tambah');
        Route::post('/kategori', 'KategoriController@store')->name('input_kategori');
        Route::get('/kembali_kategori/{id}', 'kategoriController@restore')->name('kembali_kategori');
        Route::delete('/hapus_kategori', 'kategoriController@delete')->name('hapus_kategori');
        Route::delete('/buang_kategori', 'kategoriController@destroy')->name('buang_kategori');

        // user
        Route::prefix('user')->name('user.')->group(function() {
            Route::get('/', 'UserController@index')->name('index');
            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/create', 'UserController@store');
            Route::get('/history', 'UserController@history')->name('history');
            Route::get('/restore/{id}', 'UserController@restore')->name('restore');
            Route::delete('/delete', 'UserController@delete')->name('delete');
            Route::delete('/destroy', 'UserController@destroy')->name('destroy');
        });
        // Route::get('/user', 'UserController@index')->name('user');
        // Route::post('/user', 'UserController@store')->name('input_user');
        // Route::get('/kembali_user/{id}', 'UserController@restore')->name('kembali_user');
        // Route::delete('/hapus_user', 'UserController@delete')->name('hapus_user');
        // Route::delete('/buang_user', 'UserController@destroy')->name('buang_user');

        // konfirmasi peminjaman
        Route::get('/konfirmasi/peminjaman', 'KonfirmasiPeminjamanController@index')->name('konfirmasi_peminjaman');
        Route::get('/konfirmasi/peminjaman/detail/{id}', 'KonfirmasiPeminjamanController@detail')->name('konfirmasi_peminjaman_detail');
        Route::get('/konfirmasi/peminjaman/change/{id}', 'KonfirmasiPeminjamanController@change')->name('konfirmasi_peminjaman_ganti');
        Route::post('/konfirmasi/peminjaman/change/item/{id}', 'KonfirmasiPeminjamanController@item')->name('konfirmasi_peminjaman_ganti_item');
        Route::post('/konfirmasi/peminjaman/show/{id}', 'KonfirmasiPeminjamanController@show')->name('konfirmasi_peminjaman_ganti_detail');
        Route::post('/konfirmasi/peminjaman/approve', 'KonfirmasiPeminjamanController@changeApprove')->name('konfirmasi_peminjaman_ganti_barang');
        Route::post('/konfirmasi/peminjaman', 'KonfirmasiPeminjamanController@confirm')->name('konfirmasi_peminjaman_tambah');
        Route::post('/konfirmasi/peminjaman/ganti', 'KonfirmasiPeminjamanController@confirmGanti')->name('konfirmasi_peminjaman_tambah_ganti');
        Route::delete('/konfirmasi/peminjaman', 'KonfirmasiPeminjamanController@delete')->name('konfirmasi_peminjaman_hapus');
        Route::delete('/konfirmasi/peminjaman/item', 'KonfirmasiPeminjamanController@deleteChangedItem')->name('konfirmasi_peminjaman_hapus_item');

        // konfirmasi pengambilan
        Route::get('/konfirmasi/pengambilan', 'KonfirmasiPengambilanController@index')->name('konfirmasi_pengambilan');
        Route::get('/konfirmasi/pengambilan/detail/{id}', 'KonfirmasiPengambilanController@show')->name('konfirmasi_pengambilan_detail');
        Route::put('/konfirmasi/pengambilan/confirm', 'KonfirmasiPengambilanController@confirm')->name('konfirmasi_pengambilan_konfirmasi');
        Route::delete('/konfirmasi/pengambilan/delete/{id}', 'KonfirmasiPengambilanController@delete')->name('konfirmasi_pengambilan_hapus');
        Route::get('/konfirmasi/pengambilan', 'KonfirmasiPengambilanController@index')->name('konfirmasi_pengambilan');

        // konfirmasi pengembalian
        // Route::post('/riwayat/pengembalian', 'RiwayatKembaliController@index')->name('konfirmasi_pengembalian');
        // Route::get('/riwayat/pengembalian/kondisi_barang/{id}', 'RiwayatKembaliController@KondisiBarang')->name('kondisi_barang');

        // laporan
        // laporan peminjaman
        Route::get('/laporan/peminjaman', 'LaporanPeminjamanController@index')->name('laporan_peminjaman');
        Route::get('/laporan/peminjaman/detail/{id}', 'LaporanPeminjamanController@detail')->name('laporan_peminjaman_detail');
        Route::post('laporan/peminjaman/export_excel', 'LaporanPeminjamanController@export_excel')->name('laporan_peminjaman_export_excel');
        Route::post('laporan/peminjaman/export_pdf', 'LaporanPeminjamanController@export_pdf')->name('laporan_peminjaman_export_pdf');

        // laporan pengambilan
        Route::get('/laporan/pengambilan', 'LaporanPengambilanController@index')->name('laporan_pengambilan');
        Route::get('/laporan/pengambilan/detail/{id}', 'LaporanPengambilanController@detail')->name('laporan_pengambilan_detail');
        Route::post('/laporan/pengambilan/export_excel', 'LaporanPengambilanController@export_excel')->name('laporan_pengambilan_export_excel');
        Route::post('/laporan/pengambilan/export_pdf', 'LaporanPengambilanController@export_pdf')->name('laporan_pengambilan_export_pdf');

        // laporan pengembalian
        Route::get('/laporan/pengembalian', 'LaporanPengembalianController@index')->name('laporan_pengembalian');
        Route::get('/laporan/pengembalian/detail/{id}', 'LaporanPengembalianController@detail')->name('laporan_pengembalian_detail');
        Route::post('laporan/pengembalian/export_excel', 'LaporanPengembalianController@export_excel')->name('laporan_pengembalian_export_excel');
        Route::post('laporan/pengembalian/export_pdf', 'LaporanPengembalianController@export_pdf')->name('laporan_pengembalian_export_pdf');

        // laporan barang
        Route::get('/laporan/barang', 'LaporanBarangController@index')->name('laporan_barang');
        Route::post('/laporan/barang/export_excel', 'LaporanBarangController@export_excel')->name('laporan_barang_export_excel');
        Route::post('/laporan/barang/export_pdf', 'LaporanBarangController@export_pdf')->name('laporan_barang_export_pdf');
    });

    // surat jalan
    Route::get('/suratjalan', 'SuratJalanController@index')->name('suratjalan');

    // keluhan
    Route::get('/keluhan', 'KeluhanController@index')->name('keluhan');

    // setting	
    Route::get('/setting', 'SettingController@index')->name('setting');
    Route::get('/setting/{id}/profile', 'SettingController@profile')->name('profile');
    Route::post('/setting/profile', 'SettingController@profile_update')->name('profile_update');
    Route::get('/setting/{id}/password', 'SettingController@password')->name('password');
    Route::post('/setting/password', 'SettingController@password_update')->name('password_update');

    // riwayat 
    Route::prefix('riwayat')->name('riwayat.')->group(function () {
        Route::prefix('pinjam')->name('pinjam.')->group(function () {
            Route::get('/', 'RiwayatPinjamController@index')->name('index');
            Route::get('/show/{id}', 'RiwayatPinjamController@show')->name('show');
            Route::get('/cetak/{id}', 'RiwayatPinjamController@cetak')->name('cetak');
        });

        Route::prefix('ambil')->name('ambil.')->group(function () {
            Route::get('/', 'RiwayatAmbilController@index')->name('index');
            Route::get('/show/{id}', 'RiwayatAmbilController@show')->name('show');
            Route::get('/cetak/{id}', 'RiwayatAmbilController@cetak')->name('cetak');
        });

        Route::prefix('kembali')->name('kembali.')->group(function () {
            Route::get('/', 'RiwayatKembaliController@index')->name('index');
            Route::get('/show/{id}', 'RiwayatKembaliController@show')->name('kondisi');
            Route::post('/return', 'RiwayatKembaliController@return')->name('return');
        });
    });


    // aktivitas
    Route::prefix('aktivitas')->name('aktivitas.')->group(function () {

        // pinjam
        Route::prefix('pinjam')->name('pinjam.')->group(function () {
            Route::get('/', 'PinjamController@index')->name("index");
            Route::get('/item/{id}', 'PinjamController@show')->name('show');
            Route::get('/item/detail/{id}', 'PinjamController@create')->name('detail');
            Route::post('/item/create', 'PinjamController@store')->name('create');
        });

        // ambil
        Route::prefix('ambil')->name('ambil.')->group(function () {
            Route::get('/', 'AmbilController@index')->name('index');
            Route::get('/detail/{id}', 'AmbilController@show')->name('show');
            Route::post('/create', 'AmbilController@store')->name('create');
        });
    });

    // cart
    Route::get('/cart/pinjam', 'CartPeminjamanController@index')->name('cart_pinjam');
    Route::delete('/cart/pinjam/remove', 'CartPeminjamanController@remove')->name('cart_pinjam_remove');
    Route::delete('/cart/pinjam/destroy/{id}', 'CartPeminjamanController@destroy')->name('cart_pinjam_destroy');
    Route::put('/cart/pinjam/store', 'CartPeminjamanController@store')->name('cart_pinjam_store');

    Route::get('/cart/ambil', 'CartPengambilanController@index')->name('cart_ambil');
    Route::delete('/cart/ambil/remove', 'CartPengambilanController@remove')->name('cart_ambil_remove');
    Route::delete('/cart/ambil/destroy/{id}', 'CartPengambilanController@destroy')->name('cart_ambil_destroy');
    Route::put('/cart/ambil/store', 'CartPengambilanController@store')->name('cart_ambil_store');

});


Auth::routes([
    'register' => false,
    'verify' => false,
]);
