<?php

namespace App\Exports;

use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanBarangExport implements FromQuery, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;

    public function __construct(Request $req)
    {
        $this->category = $req->category_id;
        $this->type = $req->type;
        $this->date = $req->time;
        $this->kondisi_barang = $req->item_condition;
    }

    public function registerEvents(): array
    // untuk memberikan style
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $centerBold = [
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                    'font' => [
                        'bold' => true,
                        'size' => 16,
                    ],
                ];
                $border = [
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['rgb' => '000000'],
                        ],
                    ],
                    'alignment' => [
                        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    ],
                ];
                $boldBlueFill = [
                    'font' => [
                        'bold' => true
                    ],
                    'fill' => [
                        'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => '0070C0']
                    ]
                ];

                // judul
                $event->getSheet()->getDelegate()->getStyle('A1:G3')->applyFromArray($centerBold);
                $event->sheet->mergeCells('A1:G1');
                $event->sheet->mergeCells('A2:G2');
                $event->sheet->mergeCells('A3:G3');

                // tabel
                $event->getsheet()->getDelegate()->getStyle('A5:G5')->applyFromArray($boldBlueFill);
                $event->getSheet()->getDelegate()->getStyle('A5:G' . $event->sheet->getHighestRow())->applyFromArray($border);
            },
        ];
    }

    public function headings(): array
    // untuk memberikan header pada excel
    {
        return [
            // baris pertama
            [
                'Laporan Barang'
            ],

            // baris kedua
            ['BPJS Ketenagakerjaan Cabang Bogor'],

            // baris ketiga
            ['Tahun' . ' ' . date('Y')],

            // baris keempat
            [],

            // baris kelima
            [
                'No.',
                'Nomor Barang',
                'Barang',
                'Tipe Barang',
                'Kategori Barang',
                'Stock',
                'Kondisi Barang',
            ]
        ];
    }

    public function query()
    {
        DB::statement(DB::raw('set @row:=0'));
        $item = DB::table('items')
            ->join('category', 'items.category_id', '=', 'category.id')
            ->select(DB::raw('@row := @row + 1 AS Nomor'), 'items.unique_id', 'items.item', 'items.type', 'category.category', 'items.stock', 'items.kondisi_barang')
            ->orderBy('Nomor', 'asc');
        if (!is_null($this->type)) {
            $item->where('items.type', $this->type);
        }
        if (!is_null($this->category)) {
            $item->where('items.category_id', $this->category);
        }
        if (!is_null($this->kondisi_barang)) {
            $item->where('items.kondisi_barang', $this->kondisi_barang);
        }

        if (!is_null($this->date)) {
            $tanggal = explode(" - ", $this->date);
            $item->whereBetween('items.created_at', $tanggal);
        }

        return $item;
    }
}
