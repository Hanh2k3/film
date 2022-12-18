<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert(
            [[
                'name' => 'chidaika',
                'email' => 'chjcfcaloc2020@gmail.com',
                'password' => bcrypt('123123'),
                'type_user' => 'admin'
            ],
            [
                'name' => 'chi',
                'email' => 'chjcfcaloc@gmail.com',
                'password' => bcrypt('123123'),
                'type_user' => 'user'
            ]]
        );
    }
}
