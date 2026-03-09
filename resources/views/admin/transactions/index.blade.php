@extends('layouts.admin')

@section('title', 'Daftar Transaksi')

@section('content')
    <div class="space-y-10 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h2 class="text-3xl font-black text-slate-800 tracking-tight leading-tight font-heading">
                    Daftar Transaksi & Booking
                </h2>
                <p class="text-slate-500 font-semibold mt-1">Kelola semua pemesanan layanan Anda di sini.</p>
            </div>

            <div class="flex items-center gap-3">
                @if (method_exists(\App\Http\Controllers\Admin\TransactionController::class, 'create'))
                    <a href="{{ route('admin.transactions.create') }}"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-amber-500 text-white rounded-xl font-bold hover:bg-amber-600 transition">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Transaksi
                    </a>
                @else
                    <button type="button" onclick="alert('Fitur tambah transaksi belum tersedia.')"
                        class="inline-flex items-center gap-2 px-4 py-2 bg-slate-100 text-slate-600 rounded-xl font-bold"
                        title="Belum tersedia">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                        </svg>
                        Tambah Transaksi
                    </button>
                @endif
            </div>
        </div>

        <!-- Table Card -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-gray-50">
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Pelanggan
                            </th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Layanan
                            </th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Waktu Sewa
                            </th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Total
                                Harga</th>
                            <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Status
                            </th>
                            <th
                                class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">
                                Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @forelse($transactions as $transaction)
                            <tr class="group hover:bg-slate-50 transition-colors">
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-sm font-black text-slate-800">{{ $transaction->customer_name }}</span>
                                        <span
                                            class="text-[10px] font-bold text-slate-400 mt-0.5 tracking-tight italic">{{ $transaction->customer_phone }}</span>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex items-center gap-3">
                                        <div
                                            class="w-10 h-10 rounded-xl bg-slate-100 flex items-center justify-center text-slate-500">
                                            @if ($transaction->bookable_type === 'App\Models\Car')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <circle cx="8" cy="18" r="2" stroke="currentColor"
                                                        stroke-width="2" fill="none" />
                                                    <circle cx="16" cy="18" r="2" stroke="currentColor"
                                                        stroke-width="2" fill="none" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3 12h13l3-6H3z" />
                                                </svg>
                                            @elseif($transaction->bookable_type === 'App\Models\Motorcycle')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <circle cx="6" cy="19" r="2" stroke="currentColor"
                                                        stroke-width="2" fill="none" />
                                                    <circle cx="18" cy="19" r="2" stroke="currentColor"
                                                        stroke-width="2" fill="none" />
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M11 17h4l2-5 3-2" />
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span class="text-xs font-black text-slate-700 uppercase tracking-wider">
                                                @php
                                                    $type = str_replace(
                                                        'App\\Models\\',
                                                        '',
                                                        $transaction->bookable_type,
                                                    );
                                                @endphp
                                                {{ $type }}
                                            </span>
                                            <span
                                                class="text-sm font-bold text-slate-800">{{ $transaction->bookable->name ?? 'N/A' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <div class="flex flex-col">
                                        <span
                                            class="text-xs font-black text-slate-700 uppercase tracking-widest">{{ $transaction->start_date->format('d M Y') }}</span>
                                        @if ($transaction->end_date)
                                            <span class="text-[10px] font-bold text-slate-400">-
                                                {{ $transaction->end_date->format('d M Y') }}</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="px-8 py-6">
                                    <span class="text-sm font-black text-slate-900 tracking-tight">Rp
                                        {{ number_format($transaction->total_price, 0, ',', '.') }}</span>
                                </td>
                                <td class="px-8 py-6">
                                    @php
                                        $statusClasses = [
                                            'pending' => 'bg-amber-50 text-amber-600 border-amber-100',
                                            'confirmed' => 'bg-blue-50 text-blue-600 border-blue-100',
                                            'completed' => 'bg-emerald-50 text-emerald-600 border-emerald-100',
                                            'cancelled' => 'bg-rose-50 text-rose-600 border-rose-100',
                                        ];
                                    @endphp
                                    <span
                                        class="px-3 py-1 rounded-full text-[10px] font-black uppercase tracking-[0.15em] border {{ $statusClasses[$transaction->status] ?? 'bg-slate-50 text-slate-600' }}">
                                        {{ $transaction->status }}
                                    </span>
                                </td>
                                <td class="px-8 py-6 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        <a href="{{ route('admin.transactions.show', $transaction) }}"
                                            class="p-2 text-slate-400 hover:text-amber-500 transition-colors"
                                            title="Lihat Detail">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                            </svg>
                                        </a>
                                        <a href="{{ route('admin.transactions.edit', $transaction) }}"
                                            class="p-2 text-slate-400 hover:text-blue-500 transition-colors"
                                            title="Edit Status">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                            </svg>
                                        </a>
                                        <form action="{{ route('admin.transactions.destroy', $transaction) }}"
                                            method="POST"
                                            onsubmit="return confirm('Apakah Anda yakin ingin menghapus transaksi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                class="p-2 text-slate-400 hover:text-rose-500 transition-colors"
                                                title="Hapus">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-4v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-8 py-10 text-center">
                                    <div class="flex flex-col items-center justify-center space-y-3">
                                        <div
                                            class="w-16 h-16 bg-slate-50 rounded-full flex items-center justify-center text-slate-300">
                                            <svg class="w-8 h-8" fill="none" stroke="currentColor"
                                                viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                                            </svg>
                                        </div>
                                        <p class="text-sm font-black text-slate-400 uppercase tracking-widest">Belum ada
                                            transaksi</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            @if ($transactions->hasPages())
                <div class="px-8 py-6 border-t border-gray-50 bg-slate-50/50">
                    {{ $transactions->links() }}
                </div>
            @endif
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
