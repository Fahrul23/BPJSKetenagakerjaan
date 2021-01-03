<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    public function boot()
    {
        // Using class based composers...
        View::composer(
            // [
            //     'dashboard',
            //     'riwayat_peminjaman',
            //     'riwayat_pengambilan',
            //     'riwayat_pengembalian',
            //     'setting',
            //     'setting_profile',
            //     'setting_password',
            //     'cart_peminjaman',
            //     'cart_pengambilan',
            //     'aktivitas',
            //     'aktivitas_detail',
            //     'konfirmasi_peminjaman',
            //     'konfirmasi_peminjaman_detail',
            //     'konfirmasi_peminjaman_ganti',
            //     'konfirmasi_peminjaman_ganti_detail',
            //     'konfirmasi_pengambilan',
            //     'konfirmasi_pengambilan_detail',
            //     'konfirmasi_pengembalian',
            //     'laporan_peminjaman',
            //     'laporan_peminjaman_detail',
            //     'laporan_pengambilan',
            //     'laporan_pengambilan_detail',
            //     'laporan_barang',
            //     'laporan_pengembalian',
            //     'laporan_pengembalian_detail',
            //     'barang',
            //     'barang_edit',
            //     'user',
            //     'panel',
            //     'kategori',
            //     'aset',
            //     'suratjalan',
            // ]
            '*',
            'App\Http\ViewComposers\UserComposer'
        );
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
