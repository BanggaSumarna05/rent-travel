@extends('layouts.frontend')

@section('title', 'Paket Wisata Eksklusif - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'Paket Wisata']]"
        badge="Paket Wisata"
        title="Paket Wisata"
        highlight="Tasikmalaya"
        description="Temukan pengalaman perjalanan tak terlupakan dengan paket wisata pilihan yang dikurasi khusus untuk kenyamanan dan kebahagiaan Anda."
    />

    <!-- Catalog Grid -->
    <section class="page-section-large page-section-muted">
        <div class="page-shell">
            <div class="page-grid-3">
                @forelse($tours as $tour)
                    <div class="surface-card group flex h-full flex-col overflow-hidden transition-all duration-500 hover:-translate-y-1 hover:border-amber-200/60 hover:shadow-xl"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="relative h-[22rem] overflow-hidden shrink-0">
                            <img src="{{ $tour->primary_image_url }}" alt="{{ $tour->name }}"
                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" loading="lazy">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/10 to-transparent">
                            </div>
                            <div class="absolute bottom-8 left-8 right-8">
                                <div
                                    class="flex items-center gap-2 text-[#D4AF37] text-[9px] font-black uppercase tracking-[0.4em] mb-3">
                                    <i class="fa-solid fa-location-dot h-3.5 w-3.5"></i>
                                    Standar Emas
                                </div>
                                <h2
                                    class="text-3xl font-black text-white font-heading tracking-tighter leading-none hover:text-[#D4AF37] transition-colors cursor-pointer">
                                    <a href="{{ route('tours.show', $tour) }}">{{ $tour->name }}</a>
                                </h2>
                            </div>
                        </div>

                        <div class="flex flex-1 flex-col p-6 md:p-8">
                            <div class="flex items-center gap-6 mb-8">
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-amber-50 group-hover:bg-amber-100 transition-all flex items-center justify-center text-[#D4AF37]">
                                        <i class="fa-solid fa-clock h-3.5 w-3.5"></i>
                                    </div>
                                    <span
                                        class="text-[9px] font-black text-slate-500 uppercase tracking-widest">{{ $tour->duration }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <div
                                        class="w-8 h-8 rounded-full bg-amber-50 group-hover:bg-amber-100 transition-all flex items-center justify-center text-[#D4AF37]">
                                        <i class="fa-solid fa-check h-3.5 w-3.5"></i>
                                    </div>
                                    <span class="text-[9px] font-black text-slate-500 uppercase tracking-widest">Layanan
                                        Lengkap</span>
                                </div>
                            </div>

                            <p class="text-slate-500 text-[13px] leading-relaxed mb-10 line-clamp-3 font-medium italic">
                                {{ $tour->description }}
                            </p>

                            <div class="mt-auto flex items-center justify-between gap-4 border-t border-slate-100 pt-6">
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
                                    <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin reservasi paket ' . $tour->name) }}"
                                        class="w-12 h-12 bg-slate-900 text-[#D4AF37] rounded-xl flex items-center justify-center hover:bg-[#D4AF37] hover:text-white transition-all duration-500 shadow-xl shadow-slate-950/10 shrink-0">
                                        <i class="fa-solid fa-comments text-lg"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full page-empty-state" data-aos="fade-up">
                        <div
                            class="w-32 h-32 bg-slate-100 rounded-[3rem] flex items-center justify-center text-slate-300 mx-auto mb-10">
                            <i class="fa-solid fa-map-location-dot text-slate-300 text-6xl"></i>
                        </div>
                        <h3 class="text-4xl font-black text-slate-900 mb-6 font-heading tracking-tight">Penyusunan Paket Wisata</h3>
                        <p class="text-slate-400 font-medium text-lg">Kami sedang menyiapkan paket wisata terbaik yang akan memberikan pengalaman baru bagi petualangan Anda.</p>
                    </div>
                @endforelse
            </div>

            @if ($tours->hasPages())
                <div class="page-pagination">
                    {{ $tours->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection


