<?php

namespace App\Http\Controllers;

use Auth;

use App\ItemPinjamDetail;
use App\ItemAmbil;

use App\Peminjaman;
use App\PeminjamanDetail;

use App\Pengambilan;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $role = Auth::user()->role;

        // $item_kembali_jum = Peminjaman::join('peminjaman_detail', 'peminjaman_detail.peminjamanable_id', '=', 'peminjaman.id')
        //     ->whereNotNull('confirmed_at')->whereNull('returned_at');

        $item_kembali = new Peminjaman;

        if ($role == 'admin') {
            $item_pinjam_jum = ItemPinjamDetail::count();
            $item_ambil_jum = ItemAmbil::count();
            $item_jum = $item_ambil_jum + $item_pinjam_jum;
            $item_habis_jum = ItemAmbil::where('stock', 0)
                ->get()->count();
            $data = ['item_pinjam_jum', 'item_ambil_jum', 'item_habis_jum', 'item_jum'];
        } else {
            $user_id = Auth::id();
            $act_pinjam_jum = Peminjaman::where('user_id', $user_id)->get()->count();
            $act_ambil_jum = Pengambilan::where('user_id', $user_id)->get()->count();
            $act_jum = $act_ambil_jum + $act_pinjam_jum;
            $item_kembali = $item_kembali->where('user_id', $user_id);
            $data = ['act_pinjam_jum', 'act_ambil_jum', 'act_jum'];
        }

        $item_kembali = $item_kembali->get();

        $item_kembali_jum = collect();

        foreach ($item_kembali as $key => $value) {
            $peminjamans = $value->peminjamans;
            foreach ($peminjamans as $peminjaman) {
                $changed = $peminjaman->peminjaman()->whereNotNull('confirmed_at')->whereNull('returned_at')->first();
                if ( !empty($changed) ) {
                    $item_kembali_jum->push($changed);
                }
                if ( !empty($peminjaman->confirmed_at) && empty($peminjaman->returned_at) ) {
                    $item_kembali_jum->push($peminjaman);
                }
            }
        }

        $item_kembali_jum = $item_kembali_jum->count();
        $data[] = 'item_kembali_jum';

        $item_baru = ItemAmbil::latest('updated_at')->limit(5)->get();
        $data[] = 'item_baru';

        return view('panel', compact($data));
    }
}
