<?php

namespace App\Filament\Resources\InvoiceResource\Pages;

use App\Filament\Resources\InvoiceResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;
use Filament\Infolists\Infolist;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\Section;
use Filament\Infolists\Components\Grid;

use Filament\Forms\Components\Actions\Action;
use Filament\Tables\Columns\ImageColumn;
use Filament\Actions\CreateAction;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\FileUpload;
use App\Models\Confirmation;



class ViewInvoice extends ViewRecord
{
    protected static string $resource = InvoiceResource::class;
    public function infolist(Infolist $infolist): Infolist

    {
    return $infolist
        ->schema([
            Section::make()
            ->schema([
                Grid::make(2)->schema([
            TextEntry::make('code')->label('Invoice Code'),
            TextEntry::make('product.title'),
            TextEntry::make('product.category.title')->label('Category')->badge()
            ->color(fn (string $state): string => match ($state) {
                'ikan tawar' => 'warning',
                'ikan laut' => 'success',
            }),
            TextEntry::make('qty'),
            TextEntry::make('product.unit.symbol')->label('Unit'),
            TextEntry::make('user.name')->label('User'),
            TextEntry::make('status')->label('Status')->badge()
            ->color(fn (string $state): string => match ($state) {
                'unpaid' => 'warning',
                'paid' => 'success',
                'reject' => 'danger',
            }),
            TextEntry::make('created_at')->label('Buy Date'),
            TextEntry::make('total')->formatStateUsing(fn (string $state): string => __(rupiah("{$state}"))),
        ])
        ])
        ]);
}

    protected function getHeaderActions(): array
    {
        $a = Confirmation::where('invoice_id',$this->record->id)->first();
        if ($a) {
            return [
                // 
            ];
        }else{
            return [
            CreateAction::make()->createAnother(false)
        ->model(Confirmation::class)
        ->form([
            FileUpload::make('img')->required(),
            Hidden::make('invoice_id')->default($this->record->id),
            TextInput::make('payment_method')->default($this->record->payment->title)->extraInputAttributes(['readonly' => true])->disabled(true),
            TextInput::make('total')->default($this->record->total)->currencyMask(thousandSeparator: '.',decimalSeparator: ',',precision: 2)->extraInputAttributes(['readonly' => true])->disabled(true),
        ])->successRedirectUrl(route('filament.dashboard.resources.confirmations.index'))
        ];
        }
        
    }
}
