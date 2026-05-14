@extends('layouts.admin')

@section('title', 'Manajemen FAQ')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/10 border border-white/5">
                    <i class="fa-solid fa-circle-question text-xl text-[#D4AF37]"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase">
                        Pusat <span class="gold-gradient-text italic">Informasi (FAQ)</span>
                    </h2>
                    <p class="text-slate-500 font-semibold text-sm italic">
                        Kelola daftar pertanyaan dan jawaban seputar layanan Anda.
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.faqs.create') }}"
                class="inline-flex items-center gap-3 px-6 py-4 bg-slate-900 text-amber-400 rounded-2xl font-bold text-sm hover:bg-amber-500 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-slate-900/10 w-full md:w-auto justify-center group border border-white/5">
                <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                Tambah FAQ Baru
            </a>
        </div>

        <!-- Quick Stats & Search -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 md:gap-6">
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-slate-900/20 border border-white/5">
                        <i class="fa-solid fa-layer-group text-xl text-[#D4AF37]"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Total FAQ</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $totalFaqs }} <span class="text-xs text-slate-400">Item</span></div>
                    </div>
                </div>
            </div>
            
            <div class="md:col-span-2 bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative h-full">
                <form action="{{ route('admin.faqs.index') }}" method="GET" class="relative items-center flex h-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari pertanyaan atau jawaban..."
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
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em] w-1/3">Pertanyaan (Question)</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Jawaban (Answer)</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em] text-right">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50/50">
                        @forelse ($faqs as $faq)
                            <tr class="group hover:bg-slate-50/30 transition-all duration-500">
                                <td class="px-8 py-10">
                                    <div class="text-sm font-black text-slate-900 group-hover:text-amber-600 transition-colors leading-tight uppercase">
                                        {{ $faq->question }}
                                    </div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="text-[11px] font-medium text-slate-500 line-clamp-3 italic leading-relaxed">
                                        {{ $faq->answer }}
                                    </div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="flex justify-end gap-3 overflow-hidden">
                                        <a href="{{ route('admin.faqs.edit', $faq) }}"
                                            class="w-10 h-10 bg-slate-900 text-amber-500 rounded-xl flex items-center justify-center hover:bg-amber-500 hover:text-white hover:scale-110 transition-all shadow-xl shadow-slate-950/20 group/btn border border-white/5"
                                            title="Ubah FAQ">
                                            <i class="fa-solid fa-pen-to-square group-hover/btn:rotate-12 transition-transform"></i>
                                        </a>
                                        <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white hover:scale-110 transition-all border border-red-100 group/btn shadow-xl shadow-red-500/10"
                                                title="Hapus Unit">
                                                <i class="fa-solid fa-trash-can group-hover/btn:-rotate-12 transition-transform"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                             <tr>
                                <td colspan="3" class="px-8 py-40 text-center bg-slate-50/20 relative overflow-hidden group">
                                    <div class="absolute inset-0 bg-gradient-to-b from-white/0 to-amber-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                                    <div class="w-32 h-32 bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 flex items-center justify-center mx-auto mb-10 relative z-10 transition-transform duration-700 group-hover:scale-110 group-hover:rotate-6">
                                         <i class="fa-solid fa-clipboard-question text-5xl text-slate-200 group-hover:text-amber-200 transition-colors duration-700"></i>
                                    </div>
                                    <div class="relative z-10">
                                        <h3 class="text-3xl font-black text-slate-900 mb-4 tracking-tighter uppercase leading-none">Belum Ada FAQ</h3>
                                        <p class="text-slate-500 font-bold mb-12 max-w-sm mx-auto text-sm italic tracking-tight italic">Tambahkan FAQ untuk memudahkan pelanggan memahami layanan Anda.</p>
                                        <a href="{{ route('admin.faqs.create') }}"
                                            class="inline-flex items-center gap-4 px-12 py-6 bg-slate-900 text-amber-400 rounded-[2.5rem] font-black text-[11px] uppercase tracking-[0.2em] hover:bg-amber-500 hover:text-white transition-all shadow-2xl shadow-slate-950/40 border border-white/5 active:scale-95">
                                            <i class="fa-solid fa-plus-circle text-lg"></i>
                                            Tambah FAQ Pertama
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
                @foreach ($faqs as $faq)
                    <div class="p-8 hover:bg-slate-50/50 transition-all duration-300 group">
                        <div class="mb-4">
                            <div class="text-[9px] font-black text-amber-500 uppercase tracking-widest mb-2 italic">Pertanyaan</div>
                            <h3 class="text-lg font-black text-slate-900 tracking-tight leading-tight uppercase italic group-hover:text-amber-600 transition-colors">
                                {{ $faq->question }}
                            </h3>
                        </div>
                        <div class="mb-8 bg-slate-50 p-6 rounded-[1.5rem] border border-slate-100 shadow-sm transition-all hover:bg-white">
                            <div class="text-[9px] font-black text-slate-300 uppercase tracking-widest mb-2 italic">Jawaban</div>
                            <p class="text-sm font-medium text-slate-600 italic leading-relaxed">
                                {{ $faq->answer }}
                            </p>
                        </div>
                        <div class="flex justify-end gap-4">
                            <a href="{{ route('admin.faqs.edit', $faq) }}" class="p-4 bg-slate-900 text-amber-400 rounded-2xl shadow-xl shadow-slate-950/20 border border-white/5">
                                <i class="fa-solid fa-pen-to-square"></i>
                            </a>
                            <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Hapus FAQ ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="p-4 bg-red-50 text-red-500 rounded-2xl border border-red-100 shadow-xl shadow-red-500/10">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($faqs->hasPages())
                <div class="px-10 py-12 border-t border-slate-100 bg-slate-50/50">
                    {{ $faqs->links() }}
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
