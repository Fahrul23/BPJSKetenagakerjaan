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

class LaporanPengembalianExport implements FromArray, ShouldAutoSize, WithHeadings, WithEvents
{
    use Exportable;

    public function __construct(Request $req)
    {
        $this->user = $req->user_name;
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
                $event->getSheet()->getDelegate()->getStyle('A1:I3')->applyFromArray($centerBold);
                $event->sheet->mergeCells('A1:I1');
                $event->sheet->mergeCells('A2:I2');
                $event->sheet->mergeCells('A3:I3');

                // tabel
                $event->getsheet()->getDelegate()->getStyle('A5:I5')->applyFromArray($boldBlueFill);
                $event->getSheet()->getDelegate()->getStyle('A5:I' . $event->sheet->getHighestRow())->applyFromArray($border);
            },
        ];
    }

    public function headings(): array
    {
        return [
            // baris pertama
            [
                'Laporan Pengembalian Barang'
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
                'No. Barang',
                'Barang',
                'Kategori',
                'Tanggal Pengajuan',
                'Tanggal Pinjam',
                'Tanggal Batas Pinjam',
                'Tanggal Pengembalian Barang',
            ]
        ];
    }

    public function array(): array
    {
        $pengembalian = new Peminjaman;
        if (!is_null($this->user)) {
            $pengembalian = $pengembalian->where('users.id', $this->user);
        }
        if (!is_null($this->start)) {
            // dd($this->start);
            $pengembalian = $pengembalian->whereDate('created_at', '>=', $this->start);
        }

        if (!is_null($this->end)) {
            $pengembalian = $pengembalian->whereDate('created_at', '<=', $this->end);
        }

        $pengembalian = $pengembalian->get();

        // return $pengembalian;
        // dd($pengembalian);
        $result = [];

        $i = 1;
        foreach ($pengembalian as $key => $m) {

            $data = $m->peminjamans;
            foreach ($data as $k => $d) {

                $changed = $d->peminjaman;
                $d = !empty($changed) ? $changed : $d;

                if (!empty($d->returned_at))

                    $item = $d->item;
                $value['id'] = $i++;
                $value['name'] = $m->peminjamanable_type == "App\PeminjamanDetail" ?
                    $m->peminjamanable->peminjamanable->user->name :
                    $m->user->name;
                $value['no_barang'] = $item->unique_id;
                $value['barang'] = $item->name;
                $value['kategori'] = $item->item->category->category;
                // $value['keterangan'] = $d->keterangan;
                $value['tanggal_pengajuan'] = !empty($m->created_at) ? $m->created_at->isoFormat('DD MMMM YYYY') : '-';
                $value['tanggal_pinjam'] = !empty($d->date_start) ? $d->date_start->isoFormat('DD MMMM YYYY') : '-';
                $value['tanggal_batas_pinjam'] = !empty($d->date_end) ? $d->date_end->isoFormat('DD MMMM YYYY') : '-';
                $value['tanggal_kembali'] = !empty($d->returned_at) ? $d->returned_at->isoFormat('DD MMMM YYYY') : '-';
                // $value['status'] = !empty($d->status) ? $d->status[0] : 'belum dikonfirmasi';

                array_push($result, $value);
            }
        }

        return $result;
    }
}
