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
        $productIds = $get('product_id');
        $startDate = $get('start_date');
        $endDate = $get('end_date');

        if (!$productIds || !$startDate || !$endDate) {
            $set('price', 0);
            return;
        }

        try {
            $startDate = Carbon::parse($startDate)->startOfDay();
            $endDate = Carbon::parse($endDate)->startOfDay();
            $numberOfDays = max(1, $startDate->diffInDays($endDate));

            $totalProductPrice = Product::whereIn('id', $productIds)
                ->get()
                ->sum('price');

            $set('price', $totalProductPrice * $numberOfDays);
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
                    ->required(),

                Forms\Components\Select::make('product_id')
                    ->relationship('products', 'title')
                    ->searchable()
                    ->preload()
                    ->multiple()
                    ->required()
                    ->live()
                    ->getOptionLabelFromRecordUsing(fn($record) => "{$record->title} (Rp " . number_format($record->price, 0, ',', '.') . ")")
                    ->afterStateUpdated(fn($set, $get) => static::calculatePrice($set, $get)),

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
                //
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
            'index' => Pages\ListBookings::route('/'),
            'create' => Pages\CreateBooking::route('/create'),
            'edit' => Pages\EditBooking::route('/{record}/edit'),
        ];
    }
}
