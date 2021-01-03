<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;
use DB;

use App\Http\Requests\KategoriRequest;

class KategoriController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = Category::all();
        $category_trashed = Category::onlyTrashed()->get();
        return view('kategori', ['category' => $category, 'category_trashed' => $category_trashed]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(KategoriRequest $request)
    {

        $data = $request->validated();

        try {
            $item = Category::create($data);
            if ($item->save()) {
                $alert = ['success', 'Berhasil menambahkan data kategori!'];
            } else {
                $alert = ['danger', 'Gagal menambahkan data kategori!'];
            }
        } catch (Exception $e) {
            $alert = ['danger', 'Gagal menambahkan data kategori!'];
        }

        return back()->with('alert', $alert);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $r)
    {
        try {
            $item = Category::onlyTrashed()
                ->where('id', $r->id)
                ->first();
            $item->forceDelete();
            $alert = ['success', 'Data kategori berhasil dihapus secara permanen'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data kategori gagal dihapus secara permanen'];
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
        DB::beginTransaction();
        try {
            foreach (Item::where('category_id', $r->id)->get() as $value) {
                $data = Item::find($value->id);
                $data->category_id = null;
                $data->update();
            }
            Category::find($r->id)->delete();
            DB::commit();
            $alert = ['success', 'Data kategori berhasil dihapus'];
        } catch (Exception $e) {
            DB::rollBack();
            $alert = ['danger', 'Data kategori gagal dihapus'];
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
            $item = Category::onlyTrashed()
                ->where('id', $id)
                ->restore();
            $alert = ['success', 'Data kategori berhasil dikembalikan'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data kategori gagal dikembalikan'];
        }
        return back()->with('alert', $alert);
    }

    public function riwayat()
    {
        $item_trashed = Category::onlyTrashed()->get();

        return view('kategori_riwayat', ['item' => $item_trashed]);
    }
}
