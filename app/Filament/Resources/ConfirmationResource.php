<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ConfirmationResource\Pages;
use App\Filament\Resources\ConfirmationResource\RelationManagers;
use App\Models\Confirmation;
use App\Models\Invoice;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Select;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;


class ConfirmationResource extends Resource
{
    protected static ?string $model = Confirmation::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // 
            ]);
    }

    public static function table(Table $table): Table
    {
        // $a = $this->record->invoice->status;
        $a = null;
        if (auth()->id() == 1) {
            $a = [
                ImageColumn::make('img')->simpleLightbox(),
                Tables\Columns\TextColumn::make('invoice.user.name')->label('User')->searchable(),
                Tables\Columns\TextColumn::make('invoice.code')->label('Invoice Code')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Confirm Date'),
                Tables\Columns\TextColumn::make('invoice.payment.title')->label('Payment'),
                Tables\Columns\TextColumn::make('invoice.total')->formatStateUsing(fn (string $state): string => __(rupiah("{$state}")))->label('Total'),
                Tables\Columns\TextColumn::make('invoice.status')->label('Action')->action(
                    Action::make('updateConfirmation')
    ->fillForm(fn (Confirmation $record): array => [
            'status' => $record->invoice->status,
        ])->form([
            Select::make('status')->label('Status')->options([
                        'paid' => 'paid',
                        'unpaid' => 'unpaid',
                        'reject' => 'reject',
                    ])->required(),
    ])
    ->action(function (array $data, Confirmation $record): void {
            $a = Invoice::find($record->invoice_id);
            $a->status = $data['status'];
            $a->save();
            if ($a) {
                Notification::make()
                ->title('Confirmation success')
                ->success()
                ->send(); 
            }
    })
),
];
        }else{

            $a = [
                ImageColumn::make('img')->simpleLightbox(),
                Tables\Columns\TextColumn::make('invoice.user.name')->label('User')->searchable(),
                Tables\Columns\TextColumn::make('invoice.code')->label('Invoice Code')->searchable(),
                Tables\Columns\TextColumn::make('created_at')->label('Confirm Date'),
                Tables\Columns\TextColumn::make('invoice.payment.title')->label('Payment'),
                Tables\Columns\TextColumn::make('invoice.total')->formatStateUsing(fn (string $state): string => __(rupiah("{$state}")))->label('Total'),
];

        }
        return $table
            ->columns($a)
            ->filters([
                //
            ])
            ->actions([
            //  
            ])
            ->bulkActions([
                // Tables\Actions\BulkActionGroup::make([
                // Tables\Actions\DeleteBulkAction::make(),
                // ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListConfirmations::route('/'),
            'create' => Pages\CreateConfirmation::route('/create'),
            // 'view' => Pages\ViewConfirmation::route('/{record}'),
            // 'edit' => Pages\EditConfirmation::route('/{record}/edit'),
        ];
    }
}
