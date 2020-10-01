<?php

use Illuminate\Database\Seeder;

class EmployeesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        return App\Employee::insert([
            'name' => 'Mamat',
            'ktp' => '3210071309880001',
            'sim' => '3210071309880001',
            'umur' => '40',
            'gender' => 'L',
            'phone' => '082123123123',
            'joindate' => '2020-12-12',
            'address' => 'Cikasarung',
            'photo' => 'images/user-icon.png'
        ]);
    }
}
