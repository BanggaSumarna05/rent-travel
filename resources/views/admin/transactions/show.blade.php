@extends('layouts.admin')

@section('title', 'Detail Transaksi #' . $transaction->id)

@section('content')
    <div class="max-w-4xl space-y-10 animate-fade-in text-slate-800">
        <!-- Header Section -->
        <div class="flex items-center gap-4 mb-4">
            <a href="{{ route('admin.transactions.index') }}"
                class="p-3 bg-white rounded-xl border border-gray-100 text-slate-400 hover:text-amber-600 hover:border-amber-100 transition-all shadow-sm group">
                <svg class="w-5 h-5 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor"
                    viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" />
                </svg>
            </a>
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight leading-tight font-heading">
                    Detail Transaksi <span class="text-amber-500">#{{ $transaction->id }}</span>
                </h2>
                <p class="text-slate-500 font-semibold mt-1">Dibuat pada
                    {{ $transaction->created_at->format('d M Y, H:i') }}</p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            <!-- Customer & Status Info -->
            <div class="md:col-span-2 space-y-10">
                <!-- Main Details Card -->
                <div class="bg-white rounded-[3rem] p-10 lg:p-14 shadow-sm border border-gray-100">
                    <div class="space-y-12">
                        <!-- Customer Info -->
                        <div>
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Informasi
                                Pelanggan</h3>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Nama Lengkap
                                    </p>
                                    <p class="text-lg font-black text-slate-800">{{ $transaction->customer_name }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Nomor WhatsApp
                                    </p>
                                    <p class="text-lg font-black text-slate-800">{{ $transaction->customer_phone }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Email</p>
                                    <p class="text-lg font-black text-slate-800">{{ $transaction->customer_email ?? '-' }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Service Info -->
                        <div class="pt-10 border-t border-gray-50">
                            <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Layanan &
                                Jadwal</h3>
                            <div class="flex items-start gap-6 mb-8">
                                <div
                                    class="w-20 h-20 rounded-2xl bg-slate-50 flex items-center justify-center border border-gray-100 overflow-hidden">
                                    @php $bookable = $transaction->bookable; @endphp
                                    @if ($bookable && method_exists($bookable, 'getFirstMediaUrl'))
                                        <img src="{{ $bookable->getFirstMediaUrl(request()->segment(2) ?? 'cars') }}"
                                            class="w-full h-full object-cover">
                                    @else
                                        <svg class="w-10 h-10 text-slate-300" fill="none" stroke="currentColor"
                                            viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 00-2 2z" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="flex-1">
                                    <p class="text-[10px] font-black text-amber-600 uppercase tracking-[0.2em] mb-1">
                                        {{ str_replace('App\\Models\\', '', $transaction->bookable_type) }}
                                    </p>
                                    <h4 class="text-xl font-black text-slate-800 tracking-tight">
                                        {{ $bookable->name ?? 'N/A' }}</h4>
                                    <p class="text-sm font-bold text-slate-400 mt-1 italic italic">
                                        @if ($transaction->bookable_type === 'App\Models\Car')
                                            {{ $bookable->brand ?? '' }} • {{ $bookable->transmission ?? '' }}
                                        @elseif($transaction->bookable_type === 'App\Models\Motorcycle')
                                            {{ $bookable->brand ?? '' }} • {{ $bookable->engine_capacity ?? '' }}cc
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Tanggal Mulai
                                    </p>
                                    <p class="text-lg font-black text-slate-800">
                                        {{ $transaction->start_date->format('d F Y') }}</p>
                                </div>
                                <div class="space-y-1">
                                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-wider">Tanggal
                                        Selesai</p>
                                    <p class="text-lg font-black text-slate-800">
                                        {{ $transaction->end_date ? $transaction->end_date->format('d F Y') : '-' }}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Notes Info -->
                        @if ($transaction->notes)
                            <div class="pt-10 border-t border-gray-50">
                                <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-4">Catatan
                                    Tambahan</h3>
                                <div
                                    class="p-6 bg-slate-50 rounded-3xl text-sm font-bold text-slate-600 leading-relaxed italic italic">
                                    "{!! nl2br(e($transaction->notes)) !!}"
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Status & Price Column -->
            <div class="space-y-10">
                <!-- Price Card -->
                <div class="bg-slate-900 rounded-[2.5rem] p-10 shadow-xl shadow-slate-200">
                    <p class="text-[10px] font-black text-amber-500/60 uppercase tracking-widest mb-2">Total Harga</p>
                    <h3 class="text-3xl font-black text-white tracking-tighter leading-none mb-1">Rp
                        {{ number_format($transaction->total_price, 0, ',', '.') }}</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-4 flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                        Estimasi Berhasil
                    </p>
                </div>

                <!-- Status Card -->
                <div class="bg-white rounded-[2.5rem] p-10 shadow-sm border border-gray-100">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-6">Status Transaksi</h3>
                    <div class="space-y-6">
                        @php
                            $statusClasses = [
                                'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                'confirmed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                            ];
                        @endphp
                        <div
                            class="inline-flex px-6 py-3 rounded-2xl text-xs font-black uppercase tracking-[0.2em] border {{ $statusClasses[$transaction->status] ?? 'bg-slate-50 text-slate-600' }}">
                            {{ $transaction->status }}
                        </div>

                        <a href="{{ route('admin.transactions.edit', $transaction) }}"
                            class="flex items-center justify-center gap-2 w-full py-4 bg-slate-50 text-slate-600 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-900 hover:text-white transition-all duration-300">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                            </svg>
                            Ganti Status
                        </a>

                        <hr class="border-gray-50">

                        <!-- WhatsApp Action -->
                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $transaction->customer_phone) }}"
                            target="_blank"
                            class="flex items-center justify-center gap-2 w-full py-4 bg-[#25D366] text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:shadow-lg hover:shadow-green-200 transition-all duration-300">
                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                <path
                                    d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.588-5.946 0-6.556 5.332-11.891 11.891-11.891 3.181 0 6.167 1.24 8.413 3.488 2.246 2.248 3.484 5.232 3.484 8.403 0 6.556-5.332 11.891-11.891 11.891-2.093 0-4.141-.544-5.945-1.587l-6.052 1.587zm6.756-3.832l.36.214c1.428.847 3.078 1.295 4.766 1.295 4.966 0 9.009-4.043 9.009-9.006 0-2.427-.945-4.708-2.661-6.425s-4-2.659-6.425-2.659c-4.967 0-9.01 4.043-9.01 9.007 0 1.689.448 3.34 1.296 4.766l.214.36-1.026 3.744 3.847-1.027z" />
                            </svg>
                            Hubungi via WA
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
