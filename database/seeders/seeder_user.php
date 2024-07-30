<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class seeder_user extends Seeder
{
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'User',
            'number' => '+56 9 5555 5555',
            'email' => 'user@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'user2',
            'number' => '+56 9 5555 5556',
            'email' => 'user2@gmail.com',
            'password' => bcrypt('password'),
        ]);
        DB::table('users')->insert([
            'name' => 'admin1',
            'number' => '+56 9 5555 5557',
            'email' => 'admin1@gmail.com',
            'admin_privilegies' => true,
            'password' => bcrypt('password'),
        ]);
    }
}
