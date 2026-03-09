@extends('layouts.frontend')

@section('title', 'Layanan Konserge - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Premium Header Section -->
    <section class="relative pt-32 pb-24 bg-white overflow-hidden">
        <!-- Interactive Background Patterns -->
        <div class="absolute top-0 left-0 w-full h-full pointer-events-none opacity-20">
            <div
                class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-amber-200/40 blur-[120px] rounded-full animate-pulse-slow">
            </div>
            <div class="absolute bottom-[-10%] right-[-10%] w-[500px] h-[500px] bg-slate-200/40 blur-[120px] rounded-full animate-pulse-slow"
                style="animation-delay: 2s"></div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="flex flex-col items-center">
                <div data-aos="fade-down">
                    <x-breadcrumb :items="[['label' => 'Hubungi Kami']]" />
                </div>

                <div class="text-center mt-8" data-aos="fade-up">
                    <div
                        class="inline-flex items-center gap-3 px-4 py-2 rounded-full bg-amber-50 border border-amber-100 mb-6 shadow-sm shadow-amber-900/5">
                        <span class="relative flex h-2 w-2">
                            <span
                                class="animate-ping absolute inline-flex h-full w-full rounded-full bg-amber-400 opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 bg-amber-500"></span>
                        </span>
                        <span class="text-[10px] font-black uppercase tracking-[0.2em] gold-gradient-text">Pelayanan
                            Prioritas</span>
                    </div>

                    <h1
                        class="text-5xl md:text-7xl font-black text-slate-900 mb-8 font-heading tracking-tighter leading-[0.9]">
                        Layanan <br class="hidden md:block"> <span
                            class="gold-gradient-text tracking-tighter">Konserge</span>
                    </h1>

                    <p class="text-lg text-slate-500 max-w-2xl mx-auto leading-relaxed font-medium">
                        Bantuan pribadi untuk perjalanan elit Anda berikutnya. Hubungi spesialis kami yang berdedikasi untuk
                        solusi mobilitas tanpa kompromi.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Luxury Contact Content -->
    <section class="py-24 relative overflow-hidden bg-slate-50">
        <!-- Background Accents -->
        <div class="absolute top-0 right-0 w-full h-full pointer-events-none overflow-hidden">
            <div
                class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[1000px] h-[1000px] border border-amber-500/10 rounded-full scale-150">
            </div>
            <div
                class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[800px] h-[800px] border border-amber-500/10 rounded-full scale-150">
            </div>
        </div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-20 items-stretch">
                <!-- Left Side: Contact Information Cards -->
                <div class="flex flex-col gap-10" data-aos="fade-right">
                    <div class="space-y-4">
                        <h2 class="text-xs font-black gold-gradient-text uppercase tracking-[0.4em] font-heading">Direct
                            Connection</h2>
                        <h3 class="text-3xl font-black text-slate-900 tracking-tight">Hubungi Tim Spesialis Kami</h3>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- WhatsApp Card -->
                        <div
                            class="group p-8 rounded-[3rem] bg-white border border-slate-100 shadow-[0_10px_40px_-10px_rgba(15,23,42,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.1)] hover:border-amber-200 transition-all duration-700 relative overflow-hidden h-full">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-teal-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div
                                class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-[#D4AF37] mb-6 group-hover:bg-teal-500 group-hover:text-white transition-colors duration-500 shadow-lg group-hover:shadow-teal-500/20">
                                <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" />
                                </svg>
                            </div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">WhatsApp
                                Response</div>
                            <div class="text-xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\Setting::get('whatsapp_number') }}</div>
                        </div>

                        <!-- Hours Card -->
                        <div
                            class="group p-8 rounded-[3rem] bg-white border border-slate-100 shadow-[0_10px_40px_-10px_rgba(15,23,42,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.1)] hover:border-amber-200 transition-all duration-700 relative overflow-hidden h-full">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-amber-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div
                                class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-[#D4AF37] mb-6 group-hover:bg-amber-500 group-hover:text-white transition-colors duration-500 shadow-lg group-hover:shadow-amber-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Availability
                            </div>
                            <div class="text-xl font-black text-slate-900 tracking-tight">
                                {{ \App\Models\Setting::get('opening_hours', '24 Jam') }}</div>
                        </div>

                        <!-- Email Card -->
                        <div
                            class="group p-8 rounded-[3rem] bg-white border border-slate-100 shadow-[0_10px_40px_-10px_rgba(15,23,42,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.1)] hover:border-amber-200 transition-all duration-700 relative overflow-hidden h-full">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-blue-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div
                                class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-[#D4AF37] mb-6 group-hover:bg-blue-500 group-hover:text-white transition-colors duration-500 shadow-lg group-hover:shadow-blue-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Electronic Mail
                            </div>
                            <div class="text-xl font-black text-slate-900 tracking-tight truncate">
                                {{ \App\Models\Setting::get('contact_email') }}</div>
                        </div>

                        <!-- Location Card -->
                        <div
                            class="group p-8 rounded-[3rem] bg-white border border-slate-100 shadow-[0_10px_40px_-10px_rgba(15,23,42,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.1)] hover:border-amber-200 transition-all duration-700 relative overflow-hidden h-full">
                            <div
                                class="absolute top-0 right-0 w-24 h-24 bg-red-500/5 rounded-full -mr-8 -mt-8 transition-transform group-hover:scale-150">
                            </div>
                            <div
                                class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-[#D4AF37] mb-6 group-hover:bg-red-500 group-hover:text-white transition-colors duration-500 shadow-lg group-hover:shadow-red-500/20">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-1">Corporate
                                Office</div>
                            <div class="text-lg font-black text-slate-900 tracking-tight leading-tight">
                                {{ \App\Models\Setting::get('address', 'Tasikmalaya, Jawa Barat') }}</div>
                        </div>
                    </div>

                    <!-- Priority Badge Card -->
                    <div class="mt-4 p-10 rounded-[3rem] bg-slate-900 text-white relative overflow-hidden group shadow-2xl">
                        <div
                            class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600 transform scale-x-0 group-hover:scale-x-100 transition-transform duration-1000 origin-left">
                        </div>
                        <div
                            class="absolute top-0 right-0 w-64 h-64 bg-amber-500/10 blur-[60px] rounded-full -mr-20 -mt-20">
                        </div>

                        <div class="relative z-10 flex flex-col md:flex-row items-center gap-10">
                            <div
                                class="w-24 h-24 bg-white/5 backdrop-blur-xl rounded-3xl border border-white/10 flex items-center justify-center shrink-0">
                                <div
                                    class="w-16 h-16 bg-amber-500 rounded-2xl flex items-center justify-center text-slate-900 shadow-[0_10px_30px_rgba(245,158,11,0.4)]">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" />
                                    </svg>
                                </div>
                            </div>
                            <div>
                                <h4 class="text-2xl font-black mb-3 font-heading tracking-tight italic">Eksperiens Tanpa
                                    Batas</h4>
                                <p class="text-slate-400 text-sm font-medium leading-relaxed max-w-md">
                                    Konserge kami melayani setiap detail perjalanan Anda 24 jam sehari, 7 hari seminggu.
                                    Keunggulan adalah standar minimum kami.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Contact Form -->
                <div class="relative" data-aos="fade-left">
                    <div
                        class="absolute -inset-4 bg-gradient-to-br from-amber-500/20 via-transparent to-transparent blur-3xl rounded-[4rem] pointer-events-none">
                    </div>

                    <div
                        class="relative bg-white p-10 lg:p-14 rounded-[3.5rem] shadow-[0_50px_100px_-20px_rgba(15,23,42,0.1)] border border-slate-100 flex flex-col h-full overflow-hidden">
                        <!-- Form Header -->
                        <div class="mb-10">
                            <h2 class="text-4xl font-black text-slate-900 mb-4 tracking-tighter">Kirim Pesan</h2>
                            <p class="text-slate-400 font-medium italic">Sampaikan kebutuhan Anda, spesialis kami akan
                                segera merespons.</p>
                        </div>

                        <form action="#" class="space-y-6 flex-1">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Nama
                                        Lengkap</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <input type="text"
                                            class="w-full pl-14 pr-6 py-5 bg-slate-50 border border-transparent rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all font-bold text-sm tracking-tight shadow-sm placeholder-slate-400"
                                            placeholder="Nama Anda">
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">WhatsApp
                                        / Telepon</label>
                                    <div class="relative group">
                                        <div
                                            class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1.01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                            </svg>
                                        </div>
                                        <input type="text"
                                            class="w-full pl-14 pr-6 py-5 bg-slate-50 border border-transparent rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all font-bold text-sm tracking-tight shadow-sm placeholder-slate-400"
                                            placeholder="0812...">
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Alamat
                                    Email</label>
                                <div class="relative group">
                                    <div
                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                        </svg>
                                    </div>
                                    <input type="email"
                                        class="w-full pl-14 pr-6 py-5 bg-slate-50 border border-transparent rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all font-bold text-sm tracking-tight shadow-sm placeholder-slate-400"
                                        placeholder="email@example.com">
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label
                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Kebutuhan
                                    Layanan</label>
                                <div class="relative group">
                                    <div
                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within:text-amber-500 transition-colors z-10">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-7.714 2.143L11 21l-2.286-6.857L1 12l7.714-2.143L11 3z" />
                                        </svg>
                                    </div>
                                    <select
                                        class="w-full pl-14 pr-6 py-5 bg-slate-50 border border-transparent rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all font-bold text-sm tracking-tight appearance-none relative shadow-sm text-slate-900">
                                        <option>Sewa Mobil Mewah</option>
                                        <option>Motor Matik Premium</option>
                                        <option>Paket Wisata Eksklusif</option>
                                        <option>Layanan Lainnya</option>
                                    </select>
                                    <div
                                        class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M19 9l-7 7-7-7" />
                                        </svg>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-2">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Pesan /
                                    Detail Kebutuhan</label>
                                <textarea rows="4"
                                    class="w-full px-8 py-6 bg-slate-50 border border-transparent rounded-[2.5rem] focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all font-bold text-sm tracking-tight resize-none leading-relaxed shadow-sm placeholder-slate-400"
                                    placeholder="Ceritakan rencana perjalanan Anda..."></textarea>
                            </div>

                            <button
                                class="w-full py-6 bg-slate-900 text-white rounded-3xl font-black text-lg tracking-[0.3em] uppercase gold-btn transition-all shadow-2xl shadow-slate-900/20 active:scale-[0.98] group duration-500 flex items-center justify-center gap-4 mt-4">
                                <span>Kirim Konserge</span>
                                <svg class="w-6 h-6 transform group-hover:translate-x-2 transition-transform text-[#D4AF37]"
                                    fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                        d="M17 8l4 4m0 0l-4 4m4-4H3" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Map Section with Border Frame -->
    @if (\App\Models\Setting::get('google_maps_url'))
        <section class="py-24 bg-white relative overflow-hidden">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
                <div class="mb-14" data-aos="fade-up">
                    <h2 class="text-xs font-black text-slate-400 uppercase tracking-[0.4em] mb-4">Our Presence</h2>
                    <h3 class="text-4xl font-black text-slate-900 tracking-tighter">Lokasi Strategis Kami</h3>
                </div>

                <div class="relative group" data-aos="zoom-in">
                    <!-- Frame Accents -->
                    <div
                        class="absolute -inset-1 bg-gradient-to-r from-amber-500/30 via-transparent to-amber-500/30 rounded-[4rem] group-hover:via-amber-500/10 transition-all duration-700">
                    </div>

                    <div
                        class="relative rounded-[3.5rem] overflow-hidden shadow-4xl aspect-[16/7] md:aspect-[16/6] lg:aspect-[21/9] border-8 border-white grayscale group-hover:grayscale-0 transition-all duration-1000">
                        <iframe src="{{ \App\Models\Setting::get('google_maps_url') }}"
                            class="absolute inset-0 w-full h-full border-0 group-hover:scale-105 transition-transform duration-[10s]"
                            allowfullscreen="" loading="lazy">
                        </iframe>
                    </div>

                    <!-- Floating Address Badge -->
                    <div
                        class="absolute -bottom-8 left-1/2 -translate-x-1/2 bg-slate-900 text-white px-10 py-5 rounded-[2.5rem] shadow-2xl border border-white/10 whitespace-normal md:whitespace-nowrap max-w-[90%] md:max-w-none">
                        <div class="flex items-center gap-4">
                            <div
                                class="w-10 h-10 bg-amber-500 rounded-xl flex items-center justify-center text-slate-900 shadow-lg shadow-amber-500/20">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                </svg>
                            </div>
                            <span
                                class="text-xs font-black uppercase tracking-widest text-[#D4AF37] truncate">{{ \App\Models\Setting::get('address', 'Tasikmalaya, Jawa Barat') }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <style>
        .shadow-4xl {
            box-shadow: 0 40px 100px -20px rgba(212, 175, 55, 0.15);
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #B8860B 0%, #D4AF37 50%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        @keyframes pulse-slow {

            0%,
            100% {
                opacity: 0.1;
                transform: scale(1);
            }

            50% {
                opacity: 0.2;
                transform: scale(1.1);
            }
        }

        .animate-pulse-slow {
            animation: pulse-slow 8s infinite ease-in-out;
        }
    </style>
@endsection
