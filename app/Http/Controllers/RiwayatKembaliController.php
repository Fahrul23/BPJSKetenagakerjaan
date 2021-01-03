<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;

use App\Peminjaman;
use App\PeminjamanDetail;
use App\ItemPinjamDetail;
use App\User;


use Illuminate\Support\Facades\Validator;

class RiwayatKembaliController extends Controller
{

    public function index()
    {
        $peminjaman = new Peminjaman;

        if (Auth::user()->role == 'user') $peminjaman = $peminjaman->where('user_id', Auth::id());

        $peminjaman = $peminjaman->get();

        // dd($peminjaman);

        return view('riwayat_kembali', compact('peminjaman'));
    }

    public function show($id)
    {
        $kondisi_barang = PeminjamanDetail::join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
            ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
            ->join('category', 'item_pinjam.category_id', '=', 'category.id')
            ->select('items_id', 'item_pinjam_detail.name', 'item_pinjam_detail.image', 'item_pinjam_detail.unique_id', 'category.category')
            ->where('.items_id', $id)
            ->first();
        // dd($id);

        return view('konfirmasi_pengembalian', ['kondisi_barang' => $kondisi_barang]);
    }

    public function return(Request $r)
    {
        $validation = [
            'rule' => [
                'kondisi_barang' => 'required',
                'items_id' => 'required'
            ],
            'message' => [
                'kondisi_barang.required' => 'Kondisi barang harus diisi.',
                'items_id' => 'Id barang harus ada'
            ]
        ];

        $data = (object) Validator::make($r->all(), $validation['rule'], $validation['message'])->validate();

        $kembali = PeminjamanDetail::where('items_id',  $data->items_id)
            ->whereNull('returned_at')
            ->first();

        $item = ItemPinjamDetail::findorfail($kembali->items_id);

        try {
            $item->status = '1';
            $item->condition = $data->kondisi_barang;
            $item->save();

            $kembali->returned_at = now();
            if ($kembali->save()) {
                $alert = ['success', 'Berhasil mengembalikan barang.'];
            } else {
                $alert = ['danger', 'Gagal mengembalikan barang.'];
            }
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal mengembalikan barang.'];
        }

        return redirect()->route('riwayat.kembali.index')->with('alert', $alert);
    }
}
