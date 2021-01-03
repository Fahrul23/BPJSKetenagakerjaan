<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\LaporanPeminjamanExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;
use DB;

use App\User;
use App\Category;
use App\ItemPinjamDetail;
use App\Peminjaman;
use App\PeminjamanDetail;


class LaporanPeminjamanController extends Controller
{
    public function index(Request $req)
    {
        $users = User::Where('role', 'user')->get();

        // $peminjaman = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
        //     ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
        //     ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
        //     ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
        //     ->join('category', 'item_pinjam.category_id', '=', 'category.id')
        //     ->select('users.name', 'peminjaman.id', 'peminjaman.created_at')
        //     ->groupBy('peminjaman_detail.peminjamanable_id')
        //     ->orderBy('peminjaman.created_at', 'desc');

        // if (!is_null($req->user)) {
        //     $peminjaman->where('users.id', $req->user);
        // }
        // if (!is_null($req->item)) {
        //     $peminjaman->where('item_pinjam', 'LIKE', '%' . $req->item . '%');
        // }
        // if (!is_null($req->category)) {
        //     $peminjaman->where('item_pinjam.category_id', $req->category);
        // }
        // if (!is_null($req->date)) {
        //     $tanggal = explode(" - ", $req->date);
        //     $peminjaman->whereBetween('peminjaman.created_at', $tanggal);
        // }

        $peminjamans = new Peminjaman;

        if (!is_null($req->user)) {
            $peminjamans = $peminjamans->where('user_id', $req->user);
        }

        if (!is_null($req->start)) {
            $peminjamans = $peminjamans->whereDate('created_at', '>=', $req->start);
        }

        if (!is_null($req->end)) {
            $peminjamans = $peminjamans->whereDate('created_at', '<=', $req->end);
        }

        $peminjamans = $peminjamans->paginate(10);

        return view('laporan_peminjaman', compact('users', 'peminjamans'));
    }

    public function detail($id)
    {
        // dd($id);
        $pinjams = Peminjaman::find($id);

        // $pinjams = $pinjams->peminjamans()->withTrashed()->get();

        // foreach ($pinjams as $key => $value) {
        //     $item_pinjam = $value->item;

        //     $value->item_name = $item_pinjam->name;
        //     $value->item_unique_id = $item_pinjam->unique_id;
        //     $value->item_image = $item_pinjam->image;

        //     $ganti = PeminjamanDetail::withTrashed()->find($value->id);

        //     $current = $ganti->peminjaman;


        //     $value->status = $this->setStatusPinjam($value->confirmed_at, $value->deleted_at, $current);

        //     if (!empty($current)) {

        //         $item_ganti = $current->item;

        //         $current->item_name = $item_ganti->name;
        //         $current->item_unique_id = $item_ganti->unique_id;
        //         $current->item_image = $item_ganti->image;

        //         $current->status = $this->setStatusPinjam($current->confirmed_at, $current->deleted_at);

        //         $value->ganti = $current;
        //     }
        // }

        // dd($pinjams);

        return view('laporan_peminjaman_detail', compact('pinjams'));
    }

    private function setStatusPinjam($confirm, $delete, $change = null)
    {
        switch (true) {
            case !empty($confirm):
                $status = ['disetujui', 'success'];
                break;
            case !empty($delete):
                $status = ['ditolak', 'danger'];
                break;
            case !empty($change):
                $status = ['diganti', 'primary'];
                break;

            default:
                $status = null;
                break;
        }

        return $status;
    }

    public function export_excel(Request $req)
    {
        $tanggal = date("d_m_Y");

        // passing request ke object export
        return Excel::download(new LaporanPeminjamanExport($req), 'LAP_PMJ_' . $tanggal . '.xlsx');
    }

    public function export_pdf(Request $req)
    {
        // $peminjaman = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
        //     ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
        //     ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
        //     ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
        //     ->join('category', 'item_pinjam.category_id', '=', 'category.id')
        //     ->select('users.name', 'item_pinjam_detail.unique_id', 'peminjaman_detail.id', 'item_pinjam_detail.name AS item', 'category.category',  'peminjaman_detail.keterangan', 'peminjaman.created_at', 'peminjaman_detail.date_start', 'peminjaman_detail.date_end')
        //     ->whereNull('peminjaman_detail.deleted_at')
        //     ->orderBy('peminjaman.created_at', 'desc');

        // if (!is_null($req->user_name)) {
        //     $peminjaman->where('users.id', $req->user_name);
        // }
        // if (!is_null($req->item_name)) {
        //     $peminjaman->where('item_pinjam.name', 'LIKE', '%' . $req->item_name . '%');
        // }
        // if (!is_null($req->category_id)) {
        //     $peminjaman->where('item_pinjam.category_id', $req->category_id);
        // }
        // if (!is_null($req->start)) {
        //     // dd($req->start);
        //     $peminjaman->whereDate('peminjaman.created_at', '>=', $req->start);
        // }

        // if (!is_null($req->end)) {
        //     $peminjaman->whereDate('peminjaman.created_at', '<=', $req->end);
        // }

        // $peminjaman = $peminjaman->get();
        // $peminjaman_ganti = [];

        // // DB::enableQueryLog();
        // foreach ($peminjaman as $key => $value) {
        //     $peminjaman_changed = PeminjamanDetail::find($value->id);
        //     // dd($peminjaman_changed);
        //     $peminjaman_changed = $peminjaman_changed->peminjaman;

        //     if (!empty($peminjaman_changed)) {
        //         $item = ItemPinjamDetail::join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
        //             ->join('category', 'item_pinjam.category_id', '=', 'category.id')
        //             ->where('item_pinjam_detail.id', $peminjaman_changed->items_id)->first();

        //         $peminjaman_changed->name = $item->name;
        //         $peminjaman_changed->unique_id = $item->unique_id;

        //         $peminjaman_changed->image = $item->image;
        //         $peminjaman_changed->category = $item->category;

        //         $value->ganti = $peminjaman_changed;
        //         array_push($peminjaman_ganti, $value);
        //         // dd($peminjaman_ganti);
        //         unset($peminjaman[$key]);
        //     }
        // }

        $peminjaman = new Peminjaman;
        if (!is_null($req->user)) {
            $peminjaman = $peminjaman->where('users.id', $req->user);
        }
        if (!is_null($req->start)) {
            // dd($req->start);
            $peminjaman = $peminjaman->whereDate('created_at', '>=', $req->start);
        }

        if (!is_null($req->end)) {
            $peminjaman = $peminjaman->whereDate('created_at', '<=', $req->end);
        }

        $peminjaman = $peminjaman->get();


        // dd($peminjaman);
        $tanggal = date("d_m_Y");

        $pdf = PDF::loadview('template.exports.laporan_peminjaman', compact('peminjaman'))->setPaper('a4');
        return $pdf->stream('LAP_PMJ_' . $tanggal . '.pdf');
    }
}
