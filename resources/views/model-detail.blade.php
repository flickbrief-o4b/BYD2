@extends('layouts.app')

@section('title', $car->name . ' - Spesifikasi & Harga OTR | ' . ($settings['dealer_name'] ?? 'BYD Sales Indonesia'))
@section('meta_description', 'Rincian spesifikasi, akselerasi, baterai Blade, harga OTR, promo dan pilihan tipe untuk ' . $car->name . '.')
@section('og_title', $car->name . ' - ' . $car->tagline)
@section('og_image', asset($car->image))

@section('content')

@php
    $salesWaNum = preg_replace('/[^0-9]/', '', $salesProfile?->whatsapp ?? $salesProfile?->phone ?? '6281288997722');
    if (str_starts_with($salesWaNum, '0')) { $salesWaNum = '62' . substr($salesWaNum, 1); }
@endphp

<!-- Breadcrumbs -->
<div class="bg-[#070B16] border-b border-slate-800 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center space-x-2 text-xs text-slate-400">
        <a href="{{ route('home') }}" class="hover:text-cyan-400 transition-colors">Beranda</a>
        <span class="text-slate-600">/</span>
        <a href="{{ route('home') }}#cars" class="hover:text-cyan-400 transition-colors">Model BYD</a>
        <span class="text-slate-600">/</span>
        <span class="text-cyan-400 font-bold">{{ $car->name }}</span>
    </div>
</div>

<!-- Model Hero Header -->
<section class="py-12 lg:py-16 bg-[#050811] relative overflow-hidden">
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
            
            <!-- Left Info -->
            <div class="lg:col-span-6 space-y-6">
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950 border border-cyan-500/40 text-cyan-300 text-xs font-bold uppercase tracking-widest">
                    <span>{{ $car->category }} ELECTRIC VEHICLE</span>
                </div>

                <h1 class="text-4xl sm:text-5xl lg:text-6xl font-black text-white tracking-tight">
                    {{ $car->name }}
                </h1>

                <p class="text-lg text-cyan-300 font-medium">
                    {{ $car->tagline }}
                </p>

                <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                    {{ $car->description }}
                </p>

                <!-- Starting Price Card -->
                <div class="p-5 rounded-2xl glass-panel neon-border inline-block w-full sm:w-auto">
                    <p class="text-xs text-slate-400">Harga OTR Jakarta Mulai:</p>
                    <p class="text-3xl font-black text-cyan-400 mt-1">
                        {{ $car->formatted_price }}
                    </p>
                </div>

                <!-- Action CTAs -->
                <div class="flex flex-wrap gap-4 pt-2">
                    <a href="https://wa.me/{{ $salesWaNum }}?text={{ urlencode('Halo Mas ' . ($salesProfile?->name ?? 'Sales') . ', saya tertarik dengan ' . $car->name . '. Mohon info penawaran diskon, paket kredit dan simulasi DP.') }}" 
                       target="_blank"
                       class="px-7 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-black text-xs uppercase tracking-wider flex items-center shadow-lg shadow-cyan-500/25">
                        <i class="fa-brands fa-whatsapp text-base mr-2"></i>
                        Minta Penawaran Spesial
                    </a>

                    @if($car->brochure_file)
                        <a href="{{ asset($car->brochure_file) }}" target="_blank"
                           class="px-6 py-3.5 rounded-xl glass-panel text-slate-200 hover:text-cyan-400 border border-slate-700 font-bold text-xs uppercase tracking-wider flex items-center">
                            <i class="fa-solid fa-file-pdf mr-2 text-rose-400"></i>
                            Download Brosur PDF
                        </a>
                    @endif
                </div>

            </div>

            <!-- Right Visual Display -->
            <div class="lg:col-span-6 relative flex justify-center">
                <div class="relative w-full max-w-lg group">
                    <div class="absolute inset-0 bg-cyan-500/10 rounded-3xl blur-2xl"></div>
                    <img src="{{ asset($car->image) }}" 
                         alt="{{ $car->name }}" 
                         class="relative z-10 w-full h-auto object-contain rounded-2xl drop-shadow-[0_20px_35px_rgba(0,180,255,0.3)]"
                         onerror="this.src='{{ asset('images/cars/byd-seal.svg') }}'">
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Key Specs Matrix -->
<section class="py-10 bg-[#070B16] border-y border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
            
            <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                <i class="fa-solid fa-gauge-high text-cyan-400 text-xl mb-2"></i>
                <p class="text-xs text-slate-400">Akselerasi 0-100 km/h</p>
                <p class="text-lg font-black text-white mt-1">{{ $car->acceleration ?? '3.8s' }}</p>
            </div>

            <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                <i class="fa-solid fa-road text-cyan-400 text-xl mb-2"></i>
                <p class="text-xs text-slate-400">Jarak Tempuh (Range)</p>
                <p class="text-lg font-black text-white mt-1">{{ $car->range_km ?? '570 km' }}</p>
            </div>

            <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                <i class="fa-solid fa-car-battery text-cyan-400 text-xl mb-2"></i>
                <p class="text-xs text-slate-400">Kapasitas Baterai</p>
                <p class="text-lg font-black text-white mt-1">{{ $car->battery_capacity ?? '82.5 kWh' }}</p>
            </div>

            <div class="p-4 rounded-2xl bg-slate-900/80 border border-slate-800">
                <i class="fa-solid fa-bolt-lightning text-cyan-400 text-xl mb-2"></i>
                <p class="text-xs text-slate-400">Tenaga &amp; Torsi</p>
                <p class="text-lg font-black text-white mt-1">{{ $car->max_power ?? '530 PS' }}</p>
            </div>

        </div>
    </div>
