<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Str;
use DB;
use Hash;

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
            'name' => 'admin',
            'email' => 'admin4@gmail.com',
            'password' => Hash::make('123123123'),
            'level' => 2,
        ]);
        DB::table('users')->insert(
        [
            'name' => 'user',
            'email' => 'user3@gmail.com',
            'password' => Hash::make('123123123'),
            'level' => 1,
        ]);
    }
}
