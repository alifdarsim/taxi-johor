<?php

namespace App\Filament\Resources\VehicleResource\Pages;

use App\Filament\Resources\VehicleResource;
use App\Models\Vehicle;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\EditRecord;

class EditVehicle extends EditRecord
{
    protected static string $resource = VehicleResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()
                ->before(function (Actions\DeleteAction $action, Vehicle $record) {
                    if ($record->advertisementHistory()->exists()) {
                        Notification::make()
                            ->danger()
                            ->title('Failed to delete!')
                            ->icon('heroicon-o-x-circle')
                            ->body('This taxi has advertisement history. Please delete the advertisement history first.')
                            ->persistent()
                            ->send();
                        // This will halt and cancel the delete action modal.
                        $action->cancel();
                    }
                }),
        ];
    }
}
