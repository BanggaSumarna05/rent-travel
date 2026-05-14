@extends('layouts.frontend')

@section('title', 'Pilihan Mobil - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')

    <x-frontend.page-hero
        :items="[['label' => 'Katalog Mobil']]"
        badge="Rental Mobil Tasikmalaya"
        title="Pilihan Rental Mobil"
        highlight="Tasikmalaya"
        description="Temukan rental mobil Tasikmalaya untuk lepas kunci, dengan driver, perjalanan harian, antar jemput, dan kebutuhan keluarga dengan harga yang jelas."
    />

    {{-- ── Filter & Search ── --}}
    <section x-data="{
        categories: {{ json_encode(request('categories', [])) }},
        search: '{{ request('search', '') }}',
        toggleCategory(cat) {
            if (this.categories.includes(cat)) {
                this.categories = this.categories.filter(c => c !== cat);
            } else {
                this.categories.push(cat);
            }
            this.submitForm();
        },
        submitForm() { this.$refs.filterForm.submit(); }
    }"
    class="py-3 md:py-5 bg-white/90 backdrop-blur-xl border-y border-amber-500/10 sticky top-16 lg:top-20 z-40 shadow-[0_2px_15px_rgba(0,0,0,0.03)]">
        <div class="page-shell">
            <form x-ref="filterForm" action="{{ route('cars.index') }}" method="GET"
                  class="flex flex-col sm:flex-row justify-between items-center gap-3">

                <template x-for="cat in categories">
                    <input type="hidden" name="categories[]" :value="cat">
                </template>

                {{-- Category Tabs --}}
                <div class="flex items-center gap-2 overflow-x-auto w-full sm:w-auto no-scrollbar pb-0.5">
                    <button type="button" @click="categories = []; submitForm()"
                        :class="categories.length === 0 ? 'bg-slate-900 text-[#D4AF37]' : 'bg-slate-50 text-slate-500 hover:bg-amber-50'"
                        class="px-4 py-2.5 rounded-xl font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all whitespace-nowrap shrink-0 shadow-sm">
                        Semua Koleksi
                    </button>
                    <button type="button" @click="toggleCategory('lepas_kunci')"
                        :class="categories.includes('lepas_kunci') ? 'bg-slate-900 text-[#D4AF37]' : 'bg-slate-50 text-slate-500 hover:bg-amber-50'"
                        class="px-4 py-2.5 rounded-xl font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all whitespace-nowrap shrink-0 shadow-sm">
                        Lepas Kunci
                    </button>
                    <button type="button" @click="toggleCategory('with_driver')"
                        :class="categories.includes('with_driver') ? 'bg-slate-900 text-[#D4AF37]' : 'bg-slate-50 text-slate-500 hover:bg-amber-50'"
                        class="px-4 py-2.5 rounded-xl font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all whitespace-nowrap shrink-0 shadow-sm">
                        Dengan Sopir
                    </button>
                    <button type="button" @click="toggleCategory('carter_drop')"
                        :class="categories.includes('carter_drop') ? 'bg-slate-900 text-[#D4AF37]' : 'bg-slate-50 text-slate-500 hover:bg-amber-50'"
                        class="px-4 py-2.5 rounded-xl font-black text-[9px] md:text-[10px] uppercase tracking-widest transition-all whitespace-nowrap shrink-0 shadow-sm">
                        Carter / Drop
                    </button>
                </div>

                {{-- Search --}}
                <div class="relative w-full sm:w-[300px] md:w-[350px] shrink-0">
                    <input type="text" name="search" x-model="search" @keydown.enter.prevent="submitForm()"
                        placeholder="Cari mobil rental Tasikmalaya..."
                        class="w-full pl-10 pr-4 py-2.5 bg-slate-50 border border-transparent rounded-xl focus:outline-none focus:ring-2 focus:ring-[#D4AF37]/20 focus:border-[#D4AF37] transition-all font-bold text-xs">
                    <i @click="submitForm()" class="fa-solid fa-magnifying-glass text-[#D4AF37] absolute left-3.5 top-1/2 -translate-y-1/2 cursor-pointer text-xs"></i>
                </div>
            </form>
        </div>
    </section>

    {{-- ── Catalog Grid ── --}}
    <section class="page-section page-section-muted">
        <div class="page-shell">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 md:gap-8">
                @forelse($cars as $car)
                <div class="group bg-white rounded-2xl md:rounded-[2.5rem] overflow-hidden shadow-[0_4px_20px_-4px_rgba(0,0,0,0.06)] hover:shadow-[0_20px_50px_-10px_rgba(15,23,42,0.12)] transition-all duration-500 border border-slate-100 flex flex-col h-full hover:-translate-y-1"
                     data-aos="fade-up" data-aos-delay="{{ min($loop->index * 50, 200) }}">

                    {{-- Image --}}
                    <div class="relative aspect-[16/10] overflow-hidden shrink-0">
                        <img src="{{ $car->getFirstMediaUrl('cars') ?: 'https://images.unsplash.com/photo-1549399542-7e3f8b79c341?auto=format&fit=crop&q=80&w=800' }}"
                             alt="{{ $car->name }}"
                             class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                        @if($car->is_featured)
                        <div class="absolute top-3 left-3">
                            <span class="px-3 py-1.5 bg-[#D4AF37] text-white rounded-lg text-[8px] font-black uppercase tracking-[0.2em] shadow-lg">
                                Andalan
                            </span>
                        </div>
                        @endif
                    </div>

                    {{-- Content --}}
                    <div class="p-4 md:p-6 flex flex-col flex-1">
                        {{-- Name & Price --}}
                        <div class="flex justify-between items-start gap-2 mb-4">
                            <div>
                                <h2 class="text-base md:text-xl font-black text-slate-900 font-heading tracking-tight leading-tight mb-1">
                                    <a href="{{ route('cars.show', $car) }}" class="hover:text-[#D4AF37] transition-colors">{{ $car->name }}</a>
                                </h2>
                                <div class="flex items-center gap-1.5">
                                    <span class="text-[8px] font-black uppercase tracking-[0.3em] gold-gradient-text">{{ $car->brand }}</span>
                                    <span class="w-0.5 h-0.5 rounded-full bg-slate-300"></span>
                                    <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ $car->year }}</span>
                                </div>
                            </div>
                            <div class="text-right shrink-0">
                                <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mb-0.5">Mulai</div>
                                <div class="text-sm md:text-base font-black text-slate-900 tracking-tight">
                                    Rp {{ number_format($car->price_per_day, 0, ',', '.') }}<span class="text-[8px] text-slate-400">/hr</span>
                                </div>
                                @if($car->price_per_month)
                                    <div class="text-[9px] font-black text-amber-600 tracking-tight mt-0.5 whitespace-nowrap">
                                        Rp {{ number_format($car->price_per_month, 0, ',', '.') }}<span class="text-[7px] text-slate-400 italic">/bln</span>
                                    </div>
                                @endif
                            </div>
                        </div>

                        {{-- Specs --}}
                        <div class="grid grid-cols-2 gap-2 mb-4">
                            @foreach([
                                ['icon' => 'fa-solid fa-gears', 'label' => 'Transmisi', 'value' => $car->transmission],
                                ['icon' => 'fa-solid fa-gas-pump', 'label' => 'BBM', 'value' => $car->fuel_type],
                                ['icon' => 'fa-solid fa-layer-group', 'label' => 'Kategori', 'value' => str_replace('_', ' ', $car->category)],
                                ['icon' => 'fa-solid fa-users', 'label' => 'Kapasitas', 'value' => $car->passenger_capacity . ' Kursi'],
                            ] as $spec)
                            <div class="p-2.5 bg-slate-50 rounded-xl flex items-center gap-2 group-hover:bg-amber-50 transition-colors duration-300">
                                <div class="w-6 h-6 bg-white rounded-lg shadow-sm flex items-center justify-center text-amber-500 shrink-0">
                                    <i class="{{ $spec['icon'] }} text-[10px]"></i>
                                </div>
                                <div class="min-w-0">
                                    <div class="text-[7px] font-black text-slate-300 uppercase tracking-widest leading-none mb-0.5">{{ $spec['label'] }}</div>
                                    <div class="text-[8px] font-black text-slate-600 uppercase tracking-wide leading-none truncate">{{ $spec['value'] }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>

                        {{-- CTA --}}
                        <div class="mt-auto grid grid-cols-2 gap-2">
                            <a href="{{ route('cars.show', $car) }}"
                               class="py-3 bg-slate-100 text-slate-900 rounded-xl font-black text-[9px] tracking-widest uppercase text-center hover:bg-slate-900 hover:text-white transition-all active:scale-95">
                                Detail Unit
                            </a>
                            <a href="{{ \App\Models\Setting::whatsappLink('Halo, saya ingin reservasi ' . $car->name) }}"
                               class="py-3 gold-btn text-white rounded-xl font-black text-[9px] tracking-widest uppercase text-center transition-all active:scale-95">
                                Pesan Sekarang
                            </a>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-span-full page-empty-state" data-aos="fade-up">
                    <div class="w-20 h-20 bg-slate-100 rounded-3xl flex items-center justify-center text-slate-300 mx-auto mb-6">
                        <i class="fa-solid fa-car-on text-slate-300 text-4xl"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-3 font-heading">Sedang Menyiapkan Armada</h3>
                    <p class="text-slate-400 text-sm max-w-xs mx-auto">Unit terbaik kami sedang dalam tahap persiapan.</p>
                </div>
                @endforelse
            </div>

            @if($cars->hasPages())
            <div class="page-pagination">
                {{ $cars->links() }}
            </div>
            @endif
        </div>
    </section>

@endsection


