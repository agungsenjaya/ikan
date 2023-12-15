<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ProductResource\Pages;
use App\Filament\Resources\ProductResource\RelationManagers;
use App\Models\Product;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\MorphToSelect;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables\Columns\Summarizers\Sum;
use Filament\Tables\Columns\ImageColumn;



class ProductResource extends Resource
{
    protected static ?string $model = Product::class;
    protected static ?string $inverseRelationship = 'company';

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('title')->unique(table: Product::class)->live()->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))->required(),
                TextInput::make('title')->live()->afterStateUpdated(fn (Set $set, ?string $state) => $set('slug', Str::slug($state)))->required(),
                Select::make('category_id')->relationship(name: 'category', titleAttribute: 'title')->required()->preload(),
                TextInput::make('price')->currencyMask(thousandSeparator: '.',decimalSeparator: ',',precision: 2)->required(),
                Select::make('unit_id')->relationship(name: 'unit', titleAttribute: 'title')->required()->preload(),
                Textarea::make('description')->required()->columnSpanFull(),
                FileUpload::make('img')->required()->columnSpanFull(),    
                Hidden::make('slug')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
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
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
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
            'index' => Pages\ListProducts::route('/'),
            'create' => Pages\CreateProduct::route('/create'),
            'edit' => Pages\EditProduct::route('/{record}/edit'),
            'buy' => Pages\BuyProduct::route('/{record}/buy'),
        ];
    }
}
