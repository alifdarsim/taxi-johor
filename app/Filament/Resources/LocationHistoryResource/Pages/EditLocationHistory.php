<?php

namespace App\Filament\Resources\LocationHistoryResource\Pages;

use App\Filament\Resources\LocationHistoryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditLocationHistory extends EditRecord
{
    protected static string $resource = LocationHistoryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
