<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Models\Booking;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditBooking extends EditRecord
{
    protected static string $resource = BookingResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $startDate = \Carbon\Carbon::parse($data['start_date'])->startOfDay();
        $endDate = \Carbon\Carbon::parse($data['end_date'])->startOfDay();
        $numberOfDays = max(1, $startDate->diffInDays($endDate));

        $this->productData = collect($data['products'])->map(function ($item) use ($numberOfDays) {
            $product = Product::find($item['product_id']);
            $pricePerDay = $product->price * $item['quantity'];
            return [
                'product_id' => $item['product_id'],
                'quantity' => $item['quantity'],
                'price' => $pricePerDay * $numberOfDays,
            ];
        })->toArray();

        unset($data['products']);
        return $data;
    }

    protected function afterSave(): void
    {
        // Detach all existing products first
        $this->record->products()->detach();

        // Attach new products with updated data
        foreach ($this->productData as $product) {
            $this->record->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }
    }

    protected function fillForm(): void
    {
        $this->form->fill([
            ...$this->record->toArray(),
            'products' => $this->record->products->map(function ($product) {
                return [
                    'product_id' => $product->id,
                    'quantity' => $product->pivot->quantity,
                ];
            })->toArray(),
        ]);
    }
}
