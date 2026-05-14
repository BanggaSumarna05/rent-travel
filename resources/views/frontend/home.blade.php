@extends('layouts.frontend')

@section('content')

@php
    $googleReviewUrl = 'https://www.google.com/maps/place/Rental+Mobil+Lepas+Kunci+Tasikmalaya+Cipawitra+Jaya+Abadi+(CJA+Rentcar)/@-7.3357567,108.1480361,17z/data=!3m1!4b1!4m6!3m5!1s0x2e6f57001b5d0ea9:0xeea95d572afe0227!8m2!3d-7.3357567!4d108.1480361!16s%2Fg%2F11mm0vwk1l';
    $promoCar = $featuredCars->sortBy('price_per_day')->first();
    $heroTitle = \App\Models\Setting::get('hero_title', 'Rental Mobil Tasikmalaya Lepas Kunci & Driver');
    $heroSubtitle = \App\Models\Setting::get('hero_subtitle', 'CJA RENT CAR melayani sewa mobil harian, luar kota, antar jemput, dan perjalanan keluarga di Tasikmalaya dengan armada terawat dan booking cepat.');
    $heroTitleHtml = e($heroTitle);
    $heroTitleHtml = str_replace('Tasikmalaya', '<span class="gold-gradient-text italic">Tasikmalaya</span>', $heroTitleHtml);
    $heroPhone = \App\Models\Setting::get('whatsapp_number', '0812 3456 7890');
    $heroCars = $featuredCars->map(function ($car) {
        $category = $car->category ? \Illuminate\Support\Str::headline($car->category) : 'Rental Mobil';
        $meta = collect([
            $car->transmission,
            $car->passenger_capacity ? $car->passenger_capacity . ' Penumpang' : null,
        ])->filter()->implode(' / ');

        return [
            'id' => $car->id,
            'name' => $car->name,
            'image' => $car->getFirstMediaUrl('cars') ?: asset('banner-hero.png'),
            'price' => $car->price_per_day ? 'Rp ' . number_format((float) $car->price_per_day, 0, ',', '.') : 'Hubungi Admin',
            'category' => $category,
            'meta' => $meta,
            'url' => route('cars.show', $car),
        ];
    })->values();

    if ($heroCars->isEmpty()) {
        $heroCars = collect([
            [
                'id' => null,
                'name' => 'Toyota Hiace',
                'image' => asset('banner-hero.png'),
                'price' => 'Hubungi Admin',
                'category' => 'Rental Mobil',
                'meta' => 'Automatic / 7 Penumpang',
                'url' => route('cars.index'),
            ],
        ]);
    }
@endphp

<div class="home-typography">

