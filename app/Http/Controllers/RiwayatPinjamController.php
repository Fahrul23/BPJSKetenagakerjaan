<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Auth;
use DB;

use App\User;
use App\Peminjaman;
use App\PeminjamanDetail;
use App\ItemPinjamDetail;


class RiwayatPinjamController extends Controller
{

    public function index(Request $request)
    {

        $users = User::where('role', 'user')->get();

        $role = Auth::user()->role;

        // DB::enableQueryLog();

        $pinjams = new Peminjaman;

        $pinjams = $pinjams->join('users', 'users.id', '=', 'peminjaman.user_id');
        $pinjams = $pinjams->select('peminjaman.id', 'peminjaman.user_id', 'peminjaman.created_at', 'peminjaman.updated_at');

        if ($role == 'user') {
            $pinjams = $pinjams->where('user_id', Auth::id());
        }

        if ($request->user && $role == 'admin') {
            $pinjams = $pinjams->where('user_id', $request->user);
        }

        if ($request->start) {
            $pinjams = $pinjams->whereDate('peminjaman.created_at', '>=', $request->start);
        }

        if ($request->end) {
            $pinjams = $pinjams->whereDate('peminjaman.created_at', '<=', $request->end);
        }

        $pinjams = $pinjams->orderBy('peminjaman.created_at', 'desc');

        $pinjams = $pinjams->paginate(10);

        // dd(DB::getQueryLog());

        return view('riwayat_pinjam', compact('pinjams', 'users'));
    }

    public function show($id)
    {
        $pinjams = Peminjaman::find($id);

        $pinjams = $pinjams->peminjamans()->withTrashed()->get();

        foreach ($pinjams as $key => $value) {
            $item_pinjam = $value->item;

            $value->item_name = $item_pinjam->name;
            $value->item_unique_id = $item_pinjam->unique_id;
            $value->item_image = $item_pinjam->image;

            $ganti = PeminjamanDetail::withTrashed()->find($value->id);

            $current = $ganti->peminjaman;

            $value->status = $this->setStatusPinjam($value->confirmed_at, $value->deleted_at, $current);

            if (!empty($current)) {
                $item_ganti = $current->item;

                $current->item_name = $item_ganti->name;
                $current->item_unique_id = $item_ganti->unique_id;
                $current->item_image = $item_ganti->image;

                $current->status = $this->setStatusPinjam($current->confirmed_at, $current->deleted_at);

                $value->ganti = $current;
            }
        }

        // dd($pinjams);

        return view('riwayat_pinjam_detail', compact('pinjams'));
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

    public function cetak($id)
    {
        $pinjams = Peminjaman::find($id);

        $user = $pinjams->user;

        $pinjam = $pinjams->peminjamans;

        foreach ($pinjam as $key => $value) {
            $user->date_start = $value->date_start;
            $user->date_end = $value->date_end;
            $user->keterangan = $value->keterangan;
            $user->pinjam_id = $pinjams->id;

            $item_pinjam = $value->item;

            $value->item_name = $item_pinjam->name;
            $value->item_unique_id = $item_pinjam->unique_id;
            $value->item_image = $item_pinjam->image;

            $ganti = PeminjamanDetail::find($value->id);

            $current = $ganti->peminjaman;


            if (!empty($current)) {
                $item_ganti = $current->item;

                $current->item_name = $item_ganti->name;
                $current->item_unique_id = $item_ganti->unique_id;
                $current->item_image = $item_ganti->image;

                $pinjam[$key] = $current;
            }
        }
        // dd($pinjam);

        $pdf = PDF::loadView('template.archive.cetak_bukti_pinjam', compact('pinjam', 'user'));
        return $pdf->stream();
    }
}
