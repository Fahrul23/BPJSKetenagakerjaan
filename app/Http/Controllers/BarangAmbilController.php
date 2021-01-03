<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use DB;
use Session;

use App\Http\Requests\BarangAmbilTambahRequest;

use App\ItemAmbil;
use App\Category;

class BarangAmbilController extends Controller
{

    public function index(Request $request)
    {
        $items = new ItemAmbil;
        if (!is_null($request->search)) {
            $items = $items->where('name', 'LIKE', '%' . $request->search . '%');
        }
        if (!is_null($request->category)) {
            $items = $items->where('category_id', $request->category);
        }

        $items = $items->paginate(10);

        $category = Category::all();

        return view('barang_ambil', ['items' => $items, 'category' => $category]);
    }

    public function create()
    {
        $category = Category::all();
        return view('barang_ambil_tambah', ['category' => $category]);
    }


    public function store(BarangAmbilTambahRequest $request)
    {
        $input = (object) $request->validated();

        DB::beginTransaction();
        try {

            if ( ! empty($input->image) ) 
                $img_path = $input->image->store('public/item-image');

            $item_ambil = new ItemAmbil;

            $item_ambil->category_id   = $input->category;
            $item_ambil->unique_id     = $this->getID();
            $item_ambil->name          = $input->name;

            if ( ! empty($img_path) )
                $item_ambil->image     = $img_path;

            $item_ambil->unit          = $input->unit;
            $item_ambil->stock         = $input->stock;

            $item_ambil->save();

            Session::flash('alert', ['success', 'Berhasil menambah data barang pinjam']);
            DB::commit();
        } catch (Exception $e) {
            Storage::delete($img_path);
            Session::flash('alert', ['danger', 'Gagal menambah data barang pinjam']);
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $item = ItemAmbil::find($id);
        $categories = Category::all();
        return view('barang_ambil_detail', compact('item', 'categories'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        $default_img = 'item-image/default-item.svg';

        try {

            $item = ItemAmbil::find($id);

            if (!empty($request->name))       $item->name         = ucwords($request->name);
            if (!empty($request->category))   $item->category     = $request->category;
            if (!empty($request->unit))       $item->unit         = $request->unit;
            if (!empty($request->stock))      $item->stock        = $request->stock;
            if (!empty($request->image)) {

                if ($item->image != $default_img) Storage::delete($item->image);
                $img_path = $request->image->store('public/item-image');
                $item->image = $img_path;
            }

            $item->save();
            DB::commit();
            Session::flash('alert', ['success', 'berhasil mengubah data barang.']);
        } catch (Exception $e) {

            if ($item->image != $default_img) Storage::delete($item->image);
            DB::rollBack();
            Session::flash('alert', ['danger', 'gagal mengubah data barang.']);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $item = ItemAmbil::find($id);
            $item->delete();

            Session::flash('alert', ['success', 'Berhasil menghapus barang ambil']);
            DB::commit();
            return redirect()->route('barang.ambil.index');
        } catch (Exception $e) {
            Session::flash('alert', ['danger', 'Gagal menghapus barang ambil']);
            DB::rollback();
            return redirect()->back();
        }
    }

    public function restore($id)
    {
        try {
            ItemAmbil::onlyTrashed()
                ->where('id', $id)
                ->restore();
            $alert = ['success', 'Data barang berhasil dikembalikan'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data barang gagal dikembalikan'];
        }
        return back()->with('alert', $alert);
    }

    public function destroy(Request $r)
    {
        $default_img = 'item-image/default-item.svg';

        DB::beginTransaction();
        try {
            $item = ItemAmbil::onlyTrashed()
                ->where('id', $r->id);
            $img = $item->first();

            if ( $img->image != $default_img )
                Storage::delete($img->image);

            $item->forceDelete();
            DB::commit();
            $alert = ['success', 'Data barang berhasil dihapus secara permanen'];
        } catch (Exception $e) {
            DB::rollback();
            $alert = ['danger', 'Data barang gagal dihapus secara permanen'];
        }
        return back()->with('alert', $alert);
    }

    public function riwayat()
    {
        $item_trashed = ItemAmbil::onlyTrashed()->get();

        return view('barang_ambil_riwayat', ['item' => $item_trashed]);
    }

    public function habis(Request $request)
    {
        $items = new ItemAmbil;
        if (!is_null($request->search)) {
            $items = $items->where('name', 'LIKE', '%' . $request->search . '%');
        }
        if (!is_null($request->category)) {
            $items = $items->where('category_id', $request->category);
        }
        $items = $items->where('stock', 0)->paginate(10);

        // foreach ($items as $key => $value) {
        //     dd($items->category);
        // }

        $category = Category::all();
        return view('barang_ambil', ['items' => $items, 'category' => $category]);
    }

    private function getID()
    {
        $item = new ItemAmbil;
        return $item->uniqueID();
    }
}
