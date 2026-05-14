<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CJA RENT CAR') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700;900&display=swap" rel="stylesheet">

    <!-- CSS -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Outfit', sans-serif !important;
            background-color: #f8fafc !important;
            margin: 0;
            color: #0f172a;
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #b45309 0%, #f59e0b 50%, #d97706 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .login-wrapper {
            background: 
                radial-gradient(circle at top left, rgba(245, 158, 11, 0.05), transparent 40%),
                radial-gradient(circle at bottom right, rgba(15, 23, 42, 0.05), transparent 40%);
        }

        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 1);
            box-shadow: 
                0 50px 100px -20px rgba(15, 23, 42, 0.1),
                0 30px 60px -30px rgba(0, 0, 0, 0.1);
        }

        .form-input {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .form-input:focus {
            transform: translateY(-1px);
            box-shadow: 0 10px 20px -5px rgba(245, 158, 11, 0.15) !important;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="antialiased">
    <div class="login-wrapper min-h-screen flex items-center justify-center p-6 relative overflow-hidden">
        
        <!-- Animated Background Orbs -->
        <div class="absolute top-0 right-0 -mt-24 -mr-24 w-96 h-96 bg-amber-500/10 blur-[120px] rounded-full animate-pulse"></div>
        <div class="absolute bottom-0 left-0 -mb-24 -ml-24 w-96 h-96 bg-slate-400/10 blur-[120px] rounded-full animate-pulse" style="animation-delay: 1s"></div>

        <!-- Content -->
        <div class="relative z-10 w-full max-w-[480px]">
            <div class="text-center mb-10">
                <a href="/" class="inline-block group transition-transform duration-500 hover:scale-105">
                    <div class="w-20 h-20 bg-white rounded-3xl flex items-center justify-center shadow-2xl border border-slate-100 p-4">
                        <img src="{{ \App\Models\Setting::logoUrl() }}" alt="Logo" class="w-full h-full object-contain">
                    </div>
                </a>
            </div>

            <div class="glass-card rounded-[3.5rem] p-10 lg:p-14 relative group overflow-hidden">
                <div class="absolute inset-x-0 top-0 h-2 bg-gradient-to-r from-amber-600 via-amber-200 to-amber-600 opacity-0 group-hover:opacity-100 transition-opacity duration-1000"></div>
                {{ $slot }}
            </div>

            <div class="mt-10 text-center">
                <a href="/"
                    class="text-[10px] font-black text-slate-400 hover:text-slate-900 uppercase tracking-[0.4em] transition-all flex items-center justify-center gap-3">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                    Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>
</body>

</html>


