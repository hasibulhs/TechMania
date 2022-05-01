<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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
        DB::table('users')->insert([
            'first_name'=>'Hasibul',
            'last_name'=>'Hossain',
            'email'=>'hasibulhossainshajeeb@gmail.com',
            'password'=>Hash::make('123456')
        ]);
    }
}
