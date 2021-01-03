<?php

namespace App\Exports;

use App\User;
use Illuminate\Http\Request;
use DB;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanPengambilanExport implements FromQuery, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;

    public function __construct(Request $req)
    {
        $this->category = $req->category_id;
        $this->user = $req->user_name;
        $this->item = $req->item_name;
        $this->start = $req->start;
        $this->end = $req->end;
    }

    public function registerEvents(): array
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
    {
        return [
            // baris pertama
            [
                'Laporan Pengambilan Barang'
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
                'Nama',
                'Barang',
                'Kategori',
                'Qty',
                'Satuan',
                'Tanggal Pengajuan',
            ]
        ];
    }
    public function query()
    {
        DB::statement(DB::raw('set @row:=0'));
        $pengambilan = User::query()->join('pengambilan', 'users.id', '=', 'pengambilan.user_id')
            ->join('pengambilan_detail', 'pengambilan.id', '=', 'pengambilan_detail.pengambilan_id')
            ->join('item_ambil', 'pengambilan_detail.items_id', '=', 'item_ambil.id')
            ->join('category', 'item_ambil.category_id', '=', 'category.id')
            ->select(DB::raw('@row := @row + 1 AS Nomor'), 'users.name', 'item_ambil.name as barang', 'category.category', 'pengambilan_detail.quantity', 'item_ambil.unit', DB::raw("DATE_FORMAT(pengambilan.created_at, '%d-%m-%Y') as tanggal_pengajuan"))
            ->whereNotNull('pengambilan_detail.confirmed_at')
            ->whereNull('pengambilan_detail.deleted_at')
            ->orderBy('Nomor', 'asc');
        if (!is_null($this->user)) {
            $pengambilan->where('users.id', $this->user);
        }
        if (!is_null($this->item)) {
            $pengambilan->where('item_ambil.name', 'LIKE', '%' . $this->item . '%');
        }
        if (!is_null($this->category)) {
            $pengambilan->where('item_ambil.category_id', $this->category);
        }
        if (!is_null($this->start)) {
            // dd($this->start);
            $pengambilan->whereDate('pengambilan.created_at', '>=', $this->start);
        }

        if (!is_null($this->end)) {
            $pengambilan->whereDate('pengambilan.created_at', '<=', $this->end);
        }

        return $pengambilan;
    }
}
