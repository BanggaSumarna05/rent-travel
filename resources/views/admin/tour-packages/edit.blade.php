@extends('layouts.admin')

@section('title', 'Edit Paket Wisata: ' . $tourPackage->name)

@section('content')
    <div class="max-w-4xl space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.tour-packages.index') }}"
                class="flex items-center gap-3 text-slate-400 hover:text-slate-800 transition-colors font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.tour-packages.update', $tourPackage) }}" method="POST" enctype="multipart/form-data"
            class="space-y-10 pb-20">
            @csrf
            @method('PUT')

            <!-- General Info Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-amber-500 rounded-full"></div>
                    Informasi Dasar Paket
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama Paket
                            Wisata</label>
                        <input type="text" name="name" value="{{ old('name', $tourPackage->name) }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Eksotis Bali 3 Hari 2 Malam" required>
                        @error('name')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Durasi
                            Perjalanan</label>
                        <input type="text" name="duration" value="{{ old('duration', $tourPackage->duration) }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight @error('duration') border-red-500 @enderror"
                            placeholder="Contoh: 3 Hari 2 Malam" required>
                        @error('duration')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Harga Paket
                            (Rp)</label>
                        <input type="number" name="price" value="{{ old('price', $tourPackage->price) }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight @error('price') border-red-500 @enderror"
                            placeholder="Harga dalam Rupiah" required>
                        @error('price')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Status
                            Layanan</label>
                        <select name="status"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight appearance-none">
                            <option value="active" {{ old('status', $tourPackage->status) == 'active' ? 'selected' : '' }}>
                                Aktif (Tampilkan)</option>
                            <option value="inactive"
                                {{ old('status', $tourPackage->status) == 'inactive' ? 'selected' : '' }}>Non-Aktif
                                (Sembunyikan)</option>
                        </select>
                    </div>
                </div>
            </div>

            <!-- Details Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                    Detail & Fasilitas
                </h3>

                <div class="space-y-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Deskripsi
                            Umum</label>
                        <textarea name="description" rows="4"
                            class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight resize-none @error('description') border-red-500 @enderror"
                            placeholder="Jelaskan gambaran umum perjalanan..." required>{{ old('description', $tourPackage->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Itinerary Section -->
                    <div class="space-y-6" x-data="{ items: {{ old('itinerary', $tourPackage->itinerary) ? json_encode(old('itinerary', $tourPackage->itinerary)) : '[]' }} }">
                        <div class="flex items-center justify-between ml-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Rencana
                                Perjalanan (Itinerary)</label>
                            <button type="button" @click="items.push({day: 'Hari ' + (items.length + 1), activity: ''})"
                                class="text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-800 transition-colors">
                                + Tambah Hari
                            </button>
                        </div>

                        <div class="space-y-4">
                            <template x-for="(item, index) in items" :key="index">
                                <div
                                    class="p-6 bg-gray-50 rounded-[1.5rem] border border-gray-100 space-y-4 relative group">
                                    <button type="button" @click="items.splice(index, 1)"
                                        class="absolute top-4 right-4 text-gray-400 hover:text-red-500 transition-colors">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M6 18L18 6M6 6l12 12"></path>
                                        </svg>
                                    </button>
                                    <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                        <div class="md:col-span-1">
                                            <input type="text" :name="'itinerary[' + index + '][day]'" x-model="item.day"
                                                class="w-full px-4 py-3 bg-white border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 font-bold text-xs"
                                                placeholder="Contoh: Hari 1">
                                        </div>
                                        <div class="md:col-span-3">
                                            <input type="text" :name="'itinerary[' + index + '][activity]'"
                                                x-model="item.activity"
                                                class="w-full px-4 py-3 bg-white border border-gray-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-indigo-500/20 font-bold text-xs"
                                                placeholder="Aktivitas atau tujuan...">
                                        </div>
                                    </div>
                                </div>
                            </template>
                            <div x-show="items.length === 0"
                                class="p-8 text-center border-2 border-dashed border-gray-100 rounded-[2rem]">
                                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Belum ada itinerary.
                                    Klik "Tambah Hari" untuk memulai.</p>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Termasuk
                                (Include)</label>
                            <textarea name="include" rows="6"
                                class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-emerald-500/20 focus:border-emerald-500 transition-all font-bold text-sm tracking-tight resize-none"
                                placeholder="Satu fasilitas per baris...">{{ old('include', $tourPackage->include) }}</textarea>
                        </div>
                        <div class="space-y-4">
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Tidak
                                Termasuk (Exclude)</label>
                            <textarea name="exclude" rows="6"
                                class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-red-500/20 focus:border-red-500 transition-all font-bold text-sm tracking-tight resize-none"
                                placeholder="Satu fasilitas per baris...">{{ old('exclude', $tourPackage->exclude) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Media Upload Section -->
            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-blue-500 rounded-full"></div>
                    Foto Saat Ini
                </h3>

                <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-10">
                    @foreach ($tourPackage->getMedia('tour_packages') as $media)
                        <div
                            class="relative group rounded-2xl overflow-hidden aspect-square border border-gray-100 shadow-sm">
                            <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover">
                        </div>
                    @endforeach
                </div>

                <div class="space-y-6">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Upload Foto Baru
                        (Opsional)</label>
                    <div
                        class="relative group border-2 border-dashed border-gray-200 rounded-[3rem] p-16 hover:border-blue-500 transition-all bg-gray-50/50 hover:bg-blue-50/10 cursor-pointer text-center">
                        <input type="file" name="images[]" id="images"
                            class="absolute inset-0 w-full h-full opacity-0 cursor-pointer" multiple accept="image/*">
                        <div class="flex flex-col items-center">
                            <div
                                class="w-20 h-20 bg-white rounded-2xl flex items-center justify-center text-blue-600 shadow-xl border border-blue-50 group-hover:scale-110 transition-transform mb-6">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M12 4v16m8-8H4"></path>
                                </svg>
                            </div>
                            <p class="text-[10px] font-black text-slate-800 uppercase tracking-widest mb-1">Ganti Foto Paket
                            </p>
                            <p class="text-[9px] font-bold text-slate-400 italic">JPG/PNG (Max 2MB)</p>
                        </div>
                    </div>
                    @error('images.*')
                        <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}
                        </p>
                    @enderror
                </div>
            </div>

            <button type="submit"
                class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-widest uppercase hover:bg-amber-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
                Perbarui Paket Wisata
            </button>
        </form>
    </div>
@endsection
