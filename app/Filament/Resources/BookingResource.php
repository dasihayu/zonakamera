<?php

namespace App\Filament\Resources;

use App\Filament\Resources\BookingResource\Pages;
use App\Models\Booking;
use App\Models\Product;
use Carbon\Carbon;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Http;

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
                    ->columnspanfull()
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
                    ->icon(fn(string $state): ?string => match ($state) {
                        'pending' => 'heroicon-o-clock',
                        'confirmed' => 'heroicon-o-check-circle',
                        'completed' => 'heroicon-o-check',
                        'canceled' => 'heroicon-o-x-circle',
                        'not returned' => 'heroicon-o-exclamation-circle',
                        'picked up' => 'heroicon-o-truck',
                        default => null,
                    })
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
                Tables\Actions\EditAction::make(),
                Tables\Actions\ActionGroup::make([
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
                                    'picked up' => 'Picked Up',
                                ])
                                ->required()
                                ->default(fn($record) => $record->status),
                        ])
                        ->action(fn($record, array $data) => $record->update(['status' => $data['status']])),

                    Tables\Actions\Action::make('sendReminder')
                        ->label('Send Reminder')
                        ->icon('heroicon-o-bell')
                        ->color('warning')
                        ->requiresConfirmation()
                        ->modalHeading('Send Return Reminder')
                        ->modalDescription('Are you sure you want to send a reminder to the customer?')
                        ->action(fn($record) => static::sendReminder($record))
                        ->hidden(fn($record) => $record->status !== 'not returned' || Carbon::parse($record->end_date)->isAfter(today())),
                ])
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

    protected static function sendReminder($record): void
    {
        $message = "Halo, {$record->user->firstname}!\n\n" .
            "Kami ingin mengingatkan bahwa barang yang Anda sewa belum dikembalikan. " .
            "Masa sewa seharusnya berakhir pada " . Carbon::parse($record->end_date)->format('d F Y') . ".\n\n" .
            "Silakan segera mengembalikan barang tersebut. Terima kasih!";

        static::sendWhatsAppMessage($record->user->phone, $message);
    }

    protected static function sendWhatsAppMessage(string $phone, string $message): void
    {
        $apiUrl = 'https://api.fonnte.com/send';
        $apiKey = env('FONNTE_API_KEY');

        try {
            $response = Http::withHeaders([
                'Authorization' => $apiKey,
            ])
                ->timeout(60)
                ->retry(3, 100)
                ->post($apiUrl, [
                    'target' => $phone,
                    'message' => $message,
                ]);

            if ($response->failed()) {
                \Log::error('Fonnte API Error: ' . $response->body());
                throw new \Exception('Failed to send WhatsApp message: ' . $response->body());
            }

            \Log::info('WhatsApp message sent successfully to: ' . $phone);
        } catch (\Exception $e) {
            \Log::error('WhatsApp Notification Error: ' . $e->getMessage());
            throw new \Exception('Failed to send WhatsApp message: ' . $e->getMessage());
        }
    }
}
