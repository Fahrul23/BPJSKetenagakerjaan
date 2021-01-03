<?php

use Illuminate\Database\Seeder;
use App\Peminjaman;
use App\PeminjamanDetail;
use App\ItemPinjamDetail;
use App\User;

class PeminjamanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('role', 'user')->get();
        $item = ItemPinjamDetail::all();

        for ($i = 0; $i < rand(1, 10); $i++) {

            $counter = $item->where('status', '!=', '0')->count();

            // var_dump($counter);

            if ( !($counter > 0) ) {
                break;
            }

            $user_current = $user->random();

            $peminjaman = new Peminjaman;
            $peminjaman->user_id = $user_current->id;
            $peminjaman->save();

            for ($i = 0; $i <= rand(1, 2); $i++) {

                $confirmable = rand(0, 1);

                $item_current = $item->where('status', '!=', '0')->random();

                if ($confirmable) {
                    $item_current->status = '0';
                    $item_current->save();
                }

                $peminjaman_detail = new PeminjamanDetail([
                    'items_id' => $item_current->id,
                    'keterangan' => 'Untuk keperluan dinas',
                    'confirmed_at' => $confirmable ? now() : null,
                    'date_start' => now(),
                    'date_end' => now()
                ]);

                $peminjaman->peminjamans()->save($peminjaman_detail);
            }

            $peminjaman_all = $peminjaman->peminjamans;

            foreach ($peminjaman_all as $key => $value) {

                $changeable = rand(0, 1);

                if ($changeable && empty($value->confirmed_at)) {

                    $confirmable = rand(0, 1);

                    $item_current = $item->where('status', '!=', '0')->random();

                    if ($confirmable) {
                        $item_current->status = '0';
                        $item_current->save();
                    }

                    $act = new PeminjamanDetail([
                        'items_id' => $item_current->id,
                        'keterangan' => 'Untuk keperluan dinas',
                        'confirmed_at' => $confirmable ? now() : null,
                        'date_start' => now(),
                        'date_end' => now()
                    ]);

                    $value->peminjaman()->save($act);
                }
            }


            
        }
    }
}
