<?php

namespace Database\Seeders;

use App\Models\Advertisement;
use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class AdvertisementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Advertisement::insert([
            'name' => 'Jom Jalan bersama Traveloka 2022',
            'type' => 'Vehicle Wrapping',
            'image' => '01HZJJG7HB56W5236PZ7ACSH11.jpg',
            'additional_info' => '{"description": "asdasdasdasdasdasdasd\nasda\nsd\nasdasd", "additional_info": "asdasd"}',
        ]);

        Advertisement::insert([
            'name' => 'Xandra Perfume 2022',
            'type' => 'Vehicle Wrapping',
        ]);
    }
}
