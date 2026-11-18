<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator | BYD Sales Control Center</title>

    <link rel="icon" type="image/svg+xml" href="{{ asset($settings['favicon_path'] ?? 'images/favicon.svg') }}">
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #050811;
            color: #E2E8F0;
        }
        .login-card {
            background: rgba(11, 17, 36, 0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(0, 210, 255, 0.2);
            box-shadow: 0 0 40px rgba(0, 102, 255, 0.15);
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center p-4 relative overflow-hidden bg-[#050811]">

    <!-- Background Ambient Glow -->
    <div class="absolute -top-32 -left-32 w-96 h-96 bg-cyan-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -bottom-32 -right-32 w-96 h-96 bg-blue-600/20 rounded-full blur-3xl pointer-events-none"></div>

    <div class="w-full max-w-md relative z-10">
        
        <!-- Brand Logo Header -->
        <div class="text-center mb-8">
            <a href="{{ route('home') }}" class="inline-block">
                <img src="{{ asset($settings['logo_path'] ?? 'images/byd-logo.svg') }}" 
                     alt="BYD Logo" 
                     class="h-12 w-auto mx-auto object-contain"
                     onerror="this.src='{{ asset('images/byd-logo.svg') }}'">
            </a>
            <h2 class="text-2xl font-black text-white mt-4 tracking-tight">Portal Admin Sales</h2>
            <p class="text-xs text-slate-400 mt-1">Kelola slider, varian mobil, tipe OTR, promo &amp; lead prospek</p>
        </div>

        <!-- Login Card -->
        <div class="login-card rounded-3xl p-8 space-y-6">
            
            @if(session('success'))
                <div class="p-3.5 rounded-xl bg-emerald-950/80 border border-emerald-500/40 text-emerald-300 text-xs">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="p-3.5 rounded-xl bg-rose-950/80 border border-rose-500/40 text-rose-300 text-xs">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('admin.login.submit') }}" method="POST" class="space-y-4">
                @csrf

                <!-- Email -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Email Administrator
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                            <i class="fa-regular fa-envelope"></i>
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                               placeholder="admin@example.com"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-cyan-400 focus:outline-none">
                    </div>
                </div>

                <!-- Password -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1.5">
                        Kata Sandi
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-500">
                            <i class="fa-solid fa-lock"></i>
                        </span>
                        <input type="password" name="password" required
                               placeholder="••••••••"
                               class="w-full pl-11 pr-4 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-cyan-400 focus:outline-none">
                    </div>
                </div>

                <!-- Remember Me -->
                <div class="flex items-center justify-between text-xs text-slate-400 pt-1">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="remember" class="rounded bg-slate-900 border-slate-700 text-cyan-500 focus:ring-0">
                        <span>Ingat Sesi Saya</span>
                    </label>
                </div>

                <!-- Submit Button -->
                <button type="submit" 
                        class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-blue-700 hover:from-cyan-400 hover:to-blue-600 text-white font-black text-sm uppercase tracking-wider shadow-lg shadow-cyan-500/25 flex items-center justify-center transition-all">
                    <i class="fa-solid fa-right-to-bracket mr-2"></i>
                    Masuk ke Dashboard
                </button>
            </form>

            <div class="text-center pt-2">
                <a href="{{ route('home') }}" class="text-xs text-slate-400 hover:text-cyan-400 transition-colors">
                    &larr; Kembali ke Tampilan Depan Website
                </a>
            </div>

        </div>

    </div>

</body>
</html>
