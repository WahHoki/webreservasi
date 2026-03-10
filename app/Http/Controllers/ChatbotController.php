<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Polyclinic;
use Illuminate\Support\Facades\Log;

class ChatbotController extends Controller
{
    public function chat(Request $request)
    {
        $request->validate(['message' => 'required|string']);

        try {
            $apiKey = env('GEMINI_API_KEY');
            $dataRS = $this->getHospitalContext();

            // 1. Susun instruksi yang kuat untuk asisten MediCare
            $payload = [
                'contents' => [
                    [
                        'parts' => [
                            ['text' => "Anda adalah Asisten Virtual MediCare yang ramah. Jawab dalam Bahasa Indonesia.\n\n" .
                                       "Gunakan DATA RS berikut untuk menjawab pertanyaan pasien:\n" . $dataRS . "\n\n" .
                                       "Pertanyaan Pasien: " . $request->message]
                        ]
                    ]
                ]
            ];

            // 2. Panggil Gemini 2.5 Flash (Model terbaru 2026 yang tersedia di akun Anda)
            // Jalur: v1/models/gemini-2.5-flash
            $response = Http::post("https://generativelanguage.googleapis.com/v1/models/gemini-2.5-flash:generateContent?key={$apiKey}", $payload);

            if ($response->successful()) {
                $data = $response->json();
                $reply = $data['candidates'][0]['content']['parts'][0]['text'] ?? 'Maaf, saya sedang memproses informasi. Bisa diulangi?';
                
                return response()->json([
                    'status' => 'success',
                    'reply' => $reply
                ]);
            }

            return response()->json([
                'status' => 'error',
                'reply' => 'Google API Error: ' . ($response->json()['error']['message'] ?? 'Unknown Error')
            ], 500);

        } catch (\Exception $e) {
            Log::error("Chatbot Error: " . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'reply' => 'Ada kendala pada sistem internal kami.'
            ], 500);
        }
    }

    private function getHospitalContext()
    {
        try {
            $polis = Polyclinic::with(['doctors.schedules'])->get();
            $context = "";

            if ($polis->isEmpty()) return "Data jadwal dokter saat ini belum tersedia.";

            foreach ($polis as $poli) {
                $context .= "Poli " . ($poli->name ?? 'Umum') . ":\n";
                foreach ($poli->doctors as $dokter) {
                    $context .= "- Dr. " . ($dokter->name ?? 'Staf') . "\n";
                    foreach ($dokter->schedules as $j) {
                        $context .= "  * Jadwal: " . ($j->day ?? 'Harian') . " (" . ($j->start_time ?? '08:00') . ")\n";
                    }
                }
            }
            return $context;
        } catch (\Exception $e) {
            return "Data rumah sakit tidak dapat dimuat.";
        }
    }
}