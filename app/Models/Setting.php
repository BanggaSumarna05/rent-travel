<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    protected static ?Collection $cachedSettings = null;

    protected static function booted(): void
    {
        static::saved(fn () => static::forgetCache());
        static::deleted(fn () => static::forgetCache());
    }

    public static function get($key, $default = null)
    {
        return static::allCached()->get($key, $default);
    }

    public static function allCached(): Collection
    {
        if (static::$cachedSettings === null) {
            static::$cachedSettings = static::query()->pluck('value', 'key');
        }

        return static::$cachedSettings;
    }

    public static function forgetCache(): void
    {
        static::$cachedSettings = null;
    }

    public static function whatsappNumber(?string $default = null): ?string
    {
        $number = static::get('whatsapp_number', $default);

        if ($number === null) {
            return null;
        }

        $cleanNumber = preg_replace('/\D+/', '', $number);

        return $cleanNumber !== '' ? $cleanNumber : null;
    }

    public static function whatsappLink(?string $message = null, ?string $fallback = '#'): string
    {
        $number = static::whatsappNumber();

        if ($number === null) {
            return $fallback ?? '#';
        }

        $url = "https://wa.me/{$number}";

        return $message ? $url . '?text=' . urlencode($message) : $url;
    }

    public static function logoUrl(): string
    {
        foreach (['logo.jpg', 'logo.JPG', 'logo2.png'] as $path) {
            if (is_file(public_path($path))) {
                return asset($path);
            }
        }

        return asset('favicon.ico');
    }
}
