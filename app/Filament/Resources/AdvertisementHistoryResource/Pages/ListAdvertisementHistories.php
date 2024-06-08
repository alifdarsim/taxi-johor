<?php

namespace App\Filament\Resources\AdvertisementHistoryResource\Pages;

use App\Filament\Resources\AdvertisementHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListAdvertisementHistories extends ListRecords
{
    protected static string $resource = AdvertisementHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
