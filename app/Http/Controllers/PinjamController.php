<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Auth;
use Exception;
use Session;
use Cart;
use DB;

use App\ItemPinjam;
use App\ItemPinjamDetail;
use App\Category;
use App\User;

use App\CartPinjam;

class PinjamController extends Controller
{
    /**
     * Display listing resource for activity.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = ItemPinjam::with(['items' => function($query) {
            $query->whereNotIn('condition', ['rusak', 'hilang'])->get();
        }]);
        if (!is_null($request->search)) {
            $items = $items->where('name', 'LIKE', '%' . $request->search . '%');
        }
        if (!is_null($request->category)) {
            $items = $items->where('category_id', $request->category);
        }

        $items = $items->orderBy('name', 'asc')->paginate(10);

        $category = Category::all();

        return view('aktivitas_pinjam', ['category' => $category, 'items' => $items]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        $item = ItemPinjam::find($id);
        return view('aktivitas_pinjam_item', ['item' => $item, 'id' => $id]);
    }

    /**
     * Create order for the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function create($id)
    {
        $users = User::where('role', 'user')->get();
        $item_detail = ItemPinjamDetail::find($id);

        if ( ! $item_detail->status ) {
            Session::flash('alert', ['danger', "Barang $item_detail->name ($item_detail->unique_id) tidak tersedia untuk sementara, silahkan pilih barang yang lain!"]);
            return redirect()->back();
        }
        
        $item = $item_detail->item;
        return view('aktivitas_pinjam_detail', ['item' => $item, 'item_detail' => $item_detail, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $item = ItemPinjamDetail::findorfail($request->item);
        $validation = [
            'rule' => [
                'item' => 'required',
                'keterangan' => 'string',
                'pinjam' => 'required|date|after_or_equal:' . now()->format('Y-m-d'),
                'kembali' => 'required|date|after_or_equal:pinjam',
            ],
            'message' => [
                'keterangan.string' => 'Keterangan harus diisi dengan campuran karakter angka, huruf, atau simbol.',

                'pinjam.required' => 'Masukan tanggal pinjam.',
                'pinjam.date' => 'Input harus diisi dengan format tanggal.',
                'pinjam.after_or_equal' => 'Tanggal tidak boleh diisi kurang dari hari ini.',

                'kembali.required' => 'Masukan tanggal kembali.',
                'kembali.date' => 'Input harus diisi dengan format tanggal.',
                'kembali.after_or_equal' => 'Tanggal tidak boleh diisi kurang dari tanggal pinjam.',
            ]
        ];
        if (Auth::user()->role == 'admin') {
            $validation['rule']['type']                 =   ['required', Rule::in(['baru', 'lama'])];
            $validation['rule']['user']                 =   'required';
            $validation['message']['type.required']     =   'Pilih input user harus diisi.';
            $validation['message']['user.required']     =   'Pilih user harus diisi.';
        }
        // dd($request->all());
        $data  =   (object) Validator::make($request->all(), $validation['rule'], $validation['message'])->validate();
        $user  =   Auth::user()->role == 'admin' ? $data->user : Auth::id();
        $user  =   User::findorfail($user);
        $item  =   ItemPinjamDetail::findorfail($data->item);

        if (!Session::has('pinjam')) Session::put('pinjam', []);

        $url = redirect();
        DB::beginTransaction();
        try {
            $session            =   'pinjam_' . $user->id;
            $tanggal_pinjam     =   $data->pinjam;
            $tanggal_kembali    =   $data->kembali;
            $session            =   'pinjam_' . $user->id;
            if (!in_array($user->id, Session::get('pinjam'))) {
                Session::push('pinjam', $user->id);
            }
            if (!empty(Cart::session($session)->get($item->id))) {
                throw new Exception("Barang yang dipesan sudah ada dalam cart.");
            }

            $cart = new CartPinjam;
            $cart->user_id      = Auth::id();
            $cart->to           = $user->id;
            $cart->item_id      = $item->id;
            $cart->keterangan   = $data->keterangan;
            $cart->date_start   = $tanggal_pinjam;
            $cart->date_end     = $tanggal_kembali;
            $cart->save();

            Cart::session($session)->add([
                'id' => $item->id,
                'name' => $item->name,
                'price' => '',
                'quantity' => 1,
                'attributes' => [
                    'date_start' => $cart->date_start,
                    'date_end' => $cart->date_end,
                    'image' => $item->image,
                    'keterangan' => $data->keterangan
                ]
            ]);

            $item->status = '0';
            $item->save();

            if (!Cart::session($session)->isEmpty()) {
                DB::commit();
                $alert = ['success', 'Berhasil menambahkan barang ke dalam cart ' . $user->name];
                $url = $url->route('aktivitas.pinjam.show', ['id' => $item->item->id]);
            } else {
                throw new Exception('Gagal menambahkan barang ke dalam cart ' . $user->name);
            }
        } catch (Exception $e) {
            DB::rollback();
            $alert = ['danger', $e->getMessage()];
            $url = $url->back();
            
        }
        return $url->with('alert', $alert);
    }
}
