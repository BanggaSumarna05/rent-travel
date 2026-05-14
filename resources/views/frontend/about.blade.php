@extends('layouts.frontend')

@section('title', 'Tentang Kami - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')

{{-- ═══════════════════════════════════
     HERO HEADER
═══════════════════════════════════ --}}
<x-frontend.page-hero
    :items="[['label' => 'Tentang Kami']]"
    badge="Tentang Kami"
    title="Tentang CJA"
    highlight="Rent Car"
    :description="\App\Models\Setting::get('site_description', 'Menghadirkan layanan transportasi terpercaya dengan standar armada terbaik dan kru profesional untuk kenyamanan perjalanan Anda.')"
    align="left"
/>

{{-- ═══════════════════════════════════
     STATS BAR — seamless under header
═══════════════════════════════════ --}}
<div class="bg-white">
    <div class="page-shell">
        <div class="page-stat-band grid grid-cols-3 divide-x divide-slate-200">
            <div class="page-stat-band-item">
                <span class="text-xl md:text-3xl font-black text-slate-900 tracking-tight leading-none">500+</span>
                <span class="text-[8px] md:text-[10px] font-bold text-amber-600 uppercase tracking-widest mt-1 leading-tight">Pelanggan Puas</span>
            </div>
            <div class="page-stat-band-item">
                <span class="text-xl md:text-3xl font-black text-slate-900 tracking-tight leading-none">10+</span>
                <span class="text-[8px] md:text-[10px] font-bold text-amber-600 uppercase tracking-widest mt-1 leading-tight">Tahun Berdiri</span>
            </div>
            <div class="page-stat-band-item">
                <span class="text-xl md:text-3xl font-black text-amber-500 tracking-tight leading-none">24/7</span>
                <span class="text-[8px] md:text-[10px] font-bold text-amber-600 uppercase tracking-widest mt-1 leading-tight">Siap Melayani</span>
            </div>
        </div>
    </div>
</div>

{{-- ═══════════════════════════════════
     STORY — image + text side by side
═══════════════════════════════════ --}}
<section class="page-section bg-white">
    <div class="page-shell">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 md:gap-10 lg:gap-20 items-center">

            {{-- Image — FIRST on mobile --}}
            <div class="relative" data-aos="fade-right">
                <div class="absolute inset-0 bg-amber-300/10 blur-[50px] rounded-full pointer-events-none"></div>
                <div class="surface-card relative z-10 overflow-hidden p-3">
                    <img src="{{ \App\Models\Setting::logoUrl() }}"
                         alt="CJA Rent Car"
                         class="aspect-[5/4] w-full rounded-[1.4rem] bg-slate-50 object-contain p-8 md:rounded-[1.7rem] md:p-12">
                </div>
            </div>

            {{-- Text --}}
            <div data-aos="fade-left">
                <div class="section-kicker">Kisah Kami</div>

                <h2 class="section-title mb-3 leading-tight md:mb-5 md:text-[2.35rem]">
                    Dedikasi Terhadap Pelayanan
                </h2>

                <div class="text-[13px] md:text-base text-slate-500 leading-relaxed">
                            {!! nl2br(e(\App\Models\Setting::get('about_history', 'Berawal dari dedikasi untuk menyediakan solusi transportasi berkualitas, CJA RENT CAR kini menjadi mitra terpercaya untuk sewa mobil di Tasikmalaya. Kami percaya bahwa setiap perjalanan pelanggan adalah prioritas utama yang harus dilayani dengan profesionalisme dan kenyamanan tanpa kompromi.'))) !!}
                </div>

                <div class="mt-5 flex flex-row gap-2.5 md:mt-7">
                    <a href="{{ route('cars.index') }}"
                       class="action-primary flex-1 sm:flex-none">
                        <span>Lihat Armada</span>
                        <i class="fa-solid fa-car-rear text-xs text-[#D4AF37] shrink-0"></i>
                    </a>
                    <a href="{{ \App\Models\Setting::whatsappLink() }}"
                       class="action-secondary flex-1 sm:flex-none">
                        <i class="fa-brands fa-whatsapp w-4 h-4 text-emerald-500 shrink-0"></i>
                        <span>WhatsApp</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ═══════════════════════════════════
     VISI & MISI
