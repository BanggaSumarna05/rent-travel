<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ \App\Models\Setting::get('site_name', 'Rent Travel') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <style>
        [x-cloak] {
            display: none !important;
        }

        body {
            font-family: 'Inter', sans-serif;
            scroll-behavior: smooth;
        }

        .font-heading {
            font-family: 'Outfit', sans-serif;
        }

        .sidebar-gradient {
            background: linear-gradient(180deg, #020617 0%, #0f172a 100%);
        }

        .active-nav {
            background: rgba(212, 175, 55, 0.1);
            border-left: 4px solid #D4AF37;
            color: #D4AF37 !important;
        }

        .active-nav svg {
            color: #D4AF37;
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(16px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #B8860B 0%, #D4AF37 50%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        /* Premium Scrollbar */
        ::-webkit-scrollbar {
            width: 6px;
            height: 6px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 10px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: #D4AF37;
        }

        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }

        /* Custom animations */
        @keyframes slide-in-from-top {
            from {
                opacity: 0;
                transform: translateY(-0.5rem);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-slide-in-top {
            animation: slide-in-from-top 0.4s cubic-bezier(0, 0, 0.2, 1);
        }
    </style>
</head>

<body class="bg-slate-50 text-slate-900 flex h-screen overflow-hidden" x-data="{ sidebarOpen: false }">
    <!-- Mobile Overlay -->
    <div x-show="sidebarOpen" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100" x-transition:leave="transition ease-in duration-200"
        x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0" @click="sidebarOpen = false"
        class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm z-40 lg:hidden"></div>

    <!-- Sidebar -->
    <aside
        class="fixed inset-y-0 left-0 w-72 sidebar-gradient text-white flex flex-col shadow-2xl z-50 transform lg:relative lg:translate-x-0 transition-transform duration-300 ease-in-out"
        :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full'">

        <!-- Logo Header -->
        <div class="p-6 lg:p-8 border-b border-white/5 mb-4 lg:mb-6 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 lg:gap-4 group">
                <div
                    class="w-10 h-10 lg:w-12 lg:h-12 bg-slate-900 rounded-xl lg:rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/10 group-hover:scale-105 transition-transform overflow-hidden border border-white/10">
                    <img src="{{ asset('logo.jpg') }}" alt="{{ \App\Models\Setting::get('site_name', 'Rent Travel') }}"
                        class="w-full h-full object-contain p-1">
                </div>
                <div>
                    <div class="text-sm lg:text-base font-black tracking-tight uppercase leading-none">CJA<span
                            class="gold-gradient-text">RENT CAR</span></div>
                    <div class="text-[9px] font-bold text-amber-500 uppercase tracking-wider mt-1">Sistem Admin</div>
                </div>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-white/50 hover:text-white transition-colors p-1">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar pb-4">
            <!-- Main Navigation -->
            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-4 mb-3 mt-6">Navigasi Utama
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.dashboard') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                <span class="text-sm font-bold">Dashboard</span>
            </a>

            <a href="{{ route('admin.transactions.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.transactions.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                </svg>
                <span class="text-sm font-bold">Transaksi</span>
            </a>

            <!-- Fleet Management -->
            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-4 mb-3 mt-8">Manajemen Armada
            </div>

            <a href="{{ route('admin.cars.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.cars.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="8" cy="18" r="2" stroke="currentColor" stroke-width="2" fill="none" />
                    <circle cx="16" cy="18" r="2" stroke="currentColor" stroke-width="2" fill="none" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12h13l3-6H3z" />
                </svg>
                <span class="text-sm font-bold">Mobil</span>
            </a>

            <a href="{{ route('admin.motorcycles.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.motorcycles.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <circle cx="6" cy="19" r="2" stroke="currentColor" stroke-width="2" fill="none" />
                    <circle cx="18" cy="19" r="2" stroke="currentColor" stroke-width="2"
                        fill="none" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 17h4l2-5 3-2" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17l-1-4-2-1H4" />
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 6h5l2 5" />
                </svg>
                <span class="text-sm font-bold">Motor</span>
            </a>

            <a href="{{ route('admin.tour-packages.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.tour-packages.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-bold">Paket Wisata</span>
            </a>

            <!-- Content & General -->
            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-4 mb-3 mt-8">Konten & Umum
            </div>

            <a href="{{ route('admin.testimonials.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.testimonials.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                </svg>
                <span class="text-sm font-bold">Testimoni</span>
            </a>

            <a href="{{ route('admin.posts.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.posts.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z" />
                </svg>
                <span class="text-sm font-bold">Post</span>
            </a>

            <a href="{{ route('admin.faqs.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.faqs.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <span class="text-sm font-bold">FAQ</span>
            </a>

            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.settings.*') ? 'active-nav' : '' }}">
                <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                </svg>
                <span class="text-sm font-bold">Pengaturan</span>
            </a>
        </nav>

        <!-- System Status Footer -->
        <div class="p-4 lg:p-6 border-t border-white/5">
            <div
                class="bg-white/5 rounded-xl lg:rounded-2xl p-3 lg:p-4 relative overflow-hidden group hover:bg-white/10 transition-all border border-white/5">
                <div
                    class="absolute -top-10 -right-10 w-20 lg:w-24 h-20 lg:h-24 bg-amber-500/10 rounded-full blur-2xl group-hover:scale-150 transition-transform duration-1000">
                </div>
                <div class="relative z-10">
                    <div class="text-[8px] lg:text-[9px] font-bold text-amber-500/60 uppercase tracking-[0.2em] mb-1">
                        Status Sistem</div>
                    <div class="text-xs font-bold flex items-center gap-2 text-white/90">
                        <span class="w-1.5 h-1.5 bg-amber-500 rounded-full animate-pulse"></span>
                        Luxury Admin v2.1
                    </div>
                </div>
            </div>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col min-w-0 overflow-hidden relative">
        <!-- Top Header -->
        <header
            class="h-16 lg:h-20 xl:h-24 glass-header px-4 lg:px-8 xl:px-10 flex items-center justify-between shrink-0 relative z-20">
            <div class="flex items-center gap-3 lg:gap-0 min-w-0">
                <button @click="sidebarOpen = true"
                    class="lg:hidden p-2 text-slate-700 hover:bg-slate-100 rounded-lg transition-colors shrink-0">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <h1 class="text-base lg:text-xl font-black text-slate-900 tracking-tighter leading-none">
                    @yield('title', 'Beranda')
                </h1>
            </div>

            <div class="flex items-center gap-3 lg:gap-6 xl:gap-8 shrink-0">
                <div class="hidden md:flex flex-col text-right">
                    <span
                        class="text-sm font-black text-slate-900 truncate max-w-[150px] lg:max-w-none tracking-tight">
                        {{ auth()->user()->name }}
                    </span>
                    <span class="text-[9px] font-bold text-amber-600 uppercase tracking-widest">
                        Luxury Specialist
                    </span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-10 h-10 lg:w-12 lg:h-12 bg-slate-900 text-amber-400 rounded-xl lg:rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white hover:scale-105 transition-all shadow-xl shadow-amber-950/20"
                        title="Logout">
                        <svg class="w-5 h-5 lg:w-6 lg:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form>
            </div>
        </header>

        <!-- Content Area -->
        <section class="flex-1 overflow-y-auto p-4 lg:p-8 xl:p-10">
            <!-- Success Message -->
            @if (session('success'))
                <div
                    class="mb-6 lg:mb-8 xl:mb-10 bg-gradient-to-r from-teal-50 to-emerald-50 border border-teal-200 text-teal-700 px-5 lg:px-6 xl:px-8 py-4 lg:py-5 xl:py-6 rounded-xl lg:rounded-2xl xl:rounded-[2rem] flex items-center gap-3 lg:gap-4 animate-slide-in-top shadow-sm">
                    <svg class="w-5 h-5 lg:w-6 lg:h-6 shrink-0" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd"
                            d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                            clip-rule="evenodd" />
                    </svg>
                    <span class="font-bold text-xs lg:text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </section>
    </main>

    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            duration: 800,
            once: true,
            offset: 50,
            easing: 'ease-out-cubic'
        });
    </script>
</body>

</html>
