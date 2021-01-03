<?php

use Illuminate\Database\Seeder;
use App\ItemAmbil;

class ItemAmbilSeeder extends Seeder
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
                'name' => 'Tip Ex',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 9
            ],
            (object)
            [
                'name' => 'Cutter',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Trigonal Clips no.1',
                'unit' => 'kotak',
                'category_id' => 2,
                'stock' => 0
            ],
            (object)[
                'name' => 'Trigonal Clips no.3',
                'unit' => 'kotak',
                'category_id' => 2,
                'stock' => 7
            ],
            (object)[
                'name' => 'Trigonal Clips no.5',
                'unit' => 'kotak',
                'category_id' => 2,
                'stock' => 15
            ],
            (object)[
                'name' => 'Isi Staples Kecil No.10',
                'unit' => 'dus',
                'category_id' => 2,
                'stock' => 23
            ],
            (object)[
                'name' => 'Isi Staples Besar',
                'unit' => 'dus',
                'category_id' => 2,
                'stock' => 16
            ],
            (object)[
                'name' => 'Buku Folio 100 lembar',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 8
            ],
            (object)[
                'name' => 'Buku Folio 200 lembar',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Buku Expedisi',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 0
            ],
            (object)[
                'name' => 'Kertas Fax',
                'unit' => 'rol',
                'category_id' => 2,
                'stock' => 8
            ],
            (object)[
                'name' => 'Kertas Struk Mesin Hitung',
                'unit' => 'rol',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Raut Pensil',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Penggaris Besi 30 cm',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 15
            ],
            (object)[
                'name' => 'Lem Stick',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 83
            ],
            (object)[
                'name' => 'Pan Stand (Pen Meja)',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 18
            ],
            (object)[
                'name' => 'Isi Pen Meja',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 7
            ],
            (object)[
                'name' => 'Pembatas Kertas',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 3
            ],
            (object)[
                'name' => 'Acco',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Staples Kecil  10 Y',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 17
            ],
            (object)[
                'name' => 'Staples Besar',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 4
            ],
            (object)[
                'name' => 'Kertas HVS A 4',
                'unit' => 'rim',
                'category_id' => 2,
                'stock' => 211
            ],
            (object)[
                'name' => 'Kertas Mesin Antrian',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 93
            ],
            (object)[
                'name' => 'Ordner',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 0
            ],
            (object)[
                'name' => 'Binder Clip Kecil No.105',
                'unit' => 'dus',
                'category_id' => 2,
                'stock' => 15
            ],
            (object)[
                'name' => 'Binder Clip  Sedang No. 155',
                'unit' => 'dus',
                'category_id' => 2,
                'stock' => 29
            ],
            (object)[
                'name' => 'Binder Clip  Besar No. 260',
                'unit' => 'dus',
                'category_id' => 2,
                'stock' => 17
            ],
            (object)[
                'name' => 'Stamp Pad',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Tinta Stempel Artline',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 4
            ],
            (object)[
                'name' => 'Pembolong Besar',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Pensil 2B',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 37
            ],
            (object)[
                'name' => 'Isi Pensil',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 10
            ],
            (object)[
                'name' => 'Business File F4',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 18
            ],
            (object)[
                'name' => 'Sheet Protector F4 Binder',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 20
            ],
            (object)[
                'name' => 'Pulpen Bresco Ball Liner',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 13
            ],
            (object)[
                'name' => 'Pulpen Gel Kenko',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 45
            ],
            (object)[
                'name' => 'Pulpen Foster / Bolpenku',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 84
            ],
            (object)[
                'name' => 'Pulpen Gel Liner Ink',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 25
            ],
            (object)[
                'name' => 'Spidol Hitam Kecil',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 54
            ],
            (object)[
                'name' => 'Spidol Art Line n 70',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 12
            ],
            (object)[
                'name' => 'Spidol  White Bord',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 3
            ],
            (object)[
                'name' => 'Stabilo',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 12
            ],
            (object)[
                'name' => 'Box File',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Lakban Coklat',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Lakban Hitam Besar',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Lakban Hitam Kecil',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Double Tape',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Isolasi kecil',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Kwitansi',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 4
            ],
            (object)[
                'name' => 'Gunting',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 5
            ],
            (object)[
                'name' => 'Gunting Sedang',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 3
            ],
            (object)[
                'name' => 'Buku Doble Folio',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Baterai Alkaline A2',
                'unit' => 'buah',
                'category_id' => 1,
                'stock' => 1
            ],
            (object)[
                'name' => 'Baterai Alkaline A3',
                'unit' => 'buah',
                'category_id' => 1,
                'stock' => 2
            ],
            (object)[
                'name' => 'Baterai Alkaline 9V',
                'unit' => 'buah',
                'category_id' => 1,
                'stock' => 4
            ],
            (object)[
                'name' => 'Baterai ABC',
                'unit' => 'buah',
                'category_id' => 1,
                'stock' => 1
            ],
            (object)[
                'name' => 'Label Komputer',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 0
            ],
            (object)[
                'name' => 'Post it MMS 655P Joyko',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 8
            ],
            (object)[
                'name' => 'Post it TF 654-1',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => '12'
            ],
            (object)[
                'name' => 'Post it TF 654-8c',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 11
            ],
            (object)[
                'name' => 'Post it TF 656-1',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 4
            ],
            (object)[
                'name' => 'Penghapus Pensil',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 9
            ],
            (object)[
                'name' => 'Penghapus Pensil wb',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 3
            ],
            (object)[
                'name' => 'Tape Dispenser',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 0
            ],
            (object)[
                'name' => 'Map Gantung',
                'unit' => 'pack',
                'category_id' => 2,
                'stock' => 13
            ],
            (object)[
                'name' => 'Lem UHU',
                'unit' => 'pcs',
                'category_id' => 2,
                'stock' => 3
            ],
            (object)[
                'name' => 'bolpoin quaco',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 11
            ],
            (object)[
                'name' => 'bolpoin diamond',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 34
            ],
            (object)[
                'name' => 'F.D Toshiba Hayabusa 8GB',
                'unit' => 'buah',
                'category_id' => 1,
                'stock' => 0
            ],
            (object)[
                'name' => 'Lem Foks Besar',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Map Plastik',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 39
            ],
            (object)[
                'name' => 'Amplop Polos',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Bolpoin CT Pen Laser',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 4
            ],
            (object)[
                'name' => 'Formulir 1 (PU)',
                'unit' => 'buku',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Formulir  1a (PU)',
                'unit' => 'buku',
                'category_id' => 2,
                'stock' => 21
            ],
            (object)[
                'name' => 'Formulir 1b (PU)',
                'unit' => 'buku',
                'category_id' => 2,
                'stock' => 100
            ],
            (object)[
                'name' => 'Formulir 1 (BPU)',
                'unit' => 'buku',
                'category_id' => 2,
                'stock' => 721
            ],
            (object)[
                'name' => 'Formukir 1a (BPU)',
                'unit' => 'buku',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Formulir 1b (BPU)',
                'unit' => 'buku',
                'category_id' => 2,
                'stock' => 3
            ],
            (object)[
                'name' => 'Formulir 2 (PU)',
                'unit' => 'buku',
                'category_id' => 2,
                'stock' => 10
            ],
            (object)['name' => 'Formulir 2a (PU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 17],
            (object)['name' => 'Formulir 2  (BPU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Formulir 2a (BPU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 21],
            (object)['name' => 'F 3 KK 1    (lembar Pertama)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 10],
            (object)['name' => 'F 3 KK 1    (lembar Kedua)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'F 3a KK 2  (lembar Pertama)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 7],
            (object)['name' => 'F 3a KK 2  (lembar Kedua)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'F 3b KK 3  (lembar Pertama)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'F 3b KK 3  (lembar Kedua)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Formulir  1 PN', 'unit' => 'buku', 'category_id' => 2, 'stock' => 3],
            (object)['name' => 'Formulir  4', 'unit' => 'buku', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Formulir  5', 'unit' => 'buku', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Daftar Harga unit Upah TK', 'unit' => 'buku', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Pendaftaran Proyek', 'unit' => 'buku', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Form Bukti Penerimaan Iuran Bank BJB', 'unit' => 'buku', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Pernyataan Berhenti Bekerja', 'unit' => 'rim', 'category_id' => 2, 'stock' => 6],
            (object)['name' => 'Pernyataan Koreksi Hilang KPJ/KPA', 'unit' => 'rim', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Blangko Permintaan Duplikat Kartu Peserta', 'unit' => 'rim', 'category_id' => 2, 'stock' => 9],
            (object)['name' => 'Kop Surat A 4', 'unit' => 'rim', 'category_id' => 2, 'stock' => 74],
            (object)['name' => 'Amplop Putih logo+ Alamat kantor', 'unit' => 'dus', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Amplop Putih Kaca Logo+Alamat Kantor', 'unit' => 'dus', 'category_id' => 2, 'stock' => 68],
            (object)['name' => 'Amplop Cok Kantong sedang', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 189],
            (object)['name' => 'Ampl Cok 1/2 folio', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 189],
            (object)['name' => 'Amplop  Cok Folio', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 188],
            (object)['name' => 'Amplop  Cok kantong besar', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 188],
            (object)['name' => 'Bk Disposisi', 'unit' => 'buku', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Map  Perusahaan BPJS Ketenagakerjaan', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 257],
            (object)['name' => 'Map BPJS Ketenagakerjaan (Putih)', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 620],
            (object)['name' => 'Kartu Pengenal', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Lembar Ceklist Pengajuan JHT', 'unit' => 'rim', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Surat Permohonan Tenaga Kerja Mandiri', 'unit' => 'buku', 'category_id' => 2, 'stock' => 15],
            (object)['name' => 'Form Permintaan Penggabungan Saldo', 'unit' => 'rim', 'category_id' => 2, 'stock' => 3],
            (object)['name' => 'Berita Acara Kunjungan', 'unit' => 'buku', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Lembar Peminjam Arsip FAB & LPK', 'unit' => 'buku', 'category_id' => 2, 'stock' => 7],
            (object)['name' => 'Formulir   1 (PU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 40],
            (object)['name' => 'Formukir  1a (PU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 60],
            (object)['name' => 'Formulir   1b (PU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 3],
            (object)['name' => 'Formulir 2  (PU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 5],
            (object)['name' => 'Formulir 2a (PU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 29],
            (object)['name' => 'Formulir   1 (BPU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 14],
            (object)['name' => 'Formulir 2  (BPU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 8],
            (object)['name' => 'Formulir 2a (BPU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 4],
            (object)['name' => 'Formulir 2  (BPU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 4],
            (object)['name' => 'Formulir 2a (BPU)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 4],
            (object)['name' => 'Form 1 Jakon', 'unit' => 'buku', 'category_id' => 2, 'stock' => 110],
            (object)['name' => 'Form 1a Jakon', 'unit' => 'buku', 'category_id' => 2, 'stock' => 40],
            (object)['name' => 'Form 4', 'unit' => 'buku', 'category_id' => 2, 'stock' => 3],
            (object)['name' => 'Form 5', 'unit' => 'buku', 'category_id' => 2, 'stock' => 110],
            (object)['name' => 'Form 7a', 'unit' => 'buku', 'category_id' => 2, 'stock' => 17],
            (object)['name' => 'Form 7b', 'unit' => 'buku', 'category_id' => 2, 'stock' => 17],
            (object)['name' => 'Form 7 (hal 1 dan 2)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 17],
            (object)['name' => 'Form 3 KK1 (hal 1 dan 2)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Form 3a KK2 (hal 1 dan 2)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 31],
            (object)['name' => 'Form 3b KK3 (hal 1 dan 2)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 15],
            (object)['name' => 'Form 3a PAK2 (hal 1 dan 2)', 'unit' => 'buku', 'category_id' => 2, 'stock' => 26],
            (object)['name' => 'Form 3b PAK3', 'unit' => 'buku', 'category_id' => 2, 'stock' => 11],
            (object)['name' => 'Form 3b PAK 3', 'unit' => 'buku', 'category_id' => 2, 'stock' => 17],
            (object)['name' => 'Form 3 PAK 1', 'unit' => 'buku', 'category_id' => 2, 'stock' => 29],
            (object)['name' => 'Form lampiran tambahan 3,3a,3b', 'unit' => 'buku', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Form Kendali JKK tahap 1', 'unit' => 'buku', 'category_id' => 2, 'stock' => 7],
            (object)['name' => 'Form Kendali JKK tahap 2', 'unit' => 'buku', 'category_id' => 2, 'stock' => 10],
            (object)['name' => 'Form Kendali JKM', 'unit' => 'buku', 'category_id' => 2, 'stock' => 10],
            (object)['name' => 'Form Kendali TC', 'unit' => 'buku', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Form Keterangan Ahli Waris', 'unit' => 'buku', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Form Keterangan Wali Anak', 'unit' => 'buku', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Form Manfaat Beasiswa', 'unit' => 'buku', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Map berkop Coorporate', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Map Perusahaan Coorporate', 'unit' => 'lembar', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Kartu Nama Karyawan', 'unit' => 'box', 'category_id' => 2, 'stock' => '0'],
            (object)['name' => 'Amplop Kabinet Disnaker', 'unit' => 'pack', 'category_id' => 2, 'stock' => 17],
            (object)['name' => 'Cont Form  9 1/2 x 11 1 Ply', 'unit' => 'box', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Cont Form  9 1/2 x 11 1 Ply',  'unit' => 'box', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Cont Form  9 1/2 x 11  2 Ply',  'unit' => 'box', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Tinta Doku Print CP305d Black',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Doku Print CP305d Cyan',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Doku Print CP305d Magenta',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Doku Print CP305d Yellow',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta Hp 802 Black',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Hp 802 Warna',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Epson T664 Black',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Epson T664 Cyan',  'unit' => 'buah', 'category_id' => 2, 'stock' => 3],
            (object)['name' => 'Tinta Epson T664 Magenta',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Epson T664 Yellow',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta Epson T673 Black',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Epson T673 cyan',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Epson T673  magenta',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta Epson T673  Yellow',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta Epson T6735 cyan muda',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta Epson T6736  magenta muda',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta Laser Jet 125A Black',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Laser Jet 125A Magenta',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Laser Jet 125A Cyan',  'unit' => 'buah', 'category_id' => 2, 'stock' => 1],
            (object)['name' => 'Tinta Laser Jet 125A Yellow',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta Laser Jet 05A',  'unit' => 'buah', 'category_id' => 2, 'stock' => 2],
            (object)['name' => 'Tinta Laser Jet 80A',  'unit' => 'buah', 'category_id' => 2, 'stock' => 3],
            (object)['name' => 'Tinta 920 black',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta 920 cyan',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta 920 yellow',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Tinta 920 magenta',  'unit' => 'buah', 'category_id' => 2, 'stock' => 0],
            (object)['name' => 'Pita  Epson LQ 2190',  'unit' => 'box', 'category_id' => 2, 'stock' => 1],
            (object)[
                'name' => 'Tinta Brother BT 5000 Magenta',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Tinta Brother BT 5000 Cyan',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Tinta Brother BT 5000 Yellow',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Tinta Brother BT D60 Black',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Tinta L3110 Black',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Tinta L3110 Cyan',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Tinta L3110 Magenta',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Tinta L3110 Yellow',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Tinta Fotocopy',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'HD EXTERNAL 4 TB',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 0
            ],
            (object)[
                'name' => 'Flash Disk HP Silver 64',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 6
            ],
            (object)[
                'name' => 'Ink Print Cartridge Black C 2550s',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
            (object)[
                'name' => 'Ink Print Cartridge Cyan C 2550s',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 1
            ],
            (object)[
                'name' => 'Ink Print Cartridge Magenta C 2550s',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 4
            ],
            (object)[
                'name' => 'Ink Print Cartridge Yellow C 2550s',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 3
            ],
            (object)[
                'name' => 'Laser Jet 26A HP',
                'unit' => 'buah',
                'category_id' => 2,
                'stock' => 2
            ],
        ];

        $image = 'item-image/default-item.svg';
        foreach ($barang as $item) {
            $item_model = new ItemAmbil;
            $item_model->name = $item->name;
            $item_model->unit = $item->unit;
            $item_model->category_id = $item->category_id;
            $item_model->stock = $item->stock;
            $item_model->image = $image;
            $item_model->unique_id = $item_model->uniqueId();

            $item_model->save();
        }
    }
}
