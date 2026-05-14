@extends('layouts.frontend')

@section('content')

@php
    $googleReviewUrl = 'https://www.google.com/maps/place/Rental+Mobil+Lepas+Kunci+Tasikmalaya+Cipawitra+Jaya+Abadi+(CJA+Rentcar)/@-7.3357567,108.1480361,17z/data=!3m1!4b1!4m6!3m5!1s0x2e6f57001b5d0ea9:0xeea95d572afe0227!8m2!3d-7.3357567!4d108.1480361!16s%2Fg%2F11mm0vwk1l';
@endphp

<div class="home-typography">

    {{-- ═══════════════════════════════════════
         HERO SECTION
    ═══════════════════════════════════════ --}}
    <section class="relative overflow-hidden bg-slate-900 pt-32 pb-20 lg:pt-48 lg:pb-32">
        <div class="absolute inset-0 z-0">
            <div class="absolute inset-0 bg-gradient-to-b from-slate-950/80 to-slate-900"></div>
            <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-amber-500/10 blur-[120px] rounded-full -mr-64 -mt-64"></div>
            <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-slate-500/10 blur-[120px] rounded-full -ml-32 -mb-32"></div>
        </div>

        <div class="page-shell relative z-10">
            <div class="max-w-4xl mx-auto text-center" data-aos="fade-up">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 mb-6">
                    <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                    <span class="text-[10px] font-black gold-gradient-text uppercase tracking-[0.2em]">Kesan Pelanggan</span>
                </div>
                <h1 class="text-4xl lg:text-7xl font-black text-white tracking-tight leading-[0.95] mb-8 font-heading">
                    Apa Kata <br>
                    <span class="gold-gradient-text italic">Mereka</span> Tentang Kami?
                </h1>
                <p class="text-slate-400 text-lg md:text-xl font-medium leading-relaxed max-w-2xl mx-auto">
                    Kualitas layanan adalah prioritas bagi kami. Lihat ulasan jujur dari pelanggan yang telah mempercayakan perjalanan mereka bersama CJA Rent Car.
                </p>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         GOOGLE REVIEWS SECTION
    ═══════════════════════════════════════ --}}
    <section class="py-20 lg:py-32 bg-white relative overflow-hidden">
        <div class="page-shell">
            {{-- Judul di atas --}}
            <div class="text-center mb-16" data-aos="fade-up">
                <p class="section-kicker">Google Maps Reviews</p>
                <h2 class="section-title text-premium-gradient">Ulasan Terverifikasi Langsung dari Google</h2>
                <p class="section-copy copy-strong mx-auto max-w-2xl">
                    Kami bangga memiliki reputasi tinggi di Google Maps. Ini adalah hasil nyata dari dedikasi kami dalam menyediakan armada terbaik dan layanan pelanggan 24 jam.
                </p>
            </div>

            {{-- Widget di bawah --}}
            <div class="relative" data-aos="fade-up" data-aos-delay="100">
                <div class="absolute inset-0 bg-amber-500/5 blur-[80px] rounded-full"></div>
                <div class="relative card-premium p-6 rounded-[2.5rem] border-slate-100 overflow-hidden shadow-2xl bg-white">
                    <!-- Elfsight Google Reviews -->
                    <script src="https://elfsightcdn.com/platform.js" async></script>
                    <div class="elfsight-app-9c03e5ec-7bec-4b9a-a757-3821bb4c825b" data-elfsight-app-lazy></div>
                </div>
            </div>
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         MANUAL TESTIMONIALS SECTION
    ═══════════════════════════════════════ --}}
    <section class="py-20 lg:py-32 bg-slate-50 relative overflow-hidden">
        <div class="absolute top-0 left-1/2 w-full h-[1px] bg-gradient-to-r from-transparent via-slate-200 to-transparent"></div>
        
        <div class="page-shell">
            <div class="text-center mb-16 lg:mb-24" data-aos="fade-up">
                <p class="section-kicker">Experience Feed</p>
                <h2 class="section-title text-premium-gradient">Cerita Perjalanan Bersama Kami</h2>
                <p class="section-copy copy-strong mx-auto">
                    Kumpulan testimoni dari pelanggan yang telah menyewa mobil dan menggunakan jasa paket wisata kami.
                </p>
            </div>

            @if($testimonials->isEmpty())
                <div class="text-center py-20 bg-white rounded-[3rem] border border-dashed border-slate-200" data-aos="zoom-in">
                    <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-6">
                        <i class="fa-solid fa-face-smile text-slate-300 text-3xl"></i>
                    </div>
                    <p class="text-slate-400 font-bold uppercase tracking-widest text-xs">Belum ada testimoni manual</p>
                </div>
            @else
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
                    @foreach($testimonials as $testimonial)
                        <article class="card-premium p-8 bg-white transition-all duration-500 hover:-translate-y-2 group" 
                                 data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                            <div class="flex items-center gap-1 text-[#C9A14A] mb-6">
                                @for($i=0; $i<5; $i++)
                                    <i class="fa-solid fa-star text-xs"></i>
                                @endfor
                            </div>
                            
                            <p class="text-slate-600 italic leading-relaxed mb-8 relative">
                                <span class="absolute -top-4 -left-2 text-slate-100 text-6xl font-serif">"</span>
                                {{ $testimonial->content }}
                            </p>

                            <div class="flex items-center gap-4 mt-auto">
                                <div class="w-14 h-14 rounded-2xl overflow-hidden shadow-md border border-slate-100 shrink-0">
                                    @if($testimonial->hasMedia('testimonials'))
                                        <img src="{{ $testimonial->getFirstMediaUrl('testimonials') }}" alt="{{ $testimonial->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full bg-amber-50 flex items-center justify-center text-amber-500 font-black text-xl">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                    @endif
                                </div>
                                <div>
                                    <h4 class="font-black text-slate-900 group-hover:text-[#8D6A2B] transition-colors">{{ $testimonial->name }}</h4>
                                    <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">{{ $testimonial->occupation ?: 'Pelanggan Setia' }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <div class="flex justify-center">
                    {{ $testimonials->links() }}
                </div>
            @endif
        </div>
    </section>

    {{-- ═══════════════════════════════════════
         CTA SECTION
    ═══════════════════════════════════════ --}}
    <section class="py-20 lg:py-32 bg-white">
        <div class="page-shell">
            <div class="relative overflow-hidden rounded-[4rem] bg-slate-900 p-12 lg:p-24 text-center">
                <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_rgba(201,161,74,0.15),_transparent_70%)] opacity-50"></div>
                <div class="relative z-10 max-w-3xl mx-auto">
                    <h2 class="text-3xl lg:text-5xl font-black text-white mb-8 tracking-tight font-heading leading-tight underline decoration-amber-500/30 decoration-8 underline-offset-8">
                        Jadilah Bagian dari <br> Cerita Kami Selanjutnya
                    </h2>
                    <p class="text-slate-400 text-lg mb-12 italic">
                        Siap untuk perjalanan yang nyaman dan berkesan? Amankan unit favorit Anda sekarang juga.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('cars.index') }}" class="inline-flex items-center justify-center gap-3 rounded-2xl bg-[#C9A14A] px-8 py-5 text-sm font-black text-slate-900 shadow-2xl shadow-[#C9A14A]/20 hover:-translate-y-1 transition-all">
                            <span>Lihat Semua Armada</span>
                            <i class="fa-solid fa-car-side"></i>
                        </a>
                        <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin reservasi peralanan.') }}" class="inline-flex items-center justify-center gap-3 rounded-2xl border border-white/10 bg-white/5 px-8 py-5 text-sm font-black text-white hover:bg-white/10 transition-all">
                            <span>Konsultasi via WA</span>
                            <i class="fa-brands fa-whatsapp text-emerald-400"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>

@endsection
