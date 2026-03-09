@extends('layouts.admin')

@section('title', 'Manajemen FAQ')

@section('content')
<div class="space-y-10 animate-in fade-in duration-700">
    <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
        <div>
            <h2 class="text-3xl font-black text-slate-800 font-heading tracking-tighter">Daftar FAQ</h2>
            <p class="text-slate-400 font-medium mt-1">Kelola pertanyaan umum dan jawaban untuk membantu pelanggan.</p>
        </div>
        <a href="{{ route('admin.faqs.create') }}" class="flex items-center gap-3 px-8 py-4 bg-slate-800 text-white rounded-2xl font-black text-sm hover:bg-slate-900 transition-all shadow-lg shadow-black/10 active:scale-95">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path></svg>
            Tambah FAQ
        </a>
    </div>

    <div class="bg-white rounded-[3rem] shadow-sm border border-gray-100 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50/50 border-b border-gray-100">
                        <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Pertanyaan & Jawaban</th>
                        <th class="px-10 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-50">
                    @foreach($faqs as $faq)
                    <tr class="group hover:bg-slate-50/50 transition-colors">
                        <td class="px-10 py-8">
                            <div class="space-y-4 max-w-3xl">
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-slate-100 rounded-lg flex items-center justify-center text-slate-800 font-black text-xs shrink-0">Q</div>
                                    <div class="text-lg font-black text-slate-800 tracking-tight leading-snug">{{ $faq->question }}</div>
                                </div>
                                <div class="flex items-start gap-4">
                                    <div class="w-8 h-8 bg-teal-50 rounded-lg flex items-center justify-center text-teal-600 font-black text-xs shrink-0">A</div>
                                    <p class="text-sm text-slate-500 font-medium leading-relaxed">{{ $faq->answer }}</p>
                                </div>
                            </div>
                        </td>
                        <td class="px-10 py-8 text-right">
                            <div class="flex justify-end gap-3">
                                <a href="{{ route('admin.faqs.edit', $faq) }}" class="p-3 bg-slate-50 text-slate-600 rounded-xl hover:bg-slate-100 hover:text-slate-900 transition-all border border-gray-100">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                </a>
                                <form action="{{ route('admin.faqs.destroy', $faq) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus FAQ ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-3 bg-slate-50 text-slate-600 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all border border-gray-100">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
