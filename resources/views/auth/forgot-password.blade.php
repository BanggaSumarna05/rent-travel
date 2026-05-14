<x-guest-layout>
    <div class="relative z-10">
        <div class="mb-12 text-center">
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter leading-tight uppercase mb-4">
                Lupa <span class="gold-gradient-text">Kata Sandi?</span>
            </h3>
            <p class="text-slate-500 text-xs font-bold leading-relaxed px-4 italic">
                Sebutkan alamat email Anda, dan kami akan mengirimkan instruksi untuk mengatur ulang akses Anda.
            </p>
        </div>

        <!-- Session Status -->
        <x-auth-session-status class="mb-8" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}" class="space-y-8">
            @csrf

            <!-- Email Address -->
            <div class="space-y-3">
                <label for="email" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Konfirmasi Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-500 transition-colors">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        placeholder="nama@email.com"
                        class="form-input w-full pl-14 pr-6 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:border-amber-500/30 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-300">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-wider ml-1" />
            </div>

            <button type="submit"
                class="w-full py-6 bg-slate-900 text-amber-400 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.3em] transition-all duration-500 shadow-2xl shadow-slate-900/10 active:scale-[0.98] group overflow-hidden relative border border-white/5">
                <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                <span class="relative flex items-center justify-center gap-4">
                    Kirim Link Reset
                    <svg class="w-5 h-5 transition-transform group-hover:translate-x-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 19l7-7m0 0l-7-7m7 7H5"/></svg>
                </span>
            </button>
        </form>

        <div class="mt-10 text-center">
            <a href="{{ route('login') }}" class="text-[9px] font-black text-slate-400 hover:text-amber-600 uppercase tracking-[0.2em] transition-all flex items-center justify-center gap-2 group">
                <svg class="w-4 h-4 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                Kembali ke Login
            </a>
        </div>
    </div>
</x-guest-layout>
