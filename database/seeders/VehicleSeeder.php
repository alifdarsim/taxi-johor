<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Vehicle;
use App\Models\VehicleType;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class VehicleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $brands = [[
            'name' => 'Proton',
            'image' => 'proton.png'
        ],
        [
            'name' => 'Perodua',
            'image' => 'perodua.png'
        ], [
            'name' => 'Toyota',
            'image' => 'toyota.webp'
        ], [
            'name' => 'Nissan',
            'image' => 'nissan.webp'
        ], [
            'name' => 'Hyundai',
            'image' => 'hyundai.webp'
        ], [
            'name' => 'Honda',
            'image' => 'honda.webp'
        ]];
        Brand::insert($brands);

        VehicleType::insert([
            'brand_id' => 1,
            'transportation' => 'Taxi',
            'model' => 'Saga',
        ]);

        VehicleType::insert([
            'brand_id' => 1,
            'transportation' => 'Taxi',
            'model' => 'Persona',
        ]);

        VehicleType::insert([
            'brand_id' => 2,
            'transportation' => 'Taxi',
            'model' => 'Bezza',
        ]);

        VehicleType::insert([
            'brand_id' => 2,
            'transportation' => 'Taxi',
            'model' => 'Vios',
        ]);

        VehicleType::insert([
            'brand_id' => 3,
            'transportation' => 'Taxi',
            'model' => 'Almera',
        ]);

        Vehicle::insert([
            'vehicle_type_id' => 1,
            'plate_number' => 'HWC2012',
            'image' => 'HWC2012.jpeg',
        ]);

        Vehicle::insert([
            'vehicle_type_id' => 2,
            'plate_number' => 'JHU4555',
            'image' => 'JHU4555.jpg',
        ]);

        Vehicle::insert([
            'vehicle_type_id' => 1,
            'plate_number' => 'KLM3223',
        ]);
    }
}
