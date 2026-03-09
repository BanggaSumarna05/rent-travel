@extends('layouts.admin')

@section('title', 'Tambah Testimoni Pelanggan')

@section('content')
    <div class="max-w-4xl space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.testimonials.index') }}"
                class="flex items-center gap-3 text-slate-400 hover:text-slate-800 transition-colors font-bold text-sm">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18">
                    </path>
                </svg>
                Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" class="space-y-10 pb-20">
            @csrf

            <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
                <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                    <div class="w-1.5 h-6 bg-indigo-500 rounded-full"></div>
                    Informasi Pelanggan
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama
                            Pelanggan</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight @error('name') border-red-500 @enderror"
                            placeholder="Contoh: Budi Santoso" required>
                        @error('name')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Pekerjaan /
                            Kota</label>
                        <input type="text" name="occupation" value="{{ old('occupation') }}"
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight @error('occupation') border-red-500 @enderror"
                            placeholder="Contoh: Pengusaha, Jakarta" required>
                        @error('occupation')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Rating
                            Pengalaman</label>
                        <div
                            class="flex items-center gap-4 px-8 py-5 bg-gray-50 rounded-[1.5rem] border border-transparent focus-within:ring-2 focus-within:ring-indigo-500/20 focus-within:border-indigo-500 transition-all">
                            <select name="rating"
                                class="bg-transparent w-full font-bold text-sm tracking-tight focus:outline-none" required>
                                @for ($i = 1; $i <= 5; $i++)
                                    <option value="{{ $i }}" {{ old('rating', 5) == $i ? 'selected' : '' }}>
                                        {{ $i }} Bintang</option>
                                @endfor
                            </select>
                        </div>
                    </div>

                    <div class="space-y-4 md:col-span-2">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Testimoni /
                            Ulasan</label>
                        <textarea name="content" rows="6"
                            class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all font-bold text-sm tracking-tight resize-none @error('content') border-red-500 @enderror"
                            placeholder="Tuliskan pengalaman positif pelanggan di sini..." required>{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">
                                {{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="flex items-center gap-6 p-8 bg-gray-50 rounded-[2rem] border border-transparent hover:border-indigo-100 transition-all group md:col-span-2">
                        <div class="relative inline-flex items-center cursor-pointer">
                            <input type="hidden" name="is_active" value="0">
                            <input type="checkbox" name="is_active" value="1" id="is_active" class="sr-only peer"
                                {{ old('is_active', true) ? 'checked' : '' }}>
                            <div
                                class="w-14 h-8 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-indigo-500 shadow-inner">
                            </div>
                        </div>
                        <label for="is_active"
                            class="text-xs font-black text-slate-800 uppercase tracking-widest cursor-pointer group-hover:text-indigo-600 transition-colors">Aktifkan
                            Testimoni Ini</label>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-widest uppercase hover:bg-indigo-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
                Simpan Testimoni
            </button>
        </form>
    </div>
@endsection
