<?php

namespace App\Filament\Widgets;

use Filament\Tables;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Product;
use Closure;
use Illuminate\Support\Str;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\Action;


class LatestProducts extends BaseWidget
{
    protected int | string | array $columnSpan = 'full';

    protected function getTableQuery(): Builder
    {
        return Product::query()->latest();
    }

    protected function getTableColumns(): array
    {
                return [
                    ImageColumn::make('img'),
            Tables\Columns\TextColumn::make('title')->searchable(),
            Tables\Columns\TextColumn::make('category.title')->badge()
            ->color(fn (string $state): string => match ($state) {
                'ikan tawar' => 'warning',
                'ikan laut' => 'success',
            }),
            Tables\Columns\TextColumn::make('unit.symbol'),
            Tables\Columns\TextColumn::make('stock')->state(function ($record){
                $a = 0;
                $b = $record->stocks;
                if ($b) {
                    foreach ($b as $req) {
                        $a += $req->qty;
                    };
                }
                $c = 0;
                $d = $record->invoices;
                if ($d) {
                    foreach ($d as $req) {
                        $c += $req->qty;
                    };
                }
                return $a - $c;
            }),
            Tables\Columns\TextColumn::make('price')->formatStateUsing(fn (string $state): string => __(rupiah("{$state}"))),
        ];
    }

    protected function getTableActions() :array
    {
        return [
                    Action::make('buy')
    ->url(fn (Product $record): string => route('filament.dashboard.resources.products.buy', $record))
    
        ];
    }
}