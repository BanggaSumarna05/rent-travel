@extends('layouts.admin')

@section('title', 'Edit Status Transaksi #' . $transaction->id)

@section('content')
    <div class="max-w-4xl space-y-10 animate-fade-in text-slate-800"
        x-data="{ status: '{{ old('status', $transaction->status) }}' }">
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
                    Edit Status <span class="text-amber-500">#{{ $transaction->id }}</span>
                </h2>
                <p class="text-slate-500 font-semibold mt-1">Perbarui kemajuan atau berikan catatan pada booking ini.</p>
            </div>
        </div>

        <form action="{{ route('admin.transactions.update', $transaction) }}" method="POST" class="space-y-10">
            @csrf
            @method('PUT')

            <div class="bg-white rounded-[3rem] p-10 lg:p-14 shadow-sm border border-gray-100">
                <div class="grid grid-cols-1 md:grid-cols-2 gap-12">
                    <!-- Status Selection -->
                    <div class="space-y-6">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Status
                            Pemesanan</label>
                        <div class="grid grid-cols-1 gap-4">
                            @foreach (['pending', 'confirmed', 'completed', 'cancelled'] as $status)
                                <label
                                    class="relative flex items-center p-6 border-2 rounded-3xl cursor-pointer transition-all duration-300"
                                    :class="status === '{{ $status }}' ? 'border-amber-500 bg-amber-50/30' : 'border-slate-50 hover:border-slate-200'">
                                    <input type="radio" name="status" value="{{ $status }}" class="sr-only"
                                        x-model="status"
                                        {{ old('status', $transaction->status) === $status ? 'checked' : '' }}>
                                    <div class="flex items-center gap-4 w-full">
                                        <div
                                            class="w-10 h-10 rounded-xl flex items-center justify-center {{ $status === 'pending'
                                                ? 'bg-amber-100 text-amber-600'
                                                : ($status === 'confirmed'
                                                    ? 'bg-blue-100 text-blue-600'
                                                    : ($status === 'completed'
                                                        ? 'bg-emerald-100 text-emerald-600'
                                                        : 'bg-rose-100 text-rose-600')) }}">
                                            @if ($status === 'pending')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif($status === 'confirmed')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                                </svg>
                                            @elseif($status === 'completed')
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M5 13l4 4L19 7" />
                                                </svg>
                                            @else
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor"
                                                    viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                        d="M6 18L18 6M6 6l12 12" />
                                                </svg>
                                            @endif
                                        </div>
                                        <div class="flex flex-col">
                                            <span
                                                class="text-sm font-black uppercase tracking-widest">{{ ucfirst($status) }}</span>
                                            <span
                                                class="text-[9px] font-bold text-slate-400 uppercase tracking-tight leading-none mt-1">
                                                {{ $status === 'pending'
                                                    ? 'Menunggu konfirmasi admin'
                                                    : ($status === 'confirmed'
                                                        ? 'Layanan sedang diproses'
                                                        : ($status === 'completed'
                                                            ? 'Penyewaan sudah selesai'
                                                            : 'Booking dibatalkan')) }}
                                            </span>
                                        </div>
                                        <div class="ml-auto" x-show="status === '{{ $status }}'" x-cloak>
                                                <svg class="w-5 h-5 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd"
                                                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                                                        clip-rule="evenodd" />
                                                </svg>
                                        </div>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <!-- Notes & Info -->
                    <div class="space-y-10">
                        <div class="space-y-6">
                        <!-- Denda Section -->
                        <div class="p-8 bg-red-50/50 rounded-[2rem] border border-red-100 shadow-sm space-y-6 mb-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-red-100 rounded-xl flex items-center justify-center text-red-600">
                                    <i class="fa-solid fa-triangle-exclamation"></i>
                                </div>
                                <h4 class="text-[11px] font-black text-red-800 uppercase tracking-widest">Sistem Denda & Keterlambatan</h4>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Nominal Denda (Rp)</label>
                                    <input type="number" name="penalty_amount" value="{{ old('penalty_amount', (int)$transaction->penalty_amount) }}" class="w-full px-8 py-5 mt-2 bg-white border border-red-200 rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all font-black text-sm tracking-tight text-slate-800" placeholder="0" min="0">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Detail Pelanggaran / Denda</label>
                                    <textarea name="penalty_details" rows="3" class="w-full px-8 py-5 mt-2 bg-white border border-red-200 rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all font-bold text-sm tracking-tight italic text-slate-800" placeholder="Contoh: Terlambat pengembalian 2 jam, body kendaraan lecet ringan...">{{ old('penalty_details', $transaction->penalty_details) }}</textarea>
                                </div>
                            </div>
                        </div>

                        <!-- Promo & Potongan Section -->
                        <div class="p-8 bg-emerald-50/50 rounded-[2rem] border border-emerald-100 shadow-sm space-y-6 mb-6">
                            <div class="flex items-center gap-3 mb-4">
                                <div class="w-10 h-10 bg-emerald-100 rounded-xl flex items-center justify-center text-emerald-600">
                                    <i class="fa-solid fa-tag"></i>
                                </div>
                                <h4 class="text-[11px] font-black text-emerald-800 uppercase tracking-widest">Promo & Potongan Harga</h4>
                            </div>
                            <div class="space-y-4">
                                <div>
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Nominal Potongan (Rp)</label>
                                    <input type="number" name="discount_amount" value="{{ old('discount_amount', (int)$transaction->discount_amount) }}" class="w-full px-8 py-5 mt-2 bg-white border border-emerald-200 rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all font-black text-sm tracking-tight text-slate-800" placeholder="0" min="0">
                                </div>
                                <div>
                                    <label class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-4">Nama Promo / Alasan Potongan</label>
                                    <input type="text" name="discount_details" value="{{ old('discount_details', $transaction->discount_details) }}" class="w-full px-8 py-5 mt-2 bg-white border border-emerald-200 rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 transition-all font-bold text-sm tracking-tight text-slate-800" placeholder="Contoh: Promo Ramadhan, Diskon Member...">
                                </div>
                            </div>
                        </div>
                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Catatan
                                Internal</label>
                            <textarea name="notes" rows="6"
                                class="w-full px-8 py-6 bg-slate-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-amber-500/20 focus:border-amber-500 transition-all font-bold text-sm tracking-tight leading-relaxed italic"
                                placeholder="Tambahkan catatan untuk admin lain atau untuk riwayat...">{{ old('notes', $transaction->notes) }}</textarea>
                        </div>

                        <div class="p-8 bg-amber-50 rounded-[2rem] border border-amber-100">
                            <div class="flex items-start gap-4">
                                <div class="p-2 bg-amber-500 rounded-lg text-white">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                </div>
                                <div>
                                    <h4 class="text-xs font-black text-amber-900 uppercase tracking-widest mb-1">Tips Admin
                                    </h4>
                                    <p
                                        class="text-[10px] font-bold text-amber-700/80 leading-relaxed uppercase tracking-tight leading-none">
                                        Perubahan status akan tercatat secara permanen. Pastikan Anda sudah memverifikasi
                                        pembayaran jika mengkonfirmasi booking.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Buttons -->
            <button type="submit"
                class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-[0.2em] uppercase hover:bg-amber-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
                Simpan Perubahan Status
            </button>
        </form>
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
