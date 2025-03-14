<?php

namespace App\Filament\Resources\BookingResource\Pages;

use App\Filament\Resources\BookingResource;
use App\Models\Product;
use App\Models\User;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class CreateBooking extends CreateRecord
{
    protected static string $resource = BookingResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if ($data['is_new_customer']) {
            // Create new user
            $user = User::create([
                'email' => $data['email'],
                'firstname' => $data['firstname'],
                'lastname' => $data['lastname'],
                'phone' => $data['phone'],
                'username' => Str::slug($data['firstname'] . '.' . $data['lastname']),
                'password' => bcrypt('zonakamera'),
                'email_verified_at' => now(),
            ]);

            $data['user_id'] = $user->id;
        }

        // Remove form-only fields
        unset(
            $data['is_new_customer'],
            $data['existing_user_id'],
            $data['email'],
            $data['firstname'],
            $data['lastname'],
            $data['phone']
        );

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
