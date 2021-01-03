<?php

use Illuminate\Database\Seeder;

use App\User;
use App\ItemPinjamDetail;
use App\CartPinjam;

class CartPinjamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::where('role', 'user')->get();
        $items = ItemPinjamDetail::all();

        for ($i = 0; $i < rand(1, 6); $i++) { 
            $user = $users->random();
            $item = $items->where('status', '!=', 0)
                        ->whereNotIn('condition', ['rusak', 'hilang'])
                        ->random();

            $cart = new CartPinjam;
            $cart->user_id      = $user->id;
            $cart->to           = $user->id;
            $cart->item_id      = $item->id;
            $cart->keterangan   = "Untuk dinas luar";
            $cart->date_start   = now();
            $cart->date_end     = now()->addDays(rand(1, 5));
            $cart->save();

            $item->status = '0';
            $item->save();
        }
    }
}
