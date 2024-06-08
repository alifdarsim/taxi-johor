<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\AdvertisementHistoryResource;
use App\Models\AdvertisementHistory;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Enums\IconSize;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class ActiveAdvertisement extends BaseWidget
{
    protected static ?int $sort = 3;
    protected static ?string $heading = 'Active Advertisement';

    public function table(Table $table): Table
    {
        return $table
            ->query(
                AdvertisementHistory::query()->orderBy('created_at', 'desc')->where('status', true)->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('vehicle.plate_number')
                    ->weight(FontWeight::SemiBold)
                    ->label('Taxi Installed'),
                Tables\Columns\ViewColumn::make('advertisement.name')
                    ->view('filament.resources.advertisement-history-resource')
                    ->label('Advertisement'),
                Tables\Columns\TextColumn::make('start_wrapping_at')
                    ->label('Installed at')
                    ->date(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn ($record) => ($record->status ? 'success' : 'gray'))
                    ->getStateUsing(fn ($record) => ($record->status ? 'Active' : 'Removed'))
                    ->label('Status'),
            ])
            ->headerActions([
                Tables\Actions\ViewAction::make('view')
                    ->label('View All')
                    ->iconSize(IconSize::Small)
                    ->color('primary')
                    ->url(AdvertisementHistoryResource::getUrl()),
            ])
            ->paginated(false)
            ->emptyStateHeading('No active advertisement')
            ->emptyStateDescription('Once a taxi is installed with an advertisement, it will be shown here.')
            ->emptyStateIcon('heroicon-o-banknotes');
    }
}