{{-- ═══════════════════════════════════════
     HERO
═══════════════════════════════════════ --}}
<section class="relative overflow-hidden bg-white pt-24 pb-14 md:pt-28 md:pb-20 xl:pt-32 xl:pb-24">
    <div class="pointer-events-none absolute inset-0">
        <div class="absolute left-[-8rem] top-20 h-64 w-64 rounded-full bg-[#C9A14A]/10 blur-3xl"></div>
        <div class="absolute right-[-10rem] top-0 h-[28rem] w-[28rem] rounded-full bg-[#C9A14A]/12 blur-3xl"></div>
        <div class="absolute right-0 top-0 h-full w-full bg-[linear-gradient(115deg,rgba(255,255,255,0)_42%,rgba(251,245,232,0.85)_100%)] lg:w-1/2"></div>
    </div>

    <div class="page-shell relative z-10">
        <div class="grid items-center gap-y-10 gap-x-10 xl:gap-x-14 lg:grid-cols-[0.9fr_1.02fr]">
            <div class="max-w-xl space-y-5 md:max-w-2xl md:space-y-6">
                <div class="space-y-4 md:space-y-5">
                    <h1 class="max-w-[12ch] text-[2.2rem] font-bold leading-[0.98] tracking-[-0.05em] text-[#0B0B0B] sm:text-[3rem] lg:text-[3.95rem] xl:text-[4.35rem] font-heading">
                        {!! $heroTitleHtml !!}
                    </h1>
                    <p class="max-w-lg text-[14px] leading-7 text-slate-600 md:text-[15px] md:leading-8">
                        {{ $heroSubtitle }}
                    </p>
                </div>

                <div class="flex flex-col gap-4 sm:flex-row">
                    <a href="#booking-form"
                        class="group inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-[#0B0B0B] px-6 py-4 text-sm font-bold text-white shadow-[0_24px_60px_-24px_rgba(11,11,11,0.75)] transition-all hover:-translate-y-0.5 sm:w-auto sm:px-7 sm:text-base">
                        <span>Pesan Sekarang</span>
                        <i class="fa-solid fa-arrow-right-long text-amber-500 transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin booking via WhatsApp.') }}"
                        class="inline-flex w-full items-center justify-center gap-3 rounded-2xl border border-slate-200 bg-white px-6 py-4 text-sm font-semibold text-slate-900 shadow-sm transition-all hover:border-[#C9A14A]/30 hover:bg-amber-50/60 sm:w-auto sm:px-7 sm:text-base">
                        <i class="fa-brands fa-whatsapp text-emerald-500 text-lg"></i>
                        <span>Chat WhatsApp</span>
                    </a>
                </div>

            </div>


            <div class="mx-auto w-full max-w-[34rem] lg:max-w-[36rem]">
                <div class="relative px-2 py-5 sm:px-4 sm:py-6 sm:pb-24 lg:px-6 lg:py-7 lg:pb-24"
                    x-data="heroCarousel(@js($heroCars))"
                    x-init="init()"
                    @mouseenter="pauseAutoplay()"
                    @mouseleave="startAutoplay()">
                    <div class="absolute inset-x-10 top-14 h-52 rounded-full bg-[#C9A14A]/18 blur-3xl"></div>

                    <div class="absolute -left-1 top-2 z-20 rounded-[1.1rem] border border-slate-100 bg-white/95 px-3 py-2.5 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.35)] backdrop-blur sm:-left-4 sm:top-6 sm:rounded-[1.25rem] sm:px-4 sm:py-3 lg:-left-6 lg:top-7">
                        <div class="text-[11px] font-medium text-slate-400">Mulai dari</div>
                        <div class="mt-1 text-xl font-black leading-none text-[#8D6A2B] font-heading sm:text-2xl" x-text="currentCar.price"></div>
                        <div class="mt-1 text-xs text-slate-500">/hari</div>
                    </div>

                    <a href="{{ $googleReviewUrl }}" target="_blank" rel="noopener noreferrer"
                        class="absolute right-0 top-14 z-20 hidden rounded-[1.1rem] border border-slate-100 bg-white/95 px-3 py-2.5 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.35)] backdrop-blur sm:block sm:right-2">
                        <div class="flex items-center gap-1 text-[#C9A14A]">
                            @for ($i = 0; $i < 5; $i++)
                                <i class="fa-solid fa-star text-[10px]"></i>
                            @endfor
                        </div>
                        <div class="mt-2 text-sm font-black text-[#0B0B0B]">4.9 / 5.0</div>
                        <div class="text-[11px] text-slate-500">500+ review</div>
                    </a>

                    <div class="relative mx-auto flex min-h-[15rem] items-center justify-center pt-8 sm:min-h-[18rem] sm:pt-8 lg:min-h-[21rem] lg:pt-6"
                        @touchstart.passive="handleTouchStart($event)"
                        @touchend.passive="handleTouchEnd($event)">
                        <div class="relative h-[16rem] w-[16rem] sm:h-[19rem] sm:w-[19rem] lg:h-[21rem] lg:w-[21rem]">
                            <div class="absolute inset-0 rounded-full border-[14px] border-[#C9A14A]/10 sm:border-[16px]"></div>
                            <div class="absolute inset-5 rounded-full border-[10px] border-slate-900/5 sm:inset-6 sm:border-[12px]"></div>
                            <div class="absolute inset-7 rounded-full bg-[#C9A14A]/12 blur-3xl"></div>
                            <div class="absolute inset-x-6 bottom-6 h-14 rounded-full bg-[#C9A14A]/20 blur-3xl"></div>

                            <template x-for="(car, index) in cars" :key="car.id ?? index">
                                <img x-show="active === index"
                                    x-transition:enter="transition ease-out duration-500"
                                    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                                    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave="transition ease-in duration-300"
                                    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                                    x-transition:leave-end="opacity-0 -translate-y-4 scale-95"
                                    :src="car.image"
                                    :alt="car.name"
                                    class="absolute bottom-0 left-1/2 z-10 w-[19rem] max-w-none -translate-x-1/2 object-contain drop-shadow-[0_28px_32px_rgba(15,23,42,0.2)] sm:w-[22rem] lg:w-[23rem]"
                                    loading="eager"
                                    fetchpriority="high"
                                    width="600"
                                    height="400"
                                    decoding="async">
                            </template>
                        </div>

                        <button type="button"
                            class="absolute left-0 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/90 text-slate-700 shadow-lg backdrop-blur transition hover:border-[#C9A14A] hover:text-[#8D6A2B] sm:inline-flex"
                            @click="prev()"
                            x-show="cars.length > 1">
                            <i class="fa-solid fa-chevron-left text-sm"></i>
                        </button>

                        <button type="button"
                            class="absolute right-0 top-1/2 z-20 hidden h-11 w-11 -translate-y-1/2 items-center justify-center rounded-full border border-slate-200 bg-white/90 text-slate-700 shadow-lg backdrop-blur transition hover:border-[#C9A14A] hover:text-[#8D6A2B] sm:inline-flex"
                            @click="next()"
                            x-show="cars.length > 1">
                            <i class="fa-solid fa-chevron-right text-sm"></i>
                        </button>
                    </div>

                    <a :href="currentCar.url"
                        class="relative z-20 mx-auto mt-4 block max-w-[16rem] rounded-[1.1rem] border border-slate-100 bg-white/95 p-3 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.35)] backdrop-blur transition hover:-translate-y-0.5 hover:shadow-[0_22px_55px_-30px_rgba(15,23,42,0.45)] sm:absolute sm:bottom-[-1.5rem] sm:left-[35%] sm:mt-0 sm:w-[14rem] sm:max-w-none sm:-translate-x-1/2 sm:rounded-[1.25rem] sm:p-3 lg:bottom-[-1.1rem] lg:left-[36%] lg:w-[14.5rem]">
                        <div>
                            <div class="text-[15px] font-black tracking-tight text-[#0B0B0B] font-heading sm:text-base" x-text="currentCar.name"></div>
                            <div class="mt-1 text-xs leading-5 text-slate-500 sm:text-[13px]" x-text="[currentCar.category, currentCar.meta].filter(Boolean).join(' / ')"></div>
                        </div>
                    </a>

                    <div class="relative z-20 mt-3 ml-auto flex w-full max-w-[10rem] items-center gap-2.5 rounded-[1rem] border border-slate-100 bg-white/95 px-3 py-2 shadow-[0_18px_45px_-28px_rgba(15,23,42,0.35)] backdrop-blur sm:absolute sm:bottom-4 sm:right-0 sm:mt-0 sm:max-w-[10.25rem] lg:bottom-5">
                        <span class="flex h-3 w-3 shrink-0 rounded-full bg-emerald-400 shadow-[0_0_0_4px_rgba(74,222,128,0.18)]"></span>
                        <div>
                            <div class="text-xs font-black text-[#0B0B0B]">{{ $featuredCars->count() ?: 6 }}+ kendaraan</div>
                            <div class="text-[11px] text-slate-500">Tersedia sekarang</div>
                        </div>
                    </div>

                    <div class="relative z-20 mt-6 flex items-center justify-center gap-2 sm:absolute sm:bottom-[-3.1rem] sm:left-1/2 sm:mt-0 sm:-translate-x-1/2" x-show="cars.length > 1">
                        <template x-for="(car, index) in cars" :key="'dot-' + (car.id ?? index)">
                            <button type="button"
                                class="h-2.5 rounded-full transition-all duration-300"
                                :class="active === index ? 'w-6 bg-[#C9A14A]' : 'w-2.5 bg-slate-300/70'"
                                @click="goTo(index)">
                                <span class="sr-only" x-text="'Lihat slide ' + (index + 1)"></span>
                            </button>
                        </template>
                    </div>

                    <div class="mt-4 flex items-center justify-center gap-3 text-xs text-slate-500 sm:hidden">
                        <span class="font-semibold">{{ $heroPhone }}</span>
                        <span class="h-1 w-1 rounded-full bg-slate-300"></span>
                        <span>{{ $featuredCars->count() ?: 6 }}+ kendaraan</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     SERVICES
═══════════════════════════════════════ --}}
<section class="bg-slate-50 py-16 md:py-24">
    <div class="page-shell">
        <div class="flex flex-col gap-4 md:flex-row md:items-end md:justify-between">
            <div data-aos="fade-up">
                <p class="section-kicker">Review Pelanggan Tasikmalaya</p>
                <h2 class="section-title text-premium-gradient">Dipercaya pelanggan di Tasikmalaya</h2>
                <p class="section-copy copy-strong">Ulasan singkat dari pelanggan yang sudah booking untuk kebutuhan harian, keluarga, dan perjalanan luar kota.</p>
            </div>
            <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin tanya jadwal mobil yang tersedia.') }}"
                class="group inline-flex items-center gap-2 text-sm font-black text-slate-900">
                Tanya Ketersediaan
                <i class="fa-solid fa-arrow-right-long text-[#C9A14A] transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <div class="mt-8 grid gap-6 md:grid-cols-3 md:gap-8">
            @foreach ($testimonials->take(3) as $testimonial)
                <article class="card-premium p-6"
                    data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div class="flex items-center gap-1 text-[#C9A14A]">
                        @for ($i = 0; $i < 5; $i++)
                            <i class="fa-solid fa-star text-xs"></i>
                        @endfor
                    </div>
                    <p class="mt-4 line-clamp-3 text-[15px] leading-7 copy-strong">"{{ $testimonial->content }}"</p>
                    <div class="mt-5 flex items-center gap-3">
                        <div class="flex h-11 w-11 items-center justify-center rounded-full bg-amber-50 text-sm font-black text-[#C9A14A]">
                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                        </div>
                        <div>
                            <div class="font-bold text-[#0B0B0B]">{{ $testimonial->name }}</div>
                            <div class="text-xs text-slate-500">{{ $testimonial->occupation ?: 'Pelanggan CJA RENT CAR' }}</div>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

