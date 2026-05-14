@extends('layouts.admin')

@section('title', 'Manajemen Transaksi')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/10 border border-white/5">
                    <i class="fa-solid fa-file-invoice-dollar text-xl text-[#D4AF37]"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase">
                        Monitoring <span class="gold-gradient-text italic">Transaksi</span>
                    </h2>
                    <p class="text-slate-500 font-semibold text-sm italic">
                        Kelola data transaksi dan status pemesanan layanan.
                    </p>
                </div>
            </div>
            
            <div class="flex flex-wrap gap-4 w-full md:w-auto">
                <div class="flex gap-2 w-full md:w-auto">
                     <a href="{{ route('admin.transactions.export.excel', request()->query()) }}" 
                        class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-4 bg-emerald-600 text-white rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-emerald-700 transition-all shadow-lg shadow-emerald-600/20">
                        <i class="fa-solid fa-file-excel"></i>
                        Excel
                    </a>
                    <a href="{{ route('admin.transactions.export.pdf', request()->query()) }}" 
                        class="flex-1 md:flex-none inline-flex items-center justify-center gap-2 px-5 py-4 bg-red-600 text-white rounded-2xl font-bold text-xs uppercase tracking-widest hover:bg-red-700 transition-all shadow-lg shadow-red-600/20">
                        <i class="fa-solid fa-file-pdf"></i>
                        PDF
                    </a>
                </div>
                <a href="{{ route('admin.transactions.create') }}"
                    class="inline-flex items-center gap-3 px-6 py-4 bg-slate-900 text-amber-400 rounded-2xl font-bold text-sm hover:bg-amber-500 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-slate-900/10 w-full md:w-auto justify-center group border border-white/5">
                    <i class="fa-solid fa-plus group-hover:rotate-90 transition-transform duration-300"></i>
                    Input Manual
                </a>
            </div>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-slate-900/20 border border-white/5">
                        <i class="fa-solid fa-receipt text-xl text-[#D4AF37]"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Total Pesanan</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $totalTransactions }} <span class="text-xs text-slate-400">Pesanan</span></div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <i class="fa-solid fa-clock text-xl text-white"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Menunggu</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $pendingTransactions }} <span class="text-xs text-slate-400">Pesanan</span></div>
                    </div>
                </div>
            </div>
             <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-blue-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-blue-500 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                        <i class="fa-solid fa-check-double text-xl text-white"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Dikonfirmasi</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $confirmedTransactions }} <span class="text-xs text-slate-400">Pesanan</span></div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-emerald-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-emerald-500 rounded-2xl flex items-center justify-center shadow-lg shadow-emerald-500/20">
                        <i class="fa-solid fa-money-bill-trend-up text-xl text-white"></i>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Estimasi Omzet</div>
                        <div class="text-lg font-black text-slate-900 tracking-tight italic">Rp {{ number_format($totalRevenue,0,',','.') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="bg-white p-4 rounded-[2.5rem] border border-slate-100 shadow-sm">
            <form action="{{ route('admin.transactions.index') }}" method="GET" class="flex flex-col lg:flex-row gap-4">
                <!-- Search Box -->
                <div class="relative flex-1">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari pelanggan, layanan, atau no. HP..."
                        class="w-full bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 text-sm font-bold placeholder-slate-400 py-4 pl-12 transition-all">
                    <i class="fa-solid fa-magnifying-glass text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
                </div>

                <!-- Filters -->
                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3 lg:w-auto">
                    <!-- Month -->
                    <select name="month" class="bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 text-xs font-black uppercase py-4 px-4 appearance-none cursor-pointer">
                        <option value="">Bulan (Semua)</option>
                        @foreach(range(1, 12) as $m)
                            <option value="{{ $m }}" {{ request('month') == $m ? 'selected' : '' }}>
                                {{ \Carbon\Carbon::create()->month($m)->isoFormat('MMMM') }}
                            </option>
                        @endforeach
                    </select>

                    <!-- Year -->
                    <select name="year" class="bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 text-xs font-black uppercase py-4 px-4 appearance-none cursor-pointer">
                        <option value="">Tahun (Semua)</option>
                        @foreach($availableYears as $year)
                            <option value="{{ $year }}" {{ request('year') == $year ? 'selected' : '' }}>{{ $year }}</option>
                        @endforeach
                    </select>

                    <!-- Status -->
                    <select name="status" class="bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 text-xs font-black uppercase py-4 px-4 appearance-none cursor-pointer">
                        <option value="">Status (Semua)</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Menunggu</option>
                        <option value="confirmed" {{ request('status') == 'confirmed' ? 'selected' : '' }}>Dikonfirmasi</option>
                        <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Selesai</option>
                        <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Dibatalkan</option>
                    </select>

                    <!-- Action Buttons -->
                    <div class="flex gap-2">
                        <button type="submit" class="flex-1 bg-slate-900 text-amber-500 rounded-2xl hover:bg-amber-500 hover:text-white transition-all shadow-lg active:scale-95">
                            <i class="fa-solid fa-filter"></i>
                        </button>
                        @if(request()->anyFilled(['search', 'month', 'year', 'status']))
                            <a href="{{ route('admin.transactions.index') }}" class="flex-1 inline-flex items-center justify-center bg-slate-100 text-slate-400 rounded-2xl hover:bg-slate-200 transition-all border border-slate-200 active:scale-95">
                                <i class="fa-solid fa-rotate-left"></i>
                            </a>
                        @endif
                    </div>
                </div>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-[3.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <!-- Desktop Table View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-400">
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Data Pelanggan</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Layanan & Unit</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Periode</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Total Tagihan</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Status</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50/50">
                        @forelse ($transactions as $trx)
                            <tr class="group hover:bg-slate-50/30 transition-all duration-500">
                                <td class="px-8 py-10">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 group-hover:bg-amber-100 group-hover:text-amber-600 transition-colors border border-slate-200">
                                            <i class="fa-solid fa-user text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-slate-900 group-hover:text-amber-600 transition-colors uppercase leading-none mb-1">{{ $trx->customer_name }}</div>
                                            <div class="text-[10px] font-bold text-slate-400 italic">{{ $trx->customer_phone }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="text-xs font-black text-slate-700 uppercase tracking-tight mb-1">{{ $trx->service_name }}</div>
                                    <div class="inline-flex px-2 py-0.5 bg-slate-100 rounded text-[9px] font-black text-slate-400 uppercase tracking-[0.1em] italic">{{ $trx->service_category }}</div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="flex items-center gap-3 text-[10px] font-black text-slate-600 italic">
                                        <i class="fa-solid fa-calendar-day text-amber-500 text-sm"></i>
                                        <div>
                                            {{ $trx->start_date->format('d/m/Y') }}
                                            @if($trx->end_date)
                                                <span class="text-slate-300 mx-1">-</span>
                                                {{ $trx->end_date->format('d/m/Y') }}
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="text-base font-black text-slate-900 tracking-tighter">
                                        Rp {{ number_format($trx->total_price + $trx->penalty_amount - $trx->discount_amount, 0, ',', '.') }}
                                        @if($trx->penalty_amount > 0)
                                            <i class="fa-solid fa-triangle-exclamation text-red-500 text-[10px] ml-1" title="Ada Denda"></i>
                                        @endif
                                        @if($trx->discount_amount > 0)
                                            <i class="fa-solid fa-tag text-emerald-500 text-[10px] ml-1" title="Ada Potongan"></i>
                                        @endif
                                    </div>
                                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-none mt-1">Total Tagihan</div>
                                </td>
                                <td class="px-8 py-10">
                                    @php
                                        $colors = [
                                            'pending'   => 'bg-amber-50 text-amber-600 border-amber-100',
                                            'confirmed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                            'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'cancelled' => 'bg-red-50 text-red-600 border-red-100',
                                        ];
                                        $labels = [
                                            'pending'   => 'Menunggu',
                                            'confirmed' => 'Dikonfirmasi',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                        ];
                                        $icons = [
                                            'pending'   => 'fa-clock',
                                            'confirmed' => 'fa-circle-check',
                                            'completed' => 'fa-circle-check',
                                            'cancelled' => 'fa-circle-xmark',
                                        ];
                                    @endphp
                                    <span class="px-4 py-2 {{ $colors[$trx->status] }} rounded-2xl text-[9px] font-black uppercase tracking-[0.2em] border flex items-center gap-2 w-fit shadow-sm shadow-slate-900/5">
                                        <i class="fa-solid {{ $icons[$trx->status] }} {{ $trx->status == 'pending' ? 'animate-pulse' : '' }}"></i>
                                        {{ $labels[$trx->status] }}
                                    </span>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.transactions.invoice', $trx) }}" target="_blank"
                                            class="w-10 h-10 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-emerald-500 transition-all border border-slate-100 shadow-sm"
                                            title="Cetak Invoice">
                                            <i class="fa-solid fa-print"></i>
                                        </a>
                                        <a href="{{ route('admin.transactions.show', $trx) }}"
                                            class="w-10 h-10 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-amber-500 transition-all border border-slate-100 shadow-sm"
                                            title="Detail Transaksi">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.transactions.edit', $trx) }}"
                                            class="w-10 h-10 bg-slate-50 text-slate-400 rounded-xl flex items-center justify-center hover:bg-slate-900 hover:text-amber-500 transition-all border border-slate-100 shadow-sm"
                                            title="Kelola Status">
                                            <i class="fa-solid fa-file-pen"></i>
                                        </a>
                                        <form action="{{ route('admin.transactions.destroy', $trx) }}" method="POST" onsubmit="return confirm('Hapus transaksi ini secara permanen?')">
                                            @csrf @method('DELETE')
                                            <button type="submit"
                                                class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white hover:scale-110 transition-all border border-red-100 shadow-xl shadow-red-500/10"
                                                title="Hapus Transaksi">
                                                <i class="fa-solid fa-trash-can"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-40 text-center bg-slate-50/20 relative overflow-hidden group">
                                    <div class="absolute inset-0 bg-gradient-to-b from-white/0 to-amber-500/5 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                                    <div class="w-32 h-32 bg-white rounded-[3rem] shadow-2xl shadow-slate-200/50 border border-slate-100 flex items-center justify-center mx-auto mb-10 relative z-10 transition-transform duration-700 group-hover:scale-110 group-hover:rotate-6">
                                         <i class="fa-solid fa-receipt text-5xl text-slate-200 group-hover:text-amber-200 transition-colors duration-700"></i>
                                    </div>
                                    <div class="relative z-10">
                                        <h3 class="text-3xl font-black text-slate-900 mb-4 tracking-tighter uppercase leading-none">Belum Ada Transaksi</h3>
                                        <p class="text-slate-500 font-bold mb-12 max-w-sm mx-auto text-sm italic tracking-tight italic">Data pesanan pelanggan akan muncul secara otomatis di sini.</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View Redesign -->
            <div class="md:hidden divide-y divide-slate-100/50">
                @foreach ($transactions as $trx)
                    <div class="p-8 hover:bg-slate-50/50 transition-all">
                        <div class="flex justify-between items-start mb-8">
                            <div>
                                <div class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-2 italic">INV-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</div>
                                <h3 class="text-xl font-black text-slate-900 leading-none mb-1 uppercase tracking-tight">{{ $trx->customer_name }}</h3>
                                <div class="text-[10px] font-bold text-slate-400 italic tracking-tight">{{ $trx->customer_phone }}</div>
                            </div>
                            <span class="px-4 py-2 {{ $colors[$trx->status] }} rounded-2xl text-[8px] font-black uppercase tracking-widest border shadow-sm">
                                <i class="fa-solid {{ $icons[$trx->status] }} mr-1"></i>
                                {{ $labels[$trx->status] }}
                            </span>
                        </div>

                        <div class="bg-slate-50 rounded-[1.5rem] p-6 mb-8 border border-slate-100 shadow-sm">
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Layanan</span>
                                <span class="text-[11px] font-black text-slate-800 uppercase italic">{{ $trx->service_name }}</span>
                            </div>
                            <div class="flex justify-between items-center mb-4">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Periode</span>
                                <span class="text-[10px] font-black text-slate-600 italic">{{ $trx->start_date->format('d M') }} - {{ $trx->end_date ? $trx->end_date->format('d M') : 'H+0' }}</span>
                            </div>
                            <div class="flex justify-between items-center pt-4 border-t border-slate-200/50">
                                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Tagihan</span>
                                <span class="text-lg font-black text-slate-900 tracking-tighter">
                                    Rp {{ number_format($trx->total_price + $trx->penalty_amount - $trx->discount_amount, 0, ',', '.') }}
                                    @if($trx->penalty_amount > 0)
                                        <span class="ml-1 text-[10px] text-red-500 font-black italic">+Denda</span>
                                    @endif
                                    @if($trx->discount_amount > 0)
                                        <span class="ml-1 text-[10px] text-emerald-500 font-black italic">-Disc</span>
                                    @endif
                                </span>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <a href="{{ route('admin.transactions.show', $trx) }}" class="flex-1 py-4 bg-slate-900 text-amber-500 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] text-center shadow-xl shadow-slate-950/20 border border-white/5 active:scale-95 transition-all">
                                <i class="fa-solid fa-eye mr-2"></i>
                                Detail
                            </a>
                            <form action="{{ route('admin.transactions.destroy', $trx) }}" method="POST" class="flex-none" onsubmit="return confirm('Hapus transaksi ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="w-14 h-14 bg-red-50 text-red-500 rounded-2xl flex items-center justify-center border border-red-100 shadow-xl shadow-red-500/10 active:scale-95 transition-all">
                                    <i class="fa-solid fa-trash-can"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($transactions->hasPages())
                <div class="px-10 py-12 border-t border-slate-100 bg-slate-50/50">
                    {{ $transactions->links() }}
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
