<!DOCTYPE html>
<html lang="id" class="scroll-smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    @php
        $siteName = \App\Models\Setting::get('site_name', 'CJA Rent Car');
        $siteDescription = \App\Models\Setting::get('site_description', 'Rental mobil Tasikmalaya untuk harian, lepas kunci, driver, antar jemput, dan perjalanan wisata.');
        $siteUrl = url('/');
        $logoUrl = \App\Models\Setting::logoUrl();
        $contactNumber = \App\Models\Setting::whatsappNumber();
        $contactPhone = $contactNumber ? '+' . $contactNumber : null;
        $sameAs = collect([
            \App\Models\Setting::get('instagram_link'),
            \App\Models\Setting::get('facebook_link'),
            \App\Models\Setting::get('tiktok_link'),
        ])->filter()->values()->all();

        $organizationSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'LocalBusiness',
            '@id' => $siteUrl . '#localbusiness',
            'name' => $siteName,
            'alternateName' => 'CJA Rental Mobil & Motor Tasikmalaya',
            'description' => 'Layanan sewa mobil dan motor terbaik di Tasikmalaya. Tersedia unit Avanza, Brio, Hiace, NMAX, dan Vario dengan harga kompetitif.',
            'url' => $siteUrl,
            'telephone' => '0852-2039-9817',
            'priceRange' => 'Rp 150.000 - Rp 800.000',
            'image' => [
                $logoUrl,
                asset('landing.png')
            ],
            'address' => [
                '@type' => 'PostalAddress',
                'streetAddress' => 'Jl. Cipawitra No. 12',
                'addressLocality' => 'Tasikmalaya',
                'addressRegion' => 'Jawa Barat',
                'postalCode' => '46151',
                'addressCountry' => 'ID',
            ],
            'geo' => [
                '@type' => 'GeoCoordinates',
                'latitude' => -7.3357567,
                'longitude' => 108.1480361,
            ],
            'openingHoursSpecification' => [
                [
                    '@type' => 'OpeningHoursSpecification',
                    'dayOfWeek' => [
                        'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'
                    ],
                    'opens' => '06:00',
                    'closes' => '22:00',
                ]
            ],
            'sameAs' => [
                'https://www.google.com/maps/place/Rental+Mobil+Lepas+Kunci+Tasikmalaya+Cipawitra+Jaya+Abadi+(CJA+Rentcar)/@-7.3357567,108.1480361,17z',
                'https://www.instagram.com/cjarentcar_tasikmalaya/',
            ],
            'hasOfferCatalog' => [
                '@type' => 'OfferCatalog',
                'name' => 'Layanan CJA Rent Car',
                'itemListElement' => [
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Sewa Mobil + Driver',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Sewa Motor Harian',
                        ],
                    ],
                    [
                        '@type' => 'Offer',
                        'itemOffered' => [
                            '@type' => 'Service',
                            'name' => 'Paket Wisata Tasikmalaya',
                        ],
                    ],
                ]
            ]
        ];

        $faqSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => [
                [
                    '@type' => 'Question',
                    'name' => 'Dimana lokasi rental mobil CJA Rent Car di Tasikmalaya?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'CJA Rent Car berlokasi di area Cipawitra, Tasikmalaya, Jawa Barat. Kami melayani antar jemput unit ke stasiun, hotel, atau rumah Anda.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Apa saja jenis mobil yang tersedia untuk disewa?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Kami menyediakan berbagai unit populer seperti Toyota Avanza Veloz, Honda Brio RS, dan Toyota Hiace Commuter untuk rombongan.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Apakah bisa sewa mobil lepas kunci di Tasikmalaya?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Ya, kami menyediakan layanan sewa mobil lepas kunci (tanpa supir) dengan syarat dan ketentuan yang mudah bagi warga lokal maupun wisatawan.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Berapa harga sewa motor harian di CJA Rent Car?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Harga sewa motor harian mulai dari Rp 150.000 per hari untuk unit seperti Honda Vario 160 ABS dan Yamaha NMAX Connected.'
                    ]
                ],
                [
                    '@type' => 'Question',
                    'name' => 'Bagaimana cara booking sewa mobil di CJA Rent Car?',
                    'acceptedAnswer' => [
                        '@type' => 'Answer',
                        'text' => 'Anda dapat melakukan booking langsung melalui website cjarentcar.com atau melalui WhatsApp di nomor 0852-2039-9817.'
                    ]
                ]
            ]
        ];

        if (! empty($sameAs)) {
            $organizationSchema['sameAs'] = $sameAs;
        }

        $websiteSchema = [
            '@context' => 'https://schema.org',
            '@type' => 'WebSite',
            '@id' => $siteUrl . '#website',
            'name' => $siteName,
            'url' => $siteUrl,
            'description' => $siteDescription,
            'inLanguage' => 'id-ID',
            'publisher' => [
                '@id' => $siteUrl . '#organization',
            ],
            'potentialAction' => [
                '@type' => 'SearchAction',
                'target' => [
                    '@type' => 'EntryPoint',
                    'urlTemplate' => $siteUrl . '/pencarian?q={search_term_string}',
                ],
                'query-input' => 'required name=search_term_string',
            ],
        ];
    @endphp

    {{-- SEOTools: generates title, description, keywords, canonical, robots, OG, Twitter --}}
    {!! SEOMeta::generate() !!}
    {{-- Noindex untuk halaman pencarian & listing dengan filter/sort query params --}}
    @if(request()->routeIs('search') || (request()->hasAny(['search', 'category', 'categories', 'sort']) && request()->routeIs('cars.index', 'motorcycles.index', 'tours.index', 'posts.index')))
        <meta name="robots" content="noindex, nofollow">
    @endif
    {!! OpenGraph::generate() !!}
    {{-- Twitter Card: large image untuk preview yang lebih menarik --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@cjarentcar">
    {!! Twitter::generate() !!}
    {!! JsonLd::generate() !!}
    <script type="application/ld+json">{!! json_encode($organizationSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($websiteSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>
    <script type="application/ld+json">{!! json_encode($faqSchema, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) !!}</script>

    @stack('schema')
    @stack('styles')

    <!-- Performance Optimization: Preconnect to Font Domains -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="preconnect" href="https://cdnjs.cloudflare.com">

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Poppins:wght@600;700;800&display=swap"
        rel="stylesheet" media="print" onload="this.media='all'">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" 
        media="print" onload="this.media='all'">

    <style>
        :root {
            --luxury-gold: #C9A14A;
            --luxury-gold-light: #F4E7C5;
            --luxury-gold-dark: #8D6A2B;
            --luxury-gold-metallic: linear-gradient(135deg, #8d6a2b 0%, #c9a14a 58%, #e7cf95 100%);
            --midnight-slate: #111111;
            --surface-ivory: #FCFAF6;
            --copy-muted: #5F6B7A;
            --glass-white: rgba(255, 255, 255, 0.88);
            --glass-border: rgba(15, 23, 42, 0.07);
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--surface-ivory);
            color: #111827;
        }

        .font-heading {
            font-family: 'Poppins', sans-serif;
        }

        .home-typography {
            font-feature-settings: "ss01" on, "cv02" on, "cv03" on;
        }

        .home-typography h1,
        .home-typography h2,
        .home-typography h3 {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.035em;
        }

        .home-typography .section-title {
            font-family: 'Poppins', sans-serif;
            letter-spacing: -0.04em;
        }

        .home-typography .section-copy,
        .home-typography p {
            text-wrap: pretty;
        }

        .home-typography .home-kicker {
            font-family: 'Poppins', sans-serif;
            letter-spacing: 0.16em;
        }

        .glass-nav {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(15, 23, 42, 0.06);
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.04);
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
            background: linear-gradient(to right, transparent, rgba(255, 255, 255, 0.18), transparent);
            transform: rotate(30deg);
            transition: none;
        }

        .gold-btn:hover::after {
            left: 150%;
            transition: all 0.7s ease-in-out;
        }

        .gold-btn:hover {
            box-shadow: 0 16px 32px -14px rgba(141, 106, 43, 0.28);
            transform: translateY(-2px);
        }

        /* Scrollbar */
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

        /* Utilities */
        .glass-premium {
            background: var(--glass-white);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid var(--glass-border);
            box-shadow: 0 8px 32px 0 rgba(15, 23, 42, 0.05);
        }

        .hover-glow:hover {
            box-shadow: 0 0 30px rgba(212, 175, 55, 0.2);
            border-color: rgba(212, 175, 55, 0.4);
        }

        .text-balance {
            text-wrap: balance;
        }

        .gold-border-gradient {
            border: 1px solid;
            border-image-source: var(--luxury-gold-metallic);
            border-image-slice: 1;
        }

        [x-cloak] {
            display: none !important;
        }
    </style>
</head>

<body class="bg-white text-slate-900 overflow-x-hidden"
    x-data="{ mobileMenuOpen: false, searchModalOpen: false, dropdownOpen: false, mobileServiceOpen: false }">
    <!-- Navbar -->
    <nav class="fixed top-0 w-full z-50 glass-nav">

        {{-- ── Main Bar ── --}}
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex justify-between items-center h-16 sm:h-18 lg:h-20">

                {{-- Logo --}}
                <a href="{{ route('home') }}" class="flex items-center shrink-0 group">
                    <img src="{{ \App\Models\Setting::logoUrl() }}"
                        alt="{{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}"
                        class="h-9 sm:h-10 lg:h-12 w-auto object-contain transition-all duration-500 group-hover:scale-105"
                        width="180"
                        height="48"
                        fetchpriority="high">
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden lg:flex items-center gap-10 xl:gap-12">
                    <div class="h-8 w-px bg-amber-500/10"></div>

                    <a href="{{ route('home') }}"
                        class="group relative text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('home') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                        Beranda
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-amber-500 transition-all duration-300 {{ request()->routeIs('home') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    <a href="{{ route('about') }}"
                        class="group relative text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('about') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                        Tentang
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-amber-500 transition-all duration-300 {{ request()->routeIs('about') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    <a href="{{ route('testimonials') }}"
                        class="group relative text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('testimonials') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                        Testimoni
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-amber-500 transition-all duration-300 {{ request()->routeIs('testimonials') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    {{-- Layanan Dropdown --}}
                    <div class="relative" @mouseenter="dropdownOpen = true" @mouseleave="dropdownOpen = false">
                        <button type="button"
                            class="flex items-center gap-1.5 text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('cars.*', 'motorcycles.*', 'tours.*') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                            Layanan
                            <i class="fa-solid fa-chevron-down text-[10px] transition-transform duration-300" :class="{ 'rotate-180': dropdownOpen }"></i>
                        </button>
                        <div x-show="dropdownOpen" x-cloak x-transition:enter="transition ease-out duration-200"
                            x-transition:enter-start="opacity-0 translate-y-3 scale-95"
                            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                            x-transition:leave="transition ease-in duration-150"
                            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
                            x-transition:leave-end="opacity-0 translate-y-3 scale-95"
                            class="absolute top-full left-1/2 -translate-x-1/2 pt-4 w-52">
                            <div
                                class="bg-white/95 backdrop-blur-xl rounded-2xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] border border-slate-100 p-2 overflow-hidden">
                                <a href="{{ route('cars.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[11px] font-black uppercase tracking-wider transition-all {{ request()->routeIs('cars.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <i class="fa-solid fa-car-side w-4 h-4 shrink-0"></i>
                                    Sewa Mobil
                                </a>
                                <a href="{{ route('motorcycles.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[11px] font-black uppercase tracking-wider transition-all {{ request()->routeIs('motorcycles.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <i class="fa-solid fa-motorcycle w-4 h-4 shrink-0"></i>
                                    Sewa Motor
                                </a>
                                <a href="{{ route('tours.index') }}"
                                    class="flex items-center gap-3 px-4 py-3 rounded-xl text-[11px] font-black uppercase tracking-wider transition-all {{ request()->routeIs('tours.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                                    <i class="fa-solid fa-map-location-dot w-4 h-4 shrink-0"></i>
                                    Paket Wisata
                                </a>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('posts.index') }}"
                        class="group relative text-[11px] font-black uppercase tracking-widest transition-all duration-300 {{ request()->routeIs('posts.*') ? 'text-amber-600' : 'text-slate-600 hover:text-amber-500' }}">
                        Berita
                        <span
                            class="absolute -bottom-1 left-0 h-0.5 bg-amber-500 transition-all duration-300 {{ request()->routeIs('posts.*') ? 'w-full' : 'w-0 group-hover:w-full' }}"></span>
                    </a>

                    <div class="h-8 w-px bg-amber-500/10"></div>

                    <a href="{{ route('contact') }}"
                        class="group px-7 py-3 gold-btn text-white rounded-full text-[10px] font-black uppercase tracking-widest shadow-lg shadow-amber-500/20 shrink-0">
                        Hubungi Kami
                    </a>
                </div>

                {{-- Mobile Right Actions --}}
                <div class="flex items-center gap-1 lg:hidden">
                    {{-- Search icon --}}
                    <button type="button" @click="searchModalOpen = true"
                        class="p-2.5 text-slate-500 hover:text-amber-600 rounded-xl hover:bg-amber-50 transition-all">
                        <i class="fa-solid fa-magnifying-glass w-5 h-5"></i>
                    </button>

                    {{-- Hamburger / Close --}}
                    <button type="button" @click="mobileMenuOpen = !mobileMenuOpen" class="p-2.5 rounded-xl transition-all"
                        :class="mobileMenuOpen ? 'bg-amber-50 text-amber-600' : 'text-slate-800 hover:bg-slate-50'">
                        <i x-show="!mobileMenuOpen" class="fa-solid fa-bars w-5 h-5"></i>
                        <i x-show="mobileMenuOpen" x-cloak class="fa-solid fa-xmark w-5 h-5"></i>
                    </button>
                </div>

            </div>
        </div>

        {{-- ── Mobile Drawer ── --}}
        <div x-show="mobileMenuOpen" x-cloak x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 -translate-y-4" x-transition:enter-end="opacity-100 translate-y-0"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 translate-y-0"
            x-transition:leave-end="opacity-0 -translate-y-4"
            class="lg:hidden absolute top-full inset-x-0 bg-white border-t border-amber-100/50 shadow-[0_20px_60px_-10px_rgba(15,23,42,0.15)]">

            <div class="max-w-7xl mx-auto px-4 py-6 space-y-1">

                {{-- Nav Links --}}
                <a href="{{ route('home') }}" @click="mobileMenuOpen = false"
                    class="flex items-center justify-between px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('home') ? 'text-amber-600 bg-amber-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span>Beranda</span>
                    @if (request()->routeIs('home'))
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    @endif
                </a>

                <a href="{{ route('about') }}" @click="mobileMenuOpen = false"
                    class="flex items-center justify-between px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('about') ? 'text-amber-600 bg-amber-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span>Tentang</span>
                    @if (request()->routeIs('about'))
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    @endif
                </a>

                <a href="{{ route('testimonials') }}" @click="mobileMenuOpen = false"
                    class="flex items-center justify-between px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('testimonials') ? 'text-amber-600 bg-amber-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span>Testimoni</span>
                    @if (request()->routeIs('testimonials'))
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    @endif
                </a>

                {{-- Layanan Accordion --}}
                <div>
                    <button type="button" @click="mobileServiceOpen = !mobileServiceOpen"
                        class="w-full flex items-center justify-between px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('cars.*', 'motorcycles.*', 'tours.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-700 hover:bg-slate-50' }}">
                        <span>Layanan</span>
                        <i class="fa-solid fa-chevron-down text-xs transition-transform duration-300" :class="{ 'rotate-180': mobileServiceOpen }"></i>
                    </button>

                    <div x-show="mobileServiceOpen" x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 -translate-y-2"
                        x-transition:enter-end="opacity-100 translate-y-0"
                        class="mt-1 ml-4 border-l-2 border-amber-200/60 pl-4 space-y-1">
                        <a href="{{ route('cars.index') }}" @click="mobileMenuOpen = false"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('cars.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i class="fa-solid fa-car-side w-4 h-4 shrink-0 text-amber-500"></i>
                            Sewa Mobil
                        </a>
                        <a href="{{ route('motorcycles.index') }}" @click="mobileMenuOpen = false"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('motorcycles.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i class="fa-solid fa-motorcycle w-4 h-4 shrink-0 text-amber-500"></i>
                            Sewa Motor
                        </a>
                        <a href="{{ route('tours.index') }}" @click="mobileMenuOpen = false"
                            class="flex items-center gap-3 px-4 py-3 rounded-xl font-semibold text-sm transition-all {{ request()->routeIs('tours.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-600 hover:bg-slate-50 hover:text-slate-900' }}">
                            <i class="fa-solid fa-map-location-dot w-4 h-4 shrink-0 text-amber-500"></i>
                            Paket Wisata
                        </a>
                    </div>
                </div>

                <a href="{{ route('posts.index') }}" @click="mobileMenuOpen = false"
                    class="flex items-center justify-between px-4 py-3.5 rounded-xl font-bold text-sm transition-all {{ request()->routeIs('posts.*') ? 'text-amber-600 bg-amber-50' : 'text-slate-700 hover:bg-slate-50' }}">
                    <span>Berita</span>
                    @if (request()->routeIs('posts.*'))
                        <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                    @endif
                </a>

                {{-- Divider --}}
                <div class="h-px bg-slate-100 my-2 mx-4"></div>

                {{-- CTA --}}
                <a href="{{ route('contact') }}" @click="mobileMenuOpen = false"
                    class="flex items-center justify-center w-full py-4 gold-btn text-white rounded-2xl text-sm font-black uppercase tracking-widest shadow-lg shadow-amber-500/20 mt-2">
                    Hubungi Kami
                </a>

                {{-- Quick contact strip --}}
                <div class="flex items-center justify-center gap-6 pt-2 pb-1">
                    <a href="{{ \App\Models\Setting::whatsappLink() }}"
                        class="flex items-center gap-2 text-xs font-semibold text-slate-500 hover:text-emerald-600 transition-colors">
                        <i class="fa-brands fa-whatsapp w-4 h-4 text-emerald-500 text-lg"></i>
                        Chat WhatsApp
                    </a>
                    <span class="text-slate-200">|</span>
                    <span class="flex items-center gap-1.5 text-xs font-semibold text-slate-400">
                        <span class="relative flex h-1.5 w-1.5">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-1.5 w-1.5 bg-emerald-500"></span>
                        </span>
                        Online 24/7
                    </span>
                </div>

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
                <form action="{{ route('search') }}" method="GET" class="relative">
                    <input type="text" name="q" placeholder="Cari mobil, motor, atau paket wisata..."
                        class="w-full pl-14 pr-28 py-6 bg-slate-50 border-none rounded-3xl focus:ring-2 focus:ring-amber-500/20 font-black text-lg tracking-tight text-slate-900 placeholder-slate-400"
                        value="{{ request('q') }}" autofocus>
                    <i class="fa-solid fa-magnifying-glass text-amber-500 absolute left-6 top-1/2 -translate-y-1/2 text-xl"></i>
                    <div class="absolute right-4 top-1/2 flex -translate-y-1/2 items-center gap-2">
                        <button type="submit"
                            class="rounded-xl bg-slate-900 px-4 py-2 text-xs font-black uppercase tracking-wider text-white transition-colors hover:bg-amber-500">
                            Cari
                        </button>
                        <button type="button" @click="searchModalOpen = false"
                            class="rounded-xl p-2 text-slate-400 transition-colors hover:bg-slate-100 hover:text-slate-700">
                            <i class="fa-solid fa-xmark w-6 h-6"></i>
                        </button>
                    </div>
                </form>

                {{-- <div class="mt-8 space-y-6">
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
                </div> --}}
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
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center overflow-hidden">
                        <img src="{{ \App\Models\Setting::logoUrl() }}"
                            alt="{{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}"
                            class="w-full h-full object-contain">
                    </div>
                    <span
                        class="text-2xl font-black tracking-tighter uppercase gold-gradient-text">{{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}</span>
                </a>
                <p class="text-slate-400 text-sm font-medium leading-relaxed italic">
                    "{{ \App\Models\Setting::get('site_description', 'Rental mobil Tasikmalaya untuk harian, lepas kunci, driver, antar jemput, dan perjalanan luar kota dengan proses booking cepat.') }}"
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
                    <a href="{{ route('testimonials') }}" class="hover:text-amber-500 transition-colors">Testimoni</a>
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
                            <i class="fa-solid fa-location-dot text-amber-500 text-lg"></i>
                        </div>
                        <p class="text-[12px] font-bold text-slate-400 leading-relaxed italic">
                            {{ \App\Models\Setting::get('address', 'Tasikmalaya, Jawa Barat') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0 border border-white/5">
                            <i class="fa-brands fa-whatsapp text-amber-500 text-xl"></i>
                        </div>
                        <p class="text-[12px] font-bold text-slate-400">
                            {{ \App\Models\Setting::get('whatsapp_number') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0 border border-white/5">
                            <i class="fa-solid fa-envelope text-amber-500 text-lg"></i>
                        </div>
                        <p class="text-[12px] font-bold text-slate-400">
                            {{ \App\Models\Setting::get('contact_email') }}
                        </p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div
                            class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center shrink-0 border border-white/5">
                            <i class="fa-solid fa-clock text-amber-500 text-lg"></i>
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
                                <i class="fa-brands fa-instagram text-xl text-white group-hover:scale-110 transition-transform"></i>
                            </a>
                        @endif
                        @if (\App\Models\Setting::get('facebook_link'))
                            <a href="{{ \App\Models\Setting::get('facebook_link') }}"
                                class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-amber-500 transition-all border border-white/10 group shadow-lg shrink-0">
                                <i class="fa-brands fa-facebook-f text-xl text-white group-hover:scale-110 transition-transform"></i>
                            </a>
                        @endif
                        @if (\App\Models\Setting::get('tiktok_link'))
                            <a href="{{ \App\Models\Setting::get('tiktok_link') }}"
                                class="w-10 h-10 bg-white/5 rounded-xl flex items-center justify-center hover:bg-amber-500 transition-all border border-white/10 group shadow-lg shrink-0">
                                <i class="fa-brands fa-tiktok text-xl text-white group-hover:scale-110 transition-transform"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div
            class="max-w-7xl mx-auto mt-24 pt-12 border-t border-white/5 flex flex-col md:flex-row justify-between items-center gap-8">
            <p class="text-xs font-black uppercase tracking-[0.2em] text-slate-500">&copy; {{ date('Y') }}
                {{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}. Hak Cipta Dilindungi.</p>
            <div class="flex items-center gap-8 text-[10px] font-black uppercase tracking-widest text-slate-500">
                <a href="{{ route('privacy-policy') }}" class="hover:text-amber-500 transition-colors">Privacy Policy</a>
                <a href="{{ route('terms-of-service') }}" class="hover:text-amber-500 transition-colors">Terms of Service</a>
            </div>
        </div>

        <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-amber-500/10 rounded-full blur-[120px]"></div>
    </footer>

    <!-- User Feedback -->
    {{-- <x-feedback /> --}}

    <!-- Floating WhatsApp -->
    <a href="{{ \App\Models\Setting::whatsappLink() }}" target="_blank"
        aria-label="Booking via WhatsApp"
        class="fixed bottom-5 right-4 z-[60] flex h-12 w-12 items-center justify-center rounded-full bg-emerald-500 text-white shadow-[0_18px_40px_-22px_rgba(16,185,129,0.65)] transition-all active:scale-95 hover:scale-105 hover:-translate-y-1 md:bottom-8 md:right-8 md:h-14 md:w-14">
        <i class="fa-brands fa-whatsapp text-2xl"></i>
    </a>
    @stack('scripts')
</body>

</html>
