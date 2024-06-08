<?php

namespace Database\Seeders;

use App\Models\LiveLocation;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use MatanYadaev\EloquentSpatial\Objects\Point;

class LiveLocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1, 6) as $index) {
            $liveLocation = LiveLocation::where('id', $index)->first();
            $liveLocation->coordinate = $this->getRandomCoordinate();
            $liveLocation->timestamp = $this->randomDateTime();
            $liveLocation->speed = rand(0, 100);
            $liveLocation->accuracy = rand(0, 10);
            $liveLocation->save();
        }
    }

    // get random datetime between now and 30 seconds ago
    public function randomDateTime() : String
    {
        $now = now();
        $secondsAgo = $now->subSeconds(rand(0, 10));
        return Carbon::createFromTimestamp(rand($secondsAgo->timestamp, $now->timestamp), 'Asia/Singapore');
    }

    public function getRandomCoordinate(): Point
    {
        $minLat = 1.4500;
        $maxLat = 1.4800;
        $minLon = 103.7400;
        $maxLon = 103.7700;
        $randomLat = mt_rand($minLat * 1000000, $maxLat * 1000000) / 1000000;
        $randomLon = mt_rand($minLon * 1000000, $maxLon * 1000000) / 1000000;
        return new Point($randomLon, $randomLat);
    }
}
