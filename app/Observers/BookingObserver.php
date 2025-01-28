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

        if (!$user) {
            \Log::warning("User tidak ditemukan untuk Booking ID: {$booking->id}");
            return;
        }

        if (!$user->phone) {
            \Log::warning("Nomor telepon tidak ditemukan untuk User ID: {$user->id} pada Booking ID: {$booking->id}");
            return;
        }

        $data = [
            'target' => $user->phone,
            'message' => "Halo {$user->name}, terimakasih sudah melakukan booking di zonakamera. Admin akan segera menghubungi anda untuk ketersediaan barang.",
        ];

        $response = FonnteService::sendMessage($data);
    }
}
