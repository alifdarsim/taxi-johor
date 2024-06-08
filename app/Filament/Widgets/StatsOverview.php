<?php

namespace App\Filament\Widgets;

use App\Models\Association;
use App\Models\Driver;
use App\Models\Vehicle;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class StatsOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected function getStats(): array
    {
        return [
            Stat::make('Online Taxi', 3),
            Stat::make('Total Taxi Register', Vehicle::count()),
            Stat::make('Total Association', Association::count())
        ];
    }
}
