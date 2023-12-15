<?php

namespace App\Filament\Resources\ConfirmationResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Confirmation;

class ConfirmationWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $a = Confirmation::count();
        return [
            Stat::make('Total Confirmation', $a),
        ];
    }
}
