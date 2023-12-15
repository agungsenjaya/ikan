<?php

namespace App\Filament\Resources\ProductResource\Pages;

use Filament\Forms;
use Filament\Resources\Pages\Concerns\InteractsWithRecord;
use App\Filament\Resources\ProductResource;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Resources\Pages\Page;
use Filament\Forms\Form;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Tables\Columns\Summarizers\Sum;
use App\Models\Payment;
use App\Models\Invoice;
use Filament\Forms\Components\Card;
use Filament\Notifications\Notification;

class BuyProduct extends page implements HasForms
{

    use InteractsWithRecord;
    use InteractsWithForms;

    public ?array $data = [];

    protected static string $resource = ProductResource::class;
    protected static string $view = 'filament.resources.product-resource.pages.buy-product';

    public function mount(int | string $record): void
    {
        $this->record = $this->resolveRecord($record);
        $this->form->fill();
        static::authorizeResourceAccess();
    }

    protected function getTableQuery(): Builder
    {
        return Product::where($this->record->id)->first();
    }

    public function form(Form $form): Form
        {
            $a = 0;
                    $b = $this->record->stocks;
                    if ($b) {
                        foreach ($b as $req) {
                            $a += $req->qty;
                        };
                    }

            return $form
                ->schema([
                Hidden::make('code')->default('INV-' . strtoupper(Str::random(5))),
                Hidden::make('user_id')->default(auth()->id()),
                Hidden::make('product_id')->default($this->record->id),
                TextInput::make('qty')->numeric()->maxValue($a)->live()
                ->afterStateUpdated(fn (Set $set, ?string $state) => $set('total', $state * $this->record->price))->required(),
                Select::make('payment_id')->options(Payment::all()->pluck('title', 'id'))->label('Payment Method')->required(),
                TextInput::make('total')->extraInputAttributes(['readonly' => true])->currencyMask(thousandSeparator: '.',decimalSeparator: ',',precision: 2)->label('Total')->required(),
                ])->statePath('data');
        }

    public function submit()
    {
        $buy = Invoice::create($this->form->getState());
        if ($buy) {
            Notification::make()
            ->title('Buy products success')
            ->success()
            ->send();

            return redirect()->to('/dashboard/invoices');
        }
    }
}
