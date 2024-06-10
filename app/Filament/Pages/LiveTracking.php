<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;

class LiveTracking extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-map';
    protected static ?string $navigationGroup = 'Tracker';

    protected static string $view = 'filament.pages.live-tracking';


}
