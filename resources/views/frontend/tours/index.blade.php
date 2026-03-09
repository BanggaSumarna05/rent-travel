@extends('layouts.frontend')

@section('title', 'Paket Wisata Eksklusif - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-white overflow-hidden">
        <div
            class="absolute top-0 right-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -mr-48 -mt-48 animate-pulse">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'Paket Wisata']]" />
            <div data-aos="fade-down" class="text-center">
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 font-heading tracking-tighter leading-[1]">
                    Perjalanan <span class="gold-gradient-text">Eksklusif</span>
                </h1>
                <p class="text-lg text-slate-400 max-w-3xl mx-auto leading-relaxed font-medium">
                    Dunia yang dikurasi khusus untuk Anda. Temukan destinasi luar biasa dengan pengalaman perjalanan standar
                    emas kami.
                </p>
            </div>
        </div>
    </section>

    <!-- Catalog Grid -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($tours as $tour)
                    <div class="group bg-white rounded-[3rem] overflow-hidden shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.15)] transition-all duration-700 border border-slate-100 flex flex-col h-full transform hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="relative h-[22rem] overflow-hidden shrink-0">
                            <img src="{{ $tour->primary_image_url }}" alt="{{ $tour->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/10 to-transparent">
                            </div>
                            <div class="absolute bottom-8 left-8 right-8">
                                <div
                                    class="flex items-center gap-2 text-[#D4AF37] text-[9px] font-black uppercase tracking-[0.4em] mb-3">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                            d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                        </path>
                                    </svg>
                                    Standar Emas
                                </div>
                                <h2
                                    class="text-3xl font-black text-white font-heading tracking-tighter leading-none hover:text-[#D4AF37] transition-colors cursor-pointer">
                                    <a href="{{ route('tours.show', $tour) }}">{{ $tour->name }}</a>
                                </h2>
                            </div>
                        </div>

                        <div class="p-8 flex flex-col flex-1">
                            <div class="flex items-center gap-6 mb-8">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-amber-50 group-hover:bg-amber-100 transition-all flex items-center justify-center text-[#D4AF37]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                    </div>
                                    <span
                                        class="text-[9px] font-black text-slate-500 uppercase tracking-widest">{{ $tour->duration }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-amber-50 group-hover:bg-amber-100 transition-all flex items-center justify-center text-[#D4AF37]">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                    </div>
                                    <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Layanan
                                        Lengkap</span>
                                </div>
                            </div>

                            <p class="text-slate-500 text-[13px] leading-relaxed mb-10 line-clamp-3 font-medium italic">
                                {{ $tour->description }}
                            </p>

                            <div class="mt-auto pt-8 border-t border-slate-100 flex items-center justify-between gap-4">
                                <div class="shrink-0">
                                    <div
                                        class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mb-1 font-heading">
                                        Mulai Dari</div>
                                    <div class="text-xl font-black text-slate-900 tracking-tighter">
                                        Rp {{ number_format($tour->price, 0, ',', '.') }}
                                    </div>
                                </div>
                                <div class="flex items-center gap-2 flex-1 justify-end">
                                    <a href="{{ route('tours.show', $tour) }}"
                                        class="px-6 py-4 bg-slate-100 text-slate-900 rounded-xl font-black text-[10px] tracking-widest uppercase hover:bg-slate-900 hover:text-white transition-all duration-500">
                                        Detail
                                    </a>
                                    <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Halo, saya ingin reservasi paket {{ $tour->name }}"
                                        class="w-12 h-12 bg-slate-900 text-[#D4AF37] rounded-xl flex items-center justify-center hover:bg-[#D4AF37] hover:text-white transition-all duration-500 shadow-xl shadow-slate-950/10 shrink-0">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z">
                                            </path>
                                        </svg>
                                    </a>
                                </div>
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
                        <h3 class="text-4xl font-black text-slate-900 mb-6 font-heading tracking-tight">Mengkurasi
                            Pengalaman</h3>
                        <p class="text-slate-400 font-medium text-lg">Perjalanan luar biasa baru sedang disiapkan untuk
                            Anda. Tetap pantau untuk peluncurannya.</p>
                    </div>
                @endforelse
            </div>

            @if ($tours->hasPages())
                <div class="mt-32 flex justify-center">
                    {{ $tours->links() }}
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
