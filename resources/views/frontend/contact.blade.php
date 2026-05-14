@extends('layouts.frontend')

@section('title', 'Kontak Rental Mobil Tasikmalaya - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'Hubungi Kami']]"
        badge="Admin Booking 24/7"
        title="Hubungi Rental Mobil"
        highlight="Tasikmalaya"
        description="Butuh booking cepat, cek ketersediaan unit, atau tanya harga sewa? Tim admin kami siap membantu kebutuhan rental mobil Tasikmalaya untuk harian, driver, dan perjalanan luar kota."
        glow="left"
    />

    <!-- Contact Content -->
    <section class="page-section-large relative overflow-hidden bg-slate-50">
        <!-- Background Accents -->
        <div class="absolute top-0 right-0 w-full h-full pointer-events-none overflow-hidden">
            <div
                class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[1000px] h-[1000px] border border-amber-500/10 rounded-full scale-150">
            </div>
            <div
                class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[800px] border border-amber-500/10 rounded-full scale-150">
            </div>
        </div>

        <div class="page-shell relative z-10">
            <div class="grid grid-cols-1 items-stretch gap-8 lg:grid-cols-2 lg:gap-14">
                <!-- Left Side: Contact Information Cards -->
                <div class="flex flex-col gap-8" data-aos="fade-right">
                    <div class="section-heading">
                        <div class="section-kicker">Hubungi Langsung</div>
                        <h3 class="section-title">Reservasi Rental Mobil Tasikmalaya</h3>
                        <p class="section-copy mt-2">Kami bantu pilih armada, atur jadwal, dan arahkan proses booking agar lebih cepat dan jelas.</p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- WhatsApp Card -->
                        <div class="info-card group">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-teal-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div class="icon-panel mb-5">
                                <i class="fa-brands fa-whatsapp text-2xl"></i>
                            </div>
                            <div class="mb-1 text-[9px] font-black uppercase tracking-widest text-slate-400">WhatsApp
                                Booking</div>
                            <div class="text-lg font-black tracking-tight text-slate-900 md:text-xl">
                                {{ \App\Models\Setting::get('whatsapp_number') }}</div>
                        </div>

                        <!-- Hours Card -->
                        <div class="info-card group">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-amber-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div class="icon-panel mb-5">
                                <i class="fa-solid fa-clock text-2xl"></i>
                            </div>
                            <div class="mb-1 text-[9px] font-black uppercase tracking-widest text-slate-400">Jam Operasional
                            </div>
                            <div class="text-lg font-black tracking-tight text-slate-900 md:text-xl">
                                {{ \App\Models\Setting::get('opening_hours', '24 Jam') }}</div>
                        </div>

                        <!-- Email Card -->
                        <div class="info-card group">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div class="icon-panel mb-5">
                                <i class="fa-solid fa-envelope text-2xl"></i>
                            </div>
                            <div class="mb-1 text-[9px] font-black uppercase tracking-widest text-slate-400">Email Resmi
                            </div>
                            <div class="truncate text-lg font-black tracking-tight text-slate-900 md:text-xl">
                                {{ \App\Models\Setting::get('contact_email') }}</div>
                        </div>

                        <!-- Location Card -->
                        <div class="info-card group">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-red-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div class="icon-panel mb-5">
                                <i class="fa-solid fa-location-dot text-2xl"></i>
                            </div>
                            <div class="mb-1 text-[9px] font-black uppercase tracking-widest text-slate-400">Lokasi
                                Kantor</div>
                            <div class="text-lg font-black leading-tight tracking-tight text-slate-900">
                                {{ \App\Models\Setting::get('address', 'Tasikmalaya, Jawa Barat') }}</div>
                        </div>
                    </div>

                    <!-- Service Badge Card -->
                    <div class="surface-card-dark mt-2 overflow-hidden p-8 md:p-10 relative group shadow-2xl">
                        <div
                            class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 origin-left">
                        </div>
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 blur-[60px] rounded-full -mr-20 -mt-20">
                        </div>

                        <div class="relative z-10 flex flex-col items-start gap-6 md:flex-row md:items-center md:gap-10">
                            <div
                                class="w-24 h-24 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 flex items-center justify-center shrink-0">
                                <div
                                    class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center text-slate-900 shadow-[0_10px_30px_rgba(245,158,11,0.4)]">
                                    <i class="fa-solid fa-wand-magic-sparkles text-2xl"></i>
                                </div>
                            </div>
                            <div>
                                <h4 class="mb-3 text-2xl font-black tracking-tight">Booking Cepat, Informasi Jelas</h4>
                                <p class="max-w-md text-sm font-medium leading-relaxed text-slate-300">
                                    Admin kami membantu kebutuhan rental mobil Tasikmalaya dari cek unit, durasi sewa, sampai konfirmasi jadwal keberangkatan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Contact Form -->
                <div class="relative" data-aos="fade-left">
                    <div
                        class="absolute -inset-4 bg-gradient-to-br from-amber-500/20 via-transparent to-transparent blur-3xl rounded-[4rem] pointer-events-none">
                    </div>

                    <div
                        class="surface-card relative flex h-full flex-col overflow-hidden p-6 sm:p-10 lg:p-14">
                        <!-- Form Header -->
                        <div class="section-heading">
                                <h2 class="section-title md:text-[2.35rem] mb-4">Tanya Harga & Ketersediaan Unit</h2>
                            <p class="text-slate-500 font-medium">Sampaikan kebutuhan perjalanan Anda, admin kami akan segera merespons dengan rekomendasi armada yang sesuai.</p>
                        </div>

                        @if ($errors->any())
                            <div class="mb-8 rounded-[1.5rem] border border-red-100 bg-red-50 px-6 py-5 text-sm font-semibold text-red-600">
                                Periksa kembali formulir konsultasi Anda.
                            </div>
                        @endif

                        <form action="{{ route('contact.store') }}" method="POST" class="space-y-6 flex-1">
                            @csrf
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label class="field-label">Nama Lengkap</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors">
                                            <i class="fa-solid fa-user w-5 h-5"></i>
                                        </div>
                                        <input type="text" name="name" value="{{ old('name') }}"
                                            class="field-control-with-icon"
                                            placeholder="Nama Anda">
                                    </div>
                                    @error('name')
                                        <p class="text-xs font-semibold text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="space-y-2">
                                    <label class="field-label">WhatsApp / Telepon</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors">
                                            <i class="fa-solid fa-phone w-5 h-5"></i>
                                        </div>
                                        <input type="text" name="phone" value="{{ old('phone') }}"
                                            class="field-control-with-icon"
                                            placeholder="0812...">
                                    </div>
                                    @error('phone')
                                        <p class="text-xs font-semibold text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="field-label">Alamat Email</label>
                                <div class="relative group">
                                    <div
                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors">
                                        <i class="fa-solid fa-envelope w-5 h-5"></i>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email') }}"
                                        class="field-control-with-icon"
                                        placeholder="email@example.com">
                                </div>
                                @error('email')
                                    <p class="text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="field-label">Kebutuhan Layanan</label>
                                <div class="relative group">
                                    <div
                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors z-10">
                                        <i class="fa-solid fa-hand-holding-heart w-5 h-5"></i>
                                    </div>
                                    <select name="service_type" required
                                        class="field-control-with-icon appearance-none">
                                        <option value="" disabled {{ old('service_type') ? '' : 'selected' }}>Pilih layanan</option>
                                        @foreach (['Rental Mobil Harian', 'Rental Mobil Luar Kota', 'Antar Jemput / Drop Off', 'Perjalanan Keluarga', 'Sewa Motor', 'Paket Wisata'] as $service)
                                            <option value="{{ $service }}" {{ old('service_type') === $service ? 'selected' : '' }}>{{ $service }}</option>
                                        @endforeach
                                    </select>
                                    <div
                                        class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <i class="fa-solid fa-chevron-down w-4 h-4"></i>
                                    </div>
                                </div>
                                @error('service_type')
                                    <p class="text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="space-y-2">
                                <label class="field-label">Pesan / Detail Kebutuhan</label>
                                <textarea name="message" rows="4"
                                    class="field-textarea resize-none"
                                    placeholder="Contoh: butuh Avanza untuk 2 hari di Tasikmalaya, lepas kunci mulai Jumat pagi.">{{ old('message') }}</textarea>
                                @error('message')
                                    <p class="text-xs font-semibold text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <button type="submit"
                                class="action-primary group mt-4 flex w-full items-center justify-center gap-4 rounded-[1.35rem] py-5 text-base tracking-[0.2em] uppercase">
                                <span>Kirim Permintaan</span>
                                <i class="fa-solid fa-paper-plane group-hover:translate-x-2 transition-transform text-[#D4AF37] h-5 w-5"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section with Border Frame -->
    @if (\App\Models\Setting::get('google_maps_url'))
        <section class="page-section-large bg-white relative overflow-hidden">
            <div class="page-shell relative z-10 text-center">
                    <div class="section-heading-centered" data-aos="fade-up">
                    <div class="section-kicker">Lokasi Kami</div>
                    <h3 class="section-title">Lokasi Rental Mobil Tasikmalaya</h3>
                </div>

                <div class="relative group" data-aos="zoom-in">
                    <!-- Frame Accents -->
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-amber-500/30 via-transparent to-amber-500/30 rounded-[4rem] group-hover:via-amber-500/10 transition-all duration-700">
                    </div>

                    <div
                        class="map-frame-shadow relative aspect-[16/7] overflow-hidden rounded-[3.5rem] border-8 border-white grayscale transition-all duration-1000 group-hover:grayscale-0 md:aspect-[16/6] lg:aspect-[21/9]">
                        <iframe src="{{ \App\Models\Setting::get('google_maps_url') }}"
                            class="absolute inset-0 w-full h-full border-0 group-hover:scale-105 transition-transform duration-[10s]"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>

                    <!-- Floating Address Badge -->
                    <div
                        class="absolute -bottom-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-10 py-5 rounded-[2.5rem] shadow-2xl border border-white/10 whitespace-normal md:whitespace-nowrap max-w-[90%] md:max-w-none">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-slate-900 shadow-lg shadow-amber-500/20">
                                <i class="fa-solid fa-location-crosshairs w-5 h-5"></i>
                            </div>
                            <span
                                class="truncate text-xs font-black uppercase tracking-widest text-[#D4AF37]">{{ \App\Models\Setting::get('address', 'Tasikmalaya, Jawa Barat') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif
@endsection

