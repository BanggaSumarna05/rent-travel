<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = [
        'key',
        'value',
    ];

    public static function get($key, $default = null)
    {
        $setting = static::where('key', $key)->first();

        if (!$setting) {
            return $default;
        }

        $value = $setting->value;

        // If it looks like a storage path (e.g., uploaded via our new logic)
        if (str_starts_with($value, 'settings/')) {
            return \Illuminate\Support\Facades\Storage::disk('public')->url($value);
        }

        return $value;
    }
}
