<?php

namespace App\Observers;

use App\Models\Booking;
use App\Services\FonnteService;
use App\Services\GoogleSheetsService;
use App\Services\ZuwindaService;
use Illuminate\Support\Facades\Log;

class BookingObserver
{
    protected $googleSheetsService;

    public function __construct(GoogleSheetsService $googleSheetsService)
    {
        $this->googleSheetsService = $googleSheetsService;
    }

    /**
     * Handle the Booking "created" event.
     */
    public function created(Booking $booking)
    {
        // Pastikan relasi ter-load
        $booking->loadMissing(['products', 'user']);

        $user = $booking->user;
        $products = $booking->products;

        if (!$user) {
            Log::warning("User tidak ditemukan untuk Booking ID: {$booking->id}");
            return;
        }

        if (!$user->phone) {
            Log::warning("Nomor telepon tidak ditemukan untuk User ID: {$user->id} pada Booking ID: {$booking->id}");
            return;
        }

        if ($products->isEmpty()) {
            Log::warning("Booking ID {$booking->id} tidak memiliki produk yang terkait.");
        }

        // Kirim notifikasi WhatsApp
        $data = [
            'target' => $user->phone,
            'message' => "Halo {$user->firstname}, terimakasih sudah melakukan booking di zonakamera. Admin akan segera menghubungi anda untuk ketersediaan barang.",
        ];

        try {
            ZuwindaService::sendMessage($data);
        } catch (\Exception $e) {
            Log::error("Gagal mengirim pesan ke {$user->phone}: " . $e->getMessage());
        }

        // Tambahkan ke Google Sheets
        $this->googleSheetsService->appendBookingData($booking);
    }
}
