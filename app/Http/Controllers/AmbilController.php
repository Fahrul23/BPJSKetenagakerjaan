<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use DB;
use Auth;
use Session;
use Cart;
use Exception;

use App\ItemAmbil;
use App\Category;
use App\User;

use App\CartAmbil;

class AmbilController extends Controller
{
    /**
     * Display listing resource for activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = new ItemAmbil;

        if (!empty($request->search)) {
            $items = $items->where('name', 'LIKE', '%' . $request->search . '%');
        }
        if (!empty($request->category)) {
            $items = $items->where('category_id', $request->category);
        }
        $items = $items->paginate(10);

        $categories = Category::all();

        return view('aktivitas_ambil', compact('items', 'categories'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = User::where('role', 'user')->get();
        $item = ItemAmbil::where('stock', '!=', '0')->findorfail($id);
        return view('aktivitas_ambil_detail', ['item' => $item, 'users' => $users]);
    }

    /**
     * Create order for the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $r)
    {
        $item = ItemAmbil::findorfail($r->item);

        $validation = [
            'rule' => [
                'item' => 'required',
                'quantity' => ['required', 'integer', 'max:' . $item->stock, 'min:1'],
                'keterangan' => 'required|string|max:255'
            ],
            'message' => [
                'quantity.required' => 'Jumlah harus diisi.',
                'quantity.integer' => 'Jumlah harus diisi dengan angka.',
                'quantity.max' => "Jumlah tidak boleh lebih dari $item->stock $item->unit.",
                'quantity.min' => 'Jumlah yang dipesan minimal 1.',

                'keterangan.required' => 'Keterangan harus diisi.',
                'keterangan.string' => 'Keterangan harus diisi dengan kombinasi huruf, angka, atau simbol.',
                'keterangan.max' => "Jumlah tidak boleh lebih dari $item->stock karakter."
            ]
        ];
        if (Auth::user()->role == 'admin') {
            $validation['rule']['type'] = ['required', Rule::in(['baru', 'lama'])];
            $validation['rule']['user'] = 'required';
            $validation['message']['type.required'] = 'Pilih input user harus diisi.';
            $validation['message']['user.required'] = 'Pilih user harus diisi.';
        }
        $data = (object) Validator::make($r->all(), $validation['rule'], $validation['message'])->validate();
        $id = !empty($data->user) ? $data->user : Auth::id();
        $user = User::findorfail($id);
        if (!Session::has('ambil')) Session::put('ambil', []);

        DB::beginTransaction();
        try {
            $session = 'ambil_' . $user->id;
            if (!$item->stock > 0) {
                throw new Exception("Stok barang sudah habis.");
            }

            if (!in_array($user->id, Session::get('ambil'))) {
                Session::push('ambil', $user->id);
            }
            // DB::enableQueryLog();
            $cart = CartAmbil::where('user_id', Auth::id())
                             ->where('to', $user->id)
                             ->where('item_id', $item->id)->first();
            // dd(DB::getQueryLog());
            if ( empty($cart) ) {
                $cart = new CartAmbil;
                $cart->user_id      = Auth::id();
                $cart->to           = $user->id;
                $cart->item_id      = $item->id;
                $cart->quantity     = $data->quantity;
                $cart->keterangan   = $data->keterangan;
                $cart->save();
            } else {
                CartAmbil::where('user_id', Auth::id())
                            ->where('to', $user->id)
                            ->where('item_id', $item->id)
                            ->update(['quantity' => $cart->quantity + $data->quantity]);
            }

            Cart::session($session)->add([
                'id' => $item->id,
                'name' => $item->name,
                'price' => '',
                'quantity' => $data->quantity,
                'attributes' => [
                    'image' => $item->image,
                    'keterangan' => $data->keterangan,
                    'unit' => $item->unit
                ]
            ]);

            $item->stock = $item->stock - $data->quantity;
            $item->save();

            if (!Cart::session($session)->isEmpty()) {
                $alert = ['success', "Berhasil menambahkan barang ke dalam cart $user->name!"];
            } else {
                throw new Exception("Gagal menambahkan barang ke dalam cart $user->name!");
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            $alert = ['danger', $e->getMessage()];
        }

        Session::flash('alert', $alert);

        if ( empty($item->stock) ) {
            return redirect()->route('aktivitas.ambil.index');
        }
        return redirect()->back();
    }
}
