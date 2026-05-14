@extends('layouts.admin')

@section('title', 'Log Aktivitas')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/10">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase">
                        Log <span class="gold-gradient-text italic">Aktivitas</span>
                    </h2>
                    <p class="text-slate-500 font-semibold text-sm">
                        Rekam jejak tindakan administrator di dalam sistem.
                    </p>
                </div>
            </div>
            <div class="w-full md:w-80">
                <form action="{{ route('admin.activity-logs.index') }}" method="GET" class="relative">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari aktivitas atau modul..."
                        class="w-full bg-white border-slate-100 rounded-2xl focus:ring-2 focus:ring-amber-500/20 text-sm font-bold placeholder-slate-400 py-4 pl-12 shadow-sm">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4 top-1/2 -translate-y-1/2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                    </svg>
                </form>
            </div>
        </div>

        <!-- Table Section -->
        <div class="bg-white rounded-[3rem] shadow-sm border border-slate-100 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50">
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Waktu & User</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Aktivitas</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Modul</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Keterangan</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Perangkat</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($logs as $log)
                            <tr class="group hover:bg-slate-50/30 transition-all duration-500">
                                <td class="px-8 py-8">
                                    <div class="flex flex-col gap-1">
                                        <div class="text-sm font-black text-slate-900 tracking-tight">{{ $log->created_at->format('d M Y, H:i') }}</div>
                                        <div class="flex items-center gap-2">
                                            <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                            <span class="text-[10px] font-bold text-slate-500 uppercase tracking-widest">{{ $log->user?->name ?? 'System' }}</span>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-8">
                                    <span class="px-4 py-2 bg-slate-900 text-amber-400 rounded-xl text-[10px] font-black uppercase tracking-widest shadow-lg shadow-slate-950/5">
                                        {{ $log->activity }}
                                    </span>
                                </td>
                                <td class="px-8 py-8">
                                    <span class="text-[11px] font-black text-slate-600 uppercase tracking-widest bg-slate-50 px-3 py-1 rounded-lg">
                                        {{ $log->module }}
                                    </span>
                                </td>
                                <td class="px-8 py-8">
                                    <div class="text-[11px] font-bold text-slate-500 leading-relaxed max-w-md italic">
                                        "{{ $log->description }}"
                                    </div>
                                </td>
                                <td class="px-8 py-8 text-right">
                                    <div class="flex flex-col items-end gap-1">
                                        <div class="text-[10px] font-black text-slate-900">{{ $log->ip_address }}</div>
                                        <div class="text-[8px] font-bold text-slate-400 uppercase tracking-tighter truncate max-w-[150px]" title="{{ $log->user_agent }}">
                                            {{ Str::limit($log->user_agent, 40) }}
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Empty State -->
            @if($logs->isEmpty())
                <div class="py-32 px-10 text-center bg-slate-50/20">
                    <div class="w-24 h-24 bg-white rounded-[2.5rem] shadow-xl border border-slate-100 flex items-center justify-center mx-auto mb-6">
                        <svg class="w-12 h-12 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-slate-900 mb-2 uppercase tracking-tighter">Belum Ada Catatan</h3>
                    <p class="text-slate-500 font-bold text-sm italic">Sistem belum merekam aktivitas apa pun.</p>
                </div>
            @endif

            @if ($logs->hasPages())
                <div class="px-10 py-10 border-t border-slate-50 bg-slate-50/20">
                    {{ $logs->links() }}
                </div>
            @endif
        </div>
    </div>

    <style>
        .animate-fade-in {
            animation: luxuryFadeIn 1s cubic-bezier(0, 0, 0.2, 1);
        }
        @keyframes luxuryFadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
@endsection
