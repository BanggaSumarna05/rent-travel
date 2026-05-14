@extends('layouts.admin')

@section('title', 'Tambah Post Baru')

@section('content')
    <div class="max-w-5xl space-y-10 animate-fade-in">
        <!-- Header Section -->
        <div>
            <div class="flex items-center gap-4 mb-4">
                <a href="{{ route('admin.posts.index') }}"
                    class="p-3 bg-white rounded-xl border border-gray-100 text-slate-400 hover:text-teal-600 hover:border-teal-100 transition-all shadow-sm group">
                    <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                        viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                    </svg>
                </a>
                <div>
                    <h2 class="text-3xl font-black text-slate-800 tracking-tight leading-tight font-heading">
                        Buat Post Baru
                    </h2>
                    <p class="text-slate-500 font-semibold mt-1">Berbagi artikel atau update terbaru kepada pelanggan.</p>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data"
            class="space-y-10 pb-20">
            @csrf

            <!-- Main Content Card -->
            <div class="bg-white rounded-[3rem] p-10 lg:p-14 shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 gap-10">
                    <!-- Title -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Judul
                            Post</label>
                        <input type="text" name="title" value="{{ old('title') }}" required
                            class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-lg tracking-tight"
                            placeholder="Masukkan judul post yang menarik">
                        @error('title')
                            <p class="text-xs text-red-500 font-bold ml-4">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Isi
                            Konten</label>
                        <textarea name="content" rows="12" required
                            class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight leading-relaxed"
                            placeholder="Tuliskan isi post selengkapnya di sini...">{{ old('content') }}</textarea>
                        @error('content')
                            <p class="text-xs text-red-500 font-bold ml-4">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">
                        <!-- Image Upload -->
                        <div class="space-y-4 font-black">
                            <label
                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4 italic">Gambar
                                Utama</label>
                            <div class="relative group">
                                <input type="file" name="image" id="imageInput" class="hidden" accept="image/*"
                                    onchange="previewImage(event)">
                                <label for="imageInput"
                                    class="flex flex-col items-center justify-center border-2 border-dashed border-slate-200 rounded-[2rem] p-10 cursor-pointer hover:bg-teal-50 hover:border-teal-200 transition-all group">
                                    <div id="previewContainer" class="hidden w-full mb-4">
                                        <img id="imagePreview" src="#" alt="Preview"
                                            class="w-full h-48 object-cover rounded-2xl shadow-lg">
                                    </div>
                                    <div id="uploadPlaceholder" class="flex flex-col items-center">
                                        <div
                                            class="w-16 h-16 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 mb-4 group-hover:scale-110 group-hover:bg-white group-hover:text-teal-500 transition-all duration-500">
                                            <svg class="w-8 h-8 font-black" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                    d="M12 4v16m8-8H4"></path>
                                            </svg>
                                        </div>
                                        <span
                                            class="text-[10px] font-black text-slate-400 group-hover:text-teal-600 transition-colors uppercase tracking-widest mb-1">Pilih
                                            Gambar</span>
                                        <span class="text-[9px] font-bold text-slate-400 italic">JPG/PNG (Max 2MB)</span>
                                    </div>
                                </label>
                            </div>
                            @error('image')
                                <p class="text-xs text-red-500 font-bold ml-4">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Visibility & Date -->
                        <div class="space-y-10">
                            <!-- Toggle Publish -->
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Status
                                    Publikasi</label>
                                <div class="flex items-center gap-6 p-6 bg-slate-50 rounded-3xl">
                                    <label class="relative inline-flex items-center cursor-pointer">
                                        <input type="checkbox" name="is_published" value="1" class="sr-only peer"
                                            {{ old('is_published') ? 'checked' : '' }}>
                                        <div
                                            class="w-14 h-8 bg-slate-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-teal-500">
                                        </div>
                                    </label>
                                    <span class="text-sm font-black text-slate-700 uppercase tracking-widest">Terbitkan
                                        Langsung</span>
                                </div>
                            </div>

                            <!-- Published At -->
                            <div class="space-y-4">
                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Tanggal
                                    Publikasi</label>
                                <input type="datetime-local" name="published_at"
                                    value="{{ old('published_at', now()->format('Y-m-d\TH:i')) }}"
                                    class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-teal-500/20 focus:border-teal-500 transition-all font-bold text-sm tracking-tight font-black italic">
                                @error('published_at')
                                    <p class="text-xs text-red-500 font-bold ml-4">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <button type="submit"
                class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-[0.2em] uppercase hover:bg-teal-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
                Simpan & Terbitkan Post
            </button>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const output = document.getElementById('imagePreview');
                output.src = reader.result;
                document.getElementById('previewContainer').classList.remove('hidden');
                document.getElementById('uploadPlaceholder').classList.add('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }
    </script>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s cubic-bezier(0.16, 1, 0.3, 1);
        }
    </style>
@endsection
