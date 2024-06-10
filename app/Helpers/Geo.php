<?php

namespace App\Helpers;

use Geotools\Coordinate\Coordinate;
use Geotools\Distance\Distance;
use Illuminate\Support\Collection;

class Geo
{
    static function getDistanceTravelled($locations): float|int
    {
        $totalDistance = 0;
        for ($i = 1; $i < count($locations); $i++) {
            $coordinate1 = new Coordinate([$locations[$i-1]["latitude"], $locations[$i-1]["longitude"]]);
            $coordinate2 = new Coordinate([$locations[$i]["latitude"], $locations[$i]["longitude"]]);
            $distance = new Distance();
            $distance = $distance->setFrom($coordinate1)->setTo($coordinate2);
            $totalDistance += $distance->in('meters')->flat();
        }

        return $totalDistance;
    }

    public static function getAverageSpeed($locations): float|int
    {
        $speeds = collect($locations)->pluck('speed');
        $speeds = $speeds->filter(fn ($speed) => $speed >= 3);
        $totalSpeed = $speeds->sum();
        $count = $speeds->count();
        return $totalSpeed / $count;
    }

    public static function setDataCollection($locations_data)
    {
        $data = [];
        foreach ($locations_data as $location) {
            $data[] = [
                'latitude' => $location->coordinate->latitude,
                'longitude' => $location->coordinate->longitude,
                'timestamp' => $location->timestamp,
                'speed' => $location->speed,
                'bearing' => $location->bearing,
            ];
        }
        return $data;
    }

}
