@extends('layouts.admin')

@section('title', 'Tambah Motor Baru')

@section('content')
    <div class="max-w-4xl space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.motorcycles.index') }}"
                class="flex items-center gap-3 text-slate-400 hover:text-slate-800 transition-colors font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.motorcycles.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-10 pb-20">
            @csrf

            <!-- General Info Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                    Informasi Dasar Motor
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama
                            Motor</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Honda PCX 160" required>
                        @error('name')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Merek</label>
                        <input type="text" name="brand" value="{{ old('brand') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight @error('brand') border-red-500 @enderror"
                            placeholder="Contoh: Honda" required>
                        @error('brand')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Kapasitas Mesin
                            (cc)</label>
                        <input type="number" name="engine_capacity" value="{{ old('engine_capacity') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight @error('engine_capacity') border-red-500 @enderror"
                            placeholder="Contoh: 160" required>
                        @error('engine_capacity')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Deskripsi
                            Motor</label>
                        <textarea name="description" rows="4"
                            class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-blue-500/20 focus:border-blue-500 transition-all font-bold text-sm tracking-tight resize-none @error('description') border-red-500 @enderror"
                            placeholder="Jelaskan detail dan kelebihan motor ini..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Pricing Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-teal-500 rounded-full"></div>
                    Harga Sewa
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Harga Sewa Per
                            Hari (Rp)</label>
                        <input type="number" name="price_per_day" value="{{ old('price_per_day') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('price_per_day') border-red-500 @enderror"
                            placeholder="Sewa per hari dalam Rupiah" required>
                        @error('price_per_day')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Harga Sewa Per
                            Bulan (Rp - Opsional)</label>
                        <input type="number" name="price_per_month" value="{{ old('price_per_month') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('price_per_month') border-red-500 @enderror"
                            placeholder="Contoh: 1500000">
                        @error('price_per_month')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Status
                            Motor</label>
                        <select name="status"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight appearance-none @error('status') border-red-500 @enderror"
                            required>
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Aktif Tersedia
                            </option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Tidak Aktif /
                                Maintenance</option>
                        </select>
                        @error('status')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Media Upload Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                    Media Motor
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-8 relative z-10">
                    <div class="space-y-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 block mb-2">Foto Motor</label>
                        <div class="relative group border-2 border-dashed border-gray-200 rounded-[2.5rem] p-10 hover:border-blue-500 transition-all bg-gray-50/50 hover:bg-blue-50/10 cursor-pointer text-center">
                            <input type="file" name="images[]" id="images"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="image/*">
                            <div class="flex flex-col items-center">
                                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-lg border border-blue-50 group-hover:scale-110 transition-transform mb-4">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-1">Pilih Foto</p>
                                <p class="text-[9px] font-bold text-slate-400 italic">JPG/PNG (Max 2MB)</p>
                            </div>
                        </div>
                        @error('images.*')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 block mb-2">Video Motor (Opsional)</label>
                        <div class="relative group border-2 border-dashed border-gray-200 rounded-[2.5rem] p-10 hover:border-blue-500 transition-all bg-gray-50/50 hover:bg-blue-50/10 cursor-pointer text-center">
                            <input type="file" name="videos[]" id="videos"
                                class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="video/*">
                            <div class="flex flex-col items-center">
                                <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-lg border border-blue-50 group-hover:scale-110 transition-transform mb-4">
                                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <p class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-1">Pilih Video</p>
                                <p class="text-[9px] font-bold text-slate-400 italic">MP4/MOV (Max 20MB)</p>
                            </div>
                        </div>
                        @error('videos.*')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-widest uppercase hover:bg-blue-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
                Simpan Data Motor
            </button>
        </form>
    </div>
@endsection
