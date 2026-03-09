@extends('layouts.admin')

@section('title', 'Edit FAQ')

@section('content')
<div class="max-w-4xl space-y-10 animate-in fade-in slide-in-from-bottom-6 duration-700">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.faqs.index') }}" class="flex items-center gap-3 text-slate-400 hover:text-slate-800 transition-colors font-bold text-sm">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali ke Daftar
        </a>
    </div>

    <form action="{{ route('admin.faqs.update', $faq) }}" method="POST" class="space-y-10 pb-20">
        @csrf
        @method('PUT')
        
        <div class="bg-white rounded-[3rem] p-12 shadow-sm border border-gray-100">
            <h3 class="text-xl font-black text-slate-800 mb-10 flex items-center gap-4">
                <div class="w-1.5 h-6 bg-slate-800 rounded-full"></div>
                Tanya Jawab (FAQ)
            </h3>
            
            <div class="space-y-10">
                <div class="space-y-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Pertanyaan</label>
                    <input type="text" name="question" value="{{ old('question', $faq->question) }}" class="w-full px-8 py-5 bg-gray-50 border border-transparent rounded-[1.5rem] focus:outline-none focus:ring-2 focus:ring-slate-800/20 focus:border-slate-800 transition-all font-bold text-sm tracking-tight @error('question') border-red-500 @enderror" placeholder="Contoh: Bagaimana cara memesan mobil?" required>
                    @error('question') <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p> @enderror
                </div>

                <div class="space-y-4">
                    <label class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-4">Jawaban</label>
                    <textarea name="answer" rows="6" class="w-full px-8 py-6 bg-gray-50 border border-transparent rounded-[2rem] focus:outline-none focus:ring-2 focus:ring-slate-800/20 focus:border-slate-800 transition-all font-bold text-sm tracking-tight resize-none @error('answer') border-red-500 @enderror" placeholder="Berikan jawaban yang jelas dan membantu..." required>{{ old('answer', $faq->answer) }}</textarea>
                    @error('answer') <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p> @enderror
                </div>
            </div>
        </div>

        <button type="submit" class="w-full py-8 bg-slate-900 text-white rounded-[2.5rem] font-black text-xl tracking-widest uppercase hover:bg-teal-500 transition-all shadow-xl shadow-black/10 active:scale-95 duration-500">
            Perbarui FAQ
        </button>
    </form>
</div>
@endsection
