<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Admin User - create if it doesn't exist
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin',
                'password' => Hash::make('password'),
                'is_admin' => true,
            ]
        );

        // Default Settings
        $settings = [
            'site_name' => 'Rent Travel',
            'whatsapp_number' => '6281234567890',
            'hero_title' => 'Kemudahan Rental Mobil & Motor di Genggaman Anda',
            'hero_subtitle' => 'Pesan sekarang dan nikmati perjalanan Anda dengan armada terbaik kami.',
            'contact_address' => 'Jl. Jenderal Sudirman No. 123, Jakarta, Indonesia',
            'contact_email' => 'info@renttravel.com',
            'facebook_url' => 'https://facebook.com',
            'instagram_url' => 'https://instagram.com',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
