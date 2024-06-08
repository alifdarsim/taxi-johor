<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleTypeResource\Pages;
use App\Filament\Resources\VehicleTypeResource\RelationManagers;
use App\Models\VehicleType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class VehicleTypeResource extends Resource
{
    protected static ?string $model = VehicleType::class;
    protected static ?string $navigationIcon = 'fas-car-on';
    protected static ?string $navigationGroup = 'Taxi Management';
    protected static ?int $navigationSort = 3;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Section::make('Fill New Car Type Information')->columns(2)->schema([
                    Forms\Components\Select::make('brand_id')
                        ->options(VehicleType::getBrands())
                        ->native(false)
                        ->required(),
                    Forms\Components\TextInput::make('model')
                        ->placeholder('Eg: Corolla')
                        ->required(),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('brand.image')
                    ->label('Brand Image'),
                Tables\Columns\TextColumn::make('brand.name')
                    ->label('Brand'),
                Tables\Columns\TextColumn::make('model'),

                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i A')
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
            'index' => Pages\ListVehicleTypes::route('/'),
            'create' => Pages\CreateVehicleType::route('/create'),
            'edit' => Pages\EditVehicleType::route('/{record}/edit'),
        ];
    }
}
