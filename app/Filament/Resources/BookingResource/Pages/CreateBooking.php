<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Models\Product;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
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

    protected function afterCreate(): void
    {
        foreach ($this->productData as $product) {
            $this->record->products()->attach($product['product_id'], [
                'quantity' => $product['quantity'],
                'price' => $product['price'],
            ]);
        }
    }
}
