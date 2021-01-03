<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $category = [
            ['category' => 'Elektronik'],
            ['category' => 'Alat Tulis'],
            ['category' => 'Kendaraan']
        ];

        foreach ($category as $c) {
            Category::create($c);
        }

    }
}
