<x-filament-panels::page>
    <div class="">
    <div class="flex gap-3">
        <img src="/storage/{{ $record->img }}" width="250" class="border p-2 rounded-md" alt="">
        <div class="flex justify-between">
        <div class="divide-y space-y-3">
            <div>
                <p class="opacity-50 capitalize">Payment Method :</p>
                <h1 class="capitalize font-bold text-xl">{{ $record->invoice->payment->title }}</h1>
            </div>
            <div class="pt-4">
                <p class="opacity-50 capitalize">Total :</p>
                <h1 class="capitalize font-bold text-xl">{{ rupiah($record->invoice->total) }}</h1>
            </div>
        </div>
    </div>
    </div>
    </div>
</x-filament-panels::page>