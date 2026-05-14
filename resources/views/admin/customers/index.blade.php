@extends('layouts.admin')

@section('title', 'Data Pelanggan')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/10 border border-white/5">
                    <i class="fa-solid fa-users text-xl text-blue-500"></i>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase">
                        Data <span class="gold-gradient-text italic">Pelanggan</span>
                    </h2>
                    <p class="text-slate-500 font-semibold text-sm italic">
                        Daftar lengkap pelanggan dari data transaksi penyewaan.
                    </p>
                </div>
            </div>
        </div>

        <!-- Search Bar -->
        <div class="bg-white p-4 rounded-[2rem] border border-slate-100 shadow-sm flex flex-col md:flex-row gap-4">
            <form action="{{ route('admin.customers.index') }}" method="GET" class="relative flex-1">
                <input type="text" name="search" value="{{ request('search') }}"
                    placeholder="Cari nama, no whatsapp, atau darurat..."
                    class="w-full bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-amber-500/20 text-sm font-bold placeholder-slate-400 py-4 pl-12 transition-all">
                <i class="fa-solid fa-magnifying-glass text-slate-400 absolute left-4 top-1/2 -translate-y-1/2"></i>
            </form>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-[3.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <!-- Desktop View -->
            <div class="hidden md:block overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 text-slate-400">
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Profil Pelanggan</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Kontak Darurat</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Dokumen Persyaratan</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em] text-center">Total Transaksi</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em]">Transaksi Terakhir</th>
                            <th class="px-8 py-8 text-[10px] font-black uppercase tracking-[0.2em] text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50/50">
                        @forelse ($customers as $customer)
                            <tr class="group hover:bg-slate-50/30 transition-all duration-500">
                                <td class="px-8 py-10">
                                    <div class="flex items-center gap-5">
                                        <div class="w-12 h-12 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 group-hover:bg-blue-100 group-hover:text-blue-600 transition-colors border border-slate-200">
                                            <i class="fa-solid fa-user text-lg"></i>
                                        </div>
                                        <div>
                                            <div class="text-sm font-black text-slate-900 group-hover:text-blue-600 transition-colors uppercase leading-none mb-1">{{ $customer->customer_name }}</div>
                                            <div class="text-[10px] font-bold text-emerald-600 mb-1">
                                                <i class="fa-brands fa-whatsapp mr-1"></i>{{ $customer->customer_phone }}
                                            </div>
                                            @if($customer->customer_email)
                                                <div class="text-[10px] font-bold text-slate-400">
                                                    <i class="fa-solid fa-envelope mr-1"></i>{{ $customer->customer_email }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-10">
                                    @if($customer->emergency_contact_phone)
                                        <div class="text-xs font-black text-slate-700 mb-1">
                                            <i class="fa-solid fa-phone mr-1 text-slate-400"></i>{{ $customer->emergency_contact_phone }}
                                        </div>
                                        @if($customer->emergency_contact_relation)
                                        <div class="inline-flex px-2 py-0.5 bg-amber-50 text-amber-600 rounded text-[9px] font-black tracking-widest uppercase">
                                            {{ $customer->emergency_contact_relation }}
                                        </div>
                                        @endif
                                    @else
                                        <span class="text-[10px] text-slate-400 italic">Belum diisi</span>
                                    @endif
                                </td>
                                <td class="px-8 py-10">
                                    <div class="flex flex-wrap gap-2">
                                        @php
                                            $docs = ['doc_ktp' => 'KTP', 'doc_kk' => 'KK', 'doc_npwp' => 'NPWP', 'doc_ktp_penjamin' => 'PJM'];
                                        @endphp
                                        @foreach($docs as $field => $label)
                                            <a href="{{ $customer->$field ? asset('storage/' . $customer->$field) : '#' }}" 
                                                @if($customer->$field) target="_blank" @endif
                                                class="w-10 h-10 rounded-xl flex items-center justify-center text-[9px] font-black uppercase transition-all {{ $customer->$field ? 'bg-emerald-50 text-emerald-600 hover:bg-emerald-500 hover:text-white shadow-sm border border-emerald-100' : 'bg-slate-50 text-slate-300 border border-slate-100 cursor-not-allowed' }}"
                                                title="{{ $customer->$field ? 'Lihat ' . $label : $label . ' tidak tersedia' }}">
                                                {{ $label }}
                                            </a>
                                        @endforeach
                                    </div>
                                </td>
                                <td class="px-8 py-10 text-center">
                                    <div class="inline-flex items-center justify-center w-10 h-10 rounded-xl bg-slate-900 text-white font-black shadow-lg shadow-slate-900/10">
                                        {{ $customer->total_transactions }}
                                    </div>
                                    <div class="text-[9px] font-black text-slate-400 mt-2 uppercase tracking-widest">Aktivitas</div>
                                </td>
                                <td class="px-8 py-10">
                                    <div class="text-xs font-black text-slate-700">{{ $customer->created_at->format('d M Y') }}</div>
                                    <div class="text-[10px] font-bold text-slate-400">{{ $customer->created_at->format('H:i') }} WIB</div>
                                </td>
                                <td class="px-8 py-10 text-center">
                                    <a href="{{ route('admin.customers.show', $customer->customer_phone) }}" class="inline-flex items-center justify-center w-10 h-10 bg-slate-50 text-slate-400 rounded-xl hover:bg-slate-900 hover:text-blue-400 transition-all border border-slate-100 shadow-sm" title="Lihat Profil Lengkap">
                                        <i class="fa-solid fa-eye"></i>
                                    </a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-8 py-32 text-center bg-slate-50/20">
                                    <div class="w-24 h-24 bg-white rounded-full shadow-lg flex items-center justify-center mx-auto mb-6 relative z-10 border border-slate-100">
                                         <i class="fa-solid fa-users-slash text-3xl text-slate-300"></i>
                                    </div>
                                    <h3 class="text-2xl font-black text-slate-900 mb-2 uppercase">Tidak Ada Data Pelanggan</h3>
                                    <p class="text-slate-500 font-medium text-sm">Data akan muncul otomatis dari transaksi yang ada.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <!-- Mobile View -->
            <div class="md:hidden divide-y divide-slate-100/50">
                @foreach ($customers as $customer)
                    <div class="p-6 hover:bg-slate-50/50 transition-all">
                        <div class="flex items-center justify-between mb-4">
                            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight leading-none">{{ $customer->customer_name }}</h3>
                            <div class="bg-slate-900 text-white text-[10px] font-black uppercase px-3 py-1 rounded-full shadow-md">
                                {{ $customer->total_transactions }} Transaksi
                            </div>
                        </div>
                        <div class="flex items-center gap-2 mb-4 text-xs font-bold text-emerald-600">
                            <i class="fa-brands fa-whatsapp"></i> {{ $customer->customer_phone }}
                        </div>
                        
                        @if($customer->emergency_contact_phone)
                            <div class="bg-amber-50 rounded-xl p-4 mb-4 border border-amber-100">
                                <div class="text-[9px] font-black text-amber-500 uppercase tracking-widest mb-1">Kontak Darurat</div>
                                <div class="text-sm font-black text-amber-900">{{ $customer->emergency_contact_phone }}</div>
                                <div class="text-[10px] font-bold text-amber-700 italic uppercase">{{ $customer->emergency_contact_relation ?: '-' }}</div>
                            </div>
                        @endif

                        <div class="flex flex-wrap gap-2 pt-2 border-t border-slate-100">
                            @php
                                $docs = ['doc_ktp' => 'KTP', 'doc_kk' => 'KK', 'doc_npwp' => 'NPWP', 'doc_ktp_penjamin' => 'PJM'];
                            @endphp
                            @foreach($docs as $field => $label)
                                @if($customer->$field)
                                    <a href="{{ asset('storage/' . $customer->$field) }}" target="_blank"
                                        class="flex-1 py-3 px-2 rounded-xl bg-slate-900 text-white font-black text-[10px] uppercase text-center shadow-lg active:scale-95 transition-all">
                                        <i class="fa-solid fa-file-invoice mb-1 block"></i>
                                        {{ $label }}
                                    </a>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>

            @if ($customers->hasPages())
                <div class="px-10 py-12 border-t border-slate-100 bg-slate-50/50">
                    {{ $customers->links() }}
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
