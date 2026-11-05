<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    
    <title>@yield('title', $settings['site_title'] ?? 'BYD Sales Indonesia | Dealer Resmi Mobil Listrik BYD')</title>
    <meta name="description" content="@yield('meta_description', $settings['meta_description'] ?? 'Dealer Resmi Mobil Listrik BYD Indonesia. Informasi spesifikasi, harga OTR, promo DP murah, bunga 0%, dan booking test drive.')">
    <meta name="keywords" content="{{ $settings['meta_keywords'] ?? 'BYD, BYD Indonesia, Mobil Listrik, BYD Seal, BYD Atto 3, BYD Dolphin, BYD M6' }}">
    <meta name="author" content="{{ $salesProfile?->name ?? 'BYD Sales Specialist' }}">
    <meta name="robots" content="{{ $settings['seo_robots'] ?? 'index, follow' }}">
    <link rel="canonical" href="{{ $settings['seo_canonical_url'] ?? url()->current() }}">

    @if(!empty($settings['google_site_verification']))
    <meta name="google-site-verification" content="{{ $settings['google_site_verification'] }}">
    @endif
    @if(!empty($settings['bing_site_verification']))
    <meta name="msvalidate.01" content="{{ $settings['bing_site_verification'] }}">
    @endif

    <!-- Open Graph / Facebook / WhatsApp Preview -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="@yield('og_title', $settings['og_title'] ?? ($settings['site_title'] ?? 'BYD Sales Indonesia'))">
    <meta property="og:description" content="@yield('og_description', $settings['og_description'] ?? ($settings['meta_description'] ?? 'Informasi harga, promo DP ringan, bunga 0%, dan booking test drive unit BYD.'))">
    <meta property="og:image" content="{{ asset($settings['og_image_path'] ?? 'images/og-image.svg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    <!-- Twitter Card -->
    <meta name="twitter:card" content="{{ $settings['twitter_card'] ?? 'summary_large_image' }}">
    @if(!empty($settings['twitter_site']))
    <meta name="twitter:site" content="{{ $settings['twitter_site'] }}">
    @endif
    <meta name="twitter:title" content="@yield('og_title', $settings['og_title'] ?? ($settings['site_title'] ?? 'BYD Sales Indonesia'))">
    <meta name="twitter:description" content="@yield('og_description', $settings['og_description'] ?? ($settings['meta_description'] ?? 'Informasi harga, promo DP ringan, bunga 0%, dan booking test drive unit BYD.'))">
    <meta name="twitter:image" content="{{ asset($settings['og_image_path'] ?? 'images/og-image.svg') }}">

    <!-- Google Analytics 4 (GA4) -->
    @if(!empty($settings['google_analytics_id']))
    <script async src="https://www.googletagmanager.com/gtag/js?id={{ $settings['google_analytics_id'] }}"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', '{{ $settings['google_analytics_id'] }}');
    </script>
    @endif

    <!-- Google Tag Manager (GTM) -->
    @if(!empty($settings['gtm_container_id']))
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','{{ $settings['gtm_container_id'] }}');</script>
    @endif

    <!-- Meta / Facebook Pixel -->
    @if(!empty($settings['meta_pixel_id']))
    <script>
        !function(f,b,e,v,n,t,s)
        {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
        n.callMethod.apply(n,arguments):n.queue.push(arguments)};
        if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
        n.queue=[];t=b.createElement(e);t.async=!0;
        t.src=v;s=b.getElementsByTagName(e)[0];
        s.parentNode.insertBefore(t,s)}(window, document,'script',
        'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '{{ $settings['meta_pixel_id'] }}');
        fbq('track', 'PageView');
    </script>
    @endif

    {!! $settings['custom_header_scripts'] ?? '' !!}

    <!-- Dynamic Favicon -->
    <link rel="icon" type="image/svg+xml" href="{{ asset($settings['favicon_path'] ?? 'images/favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset($settings['favicon_path'] ?? 'images/favicon.svg') }}">

    <!-- Google Fonts: Plus Jakarta Sans -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- FontAwesome for automotive icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Alpine.js for lightweight, reactive UI -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Tailwind CSS (via Vite) + Custom EV Design System -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #050811;
            color: #E2E8F0;
            overflow-x: hidden;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 8px;
        }
        ::-webkit-scrollbar-track {
            background: #090D1A;
        }
        ::-webkit-scrollbar-thumb {
            background: #0284C7;
            border-radius: 4px;
        }
        ::-webkit-scrollbar-thumb:hover {
            background: #00D2FF;
        }

        /* Ambient Glow & Futuristic Neon Effects */
        .neon-border {
            border: 1px solid rgba(0, 210, 255, 0.25);
            box-shadow: 0 0 20px rgba(0, 102, 255, 0.12);
        }
        .neon-border:hover {
            border-color: rgba(0, 210, 255, 0.6);
            box-shadow: 0 0 30px rgba(0, 210, 255, 0.25);
        }
        .glow-blue {
            text-shadow: 0 0 20px rgba(0, 210, 255, 0.6);
        }
        .bg-grid-pattern {
            background-image: radial-gradient(rgba(0, 210, 255, 0.08) 1px, transparent 1px);
            background-size: 32px 32px;
        }
        .glass-panel {
            background: rgba(11, 19, 43, 0.75);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(56, 189, 248, 0.15);
        }
        .glass-nav {
            background: rgba(5, 8, 17, 0.88);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(0, 210, 255, 0.15);
        }
    </style>

    @stack('styles')
