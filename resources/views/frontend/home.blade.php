@extends('layouts.frontend')

@section('content')
    <!-- Hero Section -->
    <section
        class="relative min-h-[75vh] md:min-h-[80vh] flex items-center pt-24 pb-8 md:pt-28 md:pb-12 overflow-hidden bg-white">
        <!-- Luxury Accents -->
        <div
            class="absolute top-0 right-0 w-[500px] md:w-[700px] h-[500px] md:h-[700px] bg-amber-100/30 md:bg-amber-100/40 blur-[100px] md:blur-[150px] rounded-full -mr-48 md:-mr-80 -mt-48 md:-mt-80 animate-pulse">
        </div>
        <div class="absolute bottom-0 left-0 w-[350px] md:w-[550px] h-[350px] md:h-[550px] bg-amber-50/40 md:bg-amber-50/50 blur-[100px] md:blur-[150px] rounded-full -ml-48 md:-ml-80 -mb-48 md:-mb-80 animate-pulse"
            style="animation-delay: 2s"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 w-full">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-center">
                <!-- Left Column: Content -->
                <div data-aos="fade-right">
                    <div
                        class="inline-flex items-center gap-3 sm:gap-4 px-4 sm:px-5 py-2 sm:py-2.5 rounded-full bg-amber-50 border border-amber-200 font-bold text-[10px] sm:text-xs uppercase tracking-wider sm:tracking-[0.25em] mb-4 sm:mb-6 shadow-sm shadow-amber-900/5">
                        <span class="relative flex h-2 w-2 sm:h-2.5 sm:w-2.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 sm:h-2.5 sm:w-2.5 bg-[#D4AF37]"></span>
                        </span>
                        <span class="gold-gradient-text">Rental Mobil Terpercaya</span>
                    </div>

                    <h1
                        class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-slate-900 mb-4 sm:mb-5 leading-[1.1] tracking-tight">
                        {{ \App\Models\Setting::get('hero_title', 'Sewa Mobil Mewah, Perjalanan Berkesan') }}
                    </h1>

                    <p
                        class="text-sm sm:text-base lg:text-lg text-slate-600 mb-6 sm:mb-8 leading-relaxed max-w-xl font-medium">
                        {{ \App\Models\Setting::get('hero_subtitle', 'Nikmati kenyamanan berkendara dengan armada mobil premium pilihan. Driver berpengalaman, harga transparan, dan pelayanan 24/7 untuk perjalanan sempurna Anda.') }}
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3 sm:gap-4">
                        <a href="{{ route('cars.index') }}"
                            class="group inline-flex items-center justify-center gap-3 px-6 sm:px-8 py-3 sm:py-4 bg-slate-900 text-white rounded-xl font-bold text-sm sm:text-base shadow-xl shadow-slate-900/20 hover:shadow-2xl hover:-translate-y-1 transition-all duration-500 hover:bg-slate-800">
                            <span>Lihat Mobil Tersedia</span>
                            <svg class="w-5 h-5 group-hover:translate-x-2 transition-transform text-[#D4AF37]"
                                fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17 8l4 4m0 0l-4 4m4-4H3" />
                            </svg>
                        </a>
                        <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}"
                            class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 sm:py-4 bg-white border border-slate-200 text-slate-900 rounded-xl font-bold text-sm sm:text-base hover:border-[#D4AF37] transition-all shadow-sm hover:shadow-lg">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                            </svg>
                            Chat WhatsApp
                        </a>
                    </div>

                    <!-- Stats -->
                    <div
                        class="mt-8 sm:mt-12 lg:mt-14 grid grid-cols-3 gap-4 sm:gap-6 lg:gap-8 border-t border-slate-100 pt-6 sm:pt-8 lg:pt-10">
                        <div>
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mb-1 tracking-tight">
                                {{ \App\Models\Setting::get('stats_1_value', '500+') }}
                            </div>
                            <div class="text-[9px] sm:text-[10px] font-bold text-amber-600 uppercase tracking-wide">
                                {{ \App\Models\Setting::get('stats_1_label', 'Pelanggan Puas') }}</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mb-1 tracking-tight">
                                {{ \App\Models\Setting::get('stats_2_value', '50+') }}
                            </div>
                            <div class="text-[9px] sm:text-[10px] font-bold text-amber-600 uppercase tracking-wide">
                                {{ \App\Models\Setting::get('stats_2_label', 'Unit Terawat') }}</div>
                        </div>
                        <div>
                            <div class="text-2xl sm:text-3xl lg:text-4xl font-black text-slate-900 mb-1 tracking-tight">
                                {{ \App\Models\Setting::get('stats_3_value', '24/7') }}
                            </div>
                            <div class="text-[9px] sm:text-[10px] font-bold text-amber-600 uppercase tracking-wide">
                                {{ \App\Models\Setting::get('stats_3_label', 'Siap Melayani') }}</div>
                        </div>
                    </div>
                </div>

                <!-- Right Column: Image -->
                <div class="relative mt-8 lg:mt-0" data-aos="zoom-out-left" data-aos-delay="200">
                    <div
                        class="relative z-10 p-3 sm:p-4 bg-white rounded-2xl sm:rounded-[2.5rem] shadow-2xl border border-amber-50">
                        <img src="{{ \App\Models\Setting::get('hero_image', asset('landing.png')) }}"
                            alt="Armada Mobil Mewah di Koleksi Kami" class="rounded-xl sm:rounded-[2.2rem] shadow-lg w-full"
                            loading="eager">

                        <!-- Floating #1 Badge -->
                        <div
                            class="absolute -top-10 -right-10 sm:-top-12 sm:-right-12 bg-slate-900 text-white p-6 sm:p-10 rounded-2xl sm:rounded-[3rem] shadow-3xl animate-float border border-white/10 z-20">
                            <div class="text-2xl sm:text-4xl font-black mb-1 gold-gradient-text tracking-tighter">#1</div>
                            <div class="text-[8px] sm:text-[10px] font-bold uppercase tracking-[0.2em] text-amber-200/60">Di
                                Tasikmalaya</div>
                        </div>

                        <!-- Trust Badge -->
                        <div class="absolute -bottom-10 -left-10 bg-white p-5 sm:p-8 rounded-2xl sm:rounded-[3rem] shadow-2xl border border-amber-100 animate-float"
                            style="animation-delay: 1s">
                            <div class="flex items-center gap-3 sm:gap-6">
                                <div
                                    class="w-12 h-12 sm:w-16 sm:h-16 rounded-xl sm:rounded-2xl flex items-center justify-center text-white shadow-lg gold-btn">
                                    <svg class="w-6 h-6 sm:w-8 sm:h-8" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-sm sm:text-lg font-black text-slate-900 tracking-tight">Terpercaya &
                                        Aman</div>
                                    <div class="text-[8px] sm:text-xs font-semibold text-slate-400 uppercase tracking-wide">
                                        Layanan Premium</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Background Glow -->
                    <div class="absolute inset-0 bg-[#D4AF37] opacity-10 blur-[120px] rounded-full scale-90 translate-x-20">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20" data-aos="fade-up">
                <h2
                    class="text-[10px] sm:text-xs font-bold gold-gradient-text uppercase tracking-[0.25em] sm:tracking-[0.4em] mb-3 sm:mb-4">
                    Layanan Kami</h2>
                <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight tracking-tight">Solusi
                    Transportasi Lengkap</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 lg:gap-12">
                <!-- Service 1: Rental Mobil -->
                <div class="group text-center" data-aos="fade-up" data-aos-delay="100">
                    <div
                        class="w-20 h-20 lg:w-24 lg:h-24 bg-white rounded-2xl border border-slate-100 flex items-center justify-center mb-6 lg:mb-8 shadow-sm group-hover:shadow-[0_20px_50px_rgba(212,175,55,0.2)] group-hover:border-[#D4AF37] transition-all duration-700 mx-auto transform group-hover:-translate-y-3 group-hover:scale-110">
                        <svg class="w-12 h-12 lg:w-14 lg:h-14 text-[#D4AF37]" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="1.4" stroke-linecap="round" stroke-linejoin="round">
                            <!-- Siluet body premium -->
                            <path
                                d="M2.5 14.5c0-.8.4-1.5 1.2-1.9l2.6-1.2 2.2-3.4c.4-.6 1-.9 1.7-.9h5.6c.7 0 1.3.3 1.7.9l2.2 3.4 2.6 1.2c.8.4 1.2 1.1 1.2 1.9v1.8c0 .6-.4 1-1 1h-1.4" />

                            <!-- Detail bawah -->
                            <path d="M4 17h1.6M18.4 17H20" />

                            <!-- Ban elegan -->
                            <circle cx="7.5" cy="17" r="1.8" />
                            <circle cx="16.5" cy="17" r="1.8" />

                            <!-- Garis pintu / body line -->
                            <path d="M8.5 9.2h7" />
                        </svg>

                    </div>
                    <h4 class="text-xl sm:text-2xl font-black text-slate-900 mb-3 sm:mb-4 tracking-tight">
                        {{ \App\Models\Setting::get('service_1_title', 'Rental Mobil') }}
                    </h4>
                    <p class="text-sm sm:text-base leading-relaxed text-slate-500 font-medium px-2">
                        {{ \App\Models\Setting::get('service_1_description', 'Pilihan mobil premium dengan kondisi terawat. Lepas kunci atau dengan driver profesional sesuai kebutuhan Anda.') }}
                    </p>
                </div>

                <!-- Service 2: Rental Motor -->
                <div class="group text-center" data-aos="fade-up" data-aos-delay="200">
                    <div
                        class="w-20 h-20 lg:w-24 lg:h-24 bg-slate-900 rounded-2xl flex items-center justify-center mb-6 lg:mb-8 shadow-xl shadow-slate-900/40 group-hover:shadow-[0_20px_50px_rgba(15,23,42,0.3)] group-hover:scale-110 group-hover:-translate-y-3 transition-all duration-700 mx-auto">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#D4AF37]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <circle cx="6" cy="19" r="2" stroke="currentColor" stroke-width="1.5"
                                fill="none" />
                            <circle cx="18" cy="19" r="2" stroke="currentColor" stroke-width="1.5"
                                fill="none" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M11 17h4l2-5 3-2" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M9 17l-1-4-2-1H4" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 6h5l2 5" />
                        </svg>
                    </div>
                    <h4 class="text-xl sm:text-2xl font-black text-slate-900 mb-3 sm:mb-4 tracking-tight">
                        {{ \App\Models\Setting::get('service_2_title', 'Rental Motor') }}
                    </h4>
                    <p class="text-sm sm:text-base leading-relaxed text-slate-500 font-medium px-2">
                        {{ \App\Models\Setting::get('service_2_description', 'Motor matic terawat untuk jelajah kota. Praktis, irit, dan nyaman untuk mobilitas harian Anda.') }}
                    </p>
                </div>

                <!-- Service 3: Paket Wisata -->
                <div class="group text-center" data-aos="fade-up" data-aos-delay="300">
                    <div
                        class="w-20 h-20 lg:w-24 lg:h-24 bg-white rounded-2xl border border-slate-100 flex items-center justify-center mb-6 lg:mb-8 shadow-sm group-hover:shadow-[0_20px_50px_rgba(212,175,55,0.2)] group-hover:border-[#D4AF37] transition-all duration-700 mx-auto transform group-hover:-translate-y-3 group-hover:scale-110">
                        <svg class="w-10 h-10 lg:w-12 lg:h-12 text-[#D4AF37]" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h4 class="text-xl sm:text-2xl font-black text-slate-900 mb-3 sm:mb-4 tracking-tight">
                        {{ \App\Models\Setting::get('service_3_title', 'Paket Wisata') }}
                    </h4>
                    <p class="text-sm sm:text-base leading-relaxed text-slate-500 font-medium px-2">
                        {{ \App\Models\Setting::get('service_3_description', 'Jelajahi destinasi favorit dengan paket tour lengkap. Driver ramah yang mengenal area wisata terbaik.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section class="py-24 bg-white relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                <!-- Left: Image -->
                <div class="relative" data-aos="fade-right">
                    <div class="aspect-[4/5] rounded-[2.5rem] overflow-hidden shadow-2xl border border-white">
                        <img src="{{ \App\Models\Setting::get('about_home_image', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=800') }}"
                            alt="Tentang Kami - Tim Profesional" class="w-full h-full object-cover">
                    </div>
                    <!-- Stats Badge Overlay -->
                    <div
                        class="absolute -bottom-10 -right-10 bg-white p-8 rounded-[2rem] shadow-2xl border border-amber-50 hidden sm:block">
                        <div class="grid grid-cols-1 gap-6">
                            <div class="flex items-center gap-4">
                                <div class="text-3xl font-black gold-gradient-text">1000+</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pelanggan</div>
                            </div>
                            <div class="h-px bg-slate-100"></div>
                            <div class="flex items-center gap-4">
                                <div class="text-3xl font-black gold-gradient-text">50+</div>
                                <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Armada</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Content -->
                <div class="space-y-8" data-aos="fade-left">
                    <div>
                        <h2 class="text-[10px] sm:text-xs font-bold gold-gradient-text uppercase tracking-[0.4em] mb-4">
                            Tentang Kami</h2>
                        <h1
                            class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight tracking-tight mb-6">
                            {{ \App\Models\Setting::get('about_home_title', 'Partner Terpercaya Perjalanan Anda') }}
                        </h1>
                        <p class="text-base text-slate-600 leading-relaxed font-medium">
                            {{ \App\Models\Setting::get('about_home_description', 'Kami adalah penyedia layanan transportasi dan manajemen perjalanan terkemuka yang berdedikasi untuk memberikan pengalaman mobilitas terbaik.') }}
                        </p>
                    </div>

                    <!-- Features Checklist -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div class="flex items-center gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Armada Terawat</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Driver Berpengalaman</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Harga Transparan</span>
                        </div>
                        <div class="flex items-center gap-3">
                            <div
                                class="w-6 h-6 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <span class="text-sm font-bold text-slate-700">Pelayanan 24 Jam</span>
                        </div>
                    </div>

                    <!-- Additional Experience Info -->
                    <div class="pt-8 border-t border-slate-200 flex flex-wrap gap-8">
                        <div>
                            <div class="text-3xl font-black text-slate-900 mb-1">5+</div>
                            <div class="text-[9px] font-bold text-amber-600 uppercase tracking-widest">Tahun Pengalaman
                            </div>
                        </div>
                        <div class="flex items-center gap-4 px-8 border-l border-slate-200">
                            <a href="{{ route('about') }}" class="group flex items-center gap-3">
                                <span
                                    class="text-sm font-black text-slate-900 uppercase tracking-widest group-hover:text-[#D4AF37] transition-colors">Pelajari
                                    Lebih Lanjut</span>
                                <div
                                    class="w-8 h-8 rounded-lg bg-slate-900 flex items-center justify-center text-white group-hover:bg-[#D4AF37] group-hover:translate-x-1 transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tour Packages Section -->
    <section class="py-16 sm:py-20 lg:py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20" data-aos="fade-up">
                <h2 class="text-[10px] sm:text-xs font-bold gold-gradient-text uppercase tracking-[0.4em] mb-4">Destinasi
                    Pilihan</h2>
                <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight tracking-tight">Paket
                    Wisata Eksklusif</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach ($featuredTours as $tour)
                    <div class="group bg-white rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 border border-slate-50 hover:border-amber-100 flex flex-col h-full"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Image -->
                        <div class="relative h-64 overflow-hidden shrink-0">
                            <img src="{{ $tour->primary_image_url }}" alt="{{ $tour->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">

                            <!-- Badges -->
                            <div class="absolute top-6 left-6 flex flex-wrap gap-2">
                                @if ($loop->first)
                                    <span
                                        class="px-3 py-1.5 bg-slate-900/80 backdrop-blur-md rounded-lg text-[9px] font-bold text-[#D4AF37] uppercase tracking-wider border border-[#D4AF37]/30">Best
                                        Seller</span>
                                @elseif($loop->iteration == 2)
                                    <span
                                        class="px-3 py-1.5 bg-amber-500 rounded-lg text-[9px] font-bold text-white uppercase tracking-wider shadow-lg">Promo</span>
                                @else
                                    <span
                                        class="px-3 py-1.5 bg-white/90 backdrop-blur-md rounded-lg text-[9px] font-bold text-slate-900 uppercase tracking-wider border border-slate-200">Favorit</span>
                                @endif
                            </div>
                        </div>

                        <!-- Content -->
                        <div class="p-8 flex flex-col flex-1">
                            <h4 class="text-xl sm:text-2xl font-black text-slate-900 mb-2 tracking-tight">
                                <a href="{{ route('tours.show', $tour) }}"
                                    class="hover:text-[#D4AF37] transition-colors">{{ $tour->name }}</a>
                            </h4>
                            <p
                                class="text-[9px] font-black text-amber-600 uppercase tracking-widest mb-6 px-3 py-1 bg-amber-50 rounded-full w-fit">
                                {{ $tour->duration }}</p>

                            <!-- Facilities -->
                            <div class="grid grid-cols-2 gap-4 mb-8">
                                <div
                                    class="flex items-center gap-2 text-slate-500 font-semibold text-[10px] uppercase tracking-wide">
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Mobil + Driver
                                </div>
                                <div
                                    class="flex items-center gap-2 text-slate-500 font-semibold text-[10px] uppercase tracking-wide">
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Hotel
                                </div>
                                <div
                                    class="flex items-center gap-2 text-slate-500 font-semibold text-[10px] uppercase tracking-wide">
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Tiket Wisata
                                </div>
                                <div
                                    class="flex items-center gap-2 text-slate-500 font-semibold text-[10px] uppercase tracking-wide">
                                    <svg class="w-4 h-4 text-[#D4AF37]" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    Makan
                                </div>
                            </div>

                            <!-- Price & Actions -->
                            <div class="mt-auto pt-6 border-t border-slate-100 flex items-center justify-between gap-4">
                                <div>
                                    <div class="text-[9px] font-bold text-slate-400 uppercase tracking-widest mb-1">Mulai
                                        Dari</div>
                                    <div class="text-xl font-black text-slate-900">Rp
                                        {{ number_format($tour->price, 0, ',', '.') }}</div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('tours.show', $tour) }}"
                                        class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-900 hover:bg-slate-900 hover:text-white transition-all">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </a>
                                    <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Halo, saya ingin pesan paket {{ $tour->name }}"
                                        class="w-10 h-10 rounded-xl gold-btn flex items-center justify-center text-white shadow-lg">
                                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-16 text-center" data-aos="fade-up">
                <p class="text-sm font-bold text-slate-500 mb-6">Custom Paket Wisata Sendiri? Sesuaikan Dengan Budget Anda.
                </p>
                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Halo, saya ingin custom paket wisata"
                    class="inline-flex items-center gap-3 px-8 py-4 bg-white border-2 border-slate-900 text-slate-900 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all shadow-xl shadow-slate-900/10">
                    <span>Custom Paket Sekarang</span>
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                    </svg>
                </a>
            </div>
        </div>
    </section>

    <!-- Featured Fleet -->
    <section class="py-16 sm:py-20 lg:py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col md:flex-row justify-between items-start md:items-end mb-12 lg:mb-20 gap-6"
                data-aos="fade-up">
                <div>
                    <h2
                        class="text-[10px] sm:text-xs font-bold gold-gradient-text uppercase tracking-[0.25em] sm:tracking-[0.4em] mb-3 sm:mb-4">
                        Armada Pilihan</h2>
                    <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight tracking-tight">
                        Mobil Favorit Kami</h3>
                </div>
                <a href="{{ route('cars.index') }}"
                    class="group inline-flex items-center gap-3 sm:gap-4 px-6 sm:px-8 py-3 sm:py-4 bg-white rounded-xl sm:rounded-2xl shadow-md hover:shadow-xl transition-all border border-slate-100 hover:border-[#D4AF37] w-full md:w-auto justify-center md:justify-start">
                    <span class="text-slate-900 font-bold tracking-wide uppercase text-xs sm:text-sm">Lihat Semua
                        Mobil</span>
                    <div
                        class="w-7 h-7 sm:w-8 sm:h-8 rounded-lg flex items-center justify-center text-white group-hover:translate-x-1 transition-transform shadow-md gold-btn">
                        <svg class="w-4 h-4 sm:w-5 sm:h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 8l4 4m0 0l-4 4m4-4H3" />
                        </svg>
                    </div>
                </a>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8 xl:gap-12">
                @foreach ($featuredCars as $car)
                    <div class="group bg-white rounded-2xl sm:rounded-[2.5rem] overflow-hidden shadow-sm hover:shadow-2xl transition-all duration-700 border border-slate-50 hover:border-amber-100 flex flex-col h-full"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Car Image -->
                        <div class="relative h-52 sm:h-56 lg:h-64 overflow-hidden">
                            <img src="{{ $car->getFirstMediaUrl('cars') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=800' }}"
                                alt="Sewa {{ $car->name }} - {{ $car->brand }} {{ $car->year }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000"
                                loading="lazy">
                            <div class="absolute top-4 left-4 sm:top-6 sm:left-6">
                                <span
                                    class="px-3 py-1.5 sm:px-4 sm:py-2 bg-slate-900/80 backdrop-blur-xl rounded-lg sm:rounded-xl text-[9px] sm:text-[10px] font-bold text-[#D4AF37] shadow-xl uppercase tracking-wider border border-[#D4AF37]/30">
                                    {{ $car->brand }}
                                </span>
                            </div>
                        </div>

                        <!-- Car Info -->
                        <div class="p-5 sm:p-6 lg:p-8 flex flex-col flex-1">
                            <h4
                                class="text-xl sm:text-2xl font-black text-slate-900 mb-3 sm:mb-4 tracking-tight leading-tight">
                                <a href="{{ route('cars.show', $car) }}"
                                    class="hover:text-[#D4AF37] transition-colors">{{ $car->name }}</a>
                            </h4>

                            <!-- Tags -->
                            <div class="flex flex-wrap gap-2 mb-6 sm:mb-8">
                                <span
                                    class="px-3 py-1.5 bg-slate-50 rounded-lg text-slate-500 font-bold text-[9px] uppercase tracking-wide border border-slate-100 italic">
                                    {{ $car->year }}
                                </span>
                                <span
                                    class="px-3 py-1.5 bg-slate-50 rounded-lg text-slate-500 font-bold text-[9px] uppercase tracking-wide border border-slate-100">
                                    {{ str_replace('_', ' ', $car->category) }}
                                </span>
                            </div>

                            <!-- Specs -->
                            <div class="grid grid-cols-2 gap-3 mb-6 sm:mb-8">
                                <div
                                    class="flex items-center gap-2 text-slate-500 font-semibold text-[9px] sm:text-[10px] uppercase tracking-wide">
                                    <svg class="w-4 h-4 text-[#D4AF37] shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z" />
                                    </svg>
                                    {{ $car->transmission }}
                                </div>
                                <div
                                    class="flex items-center gap-2 text-slate-500 font-semibold text-[9px] sm:text-[10px] uppercase tracking-wide">
                                    <svg class="w-4 h-4 text-[#D4AF37] shrink-0" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                                    </svg>
                                    {{ $car->passenger_capacity }} Kursi
                                </div>
                            </div>

                            <!-- Price & Actions -->
                            <div
                                class="mt-auto pt-5 sm:pt-6 border-t border-slate-100 flex items-center justify-between gap-3">
                                <div>
                                    <div
                                        class="text-[9px] sm:text-[10px] font-bold text-slate-400 uppercase tracking-wide mb-1">
                                        Per Hari</div>
                                    <div class="text-xl sm:text-2xl font-black text-slate-900 tracking-tight">
                                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="flex gap-2">
                                    <a href="{{ route('cars.show', $car) }}"
                                        class="w-11 h-11 sm:w-12 sm:h-12 bg-slate-100 text-slate-900 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-white transition-all duration-500 active:scale-95"
                                        title="Detail">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                    </a>
                                    <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Halo, saya ingin sewa {{ $car->name }}"
                                        class="w-11 h-11 sm:w-12 sm:h-12 bg-slate-900 rounded-xl flex items-center justify-center text-[#D4AF37] hover:bg-[#D4AF37] hover:text-white transition-all duration-500 shadow-md shadow-slate-900/10 active:scale-95"
                                        title="WhatsApp">
                                        <svg class="w-5 h-5 sm:w-6 sm:h-6" fill="currentColor" viewBox="0 0 24 24">
                                            <path
                                                d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <!-- Call to Action -->
    <section class="py-12 sm:py-16 lg:py-20 relative overflow-hidden bg-slate-900">
        <div class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_center,_#D4AF37_0%,_transparent_70%)]"></div>
        <div
            class="absolute top-0 right-0 w-[300px] sm:w-[500px] h-[300px] sm:h-[500px] bg-[#D4AF37] opacity-10 blur-[120px] rounded-full -mr-36 sm:-mr-60 -mt-36 sm:-mt-60">
        </div>

        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center" data-aos="zoom-in">
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white mb-4 sm:mb-6 leading-tight tracking-tight">
                Siap Untuk <span class="gold-gradient-text">Perjalanan Anda?</span>
            </h2>
            <p
                class="text-sm sm:text-base lg:text-lg text-amber-50 mb-8 sm:mb-10 leading-relaxed max-w-xl mx-auto font-medium opacity-90">
                Booking sekarang dan dapatkan harga terbaik. Tim kami siap membantu merencanakan perjalanan sempurna Anda,
                kapan saja.
            </p>
            <div class="flex flex-col sm:flex-row justify-center gap-3 sm:gap-4">
                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}"
                    class="inline-flex items-center justify-center gap-2 px-6 sm:px-8 py-3 sm:py-3.5 gold-btn text-white rounded-lg sm:rounded-xl font-bold text-base sm:text-lg shadow-2xl hover:scale-105 transition-transform duration-500">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path
                            d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                    </svg>
                    Pesan Sekarang
                </a>
                <a href="{{ route('faq') }}"
                    class="inline-flex items-center justify-center px-6 sm:px-8 py-3 sm:py-3.5 bg-slate-900 border-2 border-[#D4AF37] text-[#D4AF37] rounded-lg sm:rounded-xl font-bold text-base sm:text-lg hover:bg-white/5 transition-all">
                    Tanya Jawab
                </a>
            </div>
        </div>
    </section>

    <!-- Booking Section -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 opacity-10">
            <div class="absolute top-0 left-0 w-full h-full"
                style="background-image: url('{{ asset('pattern.png') }}'); background-size: 50px;"></div>
        </div>
        <!-- Decor -->
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-amber-500/10 blur-[120px] rounded-full -ml-64 -mt-64">
        </div>

        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="text-center mb-12 sm:mb-16" data-aos="fade-up">
                <h2 class="text-[10px] sm:text-xs font-bold gold-gradient-text uppercase tracking-[0.4em] mb-4">Reservasi
                    Cepat</h2>
                <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white leading-tight tracking-tight">Booking
                    Perjalanan Anda</h3>
            </div>

            <div class="bg-white rounded-[3rem] shadow-[0_50px_100px_-20px_rgba(0,0,0,0.3)] overflow-hidden p-8 sm:p-12 lg:p-16 border border-white/10"
                data-aos="zoom-in">
                <form action="{{ route('bookings.store') }}" method="POST" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 sm:gap-8">
                        <!-- Nama Lengkap -->
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Nama
                                Lengkap</label>
                            <input type="text" name="customer_name" value="{{ old('customer_name') }}"
                                placeholder="Masukkan nama lengkap Anda" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 placeholder-slate-400 @error('customer_name') ring-2 ring-red-500 @enderror">
                            @error('customer_name')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- WhatsApp -->
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Nomor
                                WhatsApp</label>
                            <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}"
                                placeholder="Contoh: 081234567890" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 placeholder-slate-400 @error('customer_phone') ring-2 ring-red-500 @enderror">
                            @error('customer_phone')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Alamat
                                Email</label>
                            <input type="email" name="customer_email" value="{{ old('customer_email') }}"
                                placeholder="nama@email.com"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 placeholder-slate-400 @error('customer_email') ring-2 ring-red-500 @enderror">
                            @error('customer_email')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Pilih Layanan -->
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Layanan</label>
                            <select name="service_type" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 @error('service_type') ring-2 ring-red-500 @enderror">
                                <option value="" disabled {{ old('service_type') ? '' : 'selected' }}>Pilih Layanan
                                </option>
                                <option value="Rental Mobil"
                                    {{ old('service_type') == 'Rental Mobil' ? 'selected' : '' }}>Rental Mobil</option>
                                <option value="City Car" {{ old('service_type') == 'City Car' ? 'selected' : '' }}>City
                                    Car</option>
                                <option value="Rental Motor"
                                    {{ old('service_type') == 'Rental Motor' ? 'selected' : '' }}>Rental Motor</option>
                                <option value="Travel Reguler"
                                    {{ old('service_type') == 'Travel Reguler' ? 'selected' : '' }}>Travel Reguler</option>
                                <option value="Paket Wisata"
                                    {{ old('service_type') == 'Paket Wisata' ? 'selected' : '' }}>Paket Wisata</option>
                            </select>
                            @error('service_type')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Mulai -->
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Tanggal
                                Mulai</label>
                            <input type="date" name="start_date" value="{{ old('start_date') }}" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 @error('start_date') ring-2 ring-red-500 @enderror">
                            @error('start_date')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Tanggal Selesai -->
                        <div class="space-y-3">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Tanggal
                                Selesai</label>
                            <input type="date" name="end_date" value="{{ old('end_date') }}"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 @error('end_date') ring-2 ring-red-500 @enderror">
                            @error('end_date')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lokasi -->
                        <div class="space-y-3 md:col-span-2">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Lokasi
                                Penjemputan</label>
                            <input type="text" name="location" value="{{ old('location') }}"
                                placeholder="Masukkan lokasi detail penjemputan" required
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 placeholder-slate-400 @error('location') ring-2 ring-red-500 @enderror">
                            @error('location')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Catatan -->
                        <div class="space-y-3 md:col-span-2">
                            <label class="text-xs font-black text-slate-900 uppercase tracking-widest pl-1">Catatan
                                Tambahan</label>
                            <textarea rows="4" name="notes" placeholder="Kebutuhan khusus (contoh: Butuh baby seat, mobil pengganti dll)"
                                class="w-full px-6 py-4 bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 focus:bg-white transition-all font-bold text-sm text-slate-900 placeholder-slate-400 @error('notes') ring-2 ring-red-500 @enderror">{{ old('notes') }}</textarea>
                            @error('notes')
                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-1 uppercase tracking-wider">
                                    {{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <!-- T&C -->
                    <div class="flex items-center gap-4 py-4">
                        <input type="checkbox" required id="tc"
                            class="w-5 h-5 rounded border-slate-200 text-amber-500 focus:ring-amber-500/20 transition-all">
                        <label for="tc" class="text-xs sm:text-sm font-bold text-slate-500 cursor-pointer">
                            Saya menyetujui <a href="#" class="text-slate-900 underline hover:text-amber-600">Syarat
                                & Ketentuan</a> yang berlaku.
                        </label>
                    </div>

                    <!-- Submit -->
                    <div class="space-y-6 pt-4">
                        <button type="submit"
                            class="w-full py-5 gold-btn text-white rounded-2xl font-black text-sm sm:text-base uppercase tracking-[0.2em] shadow-2xl shadow-amber-900/20 hover:scale-[1.02] transition-transform flex items-center justify-center gap-4">
                            <span>Kirim & Booking Sekarang</span>
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M14 5l7 7m0 0l-7 7m7-7H3"></path>
                            </svg>
                        </button>
                        <p class="text-center text-[10px] font-bold text-slate-400 uppercase tracking-widest">
                            Tim kami akan menghubungi Anda dalam waktu 5–15 menit.
                        </p>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-16 sm:py-20 lg:py-24 bg-white">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12 sm:mb-16 lg:mb-20" data-aos="fade-up">
                <h2
                    class="text-[10px] sm:text-xs font-bold gold-gradient-text uppercase tracking-[0.25em] sm:tracking-[0.4em] mb-3 sm:mb-4">
                    Testimoni</h2>
                <h3 class="text-3xl sm:text-4xl lg:text-5xl font-black text-slate-900 leading-tight tracking-tight">Kata
                    Pelanggan Kami</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach ($testimonials as $testimonial)
                    <div class="p-6 sm:p-8 lg:p-10 rounded-2xl sm:rounded-[2.5rem] bg-slate-50 border border-amber-50/50 group hover:bg-white hover:shadow-2xl hover:border-amber-100 transition-all duration-700"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                        <!-- Stars -->
                        <div class="flex items-center gap-1 mb-5 sm:mb-6">
                            @for ($i = 0; $i < 5; $i++)
                                <svg class="w-5 h-5 text-[#D4AF37]" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                        d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                </svg>
                            @endfor
                        </div>

                        <!-- Content -->
                        <p class="text-base sm:text-lg text-slate-600 leading-relaxed mb-6 sm:mb-8 font-medium italic">
                            "{{ $testimonial->content }}"
                        </p>

                        <!-- Author -->
                        <div class="flex items-center gap-4 sm:gap-6">
                            <div class="relative flex-shrink-0">
                                <div
                                    class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl overflow-hidden shadow-lg border-2 border-white ring-2 ring-amber-100">
                                    @php
                                        $avatarUrl =
                                            $testimonial->getFirstMediaUrl('testimonials') ?:
                                            'https://images.unsplash.com/photo-' .
                                                [
                                                    '1507003211169-0a1dd7228f2d',
                                                    '1438761681033-6461ffad8d80',
                                                    '1500648767791-00dcc994a43e',
                                                    '1494790108377-be9c29b29330',
                                                ][$loop->index % 4] .
                                                '?auto=format&fit=crop&q=80&w=150&h=150&fm=webp';
                                    @endphp
                                    <img src="{{ $avatarUrl }}" alt="{{ $testimonial->name }}"
                                        class="w-full h-full object-cover">
                                </div>
                                <div
                                    class="absolute -bottom-1 -right-1 w-6 h-6 bg-[#D4AF37] rounded-lg flex items-center justify-center text-white shadow-lg">
                                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd"
                                            d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <div class="text-lg sm:text-xl font-black text-slate-900 tracking-tight">
                                    {{ $testimonial->name }}</div>
                                <div class="text-[9px] sm:text-[10px] text-amber-600 font-bold uppercase tracking-wider">
                                    {{ $testimonial->occupation ?: 'Pelanggan Setia' }}</div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        @keyframes bounce-slow {

            0%,
            100% {
                transform: translateY(-5%);
            }

            50% {
                transform: translateY(0);
            }
        }

        .animate-bounce-slow {
            animation: bounce-slow 4s infinite ease-in-out;
        }
    </style>
@endsection
