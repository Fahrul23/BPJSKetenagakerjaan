<?php

use Illuminate\Database\Seeder;
use App\Pengambilan;
use App\PengambilanDetail;
use App\Item;
use App\User;

class PengambilanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('role', 'user')->first();
        $item = Item::where('type', 'ambil')->get()->random();

        $activity = new Pengambilan;
        $activity->user_id = $user->id;
        $activity->save();

        $activity_detail = new PengambilanDetail;
        $activity_detail->pengambilan_id = $activity->id;
        $activity_detail->items_id = $item->id;
        $activity_detail->quantity = rand(1, $item->stock);
        $activity_detail->save();
    }
}