═══════════════════════════════════ --}}
<section class="page-section page-section-muted border-t border-slate-100">
    <div class="page-shell">

        <div class="section-heading">
            <p class="section-kicker">Arah & Tujuan</p>
            <h2 class="section-title">Visi & Misi</h2>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 md:gap-6">
            {{-- Visi --}}
            <div class="surface-card p-5 md:p-8" data-aos="fade-up">
                <div class="flex items-center gap-3 mb-3 md:mb-4">
                    <div class="w-1 h-6 md:h-8 bg-[#D4AF37] rounded-full shrink-0"></div>
                    <h3 class="text-base md:text-xl font-black text-slate-900 tracking-tight">Visi Kami</h3>
                </div>
                <p class="text-[13px] md:text-base text-slate-500 leading-relaxed italic">
                    "{{ \App\Models\Setting::get('about_vision', 'Menjadi penyedia layanan sewa mobil terdepan di Tasikmalaya yang mengutamakan kepercayaan, keamanan, dan kepuasan pelanggan.') }}"
                </p>
            </div>

            {{-- Misi --}}
            <div class="surface-card-dark p-5 md:p-8" data-aos="fade-up" data-aos-delay="100">
                <div class="flex items-center gap-3 mb-3 md:mb-4">
                    <div class="w-1 h-6 md:h-8 bg-amber-500 rounded-full shrink-0"></div>
                    <h3 class="text-base md:text-xl font-black text-white tracking-tight">Misi Kami</h3>
                </div>
                <p class="text-[13px] md:text-base text-slate-400 leading-relaxed">
                    {{ \App\Models\Setting::get('about_mission', 'Menjaga standar kualitas armada secara berkala, memberikan pelayanan admin yang responsif, dan memastikan setiap pelanggan mendapatkan pengalaman berkendara yang aman dan berkesan.') }}
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════
     VALUES
═══════════════════════════════════ --}}
<section class="page-section bg-white">
    <div class="page-shell">
        <div class="section-heading">
            <p class="section-kicker">Keunggulan Kami</p>
            <h2 class="section-title">Nilai-Nilai Kami</h2>
        </div>

        @php
            $values = [
                ['icon' => 'fa-solid fa-shield-check', 'label' => 'Terpercaya', 'desc' => 'Armada terawat & driver berpengalaman'],
                ['icon' => 'fa-solid fa-clock', 'label' => 'Tepat Waktu', 'desc' => 'Selalu on-schedule, tanpa keterlambatan'],
                ['icon' => 'fa-solid fa-receipt', 'label' => 'Harga Jelas', 'desc' => 'Tidak ada biaya tersembunyi'],
                ['icon' => 'fa-solid fa-headset', 'label' => 'Siap 24/7', 'desc' => 'Layanan tersedia kapan pun dibutuhkan'],
            ];
        @endphp

        <div class="grid grid-cols-2 md:grid-cols-4 gap-3 md:gap-5">
            @foreach($values as $i => $val)
            <div class="surface-card-soft group p-4 text-center transition-all duration-400 hover:-translate-y-1 hover:border-amber-200/50 hover:bg-white hover:shadow-lg md:p-6"
                 data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                <div class="w-9 h-9 md:w-12 md:h-12 rounded-xl bg-amber-50 flex items-center justify-center mx-auto mb-2.5 group-hover:bg-[#C9A14A] transition-colors duration-400">
                    <i class="{{ $val['icon'] }} text-[#C9A14A] transition-colors group-hover:text-white md:text-xl"></i>
                </div>
                <div class="text-[11px] md:text-sm font-black text-slate-900 mb-1">{{ $val['label'] }}</div>
                <div class="text-[9px] md:text-[11px] text-slate-400 leading-snug">{{ $val['desc'] }}</div>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ═══════════════════════════════════
     CTA
═══════════════════════════════════ --}}
<section class="page-section page-section-muted border-t border-slate-100">
    <div class="page-shell">
        <div class="relative rounded-2xl md:rounded-[2.5rem] bg-slate-900 overflow-hidden p-7 md:p-14 text-center shadow-2xl" data-aos="zoom-in">
            <div class="absolute inset-0 bg-[radial-gradient(circle_at_center,_#D4AF37_0%,_transparent_65%)] opacity-10 pointer-events-none"></div>
            <div class="relative z-10 max-w-xl mx-auto">
                <h2 class="text-xl md:text-3xl lg:text-4xl font-black text-white mb-3 leading-tight tracking-tight">
                    Siap <span class="gold-gradient-text">Mulai Perjalanan</span> Bersama Kami?
                </h2>
                <p class="text-[13px] md:text-sm text-slate-400 mb-5 md:mb-8 leading-relaxed">
                    Hubungi kami dan nikmati layanan rental terbaik di Tasikmalaya.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-2.5">
                    <a href="{{ \App\Models\Setting::whatsappLink() }}"
                       class="action-accent">
                        <span>Hubungi Sekarang</span>
                        <i class="fa-solid fa-arrow-right-long transition-transform group-hover:translate-x-1"></i>
                    </a>
                    <a href="{{ route('cars.index') }}"
                       class="action-ghost-light">
                        Lihat Armada
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection



