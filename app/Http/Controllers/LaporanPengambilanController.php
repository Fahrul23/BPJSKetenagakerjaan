<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Exports\LaporanPengambilanExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

use App\User;
use App\Category;
use App\Pengambilan;
use App\PengambilanDetail;

class LaporanPengambilanController extends Controller
{
    public function index(Request $req)
    {
        $users = User::Where('role', 'user')->get();

        // $pengambilan = User::join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
        //     ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
        //     ->join('item_ambil', 'pengambilan_detail.items_id', '=', 'item_ambil.id')
        //     ->join('category', 'item_ambil.category_id', '=', 'category.id')
        //     ->select('users.name', 'pengambilan.id', 'pengambilan.created_at')
        //     ->groupBy('pengambilan_detail.pengambilan_id')
        //     ->whereNotNull('pengambilan_detail.confirmed_at')
        //     ->whereNull('pengambilan_detail.deleted_at')
        //     ->orderBy('pengambilan.created_at', 'desc');
        // if (!is_null($req->user)) {
        //     $pengambilan->where('users.id', $req->user);
        // }
        // if (!is_null($req->item)) {
        //     $pengambilan->where('item_ambil.name', 'LIKE', '%' . $req->item . '%');
        // }
        // if (!is_null($req->category)) {
        //     $pengambilan->where('item_ambil.category_id', $req->category);
        // }
        // if (!is_null($req->start)) {
        //     // dd($req->start);
        //     $pengambilan->whereDate('pengambilan.created_at', '>=', $req->start);
        // }

        // if (!is_null($req->end)) {
        //     $pengambilan->whereDate('pengambilan.created_at', '<=', $req->end);
        // }

        // $pengambilan = $pengambilan->get();

        $pengambilans = new Pengambilan;

        if (!is_null($req->user)) {
            $pengambilans = $pengambilans->where('user_id', $req->user);
        }

        if (!is_null($req->start)) {
            $pengambilans = $pengambilans->whereDate('created_at', '>=', $req->start);
        }

        if (!is_null($req->end)) {
            $pengambilans = $pengambilans->whereDate('created_at', '<=', $req->end);
        }

        $pengambilans = $pengambilans->paginate(10);

        return view('laporan_pengambilan', compact('users', 'pengambilans'));
    }

    public function detail($id)
    {
        // $user = User::join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
        //     ->where('pengambilan.id', $id)
        //     ->select('users.name')
        //     ->first();

        // $pengambilan_detail = User::join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
        //     ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
        //     ->join('item_ambil', 'pengambilan_detail.items_id', '=', 'item_ambil.id')
        //     ->join('category', 'item_ambil.category_id', '=', 'category.id')
        //     ->select('item_ambil.name', 'pengambilan_detail.items_id', 'item_ambil.image', 'category.category', 'pengambilan_detail.id', 'pengambilan_detail.quantity', 'item_ambil.category_id', 'item_ambil.unit')
        //     ->whereNotNull('pengambilan_detail.confirmed_at')
        //     ->whereNull('pengambilan_detail.deleted_at')
        //     ->where('pengambilan_detail.pengambilan_id', $id)
        //     ->get();

        $pengambilans = Pengambilan::find($id);

        return view('laporan_pengambilan_detail', compact('pengambilans'));
    }

    public function export_excel(Request $req)
    {
        $tanggal = date("d_m_Y");

        // passing request ke object export
        return Excel::download(new LaporanPengambilanExport($req), 'LAP_AMB_' . $tanggal . '.xlsx');
    }

    public function export_pdf(Request $req)
    {
        $pengambilan = User::join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
            ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
            ->join('item_ambil', 'pengambilan_detail.items_id', '=', 'item_ambil.id')
            ->join('category', 'item_ambil.category_id', '=', 'category.id')
            ->select('users.name', 'item_ambil.name as barang', 'category.category', 'pengambilan_detail.quantity', 'pengambilan.created_at', 'item_ambil.unit')
            ->whereNotNull('pengambilan_detail.confirmed_at')
            ->whereNull('pengambilan_detail.deleted_at')
            ->orderBy('pengambilan.created_at', 'desc');
        if (!is_null($req->user_name)) {
            $pengambilan->where('users.id', $req->user_name);
        }
        if (!is_null($req->item_name)) {
            $pengambilan->where('item_ambil.name', 'LIKE', '%' . $req->item_name . '%');
        }
        if (!is_null($req->category_id)) {
            $pengambilan->where('item_ambil.category_id', $req->category_id);
        }
        if (!is_null($req->start)) {
            // dd($req->start);
            $pengambilan->whereDate('pengambilan.created_at', '>=', $req->start);
        }

        if (!is_null($req->end)) {
            $pengambilan->whereDate('pengambilan.created_at', '<=', $req->end);
        }
        $pengambilan = $pengambilan->get();
        $tanggal = date("d_m_Y");

        $pdf = PDF::loadview('template.exports.laporan_pengambilan', ['pengambilan' => $pengambilan]);
        return $pdf->stream('LAP_AMB_' . $tanggal . '.pdf');
    }
}
