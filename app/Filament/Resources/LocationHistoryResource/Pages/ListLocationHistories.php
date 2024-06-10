<?php

namespace App\Filament\Resources\LocationHistoryResource\Pages;

use App\Filament\Resources\LocationHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListLocationHistories extends ListRecords
{
    protected static string $resource = LocationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
