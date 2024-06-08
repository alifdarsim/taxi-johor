<?php

namespace App\Filament\Widgets;

use App\Infolists\Components\SingleMarker;
use App\Models\LiveLocation;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\TextEntry;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestTaxiOnline extends BaseWidget
{
    protected static ?int $sort = 2;
    protected static ?string $heading = 'Latest Taxi Update';

    public function table(Table $table): Table
    {
        return $table
            ->poll('5s')
            ->paginated(false)
            ->query(
                // get top 5 from LiveLocation model order by timestamp desc
                LiveLocation::query()->orderBy('timestamp', 'desc')->limit(5)
            )
            ->columns([
                Tables\Columns\TextColumn::make('plate_number')
                    ->weight(FontWeight::SemiBold)
                    ->label('Plate'),
                Tables\Columns\ViewColumn::make('driver')
                    ->view('filament.components.user-name-with-image')
                    ->label('Driver'),
                Tables\Columns\TextColumn::make('timestamp')
                    ->since()
                    ->label('Timestamp'),
            ])
            ->actions([
                Tables\Actions\Action::make('View')
                    ->infolist([
                        Section::make('Last Known Location')
                            ->schema([
                                TextEntry::make('plate_number')
                                    ->label('Taxi Number'),
                                TextEntry::make('timestamp')
                                    ->label('Last Update')
                                    ->dateTime('M j, Y H:i A'),
                            ])
                            ->columns(),
                        // show a map location
                        SingleMarker::make('coordinate')
                            ->label('Location')
                            ->columnSpan(2),
                    ]),


                // show a custom action to view the driver location and open google map
//                ViewAction::make('view')
//                    ->modalHeading('Last Known Location')
//                    ->color('primary')
//                    ->label('View')
////                    ->mountUsing(function (Form $form) {
////                        $form->fill();
////
////                        // ...
////                    })
//                    ->form([
//                        Grid::make(2)->schema([
//                            TextInput::make('plate_number')
//                                ->label('Taxi Number'),
//                            TextInput::make('timestamp')
//                                ->label('Last Update')
//                                ->type('datetime-local'),
//                            SingleMapLocation::make('location')
//                                ->label('Location')
//                                ->columnSpan(2),
//                        ]),
//
//                    ])
            ]);
    }
}