<section class="bg-white py-16 md:py-20">
    <div class="page-shell">
        <div class="max-w-3xl" data-aos="fade-up">
            <p class="section-kicker">Sewa Mobil Tasikmalaya Cepat</p>
            <h2 class="section-title text-premium-gradient">Cara Booking Sewa Mobil Tasikmalaya Lebih Cepat</h2>
            <p class="section-copy copy-strong">Pilih cara booking <strong>rental mobil Tasikmalaya</strong> yang paling sesuai. WhatsApp untuk respon sangat cepat hari ini, atau gunakan form untuk kebutuhan penyewaan yang lebih terjadwal dengan detail yang jelas.</p>
        </div>

        <div class="mt-8 grid gap-6 lg:grid-cols-[1fr_1fr_1.05fr] lg:gap-8">
            <div class="card-premium p-6 md:p-7" data-aos="fade-up" data-aos-delay="100">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-50 text-emerald-600 shadow-sm">
                    <i class="fa-brands fa-whatsapp text-2xl"></i>
                </div>
                <p class="mt-5 text-[10px] font-black uppercase tracking-[0.22em] text-[#C9A14A]">Booking via WhatsApp</p>
                <h3 class="mt-2 text-xl font-black tracking-tight text-[#0B0B0B] font-heading">Paling cepat untuk cek unit tersedia</h3>
                <p class="mt-3 text-sm leading-7 copy-strong">Cocok untuk pelanggan yang ingin tanya harga, cek armada kosong, atau booking cepat tanpa isi data panjang.</p>
                <div class="mt-5 space-y-2 text-sm text-slate-600">
                    <div>Balasan lebih cepat untuk kebutuhan hari ini</div>
                    <div>Bisa langsung kirim tanggal dan lokasi</div>
                    <div>Admin bantu rekomendasi unit yang cocok</div>
                </div>
                <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin cek mobil yang tersedia hari ini.') }}" class="group mt-6 inline-flex items-center gap-2 rounded-2xl bg-[#0B0B0B] px-5 py-3.5 text-sm font-black text-white shadow-[0_18px_40px_-24px_rgba(11,11,11,0.78)]">
                    Chat WhatsApp
                    <i class="fa-solid fa-arrow-right-long text-[#C9A14A] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>

            <div class="card-premium-soft p-6 md:p-7" data-aos="fade-up" data-aos-delay="180">
                <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-[#C9A14A] shadow-sm">
                    <i class="fa-solid fa-file-contract text-2xl"></i>
                </div>
                <p class="mt-5 text-[10px] font-black uppercase tracking-[0.22em] text-[#C9A14A]">Booking via Form</p>
                <h3 class="mt-2 text-xl font-black tracking-tight text-[#0B0B0B] font-heading">Lebih pas untuk kebutuhan yang detail</h3>
                <p class="mt-3 text-sm leading-7 copy-strong">Gunakan form jika Anda sudah siap isi nama, WhatsApp, layanan, tanggal, dan lokasi penjemputan sekaligus.</p>
                <div class="mt-5 space-y-2 text-sm text-slate-600">
                    <div>Praktis untuk permintaan terjadwal</div>
                    <div>Data booking masuk lebih lengkap</div>
                    <div>Cocok untuk perjalanan keluarga atau dinas</div>
                </div>
                <a href="#booking-form" class="group mt-6 inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-black text-slate-900 shadow-sm transition-all hover:border-amber-200 hover:bg-amber-50/70">
                    Isi Form Booking
                    <i class="fa-solid fa-arrow-right-long text-[#C9A14A] transition-transform group-hover:translate-x-1"></i>
                </a>
            </div>

            <div class="card-premium-dark p-6 md:p-7" data-aos="fade-up" data-aos-delay="260">
                <div class="relative z-10">
                    <p class="text-[10px] font-black uppercase tracking-[0.22em] text-[#C9A14A]">Google Review & Lokasi</p>
                    <h3 class="mt-3 text-xl font-black tracking-tight text-white font-heading">CJA Rentcar terdaftar di Google Maps</h3>
                    <p class="mt-3 text-sm leading-7 text-slate-300">Buka lokasi bisnis untuk melihat rute, posisi usaha di Tasikmalaya, dan ulasan pelanggan langsung dari Google Maps.</p>
                    <div class="mt-5 rounded-2xl border border-white/10 bg-white/5 p-4">
                        <div class="text-sm font-black text-white">Rental Mobil Lepas Kunci Tasikmalaya Cipawitra Jaya Abadi (CJA Rentcar)</div>
                        <div class="mt-2 text-sm text-slate-300">Cipawitra, Tasikmalaya</div>
                        <div class="mt-1 text-xs uppercase tracking-[0.2em] text-[#C9A14A]">Lokasi bisnis terverifikasi di Maps</div>
                    </div>
                    <div class="mt-5 flex flex-col gap-3 sm:flex-row lg:flex-col">
                        <a href="{{ $googleReviewUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-white px-5 py-3.5 text-sm font-black text-slate-900 shadow-sm">
                            Lihat Review Google
                            <i class="fa-solid fa-star text-amber-500"></i>
                        </a>
                        <a href="{{ $googleReviewUrl }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center justify-center gap-2 rounded-2xl border border-white/10 bg-white/5 px-5 py-3.5 text-sm font-black text-white transition-all hover:bg-white/10">
                            Buka Lokasi di Maps
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-16 md:py-24">
    <div class="page-shell">
        <div class="text-center" data-aos="fade-up">
            <p class="section-kicker">Langkah Sewa</p>
            <h2 class="section-title text-premium-gradient">Booking mobil lebih cepat dalam 3 langkah</h2>
        </div>

        <div class="mt-10 grid gap-6 md:grid-cols-3 md:gap-8">
            @foreach ([['title' => 'Pilih mobil', 'copy' => 'Lihat unit yang tersedia dan pilih armada sesuai kebutuhan perjalanan Anda.'], ['title' => 'Hubungi via WhatsApp', 'copy' => 'Kirim detail tanggal, lokasi, dan kebutuhan Anda agar admin bisa bantu cek ketersediaan.'], ['title' => 'Mobil siap digunakan', 'copy' => 'Setelah konfirmasi, unit disiapkan dan siap dipakai untuk kebutuhan harian atau luar kota.']] as $step)
                <div class="card-premium-soft p-6 md:p-7" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-[#0B0B0B] text-sm font-black text-white shadow-lg shadow-slate-900/10">{{ $loop->iteration }}</div>
                    <h3 class="mt-5 text-xl font-black tracking-tight text-[#0B0B0B] font-heading">{{ $step['title'] }}</h3>
                    <p class="mt-3 text-sm leading-7 copy-strong">{{ $step['copy'] }}</p>
                </div>
            @endforeach
        </div>
    </div>
</section>

<section class="py-16 md:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 md:mb-16" data-aos="fade-up">
            <p class="text-[10px] font-bold gold-gradient-text uppercase tracking-[0.35em] mb-3">Layanan Rental Tasikmalaya</p>
            <h2 class="text-2xl md:text-4xl lg:text-5xl font-black tracking-tight leading-tight text-premium-gradient">Solusi Rental Mobil <br class="hidden md:block"> Tasikmalaya</h2>
        </div>

        <div x-data="{ activeService: null }" class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
            {{-- Rental Mobil --}}
            <button type="button" @click="activeService = 'car'" class="group text-left" data-aos="fade-up" data-aos-delay="100">
                <div class="h-full p-6 md:p-8 rounded-2xl md:rounded-[2.5rem] border transition-all duration-500 hover:-translate-y-2"
                    :class="activeService === 'car'
                        ? 'bg-slate-900 border-slate-900 shadow-[0_30px_70px_-25px_rgba(15,23,42,0.45)]'
                        : 'bg-white border-slate-100 shadow-[0_16px_40px_-28px_rgba(15,23,42,0.18)] hover:bg-[#fffaf0] hover:border-amber-200/50 hover:shadow-[0_26px_60px_-30px_rgba(201,161,74,0.2)]'">
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl flex items-center justify-center mb-5 transition-all duration-500 shadow-sm"
                        :class="activeService === 'car' ? 'bg-white/10 text-[#D4AF37]' : 'bg-amber-50 text-[#D4AF37] group-hover:bg-[#D4AF37] group-hover:text-white group-hover:shadow-lg'">
                        <i class="fa-solid fa-car-side text-2xl md:text-3xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-black mb-2 md:mb-3 tracking-tight transition-colors"
                        :class="activeService === 'car' ? 'text-white' : 'text-slate-900'">Sewa Mobil & Driver</h3>
                    <p class="text-sm leading-relaxed transition-colors"
                        :class="activeService === 'car' ? 'text-slate-300' : 'text-slate-500'">Rental mobil Tasikmalaya untuk harian, luar kota, antar jemput, dan perjalanan keluarga dengan pilihan driver berpengalaman.</p>
                </div>
            </button>

            {{-- Rental Motor --}}
            <button type="button" @click="activeService = 'motor'" class="group text-left" data-aos="fade-up" data-aos-delay="200">
                <div class="h-full p-6 md:p-8 rounded-2xl md:rounded-[2.5rem] border transition-all duration-500 hover:-translate-y-2"
                    :class="activeService === 'motor'
                        ? 'bg-slate-900 border-slate-900 shadow-[0_30px_70px_-25px_rgba(15,23,42,0.45)]'
                        : 'bg-white border-slate-100 shadow-[0_16px_40px_-28px_rgba(15,23,42,0.18)] hover:bg-[#fffaf0] hover:border-amber-200/50 hover:shadow-[0_26px_60px_-30px_rgba(201,161,74,0.2)]'">
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl flex items-center justify-center mb-5 transition-all duration-500 shadow-sm"
                        :class="activeService === 'motor' ? 'bg-white/10 text-[#D4AF37]' : 'bg-amber-50 text-[#D4AF37] group-hover:bg-[#D4AF37] group-hover:text-white group-hover:shadow-lg'">
                        <i class="fa-solid fa-motorcycle text-2xl md:text-3xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-black mb-2 md:mb-3 tracking-tight transition-colors"
                        :class="activeService === 'motor' ? 'text-white' : 'text-slate-900'">Rental Motor </h3>
                    <p class="text-sm leading-relaxed transition-colors"
                        :class="activeService === 'motor' ? 'text-slate-300' : 'text-slate-500'">Sewa motor Tasikmalaya untuk mobilitas harian yang praktis, hemat, dan cocok untuk kebutuhan perjalanan singkat di dalam kota.</p>
                </div>
            </button>

            {{-- Paket Wisata --}}
            <button type="button" @click="activeService = 'tour'" class="group text-left" data-aos="fade-up" data-aos-delay="300">
                <div class="h-full p-6 md:p-8 rounded-2xl md:rounded-[2.5rem] border transition-all duration-500 hover:-translate-y-2"
                    :class="activeService === 'tour'
                        ? 'bg-slate-900 border-slate-900 shadow-[0_30px_70px_-25px_rgba(15,23,42,0.45)]'
                        : 'bg-white border-slate-100 shadow-[0_16px_40px_-28px_rgba(15,23,42,0.18)] hover:bg-[#fffaf0] hover:border-amber-200/50 hover:shadow-[0_26px_60px_-30px_rgba(201,161,74,0.2)]'">
                    <div class="w-14 h-14 md:w-16 md:h-16 rounded-2xl flex items-center justify-center mb-5 transition-all duration-500 shadow-sm"
                        :class="activeService === 'tour' ? 'bg-white/10 text-[#D4AF37]' : 'bg-amber-50 text-[#D4AF37] group-hover:bg-[#D4AF37] group-hover:text-white group-hover:shadow-lg'">
                        <i class="fa-solid fa-map-location-dot text-2xl md:text-3xl"></i>
                    </div>
                    <h3 class="text-base md:text-xl font-black mb-2 md:mb-3 tracking-tight transition-colors"
                        :class="activeService === 'tour' ? 'text-white' : 'text-slate-900'">Paket Wisata</h3>
                    <p class="text-sm leading-relaxed transition-colors"
                        :class="activeService === 'tour' ? 'text-slate-300' : 'text-slate-500'">Paket wisata dengan armada nyaman dan itinerary praktis untuk perjalanan rombongan, keluarga, atau agenda liburan dari Tasikmalaya.</p>
                </div>
            </button>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     FLEET
═══════════════════════════════════════ --}}
<section class="py-16 md:py-24 bg-white overflow-hidden">
    <div class="page-shell">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between" data-aos="fade-up">
            <div>
                <p class="section-kicker">Mobil Tasikmalaya Terlaris</p>
                <h2 class="section-title text-premium-gradient">Pilihan Sewa Mobil Murah Tasikmalaya</h2>
                <p class="section-copy copy-strong">Temukan armada <strong>sewa mobil murah Tasikmalaya</strong> yang rutin dibooking pelanggan kami. Tersedia pilihan <strong>rental mobil lepas kunci Tasikmalaya</strong> atau menggunakan driver untuk menemani perjalanan wisata dan bisnis Anda.</p>
                @if ($promoCar)
                    <div class="mt-4 inline-flex items-center gap-3 rounded-2xl border border-amber-200/60 bg-amber-50/70 px-4 py-3 text-sm shadow-sm">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-[#C9A14A]">Harga Mulai</span>
                        <span class="font-black text-[#0B0B0B]">{{ $promoCar->name }}</span>
                        <span class="font-black text-[#0B0B0B]">Rp {{ number_format($promoCar->price_per_day, 0, ',', '.') }}/hari</span>
                    </div>
                @endif
            </div>
            <a href="{{ route('cars.index') }}" class="group inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-900 shadow-sm">
                Lihat Semua Mobil
                <i class="fa-solid fa-arrow-right-long text-[#C9A14A] transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        @php
            $highlightCar = $featuredCars->first();
        @endphp

        @if ($highlightCar)
            <div class="card-premium mt-8" data-aos="fade-up">
                <div class="grid lg:grid-cols-[0.92fr_1.08fr]">
                    <div class="relative overflow-hidden rounded-tl-[inherit] rounded-tr-[inherit] lg:rounded-tr-none lg:rounded-bl-[inherit] lg:h-full">
                        <img src="{{ $highlightCar->getFirstMediaUrl('cars') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=1200' }}"
                            alt="{{ $highlightCar->name }}" class="w-full h-full min-h-[250px] object-cover object-top lg:min-h-[350px]">
                        <div class="kicker-soft absolute left-4 top-4 gap-2 shadow-md">
                            Paling Laris
                        </div>
                    </div>
                    <div class="flex flex-col justify-between p-6">
                        <div>
                            <div class="kicker-soft gap-2 border-0 bg-slate-100 text-slate-500">
                                {{ $highlightCar->brand }}
                            </div>
                            <h3 class="mt-3 text-[1.8rem] font-bold tracking-tight text-[#0B0B0B] font-heading md:text-[2.1rem]">{{ $highlightCar->name }}</h3>
                            <p class="mt-3 text-sm leading-6 copy-strong md:text-base">
                                {{ \Illuminate\Support\Str::limit(strip_tags($highlightCar->description ?: 'Cocok untuk kebutuhan harian, keluarga, perjalanan dinas, dan luar kota dengan kabin nyaman dan perawatan rutin.'), 150) }}
                            </p>
                        </div>

                        <div class="mt-6">
                            <div class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">Mulai dari</div>
                            <div class="mt-1 text-2xl font-bold tracking-tight text-premium-gradient md:text-[2.35rem]">Rp {{ number_format($highlightCar->price_per_day, 0, ',', '.') }}</div>
                            <div class="text-sm text-slate-500">/ hari</div>

                            <div class="mt-5 flex flex-wrap gap-3">
                                <div class="spec-chip">{{ $highlightCar->passenger_capacity }} Kursi</div>
                                <div class="spec-chip">{{ $highlightCar->transmission }}</div>
                                <div class="spec-chip">{{ $highlightCar->brand }}</div>
                            </div>

                            <div class="mt-6 flex flex-col gap-3 sm:flex-row">
                                <a href="{{ route('cars.show', $highlightCar) }}"
                                    class="group inline-flex items-center justify-center gap-2 rounded-xl bg-[#0B0B0B] px-5 py-3.5 text-sm font-bold text-white">
                                    Detail Mobil
                                    <i class="fa-solid fa-arrow-right text-amber-500 transition-transform group-hover:translate-x-1"></i>
                                </a>
                                <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin booking ' . $highlightCar->name . ' untuk tanggal tertentu.') }}"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl border border-slate-200 bg-white px-5 py-3.5 text-sm font-semibold text-slate-900 transition-all hover:border-emerald-200 hover:bg-emerald-50/60">
                                    Booking via WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif

        <div class="mt-8 grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($secondaryCars as $car)
                <article class="card-premium rounded-[1.6rem]"
                    data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 75 }}">
                    <div class="relative">
                        <img src="{{ $car->getFirstMediaUrl('cars') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=900' }}"
                            alt="{{ $car->name }}" class="aspect-[16/10] w-full object-cover">
                        <div class="kicker-soft absolute left-3 top-3 shadow">
                            {{ $loop->first ? 'Rekomendasi' : 'Siap Booking' }}
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold tracking-tight text-[#0B0B0B] font-heading">{{ $car->name }}</h3>
                                <p class="mt-1 text-sm text-slate-500">{{ $car->brand }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">Mulai dari</div>
                                <div class="mt-1 text-2xl font-bold tracking-tight text-premium-gradient">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}</div>
                                <div class="text-xs text-slate-500">/ hari</div>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="spec-chip px-3 py-2.5">
                                <div class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Kapasitas</div>
                                <div class="mt-1 text-sm font-black text-slate-700">{{ $car->passenger_capacity }} Kursi</div>
                            </div>
                            <div class="spec-chip px-3 py-2.5">
                                <div class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Transmisi</div>
                                <div class="mt-1 text-sm font-black text-slate-700">{{ $car->transmission }}</div>
                            </div>
                        </div>

                        <p class="mt-5 line-clamp-2 text-sm leading-6 copy-strong">
                            {{ $car->description ?: 'Unit terawat and siap dipakai untuk kebutuhan perjalanan harian maupun luar kota.' }}
                        </p>

                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('cars.show', $car) }}"
                                class="flex-1 inline-flex items-center justify-center rounded-xl bg-[#0B0B0B] px-4 py-3.5 text-sm font-bold text-white">
                                Detail Mobil
                            </a>
                            <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya tertarik dengan mobil ' . $car->name . '.') }}"
                                aria-label="Chat WhatsApp untuk {{ $car->name }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-3.5 text-emerald-600 transition-colors hover:border-emerald-200 hover:bg-emerald-50">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     MOTORCYCLES
