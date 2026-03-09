@extends('layouts.frontend')

@section('title', 'Tentang Kami - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-white overflow-hidden">
        <div
            class="absolute top-0 left-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -ml-24 -mt-24 animate-pulse">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'Tentang Kami']]" />
            <div data-aos="fade-down" class="text-center">
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 font-heading tracking-tighter leading-[1]">
                    Tentang <span class="gold-gradient-text">Kami</span>
                </h1>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium">
                    {{ \App\Models\Setting::get('site_description', 'Menghadirkan pengalaman perjalanan tak terlupakan dengan armada terbaik dan layanan premium kelas dunia.') }}
                </p>
            </div>
        </div>
    </section>

    <!-- Vision & Mission -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-center">
                <div data-aos="fade-right">
                    <div
                        class="inline-flex items-center gap-4 px-5 py-2.5 rounded-full bg-amber-50 border border-amber-200 gold-gradient-text font-black text-xs uppercase tracking-[0.3em] mb-10 shadow-sm shadow-amber-900/5">
                        Kisah Kami
                    </div>
                    <h2 class="text-4xl font-black text-slate-900 mb-8 font-heading tracking-tighter">Dedikasi Terhadap
                        Pelayanan</h2>
                    <div class="space-y-6 text-slate-500 font-medium leading-relaxed">
                        <div class="prose prose-slate">
                            {!! nl2br(
                                e(
                                    \App\Models\Setting::get(
                                        'about_history',
                                        'Sejak didirikan, kami telah berkomitmen untuk mendefinisikan ulang standar penyewaan kendaraan mewah. Kami percaya bahwa setiap perjalanan bukan sekadar perpindahan tempat, melainkan sebuah pernyataan gaya hidup.',
                                    ),
                                ),
                            ) !!}
                        </div>
                    </div>
                </div>
                <div class="relative" data-aos="fade-left">
                    <div
                        class="relative z-10 p-4 bg-white rounded-[3rem] shadow-[0_40px_100px_-20px_rgba(0,0,0,0.1)] border border-amber-50">
                        <img src="{{ asset('logo.jpg') }}" alt="Layanan Premium Rent Travel - Pengalaman Berkendara Mewah"
                            class="rounded-[2.2rem]">
                    </div>
                    <div class="absolute inset-0 bg-gold opacity-10 blur-[100px] rounded-full scale-90 translate-x-12">
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Visi & Misi -->
    <section class="py-24 bg-white border-t border-amber-100">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-16">
                <div data-aos="fade-up">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 font-heading tracking-tight flex items-center gap-4">
                        <div class="w-1.5 h-8 bg-[#D4AF37] rounded-full"></div>
                        Visi Kami
                    </h3>
                    <p class="text-slate-500 font-medium leading-relaxed italic text-lg">
                        "{{ \App\Models\Setting::get('about_vision', 'Menjadi penyedia layanan transportasi mewah terdepan yang menginspirasi gaya hidup perjalanan eksklusif.') }}"
                    </p>
                </div>
                <div data-aos="fade-up" data-aos-delay="200">
                    <h3 class="text-2xl font-black text-slate-900 mb-6 font-heading tracking-tight flex items-center gap-4">
                        <div class="w-1.5 h-8 bg-slate-900 rounded-full"></div>
                        Misi Kami
                    </h3>
                    <p class="text-slate-500 font-medium leading-relaxed text-lg">
                        {{ \App\Models\Setting::get('about_mission', 'Memberikan standar layanan emas, menjaga armada dalam kondisi prima, dan memastikan kepuasan pelanggan melalui perhatian mendetail yang tiada banding.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>

@endsection
