<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;

use App\User;
use App\PeminjamanDetail;
use App\Item;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

use App\Exports\ActivityPengambilanExport;
use App\Exports\ActivityPeminjamanExport;
use App\ItemPinjamDetail;
use Maatwebsite\Excel\Facades\Excel;

class RiwayatController extends Controller
{
    /**
     * Display listing resource for activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function peminjaman()
    {
        $peminjaman = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
            ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
            ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
            ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
            ->join('category', 'item_pinjam.category_id', '=', 'category.id')
            ->select('users.name', 'peminjaman_detail.id', 'peminjaman_detail.keterangan', 'peminjaman_detail.date_start', 'peminjaman_detail.date_end', 'peminjaman_detail.confirmed_at', 'peminjaman_detail.returned_at', 'peminjaman_detail.created_at', 'peminjaman_detail.peminjamanable_type', DB::raw('item_pinjam_detail.name as barang'), 'item_pinjam_detail.image',  'category.category')
            ->where('peminjamanable_type', 'App\Peminjaman')
            ->orderBy('peminjaman.id', 'desc');

        if (Auth::user()->role == 'user') {
            $peminjaman = $peminjaman->where('users.id', '=', Auth::id());
        }

        $peminjaman = $peminjaman->get();

        $peminjaman_ganti = [];

        // DB::enableQueryLog();
        foreach ($peminjaman as $key => $value) {
            $peminjaman_changed = PeminjamanDetail::find($value->id);
            // dd($peminjaman_changed);
            $peminjaman_changed = $peminjaman_changed->peminjaman;

            if (!empty($peminjaman_changed)) {
                $item = ItemPinjamDetail::join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
                    ->join('category', 'item_pinjam.category_id', '=', 'category.id')
                    ->where('item_pinjam_detail.id', $peminjaman_changed->items_id)->first();

                $peminjaman_changed->name = $item->name;

                $peminjaman_changed->image = $item->image;
                $peminjaman_changed->category = $item->category;

                $value->ganti = $peminjaman_changed;
                array_push($peminjaman_ganti, $value);
                // dd($peminjaman_ganti);
                unset($peminjaman[$key]);
            }
        }
        // dd($peminjaman_ganti);

        return view('riwayat_peminjaman', ['peminjaman' => $peminjaman, 'peminjaman_ganti' => $peminjaman_ganti, 'judul' => 'Peminjaman']);
    }

    public function pengambilan()
    {
        $pengambilan = User::join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
            ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
            ->join('items', 'pengambilan_detail.items_id', '=', 'items.id')
            ->join('category', 'items.category_id', '=', 'category.id')
            ->select('users.name', 'pengambilan.id', 'pengambilan_detail.confirmed_at', 'pengambilan_detail.returned_at', 'pengambilan_detail.created_at', 'pengambilan_detail.deleted_at', 'pengambilan_detail.quantity', 'items.item', 'items.image', 'items.type', 'category.category')
            ->whereNotNull('pengambilan_detail.confirmed_at');

        if (Auth::user()->role == 'user') {
            $pengambilan = $pengambilan->where('users.id', '=', Auth::id());
        }

        $pengambilan = $pengambilan->orderBy('pengambilan.id', 'desc')->get();

        return view('riwayat_pengambilan', ['pengambilan' => $pengambilan, 'judul' => 'Pengambilan']);
    }

    public function pengembalian()
    {
        $return = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
            ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
            ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
            ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
            ->join('category', 'item_pinjam.category_id', '=', 'category.id')
            ->select('users.name', 'peminjaman_detail.id', 'peminjaman_detail.items_id', 'peminjaman_detail.keterangan', 'peminjaman_detail.date_start', 'peminjaman_detail.date_end', 'peminjaman_detail.confirmed_at', 'peminjaman_detail.returned_at', 'peminjaman_detail.created_at', 'peminjaman_detail.peminjamanable_type', 'peminjaman_detail.deleted_at', DB::raw('item_pinjam_detail.name as barang'), 'item_pinjam_detail.image',  'category.category')
            ->where('peminjamanable_type', 'App\Peminjaman')
            ->orderBy('peminjaman.created_at', 'asc');

        if (Auth::user()->role == 'user') {
            $return->where('peminjaman.user_id', Auth::user()->id)
                ->whereNotNull('peminjaman_detail.returned_at')
                ->whereNotNull('peminjaman_detail.confirmed_at');
        }

        if (Auth::user()->role == 'admin') {
            $return->whereNull('peminjaman_detail.returned_at')
                ->whereNotNull('peminjaman_detail.confirmed_at');
        }
        $return = $return->get();

        $return_ganti = [];

        // DB::enableQueryLog();
        foreach ($return as $key => $value) {
            $return_changed = PeminjamanDetail::find($value->id);
            $return_changed = $return_changed->peminjaman;

            if (!empty($return_changed)) {
                $item = ItemPinjamDetail::join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
                    ->join('category', 'item_pinjam.category_id', '=', 'category.id')
                    ->where('item_pinjam_detail.id', $return_changed->items_id)->first();

                $return_changed->name = $item->name;
                $return_changed->image = $item->image;
                $return_changed->category = $item->category;
                // dd($return_changed);

                $value->ganti = $return_changed;
                array_push($return_ganti, $value);
                // dd($return_ganti);
                unset($return[$key]);
            }
        }

        return view('riwayat_pengembalian', ['return' => $return, 'return_ganti' => $return_ganti, 'judul' => 'Pengembalian']);
    }
}
