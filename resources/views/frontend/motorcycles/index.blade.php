@extends('layouts.frontend')

@section('title', 'Sewa Motor Tasikmalaya - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'Sewa Motor']]"
        badge="Sewa Motor Tasikmalaya"
        title="Pilihan Motor"
        highlight="Siap Jalan"
        description="Cari sewa motor Tasikmalaya untuk kebutuhan harian, antar lokasi, atau mobilitas singkat? Pilih unit matic terawat dengan harga yang jelas dan proses booking cepat."
    />

    <!-- Catalog Grid -->
    <section class="page-section-large page-section-muted">
        <div class="page-shell">
            <div class="page-grid-3">
                @forelse($motorcycles as $motor)
                    <div class="group bg-white rounded-[3rem] overflow-hidden shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.15)] transition-all duration-700 border border-slate-100 flex flex-col h-full transform hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="relative h-64 overflow-hidden shrink-0">
                            <img src="{{ $motor->getFirstMediaUrl('motorcycles') ?: 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&q=80&w=800' }}"
                                alt="{{ $motor->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" loading="lazy">
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
                                    <p class="text-[9px] font-black uppercase tracking-[0.4em] gold-gradient-text">Andalan</p>
                                </div>
                                <div class="text-right shrink-0">
                                    <div
                                        class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1 font-heading">
                                        Mulai</div>
                                    <div class="text-xl font-black text-slate-900 tracking-tighter">
                                        Rp {{ number_format($motor->price_per_day, 0, ',', '.') }}<span class="text-[10px] text-slate-400">/hr</span>
                                    </div>
                                    @if($motor->price_per_month)
                                        <div class="text-[10px] font-black text-amber-600 tracking-tight mt-0.5 whitespace-nowrap">
                                            Rp {{ number_format($motor->price_per_month, 0, ',', '.') }}<span class="text-[8px] text-slate-400 italic">/bln</span>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div
                                class="p-6 bg-slate-50 rounded-[2rem] mb-6 group-hover:bg-amber-50 group-hover:border-amber-100 transition-all duration-500 border border-transparent flex items-center gap-4">
                                <div
                                    class="w-10 h-10 bg-white rounded-xl shadow-sm flex items-center justify-center text-[#D4AF37]">
                                    <i class="fa-solid fa-bolt text-lg"></i>
                                </div>
                                <div>
                                    <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-0.5">
                                        Performa Mesin</div>
                                    <div class="text-base font-black text-slate-900 tracking-tight">
                                        {{ $motor->engine_capacity }}cc </div>
                                </div>
                            </div>

                            <div class="mb-10 line-clamp-2 text-xs text-slate-400 font-medium italic leading-relaxed">
                                {{ $motor->description ?: 'Motor matic terawat, irit bensin, dan nyaman dipakai untuk mobilitas harian di Tasikmalaya.' }}
                            </div>

                            <div class="mt-auto grid grid-cols-2 gap-4">
                                <a href="{{ route('motorcycles.show', $motor) }}"
                                    class="py-4 bg-slate-100 text-slate-900 rounded-2xl font-black text-[10px] tracking-widest uppercase text-center block hover:bg-slate-900 hover:text-white transition-all active:scale-95 duration-500">
                                    Detail Unit
                                </a>
                                <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin sewa motor ' . $motor->name) }}"
                                    class="py-4 gold-btn text-white rounded-2xl font-black text-[10px] tracking-widest uppercase text-center block transition-all shadow-xl shadow-amber-950/10 active:scale-95 duration-500">
                                    Sewa Sekarang
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full page-empty-state" data-aos="fade-up">
                        <div
                            class="w-32 h-32 bg-slate-100 rounded-[3rem] flex items-center justify-center text-slate-300 mx-auto mb-10">
                            <i class="fa-solid fa-motorcycle text-slate-300 text-6xl"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 mb-6 font-heading tracking-tight">Menyiapkan Unit Motor
                        </h3>
                        <p class="text-slate-400 font-medium text-lg">Koleksi motor kami sedang dalam tahap pengecekan rutin untuk memastikan keamanan dan kenyamanan berkendara Anda.</p>
                    </div>
                @endforelse
            </div>

            @if ($motorcycles->hasPages())
                <div class="page-pagination">
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


