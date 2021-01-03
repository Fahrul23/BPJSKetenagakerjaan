<?php

use Illuminate\Database\Seeder;

use App\CartAmbil;

use App\ItemAmbil;
use App\User;

class CartAmbilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $users = User::where('role', 'user')->get();
        $items = ItemAmbil::all();

        for ($i = 0; $i < rand(1, 6); $i++) { 
            $user = $users->random();
            $item = $items->where('stock', '!=', 0)->random();

            $cart = new CartAmbil;
            $cart->user_id      = $user->id;
            $cart->to           = $user->id;
            $cart->item_id      = $item->id;
            $cart->quantity     = rand(1, $item->stock);
            $cart->keterangan   = "Penting";
            $cart->save();

            $item->stock -= $cart->quantity;
            $item->save();
        }

    }
}
