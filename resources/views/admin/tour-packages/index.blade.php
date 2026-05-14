@extends('layouts.admin')

@section('title', 'Manajemen Paket Wisata')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/10 border border-white/5">
                    <i class="fa-solid fa-map-location-dot text-xl text-[#D4AF37]"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase">
                        Daftar Paket <span class="gold-gradient-text italic">Wisata</span>
                    </h2>
                    <p class="text-slate-500 font-semibold text-sm italic">
                        Kelola data paket wisata dan informasi perjalanan.
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.tour-packages.create') }}"
                class="inline-flex items-center gap-3 px-6 py-4 bg-slate-900 text-amber-400 rounded-2xl font-bold text-sm hover:bg-amber-500 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-slate-900/10 w-full md:w-auto justify-center group border border-white/5">
                <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                Tambah Paket Baru
            </a>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 md:gap-6">
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-slate-900/20 border border-white/5">
                        <i class="fa-solid fa-layer-group text-xl text-[#D4AF37]"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Total Paket</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $totalTours }} <span class="text-xs text-slate-400">Item</span></div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <i class="fa-solid fa-circle-check text-xl text-white"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Status Publish</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $totalActive }} <span class="text-xs text-slate-400">Item</span></div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative h-full">
                <form action="{{ route('admin.tour-packages.index') }}" method="GET" class="relative items-center flex h-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari paket wisata..."
                        class="w-full bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 text-sm font-bold placeholder-slate-400 py-4 pl-12 transition-all">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 absolute left-4"></i>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-400">
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Nama Paket</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Durasi Perjalanan</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Harga Paket</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Status</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em] text-right">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50/50">
                        @forelse ($tours as $tour)
                            <tr class="group hover:bg-slate-50/30 transition-all duration-500">
                                <td class="px-8 py-10">
                                    <div class="flex items-center gap-6">
                                        <div class="relative group/img">
                                            <div class="w-24 h-24 rounded-[2rem] overflow-hidden border border-slate-100 shadow-sm relative z-10 transition-all duration-700 group-hover:scale-105 group-hover:rotate-2">
                                                <img src="{{ $tour->getFirstMediaUrl('tour_packages') ?: 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&q=80&w=200' }}"
                                                    class="w-full h-full object-cover" alt="{{ $tour->name }}">
                                            </div>
                                            <div class="absolute -inset-4 bg-amber-500/5 rounded-full blur-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
                                        </div>
                                        <div class="max-w-xs">
                                            <div class="text-xl font-black text-slate-900 tracking-tight leading-none mb-2 uppercase">{{ $tour->name }}</div>
                                            <div class="text-[10px] font-bold text-slate-400 line-clamp-1 italic tracking-tight">{{ Str::limit(strip_tags($tour->description), 50) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="flex items-center gap-3 text-[11px] font-black text-slate-600">
                                        <div class="w-9 h-9 bg-slate-50 rounded-xl flex items-center justify-center border border-slate-100 group-hover:bg-white transition-all shadow-sm">
                                            <i class="fa-solid fa-clock text-amber-500"></i>
                                        </div>
                                        <span class="uppercase italic break-all">{{ $tour->duration }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="text-xl font-black text-slate-900 tracking-tighter leading-none mb-1 group-hover:text-amber-600 transition-colors">
                                        Rp {{ number_format($tour->price, 0, ',', '.') }}
                                    </div>
                                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] italic">Harga Paket</div>
                                </td>
                                <td class="px-8 py-10">
                                    @if ($tour->status == 'active')
                                        <span class="px-5 py-2.5 bg-emerald-50 text-emerald-600 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] border border-emerald-100 flex items-center gap-3 w-fit shadow-sm shadow-emerald-500/5">
                                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse shadow-lg shadow-emerald-500/50"></span>
                                            Publish
                                        </span>
                                    @else
                                        <span class="px-5 py-2.5 bg-slate-50 text-slate-400 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] border border-slate-100 flex items-center gap-3 w-fit shadow-sm shadow-slate-900/5">
                                            <span class="w-2 h-2 bg-slate-300 rounded-full shadow-lg shadow-slate-300/50"></span>
                                            Draft
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-10">
                                    <div class="flex justify-end gap-4 overflow-hidden">
                                        <a href="{{ route('admin.tour-packages.edit', $tour) }}"
                                            class="w-12 h-12 bg-slate-900 text-amber-500 rounded-[1.25rem] flex items-center justify-center hover:bg-amber-500 hover:text-white hover:scale-110 transition-all shadow-xl shadow-slate-950/20 group/btn border border-white/5"
                                            title="Ubah Paket">
                                            <i class="fa-solid fa-pen-to-square group-hover/btn:rotate-12 transition-transform"></i>
                                        </a>
                                        <form action="{{ route('admin.tour-packages.destroy', $tour) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus paket wisata ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-12 h-12 bg-red-50 text-red-500 rounded-[1.25rem] flex items-center justify-center hover:bg-red-500 hover:text-white hover:scale-110 transition-all border border-red-100 group/btn shadow-xl shadow-red-500/10"
                                                title="Hapus Paket">
                                                <i class="fa-solid fa-trash-can group-hover/btn:-rotate-12 transition-transform"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                             <tr>
                                <td colspan="5" class="px-8 py-40 text-center bg-slate-50/20 relative overflow-hidden group">
                                    <div class="absolute inset-0 bg-gradient-to-b from-white/0 to-amber-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                                    <div class="w-32 h-32 bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 flex items-center justify-center mx-auto mb-10 relative z-10 transition-transform duration-700 group-hover:scale-110 group-hover:rotate-6">
                                         <i class="fa-solid fa-map-location text-5xl text-slate-200 group-hover:text-amber-200 transition-colors duration-700"></i>
                                    </div>
                                    <div class="relative z-10">
                                        <h3 class="text-3xl font-black text-slate-900 mb-4 tracking-tighter uppercase leading-none">Belum Ada Data Paket</h3>
                                        <p class="text-slate-500 font-bold mb-12 max-w-sm mx-auto text-sm italic tracking-tight italic">Tambahkan data paket wisata pertama Anda ke dalam sistem sekarang.</p>
                                        <a href="{{ route('admin.tour-packages.create') }}"
                                            class="inline-flex items-center gap-4 px-12 py-6 bg-slate-900 text-amber-400 rounded-[2.5rem] font-black text-[11px] uppercase tracking-[0.2em] hover:bg-amber-500 hover:text-white transition-all shadow-2xl shadow-slate-950/40 border border-white/5 active:scale-95">
                                            <i class="fa-solid fa-plus-circle text-lg"></i>
                                            Tambah Data Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View Redesign -->
            <div class="md:hidden divide-y divide-slate-100/50">
                @foreach ($tours as $tour)
                    <div class="p-8 hover:bg-slate-50/50 transition-all duration-300">
                        <div class="flex items-start gap-6 mb-8">
                            <div class="w-28 h-28 rounded-[2rem] overflow-hidden border border-slate-100 shadow-sm shrink-0">
                                <img src="{{ $tour->getFirstMediaUrl('tour_packages') ?: 'https://images.unsplash.com/photo-1502602898657-3e91760cbb34?auto=format&fit=crop&q=80&w=200' }}"
                                    class="w-full h-full object-cover" alt="{{ $tour->name }}">
                            </div>
                            <div class="flex-1 min-w-0 pt-2">
                                <h3 class="text-xl font-black text-slate-900 tracking-tight mb-2 truncate uppercase leading-none">
                                    {{ $tour->name }}
                                </h3>
                                <div class="flex items-center gap-2 mb-4">
                                    <div class="flex items-center gap-1.5 text-[9px] font-black text-slate-400 uppercase italic">
                                        <i class="fa-solid fa-clock text-amber-500"></i>
                                        {{ $tour->duration }}
                                    </div>
                                </div>
                                <div class="text-2xl font-black text-slate-900 group-hover:text-amber-600 transition-colors tracking-tighter">
                                    Rp {{ number_format($tour->price, 0, ',', '.') }}
                                </div>
                            </div>
                        </div>

                        <div class="flex items-center justify-between gap-6">
                            <div class="flex flex-wrap gap-3">
                                @if ($tour->status == 'active')
                                    <span class="px-5 py-2.5 bg-emerald-50 text-emerald-600 rounded-full text-[9px] font-black uppercase tracking-widest border border-emerald-100 flex items-center gap-2 shadow-sm">
                                        <div class="w-1.5 h-1.5 bg-emerald-500 rounded-full animate-pulse shadow-sm shadow-emerald-500"></div>
                                        Publish
                                    </span>
                                @else
                                    <span class="px-5 py-2.5 bg-slate-50 text-slate-400 rounded-full text-[9px] font-black uppercase tracking-widest border border-slate-100 flex items-center gap-2 shadow-sm">
                                        <div class="w-1.5 h-1.5 bg-slate-300 rounded-full"></div>
                                        Draft
                                    </span>
                                @endif
                            </div>
                            <div class="flex gap-4">
                                <a href="{{ route('admin.tour-packages.edit', $tour) }}" class="p-4 bg-slate-900 text-amber-400 rounded-2xl shadow-xl shadow-slate-950/20 border border-white/5">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>
                                <form action="{{ route('admin.tour-packages.destroy', $tour) }}" method="POST" onsubmit="return confirm('Hapus paket ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-4 bg-red-50 text-red-500 rounded-2xl border border-red-100 shadow-xl shadow-red-500/10">
                                        <i class="fa-solid fa-trash-can"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($tours->hasPages())
                <div class="px-10 py-12 border-t border-slate-100 bg-slate-50/50">
                    {{ $tours->links() }}
                </div>
            @endif
        </div>
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
