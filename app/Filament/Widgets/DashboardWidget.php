<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;
use App\Models\Invoice;
use App\Models\Confirmation;

class DashboardWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $a = Product::count();
        $b = Invoice::count();
        $c = Confirmation::count();
        if (auth()->id() == 1) {
            # code...
            return [
                Stat::make('Total Product', $a),
                Stat::make('Total Invoice', $b),
                Stat::make('Total Confirmation', $c),
            ];
        }else{
            return [];
        }
    }
}
