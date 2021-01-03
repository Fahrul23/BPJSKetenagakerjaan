<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;

use App\User;
use App\Activity;
use App\Item;

class KonfirmasiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $activity = User::join('activity', 'users.id', '=', 'activity.user_id')
                        ->join('items', 'activity.item_id', '=', 'items.id')
                        ->join('category', 'items.category_id', '=', 'category.id')
                        ->select('users.name', 'items.item', 'items.image', 'items.type', 'category.category', 'activity.date_start', 'activity.date_end', 'activity.id', 'activity.quantity', 'activity.alasan')
                        ->whereNull('activity.confirmed_at')
                        ->whereNull('activity.deleted_at')
                        ->get();
        return view('konfirmasi', ['activity' => $activity]);
    }   

    /**
     * Confirming order items.
     *
     * @param \Illuminate\Http\Request
     * @return \Illuminate\Http\Response
     */
    public function confirm(Request $r) {
        $act   =  activity::findorfail($r->id);
        $user  =  User::findorfail($act->user_id);
        $item  =  Item::findorfail($act->item_id);
        try {
            $qty = $item->stock - $act->quantity;
            if ( !($qty >= 0) ) {
                throw new Exception("Stok barang tidak mencukupi pemesanan $user->name barang $item->item.");
            }
            $act->confirmed_at = now();
            if ( $act->save() ) {
                $item->stock = $qty; 
                $item->save();
            }
            $alert = ['success', 'Berhasil mengkonfirmasi pemesanan barang.'];
        } catch (Exception $e) {
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
    public function delete(Request $r) {
        $act = activity::findorfail($r->id);
        try {
            $act->returned_at = now();
            $act->delete();
            $alert = ['success', 'Berhasil menghapus pemesanan barang.'];
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menghapus pemesanan barang.'];
        }
        return back()->with('alert', $alert);
    }
}
