<x-guest-layout>
    <div class="relative z-10">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <div class="mb-12 text-center">
            <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-50 border border-amber-100 mb-6">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                <span class="text-[10px] font-black gold-gradient-text uppercase tracking-[0.2em]">Akses Terenkripsi</span>
            </div>
            <h3 class="text-3xl font-black text-slate-900 tracking-tighter leading-tight uppercase">
                Masuk ke <span class="gold-gradient-text">Sistem</span>
            </h3>
            <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.3em] mt-3">
                CJA RENT CAR ADMIN</p>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-8">
            @csrf

            <!-- Email Address -->
            <div class="space-y-3">
                <label for="email" class="text-[10px] font-black text-slate-500 uppercase tracking-widest ml-1">Alamat Email</label>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-500 transition-colors">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder="nama@email.com"
                        class="form-input w-full pl-14 pr-6 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:border-amber-500/30 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-300 @error('email') border-red-500/50 @enderror">
                </div>
                <x-input-error :messages="$errors->get('email')" class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-wider ml-1" />
            </div>

            <!-- Password -->
            <div class="space-y-3">
                <div class="flex items-center justify-between ml-1">
                    <label for="password" class="text-[10px] font-black text-slate-500 uppercase tracking-widest">Kata Sandi</label>
                    @if (Route::has('password.request'))
                        <a class="text-[9px] font-black text-amber-600 uppercase tracking-widest hover:text-amber-500 transition-all border-b border-amber-500/20"
                            href="{{ route('password.request') }}">
                            Lupa Sandi?
                        </a>
                    @endif
                </div>
                <div class="relative group">
                    <div class="absolute inset-y-0 left-0 pl-6 flex items-center pointer-events-none text-slate-300 group-focus-within:text-amber-500 transition-colors">
                        <i class="fa-solid fa-shield-halved text-sm"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••"
                        class="form-input w-full pl-14 pr-6 py-5 bg-slate-50 border-2 border-transparent rounded-[1.5rem] focus:outline-none focus:border-amber-500/30 font-bold text-sm tracking-tight text-slate-900 placeholder-slate-300 @error('password') border-red-500/50 @enderror">
                </div>
                <x-input-error :messages="$errors->get('password')" class="mt-2 text-[10px] font-bold text-red-500 uppercase tracking-wider ml-1" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center ml-1">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-5 h-5 rounded-lg border-slate-200 bg-slate-50 text-amber-500 shadow-sm focus:ring-amber-500/20 focus:ring-offset-0 transition-all">
                    <span class="ms-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-slate-600 transition-colors">Ingat Sesi Saya</span>
                </label>
            </div>

            <button type="submit"
                class="w-full py-6 bg-slate-900 text-amber-400 rounded-[1.5rem] font-black text-xs uppercase tracking-[0.3em] transition-all duration-500 shadow-2xl shadow-slate-900/10 active:scale-[0.98] group overflow-hidden relative border border-white/5">
                <div class="absolute inset-x-0 bottom-0 h-1 bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                <span class="relative flex items-center justify-center gap-4">
                    Masuk ke Dashboard
                    <i class="fa-solid fa-arrow-right text-lg transition-transform group-hover:translate-x-2"></i>
                </span>
            </button>
        </form>

        <!-- Footer Note -->
        <div class="mt-14 text-center">
            <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.5em]">
                Secure <span class="text-slate-200">Management</span> Interface
            </p>
        </div>
    </div>
</x-guest-layout>
