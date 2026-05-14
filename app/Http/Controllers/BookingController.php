<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Motorcycle;
use App\Models\Setting;
use App\Models\TourPackage;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class BookingController extends Controller
{
    private const BOOKABLE_MODELS = [
        'Car' => Car::class,
        'Motorcycle' => Motorcycle::class,
        'TourPackage' => TourPackage::class,
    ];

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_name' => 'required|string|max:255',
            'customer_phone' => 'required|string|max:20',
            'customer_email' => 'nullable|email|max:255',
            'bookable_type' => ['nullable', 'string', Rule::in(array_keys(self::BOOKABLE_MODELS))],
            'bookable_id' => 'nullable|integer|required_with:bookable_type',
            'service_type' => 'nullable|string|max:255|required_without:bookable_type',
            'driver_option' => ['nullable', 'string', Rule::in(['lepas_kunci', 'dengan_driver'])],
            'start_date' => 'required|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
            'notes' => 'nullable|string',
            'location' => 'nullable|string|max:255',
            // Persyaratan rental
            'emergency_contact_phone' => 'nullable|string|max:20',
            'emergency_contact_relation' => 'nullable|string|max:100',
            'doc_ktp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'doc_kk' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'doc_npwp' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
            'doc_ktp_penjamin' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        if ($this->requiresDriverOption($validated) && empty($validated['driver_option'])) {
            throw ValidationException::withMessages([
                'driver_option' => 'Pilih opsi driver untuk layanan ini.',
            ]);
        }

        $modelClass = null;
        $bookable = null;
        $totalPrice = 0;
        $serviceCategory = $this->serviceCategoryFromRequest($validated);
        $serviceName = $validated['service_type'] ?? 'Layanan Umum';

        if (!empty($validated['bookable_type']) && !empty($validated['bookable_id'])) {
            $modelClass = self::BOOKABLE_MODELS[$validated['bookable_type']];
            $bookable = $modelClass::query()->findOrFail($validated['bookable_id']);
            $serviceCategory = $this->serviceCategoryFromBookable($validated['bookable_type']);
            $serviceName = $bookable->name;
            if (isset($bookable->brand) && $bookable->brand) {
                $serviceName = $bookable->brand . ' ' . $bookable->name;
            }

            if ($validated['bookable_type'] === 'TourPackage') {
                $totalPrice = $bookable->price;
            } else {
                $start = Carbon::parse($validated['start_date']);
                $end = !empty($validated['end_date']) ? Carbon::parse($validated['end_date']) : $start;
                $days = $start->diffInDays($end) ?: 1;
                $totalPrice = ($bookable->price_per_day ?? 0) * $days;
            }
        }

        $driverOptionLabel = $this->driverOptionLabel($validated['driver_option'] ?? null);

        // Handle file uploads
        $docPaths = [];
        foreach (['doc_ktp', 'doc_kk', 'doc_npwp', 'doc_ktp_penjamin'] as $field) {
            if ($request->hasFile($field)) {
                $docPaths[$field] = $request->file($field)->store('documents', 'public');
            }
        }

        Transaction::create([
            'customer_name' => $validated['customer_name'],
            'customer_phone' => $validated['customer_phone'],
            'customer_email' => $validated['customer_email'] ?? null,
            'service_category' => $serviceCategory,
            'service_name' => $serviceName,
            'driver_option' => $validated['driver_option'] ?? null,
            'location' => $validated['location'] ?? null,
            'bookable_type' => $modelClass,
            'bookable_id' => $validated['bookable_id'] ?? null,
            'start_date' => $validated['start_date'],
            'end_date' => $validated['end_date'] ?? null,
            'total_price' => $totalPrice,
            'status' => 'pending',
            'notes' => $validated['notes'] ?? null,
            'emergency_contact_phone' => $validated['emergency_contact_phone'] ?? null,
            'emergency_contact_relation' => $validated['emergency_contact_relation'] ?? null,
            'doc_ktp' => $docPaths['doc_ktp'] ?? null,
            'doc_kk' => $docPaths['doc_kk'] ?? null,
            'doc_npwp' => $docPaths['doc_npwp'] ?? null,
            'doc_ktp_penjamin' => $docPaths['doc_ktp_penjamin'] ?? null,
        ]);

        $siteName = Setting::get('site_name', 'CJA RENT CAR');
        $message = "*Reservasi Baru - {$siteName}*\n\n" .
            "*Data Pelanggan:*\n" .
            "- Nama: {$validated['customer_name']}\n" .
            "- WA: {$validated['customer_phone']}\n" .
            "- Email: " . ($validated['customer_email'] ?? '-') . "\n";

        if (!empty($validated['emergency_contact_phone'])) {
            $message .= "- No. Darurat: " . $validated['emergency_contact_phone'];
            if (!empty($validated['emergency_contact_relation'])) {
                $message .= " (" . $validated['emergency_contact_relation'] . ")";
            }
            $message .= "\n";
        }

        $message .= "\n*Detail Layanan:*\n" .
            "- Layanan: {$serviceName}\n" .
            "- Tanggal: " . Carbon::parse($validated['start_date'])->format('d/m/Y') . (!empty($validated['end_date']) ? ' s/d ' . Carbon::parse($validated['end_date'])->format('d/m/Y') : '') . "\n";

        if ($driverOptionLabel) {
            $message .= "- Opsi: {$driverOptionLabel}\n";
        }

        if ($totalPrice > 0) {
            $message .= '- Estimasi Total: Rp ' . number_format($totalPrice, 0, ',', '.') . "\n";
        }

        if (!empty($validated['location'])) {
            $message .= '- Lokasi: ' . $validated['location'] . "\n";
        }

        if (!empty($validated['notes'])) {
            $message .= "\n*Catatan:*\n" . $validated['notes'];
        }

        // Informasi dokumen
        $uploadedDocs = array_filter([
            'KTP' => $docPaths['doc_ktp'] ?? null,
            'KK' => $docPaths['doc_kk'] ?? null,
            'NPWP' => $docPaths['doc_npwp'] ?? null,
            'KTP Penjamin' => $docPaths['doc_ktp_penjamin'] ?? null,
        ]);
        if (!empty($uploadedDocs)) {
            $message .= "\n\n*Dokumen Terupload:* " . implode(', ', array_keys($uploadedDocs));
        }

        $message .= "\n\n_Mohon segera dikonfirmasi. Terima kasih._";

        return redirect(Setting::whatsappLink($message));
    }

    private function requiresDriverOption(array $validated): bool
    {
        if (($validated['bookable_type'] ?? null) === 'Car') {
            return true;
        }

        return in_array($validated['service_type'] ?? null, [
            'Rental Mobil Harian',
            'Rental Mobil Luar Kota',
            'Antar Jemput / Drop Off',
            'Perjalanan Keluarga',
        ], true);
    }

    private function serviceCategoryFromBookable(string $bookableType): string
    {
        return match ($bookableType) {
            'Car' => 'Rental Mobil',
            'Motorcycle' => 'Sewa Motor',
            'TourPackage' => 'Paket Wisata',
            default => 'Layanan Umum',
        };
    }

    private function serviceCategoryFromRequest(array $validated): string
    {
        $serviceType = $validated['service_type'] ?? null;

        if (! $serviceType) {
            return 'Layanan Umum';
        }

        return match ($serviceType) {
            'Sewa Motor' => 'Sewa Motor',
            'Paket Wisata' => 'Paket Wisata',
            default => 'Rental Mobil',
        };
    }

    private function driverOptionLabel(?string $driverOption): ?string
    {
        return match ($driverOption) {
            'dengan_driver' => 'Dengan Driver',
            'lepas_kunci' => 'Tanpa Driver / Lepas Kunci',
            default => null,
        };
    }
}
