<?php

namespace App\Services;

use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use App\Models\Booking;

class GoogleSheetsService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setAuthConfig(storage_path('app/breadit-411514-1f5c60d0a8e7.json'));
        $this->client->setScopes([Sheets::SPREADSHEETS]);

        $this->service = new Sheets($this->client);
        $this->spreadsheetId = config('services.google.spreadsheet_id');
    }

    public function appendBookingData(Booking $booking)
{
    // Pastikan relasi dimuat dengan pivot
    $booking->loadMissing(['products' => function ($query) {
        $query->withPivot(['quantity', 'price']);
    }, 'user']);

    $user = $booking->user;
    $products = $booking->products;

    if ($products->isEmpty()) {
        \Log::warning("Tidak ada produk ditemukan untuk Booking ID: {$booking->id}");
    }

    // Format products dengan quantity dan price dari pivot
    $productsList = $products->map(function ($product) {
        if (!$product->pivot) {
            // \Log::warning("Pivot data tidak ditemukan untuk Product ID: {$product->id} di Booking ID: {$product->pivot->booking_id ?? 'N/A'}");
            return $product->title;
        }

        $price = number_format($product->pivot->price ?? 0, 0, ',', '.');
        return sprintf(
            '%s (Qty: %d, Price: Rp %s)',
            $product->title,
            $product->pivot->quantity ?? 1,
            $price
        );
    })->implode("\n");

    \Log::info('Products being added to spreadsheet:', [
        'booking_id' => $booking->id,
        'products' => $productsList,
        'raw_products' => $products->toArray()
    ]);

    $values = [
        [
            $booking->id,
            $user->firstname . ' ' . $user->lastname,
            $user->phone,
            $productsList ?: 'Tidak ada produk',
            $booking->start_date->format('Y-m-d'),
            $booking->end_date->format('Y-m-d'),
            'Rp ' . number_format($booking->price, 0, ',', '.')
        ]
    ];

    $body = new ValueRange([
        'values' => $values
    ]);

    $params = [
        'valueInputOption' => 'RAW'
    ];

    try {
        $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            'Sheet1!A:G',
            $body,
            $params
        );
    } catch (\Exception $e) {
        \Log::error("Gagal menambahkan data ke Google Sheets: " . $e->getMessage());
    }
}
}
