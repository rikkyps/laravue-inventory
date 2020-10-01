<?php

use Illuminate\Database\Seeder;

class SupplierTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return App\Supplier::create([
            'name' => 'bilal',
            'email' => 'bilal@mail.com',
            'phone' => '082345653562',
            'address' => 'Majalengka',
            'shopname' => 'bilalshop',
            'photo' => 'images/shop.png'
        ]);
    }
}