═══════════════════════════════════════ --}}
@if($featuredMotorcycles->isNotEmpty())
<section class="py-16 md:py-24 bg-slate-50 border-t border-slate-100">
    <div class="page-shell">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-end lg:justify-between mb-8 md:mb-12" data-aos="fade-up">
            <div>
                <p class="section-kicker">Rental Motor Tasikmalaya</p>
                <h2 class="section-title text-premium-gradient">Sewa Motor Harian Tasikmalaya Matik</h2>
                <p class="section-copy copy-strong">Cari kendaraan yang gesit? <strong>Rental motor Tasikmalaya</strong> kami adalah solusinya. Armada matic terawat, irit bahan bakar, sangat pas untuk mobilitas kota atau mendatangi tempat <strong>wisata Tasikmalaya hits</strong>.</p>
            </div>
            <a href="{{ route('motorcycles.index') }}" class="group inline-flex items-center gap-2 rounded-2xl border border-slate-200 bg-white px-5 py-3 text-sm font-black text-slate-900 shadow-sm">
                Lihat Semua Motor
                <i class="fa-solid fa-arrow-right-long text-[#C9A14A] transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
            @foreach ($featuredMotorcycles as $motor)
                <article class="card-premium rounded-[1.6rem]"
                    data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 75 }}">
                    <div class="relative">
                        <img src="{{ $motor->getFirstMediaUrl('motorcycles') ?: 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&q=80&w=900' }}"
                            alt="{{ $motor->name }}" class="aspect-[16/10] w-full object-cover">
                        <div class="kicker-soft absolute left-3 top-3 shadow">
                            Siap Booking
                        </div>
                    </div>

                    <div class="p-6">
                        <div class="flex items-start justify-between gap-4">
                            <div>
                                <h3 class="text-xl font-bold tracking-tight text-[#0B0B0B] font-heading">{{ $motor->name }}</h3>
                                <p class="mt-1 text-sm text-slate-500">{{ $motor->brand }}</p>
                            </div>
                            <div class="text-right">
                                <div class="text-xs font-medium uppercase tracking-[0.18em] text-slate-500">Mulai dari</div>
                                <div class="mt-1 text-2xl font-bold tracking-tight text-premium-gradient">Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}</div>
                                <div class="text-xs text-slate-500">/ hari</div>
                            </div>
                        </div>

                        <div class="mt-5 grid grid-cols-2 gap-3">
                            <div class="spec-chip px-3 py-2.5">
                                <div class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Mesin</div>
                                <div class="mt-1 text-sm font-black text-slate-700">{{ $motor->engine_capacity }} cc</div>
                            </div>
                            <div class="spec-chip px-3 py-2.5">
                                <div class="text-[11px] font-semibold uppercase tracking-[0.18em] text-slate-400">Tipe</div>
                                <div class="mt-1 text-sm font-black text-slate-700">Matic</div>
                            </div>
                        </div>

                        <p class="mt-5 line-clamp-2 text-sm leading-6 copy-strong">
                            {{ $motor->description ?: 'Motor matic terawat, irit bensin, dan nyaman dipakai untuk mobilitas harian di Tasikmalaya.' }}
                        </p>

                        <div class="mt-6 flex gap-3">
                            <a href="{{ route('motorcycles.show', $motor) }}"
                                class="flex-1 inline-flex items-center justify-center rounded-xl bg-[#0B0B0B] px-4 py-3.5 text-sm font-bold text-white">
                                Detail Motor
                            </a>
                            <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya tertarik dengan motor ' . $motor->name . '.') }}"
                                aria-label="Chat WhatsApp untuk {{ $motor->name }}"
                                class="inline-flex items-center justify-center rounded-xl border border-slate-200 px-4 py-3.5 text-emerald-600 transition-colors hover:border-emerald-200 hover:bg-emerald-50">
                                <i class="fa-brands fa-whatsapp text-lg"></i>
                            </a>
                        </div>
                    </div>
                </article>
            @endforeach
        </div>
    </div>
