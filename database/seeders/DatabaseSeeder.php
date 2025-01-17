<?php

namespace Database\Seeders;

use App\Models\LiveLocation;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            VehicleSeeder::class,
            AssociationSeeder::class,
            TaxiListSeeder::class,
            LiveLocationSeeder::class,
            DriverSeeder::class,
        ]);
    }
}