</head>
<body class="bg-[#050811] text-slate-100 antialiased selection:bg-cyan-500 selection:text-black" x-data="{ mobileMenu: false, scrolled: false }" @scroll.window="scrolled = (window.pageYOffset > 50)">

    <!-- Top Info Bar -->
    <div class="hidden md:block bg-[#090D1A] border-b border-cyan-900/30 text-xs text-slate-400 py-2">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div class="flex items-center space-x-6">
                <span class="flex items-center text-cyan-400">
                    <i class="fa-solid fa-bolt mr-2 text-cyan-400 animate-pulse"></i>
                    <span>{{ $settings['dealer_tagline'] ?? 'Official Authorized BYD EV Dealer' }}</span>
                </span>
                <span class="flex items-center">
                    <i class="fa-regular fa-clock mr-2 text-slate-500"></i>
                    <span>{{ $settings['opening_hours'] ?? 'Senin - Minggu: 08:30 - 20:00 WIB' }}</span>
                </span>
            </div>
            <div class="flex items-center space-x-5">
                <a href="tel:{{ $salesProfile?->phone ?? $settings['dealer_phone'] ?? '' }}" class="hover:text-cyan-400 transition-colors flex items-center">
                    <i class="fa-solid fa-phone mr-1.5 text-cyan-400 text-xs"></i>
                    <span>{{ $salesProfile?->phone ?? $settings['dealer_phone'] ?? '+62 812-8899-7722' }}</span>
                </a>
                <span class="text-slate-700">|</span>
                <a href="{{ route('admin.login') }}" class="hover:text-cyan-400 transition-colors flex items-center text-slate-400">
                    <i class="fa-solid fa-lock mr-1.5 text-xs text-cyan-500"></i>
                    <span>Admin Portal</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Main Navigation Bar -->
    <header class="sticky top-0 z-50 transition-all duration-300" :class="scrolled ? 'glass-nav shadow-lg shadow-black/40' : 'bg-[#050811]/90 backdrop-blur-md border-b border-slate-800/80'">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-20">
                
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center space-x-3 group">
                    <img src="{{ asset($settings['logo_path'] ?? 'images/byd-logo.svg') }}" 
                         alt="BYD Logo" 
                         class="h-10 sm:h-12 w-auto object-contain transition-transform duration-300 group-hover:scale-105"
                         onerror="this.src='{{ asset('images/byd-logo.svg') }}'">
                </a>

                <!-- Desktop Navlinks -->
                <nav class="hidden lg:flex items-center space-x-8 text-sm font-semibold">
                    <a href="{{ route('home') }}#hero" class="text-slate-300 hover:text-cyan-400 transition-colors">Beranda</a>
                    <a href="{{ route('home') }}#cars" class="text-slate-300 hover:text-cyan-400 transition-colors">Model &amp; Varian</a>
                    <a href="{{ route('home') }}#simulasi" class="text-slate-300 hover:text-cyan-400 transition-colors">Simulasi Kredit</a>
                    <a href="{{ route('home') }}#promos" class="text-slate-300 hover:text-cyan-400 transition-colors">Promo Spesial</a>
                    <a href="{{ route('home') }}#news" class="text-slate-300 hover:text-cyan-400 transition-colors">Berita EV</a>
                    <a href="{{ route('home') }}#location" class="text-slate-300 hover:text-cyan-400 transition-colors">Lokasi &amp; Maps</a>
                </nav>

                <!-- Desktop Action Buttons -->
                <div class="hidden lg:flex items-center space-x-3">
                    <a href="{{ route('home') }}#test-drive" 
                       class="px-4 py-2.5 rounded-xl border border-cyan-500/40 text-cyan-300 hover:bg-cyan-500/10 hover:border-cyan-400 transition-all duration-300 text-xs font-bold uppercase tracking-wider flex items-center">
                        <i class="fa-solid fa-car-side mr-2"></i>
                        Test Drive
                    </a>
                    
                    @php
                        $waTarget = $salesProfile?->whatsapp ?? $settings['dealer_whatsapp'] ?? '6281288997722';
                        $waClean = preg_replace('/[^0-9]/', '', $waTarget);
                        if (str_starts_with($waClean, '0')) { $waClean = '62' . substr($waClean, 1); }
                    @endphp
                    <a href="https://wa.me/{{ $waClean }}?text={{ urlencode('Halo Sales BYD, saya ingin konsultasi harga OTR dan promo unit BYD.') }}" 
                       target="_blank"
                       class="px-5 py-2.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-xs uppercase tracking-wider shadow-lg shadow-cyan-500/25 hover:shadow-cyan-500/50 hover:brightness-110 transition-all duration-300 flex items-center">
                        <i class="fa-brands fa-whatsapp mr-2 text-sm"></i>
                        WhatsApp Sales
                    </a>
                </div>

                <!-- Mobile Hamburger Button -->
                <div class="lg:hidden flex items-center space-x-2">
                    <a href="https://wa.me/{{ $waClean }}?text={{ urlencode('Halo Sales BYD, saya ingin konsultasi unit.') }}" 
                       target="_blank" 
                       class="p-2.5 rounded-lg bg-green-600/20 text-green-400 border border-green-500/30 text-sm">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <button @click="mobileMenu = !mobileMenu" class="p-2.5 rounded-lg bg-slate-900 border border-slate-700 text-slate-200 hover:text-cyan-400 focus:outline-none">
                        <i class="fa-solid fa-bars text-lg" x-show="!mobileMenu"></i>
                        <i class="fa-solid fa-xmark text-lg" x-show="mobileMenu" style="display: none;"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- Mobile Drawer Menu -->
        <div x-show="mobileMenu" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-start="opacity-100 translate-y-0"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden glass-nav border-b border-cyan-500/20 px-6 py-6 space-y-4" 
             style="display: none;">
            <a href="{{ route('home') }}#hero" @click="mobileMenu = false" class="block text-slate-200 hover:text-cyan-400 text-base font-semibold py-1">Beranda</a>
            <a href="{{ route('home') }}#cars" @click="mobileMenu = false" class="block text-slate-200 hover:text-cyan-400 text-base font-semibold py-1">Model &amp; Varian</a>
            <a href="{{ route('home') }}#simulasi" @click="mobileMenu = false" class="block text-slate-200 hover:text-cyan-400 text-base font-semibold py-1">Simulasi Kredit</a>
            <a href="{{ route('home') }}#promos" @click="mobileMenu = false" class="block text-slate-200 hover:text-cyan-400 text-base font-semibold py-1">Promo Spesial</a>
            <a href="{{ route('home') }}#news" @click="mobileMenu = false" class="block text-slate-200 hover:text-cyan-400 text-base font-semibold py-1">Berita &amp; Artikel</a>
            <a href="{{ route('home') }}#location" @click="mobileMenu = false" class="block text-slate-200 hover:text-cyan-400 text-base font-semibold py-1">Lokasi &amp; Maps</a>
            <div class="pt-4 border-t border-slate-800 flex flex-col space-y-2">
                <a href="{{ route('home') }}#test-drive" @click="mobileMenu = false" class="w-full text-center py-3 rounded-xl border border-cyan-500/40 text-cyan-300 font-bold text-sm">
                    Booking Test Drive
                </a>
                <a href="https://wa.me/{{ $waClean }}?text={{ urlencode('Halo Sales BYD, saya ingin konsultasi unit BYD.') }}" target="_blank" class="w-full text-center py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 text-white font-bold text-sm shadow-md">
                    <i class="fa-brands fa-whatsapp mr-2"></i> WhatsApp Sales
                </a>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="bg-[#03050C] border-t border-slate-800/80 pt-16 pb-12 text-slate-400 relative overflow-hidden">
        <!-- Ambient background glow in footer -->
        <div class="absolute bottom-0 left-1/2 -translate-x-1/2 w-[800px] h-[300px] bg-gradient-to-t from-cyan-950/20 to-transparent pointer-events-none blur-3xl"></div>

        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12 mb-12">
                
                <!-- Col 1: Brand & Tagline -->
                <div class="space-y-4">
                    <img src="{{ asset($settings['logo_path'] ?? 'images/byd-logo.svg') }}" 
                         alt="BYD Logo" 
                         class="h-10 w-auto object-contain"
                         onerror="this.src='{{ asset('images/byd-logo.svg') }}'">
                    <p class="text-sm text-slate-400 leading-relaxed">
                        {{ $settings['dealer_tagline'] ?? 'Official Authorized BYD EV Dealer' }}. Menghadirkan lini kendaraan listrik canggih berteknologi e-Platform 3.0 dan Blade Battery teraman di dunia untuk mobilitas masa depan Anda.
                    </p>
                    <div class="flex items-center space-x-3 pt-2">
                        @if(!empty($settings['social_instagram']))
                            <a href="{{ $settings['social_instagram'] }}" target="_blank" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/40 transition-colors">
                                <i class="fa-brands fa-instagram text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($settings['social_facebook']))
                            <a href="{{ $settings['social_facebook'] }}" target="_blank" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/40 transition-colors">
                                <i class="fa-brands fa-facebook-f text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($settings['social_tiktok']))
                            <a href="{{ $settings['social_tiktok'] }}" target="_blank" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/40 transition-colors">
                                <i class="fa-brands fa-tiktok text-sm"></i>
                            </a>
                        @endif
                        @if(!empty($settings['social_youtube']))
                            <a href="{{ $settings['social_youtube'] }}" target="_blank" class="w-9 h-9 rounded-lg bg-slate-900 border border-slate-800 flex items-center justify-center text-slate-400 hover:text-cyan-400 hover:border-cyan-500/40 transition-colors">
                                <i class="fa-brands fa-youtube text-sm"></i>
                            </a>
                        @endif
                    </div>
                </div>

                <!-- Col 2: Quick Links -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-l-2 border-cyan-400 pl-3">
                        Navigasi Cepat
                    </h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}#hero" class="hover:text-cyan-400 transition-colors">Beranda Utama</a></li>
                        <li><a href="{{ route('home') }}#sales-profile" class="hover:text-cyan-400 transition-colors">Profil Sales Konsultan</a></li>
                        <li><a href="{{ route('home') }}#cars" class="hover:text-cyan-400 transition-colors">Daftar Model &amp; Varian</a></li>
                        <li><a href="{{ route('home') }}#simulasi" class="hover:text-cyan-400 transition-colors">Kalkulator Simulasi Kredit</a></li>
                        <li><a href="{{ route('home') }}#promos" class="hover:text-cyan-400 transition-colors">Promo &amp; Diskon DP</a></li>
                        <li><a href="{{ route('home') }}#test-drive" class="hover:text-cyan-400 transition-colors">Jadwalkan Test Drive</a></li>
                    </ul>
                </div>

                <!-- Col 3: Lineup Mobil Listrik -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-l-2 border-cyan-400 pl-3">
                        Model BYD Indonesia
                    </h4>
                    <ul class="space-y-2.5 text-sm">
                        <li><a href="{{ route('home') }}#cars" class="hover:text-cyan-400 transition-colors flex items-center justify-between"><span>BYD SEAL (Sedan Sport)</span> <span class="text-xs text-cyan-400 font-semibold">3.8s</span></a></li>
                        <li><a href="{{ route('home') }}#cars" class="hover:text-cyan-400 transition-colors flex items-center justify-between"><span>BYD ATTO 3 (Dynamic SUV)</span> <span class="text-xs text-cyan-400 font-semibold">480 km</span></a></li>
                        <li><a href="{{ route('home') }}#cars" class="hover:text-cyan-400 transition-colors flex items-center justify-between"><span>BYD DOLPHIN (Hatchback)</span> <span class="text-xs text-cyan-400 font-semibold">490 km</span></a></li>
                        <li><a href="{{ route('home') }}#cars" class="hover:text-cyan-400 transition-colors flex items-center justify-between"><span>BYD M6 (Family MPV 7-Seater)</span> <span class="text-xs text-cyan-400 font-semibold">530 km</span></a></li>
                        <li><a href="{{ route('home') }}#cars" class="hover:text-cyan-400 transition-colors flex items-center justify-between"><span>BYD SEALION 7 (Performance SUV)</span> <span class="text-xs text-cyan-400 font-semibold">800V</span></a></li>
                    </ul>
                </div>

                <!-- Col 4: Showroom & Contact -->
                <div>
                    <h4 class="text-white font-bold text-sm uppercase tracking-wider mb-4 border-l-2 border-cyan-400 pl-3">
                        Dealer &amp; Kontak Resmi
                    </h4>
                    <ul class="space-y-3 text-sm">
                        <li class="flex items-start">
                            <i class="fa-solid fa-location-dot mt-1 mr-3 text-cyan-400"></i>
                            <span>{{ $settings['dealer_address'] ?? 'Jl. BSD Grand Boulevard, Tangerang Selatan' }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-solid fa-phone mr-3 text-cyan-400"></i>
                            <span>{{ $salesProfile?->phone ?? $settings['dealer_phone'] ?? '+62 812-8899-7722' }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-brands fa-whatsapp mr-3 text-green-400 text-base"></i>
                            <span>{{ $salesProfile?->whatsapp ?? $settings['dealer_whatsapp'] ?? '6281288997722' }}</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fa-regular fa-envelope mr-3 text-cyan-400"></i>
                            <span>{{ $settings['dealer_email'] ?? 'sales@byd-arista.co.id' }}</span>
                        </li>
                    </ul>
                </div>

            </div>

            <!-- Bottom Subfooter -->
            <div class="border-t border-slate-900 pt-8 flex flex-col md:flex-row items-center justify-between text-xs text-slate-500 space-y-4 md:space-y-0">
                <p>&copy; {{ date('Y') }} {{ $settings['dealer_name'] ?? 'BYD Sales Indonesia' }}. All rights reserved.</p>
                <div class="flex items-center space-x-6">
                    <span class="text-slate-600">Teknologi Blade Battery &bull; e-Platform 3.0</span>
                    <a href="{{ route('admin.login') }}" class="text-slate-400 hover:text-cyan-400 flex items-center transition-colors">
                        <i class="fa-solid fa-gear mr-1.5 text-xs"></i> Admin Login
                    </a>
                </div>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Action Button -->
    <div class="fixed bottom-6 right-6 z-50 flex flex-col items-end group">
        <!-- Floating Tooltip Card on hover -->
        <div class="mb-3 px-4 py-2.5 rounded-2xl glass-panel shadow-2xl border border-cyan-500/30 text-xs text-slate-200 hidden sm:flex items-center space-x-3 transition-all duration-300 transform translate-y-1 group-hover:translate-y-0">
            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 animate-ping"></span>
            <div>
                <p class="font-bold text-white">{{ $salesProfile?->name ?? 'Sales BYD Online' }}</p>
                <p class="text-[11px] text-cyan-300">Siap melayani konsultasi &amp; test drive</p>
            </div>
        </div>

        <a href="https://wa.me/{{ $waClean }}?text={{ urlencode('Halo ' . ($salesProfile?->name ?? 'Sales BYD') . ', saya ingin konsultasi promo dan harga mobil listrik BYD.') }}" 
           target="_blank" 
           aria-label="Chat WhatsApp Sales"
           class="relative w-14 h-14 sm:w-16 sm:h-16 rounded-full bg-gradient-to-tr from-emerald-600 via-green-500 to-emerald-400 text-white flex items-center justify-center shadow-2xl shadow-green-500/40 hover:scale-110 active:scale-95 transition-all duration-300">
            <span class="absolute -top-1 -right-1 w-4 h-4 rounded-full bg-cyan-400 border-2 border-[#050811]"></span>
            <i class="fa-brands fa-whatsapp text-2xl sm:text-3xl"></i>
        </a>
    </div>

    @stack('scripts')
    {!! $settings['custom_footer_scripts'] ?? '' !!}
</body>
</html>
