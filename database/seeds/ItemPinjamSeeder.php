<?php

use Illuminate\Database\Seeder;
use App\ItemPinjam;
use App\ItemPinjamDetail;


class ItemPinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $barang = [
            (object) [
                'unit' => 'INNOVA PUTIH',
                'category' => 3,
                'jumlah' => 2,
            ],
            (object) [
                'unit' => 'INNOVA HITAM',
                'category' => 3,
                'jumlah' => 2,
            ],
            (object) [
                'unit' => 'AVANZA PUTIH',
                'category' => 3,
                'jumlah' => 2,
            ],
            (object) [
                'unit' => 'AVANZA HITAM',
                'category' => 3,
                'jumlah' => 2,
            ],
            (object) [
                'unit' => 'RUSH PUTIH',
                'category' => 3,
                'jumlah' => 2,
            ],
            (object) [
                'unit' => 'CITY PUTIH',
                'category' => 3,
                'jumlah' => 1,
            ],
            (object) [
                'unit' => 'CITY HITAM',
                'category' => 3,
                'jumlah' => 1,
            ],
            (object) [
                'unit' => 'MOBILIO',
                'category' => 3,
                'jumlah' => 1,
            ],
            (object) [
                'unit' => 'HINO DT 110 SDL',
                'category' => 3,
                'jumlah' => 1
            ],
            (object) [
                'unit' => 'HONDA VARIO',
                'category' => 3,
                'jumlah' => 1
            ],
            (object) [
                'unit' => 'HONDA VERZA',
                'category' => 3,
                'jumlah' => 1
            ],
            (object) [
                'unit' => 'Proyektor Epson Putih',
                'category' => 1,
                'jumlah' => 3
            ],
            (object) [
                'unit' => 'Laptop HP',
                'category' => 1,
                'jumlah' => 4
            ],
            (object) [
                'unit' => 'Laptop Dell',
                'category' => 1,
                'jumlah' => 8
            ],
            (object) [
                'unit' => 'Laptop Samsung',
                'category' => 1,
                'jumlah' => 4
            ],
            (object) [
                'unit' => 'Kamera Nikon',
                'category' => 1,
                'jumlah' => 2
            ],
            (object) [
                'unit' => 'Laser Pointer',
                'category' => 1,
                'jumlah' => 10
            ],
            (object) [
                'unit' => 'Rol Kabel 4 Colokan Bulat',
                'category' => 1,
                'jumlah' => 8
            ],
            (object) [
                'unit' => 'Rol Kabel 4 Colokan Panjang',
                'category' => 1,
                'jumlah' => 8
            ],
            (object) [
                'unit' => 'Printer Epson',
                'category' => 1,
                'jumlah' => 15
            ],
            (object) [
                'unit' => 'Printer Brother',
                'category' => 1,
                'jumlah' => 15
            ],
            (object) [
                'unit' => 'Mesin Scanner Fujitsu',
                'category' => 1,
                'jumlah' => 5
            ],
            (object) [
                'unit' => 'Mesin Penghancur Kertas',
                'category' => 1,
                'jumlah' => 3
            ],
            (object) [
                'unit' => 'Senter Besar',
                'category' => 1,
                'jumlah' => 4
            ],
            (object) [
                'unit' => 'Senter Kecil',
                'category' => 1,
                'jumlah' => 4
            ],
        ];

        $image = 'item-image/default-item.svg';
        foreach ($barang as $key => $value) {
            $item_name = $value->unit;
            $item_name = strtolower($item_name);
            $item_name = Str::title($item_name);

            $pinjam             = new ItemPinjam;

            $pinjam->category_id   = $value->category;
            $pinjam->name       = $item_name;
            $pinjam->image      = $image;

            $pinjam->save();

            for ($i = 0; $i < $value->jumlah; $i++) {
                $pinjam_detail                  = new ItemPinjamDetail;

                $pinjam_detail->item_pinjam_id  = $pinjam->id;
                $pinjam_detail->unique_id       = $pinjam_detail->uniqueID('pinjam');
                $pinjam_detail->name            = $item_name;
                $pinjam_detail->image           = $image;
                $pinjam_detail->status          = '1';
                $pinjam_detail->condition       = 'bagus';

                $pinjam_detail->save();
            }
        }
    }
}