</section>
@endif

{{-- ═══════════════════════════════════════
     TOUR PACKAGES
═══════════════════════════════════════ --}}
<section class="py-16 md:py-24 bg-slate-900 relative overflow-hidden">
    <div class="absolute top-0 left-1/4 w-96 h-96 bg-[#D4AF37]/10 blur-[120px] rounded-full -mt-48 opacity-50 pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-10 md:mb-16" data-aos="fade-up">
            <p class="text-[10px] font-bold gold-gradient-text uppercase tracking-[0.35em] mb-3">Tour Tasikmalaya & Sekitarnya</p>
            <h2 class="text-2xl md:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">Paket Wisata Tasikmalaya Terbaik</h2>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-2 md:gap-8">
            @foreach($featuredTours as $tour)
            <div class="group" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 150 }}">
                <div class="bg-white/5 rounded-2xl md:rounded-[2.5rem] border border-white/10 overflow-hidden transition-all duration-500 hover:bg-white/10 hover:border-amber-500/30">
                    {{-- Image on top (mobile), side (desktop) --}}
                    <div class="flex flex-col sm:flex-row gap-0">
                        <div class="sm:w-2/5 aspect-[16/9] sm:aspect-auto overflow-hidden relative shrink-0">
                            <img src="{{ $tour->primary_image_url }}" alt="{{ $tour->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105" loading="lazy" decoding="async" width="400" height="225">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-950/60 to-transparent"></div>
                            <div class="absolute bottom-3 left-3">
                                <span class="px-3 py-1 bg-white/10 backdrop-blur-md border border-white/20 rounded-full text-[8px] font-black text-white uppercase tracking-wider">Most Popular</span>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center p-5 sm:p-6">
                            <h3 class="text-lg md:text-xl font-black text-white mb-1 leading-tight group-hover:text-amber-400 transition-colors">{{ $tour->name }}</h3>
                            <span class="text-[9px] font-black gold-gradient-text uppercase tracking-[0.25em] mb-4">{{ $tour->duration }}</span>
                            <div class="flex items-end justify-between mt-auto">
                                <div>
                                    <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Mulai Dari</p>
                                    <div class="text-lg font-black text-white">Rp {{ number_format($tour->price, 0, ',', '.') }}</div>
                                </div>
                                <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin bertanya tentang paket wisata: ' . $tour->name) }}"
                                   class="w-10 h-10 md:w-12 md:h-12 rounded-xl md:rounded-2xl bg-[#D4AF37] flex items-center justify-center text-slate-900 shadow-lg hover:-translate-y-0.5 transition-all">
                                    <i class="fa-solid fa-arrow-right-long text-slate-900 group-hover:translate-x-1 transition-transform"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     CTA BANNER
