@extends('layouts.frontend')

@section('title', $tourPackage->name . ' - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))
@section('meta_description', Str::limit(strip_tags($tourPackage->description), 160))

@push('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $tourPackage->name }}",
  "image": "{{ $tourPackage->primary_image_url }}",
  "description": "{{ Str::limit(strip_tags($tourPackage->description), 160) }}",
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "IDR",
    "price": "{{ $tourPackage->price }}",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endpush

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-12 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -mr-48 -mt-48"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'Paket Wisata', 'url' => route('tours.index')], ['label' => $tourPackage->name]]" />
        </div>
    </section>

    <section class="pb-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-10 lg:gap-16 items-start">
                <div class="lg:col-span-2 space-y-10 lg:space-y-16">
                    <div class="relative h-56 sm:h-80 md:h-[26rem] lg:h-[32rem] rounded-[2rem] md:rounded-[3.5rem] overflow-hidden shadow-[0_40px_100px_-30px_rgba(0,0,0,0.15)] group"
                        data-aos="zoom-in">
                        <img src="{{ $tourPackage->primary_image_url }}"
                            alt="{{ $tourPackage->name }} - paket wisata dari Tasikmalaya"
                            class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-1000" loading="lazy">
                        <div class="absolute inset-0 bg-gradient-to-t from-black via-transparent to-transparent opacity-60">
                        </div>
                        <div class="absolute bottom-5 left-5 right-5 md:bottom-10 md:left-10 md:right-10 text-white">
                            <div
                                class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-amber-50/20 backdrop-blur-xl border border-amber-200/30 gold-gradient-text font-black text-[10px] uppercase tracking-[0.3em] mb-3 md:mb-6 shadow-sm shadow-amber-900/5">
                                {{ strtoupper($tourPackage->duration) }} | PAKET WISATA
                            </div>
                            <h1 class="text-2xl sm:text-4xl md:text-5xl lg:text-6xl font-black font-heading tracking-tighter leading-[0.95]">
                                {{ $tourPackage->name }}</h1>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="space-y-12" data-aos="fade-up">
                        <div>
                            <h2 class="text-xs font-black gold-gradient-text uppercase tracking-[0.5em] mb-8 font-heading">
                                Itinerary Perjalanan</h2>
                            <div class="space-y-8">
                                @if ($tourPackage->itinerary && is_array($tourPackage->itinerary) && count($tourPackage->itinerary) > 0)
                                    <div
                                        class="space-y-8 relative before:absolute before:left-[11px] before:top-2 before:bottom-2 before:w-[2px] before:bg-amber-100">
                                        @foreach ($tourPackage->itinerary as $item)
                                            <div class="relative pl-12">
                                                <div
                                                    class="absolute left-0 top-1.5 w-6 h-6 rounded-full bg-white border-2 border-[#C9A14A] flex items-center justify-center z-10">
                                                    <div class="w-2 h-2 rounded-full bg-[#C9A14A]"></div>
                                                </div>
                                                <h4
                                                    class="text-xs font-black text-slate-900 uppercase tracking-widest mb-2 font-heading">
                                                    {{ $item['day'] ?? '' }}</h4>
                                                <p class="text-slate-500 font-medium leading-relaxed italic text-sm">
                                                    {{ $item['activity'] ?? '' }}</p>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif

                                @if ($tourPackage->description)
                                    <div class="text-slate-500 font-medium leading-[2] text-base italic">
                                        {!! nl2br(e($tourPackage->description)) !!}
                                    </div>
                                @endif
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 pt-8">
                            <div
                                class="p-10 bg-amber-50/50 rounded-[3rem] border border-amber-100/50 relative overflow-hidden group">
                                <div
                                    class="absolute top-0 right-0 w-32 h-32 bg-amber-500/5 blur-2xl rounded-full -mr-16 -mt-16 group-hover:bg-amber-500/10 transition-all">
                                </div>
                                <h3
                                    class="text-sm font-black text-slate-900 mb-6 flex items-center gap-3 font-heading uppercase tracking-widest">
                                    <span
                                        class="w-8 h-8 rounded-lg bg-[#D4AF37] text-white flex items-center justify-center shadow-lg shadow-amber-900/20">
                                        <i class="fa-solid fa-check text-xs"></i>
                                    </span>
                                    Paket Termasuk
                                </h3>
                                <div
                                    class="text-xs text-slate-500 font-bold leading-relaxed space-y-4 italic whitespace-pre-line">
                                    {{ $tourPackage->include }}
                                </div>
                            </div>
                            <div
                                class="p-10 bg-slate-50 rounded-[3rem] border border-slate-100 relative overflow-hidden group">
                                <div
                                    class="absolute top-0 right-0 w-32 h-32 bg-slate-200/50 blur-2xl rounded-full -mr-16 -mt-16 group-hover:bg-slate-300 transition-all">
                                </div>
                                <h3
                                    class="text-sm font-black text-slate-900 mb-6 flex items-center gap-3 font-heading uppercase tracking-widest">
                                    <span
                                        class="w-8 h-8 rounded-lg bg-slate-900 text-white flex items-center justify-center shadow-lg shadow-slate-900/20">
                                        <i class="fa-solid fa-xmark text-xs"></i>
                                    </span>
                                    Tidak Termasuk
                                </h3>
                                <div
                                    class="text-xs text-slate-400 font-bold leading-relaxed space-y-4 italic whitespace-pre-line">
                                    {{ $tourPackage->exclude }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="lg:col-span-1" data-aos="fade-left">
                    <div
                        class="bg-white border border-slate-100 p-6 sm:p-8 lg:p-12 rounded-[2rem] lg:rounded-[3.5rem] shadow-[0_40px_100px_-30px_rgba(0,0,0,0.15)] lg:sticky lg:top-32">
                        <h3 class="text-xs font-black gold-gradient-text uppercase tracking-[0.5em] mb-10 font-heading">
                            Reservasi Paket Wisata
                        </h3>
                        <div class="mb-10 pb-10 border-b border-slate-50">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest mb-2 font-heading">
                                Mulai
                                Dari</p>
                            <p class="text-4xl font-black text-slate-900 tracking-tighter">Rp
                                {{ number_format($tourPackage->price, 0, ',', '.') }}</p>
                        </div>

                        <p class="text-slate-400 text-xs font-medium mb-12 leading-relaxed italic">"Cocok untuk perjalanan keluarga, rombongan, atau agenda wisata dengan titik keberangkatan dari Tasikmalaya dan sekitarnya."</p>

                        <div class="space-y-6" x-data="{ bookingModalOpen: {{ $errors->any() ? 'true' : 'false' }} }">
                            <button type="button" @click.prevent="bookingModalOpen = true"
                                class="block w-full bg-slate-900 text-white text-center py-6 rounded-2xl font-black text-sm tracking-[0.2em] uppercase gold-btn transition-all duration-500 shadow-2xl shadow-amber-950/20 active:scale-95">
                                Tanya Paket via WhatsApp
                            </button>

                            <!-- Booking Modal -->
                            <div x-show="bookingModalOpen" x-cloak class="fixed inset-0 z-[100] overflow-y-auto"
                                @keydown.escape.window="bookingModalOpen = false">
                                <div
                                    class="flex items-center justify-center min-h-screen px-4 pt-4 pb-20 text-center sm:block sm:p-0">
                                    <div x-show="bookingModalOpen" x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
                                        x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100"
                                        x-transition:leave-end="opacity-0"
                                        class="fixed inset-0 transition-opacity bg-slate-900/90 backdrop-blur-sm"
                                        @click="bookingModalOpen = false"></div>

                                    <div x-show="bookingModalOpen" x-transition:enter="ease-out duration-300"
                                        x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave="ease-in duration-200"
                                        x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                                        x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                                        class="inline-block w-full max-w-lg px-6 pt-8 pb-8 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-3xl sm:my-8 m-4">
                                        <div class="mb-10 text-center relative">
                                            <div
                                                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-50 border border-amber-100 mb-4 shadow-sm shadow-amber-900/5">
                                                <span class="w-1.5 h-1.5 rounded-full bg-[#C9A14A] animate-pulse"></span>
                                                    <span
                                                    class="text-[10px] font-black gold-gradient-text uppercase tracking-[0.2em]">Booking
                                                    Cepat</span>
                                            </div>
                                            <h3 class="text-3xl font-black text-slate-900 tracking-tight leading-tight">
                                                Formulir <span class="gold-gradient-text">Booking Wisata</span>
                                            </h3>
                                            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">
                                                {{ $tourPackage->name }}</p>

                                            <!-- Decorative Line -->
                                            <div class="flex items-center justify-center gap-3 mt-6">
                                                <div class="h-[1px] w-8 bg-gradient-to-r from-transparent to-slate-200">
                                                </div>
                                                <i class="fa-solid fa-crown text-amber-300 text-[10px]"></i>
                                                <div class="h-[1px] w-8 bg-gradient-to-l from-transparent to-slate-200">
                                                </div>
                                            </div>
                                        </div>
                                        <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-h-[65vh] overflow-y-auto pr-1">
                                            @csrf
                                            <input type="hidden" name="bookable_type" value="TourPackage">
                                            <input type="hidden" name="bookable_id" value="{{ $tourPackage->id }}">

                                            <div class="space-y-1.5">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nama Lengkap</label>
                                                <div class="relative group/input">
                                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                        <i class="fa-solid fa-user text-xs"></i>
                                                    </div>
                                                    <input type="text" name="customer_name" value="{{ old('customer_name') }}" required
                                                        class="w-full pl-10 pr-4 py-2.5 bg-slate-100/50 backdrop-blur-sm border border-slate-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 @error('customer_name') border-red-500 @enderror"
                                                        placeholder="Masukkan nama lengkap Anda">
                                                </div>
                                                @error('customer_name')
                                                    <p class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="space-y-1.5">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nomor WhatsApp</label>
                                                <div class="relative group/input">
                                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                        <i class="fa-brands fa-whatsapp text-sm"></i>
                                                    </div>
                                                    <input type="tel" name="customer_phone" value="{{ old('customer_phone') }}" required
                                                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 @error('customer_phone') border-red-500 @enderror"
                                                        placeholder="Contoh: 081234567890">
                                                </div>
                                                @error('customer_phone')
                                                    <p class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="space-y-1.5">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Tanggal Perjalanan</label>
                                                <div class="relative group/input">
                                                    <div class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300 pointer-events-none">
                                                        <i class="fa-solid fa-calendar-day text-xs"></i>
                                                    </div>
                                                    <input type="date" name="start_date" value="{{ old('start_date') }}" required
                                                        min="{{ date('Y-m-d') }}"
                                                        class="w-full pl-10 pr-3 py-2.5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 @error('start_date') border-red-500 @enderror">
                                                </div>
                                                @error('start_date')
                                                    <p class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="space-y-1.5">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Catatan (Opsional)</label>
                                                <div class="relative group/input">
                                                    <div class="absolute left-4 top-3 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                        <i class="fa-solid fa-message text-xs"></i>
                                                    </div>
                                                    <textarea name="notes" rows="2"
                                                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 italic @error('notes') border-red-500 @enderror"
                                                        placeholder="Tambahkan pesan khusus...">{{ old('notes') }}</textarea>
                                                </div>
                                                @error('notes')
                                                    <p class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            {{-- Persyaratan Rental --}}
                                            <x-frontend.booking-documents :compact="true" />

                                            <button type="submit"
                                                class="w-full py-4 bg-slate-900 text-white rounded-xl font-black text-[11px] uppercase tracking-[0.2em] gold-btn transition-all duration-500 shadow-xl shadow-amber-950/10 active:scale-95 mt-2 flex items-center justify-center gap-2">
                                                <i class="fa-solid fa-check-circle"></i>
                                                <span>Pesan Sekarang via WA</span>
                                            </button>

                                            <!-- Trust Badges -->
                                            <div class="flex items-center justify-between gap-4 pt-3 border-t border-slate-50">
                                                <div class="flex items-center gap-2">
                                                    <div class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                                        <i class="fa-solid fa-shield-halved text-[10px]"></i>
                                                    </div>
                                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Reservasi Aman</span>
                                                </div>
                                                <div class="flex items-center gap-2">
                                                    <div class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-[#C9A14A]">
                                                        <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                                    </div>
                                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Respon Admin</span>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <a href="{{ route('contact') }}"
                                class="block text-center text-[10px] font-black gold-gradient-text uppercase tracking-[0.3em] hover:text-slate-900 transition-colors">Hubungi Kami Lebih Lanjut</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <style>
        .shadow-3xl {
            box-shadow: 0 40px 100px -30px rgba(0, 0, 0, 0.15);
        }
    </style>
@endsection
