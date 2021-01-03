<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Exception;
use Auth;
use DB;
use Session;
use Cart;
use App\User;
use App\Item;
use App\Activity;

class CartController extends Controller
{
    /**
     * Display ordering item (pinjam).
     *
     * @return \Illuminate\Http\Response
     */
    public function pinjam()
    {
        $title = 'peminjaman';
        return view('cart', [
            'title' => $title,
            'user' => User::class,
            'session' => Session::get('pinjam')
        ]);
    }

    /**
     * Display ordering item (ambil).
     *
     * @return \Illuminate\Http\Response
     */
    public function ambil()
    {
        $title = 'pengambilan';
        return view('cart', [
            'title' => $title,
            'user' => User::class,
            'session' => Session::get('ambil')
        ]);
    }

    /**
     * Removing some order item.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function remove(Request $r)
    {
        try {
            Cart::session($r->type . '_' . $r->user)->remove($r->item);
            if (!empty(Cart::session($r->type . '_' . $r->user)->get($r->item))) {
                throw new Exception('Gagal menghapus data pesanan.');
            } else {
                if (Cart::session($r->type . '_' . $r->user)->isEmpty()) {
                    Cart::session($r->type . '_' . $r->user)->clear();
                    $session = Session::get($r->type);
                    $key = array_search($r->user, $session);
                    unset($session[$key]);
                    if (empty($session)) {
                        Session::forget($r->type);
                    } else {
                        Session::put($r->type, $session);
                    }
                }
                $alert = ['success', 'Berhasil menghapus barang dari pesanan.'];
            }
        } catch (Exception $e) {
            $alert = ['danger', $e->getMessage()];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Canceling order user.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function cancel(Request $r)
    {
        try {
            Cart::session($r->type . '_' . $r->user)->clear();
            if (!Cart::session($r->type . '_' . $r->user)->isEmpty()) {
                throw new Exception('Gagal menghapus data pesanan.');
            } else {
                $session = Session::get($r->type);
                $key = array_search($r->user, $session);
                unset($session[$key]);
                if (empty($session)) {
                    Session::forget($r->type);
                } else {
                    Session::put($r->type, $session);
                }
                $alert = ['success', 'Berhasil menghapus data pesanan.'];
            }
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menghapus data pesanan.'];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Storing data order to database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $validation = [
            'rule' => [
                'user' => 'required|integer',
                'type' => ['required', Rule::in(['pinjam', 'ambil'])],
            ],
            'message' => [
                'user.required' => 'Pilih user harus diisi.',
                'type.required' => 'Pilih input user harus diisi.',
            ]
        ];
        $data = (object) Validator::make($r->all(), $validation['rule'], $validation['message'])->validate();
        $user = User::findorfail($data->user);
        DB::beginTransaction();
        try {
            foreach (Cart::session($data->type . '_' . $user->id)->getContent() as $order) {
                $item = Item::find($order->id);
                if (empty($item)) throw new Exception('Data barang tidak ada!');
                if (empty($item->stock)) {
                    $error = $data->type == 'pinjam' ? "$item->item sudah dipinjam oleh user lain." : "Stock $item->item sudah habis.";
                    throw new Exception($error);
                }
                $input['user_id'] = $user->id;
                $input['item_id'] = $order->id;
                $input['quantity'] = $order->quantity;

                if ($data->type == 'pinjam') {
                    $date_start = explode('-', $order->attributes['date_start']);
                    $date_end = explode('-', $order->attributes['date_end']);
                    $input['date_start'] = Carbon::create($date_start[0], $date_start[1], $date_start[2]);
                    $input['date_end'] = Carbon::create($date_end[0], $date_end[1], $date_end[2]);
                    $input['alasan'] = $order->attributes['alasan'];
                }
                if (Auth::user()->role == 'admin') {
                    $input['confirmed_at'] = Carbon::now();
                    $qty = $item->stock - $order->quantity;
                    if (!($qty >= 0)) {
                        throw new Exception("Stok barang tidak mencukupi pemesanan $user->name barang $item->item.");
                    }
                    $item->stock = $qty;
                    $item->save();
                }
                Activity::create($input);
            }
            $session = Session::get($data->type);
            $key = array_search($user->id, $session);
            unset($session[$key]);
            if (empty($session)) {
                Session::forget($data->type);
            } else {
                Session::put($data->type, $session);
            }
            Cart::session($data->type . '_' . $user->id)->clear();
            DB::commit();
            $m = Auth::user()->role == 'user' ? 'Menunggu konfirmasi dari admin' : '';
            $alert = ['success', 'Berhasil membuat data pesanan. ' . $m];
        } catch (Exception $e) {
            DB::rollBack();
            $alert = ['danger', $e->getMessage()];
        }
        return back()->with('alert', $alert);
    }
}
