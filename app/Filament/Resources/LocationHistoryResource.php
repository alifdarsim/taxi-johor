<?php

namespace App\Filament\Resources;

use App\Filament\Resources\LocationHistoryResource\Pages;
use App\Filament\Resources\LocationHistoryResource\RelationManagers;
use App\Models\LocationHistory;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\DB;

class LocationHistoryResource extends Resource
{
    protected static ?string $model = LocationHistory::class;

    protected static ?string $navigationIcon = 'heroicon-o-map-pin';
    protected static ?string $navigationGroup = 'Tracker';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                //
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('location_date')
                    ->label('Date')
                    ->sortable(),
                Tables\Columns\TextColumn::make('number_plate')
                    ->label('Number Plate')
                    ->sortable(),
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

    public static function getGlobalSearchResultQuery(): Builder
    {
        return static::getModel()::query()
            ->select(DB::raw('DATE(timestamp) as date, number_plate, COUNT(*) as total'))
            ->groupBy('date', 'number_plate');
    }

    public static function getEloquentQuery(): Builder
    {
        // return query where group by date and number_plate
//        $locations = LocationHistory::select(DB::raw('DATE(timestamp) as date, number_plate, COUNT(*) as total'))
//            ->groupBy('date', 'number_plate');
        $locations = LocationHistory::select('location_date', 'number_plate', DB::raw('COUNT(*) as total'))
            ->groupBy('location_date', 'number_plate');
        return $locations;
//        return parent::getEloquentQuery()->groupBy('location_date', 'number_plate');
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
            'index' => Pages\ListLocationHistories::route('/'),
            'create' => Pages\CreateLocationHistory::route('/create'),
            'edit' => Pages\EditLocationHistory::route('/{record}/edit'),
        ];
    }
}
