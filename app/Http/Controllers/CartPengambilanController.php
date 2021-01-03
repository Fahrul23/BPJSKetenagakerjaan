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
use App\ItemAmbil;
use App\Pengambilan;
use App\PengambilanDetail;
use App\CartAmbil;

class CartPengambilanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [];
        $user_session = Session::get('ambil');
        if (is_null($user_session)) $user_session = [];
        foreach ($user_session as $session) {
            $user = User::findOrFail($session);
            $items = [];
            foreach (Cart::session("ambil_$session")->getContent() as $item) {
                array_push($items, (object) [
                    'id' => $item->id,
                    'name' => $item->name,
                    'quantity' => $item->quantity,
                    'image' => $item->attributes['image'],
                    'unit' => $item->attributes['unit']
                ]);
            }
            array_push($data, (object) [
                'user_id' => $user->id,
                'user_name' => $user->name,
                'items' => $items
            ]);
        }
        return view('cart_pengambilan', [
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
            $cart = CartAmbil::where('user_id', Auth::id())
            ->where('to', $request->user)        
            ->where('item_id', $request->item)->first();
            // $cart = Cart::session('ambil_' . $request->user)->get($request->item);
            if ( !empty($cart) ) {
                $item = ItemAmbil::find($cart->item_id);
                $item->stock = $item->stock + $cart->quantity;
                $item->save();

                CartAmbil::where('user_id', Auth::id())
                ->where('to', $request->user)        
                ->where('item_id', $request->item)->delete();
            }
            Cart::session('ambil_' . $request->user)->remove($request->item);
            if (!empty(Cart::session('ambil_' . $request->user)->get($request->item))) {
                throw new Exception();
            } else {
                if (Cart::session('ambil_' . $request->user)->isEmpty()) {
                    Cart::session('ambil_' . $request->user)->clear();
                    $session = Session::get('ambil');
                    $key = array_search($request->user, $session);
                    unset($session[$key]);
                    if (empty($session)) {
                        Session::forget('ambil');
                    } else {
                        Session::put('ambil', $session);
                    }
                }
                $alert = ['success', 'Berhasil menghapus barang dari pesanan.'];
            }
            DB::commit();
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menghapus data pesanan.'];
            DB::rollback();
        }
        return redirect()->back()->with('alert', $alert);
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
            $pengambilan = Pengambilan::create(['user_id' => $user->id]);

            $pengambilan = new Pengambilan;
            $pengambilan->user_id = $user->id;
            $pengambilan->save();

            foreach (Cart::session('ambil_' . $user->id)->getContent() as $order) {

                $item = ItemAmbil::find($order->id);

                if (empty($item)) throw new Exception('Data barang tidak ada!');
                // if (empty($item->stock)) {
                //     $error = "Stock $item->name sudah habis.";
                //     throw new Exception($error);
                // }

                $input['items_id'] = $order->id;
                $input['quantity'] = $order->quantity;

                if (Auth::user()->role == 'admin') {
                    $input['confirmed_at'] = now();
                }

                $pengambilan_detail = new PengambilanDetail($input);
                $pengambilan->pengambilans()->save($pengambilan_detail);
            }

            CartAmbil::where('user_id', Auth::id())
                      ->where('to', $user->id)->delete();

            $session = Session::get('ambil');
            $key = array_search($user->id, $session);
            unset($session[$key]);
            if (empty($session)) {
                Session::forget('ambil');
            } else {
                Session::put('ambil', $session);
            }
            Cart::session('ambil_' . $user->id)->clear();
            DB::commit();
            $m = Auth::user()->role == 'user' ? 'Menunggu konfirmasi dari admin.' : '';
            $alert = ['success', 'Berhasil membuat data pesanan. ' . $m];
        } catch (Exception $e) {
            DB::rollBack();
            $alert = ['danger', $e->getMessage()];
        }
        return redirect()->back()->with('alert', $alert);
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
            $cart = CartAmbil::where('user_id', Auth::id())
                    ->where('to', $id)->get();
            // dd($cart);
            // $cart = Cart::session('ambil_' . $id)->getContent();
            foreach ($cart as $key => $value) {
                $item = ItemAmbil::find($value->item_id);
                $item->stock = $item->stock + $value->quantity;
                $item->save();
            }
  
            CartAmbil::where('user_id', Auth::id())
                     ->where('to', $id)->delete();

            Cart::session('ambil_' . $id)->clear();

            if (!Cart::session('ambil_' . $id)->isEmpty()) {
                throw new Exception();
            } else {
                $session = Session::get('ambil');
                $key = array_search($id, $session);
                unset($session[$key]);
                if (empty($session)) {
                    Session::forget('ambil');
                } else {
                    Session::put('ambil', $session);
                }
                $alert = ['success', 'Berhasil menghapus data pesanan.'];
            }
            DB::commit();
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menghapus data pesanan.'];
            DB::rollback();
        }
        return redirect()->back()->with('alert', $alert);
    }
}
