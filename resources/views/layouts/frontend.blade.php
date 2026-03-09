<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Sewa Mobil & Motor Terbaik') - {{ \App\Models\Setting::get('site_name', 'Rent Travel') }}</title>

    <!-- SEO Meta Tags -->
    <meta name="description" content="@yield('meta_description', \App\Models\Setting::get('site_description', 'Sewa mobil dan motor premium untuk pengalaman perjalanan terbaik Anda.'))">
    <meta name="keywords" content="sewa mobil, sewa motor, paket wisata, rent car, bali, travel, luxury car rental">
    <meta name="author" content="{{ \App\Models\Setting::get('site_name', 'Rent Travel') }}">
    <meta name="robots" content="index, follow">

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('title', 'Sewa Mobil & Motor Terbaik') - {{ \App\Models\Setting::get('site_name', 'Rent Travel') }}">
    <meta property="og:description" content="@yield('meta_description', \App\Models\Setting::get('site_description', 'Sewa mobil dan motor premium untuk pengalaman perjalanan terbaik Anda.'))">
    <meta property="og:image" content="{{ \App\Models\Setting::get('site_logo', asset('logo.jpg')) }}">

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image">
    <meta property="twitter:url" content="{{ url()->current() }}">
    <meta property="twitter:title"
        content="@yield('title', 'Sewa Mobil & Motor Terbaik') - {{ \App\Models\Setting::get('site_name', 'Rent Travel') }}">
    <meta property="twitter:description" content="@yield('meta_description', \App\Models\Setting::get('site_description', 'Sewa mobil dan motor premium untuk pengalaman perjalanan terbaik Anda.'))">
    <meta property="twitter:image" content="{{ \App\Models\Setting::get('site_logo', asset('logo.jpg')) }}">

    <!-- Canonical URL -->
    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ \App\Models\Setting::get('favicon', asset('favicon.ico')) }}">

    <script src="https://cdn.tailwindcss.com"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <style>
        :root {
            --luxury-gold: #D4AF37;
            --luxury-gold-light: #F1E5AC;
            --luxury-gold-dark: #A67C00;
            --luxury-gold-metallic: linear-gradient(135deg, #B8860B 0%, #D4AF37 45%, #F1E5AC 55%, #A67C00 100%);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: #fafafa;
        }

        .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(212, 175, 55, 0.15);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.03);
        }

        .gold-gradient-text {
            background: var(--luxury-gold-metallic);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .gold-btn {
            background: linear-gradient(135deg, var(--luxury-gold) 0%, var(--luxury-gold-dark) 100%);
            position: relative;
            overflow: hidden;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gold-btn::after {
            content: '';
            position: absolute;
            top: -50%;
            left: -100%;
            width: 50%;
            height: 200%;
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.3), transparent);
            transform: rotate(30deg);
            transition: none;
        }

        .gold-btn:hover::after {
            left: 150%;
            transition: all 0.7s ease-in-out;
        }

        .gold-btn:hover {
            box-shadow: 0 15px 35px -5px rgba(212, 175, 55, 0.4);
            transform: translateY(-3px);
        }

        /* Premium Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }

        ::-webkit-scrollbar-track {
            background: #ffffff;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(180deg, #f3f4f6 0%, #D4AF37 50%, #f3f4f6 100%);
            border-radius: 10px;
            border: 2px solid #ffffff;
        }

        .text-shadow-gold {
            text-shadow: 0 0 20px rgba(212, 175, 55, 0.3);
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-15px);
            }
        }

        .animate-float {
            animation: float 5s ease-in-out infinite;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
    @stack('schema')
</head>

<body class="bg-white text-slate-900 overflow-x-hidden" x-data="{ mobileMenuOpen: false, searchModalOpen: false, dropdownOpen: false }">
    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav px-4 sm:px-6 lg:px-8 py-3 lg:py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <a href="{{ route('home') }}" class="flex items-center gap-2 group">
                <div
                    class="w-12 h-12 lg:w-20 lg:h-20 rounded-full flex items-center justify-center group-hover:scale-110 transition-transform duration-500 overflow-hidden">
                    <img src="{{ \App\Models\Setting::get('site_logo', asset('logo.jpg')) }}"
                        alt="{{ \App\Models\Setting::get('site_name', 'Rent Travel') }}"
                        class="w-full h-full object-contain">
                </div>
                <div class="flex flex-col">
                    <span
                        class="text-base lg:text-xl font-black tracking-tighter uppercase leading-none gold-gradient-text">
                        @php
                            $name = \App\Models\Setting::get('site_name', 'Rent Travel');
                            $parts = explode(' ', $name, 2);
                        @endphp
                        {{ $parts[0] }}@if (isset($parts[1]))
                            <span class="text-slate-900">{{ $parts[1] }}</span>
                        @endif
                    </span>
                    <span
                        class="text-[7px] lg:text-[8px] font-black text-amber-600 uppercase tracking-[0.4em] leading-none mt-1.5">{{ \App\Models\Setting::get('site_tagline', 'Luxury Experience') }}</span>
                </div>
            </a>

            <!-- Navbar Divider (Left) -->
            <div class="hidden lg:block h-10 w-px bg-amber-500/10 mx-8"></div>

            <!-- Desktop Menu -->
            <div class="hidden lg:flex items-center gap-12">
                <a href="{{ route('home') }}"
                    class="group relative text-sm font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('home') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                    Beranda
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full {{ request()->routeIs('home') ? 'w-full' : '' }}"></span>
                </a>

                <a href="{{ route('about') }}"
                    class="group relative text-sm font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('about') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                    Tentang
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full {{ request()->routeIs('about') ? 'w-full' : '' }}"></span>
                </a>

                <!-- Layanan Dropdown -->
                <div class="relative group/dropdown" @mouseenter="dropdownOpen = true"
                    @mouseleave="dropdownOpen = false">
                    <button
                        class="flex items-center gap-2 text-sm font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('cars.*', 'motorcycles.*', 'tours.*') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                        Layanan
                        <svg class="w-4 h-4 transition-transform duration-500 group-hover/dropdown:rotate-180"
                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="dropdownOpen" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 translate-y-4 scale-95"
                        x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                        x-transition:leave="transition ease-in duration-200"
                        x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                        x-transition:leave-end="opacity-0 translate-y-4 scale-95"
                        class="absolute top-full -left-10 w-56 pt-6" x-cloak>
                        <div
                            class="bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-amber-50/50 p-2.5 overflow-hidden">
                            <a href="{{ route('cars.index') }}"
                                class="flex items-center justify-between px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('cars.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                <span>Sewa Mobil</span>
                                <svg class="w-4 h-4 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="{{ route('motorcycles.index') }}"
                                class="flex items-center justify-between px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('motorcycles.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                <span>Sewa Motor</span>
                                <svg class="w-4 h-4 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                            <a href="{{ route('tours.index') }}"
                                class="flex items-center justify-between px-6 py-4 rounded-2xl text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('tours.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                <span>Paket Wisata</span>
                                <svg class="w-4 h-4 opacity-0 -translate-x-2 transition-all duration-300 group-hover:opacity-100 group-hover:translate-x-0"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M9 5l7 7-7 7"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <a href="{{ route('posts.index') }}"
                    class="group relative text-sm font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('posts.*') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                    Berita
                    <span
                        class="absolute -bottom-1 left-0 w-0 h-0.5 bg-amber-500 transition-all duration-300 group-hover:w-full {{ request()->routeIs('posts.*') ? 'w-full' : '' }}"></span>
                </a>

                <div class="flex items-center gap-6 border-l border-amber-500/10 pl-8">
                    <button @click="searchModalOpen = true"
                        class="text-slate-400 hover:text-amber-600 hover:scale-110 transition-all duration-300">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                    </button>
                    <a href="{{ route('contact') }}"
                        class="group px-8 py-3.5 gold-btn text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-xl shadow-amber-500/20 flex items-center gap-2">
                        Hubungi Kami
                        <svg class="w-3.5 h-3.5 group-hover:translate-x-1 transition-transform" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- Mobile Actions -->
            <div class="flex items-center gap-4 lg:hidden">
                <button @click="searchModalOpen = true" class="p-2 text-slate-400 focus:outline-none">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </button>
                <button @click="mobileMenuOpen = !mobileMenuOpen" class="p-2 text-slate-800 focus:outline-none">
                    <svg x-show="!mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16">
                        </path>
                    </svg>
                    <svg x-show="mobileMenuOpen" class="w-6 h-6" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12">
                        </path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Redesign -->
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-400"
            x-transition:enter-start="opacity-0 -translate-y-10 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-300"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 -translate-y-10 scale-95"
            class="lg:hidden absolute top-[calc(100%+1rem)] inset-x-4 bg-white/95 backdrop-blur-2xl rounded-[2.5rem] shadow-[0_40px_100px_-20px_rgba(15,23,42,0.25)] border border-amber-50/50 p-8 z-[60]">
            <div class="flex flex-col items-center gap-6" x-data="{ mobileServiceOpen: false }">
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                    class="text-xs font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('home') ? 'text-amber-600' : 'text-slate-600' }}">Beranda</a>

                <a href="{{ route('about') }}" @click="mobileMenuOpen = false"
                    class="text-xs font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('about') ? 'text-amber-600' : 'text-slate-600' }}">Tentang</a>

                <div class="w-full flex flex-col items-center gap-4">
                    <button @click="mobileServiceOpen = !mobileServiceOpen"
                        class="flex items-center gap-3 text-xs font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('cars.*', 'motorcycles.*', 'tours.*') ? 'text-amber-600' : 'text-slate-600' }}">
                        <span>Layanan</span>
                        <svg class="w-4 h-4 transition-transform duration-500"
                            :class="{ 'rotate-180': mobileServiceOpen }" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7">
                            </path>
                        </svg>
                    </button>

                    <div x-show="mobileServiceOpen" x-transition:enter="transition ease-out duration-300"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="w-full grid grid-cols-1 gap-3 bg-slate-50/50 rounded-3xl p-4">
                        <a href="{{ route('cars.index') }}" @click="mobileMenuOpen = false"
                            class="py-3 text-[10px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('cars.*') ? 'text-amber-600' : 'text-slate-500' }}">Sewa
                            Mobil</a>
                        <a href="{{ route('motorcycles.index') }}" @click="mobileMenuOpen = false"
                            class="py-3 text-[10px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('motorcycles.*') ? 'text-amber-600' : 'text-slate-500' }}">Sewa
                            Motor</a>
                        <a href="{{ route('tours.index') }}" @click="mobileMenuOpen = false"
                            class="py-3 text-[10px] font-black uppercase tracking-[0.2em] {{ request()->routeIs('tours.*') ? 'text-amber-600' : 'text-slate-500' }}">Paket
                            Wisata</a>
                    </div>
                </div>

                <a href="{{ route('posts.index') }}" @click="mobileMenuOpen = false"
                    class="text-xs font-black uppercase tracking-[0.2em] transition-all {{ request()->routeIs('posts.*') ? 'text-amber-600' : 'text-slate-600' }}">Post</a>

                <div class="w-full h-px bg-slate-100 my-2"></div>

                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false"
                    class="w-full text-center py-5 gold-btn text-white rounded-2xl text-[10px] font-black uppercase tracking-[0.3em] shadow-xl shadow-amber-500/20">Hubungi
                    Kami</a>
            </div>
        </div>
    </nav>

    <!-- Search Modal -->
    <div x-show="searchModalOpen" x-cloak class="fixed inset-0 z-[100] overflow-y-auto"
        @keydown.escape.window="searchModalOpen = false">
        <div class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
            <div x-show="searchModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                x-transition:leave-end="opacity-0"
                class="fixed inset-0 transition-opacity bg-slate-900/90 backdrop-blur-sm"
                @click="searchModalOpen = false"></div>

            <div x-show="searchModalOpen" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="inline-block w-full max-w-2xl px-8 pt-5 pb-4 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-[2.5rem] sm:my-32">
                <div class="relative">
                    <input type="text" placeholder="Cari mobil, motor, atau paket wisata..."
                        class="w-full pl-14 pr-6 py-6 bg-slate-50 border-none rounded-3xl focus:ring-2 focus:ring-amber-500/20 font-black text-lg tracking-tight text-slate-900 placeholder-slate-400"
                        autofocus>
                    <svg class="w-6 h-6 text-amber-500 absolute left-6 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>

                <div class="mt-8 space-y-6">
                    <h4 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">Pencarian Populer</h4>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ route('cars.index') }}"
                            class="px-6 py-3 bg-slate-50 hover:bg-amber-50 hover:text-amber-600 rounded-2xl text-xs font-black transition-all border border-transparent hover:border-amber-100">Toyota
                            Alphard</a>
                        <a href="{{ route('cars.index') }}"
                            class="px-6 py-3 bg-slate-50 hover:bg-amber-50 hover:text-amber-600 rounded-2xl text-xs font-black transition-all border border-transparent hover:border-amber-100">Pajero
                            Sport</a>
                        <a href="{{ route('tours.index') }}"
                            class="px-6 py-3 bg-slate-50 hover:bg-amber-50 hover:text-amber-600 rounded-2xl text-xs font-black transition-all border border-transparent hover:border-amber-100">Paket
                            Wisata Bali</a>
                        <a href="{{ route('motorcycles.index') }}"
                            class="px-6 py-3 bg-slate-50 hover:bg-amber-50 hover:text-amber-600 rounded-2xl text-xs font-black transition-all border border-transparent hover:border-amber-100">NMAX
                            2024</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-slate-900 pt-16 pb-10 px-4 sm:px-6 lg:px-8 text-white overflow-hidden relative">
        <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 lg:gap-16 relative z-10">
            <div class="space-y-8">
                <a href="#" class="flex items-center gap-3">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center overflow-hidden">
                        <img src="{{ asset('logo.jpg') }}"
                            alt="{{ \App\Models\Setting::get('site_name', 'Rent Travel') }}"
                            class="w-full h-full object-contain">
                    </div>
                    <span
                        class="text-2xl font-black tracking-tighter uppercase gold-gradient-text">{{ \App\Models\Setting::get('site_name', 'RentTravel') }}</span>
                </a>
                <p class="text-slate-400 text-sm font-medium leading-relaxed italic">
                    "{{ \App\Models\Setting::get('site_description', 'Menghadirkan pengalaman perjalanan tak terlupakan dengan armada terbaik dan layanan premium kelas dunia.') }}"
                </p>
            </div>

            <div class="space-y-8">
                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-amber-500">Layanan</h4>
                <div class="flex flex-col gap-4 text-sm font-bold text-slate-300">
                    <a href="{{ route('cars.index') }}" class="hover:text-amber-500 transition-colors">Sewa Mobil</a>
                    <a href="{{ route('motorcycles.index') }}" class="hover:text-amber-500 transition-colors">Sewa
                        Motor</a>
                    <a href="{{ route('tours.index') }}" class="hover:text-amber-500 transition-colors">Paket
                        Wisata</a>
                </div>
            </div>

            <div class="space-y-8">
                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-amber-500">Bantuan</h4>
                <div class="flex flex-col gap-4 text-sm font-bold text-slate-300">
                    <a href="{{ route('faq') }}" class="hover:text-amber-500 transition-colors">FAQ</a>
                    <a href="{{ route('contact') }}" class="hover:text-amber-500 transition-colors">Kontak</a>
                    <a href="{{ route('about') }}" class="hover:text-amber-500 transition-colors">Tentang Kami</a>
                    <a href="{{ route('posts.index') }}" class="hover:text-amber-500 transition-colors">Berita
                        Terkini</a>
                </div>
            </div>

            <div class="space-y-8">
                <h4 class="text-xs font-black uppercase tracking-[0.3em] text-amber-500">Hubungi Kami</h4>
                <div class="flex flex-col gap-5">
                    <div class="flex items-start gap-4">
                        <div
                            class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0 border border-white/5">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <p class="text-[12px] font-bold text-slate-400 leading-relaxed italic">
                            {{ \App\Models\Setting::get('address', 'Jakarta, Indonesia') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0 border border-white/5">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1.01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                            </svg>
                        </div>
                        <p class="text-[12px] font-bold text-slate-400">
                            {{ \App\Models\Setting::get('whatsapp_number') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0 border border-white/5">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                            </svg>
                        </div>
                        <p class="text-[12px] font-bold text-slate-400">
                            {{ \App\Models\Setting::get('contact_email') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0 border border-white/5">
                            <svg class="w-5 h-5 text-amber-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-[12px] font-bold text-slate-400">
                            {{ \App\Models\Setting::get('opening_hours', 'Senin - Minggu: 24 Jam') }}
                        </p>
                    </div>
                </div>

                <div class="pt-6 border-t border-white/5">
                    <div class="flex gap-4">
                        @if (\App\Models\Setting::get('instagram_link'))
                            <a href="{{ \App\Models\Setting::get('instagram_link') }}"
                                class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-amber-500 transition-all border border-white/10 group shadow-lg shrink-0">
                                <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-1.999-4.359-2.614-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z" />
                                </svg>
                            </a>
                        @endif
                        @if (\App\Models\Setting::get('facebook_link'))
                            <a href="{{ \App\Models\Setting::get('facebook_link') }}"
                                class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-amber-500 transition-all border border-white/10 group shadow-lg shrink-0">
                                <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-2.2c0-.599.164-1 .923-1h3.111l-3.328-4.8c-.377-.545-.968-.909-1.614-1H8.083c-1.381 0-2.5 1.119-2.5 2.5V8z" />
                                </svg>
                            </a>
                        @endif
                        @if (\App\Models\Setting::get('tiktok_link'))
                            <a href="{{ \App\Models\Setting::get('tiktok_link') }}"
                                class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-amber-500 transition-all border border-white/10 group shadow-lg shrink-0">
                                <svg class="w-5 h-5 text-white group-hover:scale-110 transition-transform"
                                    fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M19.589 6.686a4.793 4.793 0 0 1-3.77-4.245V2h-3.445v13.64a2.892 2.892 0 1 1-5.201-1.743l-.002-.001.002.001a2.892 2.892 0 0 1 3.183-1.254V9.166a6.333 6.333 0 1 0 5.465 6.279V9.16a8.219 8.219 0 0 0 3.77 1.254V6.686z" />
                                </svg>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div
            class="max-w-7xl mx-auto mt-24 pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8">
            <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-500">&copy; {{ date('Y') }}
                {{ \App\Models\Setting::get('site_name', 'Rent Travel') }}. Hak Cipta Dilindungi.</p>
            <div class="flex items-center gap-8 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="#" class="hover:text-amber-500 transition-colors">Privacy Policy</a>
                <a href="#" class="hover:text-amber-500 transition-colors">Terms of Service</a>
            </div>
        </div>

        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-amber-500/10 rounded-full blur-[120px]"></div>
    </footer>

    <!-- User Feedback -->
    <x-feedback />

    <!-- AOS -->
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 1000,
            once: true
        });
    </script>

    <!-- Floating WhatsApp -->
    <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}" target="_blank"
        class="fixed bottom-8 right-8 z-[60] bg-emerald-500 text-white p-4 rounded-2xl shadow-2xl shadow-emerald-500/40 hover:scale-110 hover:-translate-y-1 transition-all group active:scale-95">
        <div
            class="absolute -top-12 right-0 bg-white text-slate-900 px-4 py-2 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-xl border border-emerald-50 opacity-0 group-hover:opacity-100 transition-opacity whitespace-nowrap pointer-events-none">
            Butuh Bantuan? Chat Kami
        </div>
        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
            <path
                d="M12.031 6.172c-3.181 0-5.767 2.586-5.768 5.766-.001 1.298.38 2.27 1.025 3.012l-.582 2.128 2.183-.573c.678.368 1.588.604 2.454.604l.001.001c3.182 0 5.767-2.587 5.768-5.766 0-3.18-2.585-5.766-5.767-5.766zm3.336 8.358c-.145.408-.84.712-1.155.757-.282.041-.64.062-1.036-.065-.245-.078-.542-.191-.933-.359-1.667-.714-2.733-2.404-2.816-2.515-.083-.111-.678-.9-.678-1.714 0-.814.425-1.213.577-1.378.152-.165.33-.207.44-.207h.314c.11 0 .257.01.37.27.113.264.408 1.033.447 1.114.039.08.065.174.013.284-.052.11-.077.177-.154.269-.077.091-.162.203-.231.272-.077.076-.157.159-.067.315.09.155.398.656.853 1.062.586.522 1.08.683 1.24.764.16.081.254.068.348-.04.093-.109.402-.468.511-.627.108-.16.216-.134.364-.08.148.054.94.443 1.103.525.163.081.27.121.31.19.039.07.039.404-.106.812zM12 2c5.523 0 10 4.477 10 10s-4.477 10-10 10S2 17.523 2 12c0-2.449.882-4.689 2.348-6.426l-.423-1.545 1.585.416C7.146 3.012 9.456 2 12 2z" />
        </svg>
    </a>
</body>

</html>
