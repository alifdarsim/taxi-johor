<?php

namespace App\Filament\Resources\DriverResource\RelationManagers;

use App\Models\VehicleType;
use Filament\Actions\Action;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;

class TaxiListRelationManager extends RelationManager
{
    protected static string $relationship = 'vehicle';

    protected static ?string $title = 'Driver Vehicle List';

    public function form(Form $form): Form
    {
        return $form
            ->schema([

                Forms\Components\TextInput::make('plate_number')
                    ->required()
                    ->label('Taxi Plate Number')
                    ->columnSpan(2)
                    ->afterStateUpdated(function (callable $set, $state) {
                        $set('plate_number', Str::upper($state));
                    })
                    ->live()
                    ->columnSpan(1)
                    ->unique(ignoreRecord:true),

                Forms\Components\Group::make()->schema([
                    Forms\Components\FileUpload::make('image')
                        ->label('Car Image')
                        ->image()
                        ->maxSize(1024),
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Select::make('vehicle_type_id')
                        ->relationship('vehicleType')
                        ->getOptionLabelFromRecordUsing(fn (VehicleType $record) => "{$record->brand->name} {$record->model}")
                        ->required()
                        ->label('Car Type')
                        ->columnSpan(2)
                        ->native(false)
                        ->preload()
                        ->searchable(),
                    Forms\Components\Toggle::make('is_active')
                        ->inline(false)
                        ->label('Still Operational'),
                ]),



            ]);
    }


    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('plate_number')
            ->columns([
                Tables\Columns\ImageColumn::make('image')
                    ->label('Vehicle Image')
                    ->extraImgAttributes(['class' => 'rounded-lg'])
                    ->defaultImageUrl('/no-image-found.png')
                    ->width('120px')
                    ->height('80px'),
                Tables\Columns\TextColumn::make('plate_number'),
                Tables\Columns\TextColumn::make('is_active')
                    ->label('Operational')
                    ->color(fn ($record) => ($record->is_active ? 'success' : 'danger'))
                    ->icon(fn ($record) => ($record->is_active ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'))
                    ->getStateUsing(fn ($record) => ($record->is_active ? 'Active' : 'Removed'))
                    ->badge(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                 Tables\Actions\AttachAction::make(),
                 Tables\Actions\CreateAction::make()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DetachAction::make(),
            ])
            ->bulkActions([
//                Tables\Actions\BulkActionGroup::make([
//                    Tables\Actions\DeleteBulkAction::make(),
//                ]),
            ]);
    }
}
