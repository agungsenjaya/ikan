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
        $c = Invoice::where('status','paid')->count();
        return [
            Stat::make('Total Product', $a),
            Stat::make('Total Invoice', $b),
            Stat::make('Invoice Paid', $c),
        ];
    }
}
