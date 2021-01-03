<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use DB;

use App\User;
use App\Pengambilan;
use App\PengambilanDetail;
use App\ItemAmbil;

class KonfirmasiPengambilanController extends Controller
{
    public function index()
    {
        // $data = User::join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
        //     ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
        //     ->join('items', 'pengambilan_detail.items_id', '=', 'items.id')
        //     ->join('category', 'items.category_id', '=', 'category.id')
        //     ->select('users.name', 'items.item', 'items.image', 'items.type', 'category.category', 'pengambilan.id', 'pengambilan_detail.quantity', 'pengambilan.created_at')
        //     ->whereNull('pengambilan_detail.confirmed_at')
        //     ->whereNull('pengambilan_detail.deleted_at')
        //     ->get();

        $ambils = Pengambilan::select('pengambilan.id', 'pengambilan.user_id', 'pengambilan.created_at')
            ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
            ->whereNull('pengambilan_detail.confirmed_at')
            ->whereNull('pengambilan_detail.deleted_at')
            ->get();

        $ambils = $ambils->unique('id');

        // return view('konfirmasi_pengambilan', ['pengambilan' => $data]);
        return view('konfirmasi_pengambilan', compact('ambils'));
    }

    /**
     * Confirming order items.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $ambils = Pengambilan::find($id);
        return view('konfirmasi_pengambilan_detail', compact('ambils'));
    }


    /**
     * Confirming order items.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $request)
    {
        $pengambilan = PengambilanDetail::findOrFail($request->id);
        // dd($pengambilan);
        $item = ItemAmbil::findOrFail($pengambilan->items_id);

        DB::beginTransaction();

        try {
            if (!($item->stock >= 0)) {
                throw new Exception("Barang $item->name saat ini stoknya habis.");
            }
            $pengambilan->confirmed_at = now();
            $pengambilan->save();
            DB::commit();
            $alert = ['success', "Berhasil mengkonfirmasi pemesanan barang $item->name."];
        } catch (Exception $e) {
            $alert = ['danger', $e->getMessage()];
            DB::rollback();
        }

        return redirect()->back()->with('alert', $alert);
    }

    /**
     * Removing order items.
     *
     * @param int id
     */
    public function delete($id)
    {
        $pengambilan = PengambilanDetail::findOrFail($id);
        $item = ItemAmbil::findorfail($pengambilan->items_id);
        // dd($item);

        DB::beginTransaction();
        try {
            $item->stock += $pengambilan->quantity;
            if ($item->save()) {
                $pengambilan->delete();
            }
            DB::commit();
            $alert = ['success', 'Berhasil menghapus pemesanan barang.'];
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menghapus pemesanan barang.'];
            DB::rollback();
        }

        return redirect()->back()->with('alert', $alert);
    }
}
