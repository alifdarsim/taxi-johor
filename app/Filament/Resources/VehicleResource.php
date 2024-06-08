<?php

namespace App\Filament\Resources;

use App\Filament\Resources\VehicleResource\Pages;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class VehicleResource extends Resource
{
    protected static ?string $model = Vehicle::class;
    protected static ?string $navigationIcon = 'fas-car-side';
    protected static ?string $navigationGroup = 'Taxi Management';
    protected static ?string $recordTitleAttribute = 'plate_number';
    protected static ?string $label = 'Taxi List';

    public static function getNavigationBadge(): ?string
    {
        return Vehicle::count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['plate_number', 'drivers.name'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Number Plate')->schema([
                        Forms\Components\TextInput::make('plate_number')
                            ->required()
                            ->label('Create New Taxi Plate Number')
                            ->columnSpan(2)
                            ->afterStateUpdated(function (callable $set, $state) {
                                $set('plate_number', Str::upper($state));
                            })
                            ->live()
                            ->unique(),
                    ])
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Car Type')->schema([
                        //Create a select dropdown with options of cars model and its brands
                        Forms\Components\Select::make('vehicle_type_id')
                            ->relationship('vehicleType')
                            ->getOptionLabelFromRecordUsing(fn (VehicleType $record) => "{$record->brand->name} {$record->model}")
                            ->required()
                            ->label('Car Type')
                            ->columnSpan(2)
                            ->native(false)
                            ->preload()
                            ->searchable(),

                    ])->columns(2),
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Car Image')->schema([
                        Forms\Components\FileUpload::make('image')
                            ->label('Car Image')
                            ->image()
                            ->maxSize(1024),
                    ]),
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Operational Status')->schema([
                        Forms\Components\Toggle::make('is_active')
                            ->label('Still Operational'),
                    ]),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->width(100)
                    ->height(75)
                    ->defaultImageUrl('/no-image-found.png')
                    ->label('Image'),
                TextColumn::make('plate_number'),
                TextColumn::make('vehicleType.model')->label('Model'),
                Tables\Columns\ImageColumn::make('vehicleType.brand.image')->label('Brand'),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Operational')
                    ->boolean(),

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
            'index' => Pages\ListVehicles::route('/'),
            'create' => Pages\CreateVehicle::route('/create'),
            'edit' => Pages\EditVehicle::route('/{record}/edit'),
        ];
    }
}
