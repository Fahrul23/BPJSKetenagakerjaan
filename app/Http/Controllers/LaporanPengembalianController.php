<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LaporanPengembalianExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;

use App\User;
use App\Category;
use App\PeminjamanDetail;
use App\Peminjaman;

class LaporanPengembalianController extends Controller
{
    //
    public function index(Request $req)
    {
        $users = User::Where('role', 'user')->get();

        // $pengembalian = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
        //     ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
        //     ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
        //     ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
        //     ->join('category', 'item_pinjam.category_id', '=', 'category.id')
        //     ->select('users.name', 'peminjaman.id', 'peminjaman.created_at')
        //     ->groupBy('peminjaman_detail.peminjamanable_id')
        //     ->whereNotNull('peminjaman_detail.returned_at')
        //     ->whereNull('peminjaman_detail.deleted_at')
        //     ->orderBy('peminjaman.created_at', 'desc');
        // if (!is_null($req->user)) {
        //     $pengembalian->where('users.id', $req->user);
        // }
        // if (!is_null($req->item)) {
        //     $pengembalian->where('item_pinjam.name', 'LIKE', '%' . $req->item . '%');
        // }
        // if (!is_null($req->category)) {
        //     $pengembalian->where('item_pinjam.category_id', $req->category);
        // }
        // if (!is_null($req->date)) {
        //     $tanggal = explode(" - ", $req->date);
        //     $pengembalian->whereBetween('peminjaman.created_at', $tanggal);
        // }

        // $pengembalian = $pengembalian->get();

        // DB::enableQueryLog();

        $pengembalians = new Peminjaman;

        // dd($req->all());

        if (!is_null($req->user)) {
            $pengembalians = $pengembalians->where('peminjaman.user_id', $req->user);
            // dd($pengembalians->user_id);
        }

        if (!is_null($req->start)) {
            $pengembalians = $pengembalians->whereDate('peminjaman.created_at', '>=', $req->start);
        }

        if (!is_null($req->end)) {
            $pengembalians = $pengembalians->whereDate('peminjaman.created_at', '<=', $req->end);
        }

        $pengembalians = $pengembalians->where(function ($query) {
            $query->whereExists(function ($query) {
                $query->from('peminjaman_detail')
                    ->whereRaw('peminjaman_detail.peminjamanable_id = peminjaman.id')
                    ->where('peminjaman_detail.peminjamanable_type', 'App\\Peminjaman');
                // ->whereNotNull('peminjaman_detail.returned_at');
                // ->whereNull('peminjaman_detail.returned_at')
                // ->whereNotNull('peminjaman_detail.confirmed_at');
            })->orWhereExists(function ($query) {
                $query->from(DB::raw('peminjaman_detail as a'))
                    ->whereExists(function ($query) {
                        $query->from(DB::raw('peminjaman_detail as b'))
                            ->whereRaw('a.id = b.peminjamanable_id')
                            ->where('b.peminjamanable_type', 'App\\PeminjamanDetail');
                        //   ->whereNotNull('b.returned_at');
                        //   ->whereNull('b.returned_at')
                        //   ->whereNotNull('b.confirmed_at');
                    });
            });
        });

        // $pengembalians = $pengembalians->whereExists(function ($query) {
        //     $query->from('peminjaman_detail')
        //         ->whereRaw('peminjaman_detail.peminjamanable_id = peminjaman.id')
        //         ->where('peminjaman_detail.peminjamanable_type', 'App\\Peminjaman');
        //     // ->whereNotNull('peminjaman_detail.returned_at');
        //     // ->whereNull('peminjaman_detail.returned_at')
        //     // ->whereNotNull('peminjaman_detail.confirmed_at');
        // });

        // $pengembalians = $pengembalians->orWhereExists(function ($query) {
        //     $query->from(DB::raw('peminjaman_detail as a'))
        //         ->whereExists(function ($query) {
        //             $query->from(DB::raw('peminjaman_detail as b'))
        //                 ->whereRaw('a.id = b.peminjamanable_id')
        //                 ->where('b.peminjamanable_type', 'App\\PeminjamanDetail');
        //             //   ->whereNotNull('b.returned_at');
        //             //   ->whereNull('b.returned_at')
        //             //   ->whereNotNull('b.confirmed_at');
        //         });
        // });

        $pengembalians = $pengembalians->paginate(10);

        // dd(DB::getQueryLog());
        // dd($pengembalians);

        return view('laporan_pengembalian', compact('users', 'pengembalians'));
    }

