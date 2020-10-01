<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return App\Category::create([
            'name' => 'New Category',
            'status' => 1
        ]);
    }
}
