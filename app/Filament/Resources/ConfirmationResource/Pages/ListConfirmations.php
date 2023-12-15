<?php

namespace App\Filament\Resources\ConfirmationResource\Pages;

use App\Filament\Resources\ConfirmationResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListConfirmations extends ListRecords
{
    protected static string $resource = ConfirmationResource::class;

    // protected function getHeaderActions(): array
    // {
    //     return [
    //         Actions\CreateAction::make(),
    //     ];
    // }

    protected function getHeaderWidgets(): array
    {
        return [
            ConfirmationResource\Widgets\ConfirmationWidget::class,
        ];
    }
}