    public function detail($id)
    {
        $user = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
            ->where('peminjaman.id', $id)
            ->select('users.name')
            ->first();

        $pengembalian_detail = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
            ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
            ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
            ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
            ->join('category', 'item_pinjam.category_id', '=', 'category.id')
            ->select('item_pinjam.name', 'peminjaman_detail.items_id', 'item_pinjam.image', 'category.category', 'peminjaman_detail.returned_at', 'peminjaman_detail.id', 'peminjaman_detail.date_start', 'peminjaman_detail.date_end')
            ->whereNotNull('peminjaman_detail.returned_at')
            ->whereNull('peminjaman_detail.deleted_at')
            ->where('peminjaman_detail.peminjamanable_id', $id)
            ->get();

        // $pengembalian_ganti = [];

        // // DB::enableQueryLog();
        // foreach ($pengembalian_detail as $key => $value) {
        //     $peminjaman_changed = PeminjamanDetail::find($value->id);
        //     $peminjaman_changed = $peminjaman_changed->peminjaman;

        //     if (!empty($peminjaman_changed)) {
        //         $item = ItemPinjamDetail::join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
        //             ->join('category', 'item_pinjam.category_id', '=', 'category.id')
        //             ->where('item_pinjam_detail.id', $peminjaman_changed->items_id)->first();

        //         if (empty($peminjaman_changed->confirmed_at)) {
        //             $peminjaman_changed->name = $item->name;
        //             $peminjaman_changed->image = $item->image;
        //             $peminjaman_changed->category = $item->category;

        //             $value->ganti = $peminjaman_changed;
        //             array_push($pengembalian_ganti, $value);
        //             // dd($peminjaman_ganti);
        //             unset($pengembalian_detail[$key]);
        //         } else {
        //             unset($pengembalian_detail[$key]);
        //         }
        //     }
        // }

        return view('laporan_pengembalian_detail', ['pengembalian_detail' => $pengembalian_detail, 'user' => $user]);
    }

    public function export_excel(Request $req)
    {
        $tanggal = date("d_m_Y");

        // passing request ke object export
        return Excel::download(new LaporanPengembalianExport($req), 'LAP_PGN_' . $tanggal . '.xlsx');
    }

    public function export_pdf(Request $req)
    {
        // $pengembalian = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
        //     ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
        //     ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
        //     ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
        //     ->join('category', 'item_pinjam.category_id', '=', 'category.id')
        //     ->select('users.name', 'item_pinjam.name', 'category.category', 'peminjaman.created_at', 'peminjaman_detail.date_start', 'peminjaman_detail.date_end', 'peminjaman_detail.returned_at')
        //     ->whereNotNull('peminjaman_detail.returned_at')
        //     ->whereNull('peminjaman_detail.deleted_at')
        //     ->orderBy('peminjaman.created_at', 'desc');
        // if (!is_null($req->user_name)) {
        //     $pengembalian->where('users.id', $req->user_name);
        // }
        // if (!is_null($req->item_name)) {
        //     $pengembalian->where('item_pinjam.name', 'LIKE', '%' . $req->item_name . '%');
        // }
        // if (!is_null($req->category_id)) {
        //     $pengembalian->where('item_pinjam.category_id', $req->category_id);
        // }
        // if (!is_null($req->time)) {
        //     $tanggal = explode(" - ", $req->time);
        //     $pengembalian->whereBetween('peminjaman.created_at', $tanggal);
        // }

        // $pengembalian = $pengembalian->get();
        $pengembalian = new Peminjaman;
        if (!is_null($req->user)) {
            $pengembalian = $pengembalian->where('users.id', $req->user);
        }
        if (!is_null($req->start)) {
            // dd($req->start);
            $pengembalian = $pengembalian->whereDate('created_at', '>=', $req->start);
        }

        if (!is_null($req->end)) {
            $pengembalian = $pengembalian->whereDate('created_at', '<=', $req->end);
        }

        $pengembalian = $pengembalian->get();

        $tanggal = date("d_m_Y");

        $pdf = PDF::loadview('template.exports.laporan_pengembalian', compact('pengembalian'))->setPaper('a4');
        return $pdf->stream('LAP_PGN_' . $tanggal . '.pdf');
    }
}
