<?php

namespace App\Enums;

use Filament\Support\Contracts\HasLabel;

enum AdvertisementEnum: string implements HasLabel
{
    case WRAPPING = 'Vehicle Wrapping';
    case SEAT_STICKER = 'Seat Sticker';
    case DOOR_STICKER = 'Door Sticker';
    public function getLabel(): ?string
    {
        return match ($this) {
            self::WRAPPING => 'Vehicle Wrapping',
            self::SEAT_STICKER => 'Seat Sticker',
            self::DOOR_STICKER => 'Door Sticker',
        };
    }

}
