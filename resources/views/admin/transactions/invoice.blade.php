<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice Transaksi INV-{{ str_pad($transaction->id, 5, '0', STR_PAD_LEFT) }}</title>
    @vite('resources/css/app.css')
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&family=Outfit:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        body { font-family: 'Inter', sans-serif; background: #fff; color: #0f172a; }
        .font-heading { font-family: 'Outfit', sans-serif; }
        @media print {
            body { background: white; margin: 0; padding: 0; }
            .no-print { display: none !important; }
            @page { margin: 1cm; size: A4; }
            .print-shadow-none { box-shadow: none !important; border-color: #e2e8f0 !important; }
            .print-bg-fill { -webkit-print-color-adjust: exact; print-color-adjust: exact; }
        }
    </style>
</head>
<body class="bg-slate-50 antialiased py-8">

    <!-- Print Controls -->
    <div class="max-w-4xl mx-auto mb-8 flex justify-end no-print px-4">
        <button onclick="window.print()" class="inline-flex items-center gap-2 bg-slate-900 text-white px-6 py-3 rounded-xl font-bold shadow-lg hover:bg-slate-800 transition-all active:scale-95 border border-slate-700">
            <i class="fa-solid fa-print"></i> Cetak Invoice / Download PDF
        </button>
    </div>

    <!-- Invoice Document -->
    <div class="max-w-4xl mx-auto bg-white p-10 lg:p-14 shadow-2xl rounded-2xl print-shadow-none print-bg-fill border border-slate-100">
        <!-- Header -->
        <div class="flex justify-between items-start mb-12 pb-8 border-b-2 border-slate-100">
            <div class="flex items-center gap-4">
                <img src="{{ \App\Models\Setting::logoUrl() }}" alt="Logo" class="h-16 object-contain">
                <div>
                    <h1 class="text-3xl font-black font-heading tracking-tight uppercase text-slate-900">{{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}</h1>
                    <p class="text-sm font-bold text-amber-600 tracking-widest uppercase">Invoice Penyewaan M-1</p>
                </div>
            </div>
            <div class="text-right">
                <div class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Invoice / Ref No.</div>
                <div class="text-2xl font-black text-slate-800 tracking-tight leading-none mb-2">INV-{{ date('Y') }}-{{ str_pad($transaction->id, 6, '0', STR_PAD_LEFT) }}</div>
                <div class="text-[10px] font-bold text-slate-500 uppercase flex items-center justify-end gap-2">
                    <i class="fa-regular fa-calendar"></i> Tanggal: {{ \Carbon\Carbon::now()->format('d M Y') }}
                </div>
            </div>
        </div>

        <!-- Info Grid -->
        <div class="grid grid-cols-2 gap-10 mb-12">
            <!-- Kepada -->
            <div class="bg-slate-50 p-6 rounded-xl border border-slate-100 print-bg-fill">
                <h3 class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Tagihan Kepada:</h3>
                <div class="space-y-1 text-sm font-bold text-slate-800">
                    <p class="text-lg font-black uppercase text-slate-900 tracking-tight">{{ $transaction->customer_name }}</p>
                    <p class="flex items-center gap-2"><i class="fa-brands fa-whatsapp text-emerald-500"></i> {{ $transaction->customer_phone }}</p>
                    @if($transaction->customer_email)
                        <p class="flex items-center gap-2 text-slate-600"><i class="fa-regular fa-envelope text-slate-400"></i> {{ $transaction->customer_email }}</p>
                    @endif
                </div>
            </div>

            <!-- Detail Transaksi -->
            <div class="bg-amber-50 p-6 rounded-xl border border-amber-100 print-bg-fill">
                <h3 class="text-[9px] font-black text-amber-700 uppercase tracking-[0.2em] mb-4">Ringkasan Transaksi:</h3>
                <div class="space-y-2 text-sm font-bold text-slate-800">
                    <div class="flex justify-between">
                        <span class="text-amber-800/70">Waktu Mulai:</span>
                        <span>{{ $transaction->start_date->format('d/m/Y') }}</span>
                    </div>
                    @if($transaction->end_date)
                    <div class="flex justify-between">
                        <span class="text-amber-800/70">Waktu Selesai:</span>
                        <span>{{ $transaction->end_date->format('d/m/Y') }}</span>
                    </div>
                    @endif
                    <div class="flex justify-between pt-2 border-t border-amber-200/50">
                        <span class="text-amber-800/70">Status Pembayaran:</span>
                        <span class="uppercase font-black text-[10px] tracking-widest px-2 py-0.5 rounded
                            @if($transaction->status == 'completed' || $transaction->status == 'confirmed') bg-emerald-100 text-emerald-700 
                            @elseif($transaction->status == 'pending') bg-amber-100 text-amber-700
                            @else bg-red-100 text-red-700 @endif print-bg-fill">
                            @if($transaction->status == 'completed' || $transaction->status == 'confirmed') LUNAS / DIKONFIRMASI 
                            @elseif($transaction->status == 'pending') MENUNGGU
                            @else DIBATALKAN @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Data -->
        <table class="w-full text-left mb-12">
            <thead>
                <tr class="bg-slate-900 text-white print-bg-fill">
                    <th class="py-4 px-6 text-[10px] font-black uppercase tracking-[0.2em] rounded-l-xl">Deskripsi Layanan</th>
                    <th class="py-4 px-6 text-[10px] font-black uppercase tracking-[0.2em] text-center">Tipe</th>
                    <th class="py-4 px-6 text-[10px] font-black uppercase tracking-[0.2em] text-right rounded-r-xl">Harga</th>
                </tr>
            </thead>
            <tbody>
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="py-6 px-6">
                        <div class="text-base font-black text-slate-900 mb-1 leading-none tracking-tight">{{ $transaction->service_name }}</div>
                        <div class="text-xs font-bold text-slate-500">{{ $transaction->bookable_type === 'TourPackage' ? 'Paket Layanan Wisata' : 'Armada Kendaraan' }}</div>
                    </td>
                    <td class="py-6 px-6 text-center">
                        <span class="inline-flex px-3 py-1 bg-slate-100 rounded text-[9px] font-black uppercase tracking-widest text-slate-600 print-bg-fill">
                            {{ $transaction->service_category }}
                        </span>
                    </td>
                    <td class="py-6 px-6 text-right font-black text-lg tracking-tighter text-slate-900">
                        @if($transaction->bookable_type === 'TourPackage')
                            Rp {{ number_format($transaction->total_price, 0, ',', '.') }}
                        @else
                            Rp {{ number_format($transaction->bookable->price_per_day ?? current(explode(' - ', $transaction->total_price)), 0, ',', '.') }} <span class="text-xs text-slate-400 font-bold ml-1 tracking-normal">/ hari</span>
                        @endif
                    </td>
                </tr>
                @if($transaction->driver_option && $transaction->bookable_type !== 'TourPackage')
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-6">
                        <div class="text-sm font-black text-slate-800">Tambahan Operasional</div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <span class="inline-flex px-2 py-0.5 bg-blue-50 text-blue-600 rounded text-[9px] font-black uppercase tracking-widest print-bg-fill">Opsi Driver</span>
                    </td>
                    <td class="py-4 px-6 text-right font-bold text-sm text-slate-600">
                        {{ $transaction->driver_option == 'lepas_kunci' ? 'Lepas Kunci (Tanpa Driver)' : 'Termasuk Driver' }}
                    </td>
                </tr>
                @endif
                @if($transaction->location)
                <tr class="border-b border-slate-100 hover:bg-slate-50 transition-colors">
                    <td class="py-4 px-6">
                        <div class="text-sm font-black text-slate-800">Lokasi Penjemputan / Pengantaran</div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <i class="fa-solid fa-location-dot text-slate-400"></i>
                    </td>
                    <td class="py-4 px-6 text-right font-bold text-sm text-slate-600">
                        {{ $transaction->location }}
                    </td>
                </tr>
                @endif
                @if($transaction->penalty_amount > 0)
                <tr class="border-b-2 border-red-100 bg-red-50/30 print-bg-fill transition-colors">
                    <td class="py-4 px-6">
                        <div class="text-sm font-black text-red-700">Denda / Biaya Tambahan</div>
                        <div class="text-[10px] font-bold text-red-500 italic mt-0.5">{{ $transaction->penalty_details ?: 'Keterlambatan/Kerusakan' }}</div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <i class="fa-solid fa-triangle-exclamation text-red-400"></i>
                    </td>
                    <td class="py-4 px-6 text-right font-black text-sm text-red-600">
                        + Rp {{ number_format($transaction->penalty_amount, 0, ',', '.') }}
                    </td>
                </tr>
                @endif
                @if($transaction->discount_amount > 0)
                <tr class="border-b-2 border-emerald-100 bg-emerald-50/30 print-bg-fill transition-colors">
                    <td class="py-4 px-6">
                        <div class="text-sm font-black text-emerald-700">Potongan / Promo</div>
                        <div class="text-[10px] font-bold text-emerald-500 italic mt-0.5">{{ $transaction->discount_details ?: 'Diskon Spesial' }}</div>
                    </td>
                    <td class="py-4 px-6 text-center">
                        <i class="fa-solid fa-tag text-emerald-400"></i>
                    </td>
                    <td class="py-4 px-6 text-right font-black text-sm text-emerald-600">
                        - Rp {{ number_format($transaction->discount_amount, 0, ',', '.') }}
                    </td>
                </tr>
                @endif
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2" class="py-6 px-6 text-right text-[10px] font-black uppercase tracking-[0.2em] text-slate-500">
                        Total Pembayaran
                    </td>
                    <td class="py-6 px-6 text-right">
                        <div class="text-2xl font-black text-amber-500 tracking-tighter">Rp {{ number_format($transaction->total_price + $transaction->penalty_amount - $transaction->discount_amount, 0, ',', '.') }}</div>
                    </td>
                </tr>
            </tfoot>
        </table>

        <!-- Footer / Signature -->
        <div class="grid grid-cols-2 gap-8 pt-8">
            <div class="text-xs font-bold text-slate-500 leading-relaxed italic pr-12">
                * Pembayaran dianggap sah jika telah masuk ke rekening resmi perusahaan. <br>
                * Jika terdapat perubahan jadwal penyewaan, harap segera menghubungi tim administrasi.
            </div>
            <div class="text-center ml-auto w-48 flex flex-col items-center">
                <p class="text-[10px] font-black uppercase tracking-widest text-slate-400 mb-2">Hormat Kami,</p>
                <img src="{{ asset('ttd.png') }}" alt="Tanda Tangan" class="h-24 object-contain -my-4 relative z-10">
                <div class="border-b-2 border-slate-200 mb-2 w-full"></div>
                <p class="text-xs font-black uppercase text-slate-800">{{ \App\Models\Setting::get('site_name', 'CJA RENT CAR') }}</p>
                <p class="text-[9px] font-bold text-slate-500 tracking-widest">ADMINISTRATOR</p>
            </div>
        </div>
    </div>
</body>
</html>
