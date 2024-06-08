<?php

namespace App\Filament\Resources;

use App\Filament\Resources\AdvertisementHistoryResource\Pages;
use App\Filament\Resources\AdvertisementHistoryResource\RelationManagers;
use App\Models\AdvertisementHistory;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvertisementHistoryResource extends Resource
{
    protected static ?string $model = AdvertisementHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Advertisement';
    protected static ?string $navigationLabel = 'Ads History';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Information')->schema([
                        Forms\Components\Select::make('advertisement_id')
                            ->label('Advertisement')
                            ->options(AdvertisementHistory::getAdvertisementOptions())
                            ->native(false)
                            ->required(),
                        Forms\Components\Select::make('vehicle_id')
                            ->label('Taxi Plate Number')
                            ->relationship('vehicle', 'plate_number')
                            ->required()
                            ->preload()
                            ->searchable(),
                    ]),
                ]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Advertisement Status')->schema([
                        Forms\Components\Toggle::make('status')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->label(fn ($state) => $state ? 'Installed' : 'Removed')
                            ->reactive()
                            ->afterStateUpdated(fn ($state, $set) => $state === false ? $set('end_wrapping_at', now()) : $set('end_wrapping_at', null))
                            ->default(true),
                        Forms\Components\DatePicker::make('start_wrapping_at')
                            ->label('Installed at')
                            ->placeholder('Eg: June 1, 2024')
                            ->native(false)
                            ->required(),
                        Forms\Components\DatePicker::make('end_wrapping_at')
                            ->label('Removed at (optional)')
                            ->placeholder('Eg: June 30, 2024')
                            ->native(false),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('vehicle.plate_number')
                    ->label('Taxi Installed')
                    ->searchable(),
                Tables\Columns\ViewColumn::make('advertisement.name')
                    ->view('filament.resources.advertisement-history-resource')
                    ->label('Advertisement')
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('start_wrapping_at')
                    ->label('Installed at')
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_wrapping_at')
                    ->label('Removed at')
                    ->placeholder('-')
                    ->date()
                    ->searchable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->icon(fn ($record) => ($record->status ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'))
                    ->color(fn ($record) => ($record->status ? 'success' : 'gray'))
                    ->getStateUsing(fn ($record) => ($record->status ? 'Installed' : 'Removed'))
                    ->label('Status'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListAdvertisementHistories::route('/'),
            'create' => Pages\CreateAdvertisementHistory::route('/create'),
            'edit' => Pages\EditAdvertisementHistory::route('/{record}/edit'),
        ];
    }
}
