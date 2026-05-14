@extends('layouts.frontend')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'))

@section('content')
    @php
        $shareUrl = urlencode(request()->fullUrl());
        $shareText = urlencode($post->title . ' | ' . \App\Models\Setting::get('site_name', 'CJA RENT CAR'));
    @endphp

    <!-- Header Section -->
    <section class="relative pt-32 pb-16 bg-white overflow-hidden">
        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -ml-24 -mt-24"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <x-breadcrumb :items="[['label' => 'Artikel', 'url' => route('posts.index')], ['label' => $post->title]]" />

            <div class="mt-10 mb-8 inline-flex items-center gap-4">
                <span
                    class="px-6 py-2.5 rounded-full bg-amber-50 border border-amber-200 gold-gradient-text font-black text-[10px] uppercase tracking-[0.3em] shadow-sm shadow-amber-900/5">
                    {{ $post->published_at ? $post->published_at->format('d M Y') : 'Terbaru' }}
                </span>
            </div>

            <h1
                class="text-2xl sm:text-4xl md:text-5xl lg:text-7xl font-black text-slate-900 mb-6 md:mb-8 font-heading tracking-tighter leading-[0.95]">
                {{ $post->title }}
            </h1>

            <p class="mx-auto max-w-3xl text-sm leading-relaxed text-slate-500 md:text-base">
                {{ $post->excerpt ?? Str::limit(strip_tags($post->content), 170) }}
            </p>
        </div>
    </section>

    <!-- Article Content -->
    <article class="pb-24 bg-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Image -->
            <div
                class="relative -mt-6 mb-12 md:mb-20 rounded-[2rem] md:rounded-[3.5rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(15,23,42,0.15)] border-4 md:border-8 border-white aspect-[16/9]">
                <img src="{{ $post->getFirstMediaUrl('posts') ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=1200' }}"
                    alt="{{ $post->title }} - artikel rental mobil Tasikmalaya" class="w-full h-full object-cover">
            </div>

            <div class="max-w-3xl mx-auto">
                <!-- Content Body -->
                <div
                    class="prose prose-lg prose-slate max-w-none prose-headings:font-black prose-headings:font-heading prose-headings:tracking-tighter prose-headings:text-slate-900 prose-p:text-slate-500 prose-p:leading-relaxed prose-strong:text-slate-900 prose-blockquote:border-[#D4AF37] prose-blockquote:bg-amber-50 prose-blockquote:py-6 prose-blockquote:px-10 prose-blockquote:rounded-[2.5rem] prose-blockquote:italic prose-blockquote:font-medium">
                    {!! nl2br(e($post->content)) !!}
                </div>

                <!-- Share Buttons -->
                <div class="mt-20 pt-10 border-t border-amber-50 flex flex-wrap items-center justify-between gap-6">
                    <div class="flex items-center gap-4">
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Bagikan:</span>
                        <div class="flex items-center gap-3">
                            <a href="https://twitter.com/intent/tweet?url={{ $shareUrl }}&text={{ $shareText }}"
                                target="_blank" rel="noopener noreferrer"
                                class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-slate-900 hover:text-[#D4AF37] hover:border-slate-900 transition-all duration-300">
                                <i class="fa-brands fa-x-twitter text-sm"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ $shareUrl }}"
                                target="_blank" rel="noopener noreferrer"
                                class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-slate-900 hover:text-[#D4AF37] hover:border-slate-900 transition-all duration-300">
                                <i class="fa-brands fa-facebook-f text-sm"></i>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('posts.index') }}"
                        class="inline-flex items-center gap-3 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] group">
                        <i class="fa-solid fa-arrow-left text-lg transition-transform group-hover:-translate-x-2 text-[#D4AF37]"></i>
                        Kembali ke Daftar Berita
                    </a>
                </div>
            </div>
        </div>
    </article>

    @if (!$recentPosts->isEmpty())
        <!-- Recent Posts -->
        <section class="py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-3xl font-black text-slate-900 mb-12 font-heading tracking-tight text-center">Artikel <span
                        class="gold-gradient-text">Rekomendasi</span></h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                    @foreach ($recentPosts as $recent)
                        <article
                            class="group bg-white rounded-[2.5rem] overflow-hidden border border-slate-100 shadow-[0_10px_30px_-10px_rgba(0,0,0,0.05)] hover:shadow-[0_40px_80px_-20px_rgba(15,23,42,0.15)] transition-all duration-700 transform hover:-translate-y-2">
                            <a href="{{ route('posts.show', $recent) }}" class="block aspect-[16/9] overflow-hidden">
                                <img src="{{ $recent->getFirstMediaUrl('posts') ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=400' }}"
                                    alt="{{ $recent->title }}"
                                    class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                            </a>
                            <div class="p-8">
                                <h4
                                    class="text-lg font-black text-slate-900 mb-4 font-heading tracking-tight line-clamp-2 group-hover:gold-gradient-text transition-colors">
                                    <a href="{{ route('posts.show', $recent) }}">{{ $recent->title }}</a>
                                </h4>
                                <div class="flex items-center justify-between">
                                    <span
                                        class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $recent->published_at ? $recent->published_at->format('d M Y') : 'Baru' }}</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    <style>
        .shadow-4xl {
            box-shadow: 0 40px 100px -20px rgba(212, 175, 55, 0.15);
        }
    </style>
@endsection
