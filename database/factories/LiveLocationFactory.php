<?php

namespace Database\Factories;

use App\Models\LiveLocation;
use Illuminate\Database\Eloquent\Factories\Factory;
use MatanYadaev\EloquentSpatial\Objects\Point;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\LiveLocation>
 */
class LiveLocationFactory extends Factory
{
    protected $model = LiveLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $plateNumbers = ['ABC123', 'DEF456', 'GHI789', 'JKL012', 'MNO345', 'PQR678'];
        $driverIds = range(1, 6);
        $minLat = 1.4500;
        $maxLat = 1.4800;
        $minLon = 103.7400;
        $maxLon = 103.7700;

        return [
            'driver_id' => $this->faker->randomElement($driverIds),
            'plate_number' => $this->faker->randomElement($plateNumbers),
            'coordinate' => new Point($this->faker->longitude($minLon, $maxLon), $this->faker->latitude($minLat, $maxLat)),
            'timestamp' => $this->faker->dateTimeBetween('-1 hour', 'now'),
            'speed' => $this->faker->numberBetween(0, 100),
            'accuracy' => $this->faker->numberBetween(0, 10),
        ];
    }
}
