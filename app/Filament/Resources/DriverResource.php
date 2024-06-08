<?php

namespace App\Filament\Resources;

use App\Filament\Resources\DriverResource\Pages;
use App\Filament\Resources\DriverResource\RelationManagers;
use App\Models\Driver;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use Ysfkaya\FilamentPhoneInput\Forms\PhoneInput;

class DriverResource extends Resource
{
    protected static ?string $model = Driver::class;

    protected static ?string $navigationIcon = 'heroicon-s-user';
    protected static ?string $navigationLabel = "Taxi Drivers";
    protected static ?string $navigationGroup = 'User Management';
    protected static ?int $navigationSort = 2;
    protected static ?string $recordTitleAttribute = 'name';

    public static function getNavigationBadge(): ?string
    {
        return Driver::count();
    }

    public static function getGloballySearchableAttributes(): array
    {
        return ['name', 'vehicle.plate_number'];
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Driver Info')->schema([
                        Forms\Components\Grid::make(5)->schema([
                            Forms\Components\Grid::make(1)->schema([
                                Forms\Components\TextInput::make('name')->required()->columnSpan(1),
                                PhoneInput::make('phone')->columnSpan(1),
                                Forms\Components\Toggle::make('is_active')
                                    ->label('Driver Active')
                                    ->onIcon('heroicon-m-check')
                                    ->offIcon('heroicon-m-x-mark')
                                    ->inline(false)
                                    ->default(true),
                            ])->columnSpan(3),
                            Forms\Components\FileUpload::make('image')
                                ->avatar()
                                ->imageEditor()
                                ->maxSize(1024)
                                ->columnSpan(2),
                        ]),
                        Forms\Components\Select::make('association_id')
                            ->relationship('association', 'name')
                            ->native(false)
                            ->preload()
                            ->searchable()
                            ->required()
                            ->columnSpan(2),
                    ])->columns(2)
                ]),

                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Address')->schema([
                        Forms\Components\TextInput::make('address')->columnSpan(2),
                        Forms\Components\TextInput::make('zip'),
                        Forms\Components\TextInput::make('city'),
                        Forms\Components\TextInput::make('country')
                    ])->columns(2),

                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ViewColumn::make('name')
                    ->view('filament.components.user-name-with-image')
                    ->label('Name')
                    ->sortable()
                    ->searchable(),
                Tables\Columns\TextColumn::make('vehicle.plate_number')
                    ->label('Current Taxi(s)')
                    ->searchable()
                    ->sortable()
                    ->toggleable()
                    ->listWithLineBreaks()
                    ->bulleted()
                    ->default('-'),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\TextColumn::make('association.name')
                    ->searchable()
                    ->toggleable()
                    ->sortable(),
                Tables\Columns\IconColumn::make('is_active')
                    ->label('Active')
                    ->boolean(),
            ])
            ->filters([
                Tables\Filters\TernaryFilter::make('is_active')
                    ->label('Active')
                    ->boolean()
                    ->trueLabel('Active')
                    ->falseLabel('Inactive')
                    ->native(false),
                Tables\Filters\SelectFilter::make('association_id')
                    ->relationship('association', 'name')
                    ->label('Association')
                    ->options(fn(): array => ['' => 'All'])
                    ->default('')
                    ->searchable()
                    ->preload(),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make()
                        ->color('primary'),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                    ExportBulkAction::make()
                ]),
                ExportBulkAction::make()
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\TaxiListRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListDrivers::route('/'),
            'create' => Pages\CreateDriver::route('/create'),
            'edit' => Pages\EditDriver::route('/{record}/edit'),
        ];
    }

}
