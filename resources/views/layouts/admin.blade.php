<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
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

        .active-nav i {
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
                    <img src="{{ \App\Models\Setting::logoUrl() }}" alt="{{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}"
                        class="w-full h-full object-contain p-1">
                </div>
                <div>
                    <div class="text-sm lg:text-base font-black tracking-tight uppercase leading-none">CJA<span
                            class="gold-gradient-text">RENT CAR</span></div>
                    <div class="text-[9px] font-bold text-amber-500 uppercase tracking-wider mt-1">Sistem Admin</div>
                </div>
            </a>
            <button @click="sidebarOpen = false" class="lg:hidden text-white/50 hover:text-white transition-colors p-1">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 px-4 space-y-1 overflow-y-auto no-scrollbar pb-4">
            <!-- Main Navigation -->
            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-4 mb-3 mt-6">Navigasi Utama
            </div>

            <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.dashboard') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-gauge-high w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Dashboard</span>
            </a>

            <a href="{{ route('admin.transactions.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.transactions.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-receipt w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Transaksi</span>
            </a>

            <a href="{{ route('admin.customers.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.customers.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-users w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Data Pelanggan</span>
            </a>

            <!-- Fleet Management -->
            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-4 mb-3 mt-8">Manajemen Armada
            </div>

            <a href="{{ route('admin.cars.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.cars.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-car w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Mobil</span>
            </a>

            <a href="{{ route('admin.motorcycles.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.motorcycles.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-motorcycle w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Motor</span>
            </a>

            <a href="{{ route('admin.tour-packages.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.tour-packages.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-map-location-dot w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Paket Wisata</span>
            </a>

            <!-- Content & General -->
            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-4 mb-3 mt-8">Konten & Umum
            </div>

            <a href="{{ route('admin.testimonials.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.testimonials.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-star w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Testimoni</span>
            </a>

            <a href="{{ route('admin.posts.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.posts.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-newspaper w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Post</span>
            </a>

            <a href="{{ route('admin.faqs.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.faqs.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-circle-question w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">FAQ</span>
            </a>

            <a href="{{ route('admin.settings.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.settings.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-gears w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Pengaturan</span>
            </a>

            <!-- Administration -->
            <div class="text-[10px] font-bold text-slate-500 uppercase tracking-wider px-4 mb-3 mt-8">Administrasi
            </div>

            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.users.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-user-shield w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Daftar Admin</span>
            </a>

            <a href="{{ route('admin.activity-logs.index') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-400 hover:text-white hover:bg-white/5 transition-all {{ request()->routeIs('admin.activity-logs.*') ? 'active-nav' : '' }}">
                <i class="fa-solid fa-clock-rotate-left w-5 text-center shrink-0"></i>
                <span class="text-sm font-bold">Log Aktivitas</span>
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
                        Dashboard Admin v2.1
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
                    <i class="fa-solid fa-bars text-xl"></i>
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
                        Administrator
                    </span>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-10 h-10 lg:w-12 lg:h-12 bg-slate-900 text-amber-400 rounded-xl lg:rounded-2xl flex items-center justify-center hover:bg-amber-500 hover:text-white hover:scale-105 transition-all shadow-xl shadow-amber-950/20"
                        title="Logout">
                        <i class="fa-solid fa-right-from-bracket text-lg"></i>
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
                    <i class="fa-solid fa-circle-check text-xl"></i>
                    <span class="font-bold text-xs lg:text-sm">{{ session('success') }}</span>
                </div>
            @endif

            <!-- Page Content -->
            @yield('content')
        </section>
    </main>
</body>

</html>