</section>

<!-- Available Trims & Types Section -->
<section class="py-16 bg-[#050811]">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-12">
            <h2 class="text-3xl font-black text-white tracking-tight">
                Pilihan Tipe &amp; Varian {{ $car->name }}
            </h2>
            <p class="text-slate-400 mt-2 text-sm">
                Bandingkan spesifikasi dan harga masing-masing trim sesuai kenyamanan &amp; preferensi berkendara Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($car->types as $trim)
                <div class="glass-panel rounded-3xl p-6 sm:p-8 neon-border flex flex-col justify-between group hover:-translate-y-1 transition-all">
                    <div class="space-y-4">
                        <div class="flex items-center justify-between">
                            <span class="px-3 py-1 rounded-full bg-cyan-950 text-cyan-300 text-xs font-bold border border-cyan-500/30">
                                {{ $trim->drivetrain }}
                            </span>
                            <span class="text-xs text-slate-400">
                                {{ $trim->seats }}
                            </span>
                        </div>

                        <div>
                            <h3 class="text-xl font-bold text-white group-hover:text-cyan-400 transition-colors">
                                {{ $trim->name }}
                            </h3>
                            <p class="text-2xl font-black text-cyan-400 mt-2">
                                {{ $trim->formatted_price }}
                            </p>
                        </div>

                        <div class="space-y-2 pt-2 border-t border-slate-800 text-xs text-slate-300">
                            @if($trim->range_km)
                                <div class="flex justify-between py-1 border-b border-slate-800/50">
                                    <span class="text-slate-400">Jarak Tempuh:</span>
                                    <span class="font-semibold text-white">{{ $trim->range_km }}</span>
                                </div>
                            @endif
                            @if($trim->battery_capacity)
                                <div class="flex justify-between py-1 border-b border-slate-800/50">
                                    <span class="text-slate-400">Baterai:</span>
                                    <span class="font-semibold text-white">{{ $trim->battery_capacity }}</span>
                                </div>
                            @endif
                            @if($trim->power)
                                <div class="flex justify-between py-1 border-b border-slate-800/50">
                                    <span class="text-slate-400">Tenaga:</span>
                                    <span class="font-semibold text-white">{{ $trim->power }}</span>
                                </div>
                            @endif
                        </div>

                        @if($trim->highlights)
                            <div class="p-3 rounded-xl bg-slate-900/90 text-xs text-slate-400">
                                <p class="text-cyan-300 font-semibold mb-1">Keunggulan Varian:</p>
                                <p>{{ $trim->highlights }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="pt-6">
                        @php
                            $trimWa = "Halo Mas {$salesProfile?->name}, saya tertarik dengan {$car->name} tipe {$trim->name} seharga {$trim->formatted_price}. Mohon info promo dan stok unitnya.";
                        @endphp
                        <a href="https://wa.me/{{ $salesWaNum }}?text={{ urlencode($trimWa) }}" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-slate-800 hover:bg-cyan-500 hover:text-black text-white font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center transition-all">
                            <i class="fa-brands fa-whatsapp text-sm mr-2 text-green-400"></i>
                            Pesan Tipe Ini
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>

<!-- Features List -->
@if(!empty($car->features))
<section class="py-16 bg-[#070B16] border-t border-slate-800">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-2xl mx-auto mb-10">
            <h2 class="text-3xl font-black text-white tracking-tight">
                Fitur &amp; Teknologi Unggulan
            </h2>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($car->features as $feature)
                <div class="p-5 rounded-2xl glass-panel border border-slate-800 flex items-start space-x-4">
                    <div class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 flex items-center justify-center shrink-0">
                        <i class="fa-solid fa-check text-sm"></i>
                    </div>
                    <div>
                        <p class="font-bold text-white text-sm">{{ $feature }}</p>
                        <p class="text-xs text-slate-400 mt-1">Standar teknologi tinggi BYD untuk keselamatan dan kenyamanan berkendara kelas dunia.</p>
                    </div>
                </div>
            @endforeach
        </div>

    </div>
</section>
@endif

@endsection
