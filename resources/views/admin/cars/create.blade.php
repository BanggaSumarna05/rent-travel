@extends('layouts.admin')

@section('title', 'Tambah Mobil Baru')

@section('content')
    <div class="max-w-4xl space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.cars.index') }}"
                class="flex items-center gap-3 text-slate-400 hover:text-slate-800 transition-colors font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-10 pb-20">
            @csrf

            <!-- General Info Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-teal-500 rounded-full"></div>
                    Informasi Dasar
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama
                            Mobil</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Mercedes-Benz S-Class" required>
                        @error('name')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Merek</label>
                        <input type="text" name="brand" value="{{ old('brand') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('brand') border-red-500 @enderror"
                            placeholder="Contoh: Mercedes-Benz" required>
                        @error('brand')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4 md:col-span-2">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Deskripsi</label>
                        <textarea name="description" rows="4"
                            class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight resize-none @error('description') border-red-500 @enderror"
                            placeholder="Jelaskan kemewahan dan fitur mobil ini..." required>{{ old('description') }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>

            <!-- Technical Specs Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                    Spesifikasi Teknis & Harga
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label
                            class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Transmisi</label>
                        <select name="transmission"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight appearance-none">
                            <option value="Automatic" {{ old('transmission') == 'Automatic' ? 'selected' : '' }}>Otomatis
                                (Automatic)</option>
                            <option value="Manual" {{ old('transmission') == 'Manual' ? 'selected' : '' }}>Manual</option>
                        </select>
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Kategori
                            Layanan</label>
                        <select name="category"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight appearance-none @error('category') border-red-500 @enderror"
                            required>
                            <option value="lepas_kunci" {{ old('category') == 'lepas_kunci' ? 'selected' : '' }}>Lepas
                                Kunci</option>
                            <option value="with_driver" {{ old('category') == 'with_driver' ? 'selected' : '' }}>Dengan
                                Driver</option>
                            <option value="carter_drop" {{ old('category') == 'carter_drop' ? 'selected' : '' }}>Carter /
                                Drop</option>
                        </select>
                        @error('category')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Kapasitas
                            Penumpang</label>
                        <input type="number" name="passenger_capacity" value="{{ old('passenger_capacity') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('passenger_capacity') border-red-500 @enderror"
                            placeholder="Jumlah kursi" required>
                        @error('passenger_capacity')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Tipe Bahan
                            Bakar</label>
                        <input type="text" name="fuel_type" value="{{ old('fuel_type') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('fuel_type') border-red-500 @enderror"
                            placeholder="Contoh: Pertamax / Diesel" required>
                        @error('fuel_type')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Tahun
                            Kendaraan</label>
                        <input type="text" name="year" value="{{ old('year') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('year') border-red-500 @enderror"
                            placeholder="Contoh: 2023" required>
                        @error('year')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Harga Sewa Per
                            Hari (Rp)</label>
                        <input type="number" name="price_per_day" value="{{ old('price_per_day') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight @error('price_per_day') border-red-500 @enderror"
                            placeholder="Harga dalam Rupiah" required>
                        @error('price_per_day')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Status
                            Mobil</label>
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

                    <div
                        class="flex items-center gap-6 p-8 bg-gray-50 rounded-[2rem] border border-transparent hover:border-teal-100 transition-all group">
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_featured" value="0">
                            <input type="checkbox" name="is_featured" value="1" id="is_featured"
                                class="sr-only peer" {{ old('is_featured') ? 'checked' : '' }}>
                            <div
                                class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-teal-500 shadow-inner">
                            </div>
                        </div>
                        <label for="is_featured"
                            class="text-xs font-black text-slate-800 uppercase tracking-widest cursor-pointer group-hover:text-teal-600 transition-colors">Tandai
                            sebagai Mobil Andalan</label>
                    </div>
                </div>
            </div>

            <!-- Media Upload Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                    Galeri Foto
                </h3>

                <div class="space-y-6">
                    <div
                        class="relative group border-2 border-dashed border-gray-200 rounded-[3rem] p-16 hover:border-teal-500 transition-all bg-gray-50/50 hover:bg-teal-50/10 cursor-pointer text-center">
                        <input type="file" name="images[]" id="images"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="image/*">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-teal-600 shadow-xl border border-teal-50 group-hover:scale-110 transition-transform mb-6">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <p class="text-sm font-black text-slate-800 uppercase tracking-widest mb-2">Pilih Foto Mobil
                            </p>
                            <p class="text-xs font-bold text-slate-400">Format: JPG, PNG, Max 2MB per foto</p>
                        </div>
                    </div>
                    @error('images.*')
                        <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-widest uppercase hover:bg-teal-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
                Simpan Data Mobil
            </button>
        </form>
    </div>
@endsection
