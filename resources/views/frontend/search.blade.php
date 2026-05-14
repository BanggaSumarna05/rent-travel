@extends('layouts.frontend')

@section('title', ($query ? 'Hasil Pencarian: ' . $query : 'Pencarian') . ' - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'Pencarian']]"
        badge="Pencarian Website"
        title="Cari Armada, Paket, atau"
        highlight="Artikel"
        :description="$query !== '' ? 'Hasil pencarian untuk: ' . $query : 'Masukkan kata kunci seperti nama mobil, merek, paket wisata, atau artikel yang ingin Anda temukan.'"
        glow="center"
    />

    <section class="page-section-large bg-slate-50">
        <div class="page-shell space-y-10">
            <form action="{{ route('search') }}" method="GET" class="card-premium p-5 md:p-6">
                <div class="flex flex-col gap-4 md:flex-row">
                    <input type="text" name="q" value="{{ $query }}"
                        placeholder="Contoh: Avanza, Hiace, NMAX, Pangandaran"
                        class="w-full rounded-2xl border border-slate-200 bg-white px-5 py-4 text-sm font-semibold text-slate-900 outline-none transition focus:border-amber-400 focus:ring-4 focus:ring-amber-100">
                    <button type="submit"
                        class="inline-flex items-center justify-center rounded-2xl bg-slate-900 px-6 py-4 text-sm font-black uppercase tracking-wider text-[#D4AF37] transition-all hover:bg-[#C9A14A] hover:text-slate-900">
                        Cari Sekarang
                    </button>
                </div>
            </form>

            @php
                $totalResults = $cars->count() + $motorcycles->count() + $tours->count() + $posts->count();
            @endphp

            @if ($query !== '' && $totalResults === 0)
                <div class="card-premium p-8 text-center">
                    <h2 class="text-2xl font-black text-slate-900">Tidak ada hasil untuk "{{ $query }}"</h2>
                    <p class="mt-3 text-sm leading-7 text-slate-600">Coba kata kunci yang lebih umum seperti nama unit, merek kendaraan, atau tujuan wisata.</p>
                </div>
            @endif

            @if ($cars->isNotEmpty())
                <div class="space-y-5">
                    <div>
                        <p class="section-kicker">Rental Mobil</p>
                        <h2 class="section-title">Mobil yang cocok dengan pencarian Anda</h2>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($cars as $car)
                            <a href="{{ route('cars.show', $car) }}" class="card-premium overflow-hidden transition hover:-translate-y-1">
                                <div class="aspect-[16/10] bg-slate-100">
                                    <img src="{{ $car->getFirstMediaUrl('cars') ?: asset('banner-hero.png') }}" alt="{{ $car->name }}"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="p-5">
                                    <p class="text-[10px] font-black uppercase tracking-[0.24em] text-[#C9A14A]">{{ $car->brand }}</p>
                                    <h3 class="mt-2 text-xl font-black text-slate-900">{{ $car->name }}</h3>
                                    <p class="mt-2 text-sm text-slate-600">{{ $car->transmission }} • {{ $car->passenger_capacity }} Penumpang</p>
                                    <p class="mt-4 text-sm font-black text-slate-900">Rp {{ number_format($car->price_per_day, 0, ',', '.') }}/hari</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($motorcycles->isNotEmpty())
                <div class="space-y-5">
                    <div>
                        <p class="section-kicker">Sewa Motor</p>
                        <h2 class="section-title">Motor yang tersedia</h2>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($motorcycles as $motorcycle)
                            <a href="{{ route('motorcycles.show', $motorcycle) }}" class="card-premium overflow-hidden transition hover:-translate-y-1">
                                <div class="aspect-[16/10] bg-slate-100">
                                    <img src="{{ $motorcycle->getFirstMediaUrl('motorcycles') ?: asset('banner-hero.png') }}" alt="{{ $motorcycle->name }}"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="p-5">
                                    <p class="text-[10px] font-black uppercase tracking-[0.24em] text-[#C9A14A]">{{ $motorcycle->brand }}</p>
                                    <h3 class="mt-2 text-xl font-black text-slate-900">{{ $motorcycle->name }}</h3>
                                    <p class="mt-2 text-sm text-slate-600">{{ $motorcycle->engine_capacity }}cc</p>
                                    <p class="mt-4 text-sm font-black text-slate-900">Rp {{ number_format($motorcycle->price_per_day, 0, ',', '.') }}/hari</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($tours->isNotEmpty())
                <div class="space-y-5">
                    <div>
                        <p class="section-kicker">Paket Wisata</p>
                        <h2 class="section-title">Paket perjalanan yang ditemukan</h2>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($tours as $tour)
                            <a href="{{ route('tours.show', $tour) }}" class="card-premium overflow-hidden transition hover:-translate-y-1">
                                <div class="aspect-[16/10] bg-slate-100">
                                    <img src="{{ $tour->primary_image_url }}" alt="{{ $tour->name }}"
                                        class="h-full w-full object-cover">
                                </div>
                                <div class="p-5">
                                    <p class="text-[10px] font-black uppercase tracking-[0.24em] text-[#C9A14A]">{{ $tour->duration }}</p>
                                    <h3 class="mt-2 text-xl font-black text-slate-900">{{ $tour->name }}</h3>
                                    <p class="mt-4 text-sm font-black text-slate-900">Mulai Rp {{ number_format($tour->price, 0, ',', '.') }}</p>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif

            @if ($posts->isNotEmpty())
                <div class="space-y-5">
                    <div>
                        <p class="section-kicker">Artikel</p>
                        <h2 class="section-title">Konten terkait pencarian</h2>
                    </div>
                    <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                        @foreach ($posts as $post)
                            <a href="{{ route('posts.show', $post) }}" class="card-premium p-6 transition hover:-translate-y-1">
                                <p class="text-[10px] font-black uppercase tracking-[0.24em] text-[#C9A14A]">{{ optional($post->published_at)->format('d M Y') }}</p>
                                <h3 class="mt-3 text-xl font-black text-slate-900">{{ $post->title }}</h3>
                                <p class="mt-3 text-sm leading-7 text-slate-600">{{ \Illuminate\Support\Str::limit($post->excerpt ?: strip_tags($post->content), 120) }}</p>
                            </a>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>
@endsection