═══════════════════════════════════════ --}}
<section class="py-16 md:py-24 bg-white">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="relative overflow-hidden rounded-[2rem] border border-white/10 bg-[#0B0B0B] px-6 py-8 text-center shadow-2xl md:px-10 md:py-12 lg:px-16" data-aos="zoom-in">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(201,161,74,0.18),_transparent_65%)] opacity-70 pointer-events-none"></div>
            <div class="relative z-10 mx-auto max-w-3xl">
                <p class="inline-flex rounded-full bg-white/10 px-4 py-2 text-[11px] font-black uppercase tracking-[0.22em] text-[#C9A14A]">
                    Jadwal akhir pekan biasanya lebih cepat penuh
                </p>
                <h2 class="mt-4 text-3xl font-black leading-tight tracking-tight text-white md:text-5xl">
                    Amankan mobil lebih awal sebelum unit favorit habis di tanggal yang Anda mau
                </h2>
                <p class="mt-4 text-sm leading-7 text-slate-300 md:text-base">
                    WhatsApp untuk respon paling cepat. Form booking untuk kebutuhan yang lebih detail. Keduanya langsung masuk ke tim CJA RENT CAR.
                </p>
                <div class="mt-6 flex flex-wrap justify-center gap-2 text-xs font-semibold text-slate-200">
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2">Balasan admin cepat</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2">Cek unit sesuai tanggal</span>
                    <span class="rounded-full border border-white/10 bg-white/5 px-3 py-2">Prioritas untuk jadwal terdekat</span>
                </div>
                <div class="mt-8 flex flex-col justify-center gap-4 sm:flex-row">
                    <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin booking mobil untuk hari ini.') }}"
                       class="group inline-flex items-center justify-center gap-3 rounded-2xl bg-[#C9A14A] px-8 py-[1.125rem] text-base font-bold text-[#0B0B0B] shadow-[0_18px_40px_-24px_rgba(201,161,74,0.75)] transition-all hover:-translate-y-0.5">
                        <span>Booking via WhatsApp</span>
                        <i class="fa-brands fa-whatsapp text-lg"></i>
                    </a>
                    <a href="#booking-form"
                       class="inline-flex items-center justify-center rounded-2xl border border-white/10 bg-white/5 px-8 py-[1.125rem] text-base font-semibold text-white transition-all hover:bg-white/10">
                        Isi Form Booking
                    </a>
                </div>
                <p class="mt-6 text-xs text-slate-400">Admin biasanya merespons dalam <span class="text-[#C9A14A] font-bold">kurang dari 15 menit</span></p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     BOOKING FORM
