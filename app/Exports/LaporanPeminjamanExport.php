<?php

namespace App\Exports;

use App\Peminjaman;
use Illuminate\Http\Request;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class LaporanPeminjamanExport implements FromArray, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;

    public function __construct(Request $req)
    {
        $this->user = $req->user_name;
        $this->start = $req->start;
        $this->end = $req->end;
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
                        'startColor' => ['argb' => '00B0F0']
                    ]
                ];

                // judul
                $event->getSheet()->getDelegate()->getStyle('A1:J3')->applyFromArray($centerBold);
                $event->sheet->mergeCells('A1:J1');
                $event->sheet->mergeCells('A2:J2');
                $event->sheet->mergeCells('A3:J3');

                // tabel
                $event->getsheet()->getDelegate()->getStyle('A5:J5')->applyFromArray($boldBlueFill);
                $event->getSheet()->getDelegate()->getStyle('A5:J' . $event->sheet->getHighestRow())->applyFromArray($border);
            },
        ];
    }

    public function headings(): array
    // untuk memberikan header pada excel
    {
        return [
            // baris pertama
            [
                'Laporan Peminjaman Barang'
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
                'No Barang',
                'Barang',
                'Kategori',
                'Keterangan',
                'Tanggal Pengajuan',
                'Tanggal Pinjam',
                'Tanggal Batas Pinjam',
                'Status'
            ]
        ];
    }

    public function array(): array
    // untuk query data
    {
        // DB::statement(DB::raw('set @row:=0'));
        // $peminjaman =  User::query()->join('peminjaman', 'users.id', '=', 'peminjaman.user_id')
        //     ->join('peminjaman_detail', 'peminjaman.id', '=', 'peminjaman_detail.peminjamanable_id')
        //     ->join('item_pinjam_detail', 'peminjaman_detail.items_id', '=', 'item_pinjam_detail.id')
        //     ->join('item_pinjam', 'item_pinjam_detail.item_pinjam_id', '=', 'item_pinjam.id')
        //     ->join('category', 'item_pinjam.category_id', '=', 'category.id')
        //     ->select(DB::raw('@row := @row + 1 AS Nomor'), 'users.name', 'item_pinjam_detail.unique_id', 'item_pinjam_detail.name As item', 'category.category',  'peminjaman_detail.keterangan', DB::raw("DATE_FORMAT(peminjaman.created_at, '%d-%m-%Y') as tanggal_pengajuan"), DB::raw("DATE_FORMAT(peminjaman_detail.date_start, '%d-%m-%Y') as tanggal_pinjam"), DB::raw("DATE_FORMAT(peminjaman_detail.date_end, '%d-%m-%Y') as batas_pinjam"))
        //     ->whereNotNull('peminjaman_detail.confirmed_at')
        //     ->whereNull('peminjaman_detail.deleted_at')
        //     ->orderBy('Nomor', 'asc');
        $peminjaman = new Peminjaman;
        if (!is_null($this->user)) {
            $peminjaman = $peminjaman->where('users.id', $this->user);
        }
        if (!is_null($this->start)) {
            // dd($this->start);
            $peminjaman = $peminjaman->whereDate('created_at', '>=', $this->start);
        }

        if (!is_null($this->end)) {
            $peminjaman = $peminjaman->whereDate('created_at', '<=', $this->end);
        }

        $peminjaman = $peminjaman->get();

        // return $peminjaman;
        // dd($peminjaman);
        $result = [];

        $i = 1;
        foreach ($peminjaman as $key => $m) {

            $data = $m->peminjamans;
            foreach ($data as $k => $d) {

                $changed = $d->peminjaman;
                $d = !empty($changed) ? $changed : $d;

                if (!empty($d->confirmed_at))

                    $item = $d->item;
                $value['id'] = $i++;
                $value['name'] = $m->peminjamanable_type == "App\PeminjamanDetail" ?
                    $m->peminjamanable->peminjamanable->user->name :
                    $m->user->name;
                $value['no_barang'] = $item->unique_id;
                $value['barang'] = $item->name;
                $value['kategori'] = $item->item->category->category;
                $value['keterangan'] = $d->keterangan;
                $value['tanggal_pengajuan'] = !empty($m->created_at) ? $m->created_at->isoFormat('DD MMMM YYYY') : '-';
                $value['tanggal_pinjam'] = !empty($d->date_start) ? $d->date_start->isoFormat('DD MMMM YYYY') : '-';
                $value['tanggal_batas_pinjam'] = !empty($d->date_end) ? $d->date_end->isoFormat('DD MMMM YYYY') : '-';
                $value['status'] = !empty($d->status) ? $d->status[0] : 'belum dikonfirmasi';

                array_push($result, $value);
            }
        }

        return $result;
    }
}
