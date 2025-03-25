<?php

namespace App\Services;

use App\Models\Booking;
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;

class GoogleSheetsService
{
    protected $sheets;
    protected $spreadsheetId;

    public function __construct()
    {
        $this->spreadsheetId = config('services.google.spreadsheet_id');
        $this->initializeGoogleClient();
    }

    protected function initializeGoogleClient()
    {
        $client = new Client();
        $client->setApplicationName('Zonakamera Booking System');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(storage_path('app/google-credentials.json'));
        $client->setAccessType('offline');

        $httpConfig = [];

        // Jika di production dan menggunakan system CA certificates
        if (app()->environment('production')) {
            $httpConfig = [
                'verify' => true, // Gunakan system CA certificates
                'timeout' => 10,
            ];
        } else {
            // Local development
            $httpConfig = [
                'verify' => storage_path('app/cacert.pem'),
                'timeout' => 10,
            ];
        }

        $client->setHttpClient(new \GuzzleHttp\Client($httpConfig));
        $this->sheets = new Sheets($client);
    }

    public function appendBookingData(Booking $booking)
    {
        $range = 'Bookings!A:Z';

        $values = [
            (string) $booking->booking_id,
            $booking->start_date->format('Y-m-d H'),
            $booking->end_date->format('Y-m-d H'),
            (string) $booking->user->firstname,
            (string) $booking->user->phone,
            (string) $this->getProductsWithQuantity($booking),
            (string) $booking->total_price
        ];

        $body = new ValueRange([
            'values' => [$values] // Pastikan data berbentuk array di dalam array
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        try {
            $this->sheets->spreadsheets_values->append(
                $this->spreadsheetId,
                $range,
                $body,
                $params
            );
        } catch (\Exception $e) {
            \Log::error('Google Sheets Error: ' . $e->getMessage());
            throw $e;
        }
    }


    protected function getProductsWithQuantity(Booking $booking)
    {
        $products = $booking->products()->get(); // Pastikan relasi diambil dengan get()
        \Log::info($products);

        if ($products->isEmpty()) {
            return 'No Products';
        }

        return $products->map(function ($product) {
            $quantity = $product->pivot->quantity ?? 1;
            return "{$product->title} (x{$quantity})";
        })->implode(', ');
    }
}
