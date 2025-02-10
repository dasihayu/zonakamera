<?php

namespace App\Filament\Widgets;

use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Card;
use App\Models\Booking;

class BookingStatsWidget extends BaseWidget
{
    protected function getCards(): array
    {
        $todayBookings = Booking::whereDate('created_at', today())->count();
        $pickedUpBookings = Booking::where('status', 'picked_up')->count();
        $todayRevenue = Booking::whereDate('created_at', today())->sum('price');

        return [
            Card::make('Bookings Today', $todayBookings)
                ->description('Total bookings made today')
                ->color('primary')
                ->icon('heroicon-o-calendar'),

            Card::make('Booking Picked Up', $pickedUpBookings)
                ->description('Total bookings with picked up status')
                ->color('success')
                ->icon('heroicon-o-truck'),

            Card::make('Revenue Today', 'Rp ' . number_format($todayRevenue, 2, ',', '.'))
                ->description('Total revenue earned today')
                ->color('warning')
                ->icon('heroicon-o-banknotes'),
        ];
    }
}
