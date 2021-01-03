<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $item = [
            [
                'item' => 'Zebra Pen Sarasa Clip 1.0 mm Black',
                'stock' => 25,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593144815.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Pulpen Pilot Frixion',
                'stock' => 65,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593228945.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Pulpen Pilot BPT-P',
                'stock' => 57,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593229161.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Pulpen Pilot Balliner',
                'stock' => 60,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593229238.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Tip-ex Kenko Cair',
                'stock' => 40,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593151961.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Tip-ex Kenko Roller',
                'stock' => 27,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593175885.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 6H',
                'stock' => 13,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593182682.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 5H',
                'stock' => 50,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593183459.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 4H',
                'stock' => 43,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593183538.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 3H',
                'stock' => 10,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593183616.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 2H',
                'stock' => 27,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593184332.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil H',
                'stock' => 32,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593184362.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil F',
                'stock' => 18,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593184414.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil HB',
                'stock' => 40,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593180695.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil B',
                'stock' => 24,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593227654.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 2B',
                'stock' => 10,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593180521.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 3B',
                'stock' => 46,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593228152.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 4B',
                'stock' => 50,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593228182.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 5B',
                'stock' => 34,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593228235.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 6B',
                'stock' => 27,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593228253.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 7B',
                'stock' => 60,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593228274.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castell Pencil 8B',
                'stock' => 46,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593228324.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'STABILO Pensil Mekanik 2B Exam Grade',
                'stock' => 32,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593152585.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Faber Castel Penghapus Pensil EBTA & SPMB Ujian',
                'stock' => 9,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593151891.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Penghapus Staedtler 526 B20 rasoplast',
                'stock' => 18,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593180114.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Penghapus Staedtler 526 B20 rasoplast Black',
                'stock' => 13,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593180179.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Penghapus Staedtler 526 B20 rasoplast Combi',
                'stock' => 27,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593180264.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Penggaris Besi Stainless Steel 20 Cm',
                'stock' => 20,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593151688.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Penggaris Butterfly Plastik 15 Cm',
                'stock' => 20,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593152257.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Penggaris Butterfly Plastik 30 Cm',
                'stock' => 15,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593152335.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'STABILO Boss Original',
                'stock' => 25,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593151617.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Spidol Snowman Whiteboard (Non Permanen)',
                'stock' => 6,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593152160.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Spidol Snowman Warna-Warni',
                'stock' => 19,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593153109.jpeg',
                'kondisi_barang' => 'bagus'
            ],

            [
                'item' => 'Maped Rautan Pengserut Pensil',
                'stock' => 15,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593152724.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Kertas HVS',
                'stock' => 200,
                'type' => 'ambil',
                'category_id' => 2,
                'image' => '1593168169.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Flashdisk Sandisk Cruzer Blade 8 GB',
                'stock' => 10,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593153457.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Flashdisk Sandisk Cruzer Blade 16 GB',
                'stock' => 5,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593153457.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Flashdisk Sandisk Cruzer Blade 32 GB',
                'stock' => 5,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593153457.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Flashdisk Sandisk Cruzer Blade 64 GB',
                'stock' => 2,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593153457.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 3 W',
                'stock' => 7,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593231363.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 4 W',
                'stock' => 25,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593231495.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 5 W',
                'stock' => 30,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593231582.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 6 W',
                'stock' => 40,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593231675.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 7 W',
                'stock' => 14,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593231757.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 8 W',
                'stock' => 39,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593232122.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 9.5 W',
                'stock' => 31,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593232282.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 10 W',
                'stock' => 22,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593232374.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Lampu Led Philips 10.5 W',
                'stock' => 9,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593232438.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Baterai ABC A3',
                'stock' => 26,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593161065.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Baterai ABC A2',
                'stock' => 40,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593230786.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Baterai ABC C',
                'stock' => 14,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593230874.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Baterai ABC D',
                'stock' => 50,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593230996.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Baterai ABC 9V',
                'stock' => 4,
                'type' => 'ambil',
                'category_id' => 1,
                'image' => '1593231127.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'TaffLed Senter LED Torch Multifungsi',
                'stock' => 5,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593153770.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Kabel Penyambung USB / USB Extension 3 Meter Male To Female',
                'stock' => 3,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593153617.png',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Kabel HDD External Usb 30',
                'stock' => 4,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593161276.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'PowerBank Robot RT5800 5200 mAH',
                'stock' => 2,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593229971.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'PowerBank Robot RT7300 6600 mAH',
                'stock' => 6,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593229808.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'PowerBank Robot RT7500 7000 mAH',
                'stock' => 1,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593230079.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'PowerBank Robot RT 130 10000 mAH',
                'stock' => 5,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593161437.png',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'PowerBank Robot RT 20 20000 mAH',
                'stock' => 4,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593230231.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Regency Kipas Angin Tornado',
                'stock' => 7,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593161497.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Everycom X7 Proyektor Mini LED',
                'stock' => 9,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593161558.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Kamera Canon EOS 250D',
                'stock' => 3,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593161716.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Laptop Dell Inspiron 15 3584 Intel Core i3',
                'stock' => 5,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593161767.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Abronix Wired Mouse',
                'stock' => 8,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593161817.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Canon Pixma Home Inkjet Printer Black',
                'stock' => 4,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593162075.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Epson Perfection V39 Photo Scanner',
                'stock' => 5,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593162216.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'TOGO Mesin Laminating A3',
                'stock' => 3,
                'type' => 'pinjam',
                'category_id' => 1,
                'kondisi_barang' => 'bagus',
                'image' => '1593162311.jpeg'
            ],
            [
                'item' => 'Mesin Pemotong Kertas Royal 18 Sheet',
                'stock' => 2,
                'type' => 'pinjam',
                'category_id' => 1,
                'image' => '1593162434.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Papan Tulis',
                'stock' => 1,
                'type' => 'pinjam',
                'category_id' => 2,
                'image' => '1593162606.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'M2000 Scissors',
                'stock' => 12,
                'type' => 'pinjam',
                'category_id' => 2,
                'image' => '1593162927.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Stapler Kenko HD-10D',
                'stock' => 15,
                'type' => 'pinjam',
                'category_id' => 2,
                'kondisi_barang' => 'bagus',
                'image' => '1593163022.jpeg'
            ],
            [
                'item' => 'Veloz',
                'stock' => 3,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1593169347.png',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Honda Brio',
                'stock' => 2,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1597677143.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Suzuki Ignis',
                'stock' => 1,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1597679089.jpeg',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Toyota Corolla Cross',
                'stock' => 2,
                'type' => 'pinjam',
                'category_id' => 3,
                'kondisi_barang' => 'bagus',
                'image' => '1597711545.png'
            ],
            [
                'item' => 'Toyota VellFire',
                'stock' => 3,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1597711764.png',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Toyota Kijang Innova',
                'stock' => 2,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1597711854.png',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Suzuki Nex II',
                'stock' => 1,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1597712997.png',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Yamaha Nmax',
                'stock' => 4,
                'type' => 'pinjam',
                'category_id' => 3,
                'kondisi_barang' => 'bagus',
                'image' => '1597713069.png'
            ],
            [
                'item' => 'Honda Vario 125',
                'stock' => 3,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1597713097.png',
                'kondisi_barang' => 'bagus'
            ],
            [
                'item' => 'Honda Beat',
                'stock' => 2,
                'type' => 'pinjam',
                'category_id' => 3,
                'image' => '1597713130.png',
                'kondisi_barang' => 'bagus'
            ]




        ];

        // $barang_pinjam = array(
        //     1 => array('name' => 'MOBIL INNOVA PUTIH', 'Satuan' => 'Uinit', 'Stok' => '2'),
        //     2 => array('name' => 'MOBIL TOYOTA AVANZA PUTIH', 'Satuan' => 'Uinit', 'Stok' => '2'),
        //     3 => array('name' => 'MOBIL TOYOTA AVANZA HITAM', 'Satuan' => 'Uinit', 'Stok' => '2'),
        //     4 => array('name' => 'MOBIL HONDA CITY PUTIH', 'Satuan' => 'Uinit', 'Stok' => '1'),
        //     5 => array('name' => 'MOBIL INNOVA HITAM', 'Satuan' => 'Uinit', 'Stok' => '2'),
        //     6 => array('name' => 'MOBIL HONDA MOBILIO', 'Satuan' => 'Uinit', 'Stok' => '1'),
        //     7 => array('name' => 'MOBIL TOYOTA RUSH PUTIH', 'Satuan' => 'Uinit', 'Stok' => '2'),
        //     8 => array('name' => 'MOBIL HINO DT 110 SDL', 'Satuan' => 'Uinit', 'Stok' => '1'),
        //     9 => array('name' => 'MOBIL HONDA CITY HITAM', 'Satuan' => 'Uinit', 'Stok' => '1'),
        //     10 => array('name' => 'Sepeda Motor HONDA VARIO', 'Satuan' => 'Uinit', 'Stok' => '1'),
        //     11 => array('name' => 'Sepeda Motor HONDA VERZA CAST WHEEL', 'Satuan' => 'Uinit', 'Stok' => '1'),
        //     12 => array('name' => 'Proyektor Epson Putih', 'Satuan' => 'Uinit', 'Stok' => '3'),
        //     13 => array('name' => 'Laptop HP', 'Satuan' => 'Uinit', 'Stok' => '4'),
        //     14 => array('name' => 'Laptop Dell', 'Satuan' => 'Uinit', 'Stok' => '8'),
        //     15 => array('name' => 'Laptop Samsung', 'Satuan' => 'Uinit', 'Stok' => '4'),
        //     16 => array('name' => 'Kamera Nikon', 'Satuan' => 'Uinit', 'Stok' => '2'),
        //     17 => array('name' => 'Laser Pointer', 'Satuan' => 'Uinit', 'Stok' => '10'),
        //     18 => array('name' => 'Rol Kabel 4 Colokan Bulat', 'Satuan' => 'Uinit', 'Stok' => '8'),
        //     19 => array('name' => 'Rol Kabel 4 Colokan Panjang', 'Satuan' => 'Uinit', 'Stok' => '8'),
        //     20 => array('name' => 'Printer Epson', 'Satuan' => 'Uinit', 'Stok' => '15'),
        //     21 => array('name' => 'Printer Brother', 'Satuan' => 'Uinit', 'Stok' => '15'),
        //     22 => array('name' => 'Mesin Scanner Fujitsu', 'Satuan' => 'Uinit', 'Stok' => '5'),
        //     23 => array('name' => 'Mesin Penghancur Kertas', 'Satuan' => 'Uinit', 'Stok' => '3'),
        //     24 => array('name' => 'Senter Besar', 'Satuan' => 'Uinit', 'Stok' => '4'),
        //     25 => array('name' => 'Senter Kecil', 'Satuan' => 'Uinit', 'Stok' => '4'),
        // );
        
        

        // $barang_ambil = array(
        //     1 => array('name' => 'Tip Ex', 'Satuan' => 'bh', 'Sisa' => '9'),
        //     2 => array('name' => 'Cutter', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     3 => array('name' => 'Trigonal Clips no.1', 'Satuan' => 'ktk', 'Sisa' => '0'),
        //     4 => array('name' => 'Trigonal Clips no.3', 'Satuan' => 'ktk', 'Sisa' => '7'),
        //     5 => array('name' => 'Trigonal Clips no.5', 'Satuan' => 'ktk', 'Sisa' => '15'),
        //     6 => array('name' => 'Isi Staples  Kecil No.10', 'Satuan' => 'dus', 'Sisa' => '23'),
        //     7 => array('name' => 'Isi Staples  Besar', 'Satuan' => 'dus', 'Sisa' => '16'),
        //     8 => array('name' => 'Buku  Folio 100 lembar', 'Satuan' => 'bh', 'Sisa' => '8'),
        //     9 => array('name' => 'Buku  Folio 200 lembar', 'Satuan' => 'bh', 'Sisa' => '2'),
        //     10 => array('name' => 'Buku Expedisi', 'Satuan' => 'bh', 'Sisa' => '0'),
        //     11 => array('name' => 'Kertas  Fax', 'Satuan' => 'rol', 'Sisa' => '8'),
        //     12 => array('name' => 'Kertas  Struk Mesin Hitung', 'Satuan' => 'rol', 'Sisa' => '1'),
        //     13 => array('name' => 'Raut Pensil', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     14 => array('name' => 'Penggaris Besi  30 cm', 'Satuan' => 'bh', 'Sisa' => '15'),
        //     15 => array('name' => 'Lem Stick', 'Satuan' => 'bh', 'Sisa' => '83'),
        //     16 => array('name' => 'Pan Stand (Pen Meja)', 'Satuan' => 'bh', 'Sisa' => '18'),
        //     17 => array('name' => 'Isi Pen Meja', 'Satuan' => 'bh', 'Sisa' => '7'),
        //     18 => array('name' => 'Pembatas Kertas', 'Satuan' => 'bh', 'Sisa' => '3'),
        //     19 => array('name' => 'Acco', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     20 => array('name' => 'Staples Kecil  10 Y', 'Satuan' => 'bh', 'Sisa' => '17'),
        //     21 => array('name' => 'Staples Besar', 'Satuan' => 'bh', 'Sisa' => '4'),
        //     22 => array('name' => 'Kertas HVS A 4', 'Satuan' => 'rim', 'Sisa' => '211'),
        //     23 => array('name' => 'Kertas Mesin Antrian', 'Satuan' => 'bh', 'Sisa' => '93'),
        //     24 => array('name' => 'Ordner', 'Satuan' => 'bh', 'Sisa' => '0'),
        //     25 => array('name' => 'Binder Clip  Kecil No.105', 'Satuan' => 'dus', 'Sisa' => '15'),
        //     26 => array('name' => 'Binder Clip  Sedang No. 155', 'Satuan' => 'dus', 'Sisa' => '29'),
        //     27 => array('name' => 'Binder Clip  Besar No. 260', 'Satuan' => 'dus', 'Sisa' => '17'),
        //     28 => array('name' => 'Stamp Pad', 'Satuan' => 'bh', 'Sisa' => '2'),
        //     29 => array('name' => 'Tinta Stempel Artline', 'Satuan' => 'bh', 'Sisa' => '4'),
        //     30 => array('name' => 'Pembolong Besar', 'Satuan' => 'bh', 'Sisa' => '2'),
        //     31 => array('name' => 'Pensil   2  B', 'Satuan' => 'bh', 'Sisa' => '37'),
        //     32 => array('name' => 'Isi Pensil', 'Satuan' => 'bh', 'Sisa' => '10'),
        //     33 => array('name' => 'Business File F4', 'Satuan' => 'bh', 'Sisa' => '18'),
        //     34 => array('name' => 'Sheet Protector F4 Binder', 'Satuan' => 'bh', 'Sisa' => '20'),
        //     35 => array('name' => 'Pulpen Bresco Ball Liner', 'Satuan' => 'bh', 'Sisa' => '13'),
        //     36 => array('name' => 'Pulpen Gel Kenko', 'Satuan' => 'bh', 'Sisa' => '45'),
        //     37 => array('name' => 'Pulpen Foster / Bolpenku', 'Satuan' => 'bh', 'Sisa' => '84'),
        //     38 => array('name' => 'Pulpen Gel Liner Ink', 'Satuan' => 'bh', 'Sisa' => '25'),
        //     39 => array('name' => 'Spidol  Hitam Kecil', 'Satuan' => 'bh', 'Sisa' => '54'),
        //     40 => array('name' => 'Spidol  Art Line n 70', 'Satuan' => 'bh', 'Sisa' => '12'),
        //     41 => array('name' => 'Spidol  White Bord', 'Satuan' => 'bh', 'Sisa' => '3'),
        //     42 => array('name' => 'Stabilo', 'Satuan' => 'bh', 'Sisa' => '12'),
        //     43 => array('name' => 'Box  File', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     44 => array('name' => 'Lakban   Coklat', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     45 => array('name' => 'Lakban  Hitam Besar', 'Satuan' => 'bh', 'Sisa' => '2'),
        //     46 => array('name' => 'Lakban  Hitam Kecil', 'Satuan' => 'bh', 'Sisa' => '2'),
        //     47 => array('name' => 'Double Tape', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     48 => array('name' => 'Isolasi kecil', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     49 => array('name' => 'Kwitansi', 'Satuan' => 'bh', 'Sisa' => '4'),
        //     50 => array('name' => 'Gunting', 'Satuan' => 'bh', 'Sisa' => '5'),
        //     51 => array('name' => 'Gunting Sedang', 'Satuan' => 'bh', 'Sisa' => '3'),
        //     52 => array('name' => 'Buku  Doble Folio', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     53 => array('name' => 'Baterai Alkaline A2', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     54 => array('name' => 'Baterai Alkaline A3', 'Satuan' => 'bh', 'Sisa' => '2'),
        //     55 => array('name' => 'Baterai Alkaline 9V', 'Satuan' => 'bh', 'Sisa' => '4'),
        //     56 => array('name' => 'Baterai ABC', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     57 => array('name' => 'Label Komputer', 'Satuan' => 'bh', 'Sisa' => '0'),
        //     58 => array('name' => 'Post it MMS 655P Joyko', 'Satuan' => 'bh', 'Sisa' => '8'),
        //     59 => array('name' => 'Post it TF 654-1', 'Satuan' => 'bh', 'Sisa' => '12'),
        //     60 => array('name' => 'Post it TF 654-8c', 'Satuan' => 'bh', 'Sisa' => '11'),
        //     61 => array('name' => 'Post it TF 656-1', 'Satuan' => 'bh', 'Sisa' => '4'),
        //     62 => array('name' => 'Penghapus Pensil', 'Satuan' => 'bh', 'Sisa' => '9'),
        //     63 => array('name' => 'Penghapus Pensil wb', 'Satuan' => 'bh', 'Sisa' => '3'),
        //     64 => array('name' => 'Tape Dispenser', 'Satuan' => 'bh', 'Sisa' => '0'),
        //     65 => array('name' => 'Map Gantung', 'Satuan' => 'pak', 'Sisa' => '13'),
        //     66 => array('name' => 'Lem UHU', 'Satuan' => 'pcs', 'Sisa' => ''),
        //     67 => array('name' => 'bolpoin quaco', 'Satuan' => 'bh', 'Sisa' => '11'),
        //     68 => array('name' => 'bolpoin diamond', 'Satuan' => 'bh', 'Sisa' => '34'),
        //     69 => array('name' => 'F.D Toshiba Hayabusa 8GB', 'Satuan' => 'bh', 'Sisa' => '0'),
        //     70 => array('name' => 'Lem Foks Besar', 'Satuan' => 'bh', 'Sisa' => '1'),
        //     71 => array('name' => 'Map Plastik', 'Satuan' => 'bh', 'Sisa' => '39'),
        //     72 => array('name' => 'Amplop Polos', 'Satuan' => 'bh', 'Sisa' => '2'),
        //     73 => array('name' => 'Bolpoin CT Pen Laser', 'Satuan' => 'bh', 'Sisa' => '4'),
        // );

        foreach ($item as $i) {
            $item = new Item;
            $i['unique_id'] = $item->uniqueID($i['type']);
            Item::create($i);
        }
    }
}
