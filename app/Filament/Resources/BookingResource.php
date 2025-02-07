<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Filament\Resources\BookingResource\RelationManagers;
use App\Models\Booking;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class BookingResource extends Resource
{
    protected static ?string $model = Booking::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static function calculatePrice(callable $set, callable $get): void
    {
        $products = $get('products') ?? [];
        $startDate = $get('start_date');
        $endDate = $get('end_date');

        if (empty($products) || !$startDate || !$endDate) {
            $set('price', 0);
            return;
        }

        try {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->startOfDay();
            $numberOfDays = max(1, $startDate->diffInDays($endDate));

            $totalPrice = 0;
            foreach ($products as $product) {
                if (isset($product['product_id'], $product['quantity'])) {
                    $productPrice = Product::find($product['product_id'])->price ?? 0;
                    $totalPrice += $productPrice * $product['quantity'];
                }
            }

            $set('price', $totalPrice * $numberOfDays);
        } catch (\Exception $e) {
            $set('price', 0);
        }
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Select::make('user_id')
                    ->relationship('user', 'username')
                    ->searchable()
                    ->preload()
                    ->columnspanfull()
                    ->required(),

                Forms\Components\Repeater::make('products')
                    ->schema([
                        Forms\Components\Select::make('product_id')
                            ->label('Product')
                            ->options(function () {
                                return Product::query()
                                    ->get()
                                    ->mapWithKeys(function ($product) {
                                        return [
                                            $product->id => "{$product->title} (Rp " . number_format($product->price, 0, ',', '.') . ")"
                                        ];
                                    })
                                    ->toArray();
                            })
                            ->searchable()
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn($set, $get) => static::calculatePrice($set, $get)),

                        Forms\Components\TextInput::make('quantity')
                            ->numeric()
                            ->default(1)
                            ->required()
                            ->live()
                            ->afterStateUpdated(fn($set, $get) => static::calculatePrice($set, $get)),
                    ])
                    ->columnspanfull()
                    ->columns(2)
                    ->addActionLabel('Add Product')
                    ->required()
                    ->live(),

                Forms\Components\DateTimePicker::make('start_date')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn($set, $get) => static::calculatePrice($set, $get)),

                Forms\Components\DateTimePicker::make('end_date')
                    ->required()
                    ->live()
                    ->afterStateUpdated(fn($set, $get) => static::calculatePrice($set, $get)),

                Forms\Components\TextInput::make('price')
                    ->label('Total Price')
                    ->prefix('Rp')
                    ->readOnly()
                    ->formatStateUsing(fn($state) => number_format((float) $state, 0, ',', '.'))
                    ->dehydrateStateUsing(fn($state) => str_replace(',', '', str_replace('.', '', $state)))
                    ->required(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('user.username')
                    ->label('User'),

                Tables\Columns\TextColumn::make('user.phone')
                    ->label('Phone'),

                Tables\Columns\TextColumn::make('products.title')
                    ->label('Products')
                    ->listWithLineBreaks(),

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
                        'confirmed' => 'info',
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\Action::make('updateStatus')
                    ->label('Update Status')
                    ->icon('heroicon-o-check-circle')
                    ->color('success')
                    ->requiresConfirmation()
                    ->modalHeading('Update Booking Status')
                    ->modalDescription('Are you sure you want to update the status of this booking?')
                    ->form([
                        Forms\Components\Select::make('status')
                            ->label('Status')
                            ->options([
                                'pending' => 'Pending',
                                'confirmed' => 'Confirmed',
                                'completed' => 'Completed',
                                'canceled' => 'Canceled',
                                'not returned' => 'Not Returned',
                                'picked up' => 'Picked Up',
                            ])
                            ->required()
                            ->default(function ($record) {
                                return $record->status;
                            })
                    ])
                    ->action(function ($record, array $data): void {
                        $record->update([
                            'status' => $data['status']
                        ]);
                    })
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
