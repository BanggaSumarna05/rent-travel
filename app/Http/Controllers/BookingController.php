<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Setting;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'bookable_type' => 'nullable|string',
            'bookable_id' => 'nullable|integer',
            'service_type' => 'nullable|string', // For home page general booking
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
            'location' => 'nullable|string',
        ]);

        $modelClass = null;
        $bookable = null;
        $totalPrice = 0;
        $serviceName = $validated['service_type'] ?? 'Layanan Umum';

        // Resolve bookable if provided
        if (!empty($validated['bookable_type']) && !empty($validated['bookable_id'])) {
            $modelClass = 'App\\Models\\' . $validated['bookable_type'];
            if (class_exists($modelClass)) {
                $bookable = $modelClass::find($validated['bookable_id']);
                if ($bookable) {
                    $serviceName = $bookable->name;
                    // Calculate total price
                    if ($validated['bookable_type'] === 'TourPackage') {
                        $totalPrice = $bookable->price;
                    }
                    else {
                        $start = Carbon::parse($validated['start_date']);
                        $end = !empty($validated['end_date']) ?Carbon::parse($validated['end_date']) : $start;
                        $days = $start->diffInDays($end) ?: 1;
                        $totalPrice = ($bookable->price_per_day ?? 0) * $days;
                    }
                }
            }
        }

        // Create transaction
        $transaction = Transaction::create([
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'bookable_type' => $modelClass,
            'bookable_id' => $validated['bookable_id'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => (($validated['location'] ?? null) ? "Lokasi: " . $validated['location'] . "\n" : "") . ($validated['notes'] ?? ''),
        ]);

        // Generate WA Link
        $siteName = Setting::get('site_name', 'Rent Travel');
        $message = "*Reservasi Baru - {$siteName}*\n\n" .
            "*Data Pelanggan:*\n" .
            "• Nama: " . $validated['customer_name'] . "\n" .
            "• WA: " . $validated['customer_phone'] . "\n" .
            "• Email: " . ($validated['customer_email'] ?? '-') . "\n\n" .
            "*Detail Layanan:*\n" .
            "• Layanan: " . $serviceName . "\n" .
            "• Tanggal: " . Carbon::parse($validated['start_date'])->format('d/m/Y') . ($validated['end_date'] ? " s/d " . Carbon::parse($validated['end_date'])->format('d/m/Y') : "") . "\n";

        if ($totalPrice > 0) {
            $message .= "• Estimasi Total: Rp " . number_format($totalPrice, 0, ',', '.') . "\n";
        }

        if (!empty($validated['location'] ?? null)) {
            $message .= "• Lokasi: " . $validated['location'] . "\n";
        }

        if (!empty($validated['notes'])) {
            $message .= "\n*Catatan:*\n" . $validated['notes'];
        }

        $message .= "\n\n_Mohon segera dikonfirmasi. Terima kasih._";

        $waNumber = Setting::get('whatsapp_number');
        // Clean WA number (remove +, space, etc)
        $waNumber = preg_replace('/[^0-9]/', '', $waNumber);

        $waLink = "https://wa.me/{$waNumber}?text=" . urlencode($message);

        return redirect($waLink);
    }
}
