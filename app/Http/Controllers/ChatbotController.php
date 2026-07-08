<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ChatbotController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        $apiKey = env('GEMINI_API_KEY');

        try {
            // Menggunakan model gemini-3.5-flash dari daftar resmimu
            $response = Http::withoutVerifying()
                ->timeout(30)
                ->post("https://generativelanguage.googleapis.com/v1beta/models/gemini-3.5-flash:generateContent?key={$apiKey}", [
                'contents' => [
                    ['parts' => [['text' => $request->message]]]
                ]
            ]);

            if ($response->successful()) {
                $reply = $response->json('candidates.0.content.parts.0.text');
                return response()->json(['reply' => $reply]);
            }

            return response()->json(['reply' => 'API Error: ' . $response->body()]);

        } catch (\Exception $e) {
            return response()->json(['reply' => 'Sistem Error: ' . $e->getMessage()]);
        }
    }
}