<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'title' => 'Mr.',
            'name' => 'Joseph Opio',
            'username' => 'josephopio',
            'email' => 'hi@josephopio.com',
            'email_verified_at' => now(),
            'password' => Hash::make('lovedone16'),
            'gender' => 'M',
            'dob' => '1996-01-01',
            'age' => 25,
            'religion' => 1,
            'address_1' => 'Kampala, Uganda',
            'address_2' => 'Kampala, Uganda',
            'image' => 'https://josephopio.com/images/josephopio.jpg',
            'status' => 1,
        ]);
    }
}
