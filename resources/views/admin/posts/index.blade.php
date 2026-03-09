@extends('layouts.admin')

@section('title', 'Manajemen Post')

@section('content')
    <div class="space-y-6 md:space-y-8 lg:space-y-10 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 md:gap-6">
            <div>
                <h2 class="text-2xl md:text-3xl lg:text-4xl font-black text-slate-800 tracking-tight leading-tight">
                    Daftar Post & Artikel
                </h2>
                <p class="text-slate-500 font-semibold mt-1 md:mt-2 text-sm md:text-base">
                    Kelola konten blog dan post terbaru untuk pengunjung.
                </p>
            </div>
            <a href="{{ route('admin.posts.create') }}"
                class="inline-flex items-center gap-2 md:gap-3 px-6 md:px-8 py-3 md:py-4 bg-teal-500 text-white rounded-xl md:rounded-2xl font-bold text-sm md:text-base hover:bg-teal-600 hover:shadow-xl hover:-translate-y-0.5 transition-all duration-300 shadow-lg shadow-teal-500/20 w-full md:w-auto justify-center">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                </svg>
                Tambah Post Baru
            </a>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-2xl md:rounded-3xl lg:rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gradient-to-br from-gray-50 to-white border-b border-gray-100">
                            <th
                                class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                Info Post
                            </th>
                            <th
                                class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                Status
                            </th>
                            <th
                                class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider">
                                Tanggal Publikasi
                            </th>
                            <th
                                class="px-6 lg:px-10 py-5 lg:py-8 text-[10px] font-black text-slate-400 uppercase tracking-wider text-right">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($posts as $post)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <!-- Post Info -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8">
                                    <div class="flex items-center gap-4 lg:gap-6">
                                        <div
                                            class="w-16 h-16 lg:w-20 lg:h-20 rounded-xl lg:rounded-2xl overflow-hidden border border-gray-100 shadow-sm shrink-0">
                                            <img src="{{ $post->getFirstMediaUrl('posts') ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=200' }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                                alt="{{ $post->title }}">
                                        </div>
                                        <div class="min-w-0 max-w-xs lg:max-w-md">
                                            <div
                                                class="text-base lg:text-lg font-black text-slate-800 tracking-tight leading-tight mb-2 truncate">
                                                {{ $post->title }}
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">
                                                    {{ $post->slug }}
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <!-- Status -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8">
                                    @if ($post->is_published)
                                        <span
                                            class="inline-flex items-center gap-2 px-3 lg:px-4 py-1.5 lg:py-2 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-emerald-100 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Published
                                        </span>
                                    @else
                                        <span
                                            class="inline-flex items-center gap-2 px-3 lg:px-4 py-1.5 lg:py-2 bg-amber-50 text-amber-600 rounded-full text-[10px] font-bold uppercase tracking-wide border border-amber-100 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>

                                <!-- Published At -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8">
                                    <div class="text-sm font-bold text-slate-600">
                                        {{ $post->published_at ? $post->published_at->format('d M Y, H:i') : '-' }}
                                    </div>
                                </td>

                                <!-- Actions -->
                                <td class="px-6 lg:px-10 py-6 lg:py-8 text-right">
                                    <div class="flex justify-end gap-2 lg:gap-3">
                                        <a href="{{ route('admin.posts.edit', $post) }}"
                                            class="p-2.5 lg:p-3 bg-slate-50 text-slate-600 rounded-lg lg:rounded-xl hover:bg-teal-50 hover:text-teal-600 hover:scale-110 transition-all border border-gray-100"
                                            title="Edit">
                                            <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2.5 lg:p-3 bg-slate-50 text-slate-600 rounded-lg lg:rounded-xl hover:bg-red-50 hover:text-red-600 hover:scale-110 transition-all border border-gray-100"
                                                title="Hapus">
                                                <svg class="w-4 h-4 lg:w-5 lg:h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="px-6 lg:px-10 py-6 bg-gray-50 border-t border-gray-100 italic">
                {{ $posts->links() }}
            </div>

            <!-- Empty State -->
            @if ($posts->isEmpty())
                <div class="py-16 px-6 text-center">
                    <div class="w-20 h-20 bg-slate-100 rounded-2xl flex items-center justify-center mx-auto mb-4">
                        <svg class="w-10 h-10 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 100-4 2 2 0 000 4z" />
                        </svg>
                    </div>
                    <h3 class="text-lg font-bold text-slate-800 mb-2">Belum Ada Post</h3>
                    <p class="text-slate-500 text-sm mb-6">Mulai tambahkan post atau artikel pertama Anda.</p>
                    <a href="{{ route('admin.posts.create') }}"
                        class="inline-flex items-center gap-2 px-6 py-3 bg-teal-500 text-white rounded-xl font-bold text-sm hover:bg-teal-600 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                        Tambah Post Baru
                    </a>
                </div>
            @endif
        </div>
    </div>

    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.6s ease-out;
        }
    </style>
@endsection
