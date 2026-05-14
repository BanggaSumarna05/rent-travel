<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'service_type' => 'required|string|max:255',
            'message' => 'nullable|string',
        ]);

        $siteName = Setting::get('site_name', 'CJA RENT CAR');
        $message = "*Permintaan Konsultasi - {$siteName}*\n\n" .
            "*Data Pelanggan:*\n" .
            "- Nama: {$validated['name']}\n" .
            "- WA/Telp: {$validated['phone']}\n" .
            "- Email: " . ($validated['email'] ?? '-') . "\n" .
            "- Kebutuhan: {$validated['service_type']}\n";

        if (!empty($validated['message'])) {
            $message .= "\n*Pesan:*\n{$validated['message']}";
        }

        $message .= "\n\nMohon dihubungi kembali. Terima kasih.";

        return redirect(Setting::whatsappLink($message));
    }
}
