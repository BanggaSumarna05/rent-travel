@extends('layouts.frontend')

@section('title', 'Berita & Artikel - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    <x-frontend.page-hero
        :items="[['label' => 'Artikel']]"
        badge="Artikel Rental Mobil Tasikmalaya"
        title="Tips, Panduan, dan"
        highlight="Info Sewa Mobil"
        description="Baca artikel seputar rental mobil Tasikmalaya, tips perjalanan, referensi wisata, dan panduan memilih armada agar booking Anda lebih tepat."
        glow="left"
    />

    <!-- News Grid -->
    <section class="page-section-large page-section-muted">
        <div class="page-shell">
            @if ($posts->isEmpty())
                <div class="page-empty-state">
                    <div
                        class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-sm border border-amber-100">
                        <i class="fa-solid fa-newspaper text-3xl text-[#D4AF37]"></i>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Belum Ada Post</h3>
                    <p class="text-slate-400 font-medium">Nantikan update terbaru dari kami segera.</p>
                </div>
            @else
                <div class="page-grid-3">
                    @foreach ($posts as $post)
                        <article data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}"
                            class="surface-card group flex h-full flex-col overflow-hidden transition-all duration-500 hover:-translate-y-1 hover:border-amber-200/60 hover:shadow-xl">
                            <a href="{{ route('posts.show', $post) }}"
                                class="block relative aspect-[16/10] overflow-hidden">
                                <img src="{{ $post->getFirstMediaUrl('posts') ?: ($post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=800') }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700" loading="lazy">
                                <div
                                    class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors duration-500">
                                </div>
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="rounded-xl border border-white/20 bg-white/90 px-5 py-2.5 text-[10px] font-black uppercase tracking-widest text-slate-900 shadow-lg backdrop-blur-md">
                                        {{ $post->published_at ? $post->published_at->format('d M Y') : 'Baru' }}
                                    </span>
                                </div>
                            </a>

                            <div class="flex flex-1 flex-col p-7 md:p-8">
                                <h2
                                    class="mb-4 text-xl font-black leading-snug tracking-tight text-slate-900 transition-colors duration-300 group-hover:text-amber-600">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="mb-8 line-clamp-3 text-sm font-medium leading-relaxed text-slate-500">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <div class="mt-auto flex items-center justify-between border-t border-slate-100 pt-6">
                                    <a href="{{ route('posts.show', $post) }}"
                                        class="inline-flex items-center gap-3 text-[10px] font-black uppercase tracking-[0.3em] text-slate-900 group/btn">
                                        Baca Artikel
                                        <i class="fa-solid fa-arrow-right text-[#D4AF37] transition-transform group-hover/btn:translate-x-2"></i>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="page-pagination">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection

