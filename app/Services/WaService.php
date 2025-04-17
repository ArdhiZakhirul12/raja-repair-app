<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class WaService
{
    protected $token;

    public function __construct()
    {
        $this->token = env('FONNTE_TOKEN');
    }

    public function sendMessage($to, $message)
    {
        $response = Http::withHeaders([
            'Authorization' => $this->token,
        ])->post('https://api.fonnte.com/send', [
            'target' => $to, // Contoh: 6281234567890
            'message' => $message,
            'countryCode' => '62',
        ]);

        return $response->json();
    }
}
