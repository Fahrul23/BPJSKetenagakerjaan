<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use Carbon\Carbon;

use App\Http\Requests\BarangRequest;
use App\Http\Requests\BarangUpdateRequest;

use App\Item;
use App\Category;


class BarangController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $item = Item::all();
        $item_trashed = Item::onlyTrashed()->get();
        $barang = Item::where('stock', 0)->where('type', '=', 'ambil')->get();
        $category = Category::all();
        return view('barang', ['item' => $item, 'item_trashed' => $item_trashed, 'category' => $category, 'barang' => $barang]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\BarangRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BarangRequest $request)
    {

        $data = (object) $request->validated();
        $image = $data->image;
        $id = new Item;
        $id = $id->uniqueID($data->type);
        $input['unique_id'] = $id;
        $input['item'] = $data->item;
        $input['type'] = $data->type;
        $input['category_id'] = $data->category;
        $input['kondisi_barang'] = 'bagus';
        $input['stock'] = $data->stock;
        $input['image'] = round(microtime(true)) . '.' . $data->image->extension();

        try {
            $image->storeAs('public/item-image', $input['image']);
            $item = Item::create($input);
            if ($item->save()) {
                $alert = ['success', 'Berhasil menambahkan data barang!'];
            } else {
                $alert = ['danger', 'Gagal menambahkan data barang!'];
            }
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menambahkan data barang!'];
        }

        return back()->with('alert', $alert);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = Category::all();
        $item = Item::find($id);
        return view('barang_edit', ['item' => $item, 'category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BarangUpdateRequest $request)
    {
        $data = (object) $request->validated();

        try {
            $item = Item::find($data->id);
            if (!empty($data->item))      $item->item = $data->item;
            if (!empty($data->category))  $item->category_id = $data->category;
            if (!empty($data->kondisi_barang))  $item->kondisi_barang = $data->kondisi_barang;
            if (!empty($data->stock))     $item->stock = $item->stock + $data->stock;

            if (!empty($data->image)) {
                $ext = explode('.', $item->image)[1];
                $ext_input = $data->image->extension();
                if ($ext != $ext_input) {
                    $ext = $ext_input;
                }
                Storage::delete($item->image);
                $item->image = round(microtime(true)) . '.' . $ext;
                $data->image->storeAs('public/item-image', $item->image);
            }

            if ($item->update()) {
                $alert = ['success', 'Berhasil mengedit data barang!'];
            } else {
                $alert = ['danger', 'Gagal mengedit data barang!'];
            }
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal mengedit data barang!'];
        }

        return back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage permanently.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $r)
    {
        try {
            $item = Item::onlyTrashed()
                ->where('id', $r->id);
            $img = $item->first();
            $img_dir = 'public/item-image/' . $img->image;
            if (Storage::exists($img_dir)) {
                Storage::delete($img_dir);
            }
            $item->forceDelete();
            $alert = ['success', 'Data barang berhasil dihapus secara permanen'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data barang gagal dihapus secara permanen'];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Soft delete the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $r)
    {
        try {
            Item::find($r->id)->delete();
            $alert = ['success', 'Data barang berhasil dihapus'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data barang gagal dihapus'];
        }
        return back()->with('alert', $alert);
    }

    /**
     * Restore the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        try {
            Item::onlyTrashed()
                ->where('id', $id)
                ->restore();
            $alert = ['success', 'Data barang berhasil dikembalikan'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data barang gagal dikembalikan'];
        }
        return back()->with('alert', $alert);
    }
}
