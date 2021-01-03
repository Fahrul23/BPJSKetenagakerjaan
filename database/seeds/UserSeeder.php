<?php

use App\User;
use Faker\Factory as Faker;

use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // ini akun punya arsal
        // $user = User::create([
        //     'name' => 'Arsal',
        //     'email' => 'arsalgrakhman@example.com',
        //     'password' => Hash::make("lydia1??"),
        //     'role' => 'admin',
        // ]);
        //=========================================

        // ini akun punya binta

        // $user = User::create([
        //     'name' => 'Binta Agung',
        //     'email' => 'binta@example.com',
        //     'password' => Hash::make("binta12345"),
        //     'role' => 'admin',
        // ]);

        // $user = User::create([
        //     'name' => 'Binta Agung Putra',
        //     'email' => 'bintaagungputra@example.com',
        //     'password' => Hash::make("binta12345"),
        //     'role' => 'user',
        // ]);

        // $user = User::create([
        //     'name' => 'David',
        //     'email' => 'david@example.com',
        //     'password' => Hash::make("david12345"),
        //     'role' => 'user',
        // ]);
        //========================================= 

        // ini akun punya fahrul
        // $user = User::create([
        //     'name' => 'Fahrul Ihsan',
        //     'email' => 'fahrul@example.com',
        //     'password' => Hash::make("fahrul12345"),
        //     'role' => 'admin',
        // ]);
        //=========================================


        
        // Akun Admin

        $user = User::create([
            'name' => 'Fahrul Ihsan',
            'email' => 'fahrul@example.com',
            'password' => Hash::make("fahrul123"),
            'role' => 'admin',
        ]);

        // Akun User
        $user = User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make("user123"),
            'role' => 'admin',
        ]);

    }
}
