<?php

namespace App\Filament\Resources\ProductResource\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;
use App\Models\Product;

class ProductWidget extends BaseWidget
{
    protected function getStats(): array
    {
        $a = Product::count();
        $b = Product::where('category_id','1')->count();
        $c = Product::where('category_id','2')->count();
        return [
            Stat::make('Total Product', $a),
            Stat::make('Ikan Tawar', $c),
            Stat::make('Ikan Laut', $b),
        ];
    }
}
