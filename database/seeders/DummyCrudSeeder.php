<?php

namespace Database\Seeders;

use App\Models\Car;
use App\Models\Faq;
use App\Models\Motorcycle;
use App\Models\Post;
use App\Models\Setting;
use App\Models\Testimonial;
use App\Models\TourPackage;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyCrudSeeder extends Seeder
{
    public function run(): void
    {
        $this->seedUsers();
        $this->seedSettings();
        $this->seedCars();
        $this->seedMotorcycles();
        $this->seedTourPackages();
        $this->seedTestimonials();
        $this->seedFaqs();
        $this->seedPosts();
        $this->seedTransactions();
    }

    private function seedUsers(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@cjarentcar.test'],
            [
                'name' => 'Admin CJA RENT CAR',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'email_verified_at' => now(),
            ]
        );

        $dummyNames = ['Budi Santoso', 'Siti Aminah', 'Ahmad Hidayat', 'Dewi Lestari', 'Rizky Pratama'];
        foreach ($dummyNames as $index => $name) {
             User::firstOrCreate(
                ['email' => 'user' . ($index + 1) . '@example.com'],
                [
                    'name' => $name,
                    'password' => Hash::make('password'),
                    'is_admin' => false,
                    'email_verified_at' => now(),
                ]
            );
        }
    }

    private function seedSettings(): void
    {
        $settings = [
            'site_name' => 'CJA RENT CAR',
            'site_description' => 'Solusi rental mobil Tasikmalaya terlengkap untuk harian, bulanan, lepas kunci, maupun dengan driver profesional.',
            'site_tagline' => 'Cepat, Jelas, Aman - Pilihan Utama Rental Mobil Tasikmalaya.',
            'hero_title' => 'Sewa Mobil & Motor Murah di Tasikmalaya',
            'hero_subtitle' => 'Armada terawat, proses booking instan via WhatsApp, dan layanan jemput unit langsung ke lokasi Anda.',
            'address' => 'Jl. Ir. H. Juanda No. 123, Tasikmalaya, Jawa Barat',
            'whatsapp_number' => '6282123456789',
            'phone_number' => '0265-7654321',
            'contact_email' => 'info@cjarentcar.com',
            'opening_hours' => 'Buka Setiap Hari: 07:00 - 22:00 (Emergency 24 Jam)',
            'instagram_link' => 'https://instagram.com/cjarentcar',
            'facebook_link' => 'https://facebook.com/cjarentcar',
            'tiktok_link' => 'https://tiktok.com/@cjarentcar',
            'google_maps_url' => 'https://maps.google.com/maps?q=tasikmalaya&t=&z=13&ie=UTF8&iwloc=&output=embed',
            'about_history' => 'Berawal dari 2 unit kendaraan di tahun 2018, kini CJA RENT CAR telah berkembang menjadi penyedia transportasi terpercaya di Tasikmalaya dengan puluhan armada unggulan.',
            'about_vision' => 'Menjadi tolok ukur layanan rental kendaraan yang amanah, transparan, dan profesional di Priangan Timur.',
            'about_mission' => "1. Menjamin kebersihan dan kelaikan setiap armada.\n2. Memberikan respon cepat dan solusi tepat bagi pelanggan.\n3. Membangun kepercayaan melalui sistem harga yang jujur tanpa biaya tersembunyi.",
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }

        Setting::forgetCache();
    }

    private function seedCars(): void
    {
        $cars = [
            [
                'name' => 'Avanza Veloz Q TSS',
                'brand' => 'Toyota',
                'category' => 'lepas_kunci',
                'price_per_day' => 350000,
                'price_per_month' => 7500000,
                'transmission' => 'Automatic',
                'passenger_capacity' => 7,
                'fuel_type' => 'Bensin',
                'year' => '2023',
                'description' => "Unit terbaru dengan fitur keselamatan canggih Toyota Safety Sense.\nCocok untuk perjalanan keluarga maupun bisnis dengan kenyamanan maksimal.",
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Innova Zenix Hybrid',
                'brand' => 'Toyota',
                'category' => 'with_driver',
                'price_per_day' => 850000,
                'price_per_month' => 18000000,
                'transmission' => 'Automatic',
                'passenger_capacity' => 7,
                'fuel_type' => 'Hybrid',
                'year' => '2024',
                'description' => "Pengalaman berkendara mewah dan senyap dengan teknologi Hybrid terbaru.\nWajib dengan driver profesional kami untuk menjaga kualitas unit.",
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Honda Brio RS',
                'brand' => 'Honda',
                'category' => 'lepas_kunci',
                'price_per_day' => 300000,
                'price_per_month' => 6000000,
                'transmission' => 'Automatic',
                'passenger_capacity' => 5,
                'fuel_type' => 'Bensin',
                'year' => '2022',
                'description' => "Lincah dan sangat irit BBM. Pilihan favorit mahasiswa dan anak muda untuk mobilitas di Tasikmalaya.",
                'is_featured' => false,
                'status' => 'active',
            ],
            [
                'name' => 'Mitsubishi Xpander Ultimate',
                'brand' => 'Mitsubishi',
                'category' => 'lepas_kunci',
                'price_per_day' => 450000,
                'price_per_month' => 9500000,
                'transmission' => 'Automatic',
                'passenger_capacity' => 7,
                'fuel_type' => 'Bensin',
                'year' => '2023',
                'description' => "Desain modern dan suspensi ternyaman di kelasnya.\nSangat pas untuk perjalanan jauh ke luar kota.",
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Toyota Alphard Transformer',
                'brand' => 'Toyota',
                'category' => 'with_driver',
                'price_per_day' => 2500000,
                'price_per_month' => 45000000,
                'transmission' => 'Automatic',
                'passenger_capacity' => 6,
                'fuel_type' => 'Bensin',
                'year' => '2022',
                'description' => "Standard kenyamanan eksekutif untuk penjemputan tamu VIP atau acara pernikahan (Wedding Car) mewah.",
                'is_featured' => true,
                'status' => 'active',
            ],
            [
                'name' => 'Toyota Hiace Commuter',
                'brand' => 'Toyota',
                'category' => 'with_driver',
                'price_per_day' => 1200000,
                'price_per_month' => 25000000,
                'transmission' => 'Manual',
                'passenger_capacity' => 15,
                'fuel_type' => 'Diesel',
                'year' => '2021',
                'description' => "Solusi rombongan besar dengan kabin yang luas dan AC yang dingin hingga baris belakang.",
                'is_featured' => false,
                'status' => 'active',
            ],
        ];

        foreach ($cars as $car) {
            Car::updateOrCreate(['name' => $car['name']], $car);
        }
    }

    private function seedMotorcycles(): void
    {
        $motorcycles = [
            [
                'name' => 'Honda Vario 160 ABS',
                'brand' => 'Honda',
                'engine_capacity' => 160,
                'description' => 'Motor matic bertenaga besar dengan pengereman ABS untuk keamanan ekstra di jalanan kota.',
                'price_per_day' => 100000,
                'price_per_month' => 1800000,
                'status' => 'active',
            ],
            [
                'name' => 'Yamaha NMAX Connected',
                'brand' => 'Yamaha',
                'engine_capacity' => 155,
                'description' => 'Posisi berkendara rileks, cocok untuk keliling Tasikmalaya tanpa pegal.',
                'price_per_day' => 150000,
                'price_per_month' => 2500000,
                'status' => 'active',
            ],
            [
                'name' => 'Honda Scoopy Prestige',
                'brand' => 'Honda',
                'engine_capacity' => 110,
                'description' => 'Desain retro yang stylish, favorit untuk nongkrong di cafe-cafe pusat kota.',
                'price_per_day' => 85000,
                'price_per_month' => 1500000,
                'status' => 'active',
            ],
            [
                'name' => 'Yamaha Fazzio',
                'brand' => 'Yamaha',
                'engine_capacity' => 125,
                'description' => 'Mesin Hybrid yang irit dan desain unik ala skutik Eropa.',
                'price_per_day' => 90000,
                'price_per_month' => 1600000,
                'status' => 'active',
            ],
        ];

        foreach ($motorcycles as $motor) {
            Motorcycle::updateOrCreate(['name' => $motor['name']], $motor);
        }
    }

    private function seedTourPackages(): void
    {
        $packages = [
            [
                'name' => 'Eksplor Galunggung & Pemandian Air Panas',
                'duration' => '1 Hari (Full Day)',
                'price' => 750000,
                'itinerary' => [
                    ['day' => '08:00', 'activities' => 'Penjemputan di Hotel/Stasiun Tasikmalaya'],
                    ['day' => '09:30', 'activities' => 'Eksplor Kawah Galunggung (625 anak tangga)'],
                    ['day' => '12:00', 'activities' => 'Makan siang nasi liwet khas Galunggung'],
                    ['day' => '14:00', 'activities' => 'Relaksasi di Pemandian Air Panas Cipanas'],
                    ['day' => '17:00', 'activities' => 'Kembali ke kota dan drop off'],
                ],
                'include' => "Mobil + Driver + BBM\nTiket Masuk Wisata\nMakan Siang\nAir Mineral",
                'exclude' => "Belanja pribadi\nTips Driver (Sukarela)",
                'description' => 'Paket wisata alam paling ikonik di Tasikmalaya. Cocok untuk penyegaran mata dan relaksasi.',
                'status' => 'active',
            ],
            [
                'name' => 'Wisata Religi Pamijahan',
                'duration' => '12 Jam',
                'price' => 950000,
                'itinerary' => [
                    ['day' => '07:00', 'activities' => 'Penjemputan peserta'],
                    ['day' => '10:00', 'activities' => 'Ziarah Makam Syekh Abdul Muhyi'],
                    ['day' => '13:00', 'activities' => 'Eksplor Gua Safarwadi'],
                    ['day' => '16:00', 'activities' => 'Perjalanan pulang'],
                ],
                'include' => "Armada Avanza/Innova\nDriver Berpengalaman\nBBM",
                'exclude' => "Makan & Minum\nBiaya Guide Lokal (Gua)",
                'description' => 'Paket khusus ziarah dengan driver yang paham rute dan etiket di kawasan Pamijahan.',
                'status' => 'active',
            ],
        ];

        foreach ($packages as $p) {
            TourPackage::updateOrCreate(['name' => $p['name']], $p);
        }
    }

    private function seedTestimonials(): void
    {
        $testimonials = [
            ['name' => 'dr. H. Rahmat Hakim', 'occupation' => 'Tenaga Medis', 'content' => 'Sangat terbantu dengan sistem sewa bulanan CJA. Mobilnya selalu dalam kondisi prima, servis rutin mereka yang handle.', 'rating' => 5],
            ['name' => 'Maya Indriani', 'occupation' => 'Travel Blogger', 'content' => 'Nyobain paket tour Galunggung-nya luar biasa! Drivernya juga merangkap jadi fotografer gadakan, hasilnya keren-keren.', 'rating' => 5],
            ['name' => 'Irvan Sanjaya', 'occupation' => 'Pengusaha Muda', 'content' => 'Lepas kunci Innova Zenix-nya mantap. Proses verifikasinya cepat, adminnya sangat komunikatif.', 'rating' => 5],
            ['name' => 'Siska Amelia', 'occupation' => 'Mahasiswa Unsil', 'content' => 'Sering sewa motor Fazzio buat keliling kota. Helmnya bersih dan wangi, poin plus banget buat saya.', 'rating' => 4],
        ];

        foreach ($testimonials as $t) {
            Testimonial::updateOrCreate(['name' => $t['name']], $t + ['is_active' => true]);
        }
    }

    private function seedFaqs(): void
    {
        $faqs = [
            ['question' => 'Apa syarat utama sewa lepas kunci?', 'answer' => 'Memiliki SIM yang masih aktif, menyerahkan KTP asli sebagai jaminan, dan bersedia diverifikasi dokumen tempat tinggal.'],
            ['question' => 'Apakah harga sudah termasuk asuransi?', 'answer' => 'Harga tertera adalah biaya sewa unit. Kami memiliki opsi klaim asuransi dengan biaya partisipasi sesuai ketentuan yang berlaku.'],
            ['question' => 'Bisa jemput unit di Stasiun Tasikmalaya?', 'answer' => 'Tentu bisa! Kami menyediakan layanan antar-jemput unit ke Stasiun, Pool Bus, atau Hotel tanpa biaya tambahan untuk area Kota.'],
        ];

        foreach ($faqs as $f) {
            Faq::updateOrCreate(['question' => $f['question']], $f);
        }
    }

    private function seedPosts(): void
    {
        $posts = [
            [
                'title' => '5 Destinasi Wisata Tersembunyi di Tasikmalaya Selatan',
                'content' => "Sudah bosan dengan keriuhan kota? Tasikmalaya Selatan menyimpan permata tersembunyi seperti Pantai Karang Tawulan yang eksotis.\n\nUntuk mencapainya, kami sarankan menggunakan unit SUV seperti Fortuner atau Xpander agar perjalanan lebih tangguh melibas medan berkelok.",
                'published_at' => now()->subDays(1),
            ],
            [
                'title' => 'Panduan Merawat Mobil Rental Selama Pemakaian Jangka Panjang',
                'content' => "Bagi Anda yang mengambil program sewa bulanan, menjaga kebersihan interior adalah kunci kenyamanan.\n\nCJA Rent Car memberikan layanan free cuci 1x seminggu untuk setiap unit sewa bulanan di workshop kami.",
                'published_at' => now()->subDays(3),
            ],
        ];

        foreach ($posts as $p) {
            Post::updateOrCreate(
                ['title' => $p['title']],
                $p + ['is_published' => true]
            );
        }
    }

    private function seedTransactions(): void
    {
        $cars = Car::all();
        $motors = Motorcycle::all();
        $names = ['Didi Junaidi', 'Lilis Karlina', 'Agus Kotak', 'Maman Racing', 'Eneng Geulis'];
        
        for ($i = 0; $i < 10; $i++) {
            $isCar = rand(0, 1);
            $item = $isCar ? $cars->random() : $motors->random();
            
            Transaction::create([
                'customer_name' => $names[array_rand($names)],
                'customer_phone' => '08' . rand(1111111111, 9999999999),
                'bookable_type' => get_class($item),
                'bookable_id' => $item->id,
                'start_date' => now()->subDays(rand(1, 30)),
                'end_date' => now()->subDays(rand(-5, 0)),
                'total_price' => $item->price_per_day * rand(1, 4),
                'status' => 'completed',
                'notes' => 'Generated by seeder',
            ]);
        }
    }

    private function ensureCount($query, int $target, callable $creator): void
    {
        $current = $query->count();
        if ($current < $target) {
            $creator($target - $current);
        }
    }
}
