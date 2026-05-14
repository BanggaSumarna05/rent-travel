@extends('layouts.admin')

@section('title', 'Dashboard Sistem')

@section('content')

<div class="space-y-10 animate-fade-in">

    {{-- ── WELCOME HEADER ──────────────────────────────────────────── --}}
    <div class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-900 to-black
                rounded-[2.5rem] lg:rounded-[3.5rem] p-8 lg:p-14 text-white
                shadow-3xl border border-white/5 group">

        <div class="absolute top-0 right-0 -mt-24 -mr-24 w-[500px] h-[500px]
                    bg-amber-500/10 blur-[120px] rounded-full
                    group-hover:scale-110 transition-transform duration-1000">
        </div>
        <div class="absolute bottom-0 left-0 -mb-24 -ml-24 w-[400px] h-[400px]
                    bg-slate-500/10 blur-[120px] rounded-full
                    group-hover:scale-110 transition-transform duration-1000"
             style="transition-delay: 200ms">
        </div>

        <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-10">

            <div class="max-w-2xl">
                <div class="flex items-center gap-4 mb-6">
                    <div class="px-4 py-1.5 bg-amber-500/20 border border-amber-500/20 rounded-full">
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-500">
                            Proud Villa Admin System
                        </span>
                    </div>
                    <span class="text-xs font-bold text-slate-500 italic">Official Dashboard</span>
                </div>

                <h2 class="text-4xl lg:text-7xl font-black mb-6 tracking-tighter leading-[0.9]">
                    Selamat datang, <br>
                    <span class="gold-gradient-text">{{ explode(' ', auth()->user()->name)[0] }}!</span>
                </h2>

                <p class="text-slate-400 text-lg font-medium leading-relaxed max-w-xl mb-10">
                    Sistem berjalan dengan optimal. Kelola data unit dan tinjau performa bisnis
                    Anda hari ini dengan mudah.
                </p>

                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('admin.cars.create') }}"
                       class="inline-flex items-center justify-center px-10 py-5 bg-white text-slate-900
                              rounded-2xl font-black text-sm uppercase tracking-widest shadow-xl shadow-black/20
                              hover:bg-amber-500 hover:text-white hover:-translate-y-1 transition-all duration-500">
                        <i class="fa-solid fa-car-side mr-3 text-lg"></i>
                        Tambah Mobil
                    </a>
                    <a href="{{ route('admin.settings.index') }}"
                       class="inline-flex items-center justify-center px-10 py-5 bg-slate-800/40 backdrop-blur-xl
                              text-white border border-white/10 rounded-2xl font-black text-sm uppercase tracking-widest
                              hover:bg-slate-800 hover:border-amber-500/50 transition-all duration-500">
                        <i class="fa-solid fa-sliders mr-3 text-lg"></i>
                        Konfigurasi
                    </a>
                </div>
            </div>

            <div class="hidden lg:block">
                <div class="w-64 h-64 bg-white/5 backdrop-blur-2xl rounded-[3rem] border border-white/10
                            p-10 shadow-3xl relative overflow-hidden group/clock">
                    <div class="absolute inset-x-0 bottom-0 h-1
                                bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600
                                scale-x-0 group-hover/clock:scale-x-100 transition-transform duration-1000">
                    </div>
                    <div class="relative z-10 h-full flex flex-col justify-center text-center">
                        @php
                            \Carbon\Carbon::setLocale('id');
                            $now = \Carbon\Carbon::now('Asia/Jakarta');
                        @endphp
                        <div class="text-[10px] font-black text-amber-500 uppercase tracking-[0.4em] mb-4">
                            Laporan Waktu
                        </div>
                        <div class="text-5xl font-black text-white mb-2 tracking-tighter tabular-nums">
                            {{ $now->format('H:i') }}
                        </div>
                        <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                            {{ $now->isoFormat('dddd') }} <br>
                            {{ $now->isoFormat('D MMMM Y') }}
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>


    {{-- ── STATISTICS CARDS ────────────────────────────────────────── --}}
    @php
        $stats = [
            ['label' => 'Total Mobil',      'count' => $totalCars,                                         'icon' => 'fa-car'],
            ['label' => 'Total Motor',      'count' => $totalMotorcycles,                                  'icon' => 'fa-motorcycle'],
            ['label' => 'Paket Wisata',     'count' => $totalTours,                                        'icon' => 'fa-map-location-dot'],
            ['label' => 'Total Transaksi',  'count' => $totalTransactions,                                 'icon' => 'fa-file-invoice-dollar'],
            ['label' => 'Booking Pending',  'count' => $pendingTransactions,                               'icon' => 'fa-clock'],
            ['label' => 'Estimasi Omzet',   'count' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'), 'icon' => 'fa-wallet', 'is_price' => true],
        ];
    @endphp

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
        @foreach ($stats as $stat)
            <div class="group relative bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100
                        hover:shadow-4xl transition-all duration-500 overflow-hidden">

                <div class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-full -mr-16 -mt-16
                            group-hover:scale-150 transition-transform duration-700">
                </div>

                <div class="relative z-10">

                    <div class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center
                                text-[#D4AF37] mb-10 shadow-xl shadow-amber-950/20 border border-white/5
                                group-hover:bg-amber-500 group-hover:text-white transition-all duration-500">
                        <i class="fa-solid {{ $stat['icon'] }} text-2xl"></i>
                    </div>

                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                        {{ $stat['label'] }}
                    </div>
                    <div class="font-black text-slate-900 tracking-tighter tabular-nums mb-6
                                group-hover:scale-105 transition-transform origin-left
                                {{ isset($stat['is_price']) ? 'text-3xl' : 'text-5xl' }}">
                        {{ $stat['count'] }}
                    </div>

                    <div class="flex items-center gap-2 px-4 py-2 bg-slate-50 rounded-xl w-fit border border-slate-100 shadow-sm">
                        <span class="relative flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest italic">
                            Updated Live
                        </span>
                    </div>

                </div>
            </div>
        @endforeach
    </div>


    {{-- ── QUICK ACTIONS & ACTIVITY LOG ───────────────────────────── --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">

        <div class="lg:col-span-2 space-y-8">

            <div class="flex items-center gap-4">
                <div class="w-1.5 h-8 bg-amber-500 rounded-full"></div>
                <h3 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Perintah Utama</h3>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">

                <a href="{{ route('admin.transactions.index') }}"
                   class="group bg-slate-900 p-10 rounded-[3rem] shadow-xl hover:shadow-4xl
                          transition-all duration-500 flex items-center gap-8 relative overflow-hidden border border-white/5">
                    <div class="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 blur-[40px] rounded-full
                                group-hover:scale-150 transition-transform duration-1000">
                    </div>
                    <div class="w-16 h-16 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center
                                text-amber-400 border border-white/10 shrink-0
                                group-hover:rotate-12 transition-all duration-500">
                        <i class="fa-solid fa-chart-line text-2xl"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="text-white font-black text-xl mb-1 tracking-tight">Lihat Transaksi</div>
                        <div class="text-amber-500/60 text-[10px] font-black uppercase tracking-widest">Monitoring Pesanan</div>
                    </div>
                </a>

                <a href="{{ route('admin.cars.create') }}"
                   class="group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-4xl
                          transition-all duration-500 border border-slate-100
                          flex items-center gap-8 relative overflow-hidden">
                    <div class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center
                                text-slate-900 shrink-0 border border-slate-100
                                group-hover:bg-slate-900 group-hover:text-amber-400 transition-all duration-500">
                        <i class="fa-solid fa-plus text-2xl"></i>
                    </div>
                    <div class="relative z-10">
                        <div class="text-slate-900 font-black text-xl mb-1 tracking-tight">Armada Baru</div>
                        <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest">Register Inventaris</div>
                    </div>
                </a>

            </div>

            <div class="bg-gradient-to-br from-amber-50 to-white p-10 rounded-[3.5rem]
                        border border-amber-100 relative overflow-hidden shadow-sm">
                <div class="absolute -top-24 -right-24 w-80 h-80 bg-amber-200/20 blur-[100px] rounded-full"></div>
                <div class="relative z-10 flex gap-10 items-center">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center
                                text-amber-600 shadow-xl border border-amber-50 shrink-0 transition-transform hover:scale-110">
                        <i class="fa-solid fa-lightbulb text-3xl"></i>
                    </div>
                    <div>
                        <h4 class="text-xl font-black text-slate-900 mb-2 tracking-tight">Tips Produk</h4>
                        <p class="text-slate-500 font-medium leading-relaxed italic text-sm">
                            "Kesan pertama adalah segalanya. Pastikan foto armada Anda memiliki pencahayaan
                            profesional untuk menonjolkan kualitas unit terbaik Anda."
                        </p>
                    </div>
                </div>
            </div>

        </div>

        <div class="space-y-8">
            <h3 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Log Aktivitas</h3>

            <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Sesi Berjalan</span>
                    <span class="w-8 h-8 bg-amber-500 text-white rounded-xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <i class="fa-solid fa-bolt text-xs"></i>
                    </span>
                </div>

                <div class="p-10 space-y-10">
                    <div class="flex gap-6 relative group">
                        <div class="absolute left-6 top-12 bottom-[-40px] w-px bg-slate-100"></div>
                        <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center
                                    text-amber-400 shrink-0 relative z-10 shadow-lg border border-white/10
                                    group-hover:scale-110 transition-transform duration-500">
                            <i class="fa-solid fa-shield-check text-lg"></i>
                        </div>
                        <div class="pt-1">
                            <div class="text-sm font-black text-slate-900 mb-1">Sistem Terverifikasi</div>
                            <div class="text-[9px] font-black text-amber-500 uppercase tracking-widest italic">Active Session</div>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-50">
                        <p class="text-[10px] font-black text-slate-400 text-center uppercase tracking-[0.2em] italic">
                            Monitoring Selesai
                        </p>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


{{-- ── CHARTS SECTION ──────────────────────────────────────────────── --}}
<div class="space-y-10 mt-10 animate-fade-in" style="animation-delay: 300ms">

    {{-- Section Header --}}
    <div class="flex items-center gap-4">
        <div class="w-1.5 h-8 bg-amber-500 rounded-full"></div>
        <h3 class="text-2xl font-black text-slate-900 tracking-tight uppercase">Analitik Bisnis</h3>
    </div>

    {{-- Row 1: Monthly Transactions + Service Distribution --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Line Chart: Transaksi Bulanan --}}
        <div class="lg:col-span-2 bg-white rounded-[3rem] shadow-sm border border-slate-100 p-10 relative overflow-hidden group hover:shadow-xl transition-shadow">
            <div class="absolute -top-20 -right-20 w-64 h-64 bg-amber-400/5 blur-[80px] rounded-full
                        group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Performance</div>
                        <h4 class="text-xl font-black text-slate-900 tracking-tight uppercase">Transaksi Bulanan</h4>
                    </div>
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-amber-400 shadow-xl border border-white/5">
                        <i class="fa-solid fa-chart-area"></i>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="chartMonthly"></canvas>
                </div>
            </div>
        </div>

        {{-- Doughnut Chart: Distribusi Layanan --}}
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-10 relative overflow-hidden group hover:shadow-xl transition-shadow">
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-blue-400/5 blur-[80px] rounded-full
                        group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="relative z-10 h-full flex flex-col">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Portfolio</div>
                        <h4 class="text-xl font-black text-slate-900 tracking-tight uppercase">Tipe Layanan</h4>
                    </div>
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-amber-400 shadow-xl border border-white/5">
                        <i class="fa-solid fa-chart-pie"></i>
                    </div>
                </div>
                <div class="flex-1 flex items-center justify-center">
                    <div class="w-52 h-52">
                        <canvas id="chartService"></canvas>
                    </div>
                </div>
                {{-- Legend --}}
                <div id="serviceLegend" class="mt-6 space-y-2"></div>
            </div>
        </div>

    </div>

    {{-- Row 2: Daily Revenue (30 days) + Status Distribution --}}
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

        {{-- Bar Chart: Pendapatan Harian --}}
        <div class="lg:col-span-2 bg-white rounded-[3rem] shadow-sm border border-slate-100 p-10 relative overflow-hidden group hover:shadow-xl transition-shadow">
            <div class="absolute -bottom-20 -left-20 w-64 h-64 bg-emerald-500/5 blur-[80px] rounded-full
                        group-hover:scale-150 transition-transform duration-1000"></div>
            <div class="relative z-10">
                <div class="flex items-center justify-between mb-8">
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">30 Days Revenue</div>
                        <h4 class="text-xl font-black text-slate-900 tracking-tight uppercase">Pendapatan Harian</h4>
                    </div>
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-amber-400 shadow-xl border border-white/5">
                        <i class="fa-solid fa-money-bill-trend-up"></i>
                    </div>
                </div>
                <div class="h-64">
                    <canvas id="chartRevenue"></canvas>
                </div>
            </div>
        </div>

        {{-- Stat Cards: Status Transaksi --}}
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 p-10 hover:shadow-xl transition-shadow">
            <div class="mb-8">
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Report</div>
                <h4 class="text-xl font-black text-slate-900 tracking-tight uppercase">Status Transaksi</h4>
            </div>
            <div class="space-y-6">
                @php
                    $statusConfig = [
                        'pending'   => ['label' => 'Menunggu',     'bg' => 'bg-amber-100',  'text' => 'text-amber-700',  'bar' => 'bg-amber-400',  'icon' => 'fa-clock'],
                        'confirmed' => ['label' => 'Dikonfirmasi', 'bg' => 'bg-blue-100',   'text' => 'text-blue-700',   'bar' => 'bg-blue-400',   'icon' => 'fa-circle-check'],
                        'completed' => ['label' => 'Selesai',      'bg' => 'bg-emerald-100', 'text' => 'text-emerald-700', 'bar' => 'bg-emerald-500', 'icon' => 'fa-circle-check'],
                        'cancelled' => ['label' => 'Dibatalkan',   'bg' => 'bg-red-100',    'text' => 'text-red-700',    'bar' => 'bg-red-400',    'icon' => 'fa-circle-xmark'],
                    ];
                    $totalAll = $totalTransactions ?: 1;
                @endphp
                @foreach ($statusConfig as $status => $cfg)
                    @php $count = $statusCounts[$status] ?? 0; @endphp
                    <div class="flex items-center gap-4 group/status">
                        <div class="w-10 h-10 {{ $cfg['bg'] }} {{ $cfg['text'] }} rounded-xl flex items-center justify-center shrink-0 shadow-sm transition-transform group-hover/status:scale-110">
                            <i class="fa-solid {{ $cfg['icon'] }}"></i>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between mb-1.5">
                                <span class="text-[11px] font-black text-slate-800 uppercase tracking-tight">{{ $cfg['label'] }}</span>
                                <span class="text-[11px] font-black {{ $cfg['text'] }}">{{ $count }} <span class="text-[10px] text-slate-400">Trx</span></span>
                            </div>
                            <div class="h-1.5 bg-slate-50 rounded-full overflow-hidden border border-slate-100">
                                <div class="h-full {{ $cfg['bar'] }} rounded-full transition-all duration-1000 shadow-sm"
                                     style="width: {{ round($count / $totalAll * 100) }}%"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="mt-8 pt-6 border-t border-slate-50 text-center">
                <a href="{{ route('admin.transactions.index') }}"
                   class="inline-flex items-center gap-2 text-[10px] font-black text-[#D4AF37] uppercase tracking-widest italic
                          hover:text-amber-700 transition-colors">
                    Dashboard Monitoring Penuh
                    <i class="fa-solid fa-arrow-right-long ml-1"></i>
                </a>
            </div>
        </div>

    </div>

</div>


{{-- ── SCRIPTS ──────────────────────────────────────────────────────── --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.4/dist/chart.umd.min.js"></script>
<script>
(function () {
    'use strict';

    // ── Shared config ────────────────────────────────────────────
    Chart.defaults.font.family = "'Outfit', 'Inter', sans-serif";
    Chart.defaults.color       = '#94a3b8';

    const amber = '#D4AF37';
    const slate = '#1E293B';

    // ── Chart 1: Transaksi Bulanan ───────────────────────────────
    const monthlyLabels = @json($monthlyLabels);
    const monthlyData   = @json($monthlyData);

    new Chart(document.getElementById('chartMonthly'), {
        type: 'line',
        data: {
            labels: monthlyLabels,
            datasets: [{
                label: 'Transaksi',
                data: monthlyData,
                borderColor: amber,
                backgroundColor: 'rgba(212,175,55,0.08)',
                borderWidth: 4,
                pointBackgroundColor: '#fff',
                pointBorderColor: amber,
                pointBorderWidth: 3,
                pointRadius: 6,
                pointHoverRadius: 8,
                pointHoverBorderWidth: 4,
                fill: true,
                tension: 0.45,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { intersect: false, mode: 'index' },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: slate,
                    titleColor: '#fff',
                    bodyColor: '#D4AF37',
                    titleFont: { size: 12, weight: '900' },
                    bodyFont: { size: 12, weight: 'bold' },
                    cornerRadius: 12,
                    padding: 16,
                    displayColors: false,
                    callbacks: {
                        label: ctx => ' ' + ctx.parsed.y + ' Transaksi Berhasil'
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { maxRotation: 30, font: { size: 10, weight: 'bold' }, color: '#64748b' }
                },
                y: {
                    beginAtZero: true,
                    ticks: { precision: 0, font: { size: 11, weight: '600' }, color: '#64748b' },
                    grid: { color: 'rgba(148,163,184,0.06)', drawBorder: false }
                }
            }
        }
    });

    // ── Chart 2: Distribusi Tipe Layanan ────────────────────────
    const serviceLabels = @json($serviceLabels);
    const serviceValues = @json($serviceValues);

    const serviceColors  = ['#D4AF37', '#334155', '#475569', '#64748b'];
    const serviceDark    = ['#B8860B', '#0F172A', '#1E293B', '#334155'];

    new Chart(document.getElementById('chartService'), {
        type: 'doughnut',
        data: {
            labels: serviceLabels,
            datasets: [{
                data: serviceValues,
                backgroundColor: serviceColors.slice(0, serviceLabels.length),
                hoverBackgroundColor: serviceDark.slice(0, serviceLabels.length),
                borderWidth: 8,
                borderColor: '#ffffff',
                hoverOffset: 15,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '78%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: slate,
                    titleColor: '#fff',
                    bodyColor: '#D4AF37',
                    cornerRadius: 12,
                    padding: 16,
                    displayColors: false,
                    callbacks: {
                        label: ctx => ' ' + ctx.label + ': ' + ctx.parsed + ' Unit Tersewa'
                    }
                }
            }
        }
    });

    // Build custom legend
    const legendEl = document.getElementById('serviceLegend');
    if (legendEl && serviceLabels.length) {
        serviceLabels.forEach((lbl, i) => {
            legendEl.innerHTML += `
                <div class="flex items-center justify-between group/leg">
                    <div class="flex items-center gap-3">
                        <span class="w-3 h-3 rounded-full shrink-0 shadow-sm" style="background:${serviceColors[i]}"></span>
                        <span class="text-[11px] font-black text-slate-500 uppercase tracking-tight group-hover/leg:text-slate-900 transition-colors">${lbl}</span>
                    </div>
                    <span class="text-[11px] font-black text-slate-900 italic">${serviceValues[i]} Unit</span>
                </div>`;
        });
    } else if (legendEl) {
        legendEl.innerHTML = '<p class="text-xs text-slate-400 text-center italic">Monitor data inventaris...</p>';
    }

    // ── Chart 3: Pendapatan Harian 30 Hari ──────────────────────
    const revenueLabels = @json($revenueLabels);
    const revenueData   = @json($revenueData);

    // Show only every 5th label for readability
    const revDisplayLabels = revenueLabels.map((l, i) => i % 5 === 0 ? l : '');

    new Chart(document.getElementById('chartRevenue'), {
        type: 'bar',
        data: {
            labels: revenueLabels,
            datasets: [{
                label: 'Revenue',
                data: revenueData,
                backgroundColor: (ctx) => {
                    const val = ctx.raw || 0;
                    return val > 0 ? amber : 'rgba(148,163,184,0.15)';
                },
                hoverBackgroundColor: '#B8860B',
                borderRadius: 8,
                borderSkipped: false,
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: slate,
                    titleColor: '#fff',
                    bodyColor: '#D4AF37',
                    cornerRadius: 12,
                    padding: 16,
                    displayColors: false,
                    callbacks: {
                        title: (items) => 'Tanggal Ops: ' + items[0].label,
                        label: ctx => ' Rp ' + ctx.parsed.y.toLocaleString('id-ID')
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: {
                        font: { size: 9, weight: 'bold' },
                        color: '#64748b',
                        callback: (val, i) => revDisplayLabels[i] || '',
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: { color: 'rgba(148,163,184,0.06)', drawBorder: false },
                    ticks: {
                        font: { size: 10, weight: '600' },
                        color: '#64748b',
                        callback: val => val >= 1_000_000
                            ? 'Rp ' + (val / 1_000_000).toFixed(1) + 'jt'
                            : val >= 1_000 ? 'Rp ' + (val / 1_000).toFixed(0) + 'rb' : 'Rp ' + val
                    }
                }
            }
        }
    });

})();
</script>


{{-- ── STYLES ──────────────────────────────────────────────────────── --}}
<style>
    @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap');

    .gold-gradient-text {
        background: linear-gradient(135deg, #B8860B 0%, #D4AF37 50%, #FFD700 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .shadow-3xl { box-shadow: 0 40px 80px -15px rgba(0, 0, 0, 0.4); }
    .shadow-4xl { box-shadow: 0 50px 100px -20px rgba(184, 134, 11, 0.18); }

    .tabular-nums { font-variant-numeric: tabular-nums; }

    @keyframes fade-in {
        from { opacity: 0; transform: translateY(30px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    .animate-fade-in {
        animation: fade-in 1s cubic-bezier(0, 0, 0.2, 1) both;
    }

    /* Custom Chart Tooltip Styling via global CSS if needed, but Chart.js handled it */
</style>

@endsection
