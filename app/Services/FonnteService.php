<?php
    
namespace App\Services;

use Illuminate\Support\Facades\Http;

class FonnteService
{
    public static function sendMessage(array $data)
    {
        $url = 'https://api.fonnte.com/send';
        $token = env('FONNTE_API_KEY');

        $response = Http::withHeaders([
            'Authorization' => $token,
        ])->asMultipart()->post($url, [
            'target' => $data['target'], // Nomor penerima
            'message' => $data['message'], // Pesan
            'url' => $data['url'] ?? null, // URL file (opsional)
            'filename' => $data['filename'] ?? null, // Nama file (opsional)
            'schedule' => $data['schedule'] ?? 0, // Jadwal (default: 0)
            'typing' => $data['typing'] ?? false, // Efek mengetik (default: false)
            'delay' => $data['delay'] ?? 2, // Delay (default: 2 detik)
            'countryCode' => $data['countryCode'] ?? '62', // Kode negara
            'file' => isset($data['file']) ? fopen($data['file'], 'r') : null, // File lokal
            'location' => $data['location'] ?? null, // Lokasi (opsional)
            'followup' => $data['followup'] ?? 0, // Followup (default: 0)
        ]);

        return $response->json();
    }
}
