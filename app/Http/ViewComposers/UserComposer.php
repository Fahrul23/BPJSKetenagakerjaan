<?php

namespace App\Http\ViewComposers;

use Illuminate\View\View;
use Illuminate\Support\Facades\View as ViewShare;
use App\Repositories\UserRepository;
use Auth;
use DB;
use Session;
use Cart;


use App\User;
use App\PeminjamanDetail;
use App\Peminjaman;

use App\CartPinjam;
use App\CartAmbil;

class UserComposer
{
    public function compose(View $view)
    {
        // $peminjaman = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
        //     ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
        //     ->select('users.name', 'peminjaman.id')
        //     ->groupBy('peminjaman_detail.peminjamanable_id')
        //     ->whereNull('peminjaman_detail.confirmed_at')
        //     ->whereNull('peminjaman_detail.deleted_at');

        // DB::enableQueryLog();
        $peminjamans = Peminjaman::select('peminjaman.id', 'peminjaman.user_id', 'peminjaman_detail.id as detail_id')
            ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
            ->where('peminjamanable_type', 'App\Peminjaman')
            ->whereNull('confirmed_at')
            ->whereNull('peminjaman_detail.deleted_at')
            ->get();

        foreach ($peminjamans as $key => $value) {
            $has_change = PeminjamanDetail::withTrashed()->find($value->detail_id);
            $has_change = $has_change->peminjaman()->whereNotNull('confirmed_at')->first();

            if (!empty($has_change)) {
                unset($peminjamans[$key]);
            }
        }
        $peminjamans = $peminjamans->unique('id');

        $pengambilans = User::join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
            ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
            ->join('item_ambil', 'pengambilan_detail.items_id', '=', 'item_ambil.id')
            ->join('category', 'item_ambil.category_id', '=', 'category.id')
            ->select('users.name', 'item_ambil.name', 'item_ambil.image', 'category.category', 'pengambilan.id', 'pengambilan_detail.quantity')
            ->whereNull('pengambilan_detail.confirmed_at')
            ->whereNull('pengambilan_detail.deleted_at');

        $bell['peminjaman'] = $peminjamans;
        $bell['pengambilan'] = $pengambilans->get();
        $view->with('bell', $bell);
    }
}
