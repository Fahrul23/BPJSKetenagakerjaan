<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Item;

use Maatwebsite\Excel\Facades\Excel;
use App\Exports\LaporanBarangExport;
use PDF;

class LaporanBarangController extends Controller
{
    public function index(Request $req)
    {
        $category = Category::all();
        $item = Item::join('category', 'items.category_id', '=', 'category.id')
            ->select('items.unique_id', 'items.item', 'items.image', 'items.stock', 'items.type', 'category.category', 'items.kondisi_barang');
        if (!is_null($req->type)) {
            $item->where('items.type', $req->type);
        }
        if (!is_null($req->category)) {
            $item->where('items.category_id', $req->category);
        }
        if (!is_null($req->kondisi_barang)) {
            $item->where('items.kondisi_barang', $req->kondisi_barang);
        }
        if (!is_null($req->date)) {
            $tanggal = explode(" - ", $req->date);
            $item->whereBetween('items.created_at', $tanggal);
        }

        $item = $item->get();

        return view('laporan_barang', ['category' => $category, 'item' => $item]);
    }

    public function export_excel(Request $req)
    {
        $tanggal = date("d_m_Y");

        // passing request ke object export
        return Excel::download(new LaporanBarangExport($req), 'LAP_BRG_' . $tanggal . '.xlsx');
    }

    public function export_pdf(Request $req)
    {
        $item = Item::join('category', 'items.category_id', '=', 'category.id')
            ->select('items.unique_id', 'items.item', 'items.image', 'items.stock', 'items.type', 'category.category', 'items.kondisi_barang');
        if (!is_null($req->type)) {
            $item->where('items.type', $req->type);
        }
        if (!is_null($req->category_id)) {
            $item->where('items.category_id', $req->category_id);
        }
        if (!is_null($req->item_condition)) {
            $item->where('items.kondisi_barang', $req->item_condition);
        }
        if (!is_null($req->time)) {
            $tanggal = explode(" - ", $req->time);
            $item->whereBetween('items.created_at', $tanggal);
        }

        $item = $item->get();
        $tanggal = date("d_m_Y");

        $pdf = PDF::loadview('exports.laporan_barang', ['item' => $item]);
        return $pdf->download('LAP_BRG_' . $tanggal . '.pdf');
    }
}
