<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_name',
        'customer_phone',
        'customer_email',
        'service_category',
        'service_name',
        'driver_option',
        'location',
        'bookable_type',
        'bookable_id',
        'start_date',
        'end_date',
        'total_price',
        'status',
        'notes',
        // Persyaratan rental
        'emergency_contact_phone',
        'emergency_contact_relation',
        'doc_ktp',
        'doc_kk',
        'doc_npwp',
        'doc_ktp_penjamin',
        'penalty_amount',
        'penalty_details',
        'discount_amount',
        'discount_details',
    ];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'total_price' => 'decimal:2',
        'penalty_amount' => 'decimal:2',
        'discount_amount' => 'decimal:2',
    ];

    public function bookable()
    {
        return $this->morphTo();
    }

    public function serviceCategoryLabel(): string
    {
        if ($this->service_category) {
            return $this->service_category;
        }

        return match ($this->bookable_type) {
            Car::class => 'Rental Mobil',
            Motorcycle::class => 'Sewa Motor',
            TourPackage::class => 'Paket Wisata',
            default => 'Layanan Umum',
        };
    }

    public function serviceDisplayName(): string
    {
        $name = $this->service_name ?: $this->bookable?->name ?: 'Booking Umum';
        
        // If the stored service_name doesn't already contain the brand, try to prepend it from relationship
        if ($this->bookable && isset($this->bookable->brand) && !str_contains(strtolower($name), strtolower($this->bookable->brand))) {
            return $this->bookable->brand . ' ' . $name;
        }

        return $name;
    }

    public function driverOptionLabel(): ?string
    {
        $value = $this->driver_option ?: $this->extractStructuredNote('Opsi Driver');

        if (! $value) {
            return null;
        }

        return match ($value) {
            'lepas_kunci' => 'Tanpa Driver / Lepas Kunci',
            'dengan_driver' => 'Dengan Driver',
            default => $value,
        };
    }

    public function locationLabel(): ?string
    {
        return $this->location ?: $this->extractStructuredNote('Lokasi');
    }

    public function customerNotes(): ?string
    {
        if (! $this->notes) {
            return null;
        }

        $cleanNotes = preg_replace('/^Opsi Driver:\s*.+\R?/mu', '', $this->notes);
        $cleanNotes = preg_replace('/^Lokasi:\s*.+\R?/mu', '', $cleanNotes ?? '');
        $cleanNotes = trim($cleanNotes ?? '');

        return $cleanNotes !== '' ? $cleanNotes : null;
    }

    public function bookableTypeLabel(): string
    {
        return match ($this->bookable_type) {
            Car::class => 'Mobil',
            Motorcycle::class => 'Motor',
            TourPackage::class => 'Paket Wisata',
            default => $this->serviceCategoryLabel(),
        };
    }

    public function bookableMeta(): ?string
    {
        $bookable = $this->bookable;

        if ($bookable instanceof Car) {
            return collect([$bookable->brand, $bookable->transmission])
                ->filter()
                ->implode(' | ');
        }

        if ($bookable instanceof Motorcycle) {
            return collect([$bookable->brand, $bookable->engine_capacity ? $bookable->engine_capacity . 'cc' : null])
                ->filter()
                ->implode(' | ');
        }

        if ($bookable instanceof TourPackage) {
            return $bookable->duration;
        }

        return null;
    }

    public function bookableImageUrl(): ?string
    {
        $bookable = $this->bookable;

        if (! $bookable) {
            return null;
        }

        if ($bookable instanceof TourPackage) {
            return $bookable->primary_image_url;
        }

        if (! method_exists($bookable, 'getFirstMediaUrl')) {
            return null;
        }

        $collection = match ($this->bookable_type) {
            Car::class => 'cars',
            Motorcycle::class => 'motorcycles',
            TourPackage::class => 'tour_packages',
            default => '',
        };

        if ($collection === '') {
            return null;
        }

        $imageUrl = $bookable->getFirstMediaUrl($collection);

        return $imageUrl !== '' ? $imageUrl : null;
    }

    private function extractStructuredNote(string $label): ?string
    {
        if (! $this->notes) {
            return null;
        }

        $match = Str::of($this->notes)->match('/^' . preg_quote($label, '/') . ':\s*(.+)$/mu');

        return $match->isNotEmpty() ? trim((string) $match) : null;
    }
}

