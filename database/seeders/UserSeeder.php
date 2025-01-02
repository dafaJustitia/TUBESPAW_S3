<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'dafa',
                'email' => 'dafa@gmail.com',
                'password' => bcrypt('dafa'),
                'avatar_url' => null
            ],
            [
                'name' => 'ayod',
                'email' => 'ayod@gmail.com',
                'password' => bcrypt('ayod'),
                'avatar_url' => null
            ],
            [
                'name' => 'alvyn',
                'email' => 'alvyn@gmail.com',
                'password' => bcrypt('alvyn'),
                'avatar_url' => null
            ],
            [
                'name' => 'dzikri',
                'email' => 'dzikri@gmail.com',
                'password' => bcrypt('dzikri'),
                'avatar_url' => null
            ]
            ,
            [
                'name' => 'Administator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'avatar_url' => null
            ]

        ]);
    }
}
