@extends('layouts.admin')

@section('title', 'Manajemen Testimoni')

@section('content')
    <div class="space-y-10 animate-in fade-in duration-700">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-800 font-heading tracking-tighter">Daftar Testimoni</h2>
                <p class="text-slate-400 font-medium mt-1">Kelola ulasan dan pengalaman pelanggan untuk ditampilkan di
                    frontend.</p>
            </div>
            <a href="{{ route('admin.testimonials.create') }}"
                class="flex items-center gap-3 px-8 py-4 bg-indigo-500 text-white rounded-2xl font-black text-sm hover:bg-indigo-600 transition-all shadow-lg shadow-indigo-500/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Testimoni
            </a>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Profil
                                Pelanggan</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Isi
                                Ulasan</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status
                            </th>
                            <th
                                class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($testimonials as $testimonial)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-6">
                                        <div
                                            class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-600 font-black text-xl shadow-sm shrink-0 border border-indigo-100">
                                            {{ strtoupper(substr($testimonial->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="text-lg font-black text-slate-800 tracking-tight leading-none mb-2">
                                                {{ $testimonial->name }}</div>
                                            <div class="text-[10px] font-black text-indigo-500 uppercase tracking-widest">
                                                {{ $testimonial->occupation }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <p class="text-sm text-slate-500 font-medium italic leading-relaxed max-w-xl">
                                        "{{ Str::limit($testimonial->content, 100) }}"</p>
                                </td>
                                <td class="px-10 py-8">
                                    @if ($testimonial->is_active)
                                        <span
                                            class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100 flex items-center gap-2 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="px-4 py-2 bg-slate-50 text-slate-400 rounded-full text-[10px] font-black uppercase tracking-widest border border-gray-100 flex items-center gap-2 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                            Arsip
                                        </span>
                                    @endif
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.testimonials.edit', $testimonial) }}"
                                            class="p-3 bg-slate-50 text-slate-600 rounded-xl hover:bg-indigo-50 hover:text-indigo-600 transition-all border border-gray-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.testimonials.destroy', $testimonial) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus testimoni ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-3 bg-slate-50 text-slate-600 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all border border-gray-100">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                                    </path>
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
        </div>
    </div>
@endsection
