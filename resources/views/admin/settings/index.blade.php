@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')
    <div class="max-w-5xl space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <div>
            <h2 class="text-3xl font-black text-slate-800 font-heading tracking-tighter">Konfigurasi Aplikasi</h2>
            <p class="text-slate-400 font-medium mt-1">Sesuaikan identitas situs dan informasi kontak bisnis Anda.</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data"
            class="space-y-10 pb-20">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10">
                <!-- Sidebar Navigation for Settings -->
                <div class="lg:col-span-1 space-y-4">
                    <div class="bg-white rounded-[2.5rem] p-4 shadow-sm border border-gray-100 sticky top-10">
                        <button type="button" onclick="scrollToSection('identitas')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl bg-teal-50 text-teal-600 font-black text-sm transition-all text-left group">
                            <div class="w-2 h-2 rounded-full bg-teal-500"></div>
                            Identitas Situs
                        </button>
                        <button type="button" onclick="scrollToSection('media')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Media & Aset
                        </button>
                        <button type="button" onclick="scrollToSection('kontak')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Kontak & WhatsApp
                        </button>
                        <button type="button" onclick="scrollToSection('sosmed')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Media Sosial
                        </button>
                        <button type="button" onclick="scrollToSection('hero')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Hero Section
                        </button>
                        <button type="button" onclick="scrollToSection('statistik')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Statistik (Home)
                        </button>
                        <button type="button" onclick="scrollToSection('layanan')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Layanan (Home)
                        </button>
                        <button type="button" onclick="scrollToSection('about_home')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Tentang Kami (Home)
                        </button>
                        <button type="button" onclick="scrollToSection('tentang')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Tentang Kami (Detail)
                        </button>
                    </div>
                </div>

                <!-- Settings Content -->
                <div class="lg:col-span-2 space-y-10">
                    <!-- Section: Identitas -->
                    <div id="identitas" class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                        <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                            <div class="w-1.5 h-6 bg-teal-500 rounded-full"></div>
                            Identitas Utama
                        </h3>

                        <div class="space-y-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama
                                    Situs / Perusahaan</label>
                                <input type="text" name="settings[site_name]"
                                    value="{{ \App\Models\Setting::get('site_name') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight"
                                    placeholder="Nama Bisnis Anda">
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Slogan
                                    Bisnis (Tagline)</label>
                                <input type="text" name="settings[site_tagline]"
                                    value="{{ \App\Models\Setting::get('site_tagline') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight"
                                    placeholder="Slogan yang tampil di homepage">
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Alamat
                                    Kantor</label>
                                <textarea name="settings[address]" rows="3"
                                    class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight resize-none"
                                    placeholder="Alamat lengkap operasional">{{ \App\Models\Setting::get('address') }}</textarea>
                            </div>
                        </div>

                        <!-- Section: Media -->
                        <div id="media"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-rose-500 rounded-full"></div>
                                Media & Aset Visual
                            </h3>

                            <div class="space-y-10">
                                <!-- Site Logo -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                                    <div class="space-y-4">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Logo
                                            Situs</label>
                                        <input type="file" name="files[site_logo]"
                                            class="w-full px-8 py-4 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all font-bold text-xs">
                                        <p class="text-[10px] text-slate-400 ml-4 italic">Rekomendasi: PNG Transparan,
                                            512x512px</p>
                                    </div>
                                    <div
                                        class="bg-gray-50 rounded-[1.5rem] p-6 flex flex-col items-center justify-center border border-dashed border-gray-200">
                                        <span
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Preview
                                            Logo</span>
                                        <img src="{{ \App\Models\Setting::get('site_logo', asset('logo.jpg')) }}"
                                            class="max-h-24 object-contain rounded-lg">
                                    </div>
                                </div>

                                <!-- Favicon -->
                                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-start">
                                    <div class="space-y-4">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Favicon</label>
                                        <input type="file" name="files[favicon]"
                                            class="w-full px-8 py-4 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all font-bold text-xs">
                                        <p class="text-[10px] text-slate-400 ml-4 italic">Format: .ico atau .png (32x32px)
                                        </p>
                                    </div>
                                    <div
                                        class="bg-gray-50 rounded-[1.5rem] p-6 flex flex-col items-center justify-center border border-dashed border-gray-200">
                                        <span
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Preview
                                            Favicon</span>
                                        <img src="{{ \App\Models\Setting::get('favicon', asset('favicon.ico')) }}"
                                            class="w-8 h-8 object-contain">
                                    </div>
                                </div>

                                <hr class="border-gray-100">

                                <!-- Hero Image -->
                                <div class="space-y-6">
                                    <div class="space-y-4">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Hero
                                            Background Image (Home)</label>
                                        <input type="file" name="files[hero_image]"
                                            class="w-full px-8 py-4 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all font-bold text-xs">
                                    </div>
                                    <div class="bg-gray-50 rounded-[2rem] p-8 border border-dashed border-gray-200">
                                        <span
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 block text-center">Preview
                                            Hero Image</span>
                                        <img src="{{ \App\Models\Setting::get('hero_image', asset('landing.png')) }}"
                                            class="w-full h-64 object-cover rounded-[1.5rem] shadow-lg">
                                    </div>
                                </div>

                                <!-- About Image -->
                                <div class="space-y-6">
                                    <div class="space-y-4">
                                        <label
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">About
                                            Section Image (Home)</label>
                                        <input type="file" name="files[about_home_image]"
                                            class="w-full px-8 py-4 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-rose-500/20 focus:border-rose-500 transition-all font-bold text-xs">
                                    </div>
                                    <div class="bg-gray-50 rounded-[2rem] p-8 border border-dashed border-gray-200">
                                        <span
                                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4 block text-center">Preview
                                            About Image</span>
                                        <img src="{{ \App\Models\Setting::get('about_home_image', 'https://images.unsplash.com/photo-1519389950473-47ba0277781c?auto=format&fit=crop&q=80&w=800') }}"
                                            class="w-full h-64 object-cover rounded-[1.5rem] shadow-lg">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Kontak -->
                        <div id="kontak"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                                Kontak & Layanan
                            </h3>

                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Email
                                        Bisnis</label>
                                    <input type="email" name="settings[contact_email]"
                                        value="{{ \App\Models\Setting::get('contact_email') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="email@bisnis.com">
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 flex items-center gap-2">
                                        Nomor WhatsApp
                                        <span class="px-2 py-1 bg-teal-50 text-teal-600 rounded-md text-[8px]">Gunakan
                                            format
                                            Internasional</span>
                                    </label>
                                    <div class="relative">
                                        <div class="absolute left-8 top-1/2 -translate-y-1/2 text-slate-400 font-bold">+
                                        </div>
                                        <input type="text" name="settings[whatsapp_number]"
                                            value="{{ \App\Models\Setting::get('whatsapp_number') }}"
                                            class="w-full pl-12 pr-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight"
                                            placeholder="628123456789">
                                    </div>
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nomor
                                        Telepon Kantor (Opsional)</label>
                                    <input type="text" name="settings[phone_number]"
                                        value="{{ \App\Models\Setting::get('phone_number') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="(021) 123456">
                                </div>

                                <div class="space-y-4">
                                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Jam
                                        Operasional</label>
                                    <input type="text" name="settings[opening_hours]"
                                        value="{{ \App\Models\Setting::get('opening_hours') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="Senin - Minggu: 24 Jam">
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                        Google Maps (Embed/Share)</label>
                                    <input type="text" name="settings[google_maps_url]"
                                        value="{{ \App\Models\Setting::get('google_maps_url') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="https://goo.gl/maps/...">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Sosial Media -->
                        <div id="sosmed"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                                Eksistensi Media Sosial
                            </h3>

                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                        Instagram</label>
                                    <input type="url" name="settings[instagram_link]"
                                        value="{{ \App\Models\Setting::get('instagram_link') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="https://instagram.com/username">
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                        Facebook</label>
                                    <input type="url" name="settings[facebook_link]"
                                        value="{{ \App\Models\Setting::get('facebook_link') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="https://facebook.com/page">
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                        TikTok</label>
                                    <input type="url" name="settings[tiktok_link]"
                                        value="{{ \App\Models\Setting::get('tiktok_link') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="https://tiktok.com/@username">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Hero Content -->
                        <div id="hero"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-pink-500 rounded-full"></div>
                                Hero Section (Home)
                            </h3>

                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Hero
                                        Title</label>
                                    <input type="text" name="settings[hero_title]"
                                        value="{{ \App\Models\Setting::get('hero_title', 'Sewa Mobil Mewah, Perjalanan Berkesan') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="Judul utama di halaman depan">
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Hero
                                        Subtitle</label>
                                    <textarea name="settings[hero_subtitle]" rows="3"
                                        class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-pink-500/20 focus:border-pink-500 transition-all font-bold text-sm tracking-tight resize-none"
                                        placeholder="Sub-judul di bawah judul utama">{{ \App\Models\Setting::get('hero_subtitle', 'Nikmati kenyamanan berkendara dengan armada mobil premium pilihan.') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Statistik -->
                        <div id="statistik"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-orange-500 rounded-full"></div>
                                Statistik Perusahaan
                            </h3>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Stat 1
                                        Value</label>
                                    <input type="text" name="settings[stats_1_value]"
                                        value="{{ \App\Models\Setting::get('stats_1_value', '500+') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all font-bold text-sm tracking-tight">
                                </div>
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Stat 1
                                        Label</label>
                                    <input type="text" name="settings[stats_1_label]"
                                        value="{{ \App\Models\Setting::get('stats_1_label', 'Pelanggan Puas') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all font-bold text-sm tracking-tight">
                                </div>
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Stat 2
                                        Value</label>
                                    <input type="text" name="settings[stats_2_value]"
                                        value="{{ \App\Models\Setting::get('stats_2_value', '50+') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all font-bold text-sm tracking-tight">
                                </div>
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Stat 2
                                        Label</label>
                                    <input type="text" name="settings[stats_2_label]"
                                        value="{{ \App\Models\Setting::get('stats_2_label', 'Unit Terawat') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all font-bold text-sm tracking-tight">
                                </div>
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Stat 3
                                        Value</label>
                                    <input type="text" name="settings[stats_3_value]"
                                        value="{{ \App\Models\Setting::get('stats_3_value', '24/7') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all font-bold text-sm tracking-tight">
                                </div>
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Stat 3
                                        Label</label>
                                    <input type="text" name="settings[stats_3_label]"
                                        value="{{ \App\Models\Setting::get('stats_3_label', 'Siap Melayani') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-orange-500/20 focus:border-orange-500 transition-all font-bold text-sm tracking-tight">
                                </div>
                            </div>
                        </div>

                        <!-- Section: Layanan -->
                        <div id="layanan"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-purple-500 rounded-full"></div>
                                Layanan (Home)
                            </h3>

                            <div class="space-y-10">
                                <div class="p-8 bg-gray-50 rounded-[2rem] space-y-6">
                                    <h4 class="font-black text-sm uppercase tracking-widest text-slate-400">Layanan 1</h4>
                                    <div class="space-y-4">
                                        <input type="text" name="settings[service_1_title]"
                                            value="{{ \App\Models\Setting::get('service_1_title', 'Rental Mobil') }}"
                                            class="w-full px-8 py-5 bg-white border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all font-bold text-sm tracking-tight"
                                            placeholder="Judul Layanan 1">
                                        <textarea name="settings[service_1_description]" rows="2"
                                            class="w-full px-8 py-6 bg-white border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all font-bold text-sm tracking-tight resize-none"
                                            placeholder="Deskripsi Layanan 1">{{ \App\Models\Setting::get('service_1_description', 'Pilihan mobil premium dengan kondisi terawat.') }}</textarea>
                                    </div>
                                </div>

                                <div class="p-8 bg-gray-50 rounded-[2rem] space-y-6">
                                    <h4 class="font-black text-sm uppercase tracking-widest text-slate-400">Layanan 2</h4>
                                    <div class="space-y-4">
                                        <input type="text" name="settings[service_2_title]"
                                            value="{{ \App\Models\Setting::get('service_2_title', 'Rental Motor') }}"
                                            class="w-full px-8 py-5 bg-white border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all font-bold text-sm tracking-tight"
                                            placeholder="Judul Layanan 2">
                                        <textarea name="settings[service_2_description]" rows="2"
                                            class="w-full px-8 py-6 bg-white border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all font-bold text-sm tracking-tight resize-none"
                                            placeholder="Deskripsi Layanan 2">{{ \App\Models\Setting::get('service_2_description', 'Motor matic terawat untuk jelajah kota.') }}</textarea>
                                    </div>
                                </div>

                                <div class="p-8 bg-gray-50 rounded-[2rem] space-y-6">
                                    <h4 class="font-black text-sm uppercase tracking-widest text-slate-400">Layanan 3</h4>
                                    <div class="space-y-4">
                                        <input type="text" name="settings[service_3_title]"
                                            value="{{ \App\Models\Setting::get('service_3_title', 'Paket Wisata') }}"
                                            class="w-full px-8 py-5 bg-white border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all font-bold text-sm tracking-tight"
                                            placeholder="Judul Layanan 3">
                                        <textarea name="settings[service_3_description]" rows="2"
                                            class="w-full px-8 py-6 bg-white border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-purple-500/20 focus:border-purple-500 transition-all font-bold text-sm tracking-tight resize-none"
                                            placeholder="Deskripsi Layanan 3">{{ \App\Models\Setting::get('service_3_description', 'Jelajahi destinasi favorit dengan paket tour lengkap.') }}</textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Tentang Kami (Home) -->
                        <div id="about_home"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-yellow-500 rounded-full"></div>
                                Tentang Kami (Home)
                            </h3>

                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">About
                                        Title (Home)</label>
                                    <input type="text" name="settings[about_home_title]"
                                        value="{{ \App\Models\Setting::get('about_home_title', 'Partner Terpercaya Perjalanan Anda') }}"
                                        class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="Judul bagian tentang kami di homepage">
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">About
                                        Description (Home)</label>
                                    <textarea name="settings[about_home_description]" rows="4"
                                        class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-yellow-500/20 focus:border-yellow-500 transition-all font-bold text-sm tracking-tight resize-none"
                                        placeholder="Deskripsi singkat tentang kami di homepage">{{ \App\Models\Setting::get('about_home_description', 'Kami adalah penyedia layanan transportasi dan manajemen perjalanan terkemuka yang berdedikasi untuk memberikan pengalaman mobilitas terbaik.') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Section: Tentang Kami -->
                        <div id="tentang"
                            class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                                <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                                Tentang Kami (CMS)
                            </h3>

                            <div class="space-y-8">
                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Sejarah
                                        & Kisah Kami</label>
                                    <textarea name="settings[about_history]" rows="6"
                                        class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight leading-relaxed"
                                        placeholder="Ceritakan sejarah perusahaan...">{{ \App\Models\Setting::get('about_history') }}</textarea>
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Visi
                                        Perusahaan</label>
                                    <textarea name="settings[about_vision]" rows="3"
                                        class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="Visi perusahaan...">{{ \App\Models\Setting::get('about_vision') }}</textarea>
                                </div>

                                <div class="space-y-4">
                                    <label
                                        class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Misi
                                        Perusahaan</label>
                                    <textarea name="settings[about_mission]" rows="3"
                                        class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="Misi perusahaan...">{{ \App\Models\Setting::get('about_mission') }}</textarea>
                                </div>
                            </div>
                        </div>

                        <button type="submit"
                            class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-widest uppercase hover:bg-teal-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
                            Simpan Perubahan Pengaturan
                        </button>
                    </div>
                </div>
        </form>
    </div>

    <script>
        function scrollToSection(id) {
            document.getElementById(id).scrollIntoView({
                behavior: 'smooth'
            });

            // Update active state of buttons
            const sidebarButtons = document.querySelectorAll('.lg\\:col-span-1 button');
            sidebarButtons.forEach(btn => {
                btn.classList.remove('bg-teal-50', 'text-teal-600');
                btn.classList.add('text-slate-400');
                btn.querySelector('div').classList.remove('bg-teal-500');
                btn.querySelector('div').classList.add('bg-transparent');
            });

            const activeBtn = Array.from(sidebarButtons).find(btn => btn.getAttribute('onclick').includes(id));
            if (activeBtn) {
                activeBtn.classList.add('bg-teal-50', 'text-teal-600');
                activeBtn.classList.remove('text-slate-400');
                activeBtn.querySelector('div').classList.add('bg-teal-500');
                activeBtn.querySelector('div').classList.remove('bg-transparent');
            }
        }
    </script>
@endsection
