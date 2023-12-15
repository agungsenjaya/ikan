<?php

namespace App\Filament\Resources\InvoiceResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Invoice;

class InvoiceWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $a = Invoice::count();
        $b = Invoice::where('status','paid')->count();
        $c = Invoice::where('status','unpaid')->count();
        $d = Invoice::where('status','reject')->count();
        return [
            Stat::make('Total Invoice', $a),
            Stat::make('Invoice Paid', $b),
            Stat::make('Invoice Unpaid', $c),
            Stat::make('Invoice Reject', $d),
        ];
    }
}
