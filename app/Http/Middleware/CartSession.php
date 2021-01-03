<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Session;
use Cart;

use App\CartPinjam;
use App\CartAmbil;

class CartSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        /**
         * Session cart pinjam
         * 
         * Session yang menyimpan data cart pinjam
         */
        $cart_pinjam = CartPinjam::where('user_id', Auth::id())->get();
        $cart_pinjam_session = Session::get('pinjam') ?? [];

        foreach ($cart_pinjam_session as $key => $value) {
            if ( $cart_pinjam->where('user_id', $value)->isEmpty() ) {
                unset($cart_pinjam_session[$key]);
                Cart::session("pinjam_$value")->clear();
            }
        }

        Session::put('pinjam', $cart_pinjam_session);

        foreach ($cart_pinjam as $key => $value) {
            if ( !in_array($value->to, $cart_pinjam_session) ) {
                array_push($cart_pinjam_session, $value->to);
                Session::put('pinjam', $cart_pinjam_session);
            }
            $item = $value->item;
            $carts = Cart::session("pinjam_$value->to");
            $hasItem = $carts->get($item->id);
            if ( empty($hasItem) ) {
                $item = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => '',
                    'quantity' => 1,
                    'attributes' => [
                        'date_start' => $value->date_start,
                        'date_end' => $value->date_end,
                        'image' => $item->image,
                        'keterangan' => $value->keterangan
                    ]
                ];
                Cart::session("pinjam_$value->to")->add($item);
            }
        }
        /**
         * Session cart ambil
         * 
         * Session yang menyimpan data cart ambil
         */
        $cart_ambil = CartAmbil::where('user_id', Auth::id())->get();
        $cart_ambil_session = Session::get('ambil') ?? [];

        foreach ($cart_ambil_session as $key => $value) {
            if ( $cart_ambil->where('user_id', $value)->isEmpty() ) {
                unset($cart_ambil_session[$key]);
                Cart::session("ambil_$value")->clear();
            }
        }

        Session::put('ambil', $cart_ambil_session);

        foreach ($cart_ambil as $key => $value) {
            if ( !in_array($value->to, $cart_ambil_session) ) {
                array_push($cart_ambil_session, $value->to);
                Session::put('ambil', $cart_ambil_session);
            }
            $item = $value->item;
            $carts = Cart::session("ambil_$value->to");
            $hasItem = $carts->get($item->id);
            if ( empty($hasItem) ) {
                $item = [
                    'id' => $item->id,
                    'name' => $item->name,
                    'price' => '',
                    'quantity' => $value->quantity,
                    'attributes' => [
                        'image' => $item->image,
                        'unit' => $item->unit,
                        'keterangan' => $value->keterangan
                    ]
                ];
                Cart::session("ambil_$value->to")->add($item);
            }
        }

        return $next($request);
    }
}
