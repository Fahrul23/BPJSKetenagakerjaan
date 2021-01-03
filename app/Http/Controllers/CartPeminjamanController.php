<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Cart;
use Session;
use DB;
use Auth;

use App\User;
use App\ItemPinjamDetail;
use App\Peminjaman;
use App\PeminjamanDetail;

use App\CartPinjam;

class CartPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $user_session = Session::get('pinjam');
        if (is_null($user_session)) $user_session = [];
        foreach ($user_session as $session) {
            $user = User::findOrFail($session);
            $items = [];
            foreach (Cart::session("pinjam_$session")->getContent() as $item) {
                array_push($items, (object) [
                    'id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'date_start' => $item->attributes['date_start'],
                    'date_end' => $item->attributes['date_end'],
                    'image' => $item->attributes['image'],
                    'keterangan' => $item->attributes['keterangan'],
                ]);
            }
            array_push($data, (object) [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'items' => $items
            ]);
        }
        return view('cart_peminjaman', [
            'data' => $data
        ]);
    }

    /**
     * Removing some order item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $request)
    {
        DB::beginTransaction();
        try {
            $cart = CartPinjam::where('user_id', Auth::id())
                                ->where('to', $request->user)
                                ->where('item_id', $request->item)
                                ->first();
            if ( !empty($cart) ) {
                
                $item = $cart->item;
                $item->status = '1';
                $item->save();
                
                CartPinjam::where('user_id', Auth::id())
                                    ->where('to', $request->user)
                                    ->where('item_id', $request->item)
                                    ->delete();
            }


            Cart::session('pinjam_' . $request->user)->remove($request->item);
            if (!empty(Cart::session('pinjam_' . $request->user)->get($request->item))) {
                throw new Exception();
            } else {
                if (Cart::session('pinjam_' . $request->user)->isEmpty()) {
                    Cart::session('pinjam_' . $request->user)->clear();
                    $session = Session::get('pinjam');
                    $key = array_search($request->user, $session);
                    unset($session[$key]);
                    if (empty($session)) {
                        Session::forget('pinjam');
                    } else {
                        Session::put('pinjam', $session);
                    }
                }
                DB::commit();
                $alert = ['success', 'Berhasil menghapus barang dari pesanan.'];
            }
        } catch (Exception $e) {
            DB::rollback();
            $alert = ['danger', 'Gagal menghapus data pesanan.'];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = [
            'rule' => [
                'user' => 'required|integer',
            ],
            'message' => [
                'user.required' => 'Pilih user harus diisi.',
            ]
        ];

        $data = (object) Validator::make($request->all(), $validation['rule'], $validation['message'])->validate();
        $user = User::findorfail($data->user);
        

        DB::beginTransaction();
        try {
            $peminjaman = Peminjaman::create(['user_id' => $user->id]);
            foreach (Cart::session('pinjam_' . $user->id)->getContent() as $order) {
                $item = ItemPinjamDetail::find($order->id);
                if (empty($item)) throw new Exception('Data barang tidak ada!');
                // if (empty($item->stock)) {
                //     $error = "$item->item sudah dipinjam oleh user lain.";
                //     throw new Exception($error);
                // }
                // $input['peminjaman_id'] = $peminjaman->id;
                $input['items_id'] = $order->id;
                // $input['quantity'] = $order->quantity;

                $input['date_start'] = $order->attributes['date_start'];
                $input['date_end'] = $order->attributes['date_start']->endOfDay();
                $input['keterangan'] = $order->attributes['keterangan'];
                

                if (Auth::user()->role == 'admin') {
                    $input['confirmed_at'] = now();
                    $item->status = '0';
                    $item->save();
                }
                $peminjaman_detail = new PeminjamanDetail($input);

                $peminjaman->peminjamans()->save($peminjaman_detail);
            }

            CartPinjam::where('user_id', Auth::id())->delete();

            $session = Session::get('pinjam');
            $key = array_search($user->id, $session);
            unset($session[$key]);
            if (empty($session)) {
                Session::forget('pinjam');
            } else {
                Session::put('pinjam', $session);
            }
            Cart::session('pinjam_' . $user->id)->clear();
            DB::commit();
            $m = Auth::user()->role == 'user' ? 'Menunggu konfirmasi dari admin.' : '';
            $alert = ['success', 'Berhasil membuat data pesanan. ' . $m];
        } catch (Exception $e) {
            DB::rollBack();
            $alert = ['danger', $e->getMessage()];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from session cart.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {   
        DB::beginTransaction();
        try {
            $carts = CartPinjam::where('user_id', Auth::id())
                                ->where('to', $id)
                                ->get();
            foreach ($carts as $cart) {
                $item = $cart->item;
                $item->status = '1';
                $item->save();
    
                CartPinjam::where('user_id', Auth::id())
                    ->where('to', $id)
                    ->where('item_id', $cart->item_id)
                    ->delete();
            }
            Cart::session('pinjam_' . $id)->clear();
            if (!Cart::session('pinjam_' . $id)->isEmpty()) {
                throw new Exception();
            } else {
                $session = Session::get('pinjam');
                $key = array_search($id, $session);
                unset($session[$key]);
                if (empty($session)) {
                    Session::forget('pinjam');
                } else {
                    Session::put('pinjam', $session);
                }
                DB::commit();
                $alert = ['success', 'Berhasil menghapus data pesanan.'];
            }
        } catch (Exception $e) {
            DB::rollback();
            $alert = ['danger', 'Gagal menghapus data pesanan.'];
        }
        return back()->with('alert', $alert);
    }
}
