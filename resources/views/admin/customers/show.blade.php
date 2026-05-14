@extends('layouts.admin')

@section('title', 'Detail Pelanggan - ' . $customerInfo->customer_name)

@section('content')
    <div class="space-y-10 animate-fade-in pb-10">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight leading-tight uppercase">
                    Profil <span class="text-blue-500">Pelanggan</span>
                </h2>
                <p class="text-slate-500 font-semibold mt-1 italic tracking-tight">Detail lengkap profil & seluruh riwayat transaksi pelanggan.</p>
            </div>
            <a href="{{ route('admin.customers.index') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-white border border-slate-200 text-slate-600 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-50 transition-all shadow-sm">
                <i class="fa-solid fa-arrow-left"></i>
                Kembali
            </a>
        </div>

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-10">
            <!-- Left Sidebar (Profil & Dokumen) -->
            <div class="xl:col-span-1 space-y-10">
                <!-- Data Profil -->
                <div class="bg-white rounded-[2.5rem] p-8 lg:p-10 shadow-sm border border-slate-100">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-blue-500/10 border border-white/5">
                            <i class="fa-solid fa-address-card text-xl text-blue-500"></i>
                        </div>
                        <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Biodata Utama</h3>
                    </div>

                    <div class="space-y-6">
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Nama Lengkap</p>
                            <p class="text-xl font-black text-slate-900 uppercase tracking-tight leading-none">{{ $customerInfo->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">WhatsApp</p>
                            <p class="text-base font-black text-emerald-600 tracking-tight">{{ $customerInfo->customer_phone }}</p>
                        </div>
                        <div>
                            <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1.5">Email</p>
                            <p class="text-base font-black text-slate-800 tracking-tight">{{ $customerInfo->customer_email ?: '-' }}</p>
                        </div>
                        
                        <div class="pt-6 border-t border-slate-100">
                            <p class="text-[10px] font-black text-amber-500 uppercase tracking-widest mb-3">Kontak Darurat / Penjamin</p>
                            @if($customerInfo->emergency_contact_phone)
                                <p class="text-base font-black text-amber-900 mb-1 leading-none">{{ $customerInfo->emergency_contact_phone }}</p>
                                @if($customerInfo->emergency_contact_relation)
                                    <span class="inline-block px-3 py-1 bg-amber-50 text-amber-600 rounded-lg text-[10px] font-black uppercase tracking-widest border border-amber-100">
                                        {{ $customerInfo->emergency_contact_relation }}
                                    </span>
                                @endif
                            @else
                                <p class="text-sm font-bold text-slate-400 italic">Belum ada kontak darurat terdaftar.</p>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Dokumen Persyaratan -->
                <div class="bg-white rounded-[2.5rem] p-8 lg:p-10 shadow-sm border border-slate-100">
                    <div class="flex items-center gap-4 mb-8">
                        <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-500 border border-amber-100">
                            <i class="fa-solid fa-file-shield text-xl"></i>
                        </div>
                        <h3 class="text-[11px] font-black text-slate-400 uppercase tracking-[0.2em]">Dokumen Persyaratan</h3>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        @php
                            $docs = [
                                ['key' => 'doc_ktp', 'label' => 'KTP', 'icon' => 'fa-id-card'],
                                ['key' => 'doc_kk', 'label' => 'KK', 'icon' => 'fa-users'],
                                ['key' => 'doc_npwp', 'label' => 'NPWP', 'icon' => 'fa-file-invoice'],
                                ['key' => 'doc_ktp_penjamin', 'label' => 'KTP Penjamin', 'icon' => 'fa-user-shield'],
                            ];
                        @endphp
                        @foreach($docs as $doc)
                            <div class="group relative bg-slate-50 rounded-2xl p-4 border border-slate-100 hover:border-amber-300 transition-all flex flex-col items-center justify-center text-center gap-2">
                                @if($customerInfo->{$doc['key']})
                                    <div class="absolute inset-0 bg-white/50 backdrop-blur-[2px] opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl flex items-center justify-center z-10">
                                        <a href="{{ asset('storage/' . $customerInfo->{$doc['key']}) }}" target="_blank" class="w-10 h-10 bg-amber-500 text-white rounded-xl flex items-center justify-center shadow-lg hover:scale-110 transition-transform">
                                            <i class="fa-solid fa-expand"></i>
                                        </a>
                                    </div>
                                    <i class="fa-solid {{ $doc['icon'] }} text-3xl text-emerald-500 mb-1"></i>
                                    <span class="text-[10px] font-black text-slate-700 uppercase tracking-wider relative z-20">{{ $doc['label'] }}</span>
                                    <span class="text-[8px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full border border-emerald-100">Terunggah</span>
                                @else
                                    <i class="fa-solid {{ $doc['icon'] }} text-3xl text-slate-300 mb-1"></i>
                                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-wider">{{ $doc['label'] }}</span>
                                    <span class="text-[8px] font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-full">Kosong</span>
                                @endif
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Right Column (Riwayat Transaksi) -->
            <div class="xl:col-span-2 space-y-10">
                <div class="bg-white rounded-[3rem] p-8 lg:p-10 shadow-sm border border-slate-100">
                    <div class="flex items-center justify-between mb-8">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-black/10 border border-white/5 text-amber-500">
                                <i class="fa-solid fa-clock-rotate-left text-xl"></i>
                            </div>
                            <div>
                                <h3 class="text-xl font-black text-slate-900 tracking-tight leading-none mb-1">Riwayat Transaksi</h3>
                                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">{{ $transactions->count() }} Total Aktivitas</p>
                            </div>
                        </div>
                    </div>

                    <div class="overflow-x-auto no-scrollbar">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b-2 border-slate-100">
                                    <th class="py-4 pr-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] whitespace-nowrap">ID / Tanggal</th>
                                    <th class="py-4 px-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Layanan</th>
                                    <th class="py-4 px-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Total Tagihan</th>
                                    <th class="py-4 px-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Status</th>
                                    <th class="py-4 pl-6 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Detail</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-50/80">
                                @foreach($transactions as $trx)
                                <tr class="group hover:bg-slate-50/50 transition-colors">
                                    <td class="py-6 pr-6 whitespace-nowrap">
                                        <div class="text-[10px] font-black text-amber-600 uppercase tracking-widest mb-1 italic">INV-{{ str_pad($trx->id, 5, '0', STR_PAD_LEFT) }}</div>
                                        <div class="text-xs font-black text-slate-900 tracking-tight">{{ $trx->created_at->format('d M Y') }}</div>
                                    </td>
                                    <td class="py-6 px-6">
                                        <div class="text-sm font-black text-slate-800 tracking-tight leading-none mb-1">{{ $trx->service_name }}</div>
                                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $trx->service_category }}</div>
                                    </td>
                                    <td class="py-6 px-6 whitespace-nowrap">
                                        <div class="text-sm font-black text-slate-900 tracking-tight">
                                            Rp {{ number_format($trx->total_price + $trx->penalty_amount, 0, ',', '.') }}
                                            @if($trx->penalty_amount > 0)
                                                <span class="ml-1 w-2 h-2 rounded-full bg-red-500 inline-block align-middle" title="Termasuk Denda"></span>
                                            @endif
                                        </div>
                                    </td>
                                    <td class="py-6 px-6 whitespace-nowrap">
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
                                        @endphp
                                        <span class="px-3 py-1.5 {{ $colors[$trx->status] }} rounded-lg text-[9px] font-black uppercase tracking-widest border">
                                            {{ $labels[$trx->status] }}
                                        </span>
                                    </td>
                                    <td class="py-6 pl-6 text-right">
                                        <a href="{{ route('admin.transactions.show', $trx) }}" class="inline-flex items-center justify-center w-10 h-10 bg-slate-50 text-slate-400 rounded-xl hover:bg-slate-900 hover:text-amber-500 transition-all border border-slate-100 shadow-sm" title="Lihat Transaksi Ini">
                                            <i class="fa-solid fa-arrow-up-right-from-square"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
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
