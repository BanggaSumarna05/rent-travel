<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'CJA RENT CAR') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Unbreakable CSS Fallback -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        amber: {
                            50: '#fffbeb',
                            100: '#fef3c7',
                            200: '#fde68a',
                            300: '#fcd34d',
                            400: '#fbbf24',
                            500: '#f59e0b',
                            600: '#d97706',
                            700: '#b45309',
                            800: '#92400e',
                            900: '#78350f',
                        }
                    },
                    animation: {
                        'fade-in': 'fadeIn 0.8s ease-out forwards',
                    },
                    keyframes: {
                        fadeIn: {
                            '0%': {
                                opacity: '0',
                                transform: 'translateY(10px)'
                            },
                            '100%': {
                                opacity: '1',
                                transform: 'translateY(0)'
                            },
                        }
                    }
                }
            }
        }
    </script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;700;900&display=swap');

        body {
            font-family: 'Inter', sans-serif !important;
            background-color: #0f172a !important;
            margin: 0;
            color: #e2e8f0;
        }

        .gold-gradient-text {
            background: linear-gradient(135deg, #D4AF37 0%, #F5E050 50%, #B8860B 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            display: inline-block;
        }

        .gold-btn {
            background: linear-gradient(135deg, #D4AF37 0%, #B8860B 100%) !important;
            color: white !important;
            border: none !important;
            transition: all 0.3s ease;
        }

        .gold-btn:hover {
            filter: brightness(1.2) !important;
            transform: translateY(-2px);
            box-shadow: 0 15px 30px -10px rgba(212, 175, 55, 0.4) !important;
        }

        input:focus {
            border-color: #D4AF37 !important;
            background: rgba(255, 255, 255, 0.1) !important;
            outline: none;
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.1) !important;
        }

        .login-wrapper {
            background: radial-gradient(circle at top left, rgba(212, 175, 55, 0.08), transparent 40%),
                radial-gradient(circle at bottom right, rgba(79, 70, 229, 0.08), transparent 40%);
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body class="font-sans antialiased">
    <div class="login-wrapper min-h-screen flex items-center justify-center p-4 sm:p-6 relative overflow-hidden">

        <!-- Content -->
        <div class="relative z-10 w-full max-w-[450px] animate-fade-in">
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <div
                        class="w-20 h-20 bg-white/5 border border-white/10 rounded-[2rem] flex items-center justify-center shadow-2xl backdrop-blur-xl">
                        <img src="{{ asset('logo.jpg') }}" alt="Logo" class="w-14 h-14 object-contain">
                    </div>
                </a>
            </div>

            <div
                class="glass-card bg-[#1e293b]/40 border border-white/10 rounded-[3rem] p-8 sm:p-12 shadow-[0_50px_100px_-20px_rgba(0,0,0,0.5)] backdrop-blur-2xl">
                {{ $slot }}
            </div>

            <div class="mt-8 text-center">
                <a href="/"
                    class="text-[9px] font-black text-slate-500 hover:text-amber-500 uppercase tracking-[0.4em] transition-all flex items-center justify-center gap-3">
                    <i class="fa-solid fa-arrow-left"></i>
                    Return to Hub
                </a>
            </div>
        </div>
    </div>
</body>

</html>
