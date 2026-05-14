@extends('layouts.admin')

@section('title', 'Pengaturan Sistem')

@section('content')
    <div class="max-w-5xl space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <div>
            <h2 class="text-3xl font-black text-slate-800 font-heading tracking-tighter">Konfigurasi Aplikasi</h2>
            <p class="text-slate-400 font-medium mt-1">Sesuaikan identitas situs dan informasi kontak bisnis Anda.</p>
        </div>

        <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-10 pb-20">
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
                        <button type="button" onclick="scrollToSection('tentang')"
                            class="w-full flex items-center gap-4 px-6 py-4 rounded-2xl text-slate-400 hover:bg-gray-50 font-black text-sm transition-all text-left">
                            <div class="w-2 h-2 rounded-full bg-transparent"></div>
                            Tentang Kami
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
                    </div>

                    <!-- Section: Kontak -->
                    <div id="kontak" class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                        <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                            <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                            Kontak & Layanan
                        </h3>

                        <div class="space-y-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Email
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
                                    <span class="px-2 py-1 bg-teal-50 text-teal-600 rounded-md text-[8px]">Gunakan format
                                        Internasional</span>
                                </label>
                                <div class="relative">
                                    <div class="absolute left-8 top-1/2 -translate-y-1/2 text-slate-400 font-bold">+</div>
                                    <input type="text" name="settings[whatsapp_number]"
                                        value="{{ \App\Models\Setting::get('whatsapp_number') }}"
                                        class="w-full pl-12 pr-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight"
                                        placeholder="628123456789">
                                </div>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nomor
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
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                    Google Maps (Embed/Share)</label>
                                <input type="text" name="settings[google_maps_url]"
                                    value="{{ \App\Models\Setting::get('google_maps_url') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight"
                                    placeholder="https://goo.gl/maps/...">
                            </div>
                        </div>
                    </div>

                    <!-- Section: Sosial Media -->
                    <div id="sosmed" class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100 scroll-mt-10">
                        <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                            <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                            Eksistensi Media Sosial
                        </h3>

                        <div class="space-y-8">
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                    Instagram</label>
                                <input type="url" name="settings[instagram_link]"
                                    value="{{ \App\Models\Setting::get('instagram_link') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight"
                                    placeholder="https://instagram.com/username">
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                    Facebook</label>
                                <input type="url" name="settings[facebook_link]"
                                    value="{{ \App\Models\Setting::get('facebook_link') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight"
                                    placeholder="https://facebook.com/page">
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Link
                                    TikTok</label>
                                <input type="url" name="settings[tiktok_link]"
                                    value="{{ \App\Models\Setting::get('tiktok_link') }}"
                                    class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight"
                                    placeholder="https://tiktok.com/@username">
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
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Sejarah
                                    & Kisah Kami</label>
                                <textarea name="settings[about_history]" rows="6"
                                    class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight leading-relaxed"
                                    placeholder="Ceritakan sejarah perusahaan...">{{ \App\Models\Setting::get('about_history') }}</textarea>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Visi
                                    Perusahaan</label>
                                <textarea name="settings[about_vision]" rows="3"
                                    class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight"
                                    placeholder="Visi perusahaan...">{{ \App\Models\Setting::get('about_vision') }}</textarea>
                            </div>

                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Misi
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
