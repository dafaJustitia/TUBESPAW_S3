<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Province;

class ProvinceSeeder extends Seeder
{
    public function run()
    {
        $provinces = [
            ['name' => 'Jawa Timur'],
            ['name' => 'Jawa Tengah'],
            ['name' => 'Jawa Barat'],
        ];

        foreach ($provinces as $province) {
            Province::create($province);
        }
    }
}
