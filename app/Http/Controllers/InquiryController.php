<?php

namespace App\Http\Controllers;

use App\Models\Inquiry;
use Illuminate\Http\Request;

class InquiryController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'service_category_id' => 'nullable|exists:service_categories,id',
            'service_name' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'message' => 'required|string',
        ]);


        $inquiry = Inquiry::create([
            'service_category_id' => $request->service_category_id,
            'service_name' => $request->service_name,
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message,
            'status' => 'new',
        ]);

        // Orbit WA Notification
        $apiKey = \App\Models\Setting::getValue('orbit_api_key');
        $recipient = \App\Models\Setting::getValue('orbit_recipient');

        if ($apiKey && $recipient) {
            try {
                $categoryName = $inquiry->serviceCategory ? $inquiry->serviceCategory->name : 'Umum / Lainnya';
                $packageName = $inquiry->service_name ?: 'Custom / Belum Ditentukan';
                
                $waMessage = "🚀 *Pesan Baru Terdeteksi!*\n\n"
                    . "Halo Admin,\nAda permintaan layanan baru melalui website Andrew.Devlog.\n\n"
                    . "*Detail Pengirim:*\n"
                    . "👤 Nama: {$inquiry->name}\n"
                    . "📧 Email: {$inquiry->email}\n"
                    . "📱 No. HP: {$inquiry->phone}\n\n"
                    . "*Layanan:*\n"
                    . "📂 Kategori: {$categoryName}\n"
                    . "🛠 Paket: {$packageName}\n\n"
                    . "*Pesan:*\n"
                    . "_{$inquiry->message}_\n\n"
                    . "Silakan cek dashboard admin untuk detail lebih lanjut.";

                $response = \Illuminate\Support\Facades\Http::withToken($apiKey)
                    ->timeout(10)
                    ->post('https://orbitwaapi.site/api/v1/messages/send', [
                        'to' => $recipient,
                        'message' => $waMessage,
                    ]);

                if ($response->successful()) {
                    \Illuminate\Support\Facades\Log::info('Orbit WA Success: Message sent to ' . $recipient);
                } else {
                    \Illuminate\Support\Facades\Log::error('Orbit WA Failed: Status ' . $response->status() . ' Body: ' . $response->body());
                }
            } catch (\Exception $e) {
                \Illuminate\Support\Facades\Log::error('Orbit WA Exception: ' . $e->getMessage());
            }
        }

        return back()->with('success', 'Pesan Anda telah terkirim! Saya akan segera menghubungi Anda.');
    }
}
