@extends('layouts.admin')

@section('title', 'Manajemen Paket Wisata')

@section('content')
    <div class="space-y-10 animate-in fade-in duration-700">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-800 font-heading tracking-tighter">Daftar Paket Wisata</h2>
                <p class="text-slate-400 font-medium mt-1">Kelola paket perjalanan eksklusif dan status publikasinya.</p>
            </div>
            <a href="{{ route('admin.tour-packages.create') }}"
                class="flex items-center gap-3 px-8 py-4 bg-amber-500 text-white rounded-2xl font-black text-sm hover:bg-amber-600 transition-all shadow-lg shadow-amber-500/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Paket Baru
            </a>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Destinasi & Paket</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Durasi
                            </th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Harga
                                Paket</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status
                            </th>
                            <th
                                class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($tours as $tour)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-6">
                                        <div
                                            class="w-20 h-20 rounded-2xl overflow-hidden border border-gray-100 shadow-sm shrink-0">
                                            <img src="{{ $tour->getFirstMediaUrl('tour_packages') ?: 'https://images.unsplash.com/photo-1544636331-e26879cd4d9b?auto=format&fit=crop&q=80&w=800' }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        </div>
                                        <div>
                                            <div class="text-lg font-black text-slate-800 tracking-tight leading-none mb-2">
                                                {{ $tour->name }}</div>
                                            <div
                                                class="text-[10px] font-black text-amber-600 uppercase tracking-widest leading-none">
                                                Paket Wisata</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div
                                        class="flex items-center gap-3 text-xs font-bold text-slate-500 uppercase tracking-tight">
                                        <svg class="w-4 h-4 text-amber-500" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        {{ $tour->duration }}
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="text-lg font-black text-slate-800 tracking-tighter">Rp
                                        {{ number_format($tour->price, 0, ',', '.') }}</div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Total Harga
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    @if ($tour->status == 'active')
                                        <span
                                            class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100 flex items-center gap-2 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Aktif
                                        </span>
                                    @else
                                        <span
                                            class="px-4 py-2 bg-gray-50 text-slate-400 rounded-full text-[10px] font-black uppercase tracking-widest border border-gray-100 flex items-center gap-2 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-slate-300"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.tour-packages.edit', $tour) }}"
                                            class="p-3 bg-slate-50 text-slate-600 rounded-xl hover:bg-amber-50 hover:text-amber-600 transition-all border border-gray-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.tour-packages.destroy', $tour) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket wisata ini?')">
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
                        @empty
                            <tr>
                                <td colspan="5" class="px-10 py-20 text-center">
                                    <div class="flex flex-col items-center">
                                        <div
                                            class="w-20 h-20 bg-gray-50 rounded-3xl flex items-center justify-center text-slate-300 mb-6">
                                            <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4">
                                                </path>
                                            </svg>
                                        </div>
                                        <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum ada
                                            paket wisata</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if ($tours->hasPages())
            <div class="mt-10">
                {{ $tours->links() }}
            </div>
        @endif
    </div>
@endsection
