@extends('layouts.frontend')

@section('title', $car->name . ' - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))
@section('meta_description', Str::limit(strip_tags($car->description), 160))

@push('schema')
    <script type="application/ld+json">
{
  "@context": "https://schema.org/",
  "@type": "Product",
  "name": "{{ $car->name }}",
  "image": "{{ $car->getFirstMediaUrl('cars') }}",
  "description": "{{ Str::limit(strip_tags($car->description), 160) }}",
  "brand": {
    "@type": "Brand",
    "name": "{{ $car->brand }}"
  },
  "offers": {
    "@type": "Offer",
    "url": "{{ url()->current() }}",
    "priceCurrency": "IDR",
    "price": "{{ $car->price_per_day }}",
    "availability": "https://schema.org/InStock"
  }
}
</script>
@endpush

@push('styles')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-main {
            width: 100%;
            height: 100%;
            border-radius: 3rem;
        }

        .swiper-thumbs {
            height: 100px;
            box-sizing: border-box;
            padding: 10px 0;
        }

        .swiper-thumbs .swiper-slide {
            width: 25%;
            height: 100%;
            opacity: 0.4;
            border-radius: 1rem;
            overflow: hidden;
            cursor: pointer;
            border: 2px solid transparent;
            transition: all 0.3s ease;
        }

        .swiper-thumbs .swiper-slide-thumb-active {
            opacity: 1;
            border-color: #D4AF37;
        }

        .swiper-button-next,
        .swiper-button-prev {
            color: #D4AF37 !important;
            background: white;
            width: 50px !important;
            height: 50px !important;
            border-radius: 50%;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }

        .swiper-button-next:after,
        .swiper-button-prev:after {
            font-size: 20px !important;
            font-weight: 900;
        }
    </style>
@endpush

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-12 bg-white overflow-hidden">
        <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -mr-48 -mt-48"></div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'Katalog Mobil', 'url' => route('cars.index')], ['label' => $car->name]]" />
        </div>
    </section>

    <section class="pb-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 lg:gap-16 items-start">
                <!-- Gallery Section -->
                <div data-aos="fade-right" class="sticky top-32">
                    <div class="rounded-[3rem] overflow-hidden shadow-2xl border border-slate-100 mb-6 aspect-[4/3] bg-slate-50">
                        <div class="swiper swiper-main">
                            <div class="swiper-wrapper">
                                {{-- Videos first --}}
                                @foreach ($car->getMedia('videos') as $media)
                                    <div class="swiper-slide bg-slate-900 flex items-center justify-center">
                                        <video src="{{ $media->getUrl() }}" class="w-full h-full object-contain" controls
                                            muted playsinline></video>
                                    </div>
                                @endforeach
                                {{-- Images --}}
                                @php
                                    $images = $car->getMedia('cars');
                                @endphp
                                @forelse($images as $media)
                                    <div class="swiper-slide">
                                        <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover"
                                            alt="{{ $car->name }}">
                                    </div>
                                @empty
                                    @if($car->getMedia('videos')->isEmpty())
                                        <div class="swiper-slide">
                                            <img src="https://images.unsplash.com/photo-1542282088-fe8426682b8f?auto=format&fit=crop&q=80&w=1200"
                                                class="w-full h-full object-cover" alt="No Image">
                                        </div>
                                    @endif
                                @endforelse
                            </div>
                            <div class="swiper-button-next"></div>
                            <div class="swiper-button-prev"></div>
                        </div>
                    </div>

                    {{-- Thumbs slider --}}
                    <div class="swiper swiper-thumbs">
                        <div class="swiper-wrapper">
                            @foreach ($car->getMedia('videos') as $media)
                                <div class="swiper-slide relative bg-slate-900 group">
                                    <video src="{{ $media->getUrl() }}" class="w-full h-full object-cover opacity-50"></video>
                                    <div class="absolute inset-0 flex items-center justify-center text-white">
                                        <i class="fa-solid fa-play text-xs opacity-80"></i>
                                    </div>
                                </div>
                            @endforeach
                            @foreach ($car->getMedia('cars') as $media)
                                <div class="swiper-slide">
                                    <img src="{{ $media->getUrl() }}" class="w-full h-full object-cover">
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Detail Section -->
                <div data-aos="fade-left">
                    <div class="mb-10">
                        <div
                            class="inline-flex items-center gap-3 px-4 py-2 rounded-xl bg-amber-50 border border-amber-100 gold-gradient-text font-black text-[10px] uppercase tracking-[0.3em] mb-6 shadow-sm shadow-amber-900/5">
                            {{ strtoupper($car->brand) }} • {{ strtoupper($car->transmission) }}
                        </div>
                        <h1
                            class="text-4xl md:text-5xl font-black text-slate-900 mb-4 font-heading tracking-tighter leading-tight">
                            {{ $car->name }}</h1>
                        <div class="flex flex-col gap-1">
                            <div class="flex items-baseline gap-2">
                                <span class="text-3xl font-black text-slate-900 tracking-tighter">Rp
                                    {{ number_format($car->price_per_day, 0, ',', '.') }}</span>
                                <span class="text-sm font-bold text-slate-400 uppercase tracking-widest font-heading">/
                                    Hari</span>
                            </div>
                            @if($car->price_per_month)
                                <div class="flex items-baseline gap-2">
                                    <span class="text-xl font-black text-amber-600 tracking-tighter">Rp
                                        {{ number_format($car->price_per_month, 0, ',', '.') }}</span>
                                    <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest font-heading">/
                                        Bulan</span>
                                </div>
                            @endif
                        </div>
                        <p class="mt-4 max-w-2xl text-sm font-medium leading-relaxed text-slate-500">
                            Rental mobil {{ $car->name }} di Tasikmalaya untuk kebutuhan harian, perjalanan keluarga, antar jemput, atau perjalanan kerja dengan unit terawat dan proses booking cepat.
                        </p>
                    </div>

                    <div class="grid grid-cols-2 gap-4 sm:gap-8 mb-12 py-10 border-y border-slate-100">
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] font-heading">Tahun
                                Produksi</p>
                            <p class="text-lg font-black text-slate-900 tracking-tight">{{ $car->year }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] font-heading">
                                Kapasitas
                            </p>
                            <p class="text-lg font-black text-slate-900 tracking-tight">{{ $car->passenger_capacity }} Kursi
                            </p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] font-heading">
                                Transmisi
                            </p>
                            <p class="text-lg font-black text-slate-900 tracking-tight">{{ $car->transmission }}</p>
                        </div>
                        <div class="space-y-1">
                            <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] font-heading">Bahan
                                Bakar</p>
                            <p class="text-lg font-black text-slate-900 tracking-tight">{{ $car->fuel_type }}</p>
                        </div>
                    </div>

                    <div class="mb-12">
                        <h3 class="text-xs font-black gold-gradient-text uppercase tracking-[0.4em] mb-6 font-heading">
                            Detail Rental &
                            Ketentuan Sewa</h3>
                        <div class="text-slate-500 font-medium leading-[1.8] text-sm space-y-4">
                            {!! nl2br(e($car->description)) !!}
                        </div>
                    </div>

                    <div class="space-y-6 pt-6" x-data="{ bookingModalOpen: {{ $errors->any() ? 'true' : 'false' }} }">
                        <button type="button" @click.prevent="bookingModalOpen = true"
                            class="block w-full bg-slate-900 text-white text-center py-6 rounded-2xl font-black text-sm tracking-[0.2em] uppercase gold-btn transition-all duration-500 shadow-2xl shadow-amber-950/20 active:scale-95">
                            Cek Ketersediaan & Booking
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
                                            <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                                            <span
                                                class="text-[10px] font-black gold-gradient-text uppercase tracking-[0.2em]">Layanan
                                                Prioritas</span>
                                        </div>
                                        <h3 class="text-xl sm:text-3xl font-black text-slate-900 tracking-tight leading-tight">
                                            Formulir <span class="gold-gradient-text">Booking Mobil</span>
                                        </h3>
                                        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-2">
                                            {{ ($car->brand ? $car->brand . ' ' : '') . $car->name }}</p>

                                        <!-- Decorative Line -->
                                        <div class="flex items-center justify-center gap-3 mt-6">
                                            <div class="h-[1px] w-8 bg-gradient-to-r from-transparent to-slate-200"></div>
                                            <i class="fa-solid fa-crown text-amber-300 text-[10px]"></i>
                                            <div class="h-[1px] w-8 bg-gradient-to-l from-transparent to-slate-200"></div>
                                        </div>
                                    </div>
                                    <form action="{{ route('bookings.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4 max-h-[65vh] overflow-y-auto pr-1">
                                        @csrf
                                        <input type="hidden" name="bookable_type" value="Car">
                                        <input type="hidden" name="bookable_id" value="{{ $car->id }}">

                                        <div class="space-y-1.5">
                                            <label
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nama
                                                Lengkap</label>
                                            <div class="relative group/input">
                                                <div
                                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                    <i class="fa-solid fa-user text-xs"></i>
                                                </div>
                                                <input type="text" name="customer_name"
                                                    value="{{ old('customer_name') }}" required
                                                    class="w-full pl-10 pr-4 py-2.5 bg-slate-100/50 backdrop-blur-sm border border-slate-200/50 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 @error('customer_name') border-red-500 @enderror"
                                                    placeholder="Masukkan nama lengkap Anda">
                                            </div>
                                            @error('customer_name')
                                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="space-y-1.5">
                                            <label
                                                class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Nomor
                                                WhatsApp</label>
                                            <div class="relative group/input">
                                                <div
                                                    class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                    <i class="fa-brands fa-whatsapp text-sm"></i>
                                                </div>
                                                <input type="tel" name="customer_phone"
                                                    value="{{ old('customer_phone') }}" required
                                                    class="w-full pl-10 pr-4 py-2.5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-400 @error('customer_phone') border-red-500 @enderror"
                                                    placeholder="Contoh: 081234567890">
                                            </div>
                                            @error('customer_phone')
                                                <p class="text-red-500 text-[10px] font-bold mt-1 ml-4 uppercase tracking-wider">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                            <div class="space-y-1.5 sm:col-span-2">
                                                <label
                                                    class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Opsi
                                                    Driver</label>
                                                <div class="relative group/input">
                                                    <div
                                                        class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400 group-focus-within/input:text-[#D4AF37] transition-colors duration-300">
                                                        <i class="fa-solid fa-id-card text-xs"></i>
                                                    </div>
                                                    <select name="driver_option" required
                                                        class="w-full appearance-none pl-10 pr-4 py-2.5 bg-slate-50/50 backdrop-blur-sm border border-slate-100 rounded-xl focus:outline-none focus:ring-2 focus:ring-amber-500/10 focus:border-[#D4AF37] focus:bg-white transition-all duration-300 font-bold text-sm tracking-tight text-slate-900 @error('driver_option') border-red-500 @enderror">
                                                        <option value="" disabled {{ old('driver_option') ? '' : 'selected' }}>Pilih opsi driver</option>
                                                        <option value="lepas_kunci" {{ old('driver_option') === 'lepas_kunci' ? 'selected' : '' }}>Tanpa Driver / Lepas Kunci</option>
                                                        <option value="dengan_driver" {{ old('driver_option') === 'dengan_driver' ? 'selected' : '' }}>Dengan Driver</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                         <div class="grid grid-cols-2 gap-3">
                                            <div class="space-y-1.5">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Tgl Ambil</label>
                                                <input type="date" name="start_date" value="{{ old('start_date') }}" required
                                                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:border-[#D4AF37] font-bold text-sm">
                                            </div>
                                            <div class="space-y-1.5">
                                                <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Tgl Kembali</label>
                                                <input type="date" name="end_date" value="{{ old('end_date') }}" required
                                                    class="w-full px-4 py-2.5 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:border-[#D4AF37] font-bold text-sm">
                                            </div>
                                        </div>

                                        <div class="space-y-1.5">
                                            <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-2">Catatan Tambahan</label>
                                            <textarea name="notes" rows="3"
                                                class="w-full px-4 py-3 bg-slate-50 border border-slate-100 rounded-xl focus:outline-none focus:border-[#D4AF37] font-bold text-sm resize-none"
                                                placeholder="Contoh: Titik jemput di bandara, butuh kursi bayi, dll.">{{ old('notes') }}</textarea>
                                        </div>

                                        <button type="submit"
                                            class="w-full py-5 mt-4 bg-slate-900 text-white rounded-2xl font-black text-xs tracking-[.3em] uppercase gold-btn shadow-xl shadow-amber-950/20 active:scale-95 transition-all">
                                            Konfirmasi Booking
                                        </button>
                                    </form>
                                    <div class="mt-8 flex flex-col items-center gap-4">
                                        <div class="flex items-center gap-2">
                                            <span class="h-px w-8 bg-slate-100"></span>
                                            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Ada pertanyaan mengenai unit ini?</p>
                                            <span class="h-px w-8 bg-slate-100"></span>
                                        </div>
                                        <a href="{{ route('contact') }}"
                                            class="block text-center text-[10px] font-black gold-gradient-text uppercase tracking-[0.3em] hover:text-slate-900 transition-colors">Hubungi kami Lebih lanjut</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
        <script>
            var thumbs = new Swiper(".swiper-thumbs", {
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
            });
            var main = new Swiper(".swiper-main", {
                spaceBetween: 10,
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: thumbs,
                },
            });
        </script>
    @endpush
@endsection
