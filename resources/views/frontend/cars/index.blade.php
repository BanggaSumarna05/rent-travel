@extends('layouts.frontend')

@section('title', 'Pilihan Mobil - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-white overflow-hidden">
        <div
            class="absolute top-0 right-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -mr-48 -mt-48 animate-pulse">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'Katalog Mobil']]" />
            <div data-aos="fade-down" class="text-center">
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 font-heading tracking-tighter leading-[1]">
                    Armada <span class="gold-gradient-text">Utama</span>
                </h1>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium">
                    Rasakan keunggulan tanpa syarat. Pilihan kendaraan premium kami dikurasi khusus untuk Anda yang
                    menguasai jalanan.
                </p>
            </div>
        </div>
    </section>

    <!-- Filter & Search -->
    <section
        class="py-8 bg-white/80 backdrop-blur-xl border-y border-amber-500/10 sticky top-[72px] lg:top-[96px] z-40 shadow-[0_2px_15px_rgba(0,0,0,0.02)]">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-4 overflow-x-auto pb-4 md:pb-0 w-full md:w-auto no-scrollbar">
                    <button
                        class="px-6 py-2.5 bg-slate-900 text-[#D4AF37] rounded-xl font-black text-[10px] uppercase tracking-widest shadow-lg shadow-slate-950/20 whitespace-nowrap">
                        Semua Koleksi
                    </button>
                    <button
                        class="px-6 py-2.5 bg-slate-50 text-slate-500 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#D4AF37] hover:text-white transition-all whitespace-nowrap">
                        Otomatis
                    </button>
                    <button
                        class="px-6 py-2.5 bg-slate-50 text-slate-500 rounded-xl font-black text-[10px] uppercase tracking-widest hover:bg-[#D4AF37] hover:text-white transition-all whitespace-nowrap">
                        Manual
                    </button>
                </div>
                <div class="relative w-full md:w-[350px]">
                    <input type="text" placeholder="Cari koleksi armada..."
                        class="w-full pl-12 pr-6 py-3 bg-slate-50 border border-transparent rounded-2xl focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all font-bold text-xs tracking-tight">
                    <svg class="w-5 h-5 text-[#D4AF37] absolute left-4 top-1/2 -translate-y-1/2" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                    </svg>
                </div>
            </div>
        </div>
    </section>

    <!-- Catalog Grid -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($cars as $car)
                    <div class="group bg-white rounded-[3rem] overflow-hidden shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.15)] transition-all duration-700 border border-slate-100 flex flex-col h-full transform hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="relative h-64 overflow-hidden shrink-0">
                            <img src="{{ $car->getFirstMediaUrl('cars') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=800' }}"
                                alt="{{ $car->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-6 left-6">
                                @if ($car->is_featured)
                                    <span
                                        class="px-4 py-2 bg-[#D4AF37] text-white rounded-xl text-[9px] font-black uppercase tracking-[0.3em] shadow-lg">
                                        Pilihan Elit
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="p-8 flex flex-col flex-1">
                            <div class="flex justify-between items-start mb-8">
                                <div>
                                    <h2
                                        class="text-2xl font-black text-slate-900 font-heading tracking-tighter leading-[1] mb-2">
                                        <a href="{{ route('cars.show', $car) }}"
                                            class="hover:text-[#D4AF37] transition-colors">{{ $car->name }}</a>
                                    </h2>
                                    <div class="flex items-center gap-2">
                                        <p class="text-[9px] font-black uppercase tracking-[0.4em] gold-gradient-text">
                                            {{ $car->brand }}</p>
                                        <span class="w-1 h-1 rounded-full bg-slate-200"></span>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest">
                                            {{ $car->year }}</p>
                                    </div>
                                </div>
                                <div class="text-right">
                                    <div
                                        class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 font-heading">
                                        Per Hari</div>
                                    <div class="text-xl font-black text-slate-900 tracking-tighter">
                                        Rp {{ number_format($car->price_per_day, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <div class="grid grid-cols-2 gap-4 mb-10">
                                <div
                                    class="p-4 bg-slate-50 rounded-[2rem] flex items-center gap-3 group-hover:bg-amber-50 group-hover:border-amber-100 transition-all duration-500 border border-transparent">
                                    <div
                                        class="w-8 h-8 bg-white rounded-lg shadow-sm flex items-center justify-center text-[#D4AF37]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[7px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Transmisi</span>
                                        <span
                                            class="text-[9px] font-black text-slate-500 uppercase tracking-widest leading-none">{{ $car->transmission }}</span>
                                    </div>
                                </div>
                                <div
                                    class="p-4 bg-slate-50 rounded-[2rem] flex items-center gap-3 group-hover:bg-amber-50 group-hover:border-amber-100 transition-all duration-500 border border-transparent">
                                    <div
                                        class="w-8 h-8 bg-white rounded-lg shadow-sm flex items-center justify-center text-[#D4AF37]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 18.657A8 8 0 016.343 7.343S7 9 9 10c0-2 .5-5 2.986-7C14 5 16.09 5.777 17.656 7.343A7.975 7.975 0 0120 13a7.975 7.975 0 01-2.343 5.657z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[7px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Bahan
                                            Bakar</span>
                                        <span
                                            class="text-[9px] font-black text-slate-500 uppercase tracking-widest leading-none">{{ $car->fuel_type }}</span>
                                    </div>
                                </div>
                                <div
                                    class="p-4 bg-slate-50 rounded-[2rem] flex items-center gap-3 group-hover:bg-amber-50 group-hover:border-amber-100 transition-all duration-500 border border-transparent">
                                    <div
                                        class="w-8 h-8 bg-white rounded-lg shadow-sm flex items-center justify-center text-[#D4AF37]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[7px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Kategori</span>
                                        <span
                                            class="text-[9px] font-black text-slate-500 uppercase tracking-widest leading-none">{{ str_replace('_', ' ', $car->category) }}</span>
                                    </div>
                                </div>
                                <div
                                    class="p-4 bg-slate-50 rounded-[2rem] flex items-center gap-3 group-hover:bg-amber-50 group-hover:border-amber-100 transition-all duration-500 border border-transparent">
                                    <div
                                        class="w-8 h-8 bg-white rounded-lg shadow-sm flex items-center justify-center text-[#D4AF37]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                                            </path>
                                        </svg>
                                    </div>
                                    <div class="flex flex-col">
                                        <span
                                            class="text-[7px] font-black text-slate-300 uppercase tracking-widest leading-none mb-1">Kapasitas</span>
                                        <span
                                            class="text-[9px] font-black text-slate-500 uppercase tracking-widest leading-none">{{ $car->passenger_capacity }}
                                            Kursi</span>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-auto grid grid-cols-2 gap-4">
                                <a href="{{ route('cars.show', $car) }}"
                                    class="py-4 bg-slate-100 text-slate-900 rounded-2xl font-black text-[10px] tracking-widest uppercase text-center block hover:bg-slate-900 hover:text-white transition-all active:scale-95 duration-500">
                                    Detail Unit
                                </a>
                                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Halo, saya ingin reservasi {{ $car->name }}"
                                    class="py-4 gold-btn text-white rounded-2xl font-black text-[10px] tracking-widest uppercase text-center block transition-all shadow-xl shadow-amber-900/10 active:scale-95 duration-500">
                                    Pesan Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-40 text-center" data-aos="fade-up">
                        <div
                            class="w-32 h-32 bg-slate-100 rounded-[3rem] flex items-center justify-center text-slate-300 mx-auto mb-10">
                            <svg class="w-16 h-16" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M9.172 9.172a4 4 0 015.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 mb-6 font-heading tracking-tight">Memperbarui Koleksi
                        </h3>
                        <p class="text-slate-400 font-medium text-lg">Kami sedang mengkurasi penambahan unit baru untuk
                            armada elit kami. Silakan hubungi konserge kami untuk bantuan langsung.</p>
                    </div>
                @endforelse
            </div>

            @if ($cars->hasPages())
                <div class="mt-32 flex justify-center">
                    {{ $cars->links() }}
                </div>
            @endif
        </div>
    </section>

    <style>
        .shadow-3xl {
            box-shadow: 0 30px 80px -15px rgba(15, 23, 42, 0.1);
        }

        .shadow-3xl:hover {
            box-shadow: 0 40px 100px -20px rgba(212, 175, 55, 0.15);
        }
    </style>
@endsection
