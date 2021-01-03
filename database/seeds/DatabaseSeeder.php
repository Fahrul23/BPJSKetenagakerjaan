<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([

            UserSeeder::class,
            CategorySeeder::class,
            // ItemSeeder::class,
            ItemPinjamSeeder::class,
            ItemAmbilSeeder::class,

            // PengambilanSeeder::class,
            // PeminjamanSeeder::class,

            // CartPinjamSeeder::class,
            // CartAmbilSeeder::class,


            SetupSql::class
        ]);
    }
}
