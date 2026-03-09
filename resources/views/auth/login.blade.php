<x-guest-layout>
    <div class="relative z-10">
        <!-- Session Status -->
        <x-auth-session-status class="mb-6" :status="session('status')" />

        <div class="mb-10 text-center relative">
            <div
                class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-amber-500/10 border border-amber-500/20 mb-4 shadow-sm shadow-amber-900/10">
                <span class="w-1.5 h-1.5 rounded-full bg-amber-500 animate-pulse"></span>
                <span class="text-[10px] font-black gold-gradient-text uppercase tracking-[0.2em]">Secure Access</span>
            </div>
            <h3 class="text-3xl font-black text-white tracking-tight leading-tight">
                Elite <span class="gold-gradient-text">Member</span>
            </h3>
            <p class="text-slate-400 text-[10px] font-bold uppercase tracking-[0.3em] mt-2">
                Proud Tech Digital Agency</p>

            <div class="flex items-center justify-center gap-3 mt-6">
                <div class="h-[1px] w-8 bg-gradient-to-r from-transparent to-white/10"></div>
                <i class="fa-solid fa-crown text-amber-500/50 text-[10px]"></i>
                <div class="h-[1px] w-8 bg-gradient-to-l from-transparent to-white/10"></div>
            </div>
        </div>

        <form method="POST" action="{{ route('login') }}" class="space-y-6">
            @csrf

            <!-- Email Address -->
            <div class="space-y-2">
                <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-widest ml-1">Email
                    Connection</label>
                <div class="relative group">
                    <div
                        class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-500 transition-colors">
                        <i class="fa-solid fa-envelope text-sm"></i>
                    </div>
                    <input id="email" type="email" name="email" :value="old('email')" required autofocus
                        autocomplete="username" placeholder="your@email.com"
                        class="w-full pl-12 pr-6 py-4 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500/50 focus:bg-white/10 transition-all duration-500 font-bold text-sm tracking-tight text-white placeholder-slate-500 uppercase @error('email') border-red-500/50 @enderror">
                </div>
                <x-input-error :messages="$errors->get('email')"
                    class="mt-2 text-[10px] font-bold text-red-400 uppercase tracking-wider" />
            </div>

            <!-- Password -->
            <div class="space-y-2">
                <div class="flex items-center justify-between ml-1">
                    <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Master
                        Key</label>
                    @if (Route::has('password.request'))
                        <a class="text-[9px] font-black gold-gradient-text uppercase tracking-widest hover:brightness-125 transition-all"
                            href="{{ route('password.request') }}">
                            Forgot?
                        </a>
                    @endif
                </div>
                <div class="relative group">
                    <div
                        class="absolute inset-y-0 left-0 pl-5 flex items-center pointer-events-none text-slate-500 group-focus-within:text-amber-500 transition-colors">
                        <i class="fa-solid fa-shield-halved text-sm"></i>
                    </div>
                    <input id="password" type="password" name="password" required autocomplete="current-password"
                        placeholder="••••••••"
                        class="w-full pl-12 pr-6 py-4 bg-white/5 backdrop-blur-md border border-white/10 rounded-2xl focus:outline-none focus:ring-4 focus:ring-amber-500/10 focus:border-amber-500/50 focus:bg-white/10 transition-all duration-500 font-bold text-sm tracking-tight text-white placeholder-slate-500 @error('password') border-red-500/50 @enderror">
                </div>
                <x-input-error :messages="$errors->get('password')"
                    class="mt-2 text-[10px] font-bold text-red-400 uppercase tracking-wider" />
            </div>

            <!-- Remember Me -->
            <div class="flex items-center justify-between pb-2">
                <label for="remember_me" class="inline-flex items-center cursor-pointer group">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="w-4 h-4 rounded border-white/10 bg-white/5 text-amber-500 shadow-sm focus:ring-amber-500/20 focus:ring-offset-0 transition-all">
                    <span
                        class="ms-3 text-[10px] font-bold text-slate-400 uppercase tracking-widest group-hover:text-slate-300 transition-colors">{{ __('Remember Session') }}</span>
                </label>
            </div>

            <button type="submit"
                class="w-full py-5 bg-slate-900 text-white rounded-2xl font-black text-xs uppercase tracking-[0.2em] gold-btn transition-all duration-500 shadow-2xl shadow-amber-950/20 active:scale-95 group overflow-hidden relative">
                <div
                    class="absolute inset-0 bg-gradient-to-r from-amber-600/0 via-white/10 to-amber-600/0 -translate-x-full group-hover:animate-shimmer">
                </div>
                <span class="relative flex items-center justify-center gap-3">
                    Authenticate
                    <i class="fa-solid fa-arrow-right-long group-hover:translate-x-1 transition-transform"></i>
                </span>
            </button>
        </form>

        <!-- Footer Note -->
        <div class="mt-10 text-center">
            <p class="text-[9px] font-black text-slate-500 uppercase tracking-[0.4em]">
                Protected by Proud <span class="text-slate-400">Security</span> Protocols
            </p>
        </div>
    </div>
</x-guest-layout>
