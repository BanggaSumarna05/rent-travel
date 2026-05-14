@extends('layouts.admin')

@section('title', 'Tambah Mobil Baru')

@section('content')
    <div class="max-w-4xl space-y-10 animate-fade-in">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.cars.index') }}"
                class="flex items-center gap-3 text-slate-400 hover:text-slate-900 transition-colors font-black text-[10px] uppercase tracking-[0.2em] group">
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-10 pb-20">
            @csrf

            <!-- General Info Section -->
            <div class="bg-white rounded-[3rem] p-10 lg:p-14 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-full blur-3xl -mr-32 -mt-32 opacity-50 group-hover:bg-amber-50 transition-colors duration-1000"></div>
                
                <h3 class="text-xl font-black text-slate-900 mb-12 flex items-center gap-5 relative z-10 uppercase tracking-tighter italic">
                    <div class="w-1.5 h-8 bg-amber-500 rounded-full shadow-lg shadow-amber-500/50"></div>
                    Informasi Dasar <span class="gold-gradient-text ml-2">Unit</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 relative z-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Nama Unit</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Rolls-Royce Phantom" required>
                        @error('name')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Merek / Manufaktur</label>
                        <input type="text" name="brand" value="{{ old('brand') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('brand') border-red-500 @enderror"
                            placeholder="Contoh: Rolls-Royce" required>
                        @error('brand')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Deskripsi & Keunggulan Unit</label>
                        <textarea name="description" rows="5"
                            class="w-full px-8 py-6 bg-slate-50 border-2 border-transparent rounded-[2rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight resize-none @error('description') border-red-500 @enderror"
                            placeholder="Deskripsikan fitur, kenyamanan, dan keunggulan unit ini..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Technical Specs Section -->
            <div class="bg-white rounded-[3rem] p-10 lg:p-14 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-full blur-3xl -mr-32 -mt-32 opacity-50 group-hover:bg-slate-100 transition-colors duration-1000"></div>

                <h3 class="text-xl font-black text-slate-900 mb-12 flex items-center gap-5 relative z-10 uppercase tracking-tighter italic">
                    <div class="w-1.5 h-8 bg-slate-900 rounded-full shadow-lg shadow-slate-900/50"></div>
                    Spesifikasi <span class="gold-gradient-text ml-2">Teknis</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10 relative z-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Konfigurasi Transmisi</label>
                        <div class="relative">
                            <select name="transmission"
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight appearance-none cursor-pointer">
                                <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Otomatis (Automatic)</option>
                                <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Varian Layanan</label>
                        <div class="relative">
                            <select name="category"
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight appearance-none cursor-pointer @error('category') border-red-500 @enderror"
                                required>
                                <option value="lepas_kunci" {{ old('category') == 'lepas_kunci' ? 'selected' : '' }}>Layanan Lepas Kunci</option>
                                <option value="with_driver" {{ old('category') == 'with_driver' ? 'selected' : '' }}>Layanan Dengan Driver</option>
                                <option value="carter_drop" {{ old('category') == 'carter_drop' ? 'selected' : '' }}>Layanan Carter / Drop</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('category')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Kapasitas Kursi</label>
                        <input type="number" name="passenger_capacity" value="{{ old('passenger_capacity') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('passenger_capacity') border-red-500 @enderror"
                            placeholder="Contoh: 4" required>
                        @error('passenger_capacity')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Jenis Bahan Bakar</label>
                        <input type="text" name="fuel_type" value="{{ old('fuel_type') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('fuel_type') border-red-500 @enderror"
                            placeholder="Contoh: Pertamax Turbo / Electric" required>
                        @error('fuel_type')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Manufaktur Tahun</label>
                        <input type="text" name="year" value="{{ old('year') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('year') border-red-500 @enderror"
                            placeholder="Contoh: 2024" required>
                        @error('year')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Harga Sewa / Hari (IDR)</label>
                        <input type="number" name="price_per_day" value="{{ old('price_per_day') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('price_per_day') border-red-500 @enderror"
                            placeholder="Harga harian unit" required>
                        @error('price_per_day')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Harga Sewa / Bulan (IDR - Opsional)</label>
                        <input type="number" name="price_per_month" value="{{ old('price_per_month') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('price_per_month') border-red-500 @enderror"
                            placeholder="Contoh: 5000000">
                        @error('price_per_month')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Status Operasional</label>
                        <div class="relative">
                            <select name="status"
                                class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight appearance-none cursor-pointer @error('status') border-red-500 @enderror"
                                required>
                                <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif & Tersedia</option>
                                <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Non-Aktif / Maintenance</option>
                            </select>
                            <div class="absolute right-6 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 9l-7 7-7-7"></path></svg>
                            </div>
                        </div>
                        @error('status')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-6 p-8 bg-slate-900 rounded-[2rem] border border-white/5 shadow-xl shadow-slate-950/20 group/feat">
                        <div class="relative inline-flex items-center cursor-pointer scale-110">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" id="is_featured"
                                class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                            <div
                                class="w-14 h-8 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-slate-400 after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-amber-500 peer-checked:after:bg-white shadow-inner">
                            </div>
                        </div>
                        <label for="is_featured"
                            class="text-xs font-black text-white uppercase tracking-[0.2em] cursor-pointer group-hover/feat:text-amber-400 transition-colors italic">Unit <span class="gold-gradient-text uppercase not-italic">Featured</span></label>
                    </div>
                </div>
            </div>

            <!-- Media Upload Section -->
            <div class="bg-white rounded-[3rem] p-10 lg:p-14 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute -left-10 -bottom-10 w-48 h-48 bg-amber-50 rounded-full blur-3xl opacity-50 group-hover:scale-150 transition-transform duration-1000"></div>

                <h3 class="text-xl font-black text-slate-900 mb-12 flex items-center gap-5 relative z-10 uppercase tracking-tighter italic">
                    <div class="w-1.5 h-8 bg-amber-500 rounded-full shadow-lg shadow-amber-500/50"></div>
                    Galeri <span class="gold-gradient-text ml-2">Media</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Foto Unit</label>
                        <div class="relative group border-4 border-dashed border-slate-100 rounded-[3rem] p-10 hover:border-amber-500/50 transition-all bg-slate-50/50 hover:bg-amber-50/10 cursor-pointer text-center">
                            <input type="file" name="images[]" id="images"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="image/*">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-amber-500 shadow-xl border border-slate-50 group-hover:scale-110 transition-transform mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-1">Unggah Foto</p>
                                <p class="text-[8px] font-bold text-slate-400 italic">JPG/PNG (Max 2MB)</p>
                            </div>
                        </div>
                        @error('images.*')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Video Unit (Opsional)</label>
                        <div class="relative group border-4 border-dashed border-slate-100 rounded-[3rem] p-10 hover:border-amber-500/50 transition-all bg-slate-50/50 hover:bg-amber-50/10 cursor-pointer text-center">
                            <input type="file" name="videos[]" id="videos"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="video/*">
                            <div class="flex flex-col items-center">
                                <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center text-amber-500 shadow-xl border border-slate-50 group-hover:scale-110 transition-transform mb-4">
                                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-1">Unggah Video</p>
                                <p class="text-[8px] font-bold text-slate-400 italic">MP4/MOV (Max 20MB)</p>
                            </div>
                        </div>
                        @error('videos.*')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full py-8 bg-slate-900 text-amber-400 rounded-[3rem] font-black text-xl tracking-[0.3em] uppercase hover:bg-amber-500 hover:text-white transition-all shadow-2xl shadow-slate-950/20 active:scale-95 duration-700 border border-white/5 relative overflow-hidden group">
                <span class="relative z-10">Simpan Data Unit</span>
                <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-amber-400 translate-y-full group-hover:translate-y-0 transition-transform duration-700"></div>
            </button>
        </form>
    </div>

    <style>
        .animate-fade-in {
            animation: luxuryFadeIn 1s cubic-bezier(0, 0, 0.2, 1);
        }
        @keyframes luxuryFadeIn {
            from { opacity: 0; transform: translateY(30px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection
