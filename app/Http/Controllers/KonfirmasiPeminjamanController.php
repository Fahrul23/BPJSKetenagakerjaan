<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Database\Eloquent\Builder;
use DB;
use Exception;

use App\User;
use App\Peminjaman;
use App\PeminjamanDetail;
use App\ItemPinjam;
use App\ItemPinjamDetail;
use App\Category;

class KonfirmasiPeminjamanController extends Controller
{
    //
    public function index()
    {
        $peminjamans = Peminjaman::select('peminjaman.id', 'peminjaman.user_id', 'peminjaman_detail.id as detail_id')
            ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
            ->where('peminjamanable_type', 'App\\Peminjaman')
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

        // dd($peminjamans);

        return view('konfirmasi_peminjaman', compact('peminjamans'));
    }

    public function detail($id)
    {
        $user = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
            ->where('peminjaman.id', $id)
            ->select('users.name')
            ->first();

        $peminjaman_detail = User::join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
            ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
            ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
            ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
            ->join('category', 'item_pinjam.category_id', '=', 'category.id')
            ->select('item_pinjam_detail.name', 'peminjaman_detail.items_id', 'item_pinjam_detail.image', 'category.category', 'peminjaman_detail.date_start', 'peminjaman_detail.date_end', 'peminjaman_detail.id', 'peminjaman_detail.keterangan')
            ->where('peminjaman_detail.peminjamanable_type', 'App\Peminjaman')
            ->whereNull('peminjaman_detail.confirmed_at')
            ->whereNull('peminjaman_detail.deleted_at')
            ->where('peminjaman.id', $id)
            ->get();

        $peminjaman_ganti = [];

        // DB::enableQueryLog();
        foreach ($peminjaman_detail as $key => $value) {
            $peminjaman_changed = PeminjamanDetail::find($value->id);
            $peminjaman_changed = $peminjaman_changed->peminjaman;

            if (!empty($peminjaman_changed)) {
                $item = ItemPinjamDetail::join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
                    ->join('category', 'item_pinjam.category_id', '=', 'category.id')
                    ->where('item_pinjam_detail.id', $peminjaman_changed->items_id)->first();

                if (empty($peminjaman_changed->confirmed_at)) {
                    $peminjaman_changed->name = $item->name;
                    $peminjaman_changed->image = $item->image;
                    $peminjaman_changed->category = $item->category;

                    $value->ganti = $peminjaman_changed;
                    array_push($peminjaman_ganti, $value);
                    // dd($peminjaman_ganti);
                    unset($peminjaman_detail[$key]);
                } else {
                    unset($peminjaman_detail[$key]);
                }
            }
        }

        // dd(DB::getQueryLog());
        // dd($peminjaman_detail);
        // dd($peminjaman_ganti);
        return view('konfirmasi_peminjaman_detail', ['peminjaman_detail' => $peminjaman_detail, 'peminjaman_ganti' => $peminjaman_ganti, 'user' => $user]);
    }

    public function change(Request $request, $id)
    {
        $peminjaman = PeminjamanDetail::findOrFail($id);
        $item_detail = ItemPinjamDetail::findOrFail($peminjaman->items_id);
        $item = ItemPinjam::findorfail($item_detail->item_pinjam_id);

        if ($peminjaman->peminjamanable_type == "App\PeminjamanDetail")
            return back()->with('alert', ['danger', 'Item sudah diganti dengan item lain.']);

        $item_ganti = ItemPinjam::orderBy('category_id', 'asc')
            ->where('item_pinjam.category_id', '=', $item->category_id)
            ->whereNotIn('id', [$peminjaman->item->item->id]);

        if (!is_null($request->search)) {
            $item->where('item_pinjam.name', 'LIKE', '%' . $request->search . '%');
        }

        $items = $item_ganti->orderBy('name', 'asc')->paginate(10);

        return view('konfirmasi_peminjaman_ganti', ['item' => $items, 'peminjaman_id' => $peminjaman->peminjamanable_id, 'peminjaman_detail_id' => $peminjaman->id]);
    }

