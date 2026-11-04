<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Admin Dashboard') | BYD Sales Control Center</title>

    <!-- Dynamic Favicon from setting -->
    <link rel="icon" type="image/svg+xml" href="{{ asset(\App\Models\Setting::get('favicon_path', 'images/favicon.svg')) }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- FontAwesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Alpine.js -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS (via Vite) -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #070B16;
            color: #E2E8F0;
        }
        .admin-sidebar {
            background: #050811;
            border-right: 1px solid rgba(0, 210, 255, 0.12);
        }
        .admin-card {
            background: #0B1124;
            border: 1px solid rgba(56, 189, 248, 0.12);
        }
    </style>
</head>
<body class="bg-[#070B16] text-slate-100 min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Mobile Sidebar Backdrop -->
    <div x-show="sidebarOpen" 
         @click="sidebarOpen = false" 
         class="fixed inset-0 bg-black/60 z-40 lg:hidden"
         style="display: none;"></div>

    <!-- Sidebar -->
    <aside :class="sidebarOpen ? 'translate-x-0' : '-translate-x-full lg:translate-x-0'"
           class="fixed inset-y-0 left-0 z-50 w-64 admin-sidebar transition-transform duration-300 flex flex-col justify-between">
        
        <div>
            <!-- Sidebar Header / Logo -->
            <div class="h-20 px-6 flex items-center justify-between border-b border-slate-800">
                <a href="{{ route('admin.dashboard') }}" class="flex items-center space-x-3">
                    <img src="{{ asset(\App\Models\Setting::get('logo_path', 'images/byd-logo.svg')) }}" 
                         alt="BYD Logo" 
                         class="h-8 w-auto object-contain"
                         onerror="this.src='{{ asset('images/byd-logo.svg') }}'">
                </a>
                <button @click="sidebarOpen = false" class="lg:hidden text-slate-400 hover:text-white">
                    <i class="fa-solid fa-xmark text-lg"></i>
                </button>
            </div>

            <!-- Navigation Links -->
            <nav class="p-4 space-y-1.5 text-sm font-semibold">
                <p class="px-3 pt-2 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-500">Menu Utama</p>

                <a href="{{ route('admin.dashboard') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.dashboard') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-chart-pie w-5 text-center"></i>
                    <span>Dashboard</span>
                </a>

                <a href="{{ route('admin.inquiries.index') }}" 
                   class="flex items-center justify-between px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.inquiries.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <div class="flex items-center space-x-3">
                        <i class="fa-solid fa-envelope-open-text w-5 text-center"></i>
                        <span>Prospek &amp; Test Drive</span>
                    </div>
                    @php
                        $newCount = \App\Models\Inquiry::where('status', 'baru')->count();
                    @endphp
                    @if($newCount > 0)
                        <span class="px-2 py-0.5 rounded-full bg-cyan-500 text-black text-xs font-black">
                            {{ $newCount }}
                        </span>
                    @endif
                </a>

                <p class="px-3 pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-500">Konten Mobil &amp; Web</p>

                <a href="{{ route('admin.cars.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.cars.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-car-side w-5 text-center"></i>
                    <span>Model &amp; Varian Mobil</span>
                </a>

                <a href="{{ route('admin.sliders.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.sliders.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-images w-5 text-center"></i>
                    <span>Hero Sliders</span>
                </a>

                <a href="{{ route('admin.promos.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.promos.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-tags w-5 text-center"></i>
                    <span>Promo &amp; Diskon</span>
                </a>

                <a href="{{ route('admin.news.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.news.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-newspaper w-5 text-center"></i>
                    <span>Berita &amp; Artikel</span>
                </a>

                <p class="px-3 pt-4 pb-1 text-[11px] font-bold uppercase tracking-wider text-slate-500">Konfigurasi</p>

                <a href="{{ route('admin.sales.edit') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.sales.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-user-tie w-5 text-center"></i>
                    <span>Profil Sales Consultant</span>
                </a>

                <a href="{{ route('admin.settings.index') }}" 
                   class="flex items-center space-x-3 px-3 py-2.5 rounded-xl transition-colors {{ request()->routeIs('admin.settings.*') ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'text-slate-400 hover:text-white hover:bg-slate-900' }}">
                    <i class="fa-solid fa-sliders w-5 text-center"></i>
                    <span>Logo, Favicon &amp; OG Graph</span>
                </a>
            </nav>
        </div>

        <!-- Sidebar Footer / Logout -->
        <div class="p-4 border-t border-slate-800 space-y-2">
            <a href="{{ route('home') }}" target="_blank" 
               class="flex items-center justify-between px-3 py-2 text-xs text-cyan-400 hover:text-cyan-300 font-semibold bg-slate-900/60 rounded-xl border border-slate-800">
                <span>Lihat Frontend Web</span>
                <i class="fa-solid fa-arrow-up-right-from-square"></i>
            </a>

            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-full flex items-center space-x-3 px-3 py-2 text-xs text-rose-400 hover:bg-rose-500/10 rounded-xl transition-colors font-semibold">
                    <i class="fa-solid fa-arrow-right-from-bracket w-5 text-center"></i>
                    <span>Keluar (Logout)</span>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content Area -->
    <div class="flex-1 lg:pl-64 flex flex-col min-w-0">
        
        <!-- Top Navbar -->
        <header class="h-20 bg-[#050811] border-b border-slate-800 px-6 sm:px-8 flex items-center justify-between sticky top-0 z-30">
            <div class="flex items-center space-x-4">
                <button @click="sidebarOpen = true" class="lg:hidden p-2 rounded-lg bg-slate-900 text-slate-300 hover:text-white">
                    <i class="fa-solid fa-bars text-lg"></i>
                </button>
                <h1 class="text-lg font-bold text-white">
                    @yield('header_title', 'Dashboard')
                </h1>
            </div>

            <div class="flex items-center space-x-4">
                <div class="hidden sm:flex items-center space-x-2 px-3 py-1.5 rounded-full bg-cyan-950/60 border border-cyan-500/30 text-xs text-cyan-300">
                    <i class="fa-solid fa-shield-halved text-cyan-400"></i>
                    <span>{{ auth()->user()->name }}</span>
                </div>
            </div>
        </header>

        <!-- Body Content -->
        <main class="p-6 sm:p-8 flex-1">
            <!-- Flash Message -->
            @if(session('success'))
                <div class="mb-6 p-4 rounded-2xl bg-emerald-950/70 border border-emerald-500/40 text-emerald-300 text-sm flex items-center space-x-3">
                    <i class="fa-solid fa-circle-check text-lg"></i>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="mb-6 p-4 rounded-2xl bg-rose-950/70 border border-rose-500/40 text-rose-300 text-sm">
                    <p class="font-bold mb-1 flex items-center"><i class="fa-solid fa-circle-exclamation mr-2"></i> Periksa kesalahan pengisian:</p>
                    <ul class="list-disc list-inside text-xs space-y-1">
                        @foreach($errors->all() as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @yield('content')
        </main>

        <!-- Footer -->
        <footer class="px-8 py-4 bg-[#050811] border-t border-slate-800 text-xs text-slate-500 flex justify-between items-center">
            <span>BYD Sales Portal &bull; Automotive Content Management</span>
            <span>Laravel {{ app()->version() }} &bull; PHP {{ phpversion() }}</span>
        </footer>

    </div>

    @stack('scripts')
</body>
</html>
