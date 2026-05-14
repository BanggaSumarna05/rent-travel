@extends('layouts.admin')

@section('title', 'Manajemen Admin')

@section('content')
    <div class="space-y-8 animate-fade-in">
        <!-- Header Section -->
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-6">
            <div class="flex items-center gap-4">
                <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/10">
                    <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                    </svg>
                </div>
                <div>
                    <h2 class="text-2xl md:text-3xl font-black text-slate-900 tracking-tight leading-tight uppercase">
                        Manajemen <span class="gold-gradient-text italic">Admin</span>
                    </h2>
                    <p class="text-slate-500 font-semibold text-sm">
                        Kelola akses dan otoritas administrator sistem.
                    </p>
                </div>
            </div>
            <a href="{{ route('admin.users.create') }}"
                class="inline-flex items-center gap-3 px-6 py-4 bg-slate-900 text-amber-400 rounded-2xl font-bold text-sm hover:bg-amber-500 hover:text-white hover:-translate-y-1 transition-all duration-300 shadow-xl shadow-slate-900/10 w-full md:w-auto justify-center group border border-white/5">
                <svg class="w-5 h-5 group-hover:rotate-90 transition-transform duration-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 6v6m0 0v6m0-6h6m-6 0H6"/>
                </svg>
                Tambah Admin Baru
            </a>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 md:gap-6">
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-slate-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-slate-900 rounded-2xl flex items-center justify-center shadow-lg shadow-slate-900/20">
                        <svg class="w-6 h-6 text-amber-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 00-3-3.87m-4-12a4 4 0 010 7.75" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Total Pengguna</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $totalUsers }} <span class="text-xs text-slate-400">Akun</span></div>
                    </div>
                </div>
            </div>
            <div class="bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-md transition-all group overflow-hidden relative">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-amber-50 rounded-full group-hover:scale-150 transition-transform duration-700 opacity-50"></div>
                <div class="flex items-center gap-4 relative z-10">
                    <div class="w-12 h-12 bg-amber-500 rounded-2xl flex items-center justify-center shadow-lg shadow-amber-500/20">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                        </svg>
                    </div>
                    <div>
                        <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-0.5">Status Admin</div>
                        <div class="text-xl font-black text-slate-900 tracking-tight">{{ $totalAdmins }} <span class="text-xs text-slate-400">Akun</span></div>
                    </div>
                </div>
            </div>
            <div class="sm:col-span-2 bg-white p-6 rounded-[2.5rem] border border-slate-100 shadow-sm">
                <form action="{{ route('admin.users.index') }}" method="GET" class="relative items-center flex h-full">
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Cari berdasarkan nama atau email..."
                        class="w-full bg-slate-50 border-none rounded-xl focus:ring-2 focus:ring-amber-500/20 text-sm font-bold placeholder-slate-400 py-4 pl-12">
                    <svg class="w-5 h-5 text-slate-400 absolute left-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Profil Admin</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Email & Kontak</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Hak Akses</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Terdaftar Sejak</th>
                            <th class="px-8 py-8 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Manajemen</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        @foreach ($users as $user)
                            <tr class="group hover:bg-slate-50/30 transition-all duration-500">
                                <td class="px-8 py-8">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 rounded-2xl bg-slate-900 flex items-center justify-center text-amber-500 font-black text-lg shadow-lg shadow-slate-950/10 border border-white/5">
                                            {{ strtoupper(substr($user->name, 0, 1)) }}
                                        </div>
                                        <div>
                                            <div class="text-base font-black text-slate-900 tracking-tight leading-none mb-1">{{ $user->name }}</div>
                                            @if($user->id === auth()->id())
                                                <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded">Sesi Anda</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-8 py-8">
                                    <div class="text-sm font-bold text-slate-600 mb-1">{{ $user->email }}</div>
                                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Email Terverifikasi</div>
                                </td>
                                <td class="px-8 py-8">
                                    @if ($user->is_admin)
                                        <span class="px-4 py-2 bg-slate-900 text-amber-400 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border border-white/10 flex items-center gap-2 w-fit">
                                            <svg class="w-4 h-4 text-amber-500" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z"/>
                                            </svg>
                                            Administrator
                                        </span>
                                    @else
                                        <span class="px-4 py-2 bg-slate-50 text-slate-400 rounded-xl text-[10px] font-black uppercase tracking-[0.2em] border border-slate-100 flex items-center gap-2 w-fit">
                                            <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                                <path d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"/>
                                            </svg>
                                            Pengguna
                                        </span>
                                    @endif
                                </td>
                                <td class="px-8 py-8">
                                    <div class="text-sm font-bold text-slate-900 tracking-tight">{{ $user->created_at->format('d M Y') }}</div>
                                    <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">{{ $user->created_at->diffForHumans() }}</div>
                                </td>
                                <td class="px-8 py-8">
                                    <div class="flex justify-end gap-3">
                                        <a href="{{ route('admin.users.edit', $user) }}"
                                            class="w-10 h-10 bg-slate-900 text-amber-500 rounded-xl flex items-center justify-center hover:bg-amber-500 hover:text-white transition-all shadow-lg shadow-slate-950/10">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                                            </svg>
                                        </a>
                                        @if($user->id !== auth()->id())
                                            <form action="{{ route('admin.users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus admin ini? Log aktivitas mereka akan tetap tersimpan.')">
                                                @csrf @method('DELETE')
                                                <button type="submit"
                                                    class="w-10 h-10 bg-red-50 text-red-500 rounded-xl flex items-center justify-center hover:bg-red-500 hover:text-white transition-all border border-red-100 shadow-lg shadow-red-500/10">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                    </svg>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            @if ($users->hasPages())
                <div class="px-10 py-10 border-t border-slate-50 bg-slate-50/20">
                    {{ $users->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
