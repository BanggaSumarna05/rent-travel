@extends('layouts.frontend')

@section('title', 'Berita & Artikel - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-20 bg-white overflow-hidden">
        <div
            class="absolute top-0 left-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -ml-24 -mt-24 animate-pulse">
        </div>
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <x-breadcrumb :items="[['label' => 'Post']]" />
            <div data-aos="fade-down" class="text-center">
                <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 font-heading tracking-tighter leading-[1]">
                    Wawasan <span class="gold-gradient-text">Perjalanan</span>
                </h1>
                <p class="text-lg text-slate-400 max-w-2xl mx-auto leading-relaxed font-medium">
                    Temukan tips perjalanan, ulasan armada terbaru, dan berita eksklusif dari dunia pariwisata premium.
                </p>
            </div>
        </div>
    </section>

    <!-- News Grid -->
    <section class="py-24 bg-gray-50">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            @if ($posts->isEmpty())
                <div class="text-center py-20">
                    <div
                        class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-sm border border-amber-100">
                        <svg class="w-10 h-10 text-[#D4AF37]" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 100-4 2 2 0 000 4z">
                            </path>
                        </svg>
                    </div>
                    <h3 class="text-2xl font-black text-slate-900 mb-2">Belum Ada Post</h3>
                    <p class="text-slate-400 font-medium">Nantikan update terbaru dari kami segera.</p>
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-10">
                    @foreach ($posts as $post)
                        <article data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}"
                            class="group bg-white rounded-[3rem] overflow-hidden border border-slate-100 shadow-[0_10px_40px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.15)] transition-all duration-700 flex flex-col h-full transform hover:-translate-y-2">
                            <a href="{{ route('posts.show', $post) }}"
                                class="block relative aspect-[16/10] overflow-hidden">
                                <img src="{{ $post->getFirstMediaUrl('posts') ?: ($post->image ? asset('storage/' . $post->image) : 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=800') }}"
                                    alt="{{ $post->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                <div
                                    class="absolute inset-0 bg-black/20 group-hover:bg-black/0 transition-colors duration-500">
                                </div>
                                <div class="absolute top-6 left-6">
                                    <span
                                        class="px-5 py-2.5 bg-white/90 backdrop-blur-md rounded-xl text-[10px] font-black text-slate-900 uppercase tracking-widest shadow-lg border border-white/20">
                                        {{ $post->published_at ? $post->published_at->format('d M Y') : 'Baru' }}
                                    </span>
                                </div>
                            </a>

                            <div class="p-10 flex flex-col flex-1">
                                <h2
                                    class="text-xl font-black text-slate-900 mb-4 font-heading tracking-tight leading-snug group-hover:gold-gradient-text transition-colors duration-300">
                                    <a href="{{ route('posts.show', $post) }}">{{ $post->title }}</a>
                                </h2>
                                <p class="text-slate-400 text-sm font-medium leading-relaxed mb-8 line-clamp-3 italic">
                                    {{ Str::limit(strip_tags($post->content), 120) }}
                                </p>

                                <div class="mt-auto pt-8 border-t border-slate-100 flex items-center justify-between">
                                    <a href="{{ route('posts.show', $post) }}"
                                        class="inline-flex items-center gap-3 text-[10px] font-black text-slate-900 uppercase tracking-[0.3em] group/btn">
                                        Baca Selengkapnya
                                        <svg class="w-4 h-4 transition-transform group-hover/btn:translate-x-2 text-[#D4AF37]"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                                d="M17 8l4 4m0 0l-4 4m4-4H3"></path>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-20 flex justify-center">
                    {{ $posts->links() }}
                </div>
            @endif
        </div>
    </section>

    <style>
        .shadow-4xl {
            box-shadow: 0 40px 100px -20px rgba(212, 175, 55, 0.12);
        }
    </style>
@endsection
