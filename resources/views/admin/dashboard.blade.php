@extends('layouts.admin')

@section('title', 'Dashboard Sistem')

@section('content')
    <div class="space-y-10 animate-fade-in">
        <!-- Luxury Welcome Header -->
        <div
            class="relative overflow-hidden bg-gradient-to-br from-slate-900 via-slate-900 to-black rounded-[2.5rem] lg:rounded-[3.5rem] p-8 lg:p-14 text-white shadow-3xl border border-white/5 group">
            <!-- Dynamic Background Accents -->
            <div
                class="absolute top-0 right-0 -mt-24 -mr-24 w-[500px] h-[500px] bg-amber-500/10 blur-[120px] rounded-full group-hover:scale-110 transition-transform duration-1000">
            </div>
            <div class="absolute bottom-0 left-0 -mb-24 -ml-24 w-[400px] h-[400px] bg-slate-500/10 blur-[120px] rounded-full group-hover:scale-110 transition-transform duration-1000"
                style="transition-delay: 200ms"></div>

            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-10">
                <div class="max-w-2xl">
                    <div class="flex items-center gap-4 mb-6" data-aos="fade-right">
                        <div class="px-4 py-1.5 bg-amber-500/20 border border-amber-500/20 rounded-full">
                            <span class="text-[10px] font-black uppercase tracking-[0.2em] text-amber-500">Luxury Concierge
                                System</span>
                        </div>
                        <span class="text-xs font-bold text-slate-500 italic">Online & Secure</span>
                    </div>

                    <h2 class="text-4xl lg:text-6xl font-black mb-6 tracking-tighter leading-[0.9]" data-aos="fade-up">
                        Selamat datang, <br>
                        <span class="gold-gradient-text">{{ explode(' ', auth()->user()->name)[0] }}!</span>
                    </h2>

                    <p class="text-slate-400 text-lg font-medium leading-relaxed max-w-xl mb-10" data-aos="fade-up"
                        data-aos-delay="100">
                        Sistem berjalan dengan optimal. Kelola armada eksklusif dan tinjau performa bisnis Anda hari ini
                        dengan presisi.
                    </p>

                    <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="200">
                        <a href="{{ route('admin.cars.create') }}"
                            class="inline-flex items-center justify-center px-10 py-5 bg-white text-slate-900 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-amber-500 hover:text-white transition-all duration-500 shadow-xl shadow-black/20 hover:-translate-y-1">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Tambah Mobil
                        </a>
                        <a href="{{ route('admin.settings.index') }}"
                            class="inline-flex items-center justify-center px-10 py-5 bg-slate-800/40 backdrop-blur-xl text-white border border-white/10 rounded-2xl font-black text-sm uppercase tracking-widest hover:bg-slate-800 hover:border-amber-500/50 transition-all duration-500">
                            <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                            </svg>
                            Konfigurasi
                        </a>
                    </div>
                </div>

                <!-- Enhanced Clock Widget -->
                <div class="hidden lg:block" data-aos="zoom-in" data-aos-delay="300">
                    <div
                        class="w-64 h-64 bg-white/5 backdrop-blur-2xl rounded-[3rem] border border-white/10 p-10 shadow-3xl relative overflow-hidden group/clock">
                        <div
                            class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600 transform scale-x-0 group-hover/clock:scale-x-100 transition-transform duration-1000">
                        </div>

                        <div class="relative z-10 h-full flex flex-col justify-center text-center">
                            <div class="text-[10px] font-black text-amber-500 uppercase tracking-[0.4em] mb-4">Real Time
                                Status</div>
                            <div class="text-5xl font-black text-white mb-2 tracking-tighter tabular-nums">
                                @php
                                    \Carbon\Carbon::setLocale('id');
                                    $now = \Carbon\Carbon::now('Asia/Jakarta');
                                @endphp
                                {{ $now->format('H:i') }}
                            </div>
                            <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest leading-relaxed">
                                {{ $now->isoFormat('dddd') }} <br> {{ $now->isoFormat('D MMMM Y') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Gold Themed Statistics -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
            @php
                $stats = [
                    [
                        'label' => 'Total Mobil',
                        'count' => $totalCars,
                        'icon' => 'car',
                        'color' => 'amber',
                    ],
                    [
                        'label' => 'Total Motor',
                        'count' => $totalMotorcycles,
                        'icon' => 'moto',
                        'color' => 'slate',
                    ],
                    [
                        'label' => 'Paket Wisata',
                        'count' => $totalTours,
                        'icon' => 'tour',
                        'color' => 'amber',
                    ],
                    [
                        'label' => 'Total Transaksi',
                        'count' => $totalTransactions,
                        'icon' => 'receipt',
                        'color' => 'slate',
                    ],
                    [
                        'label' => 'Booking Pending',
                        'count' => $pendingTransactions,
                        'icon' => 'clock',
                        'color' => 'amber',
                    ],
                    [
                        'label' => 'Total Pendapatan',
                        'count' => 'Rp ' . number_format($totalRevenue, 0, ',', '.'),
                        'icon' => 'wallet',
                        'color' => 'slate',
                        'is_price' => true,
                    ],
                ];
            @endphp

            @foreach ($stats as $stat)
                <div class="group relative bg-white p-10 rounded-[3rem] shadow-sm border border-slate-100 hover:shadow-4xl transition-all duration-500 overflow-hidden"
                    data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                    <div
                        class="absolute top-0 right-0 w-32 h-32 bg-slate-50 rounded-full -mr-16 -mt-16 group-hover:scale-150 transition-transform duration-700">
                    </div>

                    <div class="relative z-10">
                        <div
                            class="w-16 h-16 bg-slate-900 rounded-2xl flex items-center justify-center text-amber-400 mb-10 group-hover:bg-amber-500 group-hover:text-white transition-all duration-500 shadow-xl shadow-amber-950/20">
                            @if ($stat['icon'] == 'car')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 12h13l3-6H3zM8 18a2 2 0 100-4 2 2 0 000 4zM16 18a2 2 0 100-4 2 2 0 000 4z" />
                                </svg>
                            @elseif($stat['icon'] == 'moto')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <circle cx="6" cy="19" r="3" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                    <circle cx="18" cy="19" r="3" stroke="currentColor" stroke-width="2"
                                        fill="none" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M10 19h4l2-8 3-2" />
                                </svg>
                            @elseif($stat['icon'] == 'tour')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @elseif($stat['icon'] == 'receipt')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01" />
                                </svg>
                            @elseif($stat['icon'] == 'clock')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            @elseif($stat['icon'] == 'wallet')
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                                </svg>
                            @else
                                <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z" />
                                </svg>
                            @endif
                        </div>

                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">
                            {{ $stat['label'] }}</div>
                        <div
                            class="font-black text-slate-900 tracking-tighter tabular-nums mb-6 group-hover:scale-105 transition-transform origin-left {{ isset($stat['is_price']) ? 'text-3xl' : 'text-5xl' }}">
                            {{ $stat['count'] }}</div>

                        <div class="flex items-center gap-2 px-4 py-2 bg-slate-50 rounded-xl w-fit">
                            <span class="relative flex h-2 w-2">
                                <span
                                    class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                                <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                            </span>
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Active Live
                                Data</span>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Quick Actions & Activity Log -->
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
            <!-- Main Actions -->
            <div class="lg:col-span-2 space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-1.5 h-8 bg-amber-500 rounded-full"></div>
                    <h3 class="text-2xl font-black text-slate-900 tracking-tight">Perintah Utama</h3>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <a href="{{ route('admin.transactions.index') }}"
                        class="group bg-slate-900 p-10 rounded-[3rem] shadow-xl hover:shadow-4xl transition-all duration-500 flex items-center gap-8 relative overflow-hidden">
                        <div
                            class="absolute top-0 right-0 w-32 h-32 bg-amber-500/10 blur-[40px] rounded-full group-hover:scale-150 transition-transform duration-1000">
                        </div>

                        <div
                            class="w-16 h-16 bg-white/10 backdrop-blur-xl rounded-2xl flex items-center justify-center text-amber-400 border border-white/10 group-hover:rotate-12 transition-all duration-500 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div class="text-white font-black text-xl mb-1 tracking-tight">Lihat Transaksi</div>
                            <div class="text-amber-500/60 text-[10px] font-black uppercase tracking-widest leading-none">
                                Monitoring Booking</div>
                        </div>
                    </a>

                    <a href="{{ route('admin.cars.create') }}"
                        class="group bg-white p-10 rounded-[3rem] shadow-sm hover:shadow-4xl transition-all duration-500 border border-slate-100 flex items-center gap-8 relative overflow-hidden">
                        <div
                            class="w-16 h-16 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-900 group-hover:bg-slate-900 group-hover:text-amber-400 transition-all duration-500 shrink-0">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                        </div>

                        <div class="relative z-10">
                            <div class="text-slate-900 font-black text-xl mb-1 tracking-tight">Armada Baru</div>
                            <div class="text-slate-400 text-[10px] font-black uppercase tracking-widest leading-none">
                                Register Inventaris</div>
                        </div>
                    </a>
                </div>

                <!-- Promotion / Tip Card -->
                <div
                    class="bg-gradient-to-br from-amber-50 to-white p-10 rounded-[3.5rem] border border-amber-100 relative overflow-hidden">
                    <div class="absolute -top-24 -right-24 w-80 h-80 bg-amber-200/20 blur-[100px] rounded-full"></div>

                    <div class="relative z-10 flex gap-10 items-center">
                        <div
                            class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center text-amber-600 shadow-xl border border-amber-50 shrink-0">
                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div>
                            <h4 class="text-xl font-black text-slate-900 mb-3 tracking-tight">Luxury Insight</h4>
                            <p class="text-slate-500 font-medium leading-relaxed italic">
                                "Kesan pertama adalah segalanya. Pastikan foto armada Anda memiliki pencahayaan profesional
                                untuk menonjolkan detail premium."
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Activity Timeline -->
            <div class="space-y-8">
                <h3 class="text-2xl font-black text-slate-900 tracking-tight">Log Aktivitas</h3>

                <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
                    <div class="px-10 py-8 border-b border-slate-50 flex justify-between items-center bg-slate-50/50">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Real-time
                            Events</span>
                        <span class="p-2 bg-amber-100 text-amber-600 rounded-xl">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </span>
                    </div>

                    <div class="p-10 space-y-10">
                        <div class="flex gap-6 relative group">
                            <div class="absolute left-6 top-12 bottom-[-40px] w-px bg-slate-100"></div>
                            <div
                                class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center text-amber-400 shrink-0 relative z-10 shadow-lg border border-white/10 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M5 13l4 4L19 7" />
                                </svg>
                            </div>
                            <div class="pt-1">
                                <div class="text-sm font-black text-slate-900 mb-1">Sistem Terverifikasi</div>
                                <div class="text-[9px] font-black text-amber-500 uppercase tracking-widest">Active Session
                                </div>
                            </div>
                        </div>

                        <div class="pt-6 border-t border-slate-50">
                            <p class="text-[10px] font-black text-slate-400 text-center uppercase tracking-[0.2em]">
                                Synchronized Complete</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <style>
        .gold-gradient-text {
            background: linear-gradient(135deg, #B8860B 0%, #D4AF37 50%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        .shadow-4xl {
            box-shadow: 0 50px 100px -20px rgba(184, 134, 11, 0.15);
        }

        .shadow-3xl {
            box-shadow: 0 40px 80px -15px rgba(0, 0, 0, 0.3);
        }

        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s cubic-bezier(0, 0, 0.2, 1);
        }

        .tabular-nums {
            font-variant-numeric: tabular-nums;
        }
    </style>
@endsection
