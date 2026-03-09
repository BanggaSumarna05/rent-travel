@extends('layouts.admin')

@section('title', 'Manajemen Motor')

@section('content')
    <div class="space-y-10 animate-in fade-in duration-700">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-800 font-heading tracking-tighter">Daftar Armada Motor</h2>
                <p class="text-slate-400 font-medium mt-1">Kelola inventaris motor premium dan performa mesinnya.</p>
            </div>
            <a href="{{ route('admin.motorcycles.create') }}"
                class="flex items-center gap-3 px-8 py-4 bg-blue-500 text-white rounded-2xl font-black text-sm hover:bg-blue-600 transition-all shadow-lg shadow-blue-500/20 active:scale-95">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6">
                    </path>
                </svg>
                Tambah Motor Baru
            </a>
        </div>

        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-gray-50/50 border-b border-gray-100">
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Info
                                Motor</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">
                                Kapasitas Mesin</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Harga
                                Sewa</th>
                            <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status
                            </th>
                            <th
                                class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach ($motorcycles as $motor)
                            <tr class="group hover:bg-slate-50/50 transition-colors">
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-6">
                                        <div
                                            class="w-20 h-20 rounded-2xl overflow-hidden border border-gray-100 shadow-sm shrink-0">
                                            <img src="{{ $motor->getFirstMediaUrl('motorcycles') ?: 'https://images.unsplash.com/photo-1558981806-ec527fa84c39?auto=format&fit=crop&q=80&w=200' }}"
                                                class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                        </div>
                                        <div>
                                            <div class="text-lg font-black text-slate-800 tracking-tight leading-none mb-2">
                                                {{ $motor->name }}</div>
                                            <div class="text-[10px] font-black text-blue-600 uppercase tracking-widest">
                                                {{ $motor->brand }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="flex items-center gap-3 text-sm font-black text-slate-600">
                                        <div
                                            class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-600">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                            </svg>
                                        </div>
                                        {{ $motor->engine_capacity }}cc
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    <div class="text-lg font-black text-slate-800 tracking-tighter">Rp
                                        {{ number_format($motor->price_per_day, 0, ',', '.') }}</div>
                                    <div class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Per Hari
                                    </div>
                                </td>
                                <td class="px-10 py-8">
                                    @if ($motor->status == 'active')
                                        <span
                                            class="px-4 py-2 bg-emerald-50 text-emerald-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-emerald-100 flex items-center gap-2 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-emerald-500 animate-pulse"></span>
                                            Tersedia
                                        </span>
                                    @else
                                        <span
                                            class="px-4 py-2 bg-red-50 text-red-600 rounded-full text-[10px] font-black uppercase tracking-widest border border-red-100 flex items-center gap-2 w-fit">
                                            <span class="w-1.5 h-1.5 rounded-full bg-red-500"></span>
                                            Non-Aktif
                                        </span>
                                    @endif
                                </td>
                                <td class="px-10 py-8 text-right">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.motorcycles.edit', $motor) }}"
                                            class="p-3 bg-slate-50 text-slate-600 rounded-xl hover:bg-blue-50 hover:text-blue-600 transition-all border border-gray-100">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z">
                                                </path>
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.motorcycles.destroy', $motor) }}" method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus motor ini?')">
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