═══════════════════════════════════════ --}}
<section id="booking-form" class="py-16 md:py-24 bg-slate-50 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-96 h-96 bg-amber-100/20 blur-[100px] rounded-full -mr-48 -mt-48 pointer-events-none"></div>

    <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="text-center mb-10 md:mb-16" data-aos="fade-up">
            <p class="text-[10px] font-bold gold-gradient-text uppercase tracking-[0.35em] mb-3">Form Booking Online</p>
            <h2 class="text-2xl md:text-4xl font-black text-slate-900 tracking-tight">Booking Rental Mobil Tasikmalaya</h2>
        </div>

        <div class="card-premium rounded-3xl md:rounded-[3rem] p-6 md:p-12" data-aos="zoom-in"
            x-data="{
                serviceType: '{{ old('service_type', '') }}',
                bookableId: '{{ old('bookable_id', '') }}',
                bookableType: '{{ old('bookable_type', '') }}',
                allCars: @js($allCars),
                allMotorcycles: @js($allMotorcycles),
                allTours: @js($allTours),
                get units() {
                    let list = [];
                    let type = '';
                    if (this.serviceType === 'Sewa Motor') {
                        list = this.allMotorcycles;
                        type = 'Motorcycle';
                    } else if (this.serviceType === 'Paket Wisata') {
                        list = this.allTours;
                        type = 'TourPackage';
                    } else if (['Rental Mobil Harian', 'Rental Mobil Luar Kota', 'Antar Jemput / Drop Off', 'Perjalanan Keluarga'].includes(this.serviceType)) {
                        list = this.allCars;
                        type = 'Car';
                    }
                    this.bookableType = type;
                    return list;
                }
            }">
            <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-5 md:space-y-6">
                @csrf
                <input type="hidden" name="bookable_type" :value="bookableType" x-model="bookableType">
                
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2 md:gap-6">

                    <div class="space-y-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">Nama Lengkap</label>
                        <input type="text" name="customer_name" value="{{ old('customer_name') }}" placeholder="Nama lengkap Anda" required
                               class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 placeholder:text-slate-300 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                    </div>

                    <div class="space-y-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">WhatsApp</label>
                        <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" placeholder="08xxxxxxxxxx" required
                               class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 placeholder:text-slate-300 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                    </div>

                    <div class="space-y-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">Layanan</label>
                        <select name="service_type" required x-model="serviceType"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                            <option value="" disabled>Pilih Layanan</option>
                            @foreach (['Rental Mobil Harian', 'Rental Mobil Luar Kota', 'Antar Jemput / Drop Off', 'Perjalanan Keluarga', 'Sewa Motor', 'Paket Wisata'] as $service)
                                <option value="{{ $service }}">{{ $service }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="space-y-2" x-show="units.length > 0" x-transition>
                        <label class="pl-1 text-sm font-medium text-slate-600">Pilih Unit/Paket</label>
                        <select name="bookable_id" x-model="bookableId" :required="units.length > 0"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                            <option value="">-- Melalui Daftar --</option>
                            <template x-for="unit in units" :key="unit.id">
                                <option :value="unit.id" x-text="(unit.brand ? unit.brand + ' ' : '') + unit.name"></option>
                            </template>
                        </select>
                    </div>

                    <div class="space-y-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">Pilihan Driver</label>
                        <select name="driver_option"
                                class="w-full appearance-none rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                            <option value="" disabled {{ old('driver_option') ? '' : 'selected' }}>Pilih Opsi</option>
                            <option value="lepas_kunci" {{ old('driver_option') == 'lepas_kunci' ? 'selected' : '' }}>Tanpa Driver / Lepas Kunci</option>
                            <option value="dengan_driver" {{ old('driver_option') == 'dengan_driver' ? 'selected' : '' }}>Dengan Driver</option>
                        </select>
                        <p class="pl-1 text-[10px] text-slate-400 font-bold uppercase tracking-wider">Khusus Layanan Mobil</p>
                    </div>

                    <div class="space-y-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">Email (Opsional)</label>
                        <input type="email" name="customer_email" value="{{ old('customer_email') }}" placeholder="email@contoh.com"
                               class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 placeholder:text-slate-300 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                    </div>

                    <div class="space-y-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">Tanggal Mulai</label>
                        <input type="date" name="start_date" value="{{ old('start_date') }}" required
                               class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                    </div>

                    <div class="space-y-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">Tanggal Selesai</label>
                        <input type="date" name="end_date" value="{{ old('end_date') }}"
                               class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                    </div>

                    <div class="space-y-2 md:col-span-2">
                        <label class="pl-1 text-sm font-medium text-slate-600">Lokasi Penjemputan</label>
                        <input type="text" name="location" value="{{ old('location') }}" placeholder="Alamat detail penjemputan" required
                               class="w-full rounded-lg border border-slate-200 bg-white px-4 py-3 text-base text-slate-900 placeholder:text-slate-300 transition-all focus:border-[#C9A14A] focus:outline-none focus:ring-2 focus:ring-amber-400/10">
                    </div>

                    {{-- Persyaratan Rental --}}
                    <x-frontend.booking-documents :compact="true" />
                </div>

                <div class="pt-4 text-center">
                    <button type="submit"
                            class="group inline-flex w-full items-center justify-center gap-3 rounded-2xl bg-slate-900 px-10 py-[1.125rem] text-base font-bold text-white shadow-xl transition-all hover:-translate-y-0.5 hover:bg-slate-800 md:w-auto">
                        <span>Kirim Permintaan Booking</span>
                        <i class="fa-solid fa-paper-plane text-amber-500 group-hover:translate-x-1 transition-transform group-hover:-translate-y-1"></i>
                    </button>
                    <p class="mt-4 text-xs text-slate-400">Tim kami menghubungi dalam <span class="text-[#D4AF37] font-bold">15 menit</span></p>
                </div>
            </form>
        </div>

        <div class="mt-6 grid gap-4 md:grid-cols-2" data-aos="fade-up" data-aos-delay="120">
            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm md:p-6">
                <p class="text-[10px] font-black uppercase tracking-[0.24em] text-[#C9A14A]">Persyaratan Booking</p>
                <h3 class="mt-3 text-lg font-black tracking-tight text-slate-900">Siapkan data dasar sebelum konfirmasi</h3>
                <div class="mt-4 space-y-2 text-sm leading-7 text-slate-600">
                    <div>KTP atau identitas aktif untuk verifikasi booking.</div>
                    <div>Nomor WhatsApp aktif agar admin mudah menghubungi.</div>
                    <div>Tanggal pemakaian, lokasi jemput, dan pilihan driver sudah jelas.</div>
                    <div>Khusus lepas kunci, admin dapat meminta dokumen pendukung saat konfirmasi.</div>
                </div>
            </div>

            <div class="rounded-3xl border border-slate-200 bg-white p-5 shadow-sm md:p-6">
                <p class="text-[10px] font-black uppercase tracking-[0.24em] text-[#C9A14A]">Catatan Penting</p>
                <h3 class="mt-3 text-lg font-black tracking-tight text-slate-900">Agar proses booking lebih cepat</h3>
                <div class="mt-4 space-y-2 text-sm leading-7 text-slate-600">
                    <div>Harga final mengikuti durasi, unit, dan opsi driver yang dipilih.</div>
                    <div>Jadwal dianggap aman setelah admin mengonfirmasi ketersediaan unit.</div>
                    <div>Untuk kebutuhan mendadak atau hari yang sama, sebaiknya lanjutkan juga via WhatsApp.</div>
                    <div>Tim CJA RENT CAR akan membantu cek unit dan syarat sesuai kebutuhan perjalanan Anda.</div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════════
     TESTIMONIALS
═══════════════════════════════════════ --}}
<section class="py-16 md:py-24 bg-slate-50">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mb-12 md:mb-16" data-aos="fade-up">
            <p class="text-[10px] font-bold gold-gradient-text uppercase tracking-[0.35em] mb-3">Keunggulan Layanan CJA</p>
            <h2 class="text-2xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight">Rental Mobil Tasikmalaya Andal, Transparan & Terpercaya</h2>
            <p class="mt-4 text-sm md:text-base text-slate-500 leading-relaxed">
                CJA RENT CAR hadir sebagai solusi transportasi Anda, mencakup layanan <strong>rental mobil + sopir Tasikmalaya</strong> hingga penyewaan motor harian. Kami memastikan kualitas kebersihan tiap armada dengan rincian harga wajar, bebas tambahan tak terduga, didukung layanan respon instan.
            </p>
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8" x-data="{ activeChoose: null }">
            <div class="card-premium rounded-3xl p-6 md:p-8" data-aos="fade-up" data-aos-delay="100">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-[#D4AF37]">
                    <i class="fa-solid fa-file-invoice-dollar text-2xl"></i>
                </div>
                <h3 class="mb-2 text-lg font-black tracking-tight text-slate-900">Harga dan Ketentuan Lebih Transparan</h3>
                <p class="text-sm leading-relaxed text-slate-500">Pelanggan lebih mudah membandingkan armada, durasi, dan kebutuhan sewa karena informasi unit disusun jelas dari awal.</p>
            </div>

            <div class="card-premium rounded-3xl p-6 md:p-8" data-aos="fade-up" data-aos-delay="200">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-[#D4AF37]">
                    <i class="fa-solid fa-clock-rotate-left text-2xl"></i>
                </div>
                <h3 class="mb-2 text-lg font-black tracking-tight text-slate-900">Respon Booking Lebih Cepat</h3>
                <p class="text-sm leading-relaxed text-slate-500">Admin membantu cek ketersediaan unit, konfirmasi jadwal, dan arahkan proses booking rental mobil Tasikmalaya lewat WhatsApp dengan cepat.</p>
            </div>

            <div class="card-premium rounded-3xl p-6 md:p-8" data-aos="fade-up" data-aos-delay="300">
                <div class="mb-4 inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-50 text-[#D4AF37]">
                    <i class="fa-solid fa-car-on text-2xl"></i>
                </div>
                <h3 class="mb-2 text-lg font-black tracking-tight text-slate-900">Armada Cocok untuk Banyak Kebutuhan</h3>
                <p class="text-sm leading-relaxed text-slate-500">Mulai dari city car, mobil keluarga, hingga paket perjalanan wisata, semua disiapkan untuk kebutuhan pengguna di Tasikmalaya dan sekitarnya.</p>
            </div>
        </div>
    </div>
</section>

@if ($faqs->isNotEmpty())
<section class="py-16 md:py-24 bg-white" x-data="{ activeFaq: 0 }">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-3xl" data-aos="fade-up">
                <p class="text-[10px] font-bold gold-gradient-text uppercase tracking-[0.35em] mb-3">Pertanyaan Umum</p>
                <h2 class="text-2xl md:text-4xl font-black text-slate-900 tracking-tight leading-tight">FAQ Rental Mobil Tasikmalaya</h2>
                <p class="mt-4 text-sm md:text-base text-slate-500 leading-relaxed">
                    Pertanyaan yang sering diajukan pelanggan sebelum booking, mulai dari syarat sewa, durasi pemakaian, sampai pilihan lepas kunci atau dengan driver.
                </p>
            </div>
            <a href="{{ route('faq') }}" class="group inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.3em] text-slate-900">
                Lihat Semua FAQ
                <i class="fa-solid fa-arrow-right-long text-[#D4AF37] transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <div class="mt-10 space-y-5">
            @foreach ($faqs->take(4) as $faq)
                <div class="card-premium-soft overflow-hidden rounded-[1.6rem]" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                    <button type="button" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left md:px-7"
                        @click="activeFaq = activeFaq === {{ $loop->index }} ? null : {{ $loop->index }}">
                        <span class="text-base font-black tracking-tight text-[#0B0B0B] md:text-lg">{{ $faq->question }}</span>
                        <span class="flex h-9 w-9 shrink-0 items-center justify-center rounded-full bg-white text-slate-600 transition-all"
                            :class="activeFaq === {{ $loop->index }} ? 'rotate-45 bg-amber-50 text-[#C9A14A]' : ''">+</span>
                    </button>
                    <div x-show="activeFaq === {{ $loop->index }}" x-transition.opacity.duration.200ms class="border-t border-slate-100 bg-white px-6 py-5 text-sm leading-7 text-slate-500 md:px-7">
                        {{ $faq->answer }}
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if ($posts->isNotEmpty())
<section class="py-16 md:py-24 bg-slate-900">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-col gap-8 lg:flex-row lg:items-end lg:justify-between">
            <div class="max-w-3xl" data-aos="fade-up">
                <p class="text-[10px] font-bold gold-gradient-text uppercase tracking-[0.35em] mb-3">Wawasan & Tips</p>
                <h2 class="text-2xl md:text-4xl font-black text-white tracking-tight leading-tight">Blog & Informasi Terbaru</h2>
                <p class="mt-4 text-sm md:text-base text-slate-400 leading-relaxed">
                    Kami juga membagikan artikel yang membantu calon pelanggan memahami pilihan armada, tips sewa mobil, dan referensi perjalanan agar keputusan booking lebih tepat.
                </p>
            </div>
            <a href="{{ route('posts.index') }}" class="group inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.3em] text-white">
                Baca Semua Artikel
                <i class="fa-solid fa-arrow-right-long text-[#D4AF37] transition-transform group-hover:translate-x-1"></i>
            </a>
        </div>

        <div class="mt-10 grid grid-cols-1 gap-6 md:grid-cols-3 md:gap-8">
            @foreach ($posts as $post)
            <article class="card-premium-dark overflow-hidden rounded-3xl border-white/10" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <a href="{{ route('posts.show', $post) }}" class="block aspect-[16/10] overflow-hidden">
                    <img src="{{ $post->getFirstMediaUrl('posts') ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=800' }}"
                        alt="{{ $post->title }} - artikel rental mobil Tasikmalaya"
                        class="h-full w-full object-cover transition-transform duration-700 hover:scale-105" loading="lazy" decoding="async">
                </a>
                <div class="p-6">
                    <p class="mb-3 text-[10px] font-black uppercase tracking-[0.3em] text-[#D4AF37]">{{ $post->published_at ? $post->published_at->format('d M Y') : 'Baru' }}</p>
                    <h3 class="mb-3 text-lg font-black tracking-tight text-white">
                        <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                    </h3>
                    <p class="text-sm leading-relaxed text-slate-400">{{ \Illuminate\Support\Str::limit(strip_tags($post->content), 110) }}</p>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>
@endif

</div>

@endsection
