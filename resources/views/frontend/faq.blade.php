@extends('layouts.frontend')

@section('title', 'Hak Istimewa - FAQ - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-white overflow-hidden">
        <div
            class="absolute top-0 right-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -mr-48 -mt-48 animate-pulse">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'FAQ']]" />
            <div data-aos="fade-down" class="text-center">
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 font-heading tracking-tighter leading-[1]">
                    Akses <span class="gold-gradient-text">Istimewa</span>
                </h1>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium">
                    Segala hal yang perlu Anda ketahui tentang layanan elit kami. Jawaban jelas untuk perjalanan yang
                    lancar.
                </p>
            </div>
        </div>
    </section>

    <!-- FAQ Grid -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="space-y-8">
                @forelse($faqs as $faq)
                    <div class="group bg-white rounded-[3rem] p-10 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.15)] transition-all duration-700 border border-slate-100 transform hover:-translate-y-2"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <div class="flex items-start gap-8">
                            <div
                                class="w-12 h-12 bg-slate-900 rounded-xl flex items-center justify-center text-[#D4AF37] shrink-0 shadow-lg shadow-amber-900/10 group-hover:scale-110 transition-transform">
                                <span class="text-lg font-black font-heading">?</span>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900 mb-4 font-heading tracking-tight leading-snug">
                                    {{ $faq->question }}</h3>
                                <p class="text-base text-slate-500 leading-relaxed font-medium">{{ $faq->answer }}</p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="text-center py-20" data-aos="fade-up">
                        <div
                            class="w-24 h-24 bg-slate-100 rounded-[2.5rem] flex items-center justify-center text-slate-300 mx-auto mb-8">
                            <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                    d="M8.228 9c.549-1.165 2.03-2 3.772-2 2.21 0 4 1.343 4 3 0 1.4-1.278 2.575-3.006 2.907-.542.104-.994.54-.994 1.093m0 3h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z">
                                </path>
                            </svg>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">Belum ada pertanyaan</h4>
                        <p class="text-slate-400 font-medium">Silakan hubungi konserge kami untuk bantuan lebih lanjut.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>

    <style>
        .shadow-4xl {
            box-shadow: 0 40px 100px -20px rgba(212, 175, 55, 0.15);
        }
    </style>
@endsection
