<?php

namespace App\Filament\Widgets;

use Filament\Widgets\TableWidget as BaseWidget;
use Filament\Tables;
use Filament\Tables\Table;
use App\Models\Booking;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms;

class BookingTableWidget extends BaseWidget
{
    protected int|string|array $columnSpan = 'full';

    public function table(Table $table): Table
    {
        return $table
            ->query(Booking::query()->latest())
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('User'),

                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Phone'),

                Tables\Columns\TextColumn::make('products')
                    ->label('Products')
                    ->badge()
                    ->getStateUsing(function ($record) {
                        return $record->products->map(function ($product) {
                            $price = number_format($product->pivot->price, 0, ',', '.');
                            return "{$product->title} (Qty: {$product->pivot->quantity}) - Rp {$price}";
                        })->toArray();
                    })
                    ->colors([
                        'primary',
                    ]),

                Tables\Columns\TextColumn::make('start_date')
                    ->label('Start Date')
                    ->dateTime('l, d F Y'),

                Tables\Columns\TextColumn::make('end_date')
                    ->label('End Date')
                    ->dateTime('l, d F Y'),

                Tables\Columns\TextColumn::make('price')
                    ->label('Total Price')
                    ->formatStateUsing(fn($state) => 'Rp ' . number_format($state, 0, ',', '.')),

                Tables\Columns\TextColumn::make('status')
                    ->badge()
                    ->color(fn(string $state): string => match ($state) {
                        'pending' => 'warning',
                        'confirmed' => 'success',
                        'completed' => 'success',
                        'canceled' => 'danger',
                        'not returned' => 'danger',
                        'picked up' => 'info',
                        default => 'secondary',
                    })
                    ->formatStateUsing(fn(string $state): string => ucfirst($state)),
            ])
            ->filters([
                Tables\Filters\SelectFilter::make('status')
                    ->label('Status')
                    ->options([
                        'pending' => 'Pending',
                        'confirmed' => 'Confirmed',
                        'completed' => 'Completed',
                        'canceled' => 'Canceled',
                        'not returned' => 'Not Returned',
                        'picked up' => 'Picked Up',
                    ]),
                Tables\Filters\Filter::make('booking_date_range')
                    ->form([
                        Forms\Components\DatePicker::make('from')->label('From'),
                        Forms\Components\DatePicker::make('to')->label('To'),
                    ])
                    ->query(function (Builder $query, array $data): Builder {
                        return $query
                            ->when(
                                $data['from'],
                                fn(Builder $query, $date): Builder => $query->whereDate('start_date', '>=', $date)
                            )
                            ->when(
                                $data['to'],
                                fn(Builder $query, $date): Builder => $query->whereDate('start_date', '<=', $date)
                            );
                    }),
            ])
            ->actions([
                // 
            ]);
    }
}
