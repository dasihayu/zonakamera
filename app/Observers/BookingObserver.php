<?php

namespace App\Observers;

use App\Models\Booking;
use App\Services\FonnteService;
use Carbon\Carbon;

class BookingObserver
{
    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking)
    {
        $user = $booking->user;
        $products = $booking->products;
        // if (!$user || !$user->phone || $products->isEmpty()) {
        //     \Log::warning("Data tidak lengkap untuk Booking ID: {$booking->id}");
        //     return;
        // }
        $productNames = $products->pluck('title')->join(', ');
        
        $formattedStartDate = Carbon::parse($booking->start_date)->translatedFormat('l, d F Y');
        $formattedEndDate = Carbon::parse($booking->end_date)->translatedFormat('l, d F Y');

        $data = [
            'target' => $user->phone,
            'message' => "Halo {$user->name}, booking Anda dengan item berikut telah berhasil dibuat: {$productNames} untuk tanggal {$formattedStartDate} sampai {$formattedEndDate} Admin akan segera menghubungi anda untuk ketersediaan barang.",
        ];

        $response = FonnteService::sendMessage($data);

        if ($response['status'] !== 'success') {
            \Log::error("Gagal mengirim pesan untuk Booking ID: {$booking->id}", $response);
        }
    }
}
