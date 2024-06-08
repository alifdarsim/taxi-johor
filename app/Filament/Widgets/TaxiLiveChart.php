<?php

namespace App\Filament\Widgets;

use Filament\Widgets\ChartWidget;

class TaxiLiveChart extends ChartWidget
{
    protected static ?string $heading = 'Chart';
    protected static ?int $sort = 3;

    protected function getData(): array
    {
        return [
            'datasets' => [
                [
                    'label' => 'Blog posts created',
                    'data' => [5, 10],
                ],
            ],
            'labels' => ['Online', 'Offline'],
        ];
    }

    protected function getType(): string
    {
        return 'pie';
    }

    public function getOnlineTaxi()
    {

    }
}
