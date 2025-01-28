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
        $user = $booking->user;

        // Format products dengan quantity dari pivot
        $products = $booking->products->map(function ($product) {
            return sprintf(
                '%s (x%d)',
                $product->title,
                $product->pivot->quantity
            );
        })->implode(', ');

        $values = [
            [
                $booking->id,
                $user->firstname . ' ' . $user->lastname,
                $user->phone,
                $products,
                $booking->start_date->format('Y-m-d'),
                $booking->end_date->format('Y-m-d'),
                $booking->price
            ]
        ];

        $body = new ValueRange([
            'values' => $values
        ]);

        $params = [
            'valueInputOption' => 'RAW'
        ];

        $this->service->spreadsheets_values->append(
            $this->spreadsheetId,
            'Sheet1!A:G',
            $body,
            $params
        );
    }
}
