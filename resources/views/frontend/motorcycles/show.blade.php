@extends('layouts.frontend')

@section('title', $motorcycle->name . ' - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))
@section('meta_description', Str::limit(strip_tags($motorcycle->description), 160))

@push('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $motorcycle->name }}",
  "image": "{{ $motorcycle->getFirstMediaUrl('motorcycles') }}",
  "description": "{{ Str::limit(strip_tags($motorcycle->description), 160) }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $motorcycle->brand }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "IDR",
    "price": "{{ $motorcycle->price_per_day }}",
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
            <x-breadcrumb :items="[
                ['label' => 'Katalog Motor', 'url' => route('motorcycles.index')],
                ['label' => $motorcycle->name],
            ]" />
        </div>
    </section>

    <section class="pb-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-24 items-start">
                <!-- Gallery Section -->
                <div data-aos="fade-right">
                    <div
                        class="rounded-[3rem] overflow-hidden shadow-[0_40px_100px_-30px_rgba(0,0,0,0.15)] border border-slate-100 mb-8 aspect-[4/3]">
                        <img src="{{ $motorcycle->getFirstMediaUrl('motorcycles') ?: 'https://images.unsplash.com/photo-1558981403-c5f91cbba527?auto=format&fit=crop&q=80&w=1200' }}"
                            class="w-full h-full object-cover" alt="{{ $motorcycle->name }}">
                    </div>
                </div>

                <!-- Detail Section -->
                <div data-aos="fade-left">
                    <div class="mb-10">
                        <div
                            class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-amber-50 border border-amber-100 gold-gradient-text font-black text-[10px] uppercase tracking-[0.3em] mb-6 shadow-sm shadow-amber-900/5">
                            {{ strtoupper($motorcycle->brand) }} • ARMADA ELIT
                        </div>
                        <h1
                            class="text-4xl md:text-5xl font-black text-slate-900 mb-4 font-heading tracking-tighter leading-tight">
                            {{ $motorcycle->name }}</h1>
                        <div class="flex items-baseline gap-2">
                            <span class="text-3xl font-black text-slate-900 tracking-tighter">Rp
                                {{ number_format($motorcycle->price_per_day, 0, ',', '.') }}</span>
                            <span class="text-sm font-bold text-slate-400 uppercase tracking-widest font-heading">/
                                Hari</span>
                        </div>
                    </div>

                    <div class="mb-12 py-10 border-y border-slate-100 flex items-center gap-6">
                        <div
                            class="w-16 h-16 bg-amber-500/10 rounded-2xl flex items-center justify-center text-[#D4AF37] shadow-sm shrink-0 border border-amber-100">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                            </svg>
                        </div>
                        <div>
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] font-heading mb-1">
                                Performa Mesin</p>
                            <p class="text-2xl font-black text-slate-900 tracking-tight">
                                {{ $motorcycle->engine_capacity }}cc
                                Masterpiece</p>
                        </div>
                    </div>

                    <div class="mb-12">
                        <h3 class="text-xs font-black gold-gradient-text uppercase tracking-[0.4em] mb-6 font-heading">
                            Deskripsi Unit
                        </h3>
                        <div class="text-slate-500 font-medium leading-[1.8] text-sm space-y-4">
                            {!! nl2br(e($motorcycle->description)) !!}
                        </div>
                    </div>

                    <div class="space-y-6 pt-6" x-data="{ bookingModalOpen: {{ $errors->any() ? 'true' : 'false' }} }">
                        <button @click="bookingModalOpen = true"
                            class="block w-full bg-slate-900 text-white text-center py-6 rounded-2xl font-black text-sm tracking-[0.2em] uppercase gold-btn transition-all duration-500 shadow-2xl shadow-amber-950/20 active:scale-95">
                            Kuasai Jalanan Sekarang
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
                                    class="inline-block w-full max-w-xl px-8 pt-10 pb-10 overflow-hidden text-left align-middle transition-all transform bg-white shadow-2xl rounded-[3rem] sm:my-32">
                                    <div class="mb-10 text-center relative">
                                        <div
                                            class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-50 border border-amber-100 mb-4 shadow-sm shadow-amber-900/5">
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span
                                                class="text-[10px] font-black gold-gradient-text uppercase tracking-[0.2em]">Priority
                                                Booking</span>
                                        </div>
                                        <h3 class="text-3xl font-black text-slate-900 tracking-tight leading-tight">
                                            Formulir <span class="gold-gradient-text">Reservasi</span>
                                        </h3>
                                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">
                                            {{ $motorcycle->name }}</p>

                                        <!-- Decorative Line -->
                                        <div class="flex items-center justify-center gap-3 mt-6">
                                            <div class="h-[1px] w-8 bg-gradient-to-r from-transparent to-slate-200"></div>
                                            <i class="fa-solid fa-crown text-amber-300 text-[10px]"></i>
                                            <div class="h-[1px] w-8 bg-gradient-to-l from-transparent to-slate-200"></div>
                                        </div>
                                    </div>
                                    <form action="{{ route('bookings.store') }}" method="POST" class="space-y-6">
                                        @csrf
                                        <input type="hidden" name="bookable_type" value="Motorcycle">
                                        <input type="hidden" name="bookable_id" value="{{ $motorcycle->id }}">

                                        <div class="space-y-2">
                                            <label
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nama
                                                Lengkap</label>
                                            <div class="relative group/input">
                                                <div
                                                    class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                    <i class="fa-solid fa-user text-sm"></i>
                                                </div>
                                                <input type="text" name="customer_name"
                                                    value="{{ old('customer_name') }}" required
                                                    class="w-full pl-14 pr-8 py-5 bg-slate-100/50 backdrop-blur-sm border border-slate-200/50 rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 @error('customer_name') border-red-500 @enderror"
                                                    placeholder="Masukkan nama lengkap Anda">
                                            </div>
                                            @error('customer_name')
                                                <p
                                                    class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Nomor
                                                WhatsApp</label>
                                            <div class="relative group/input">
                                                <div
                                                    class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                    <i class="fa-brands fa-whatsapp text-lg"></i>
                                                </div>
                                                <input type="tel" name="customer_phone"
                                                    value="{{ old('customer_phone') }}" required
                                                    class="w-full pl-14 pr-8 py-5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-[2rem] focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 @error('customer_phone') border-red-500 @enderror"
                                                    placeholder="Contoh: 081234567890">
                                            </div>
                                            @error('customer_phone')
                                                <p
                                                    class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                                            <div class="space-y-2">
                                                <label
                                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Mulai
                                                    Sewa</label>
                                                <div class="relative group/input">
                                                    <div
                                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300 pointer-events-none">
                                                        <i class="fa-solid fa-calendar-alt text-sm"></i>
                                                    </div>
                                                    <input type="date" name="start_date"
                                                        value="{{ old('start_date') }}" required
                                                        min="{{ date('Y-m-d') }}"
                                                        class="w-full pl-14 pr-6 py-5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-[2rem] focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 @error('start_date') border-red-500 @enderror">
                                                </div>
                                                @error('start_date')
                                                    <p
                                                        class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                            <div class="space-y-2">
                                                <label
                                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Selesai
                                                    Sewa</label>
                                                <div class="relative group/input">
                                                    <div
                                                        class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300 pointer-events-none">
                                                        <i class="fa-solid fa-calendar-check text-sm"></i>
                                                    </div>
                                                    <input type="date" name="end_date" value="{{ old('end_date') }}"
                                                        min="{{ date('Y-m-d') }}"
                                                        class="w-full pl-14 pr-6 py-5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-[2rem] focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 @error('end_date') border-red-500 @enderror">
                                                </div>
                                                @error('end_date')
                                                    <p
                                                        class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">
                                                        {{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="space-y-2">
                                            <label
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Catatan
                                                (Opsional)</label>
                                            <div class="relative group/input">
                                                <div
                                                    class="absolute left-6 top-8 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                    <i class="fa-solid fa-message text-sm"></i>
                                                </div>
                                                <textarea name="notes" rows="3"
                                                    class="w-full pl-14 pr-8 py-6 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-[2rem] focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 italic @error('notes') border-red-500 @enderror"
                                                    placeholder="Tambahkan pesan atau permintaan khusus...">{{ old('notes') }}</textarea>
                                            </div>
                                            @error('notes')
                                                <p
                                                    class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">
                                                    {{ $message }}</p>
                                            @enderror
                                        </div>

                                        <button type="submit"
                                            class="w-full py-6 bg-slate-900 text-white rounded-[2rem] font-black text-xs uppercase tracking-[0.2em] gold-btn transition-all duration-500 shadow-xl shadow-amber-950/10 active:scale-95 mt-4 flex items-center justify-center gap-3">
                                            <i class="fa-solid fa-check-circle"></i>
                                            <span>Konfirmasi & Lanjut WA</span>
                                        </button>

                                        <!-- Trust Badges -->
                                        <div
                                            class="flex items-center justify-between gap-4 pt-4 border-t border-slate-50 mt-6">
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-500">
                                                    <i class="fa-solid fa-shield-halved text-[10px]"></i>
                                                </div>
                                                <span
                                                    class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Secured
                                                    Booking</span>
                                            </div>
                                            <div class="flex items-center gap-2">
                                                <div
                                                    class="w-8 h-8 rounded-full bg-amber-50 flex items-center justify-center text-amber-500">
                                                    <i class="fa-brands fa-whatsapp text-[10px]"></i>
                                                </div>
                                                <span
                                                    class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Instant
                                                    Approval</span>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                        <a href="{{ route('contact') }}"
                            class="block text-center text-[10px] font-black gold-gradient-text uppercase tracking-[0.3em] hover:text-slate-900 transition-colors">Hubungi
                            Konserge Mendalam</a>
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
