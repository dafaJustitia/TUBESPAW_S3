<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\City;
use App\Models\Province;

class CitySeeder extends Seeder
{
    public function run()
    {
        $cities = [
            ['name' => 'Surabaya', 'province_id' => Province::where('name', 'Jawa Timur')->first()->id],
            ['name' => 'Malang', 'province_id' => Province::where('name', 'Jawa Timur')->first()->id],
            ['name' => 'Semarang', 'province_id' => Province::where('name', 'Jawa Tengah')->first()->id],
            ['name' => 'Solo', 'province_id' => Province::where('name', 'Jawa Tengah')->first()->id],
            ['name' => 'Bandung', 'province_id' => Province::where('name', 'Jawa Barat')->first()->id],
            ['name' => 'Bogor', 'province_id' => Province::where('name', 'Jawa Barat')->first()->id],
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}