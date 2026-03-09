@extends('layouts.frontend')

@section('title', $post->title . ' - ' . \App\Models\Setting::get('site_name', 'Rent Travel'))

@section('content')
    <!-- Header Section -->
    <section class="relative pt-32 pb-16 bg-white overflow-hidden">
        <div class="absolute top-0 left-0 w-[400px] h-[400px] bg-amber-50/50 blur-[100px] rounded-full -ml-24 -mt-24"></div>
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
            <x-breadcrumb :items="[['label' => 'Post', 'url' => route('posts.index')], ['label' => $post->title]]" />

            <div class="mt-10 mb-8 inline-flex items-center gap-4">
                <span
                    class="px-6 py-2.5 rounded-full bg-amber-50 border border-amber-200 gold-gradient-text font-black text-[10px] uppercase tracking-[0.3em] shadow-sm shadow-amber-900/5">
                    {{ $post->published_at ? $post->published_at->format('d M Y') : 'Terbaru' }}
                </span>
            </div>

            <h1
                class="text-4xl md:text-5xl lg:text-7xl font-black text-slate-900 mb-8 font-heading tracking-tighter leading-[0.9]">
                {{ $post->title }}
            </h1>
        </div>
    </section>

    <!-- Article Content -->
    <article class="pb-24 bg-white relative">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">
            <!-- Hero Image -->
            <div
                class="relative -mt-8 mb-20 rounded-[3.5rem] overflow-hidden shadow-[0_50px_100px_-20px_rgba(15,23,42,0.15)] border-8 border-white aspect-[21/9]">
                <img src="{{ $post->getFirstMediaUrl('posts') ?: 'https://images.unsplash.com/photo-1504711434969-e33886168f5c?auto=format&fit=crop&q=80&w=1200' }}"
                    alt="{{ $post->title }}" class="w-full h-full object-cover">
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
                            <a href="#"
                                class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-slate-900 hover:text-[#D4AF37] hover:border-slate-900 transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z" />
                                </svg>
                            </a>
                            <a href="#"
                                class="w-10 h-10 rounded-full border border-slate-100 flex items-center justify-center text-slate-400 hover:bg-slate-900 hover:text-[#D4AF37] hover:border-slate-900 transition-all duration-300">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24">
                                    <path
                                        d="M9 8h-3v4h3v12h5v-12h3.642l.358-4h-4v-1.667c0-.955.192-1.333 1.115-1.333h2.885v-5h-3.808c-3.596 0-5.192 1.583-5.192 4.615v3.385z" />
                                </svg>
                            </a>
                        </div>
                    </div>

                    <a href="{{ route('posts.index') }}"
                        class="inline-flex items-center gap-3 text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] group">
                        <svg class="w-5 h-5 transition-transform group-hover:-translate-x-2 text-[#D4AF37]" fill="none"
                            stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3"
                                d="M7 16l-4-4m0 0l4-4m-4 4h18"></path>
                        </svg>
                        Kembali Ke Post
                    </a>
                </div>
            </div>
        </div>
    </article>

    @if (!$recentPosts->isEmpty())
        <!-- Recent Posts -->
        <section class="py-24 bg-slate-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <h3 class="text-3xl font-black text-slate-900 mb-12 font-heading tracking-tight text-center">Post <span
                        class="gold-gradient-text">Terkait</span></h3>
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
