@php
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
                $e = $a - $c;
$locale = 'id';
$currency = 'IDR';
$price = $this->record->price;
$fmt = new NumberFormatter($locale, NumberFormatter::CURRENCY);
$formattedPrice = $fmt->formatCurrency($price, $currency);
@endphp
<x-filament-panels::page>
    <div class="divide-y space-y-6">
    <div>
        <img src="/storage/{{ $this->record->img }}" width="200" alt="">
    </div>
    <div class="pt-4">
    <p class="opacity-50">Price :</p>
    <!-- <h1 class="capitalize font-bold text-xl">{{ $this->record->price }}</h1> -->
    <h1 class="capitalize font-bold text-xl">{{ rupiah($this->record->price) }}</h1>
    </div>
    <div class="pt-4 flex justify-between">
        <div>
            <h1 class="capitalize font-bold text-xl">{{ $this->record->title }}</h1>
            <p class="opacity-50 capitalize">{{ $this->record->category->title }}</p>
        </div>
        <div class="flex gap-8 divide-x">
            <div>

                <p class="opacity-50">Stock :</p>
                <h1 class="capitalize font-bold text-xl">{{ $e }}</h1>
            </div>
            <div class="ps-4">

                <p class="opacity-50">Unit :</p>
                <h1 class="capitalize font-bold text-xl">{{ $this->record->unit->symbol }}</h1>
            </div>
        </div>
    </div>
    
    <div class="pt-4">
    <p class="opacity-50 mb-2">Description :</p>    
    <p class="opacity-50">{{ $this->record->description }}</p>    
        </div>
    <form wire:submit.prevent="submit" class="pt-4">
        {{ $this->form }}
        <br/>
        <div>
        <x-filament::button type="submit">
            Buy Product
        </x-filament::button>
        </div>
    </form>
    </div>
</x-filament-panels::page>