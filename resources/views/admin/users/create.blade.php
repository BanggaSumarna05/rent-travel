@extends('layouts.admin')

@section('title', 'Tambah Admin Baru')

@section('content')
    <div class="max-w-4xl space-y-10 animate-fade-in">
        <div class="flex items-center justify-between">
            <a href="{{ route('admin.users.index') }}"
                class="flex items-center gap-3 text-slate-400 hover:text-slate-900 transition-colors font-black text-[10px] uppercase tracking-[0.2em] group">
                <div class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center group-hover:bg-amber-500 group-hover:text-white transition-all">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                </div>
                Kembali ke Daftar
            </a>
        </div>

        <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-10 pb-20">
            @csrf

            <!-- Identity Section -->
            <div class="bg-white rounded-[3rem] p-10 lg:p-14 shadow-sm border border-slate-100 relative overflow-hidden group">
                <div class="absolute top-0 right-0 w-64 h-64 bg-slate-50 rounded-full blur-3xl -mr-32 -mt-32 opacity-50"></div>
                
                <h3 class="text-xl font-black text-slate-900 mb-12 flex items-center gap-5 relative z-10 uppercase tracking-tighter italic">
                    <div class="w-1.5 h-8 bg-amber-500 rounded-full shadow-lg shadow-amber-500/50"></div>
                    Identitas <span class="gold-gradient-text ml-2">Admin</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-12 relative z-10">
                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Nama Lengkap</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('name') border-red-500 @enderror"
                            placeholder="Nama admin" required>
                        @error('name')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Email Resmi</label>
                        <input type="email" name="email" value="{{ old('email') }}"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('email') border-red-500 @enderror"
                            placeholder="email@example.com" required>
                        @error('email')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Password Akun</label>
                        <input type="password" name="password"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight @error('password') border-red-500 @enderror"
                            placeholder="Min. 8 karakter" required>
                        @error('password')
                            <p class="text-red-500 text-[10px] font-black uppercase tracking-widest ml-4 mt-2">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="space-y-4">
                        <label class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] ml-2">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation"
                            class="w-full px-8 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:ring-0 focus:border-amber-500/50 transition-all font-bold text-sm tracking-tight"
                            placeholder="Ulangi password" required>
                    </div>

                    <div class="flex items-center gap-6 p-8 bg-slate-900 rounded-[2rem] border border-white/5 shadow-xl shadow-slate-950/20 md:col-span-2">
                        <div class="relative inline-flex items-center cursor-pointer scale-110">
                            <input type="hidden" name="is_admin" value="0">
                            <input type="checkbox" name="is_admin" value="1" id="is_admin"
                                class="sr-only peer" {{ old('is_admin') ? 'checked' : '' }}>
                            <div
                                class="w-14 h-8 bg-white/10 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[4px] after:left-[4px] after:bg-slate-400 after:rounded-full after:h-6 after:w-6 after:transition-all peer-checked:bg-amber-500 peer-checked:after:bg-white shadow-inner">
                            </div>
                        </div>
                        <label for="is_admin"
                            class="text-xs font-black text-white uppercase tracking-[0.2em] cursor-pointer">Aktifkan Status <span class="gold-gradient-text uppercase not-italic">Administrator</span></label>
                    </div>
                </div>
            </div>

            <button type="submit"
                class="w-full py-8 bg-slate-900 text-amber-400 rounded-[3rem] font-black text-xl tracking-[0.3em] uppercase hover:bg-amber-500 hover:text-white transition-all shadow-2xl shadow-slate-950/20 border border-white/5 relative overflow-hidden group">
                <span class="relative z-10">Daftarkan Admin</span>
                <div class="absolute inset-0 bg-gradient-to-r from-amber-600 to-amber-400 translate-y-full group-hover:translate-y-0 transition-transform duration-700"></div>
            </button>
        </form>
    </div>
@endsection
