<?php

namespace App\Enums;

enum Transportation: string
{
    case TAXI = 'taxi';
    case BUS = 'bus';
    case TRAIN = 'train';
    case PLANE = 'plane';
    case SHIP = 'ship';
    case CAR = 'car';
    case BIKE = 'bike';
    case MOTORBIKE = 'motorbike';
    case FERRY = 'ferry';


    public static function toArray(): array
    {
        return array_column(Transportation::cases(), 'value');
    }
}
