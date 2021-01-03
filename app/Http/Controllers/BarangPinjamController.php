<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Exception;
use DB;
use Session;

use App\Http\Requests\BarangPinjamTambahRequest;
use App\Http\Requests\BarangPinjamUbahStatusRequest;

use App\ItemPinjamDetail;
use App\ItemPinjam;
use App\Category;

class BarangPinjamController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $item = ItemPinjam::withCount('items');
        if (!is_null($request->search)) {
            $item->where('item_pinjam.name', 'LIKE', '%' . $request->search . '%');
        }
        if (!is_null($request->category)) {
            $item->where('category_id', $request->category)->orderBy('name', 'asc');
        }
        $items = $item->orderBy('name', 'asc')->paginate(10);
        $category = Category::all();

        return view('barang_pinjam', compact('items', 'category'));
    }

    public function create()
    {
        $category = Category::all();
        return view('barang_pinjam_tambah', ['category' => $category]);
    }

    public function store(BarangPinjamTambahRequest $request)
    {
        $input = (object) $request->validated();

        DB::beginTransaction();
        try {

            if ( ! empty( $input->image ) ) {
                $img_path = $input->image->store( 'public/item-image' );
            }

            $item_pinjam = new ItemPinjam;

            $item_pinjam->category_id   = $input->category;
            $item_pinjam->name          = $input->name;

            if ( ! empty( $img_path ) ) $item_pinjam->image = $img_path;

            $item_pinjam->save();

            for ($i = 0; $i < (int) $input->stock; $i++) {

                $item_pinjam_detail_data = [
                    'unique_id' => $this->getID(),
                    'name' => $item_pinjam->name,
                    'status' => 'bagus',
                ];

                if ( ! empty( $img_path ) )
                    $item_pinjam_detail_data['image'] = $img_path;

                $item_pinjam_detail = new ItemPinjamDetail( $item_pinjam_detail_data );

                $item_pinjam->items()->save($item_pinjam_detail);
            }

            Session::flash('alert', ['success', 'Berhasil menambah data barang pinjam']);
            DB::commit();
        } catch (Exception $e) {
            Storage::delete($img_path);
            Session::flash('alert', ['danger', 'Gagal menambah data barang pinjam']);
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function storeMoreItem(Request $request)
    {
        DB::beginTransaction();
        try {

            $item = ItemPinjam::find($request->id);

            $item_new = new ItemPinjamDetail([
                'unique_id' => $this->getID(),
                'name' => $item->name,
                'image' => $item->image,
                'status' => 1,
                'condition' => 'bagus'
            ]);

            $item->items()->save($item_new);

            Session::flash('alert', ['success', "Berhasil menambah data barang $item->name"]);
            DB::commit();
        } catch (Exception $e) {
            Session::flash('alert', ['danger', "Gagal menambah data barang $item->name"]);
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function show($id)
    {
        $item = ItemPinjam::find($id);
        $details = $item->items;
        $categories = Category::all();
        return view('barang_pinjam_detail', compact('item', 'details', 'categories'));
    }

    public function update(Request $request, $id)
    {

        DB::beginTransaction();

        $default_img = 'item-image/default-item.svg';

        try {

            $item = ItemPinjam::find($id);

            if (!empty($request->name)) {
                $item->name = $request->name;
                $item->items()->update(['name' => $request->name]);
            }

            if (!empty($request->category)) {
                $item->category_id = $request->category;
            }

            if (!empty($request->image)) {

                if ($item->image != $default_img) Storage::delete($item->image);
                $img_path = $request->image->store('public/item-image');
                $item->image = $img_path;

                $item->items()->update(['image' => $img_path]);
            }

            $item->save();

            Session::flash('alert', ['success', "Berhasil mengubah data barang $item->name"]);
            DB::commit();
        } catch (Exception $e) {

            Session::flash('alert', ['danger', "Gagal mengubah data barang $item->name"]);
            DB::rollBack();
        }

        return redirect()->back();
    }

    public function updateStatus(BarangPinjamUbahStatusRequest $request)
    {
        $input = (object) $request->validated();

        DB::beginTransaction();
        try {
            $item = ItemPinjamDetail::find($input->id);
            $item->condition = $input->condition;
            $item->save();

            DB::commit();
            Session::flash('alert', ['success', "Berhasil mengubah status barang $item->name!"]);
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('alert', ['danger', "Gagal mengubah status barang $item->name!"]);
        }

        return redirect()->back();
    }

    public function deleteItem($id)
    {

        DB::beginTransaction();
        try {
            $item = ItemPinjamDetail::find($id);
            $item->delete();

            DB::commit();
            Session::flash('alert', ['success', 'Berhasil menghapus barang!']);
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('alert', ['danger', 'Gagal menghapus barang!']);
        }

        return redirect()->back();
    }

    public function delete($id)
    {
        DB::beginTransaction();
        try {
            $item = ItemPinjam::find($id);
            $item->delete();

            DB::commit();
            Session::flash('alert', ['success', 'Berhasil menghapus barang!']);
        } catch (Exception $e) {
            DB::rollBack();
            Session::flash('alert', ['danger', 'Gagal menghapus barang!']);
        }

        return redirect()->route('barang.pinjam.index');
    }

    public function destroy(Request $r)
    {

        $default_img = 'item-image/default-item.svg';

        DB::beginTransaction();
        try {
            $item = ItemPinjam::onlyTrashed()
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

    public function restore($id)
    {
        try {
            ItemPinjam::onlyTrashed()
                ->where('id', $id)
                ->restore();
            $alert = ['success', 'Data barang berhasil dikembalikan'];
        } catch (Exception $e) {
            $alert = ['danger', 'Data barang gagal dikembalikan'];
        }
        return back()->with('alert', $alert);
    }

    public function riwayat()
    {
        $item_trashed = ItemPinjam::onlyTrashed()->get();

        return view('barang_pinjam_riwayat', ['item' => $item_trashed]);
    }


    /**
     *  Ambil id unique barang
     *  
     *  Default value untuk id unique barang
     *  pinjam.
     *  
     *  @return string $unique_id
     */

    private function getID()
    {
        $item = new ItemPinjamDetail;
        return $item->uniqueID();
    }
}