    public function item(Request $request, $id)
    {
        $item_detail = ItemPinjamDetail::where('item_pinjam_id', $id)->first();
        $item_pinjam = ItemPinjam::where('id', $item_detail->item_pinjam_id)->first();

        $item = ItemPinjamDetail::where('item_pinjam_id', $id)
            ->where('condition', 'bagus');
        if (!is_null($request->name)) {
            $item->where('item_pinjam_detail.name', 'LIKE', '%' . $request->name . '%');
        }
        $item_paginate = $item->paginate(10);

        return view('konfirmasi_peminjaman_ganti_item', ['item' => $item_paginate, 'id' => $id, 'peminjaman_id' => $request->peminjaman_id, 'peminjaman_detail_id' => $request->peminjaman_detail_id, 'item_pinjam' => $item_pinjam]);
    }

    public function changeApprove(Request $request)
    {
        // dd($request->all());
        DB::beginTransaction();
        try {

            $data = PeminjamanDetail::where('items_id', '!=', $request->item_id)
                                    ->find($request->peminjaman_detail_id);

            if ( empty($data) ) throw new Exception();

            $peminjaman = new PeminjamanDetail([
                'items_id' => $request->item_id,
                'keterangan' => $request->keterangan_ganti,
                'date_start' => $data->date_start,
                'date_end' => $data->date_end,
            ]);

            $data->peminjaman()->save($peminjaman);

            DB::commit();
            $alert = ['success', 'Berhasil mengganti pemesanan barang.'];
        } catch (Exception $e) {
            DB::rollback();
            $alert = ['danger', 'Gagal mengganti pemesanan barang.'];
        }
        return redirect()->route('konfirmasi_peminjaman_detail', ['id' => $request->peminjaman_id])->with('alert', $alert);
    }

    public function show(Request $request, $id)
    {
        $item_detail = ItemPinjamDetail::where('status', '!=', '0')
            ->whereNotIn('condition', ['rusak', 'hilang'])
            ->findorfail($id);
        $item = ItemPinjam::findorfail($item_detail->item_pinjam_id);
        // dd($item_detail);
        return view('konfirmasi_peminjaman_ganti_detail', ['item' => $item, 'item_detail' => $item_detail, 'peminjaman_id' => $request->peminjaman_id, 'peminjaman_detail_id' => $request->peminjaman_detail_id]);
    }

    /**
     * Confirming order items.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $r)
    {
        $act   =  PeminjamanDetail::findorfail($r->id);
        $item  =  ItemPinjamDetail::findorfail($act->items_id);
        // dd($item);
        try {
            if ($item->status == '0') {
                throw new Exception("Barang sedang dalam peminjaman.");
            }
            $act->confirmed_at = now();
            if ($act->save()) {
                $item->status = '0';
                $item->save();
            }
            $alert = ['success', 'Berhasil mengonfirmasi pemesanan barang.'];
        } catch (Exception $e) {
            $alert = ['danger', $e->getMessage()];
        }
        return back()->with('alert', $alert);
    }

    public function confirmGanti(Request $r)
    {
        $act   =  PeminjamanDetail::findorfail($r->id);
        $item  =  ItemPinjamDetail::findorfail($act->items_id);

        DB::beginTransaction();
        try {
            if (!$item->status) {
                throw new Exception("Barang sedang dalam peminjaman.");
            }

            $act_parent = $act->peminjamanable->item;
            $act_parent->status = '1';
            $act_parent->save();

            $act->confirmed_at = now();
            if ($act->save()) {
                $item->status = '0';
                $item->save();
            }
            DB::commit();
            $alert = ['success', 'Berhasil mengonfirmasi pemesanan barang.'];
        } catch (Exception $e) {
            DB::rollback();
            $alert = ['danger', $e->getMessage()];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Removing order items.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $r)
    {
        $act = PeminjamanDetail::findorfail($r->id);
        try {
            $act->returned_at = now();
            $act->delete();
            $alert = ['success', 'Berhasil menghapus pemesanan barang.'];
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menghapus pemesanan barang.'];
        }
        return back()->with('alert', $alert);
    }

    public function deleteChangedItem(Request $request)
    {
        $act = PeminjamanDetail::findorfail($request->id);
        try {
            $act->returned_at = now();
            $act->forceDelete();
            $alert = ['success', 'Berhasil membatalkan penggantian barang.'];
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal membatalkan penggantian barang.'];
        }
        return back()->with('alert', $alert);
    }
}
