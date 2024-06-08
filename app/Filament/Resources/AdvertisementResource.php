<?php

namespace App\Filament\Resources;

use App\Enums\AdvertisementEnum;
use App\Filament\Resources\AdvertisementResource\Pages;
use App\Filament\Resources\AdvertisementResource\RelationManagers;
use App\Models\Advertisement;
use App\Models\Association;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Support\Enums\FontWeight;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class AdvertisementResource extends Resource
{
    protected static ?string $model = Advertisement::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';
    protected static ?string $navigationGroup = 'Advertisement';
    protected static ?string $navigationLabel = 'Advertisement List';

    public static function getNavigationBadge(): ?string
    {
        return Advertisement::count();
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Information')->schema([
                        Forms\Components\TextInput::make('name')
                            ->label('Advertisement Title')
                            ->placeholder('Eg: Jom Raya BEST FM 2020')
                            ->required(),
                        Forms\Components\Textarea::make('description')
                            ->label('Advertisement Description (if any)')
                            ->placeholder('Eg: Mari muat turun aplikasi BEST FM sekarang dan dengar siaran terbaik sepanjang masa!')
                            ->rows(2)
                            ->autosize(),
                        Forms\Components\Textarea::make('details')
                            ->label('Advertisement Description (if any)')
                            ->placeholder('Eg: &#10;Syarikat: Suara Johor Sdn Bhd&#10;PIC: PN. SITI&#10;Telefon: 012-3456789, &#10;Email: ....')
                            ->rows(5)
                            ->autosize(),
                    ]),
                ]),
                Forms\Components\Group::make()->schema([
                    Forms\Components\Section::make('Advertisement')->schema([
                        Forms\Components\Toggle::make('status')
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->label(fn ($state) => $state ? 'Active' : 'Inactive')
                            ->reactive()
                            ->default(true),
                        Forms\Components\Grid::make(1)->schema([
                            Forms\Components\Select::make('type')
                                ->options(AdvertisementEnum::class)
                                ->native(false)
                                ->required(),
                        ]),
                        Forms\Components\FileUpload::make('image')
                            ->label('Design Image')
                            ->image(),
                    ]),
                ]),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable()
                    ->description(fn ($record): string => $record->description ?? 'No description provided')
                    ->sortable(),
                Tables\Columns\TextColumn::make('details')
                    ->getStateUsing(fn ($record) => explode("\n", $record->details))
                    ->listWithLineBreaks()
                    ->searchable()
                    ->size('sm')
                    ->weight(FontWeight::Light)
                    ->sortable(),
                Tables\Columns\ImageColumn::make('image')
                    ->width('200px')
                    ->height('100px')
                    ->defaultImageUrl('/no-image-found.png')
                    ->label('Advertisement Design'),
                Tables\Columns\TextColumn::make('type')
                    ->badge()
                    ->toggleable(isToggledHiddenByDefault: false),
                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->icon(fn ($record) => ($record->status ? 'heroicon-o-check-circle' : 'heroicon-o-x-circle'))
                    ->color(fn ($record) => ($record->status ? 'success' : 'gray'))
                    ->getStateUsing(fn ($record) => ($record->status ? 'Active' : 'Not Active'))
                    ->label('Status'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime('d/m/Y H:i A')
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime('d/m/Y H:i A')
                    ->toggleable(isToggledHiddenByDefault: true),
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
            'index' => Pages\ListAdvertisements::route('/'),
            'create' => Pages\CreateAdvertisement::route('/create'),
            'edit' => Pages\EditAdvertisement::route('/{record}/edit'),
        ];
    }
}
