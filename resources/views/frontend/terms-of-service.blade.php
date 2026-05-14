@extends('layouts.frontend')

@section('title', 'Syarat dan Ketentuan - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'Syarat dan Ketentuan']]"
        badge="Aturan Layanan"
        title="Syarat dan"
        highlight="Ketentuan"
        description="Ringkasan aturan penggunaan website dan proses booking agar komunikasi antara pelanggan dan admin tetap jelas."
    />

    <section class="page-section-large bg-slate-50">
        <div class="page-shell">
            <div class="card-premium space-y-8 p-6 md:p-10">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Permintaan Booking</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Setiap pengiriman form atau chat WhatsApp dianggap sebagai permintaan booking. Jadwal baru dianggap aman setelah admin mengonfirmasi ketersediaan unit dan detail layanan.</p>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Ketersediaan dan Harga</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Harga final dapat menyesuaikan jenis unit, durasi pemakaian, lokasi, dan opsi driver. Informasi di website berfungsi sebagai acuan awal sebelum konfirmasi admin.</p>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Tanggung Jawab Pengguna</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Pelanggan wajib memberikan data yang benar dan dapat dihubungi. Untuk layanan tertentu, admin dapat meminta identitas atau informasi tambahan sebelum booking diproses lebih lanjut.</p>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Perubahan Layanan</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Perubahan tanggal, unit, atau detail perjalanan sebaiknya disampaikan secepat mungkin agar admin bisa menyesuaikan ketersediaan dan estimasi biaya.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
