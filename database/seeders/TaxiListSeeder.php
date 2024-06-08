<?php

namespace Database\Seeders;

use App\Models\Driver;
use App\Models\DriverVehicle;
use App\Models\Vehicle;
use App\Models\TaxiWrapper;
use Illuminate\Database\Seeder;

class TaxiListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Driver::insert([
            'name' => 'Alif Darsim',
            'phone' => '081234567890',
            'address' => 'Jalan Pahlawan No. 1',
            'zip' => '12345',
            'city' => 'Jakarta',
            'country' => 'Indonesia',
            'association_id' => 1,
            'is_active' => 1,
        ]);

        Driver::insert([
            'name' => 'Abu Seman',
            'phone' => '+0155663223',
            'address' => 'Jalan Pahlawan No. 1',
            'zip' => '12345',
            'city' => 'Jakarta',
            'country' => 'Malaysia',
            'association_id' => 3,
            'is_active' => 1,
        ]);

        Vehicle::insert([
            'taxi_type_id' => 1,
            'plate_number' => 'JHU1234',
        ]);

        Vehicle::insert([
            'taxi_type_id' => 2,
            'plate_number' => 'JHU5678',
        ]);

        TaxiWrapper::insert([
            'name' => 'MDC Taxi',
            'taxi_list_id' => 1,
            'design' => '/text/image.png',
            'start_wrapping_at' => '2023-01-01 00:00:00',
            'end_wrapping_at' => '2023-02-01 00:00:00',
        ]);

        DriverVehicle::insert([
            'driver_id' => 1,
            'taxi_list_id' => 1,
        ]);

        DriverVehicle::insert([
            'driver_id' => 1,
            'taxi_list_id' => 2,
        ]);

    }
}
