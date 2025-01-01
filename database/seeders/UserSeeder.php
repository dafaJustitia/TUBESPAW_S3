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
                'name' => 'Devies',
                'email' => 'deviesade@gmail.com',
                'password' => bcrypt('123456'),
                'avatar_url' => null
            ],
            [
                'name' => 'Administator',
                'email' => 'admin@gmail.com',
                'password' => bcrypt('123456'),
                'avatar_url' => null
            ]
            
        ]);
    }
}
