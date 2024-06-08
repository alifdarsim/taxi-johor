<?php

namespace App\Filament\Resources\AdvertisementHistoryResource\Pages;

use App\Filament\Resources\AdvertisementHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditAdvertisementHistory extends EditRecord
{
    protected static string $resource = AdvertisementHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
