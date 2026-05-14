@extends('layouts.frontend')

@section('title', 'Kebijakan Privasi - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'Kebijakan Privasi']]"
        badge="Informasi Privasi"
        title="Kebijakan"
        highlight="Privasi"
        description="Penjelasan singkat tentang data yang kami terima, tujuan penggunaannya, dan cara kami menjaga informasi pelanggan."
    />

    <section class="page-section-large bg-slate-50">
        <div class="page-shell">
            <div class="card-premium space-y-8 p-6 md:p-10">
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Data yang Kami Terima</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Kami menerima data yang Anda kirim saat booking atau konsultasi, seperti nama, nomor WhatsApp, email, tanggal kebutuhan, layanan yang dipilih, lokasi penjemputan, dan catatan tambahan.</p>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Tujuan Penggunaan</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Data digunakan untuk memproses booking, menghubungi pelanggan, mengonfirmasi ketersediaan unit, serta membantu admin menyiapkan layanan yang sesuai dengan kebutuhan perjalanan Anda.</p>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Penyimpanan dan Akses</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Informasi booking disimpan dalam sistem admin internal dan hanya digunakan untuk operasional layanan. Kami tidak menjual data pelanggan kepada pihak lain.</p>
                </div>
                <div>
                    <h2 class="text-2xl font-black text-slate-900">Kontak</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Jika Anda ingin memperbarui atau menghapus informasi booking tertentu, hubungi admin melalui halaman kontak atau WhatsApp resmi yang tersedia di website.</p>
                </div>
            </div>
        </div>
    </section>
@endsection
