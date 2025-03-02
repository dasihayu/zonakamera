<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ZuwindaService
{
    public static function sendMessage(array $data)
    {
        // Correct endpoint from documentation
        $url = 'https://api.zuwinda.com/v2/messaging/whatsapp/message';
        $token = config('services.zuwinda.token');

        // Validate token first
        if (empty($token)) {
            Log::error('Zuwinda token is empty');
            throw new \Exception('Zuwinda API token is not configured');
        }

        // Format the phone number if necessary
        $phone = $data['target'];
        // Remove any '+' prefix and ensure proper format
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        // Prepare request payload according to documentation
        $payload = [
            'accountId' => config('services.zuwinda.account_id', ''), // Add account ID to your config
            'to' => $phone,
            'messageType' => 'text',
            'content' => $data['message'],
        ];

        // Debug request
        Log::info('Zuwinda Request:', [
            'url' => $url,
            'headers' => ['X-Access-Key' => substr($token, 0, 5) . '...'],
            'payload' => $payload
        ]);

        try {
            // Using X-Access-Key header as shown in documentation
            $response = Http::withHeaders([
                'X-Access-Key' => $token,
                'Content-Type' => 'application/json',
            ])->post($url, $payload);

            // Debug response
            Log::info('Zuwinda Response:', [
                'status' => $response->status(),
                'body' => $response->json(),
            ]);

            if (!$response->successful()) {
                Log::error('Zuwinda Request Failed:', [
                    'status' => $response->status(),
                    'error' => $response->body()
                ]);

                throw new \Exception('Zuwinda API request failed: ' . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Zuwinda Exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}