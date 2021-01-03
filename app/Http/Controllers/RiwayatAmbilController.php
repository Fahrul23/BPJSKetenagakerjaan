<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
use Auth;
use DB;

use App\User;
use App\Pengambilan;
use App\PengambilanDetail;
use App\ItemAmbilDetail;

class RiwayatAmbilController extends Controller
{

    public function index(Request $request)
    {

        $users = User::where('role', 'user')->get();

        $role = Auth::user()->role;

        // DB::enableQueryLog();

        $ambils = new Pengambilan;

        $ambils = $ambils->join('users', 'users.id', '=', 'pengambilan.user_id')
            ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id');
        $ambils = $ambils->select('pengambilan.id', 'pengambilan.user_id', 'pengambilan.created_at', 'pengambilan.updated_at');

        if ($role == 'user') {
            $ambils = $ambils->where('user_id', Auth::id());
        }

        if ($request->user && $role == 'admin') {
            $ambils = $ambils->where('user_id', $request->user);
        }

        if ($request->start) {
            $ambils = $ambils->whereDate('pengambilan.created_at', '>=', $request->start);
        }

        if ($request->end) {
            $ambils = $ambils->whereDate('pengambilan.created_at', '<=', $request->end);
        }

        $ambils = $ambils->orderBy('pengambilan.created_at', 'desc');

        $ambils = $ambils->paginate(10);

        // dd(DB::getQueryLog());

        return view('riwayat_ambil', compact('ambils', 'users'));
    }


    public function show($id)
    {
        $ambils = Pengambilan::find($id);

        // $ambils = $ambils->pengambilans()->withTrashed()->get();

        // foreach ($ambils as $key => $value) {
        //     $item_ambil = $value->item;

        //     $value->item_name = $item_ambil->name;
        //     $value->item_unique_id = $item_ambil->unique_id;
        //     $value->item_image = $item_ambil->image;
        //     $value->unit = $item_ambil->unit;



        //     if (!empty($current)) {
        //         $item_ganti = $current->item;

        //         $current->item_name = $item_ganti->name;
        //         $current->item_unique_id = $item_ganti->unique_id;
        //         $current->item_image = $item_ganti->image;


        //         $value->ganti = $current;
        //     }
        // }

        // dd($ambils);

        return view('riwayat_ambil_detail', compact('ambils'));
    }

    public function cetak($id)
    {
        $ambils = Pengambilan::find($id);

        $user = $ambils->user;

        $ambil = $ambils->pengambilans;

        foreach ($ambil as $key => $value) {
            $user->date_start = $value->created_at;
            $user->ambil_id = $ambils->id;

            $item_pinjam = $value->item;

            $value->item_name = $item_pinjam->name;
            $value->item_unique_id = $item_pinjam->unique_id;
            $value->item_image = $item_pinjam->image;
            $value->item_qty = $value->quantity;
            $value->item_unit = $item_pinjam->unit;
        }

        $pdf = PDF::loadView('template.archive.cetak_bukti_ambil', compact('ambil', 'user'));
        return $pdf->stream();
    }
}
