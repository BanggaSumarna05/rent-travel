@extends('layouts.frontend')

@section('title', 'Hak Istimewa - FAQ - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@push('schema')
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "FAQPage",
            "mainEntity": [
                @foreach ($faqs as $faq)
                    {
                        "@type": "Question",
                        "name": @json($faq->question),
                        "acceptedAnswer": {
                            "@type": "Answer",
                            "text": @json($faq->answer)
                        }
                    }@if (! $loop->last),@endif
                @endforeach
            ]
        }
    </script>
@endpush

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'FAQ']]"
        badge="FAQ Booking"
        title="Jawaban untuk"
        highlight="Pertanyaan Umum"
        description="Baca pertanyaan yang paling sering diajukan sebelum booking rental mobil Tasikmalaya, mulai dari syarat sewa sampai proses pemesanan."
    />

    <section class="page-section-large page-section-muted" x-data="{ activeFaq: 0 }">
        <div class="page-shell-narrow">
            <div class="section-heading-centered" data-aos="fade-up">
                <div class="section-kicker">FAQ Rental Mobil Tasikmalaya</div>
                <h2 class="section-title">Informasi yang paling sering dicari pelanggan</h2>
                <p class="section-copy mx-auto">Disusun lebih ringkas agar calon pelanggan cepat paham sebelum menghubungi admin atau mengisi form booking.</p>
            </div>

            <div class="space-y-4 md:space-y-5">
                @forelse($faqs as $faq)
                    <div class="overflow-hidden rounded-[1.75rem] border border-slate-100 bg-white shadow-sm transition-all duration-300 hover:shadow-lg"
                        data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <button type="button" class="flex w-full items-center justify-between gap-4 px-6 py-5 text-left md:px-8 md:py-6"
                            @click="activeFaq = activeFaq === {{ $loop->index }} ? null : {{ $loop->index }}">
                            <div class="flex items-start gap-4">
                                <div class="flex h-11 w-11 shrink-0 items-center justify-center rounded-2xl bg-amber-50 text-base font-black text-[#C9A14A]">
                                    {{ str_pad((string) ($loop->iteration), 2, '0', STR_PAD_LEFT) }}
                                </div>
                                <h3 class="pt-1 text-lg font-black leading-snug tracking-tight text-[#0B0B0B] md:text-xl font-heading">
                                    {{ $faq->question }}
                                </h3>
                            </div>
                            <span class="flex h-10 w-10 shrink-0 items-center justify-center rounded-full bg-slate-100 text-slate-600 transition-all"
                                :class="activeFaq === {{ $loop->index }} ? 'rotate-45 bg-amber-50 text-[#C9A14A]' : ''">+</span>
                        </button>
                        <div x-show="activeFaq === {{ $loop->index }}" x-transition.opacity.duration.200ms class="border-t border-slate-100 px-6 py-5 text-sm leading-7 text-slate-500 md:px-8 md:text-base">
                            {{ $faq->answer }}
                        </div>
                    </div>
                @empty
                    <div class="page-empty-state" data-aos="fade-up">
                        <div
                            class="w-24 h-24 bg-slate-100 rounded-[2.5rem] flex items-center justify-center text-slate-300 mx-auto mb-8">
                            <i class="fa-solid fa-circle-question text-slate-300 text-5xl"></i>
                        </div>
                        <h4 class="text-2xl font-black text-slate-900 mb-4">Belum ada pertanyaan</h4>
                        <p class="text-slate-400 font-medium">Silakan hubungi admin kami untuk bantuan lebih lanjut.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection

