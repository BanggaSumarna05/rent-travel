<div x-data="{
    open: false,
    rating: 0,
    submitted: false,
    hover: 0
}" class="fixed bottom-24 right-6 lg:right-16 z-40">
    <!-- Trigger Button -->
    <button @click="open = !open"
            class="w-12 h-12 bg-white text-gold rounded-full shadow-2xl border border-amber-100 flex items-center justify-center hover:scale-110 transition-all duration-500 group">
        <svg x-show="!open" class="w-6 h-6 group-hover:rotate-12 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
        </svg>
        <svg x-show="open" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
        </svg>
    </button>

    <!-- Feedback Panel -->
    <div x-show="open"
         x-cloak
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0 translate-y-4 scale-95"
         x-transition:enter-end="opacity-100 translate-y-0 scale-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100 translate-y-0 scale-100"
         x-transition:leave-end="opacity-0 translate-y-4 scale-95"
         class="absolute bottom-16 right-0 w-72 sm:w-80 bg-white rounded-[2rem] shadow-4xl border border-amber-50 p-8">

        <div x-show="!submitted">
            <h4 class="text-xl font-black text-gray-900 mb-2 font-heading tracking-tight">Apa Pendapat Anda?</h4>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest mb-6 leading-relaxed">Masukan Anda sangat berharga bagi kami.</p>

            <div class="flex justify-center gap-2 mb-8">
                <template x-for="i in 5">
                    <button @mouseenter="hover = i"
                            @mouseleave="hover = 0"
                            @click="rating = i"
                            class="p-1 focus:outline-none transition-transform hover:scale-125 duration-300">
                        <svg class="w-8 h-8"
                             :class="(hover >= i || rating >= i) ? 'text-gold fill-current' : 'text-gray-200 fill-transparent'"
                             stroke="currentColor" stroke-width="1.5" viewBox="0 0 24 24">
                             <path stroke-linecap="round" stroke-linejoin="round" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.54 1.118l-3.976-2.888a1 1 0 00-1.175 0l-3.976 2.888c-.784.57-1.838-.197-1.539-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                        </svg>
                    </button>
                </template>
            </div>

            <textarea placeholder="Ceritakan pengalaman Anda..."
                      class="w-full px-4 py-3 bg-gray-50 border border-transparent rounded-xl focus:outline-none focus:ring-2 focus:ring-gold/20 focus:border-gold transition-all text-xs font-medium mb-6 placeholder-gray-300 resize-none h-24"></textarea>

            <button @click="submitted = true; setTimeout(() => open = false, 3000)"
                    :disabled="rating === 0"
                    class="w-full py-4 bg-black text-white rounded-xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl hover:bg-gold transition-all disabled:opacity-30 disabled:cursor-not-allowed">
                Kirim Masukan
            </button>
        </div>

        <div x-show="submitted" class="text-center py-4">
            <div class="w-16 h-16 bg-gold/10 rounded-full flex items-center justify-center text-gold mx-auto mb-6">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            </div>
            <h4 class="text-xl font-black text-gray-900 mb-2 font-heading tracking-tight">Terima Kasih!</h4>
            <p class="text-[10px] text-gray-400 font-bold uppercase tracking-widest leading-relaxed">Kami sangat menghargai kontribusi Anda untuk kemajuan kami.</p>
        </div>
    </div>
</div>

<style>
    .shadow-4xl {
        box-shadow: 0 40px 100px -30px rgba(0, 0, 0, 0.2);
    }
</style>
