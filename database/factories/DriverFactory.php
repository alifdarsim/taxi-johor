<?php

namespace Database\Factories;

use App\Models\Association;
use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Driver>
 */
class DriverFactory extends Factory
{

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // get images from pravatar.cc
        $image = 'https://i.pravatar.cc/200?img=' . $this->faker->numberBetween(1, 70);
        $newName = $this->faker->uuid() . '.jpeg';
        file_put_contents(storage_path('app') . '/public/' . $newName, file_get_contents($image));

        return [
            'name' => $this->faker->name,
            'phone' => $this->faker->phoneNumber,
            'image' => $newName,
            'address' => $this->faker->address,
            'zip' => $this->faker->postcode,
            'city' => $this->faker->city,
            'country' => 'Malaysia',
            'association_id' => $this->faker->numberBetween(1, Association::count()),
        ];
    }
}
