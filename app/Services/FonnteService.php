<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class FonnteService
{
    public static function sendMessage(array $data)
    {
        $url = 'https://api.fonnte.com/send';
        $token = env('FONNTE_API_KEY');

        // Debug input data
        Log::info('Fonnte Request Data:', [
            'url' => $url,
            'target' => $data['target'],
            'message' => $data['message'],
            'has_file' => isset($data['file']),
            'token_exists' => !empty($token)
        ]);

        try {
            $response = Http::withHeaders([
                'Authorization' => $token,
            ])->asMultipart()->post($url, [
                'target' => $data['target'],
                'message' => $data['message'],
                'url' => $data['url'] ?? null,
                'filename' => $data['filename'] ?? null,
                'schedule' => $data['schedule'] ?? 0,
                'typing' => $data['typing'] ?? false,
                'delay' => $data['delay'] ?? 2,
                'countryCode' => $data['countryCode'] ?? '62',
                'file' => isset($data['file']) ? fopen($data['file'], 'r') : null,
                'location' => $data['location'] ?? null,
                'followup' => $data['followup'] ?? 0,
            ]);

            // Debug response
            Log::info('Fonnte Response:', [
                'status' => $response->status(),
                'body' => $response->json(),
                'headers' => $response->headers()
            ]);

            if (!$response->successful()) {
                Log::error('Fonnte Request Failed:', [
                    'status' => $response->status(),
                    'body' => $response->json(),
                    'error' => $response->body()
                ]);

                throw new \Exception('Fonnte API request failed: ' . $response->body());
            }

            return $response->json();
        } catch (\Exception $e) {
            Log::error('Fonnte Exception:', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            throw $e;
        }
    }
}
