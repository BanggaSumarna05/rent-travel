@extends('layouts.frontend')

@section('title', 'Pilihan Motor - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-white overflow-hidden">
        <div
            class="absolute top-0 right-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -mr-48 -mt-48 animate-pulse">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'Katalog Motor']]" />
            <div data-aos="fade-down" class="text-center">
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 font-heading tracking-tighter leading-[1]">
                    Kebebasan <span class="gold-gradient-text">Murni</span>
                </h1>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium">
                    Lepaskan semangat petualang Anda di jalanan. Jelajahi koleksi kendaraan roda dua premium kami, dirawat
                    dengan standar emas tertinggi.
                </p>
            </div>
        </div>
    </section>

    <!-- Catalog Grid -->
    <section class="py-24 bg-slate-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-12">
                @forelse($motorcycles as $motor)
                    <div class="group bg-white rounded-[3rem] overflow-hidden shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.15)] transition-all duration-700 border border-slate-100 flex flex-col h-full transform hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="relative h-64 overflow-hidden shrink-0">
                            <img src="{{ $motor->getFirstMediaUrl('motorcycles') ?: 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&q=80&w=800' }}"
                                alt="{{ $motor->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000">
                            <div class="absolute top-6 right-6">
                                <span
                                    class="px-4 py-2 bg-slate-900/80 backdrop-blur-xl rounded-xl text-[9px] font-black text-[#D4AF37] shadow-2xl uppercase tracking-[0.3em] border border-[#D4AF37]/30">
                                    {{ $motor->brand }}
                                </span>
                            </div>
                        </div>

                        <div class="p-8 flex flex-col flex-1">
                            <div class="flex justify-between items-start mb-8">
                                <div>
                                    <h2
                                        class="text-2xl font-black text-slate-900 font-heading tracking-tighter leading-[1] mb-2">
                                        <a href="{{ route('motorcycles.show', $motor) }}"
                                            class="hover:text-[#D4AF37] transition-colors">{{ $motor->name }}</a>
                                    </h2>
                                    <p class="text-[9px] font-black uppercase tracking-[0.4em] gold-gradient-text">Armada
                                        Elit</p>
                                </div>
                                <div class="text-right">
                                    <div
                                        class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 font-heading">
                                        Per Hari</div>
                                    <div class="text-xl font-black text-slate-900 tracking-tighter">
                                        Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}
                                    </div>
                                </div>
                            </div>

                            <div
                                class="p-6 bg-slate-50 rounded-[2rem] mb-6 group-hover:bg-amber-50 group-hover:border-amber-100 transition-all duration-500 border border-transparent flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-[#D4AF37]">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">
                                        Performa Mesin</div>
                                    <div class="text-base font-black text-slate-900 tracking-tight">
                                        {{ $motor->engine_capacity }}cc Masterpiece</div>
                                </div>
                            </div>

                            <div class="mb-10 line-clamp-2 text-xs text-slate-400 font-medium italic leading-relaxed">
                                {{ $motor->description ?: 'Pengalaman berkendara premium dengan performa mesin terbaik di kelasnya.' }}
                            </div>

                            <div class="mt-auto grid grid-cols-2 gap-4">
                                <a href="{{ route('motorcycles.show', $motor) }}"
                                    class="py-4 bg-slate-100 text-slate-900 rounded-2xl font-black text-[10px] tracking-widest uppercase text-center block hover:bg-slate-900 hover:text-white transition-all active:scale-95 duration-500">
                                    Detail Unit
                                </a>
                                <a href="https://wa.me/{{ \App\Models\Setting::get('whatsapp_number') }}?text=Halo, saya ingin sewa motor {{ $motor->name }}"
                                    class="py-4 gold-btn text-white rounded-2xl font-black text-[10px] tracking-widest uppercase text-center block transition-all shadow-xl shadow-amber-950/10 active:scale-95 duration-500">
                                    Sewa Sekarang
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
                        <h3 class="text-4xl font-black text-slate-900 mb-6 font-heading tracking-tight">Pemeliharaan Armada
                        </h3>
                        <p class="text-slate-400 font-medium text-lg">Motor elit kami saat ini sedang menjalani perawatan
                            standar emas. Silakan periksa kembali nanti untuk perjalanan terbaik Anda.</p>
                    </div>
                @endforelse
            </div>

            @if ($motorcycles->hasPages())
                <div class="mt-32 flex justify-center">
                    {{ $motorcycles->links() }}
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
