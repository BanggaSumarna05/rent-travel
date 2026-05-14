<x-guest-layout>
    <div class="relative z-10">
        <div class="mb-10 text-center">
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter leading-tight uppercase mb-4">
                Daftar <span class="gold-gradient-text">Akun Baru</span>
            </h3>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.3em]">
                CJA RENT CAR MEMBERSHIP</p>
        </div>

        <form method="POST" action="{{ route('register') }}" class="space-y-6">
            @csrf

            <!-- Name -->
            <div class="space-y-2">
                <label for="name" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Nama Lengkap</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-500 transition-colors">
                        <i class="fa-solid fa-user text-sm"></i>
                    </div>
                    <input id="name" type="text" name="name" :value="old('name')" required autofocus
                        placeholder="Nama Anda"
                        class="form-input w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-transparent rounded-[1.25rem] focus:outline-none focus:border-amber-500/30 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-300">
                </div>
                <x-input-error :messages="$errors->get('name')" class="mt-2 text-[10px] font-bold text-red-500 ml-1" />
            </div>

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Alamat Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-500 transition-colors">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required
                        placeholder="email@example.com"
                        class="form-input w-full pl-14 pr-6 py-4 bg-slate-50 border-2 border-transparent rounded-[1.25rem] focus:outline-none focus:border-amber-500/30 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-300">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold text-red-500 ml-1" />
            </div>

            <!-- Password -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="space-y-2">
                    <label for="password" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Kata Sandi</label>
                    <input id="password" type="password" name="password" required
                        placeholder="••••••••"
                        class="form-input w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-[1.25rem] focus:outline-none focus:border-amber-500/30 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-300">
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold text-red-500 ml-1" />
                </div>

                <div class="space-y-2">
                    <label for="password_confirmation" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Konfirmasi</label>
                    <input id="password_confirmation" type="password" name="password_confirmation" required
                        placeholder="••••••••"
                        class="form-input w-full px-6 py-4 bg-slate-50 border-2 border-transparent rounded-[1.25rem] focus:outline-none focus:border-amber-500/30 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-300">
                </div>
            </div>

            <button type="submit"
                class="w-full py-6 bg-slate-900 text-amber-400 rounded-[1.25rem] font-black text-xs uppercase tracking-[0.3em] transition-all duration-500 shadow-2xl shadow-slate-900/10 active:scale-[0.98] group overflow-hidden relative border border-white/5 mt-4">
                <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                <span class="relative flex items-center justify-center gap-4">
                    Buat Akun Sekarang
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/></svg>
                </span>
            </button>
        </form>

        <div class="mt-10 text-center">
            <a href="{{ route('login') }}" class="text-[10px] font-black text-slate-400 hover:text-amber-600 uppercase tracking-[0.2em] transition-all">
                Sudah punya akun? <span class="text-slate-900 border-b border-amber-500/20">Masuk di sini</span>
            </a>
        </div>
    </div>
</x-guest-layout>
