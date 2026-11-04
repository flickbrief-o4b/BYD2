@extends('layouts.app')

@section('title', $settings['site_title'] ?? 'BYD Sales Indonesia | Dealer Resmi Mobil Listrik BYD')

@section('content')

{{-- ========================================== --}}
{{-- 1. HERO SLIDER SECTION                     --}}
{{-- ========================================== --}}
<section id="hero" class="relative overflow-hidden bg-[#050811] text-white" 
         x-data="{ 
            currentSlide: 0, 
            totalSlides: {{ count($sliders) > 0 ? count($sliders) : 1 }},
            timer: null,
            init() {
                this.startAutoPlay();
            },
            startAutoPlay() {
                this.timer = setInterval(() => {
                    this.next();
                }, 6000);
            },
            stopAutoPlay() {
                clearInterval(this.timer);
            },
            next() {
                this.currentSlide = (this.currentSlide + 1) % this.totalSlides;
            },
            prev() {
                this.currentSlide = (this.currentSlide - 1 + this.totalSlides) % this.totalSlides;
            },
            goTo(i) {
                this.currentSlide = i;
            }
         }" 
         @mouseenter="stopAutoPlay()" 
         @mouseleave="startAutoPlay()">

    <!-- Ambient background glows -->
    <div class="absolute -top-40 -left-40 w-96 h-96 bg-cyan-600/20 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute top-1/2 -right-40 w-[500px] h-[500px] bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="relative min-h-[560px] md:min-h-[640px] lg:min-h-[700px] flex items-center">
        @forelse($sliders as $index => $slider)
            <div x-show="currentSlide === {{ $index }}"
                 x-transition:enter="transition ease-out duration-700"
                 x-transition:enter-start="opacity-0 translate-x-12 scale-95"
                 x-transition:enter-end="opacity-100 translate-x-0 scale-100"
                 x-transition:leave="transition ease-in duration-500 absolute inset-0"
                 x-transition:leave-start="opacity-100 translate-x-0 scale-100"
                 x-transition:leave-end="opacity-0 -translate-x-12 scale-95"
                 class="w-full py-16 lg:py-24"
                 style="{{ $index !== 0 ? 'display: none;' : '' }}">
                
                <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center">
                        
                        <!-- Left Text Content -->
                        <div class="lg:col-span-6 space-y-6 text-center lg:text-left z-10">
                            @if(!empty($slider->badge))
                                <div class="inline-flex items-center space-x-2 px-3.5 py-1.5 rounded-full bg-cyan-950/80 border border-cyan-500/40 text-cyan-300 text-xs font-bold uppercase tracking-widest">
                                    <span class="w-2 h-2 rounded-full bg-cyan-400 animate-pulse"></span>
                                    <span>{{ $slider->badge }}</span>
                                </div>
                            @endif

                            <h1 class="text-3xl sm:text-4xl md:text-5xl lg:text-6xl font-black text-white tracking-tight leading-tight">
                                {!! nl2br(e($slider->title)) !!}
                            </h1>

                            <p class="text-base sm:text-lg text-slate-300 max-w-xl mx-auto lg:mx-0 leading-relaxed">
                                {{ $slider->subtitle }}
                            </p>

                            <!-- CTAs -->
                            <div class="pt-2 flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4">
                                <a href="{{ $slider->button_link ?? '#cars' }}" 
                                   class="w-full sm:w-auto px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-blue-700 hover:from-cyan-400 hover:to-blue-600 text-white font-extrabold text-sm uppercase tracking-wider shadow-lg shadow-cyan-500/30 hover:shadow-cyan-500/60 transition-all duration-300 text-center">
                                    {{ $slider->button_text ?? 'Lihat Varian & Harga' }}
                                    <i class="fa-solid fa-arrow-right ml-2"></i>
                                </a>

                                <a href="#test-drive" 
                                   class="w-full sm:w-auto px-7 py-4 rounded-xl glass-panel text-cyan-300 hover:text-white hover:border-cyan-400 font-bold text-sm uppercase tracking-wider transition-all duration-300 text-center">
                                    <i class="fa-solid fa-calendar-check mr-2"></i>
                                    Booking Test Drive
                                </a>
                            </div>

                            <!-- Trust Badges -->
                            <div class="pt-6 grid grid-cols-3 gap-4 border-t border-slate-800/80 text-left max-w-lg mx-auto lg:mx-0">
                                <div>
                                    <p class="text-xs text-slate-400">Garansi Baterai</p>
                                    <p class="text-sm font-bold text-cyan-400">8 Tahun / 160k KM</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Gratis Servis</p>
                                    <p class="text-sm font-bold text-cyan-400">4 Thn / 60k KM</p>
                                </div>
                                <div>
                                    <p class="text-xs text-slate-400">Home Charging</p>
                                    <p class="text-sm font-bold text-cyan-400">Free 7kW Wallbox</p>
                                </div>
                            </div>
                        </div>

                        <!-- Right Image Display -->
                        <div class="lg:col-span-6 relative flex justify-center items-center">
                            <div class="relative w-full max-w-xl group">
                                <div class="absolute inset-0 bg-gradient-to-tr from-cyan-500/20 to-blue-600/30 rounded-3xl blur-2xl group-hover:blur-3xl transition-all duration-500"></div>
                                <img src="{{ asset($slider->image) }}" 
                                     alt="{{ $slider->title }}" 
                                     class="relative z-10 w-full h-auto object-contain rounded-2xl drop-shadow-[0_20px_35px_rgba(0,140,255,0.3)] transition-transform duration-500 group-hover:scale-[1.02]"
                                     onerror="this.src='{{ asset('images/cars/byd-seal.svg') }}'">
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        @empty
            <div class="w-full py-24 text-center">
                <h1 class="text-4xl font-black text-white">BYD ELEKTRIK INDONESIA</h1>
                <p class="text-slate-400 mt-2">Dapatkan penawaran terbaik dan test drive unit impian Anda sekarang.</p>
            </div>
        @endforelse
    </div>

    <!-- Slider Navigation Arrows & Dot Indicators -->
    @if(count($sliders) > 1)
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pb-8 flex items-center justify-between">
            <!-- Indicator Dots -->
            <div class="flex items-center space-x-2.5">
                @foreach($sliders as $idx => $s)
                    <button @click="goTo({{ $idx }})" 
                            aria-label="Slide {{ $idx + 1 }}"
                            class="h-2 rounded-full transition-all duration-300"
                            :class="currentSlide === {{ $idx }} ? 'w-8 bg-cyan-400 shadow-md shadow-cyan-400/50' : 'w-2 bg-slate-700 hover:bg-slate-500'">
                    </button>
                @endforeach
            </div>

            <!-- Arrow buttons -->
            <div class="flex items-center space-x-2">
                <button @click="prev()" aria-label="Previous Slide" class="w-10 h-10 rounded-xl glass-panel border border-slate-700/60 hover:border-cyan-400 text-slate-300 hover:text-cyan-400 flex items-center justify-center transition-all">
                    <i class="fa-solid fa-chevron-left text-xs"></i>
                </button>
                <button @click="next()" aria-label="Next Slide" class="w-10 h-10 rounded-xl glass-panel border border-slate-700/60 hover:border-cyan-400 text-slate-300 hover:text-cyan-400 flex items-center justify-center transition-all">
                    <i class="fa-solid fa-chevron-right text-xs"></i>
                </button>
            </div>
        </div>
    @endif
</section>

{{-- ========================================== --}}
{{-- 2. SALES PROFILE CARD SECTION              --}}
{{-- ========================================== --}}
@if($salesProfile)
<section id="sales-profile" class="relative py-16 bg-[#070B16] border-y border-cyan-900/20">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="relative glass-panel rounded-3xl p-6 sm:p-10 lg:p-12 overflow-hidden neon-border">
            <!-- Background Decorative EV grid & ambient lighting -->
            <div class="absolute -right-20 -bottom-20 w-80 h-80 bg-cyan-500/10 rounded-full blur-3xl pointer-events-none"></div>
            <div class="absolute top-0 right-0 p-8 text-cyan-500/5 font-black text-8xl select-none hidden lg:block">BYD</div>

            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 lg:gap-12 items-center relative z-10">
                
                <!-- Left: Sales Photo with certified verified badge -->
                <div class="lg:col-span-4 flex justify-center">
                    <div class="relative group">
                        <!-- Glow behind photo -->
                        <div class="absolute -inset-1 rounded-3xl bg-gradient-to-r from-cyan-500 to-blue-600 opacity-60 blur-lg group-hover:opacity-100 transition duration-500"></div>
                        
                        <div class="relative w-64 h-64 sm:w-72 sm:h-72 rounded-2xl overflow-hidden bg-[#0A1022] border-2 border-cyan-400/40 shadow-2xl">
                            <img src="{{ asset($salesProfile->photo ?? 'images/sales/sales-consultant.svg') }}" 
                                 alt="{{ $salesProfile->name }}" 
                                 class="w-full h-full object-cover transition duration-500 group-hover:scale-105"
                                 onerror="this.src='{{ asset('images/sales/sales-consultant.svg') }}'">
                        </div>

                        <!-- Certified Floating Pill -->
                        <div class="absolute -bottom-3 left-1/2 -translate-x-1/2 whitespace-nowrap px-4 py-1.5 rounded-full bg-slate-900/95 border border-cyan-400 text-cyan-300 text-xs font-bold shadow-xl flex items-center space-x-1.5">
                            <i class="fa-solid fa-circle-check text-emerald-400"></i>
                            <span>{{ $salesProfile->badge ?? 'Official Master Sales' }}</span>
                        </div>
                    </div>
                </div>

                <!-- Right: Sales Info, Stats & Direct Contact -->
                <div class="lg:col-span-8 space-y-5 text-center lg:text-left">
                    
                    <div class="inline-flex items-center space-x-2 text-xs font-semibold text-cyan-400 bg-cyan-950/60 px-3 py-1 rounded-full border border-cyan-500/30">
                        <i class="fa-solid fa-id-badge"></i>
                        <span>{{ $salesProfile->branch ?? 'BYD Experience Center' }}</span>
                    </div>

                    <div>
                        <h2 class="text-2xl sm:text-3xl lg:text-4xl font-extrabold text-white">
                            {{ $salesProfile->name }}
                        </h2>
                        <p class="text-sm sm:text-base text-cyan-300 font-medium mt-1">
                            {{ $salesProfile->title }}
                        </p>
                    </div>

                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed max-w-2xl">
                        "{{ $salesProfile->bio ?? 'Saya siap membantu Anda dari pemilihan model, test drive di tempat Anda, konsultasi kredit, simulasi DP ringan hingga mobil tiba di garasi Anda dengan garansi resmi.' }}"
                    </p>

                    <!-- Key Metrics Stats -->
                    <div class="grid grid-cols-3 gap-4 pt-2 max-w-lg mx-auto lg:mx-0">
                        <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800 text-center">
                            <p class="text-2xl font-black text-cyan-400">{{ $salesProfile->experience_years }}+</p>
                            <p class="text-xs text-slate-400 mt-0.5">Tahun Pengalaman</p>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800 text-center">
                            <p class="text-2xl font-black text-cyan-400">{{ $salesProfile->units_sold }}+</p>
                            <p class="text-xs text-slate-400 mt-0.5">Unit Terkirim</p>
                        </div>
                        <div class="p-3 rounded-2xl bg-slate-900/80 border border-slate-800 text-center">
                            <p class="text-2xl font-black text-emerald-400 flex items-center justify-center">
                                <i class="fa-solid fa-star text-amber-400 text-base mr-1"></i>
                                {{ $salesProfile->rating }}
                            </p>
                            <p class="text-xs text-slate-400 mt-0.5">Kepuasan Klien</p>
                        </div>
                    </div>

                    <!-- Direct Action Buttons -->
                    <div class="pt-4 flex flex-wrap items-center justify-center lg:justify-start gap-4">
                        @php
                            $salesWaNum = preg_replace('/[^0-9]/', '', $salesProfile->whatsapp ?? $salesProfile->phone);
                            if (str_starts_with($salesWaNum, '0')) { $salesWaNum = '62' . substr($salesWaNum, 1); }
                        @endphp
                        
                        <a href="https://wa.me/{{ $salesWaNum }}?text={{ urlencode('Halo Mas ' . $salesProfile->name . ', saya ingin konsultasi harga, promo dan booking test drive mobil BYD.') }}" 
                           target="_blank"
                           class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-500 hover:to-green-400 text-white font-bold text-sm shadow-lg shadow-green-500/25 flex items-center transition-all duration-300">
                            <i class="fa-brands fa-whatsapp text-lg mr-2"></i>
                            Chat WhatsApp (Fast Response)
                        </a>

                        <a href="tel:{{ $salesProfile->phone }}" 
                           class="px-6 py-3.5 rounded-xl glass-panel text-slate-200 hover:text-cyan-400 hover:border-cyan-400 font-bold text-sm flex items-center transition-all duration-300">
                            <i class="fa-solid fa-phone mr-2 text-cyan-400"></i>
                            Telepon Langsung
                        </a>

                        <a href="#test-drive" 
                           class="px-6 py-3.5 rounded-xl bg-slate-800/90 hover:bg-slate-700 text-cyan-300 font-bold text-sm border border-cyan-500/20 flex items-center transition-all duration-300">
                            <i class="fa-solid fa-clipboard-list mr-2"></i>
                            Minta Penawaran / Simulasi
                        </a>
                    </div>

                </div>

            </div>
        </div>

    </div>
</section>
@endif

{{-- ========================================== --}}
{{-- 3. CAR MODELS & VARIANTS (DAN TYPE-TYPENYA) --}}
{{-- ========================================== --}}
<section id="cars" class="py-20 bg-[#050811] relative" 
         x-data="{ 
            activeCategory: 'all', 
            selectedCar: null,
            openTypeModal: false,
            openModel(car) {
                this.selectedCar = car;
                this.openTypeModal = true;
            }
         }">
    
    <!-- Ambient light -->
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-full max-w-4xl h-96 bg-blue-600/10 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <!-- Section Header -->
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-cyan-300 text-xs font-bold uppercase tracking-widest mb-3">
                <i class="fa-solid fa-bolt text-cyan-400"></i>
                <span>LINE-UP MOBIL LISTRIK RESMI</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                Varian Mobil BYD &amp; Type-Typenya
            </h2>
            <p class="text-slate-400 mt-4 text-base sm:text-lg">
                Pilih model mobil listrik BYD berteknologi Blade Battery terunggul. Klik pada setiap tipe untuk melihat spesifikasi detail dan simulasi kredit.
            </p>

            <!-- Filter Buttons -->
            <div class="flex flex-wrap items-center justify-center gap-2 pt-6">
                <button @click="activeCategory = 'all'" 
                        :class="activeCategory === 'all' ? 'bg-cyan-500 text-black font-extrabold shadow-lg shadow-cyan-500/30' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-cyan-500/50'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-300">
                    Semua Model ({{ count($carModels) }})
                </button>
                <button @click="activeCategory = 'Sedan'" 
                        :class="activeCategory === 'Sedan' ? 'bg-cyan-500 text-black font-extrabold shadow-lg shadow-cyan-500/30' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-cyan-500/50'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-300">
                    Sedan Sport (Seal)
                </button>
                <button @click="activeCategory = 'SUV'" 
                        :class="activeCategory === 'SUV' ? 'bg-cyan-500 text-black font-extrabold shadow-lg shadow-cyan-500/30' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-cyan-500/50'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-300">
                    SUV (Atto 3 &amp; Sealion)
                </button>
                <button @click="activeCategory = 'MPV'" 
                        :class="activeCategory === 'MPV' ? 'bg-cyan-500 text-black font-extrabold shadow-lg shadow-cyan-500/30' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-cyan-500/50'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-300">
                    MPV 7-Seater (M6)
                </button>
                <button @click="activeCategory = 'Hatchback'" 
                        :class="activeCategory === 'Hatchback' ? 'bg-cyan-500 text-black font-extrabold shadow-lg shadow-cyan-500/30' : 'bg-slate-900 text-slate-300 border border-slate-800 hover:border-cyan-500/50'"
                        class="px-5 py-2.5 rounded-full text-xs uppercase tracking-wider transition-all duration-300">
                    Hatchback (Dolphin)
                </button>
            </div>
        </div>

        <!-- Models Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($carModels as $car)
                <div x-show="activeCategory === 'all' || activeCategory === '{{ $car->category }}'"
                     x-transition:enter="transition ease-out duration-300"
                     x-transition:enter-start="opacity-0 scale-95"
                     x-transition:enter-end="opacity-100 scale-100"
                     class="group relative glass-panel rounded-3xl overflow-hidden neon-border flex flex-col justify-between transition-all duration-300 hover:-translate-y-2">
                    
                    <div>
                        <!-- Car Thumbnail & Header Badge -->
                        <div class="relative bg-gradient-to-b from-slate-900 to-[#0A1020] p-6 text-center overflow-hidden">
                            <!-- Category Badge -->
                            <div class="absolute top-4 left-4 z-10 flex items-center space-x-2">
                                <span class="px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-400/40 text-cyan-300 text-[11px] font-bold uppercase tracking-wider">
                                    {{ $car->category }}
                                </span>
                                @if($car->is_featured)
                                    <span class="px-2.5 py-1 rounded-full bg-blue-600/80 text-white text-[11px] font-bold">
                                        Favorit
                                    </span>
                                @endif
                            </div>

                            <!-- Trims Count Badge -->
                            <div class="absolute top-4 right-4 z-10">
                                <span class="px-3 py-1 rounded-full bg-slate-900/90 border border-slate-700 text-slate-300 text-[11px] font-semibold">
                                    {{ $car->types->count() }} Tipe Tersedia
                                </span>
                            </div>

                            <!-- Image -->
                            <div class="py-8 transform group-hover:scale-105 transition-transform duration-500">
                                <img src="{{ asset($car->image) }}" 
                                     alt="{{ $car->name }}" 
                                     class="w-full h-48 object-contain drop-shadow-[0_15px_25px_rgba(0,180,255,0.25)]"
                                     onerror="this.src='{{ asset('images/cars/byd-seal.svg') }}'">
                            </div>

                            <!-- Acceleration / Key highlight pill -->
                            <div class="inline-flex items-center space-x-3 px-3.5 py-1.5 rounded-full bg-slate-900/90 border border-cyan-500/30 text-xs text-slate-300">
                                <span class="text-cyan-400 font-bold"><i class="fa-solid fa-gauge-high mr-1"></i> {{ $car->acceleration }}</span>
                                <span class="text-slate-600">&bull;</span>
                                <span class="text-cyan-400 font-bold"><i class="fa-solid fa-road mr-1"></i> {{ $car->range_km }}</span>
                            </div>
                        </div>

                        <!-- Car Body Info -->
                        <div class="p-6 space-y-4">
                            <div>
                                <h3 class="text-2xl font-black text-white group-hover:text-cyan-400 transition-colors">
                                    {{ $car->name }}
                                </h3>
                                <p class="text-xs text-slate-400 mt-1 line-clamp-1">
                                    {{ $car->tagline }}
                                </p>
                            </div>

                            <!-- Starting Price Box -->
                            <div class="p-4 rounded-2xl bg-gradient-to-r from-cyan-950/40 to-blue-950/40 border border-cyan-500/20">
                                <p class="text-xs text-slate-400">Harga Mulai Dari (OTR Jakarta):</p>
                                <p class="text-2xl font-black text-cyan-400 tracking-tight mt-0.5">
                                    {{ $car->formatted_price }}
                                </p>
                            </div>

                            <!-- List of Available Types & Trims Preview -->
                            <div class="space-y-2 pt-1">
                                <p class="text-xs font-bold uppercase tracking-wider text-slate-400 flex items-center justify-between">
                                    <span>Pilihan Tipe / Varian:</span>
                                    <span class="text-cyan-400 font-normal">Klik untuk rincian</span>
                                </p>
                                <div class="space-y-1.5">
                                    @foreach($car->types as $trim)
                                        <div class="flex items-center justify-between text-xs p-2.5 rounded-xl bg-slate-900/80 border border-slate-800/80 hover:border-cyan-500/40 transition-colors">
                                            <div class="flex items-center space-x-2">
                                                <i class="fa-solid fa-circle-check text-cyan-400 text-[10px]"></i>
                                                <span class="font-semibold text-slate-200">{{ $trim->name }}</span>
                                            </div>
                                            <span class="font-bold text-cyan-300">
                                                {{ $trim->formatted_price }}
                                            </span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Top Features List -->
                            @if(!empty($car->features))
                                <div class="pt-2">
                                    <ul class="space-y-1.5 text-xs text-slate-400">
                                        @foreach(array_slice($car->features, 0, 3) as $feat)
                                            <li class="flex items-start">
                                                <i class="fa-solid fa-bolt text-cyan-400 mt-0.5 mr-2 text-[10px]"></i>
                                                <span>{{ $feat }}</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- Card Actions -->
                    <div class="p-6 pt-0 space-y-2.5">
                        <div class="grid grid-cols-2 gap-2">
                            <!-- Button Detail / Types breakdown -->
                            <a href="{{ route('model.detail', $car->slug) }}" 
                               class="w-full py-3 rounded-xl bg-slate-800 hover:bg-slate-700 text-white font-bold text-xs uppercase tracking-wider text-center transition-all">
                                Detail Spesifikasi
                            </a>

                            <!-- Button Simulasi -->
                            <a href="#simulasi" 
                               @click="prefillSimulation('{{ $car->id }}', '{{ $car->starting_price }}')"
                               class="w-full py-3 rounded-xl border border-cyan-500/40 text-cyan-300 hover:bg-cyan-500/10 font-bold text-xs uppercase tracking-wider text-center transition-all">
                                Simulasi DP
                            </a>
                        </div>

                        <!-- Direct WhatsApp Consultation for this car -->
                        @php
                            $carWaMsg = "Halo Mas {$salesProfile?->name}, saya tertarik dengan mobil {$car->name}. Boleh info simulasi kredit, diskon promo dan jadwal test drive?";
                        @endphp
                        <a href="https://wa.me/{{ $salesWaNum }}?text={{ urlencode($carWaMsg) }}" 
                           target="_blank"
                           class="w-full py-3 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:brightness-110 text-white font-extrabold text-xs uppercase tracking-wider text-center shadow-md shadow-cyan-500/20 flex items-center justify-center transition-all">
                            <i class="fa-brands fa-whatsapp text-sm mr-2"></i>
                            Minta Penawaran {{ $car->name }}
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ========================================== --}}
{{-- 4. INTERACTIVE LOAN / SIMULASI KREDIT      --}}
{{-- ========================================== --}}
<section id="simulasi" class="py-20 bg-[#070B16] relative border-y border-cyan-900/30"
         x-data="{
            selectedCarId: '{{ $carModels->first()?->id ?? 1 }}',
            selectedTrimId: '{{ $carModels->first()?->types->first()?->id ?? '' }}',
            carPrices: {
                @foreach($carModels as $c)
                    @foreach($c->types as $t)
                        '{{ $t->id }}': {{ $t->price }},
                    @endforeach
                @endforeach
            },
            currentPrice: {{ $carModels->first()?->starting_price ?? 365000000 }},
            dpPercent: 20,
            tenorYears: 3,
            interestRate: 3.5, // % per year approx
            
            get dpNominal() {
                return (this.currentPrice * (this.dpPercent / 100));
            },
            get loanPrincipal() {
                return this.currentPrice - this.dpNominal;
            },
            get monthlyInstallment() {
                let months = this.tenorYears * 12;
                let totalInterest = this.loanPrincipal * (this.interestRate / 100) * this.tenorYears;
                let totalDebt = this.loanPrincipal + totalInterest;
                return Math.round(totalDebt / months);
            },
            formatRupiah(num) {
                return 'Rp ' + Number(num).toLocaleString('id-ID');
            },
            updatePriceFromTrim() {
                if (this.carPrices[this.selectedTrimId]) {
                    this.currentPrice = this.carPrices[this.selectedTrimId];
                }
            }
         }">
    
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-12">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-cyan-300 text-xs font-bold uppercase tracking-widest mb-3">
                <i class="fa-solid fa-calculator text-cyan-400"></i>
                <span>ESTIMASI PEMBIAYAAN FLEKSIBEL</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                Kalkulator Simulasi Kredit &amp; DP
            </h2>
            <p class="text-slate-400 mt-3 text-sm sm:text-base">
                Hitung estimasi Down Payment (DP) dan angsuran bulanan yang sesuai dengan rencana anggaran keuangan Anda.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
            
            <!-- Left: Simulation Controls Form -->
            <div class="lg:col-span-7 glass-panel rounded-3xl p-6 sm:p-8 space-y-6">
                
                <!-- Select Car Model & Trim -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Pilih Tipe / Varian Mobil BYD
                    </label>
                    <select x-model="selectedTrimId" 
                            @change="updatePriceFromTrim()"
                            class="w-full px-4 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-white font-medium focus:border-cyan-400 focus:outline-none">
                        @foreach($carModels as $c)
                            <optgroup label="{{ $c->name }} ({{ $c->category }})">
                                @foreach($c->types as $t)
                                    <option value="{{ $t->id }}">
                                        {{ $c->name }} - {{ $t->name }} (Rp {{ number_format($t->price, 0, ',', '.') }})
                                    </option>
                                @endforeach
                            </optgroup>
                        @endforeach
                    </select>
                </div>

                <!-- Custom OTR Price Display & Edit -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Harga OTR Kendaraan
                    </label>
                    <div class="relative">
                        <input type="number" 
                               x-model.number="currentPrice" 
                               step="1000000"
                               class="w-full px-4 py-3.5 rounded-xl bg-slate-900 border border-slate-700 text-cyan-400 font-bold text-lg focus:border-cyan-400 focus:outline-none">
                        <span class="absolute right-4 top-1/2 -translate-y-1/2 text-xs text-slate-500 font-semibold">IDR</span>
                    </div>
                </div>

                <!-- DP Percentage Slider -->
                <div>
                    <div class="flex justify-between items-center mb-2">
                        <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                            Uang Muka (DP): <span class="text-cyan-400 font-black text-sm" x-text="dpPercent + '%'"></span>
                        </label>
                        <span class="text-xs text-cyan-300 font-bold" x-text="formatRupiah(dpNominal)"></span>
                    </div>
                    <input type="range" 
                           x-model.number="dpPercent" 
                           min="10" 
                           max="50" 
                           step="5"
                           class="w-full h-2.5 bg-slate-800 rounded-lg appearance-none cursor-pointer accent-cyan-400">
                    <div class="flex justify-between text-[11px] text-slate-500 mt-1">
                        <span>10% (DP Ringan)</span>
                        <span>20%</span>
                        <span>30%</span>
                        <span>40%</span>
                        <span>50%</span>
                    </div>
                </div>

                <!-- Tenor Selection -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Jangka Waktu Tenor (Tahun)
                    </label>
                    <div class="grid grid-cols-5 gap-2">
                        <template x-for="t in [1, 2, 3, 4, 5]" :key="t">
                            <button type="button"
                                    @click="tenorYears = t"
                                    :class="tenorYears === t ? 'bg-cyan-500 text-black font-extrabold shadow-md shadow-cyan-500/30' : 'bg-slate-900 text-slate-300 border border-slate-700 hover:border-cyan-400'"
                                    class="py-3 rounded-xl text-xs font-semibold transition-all">
                                <span x-text="t + ' Thn'"></span>
                                <span class="block text-[10px] opacity-75" x-text="(t * 12) + ' Bln'"></span>
                            </button>
                        </template>
                    </div>
                </div>

            </div>

            <!-- Right: Results Card with CTA -->
            <div class="lg:col-span-5 glass-panel rounded-3xl p-6 sm:p-8 neon-border space-y-6 bg-gradient-to-br from-slate-900/90 to-[#0A1124]">
                
                <h3 class="text-lg font-black text-white border-b border-slate-800 pb-3 flex items-center justify-between">
                    <span>Hasil Simulasi Pembiayaan</span>
                    <span class="text-xs px-2.5 py-1 rounded-full bg-cyan-950 text-cyan-300 font-semibold border border-cyan-500/30">Estimasi</span>
                </h3>

                <div class="space-y-4 text-sm">
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">Harga OTR</span>
                        <span class="font-bold text-white" x-text="formatRupiah(currentPrice)"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">Uang Muka (DP <span x-text="dpPercent"></span>%)</span>
                        <span class="font-bold text-cyan-400" x-text="formatRupiah(dpNominal)"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">Pokok Hutang</span>
                        <span class="font-bold text-white" x-text="formatRupiah(loanPrincipal)"></span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-slate-800/60">
                        <span class="text-slate-400">Tenor Pembiayaan</span>
                        <span class="font-bold text-white" x-text="tenorYears + ' Tahun (' + (tenorYears * 12) + ' Bulan)'"></span>
                    </div>
                </div>

                <!-- Highlight Cicilan Per Bulan -->
                <div class="p-5 rounded-2xl bg-gradient-to-r from-cyan-950/70 via-blue-950/70 to-slate-900 border border-cyan-400/40 text-center">
                    <p class="text-xs font-bold uppercase tracking-wider text-cyan-300">Estimasi Cicilan Per Bulan</p>
                    <p class="text-3xl sm:text-4xl font-black text-white mt-1.5 glow-blue" x-text="formatRupiah(monthlyInstallment)"></p>
                    <p class="text-[11px] text-slate-400 mt-2">*Simulasi bersifat indikatif dan belum termasuk asuransi all-risk &amp; admin leasing rekanan.</p>
                </div>

                <!-- Direct CTA with Prefilled Simulation to WhatsApp -->
                <div class="pt-2">
                    <a :href="'https://wa.me/{{ $salesWaNum }}?text=' + encodeURIComponent('Halo Mas {{ $salesProfile?->name }}, saya ingin ajukan simulasi kredit mobil BYD dengan rincian:\nHarga OTR: ' + formatRupiah(currentPrice) + '\nDP: ' + dpPercent + '% (' + formatRupiah(dpNominal) + ')\nTenor: ' + tenorYears + ' Tahun\nEstimasi Angsuran: ' + formatRupiah(monthlyInstallment) + '/bln.\nMohon info paket kredit promo termurah dari leasing rekanan. Terima kasih!')" 
                       target="_blank"
                       class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-black text-xs uppercase tracking-wider text-center shadow-lg shadow-cyan-500/25 flex items-center justify-center transition-all">
                        <i class="fa-brands fa-whatsapp text-base mr-2"></i>
                        Ajukan Paket Kredit Ini ke Sales
                    </a>
                </div>

            </div>

        </div>

    </div>
</section>

{{-- ========================================== --}}
{{-- 5. PROMO CARD SECTION                      --}}
{{-- ========================================== --}}
<section id="promos" class="py-20 bg-[#050811] relative">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-cyan-300 text-xs font-bold uppercase tracking-widest mb-3">
                <i class="fa-solid fa-tags text-cyan-400"></i>
                <span>PROGRAM DISKON &amp; CASHBACK</span>
            </div>
            <h2 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight">
                Promo Spesial BYD Bulan Ini
            </h2>
            <p class="text-slate-400 mt-3 text-base">
                Manfaatkan program promo eksklusif pembelian mobil listrik BYD resmi dengan berbagai kemudahan dan bonus ekstra.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($promos as $promo)
                <div class="glass-panel rounded-3xl overflow-hidden neon-border flex flex-col justify-between group hover:-translate-y-2 transition-all duration-300">
                    
                    <div>
                        <!-- Promo Banner Image / Graphic -->
                        <div class="relative h-48 bg-slate-900 overflow-hidden">
                            <img src="{{ asset($promo->image) }}" 
                                 alt="{{ $promo->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/promos/promo-bunga-nol.svg') }}'">
                            
                            @if(!empty($promo->badge))
                                <div class="absolute top-4 left-4">
                                    <span class="px-3 py-1.5 rounded-full bg-cyan-500 text-black text-xs font-black uppercase tracking-wider shadow-lg">
                                        {{ $promo->badge }}
                                    </span>
                                </div>
                            @endif

                            @if($promo->valid_until)
                                <div class="absolute bottom-3 right-3 px-3 py-1 rounded-lg bg-black/80 backdrop-blur-md text-[11px] text-slate-300 border border-slate-700">
                                    <i class="fa-regular fa-clock mr-1 text-cyan-400"></i>
                                    Berlaku s/d {{ $promo->valid_until->format('d M Y') }}
                                </div>
                            @endif
                        </div>

                        <!-- Promo Content -->
                        <div class="p-6 space-y-3">
                            <h3 class="text-xl font-bold text-white group-hover:text-cyan-400 transition-colors">
                                {{ $promo->title }}
                            </h3>
                            <p class="text-sm text-slate-300 leading-relaxed">
                                {{ $promo->summary }}
                            </p>

                            @if(!empty($promo->terms))
                                <div class="pt-2 text-xs text-slate-400 border-t border-slate-800">
                                    <p class="font-semibold text-slate-300 mb-1">Ketentuan:</p>
                                    <p class="whitespace-pre-line leading-relaxed text-slate-400">{{ $promo->terms }}</p>
                                </div>
                            @endif
                        </div>
                    </div>

                    <!-- Promo CTA -->
                    <div class="p-6 pt-0">
                        @php
                            $promoWaMsg = "Halo Mas {$salesProfile?->name}, saya ingin klaim '{$promo->title}'. Bagaimana syarat & prosesnya?";
                        @endphp
                        <a href="https://wa.me/{{ $salesWaNum }}?text={{ urlencode($promoWaMsg) }}" 
                           target="_blank"
                           class="w-full py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-extrabold text-xs uppercase tracking-wider text-center flex items-center justify-center transition-all shadow-md shadow-cyan-500/20">
                            <i class="fa-brands fa-whatsapp text-sm mr-2"></i>
                            Klaim Promo Ini Sekarang
                        </a>
                    </div>

                </div>
            @endforeach
        </div>

    </div>
</section>

{{-- ========================================== --}}
{{-- 6. NEWS CARD SECTION                       --}}
{{-- ========================================== --}}
<section id="news" class="py-20 bg-[#070B16] relative border-t border-cyan-900/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="flex flex-col md:flex-row md:items-end justify-between mb-12">
            <div>
                <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-cyan-300 text-xs font-bold uppercase tracking-widest mb-3">
                    <i class="fa-solid fa-newspaper text-cyan-400"></i>
                    <span>INFORMASI &amp; TEKNOLOGI EV</span>
                </div>
                <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                    Berita &amp; Artikel Terkini BYD
                </h2>
                <p class="text-slate-400 mt-2 text-sm sm:text-base">
                    Ulasan teknologi Blade Battery, tips merawat mobil listrik, dan agenda peluncuran terbaru di Indonesia.
                </p>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($articles as $news)
                <article class="glass-panel rounded-3xl overflow-hidden neon-border flex flex-col justify-between group hover:-translate-y-2 transition-all duration-300">
                    <div>
                        <!-- News Thumbnail -->
                        <div class="relative h-48 bg-slate-900 overflow-hidden">
                            <img src="{{ asset($news->image) }}" 
                                 alt="{{ $news->title }}" 
                                 class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                 onerror="this.src='{{ asset('images/news/news-m6.svg') }}'">
                            
                            <div class="absolute top-4 left-4">
                                <span class="px-3 py-1 rounded-full bg-blue-600 text-white text-[11px] font-bold uppercase tracking-wider">
                                    {{ $news->category }}
                                </span>
                            </div>

                            @if($news->published_at)
                                <div class="absolute bottom-3 right-3 px-2.5 py-1 rounded-md bg-black/75 backdrop-blur-md text-[11px] text-slate-300">
                                    {{ $news->published_at->format('d M Y') }}
                                </div>
                            @endif
                        </div>

                        <!-- News Details -->
                        <div class="p-6 space-y-3">
                            <h3 class="text-lg font-bold text-white group-hover:text-cyan-400 transition-colors line-clamp-2">
                                <a href="{{ route('news.detail', $news->slug) }}">
                                    {{ $news->title }}
                                </a>
                            </h3>
                            <p class="text-xs text-slate-400 line-clamp-3 leading-relaxed">
                                {{ $news->summary }}
                            </p>
                        </div>
                    </div>

                    <div class="p-6 pt-0 flex items-center justify-between text-xs text-slate-400 border-t border-slate-800/80 mt-2">
                        <span class="flex items-center">
                            <i class="fa-regular fa-user mr-1.5 text-cyan-400"></i>
                            {{ $news->author }}
                        </span>
                        <a href="{{ route('news.detail', $news->slug) }}" class="text-cyan-400 hover:text-cyan-300 font-bold flex items-center">
                            Baca Selengkapnya
                            <i class="fa-solid fa-arrow-right ml-1 text-[10px]"></i>
                        </a>
                    </div>
                </article>
            @endforeach
        </div>

    </div>
</section>

{{-- ========================================== --}}
{{-- 7. CTA & TEST DRIVE BOOKING FORM           --}}
{{-- ========================================== --}}
<section id="test-drive" class="py-20 bg-[#050811] relative overflow-hidden" 
         x-data="{ 
            inquiryType: 'test_drive',
            submitting: false,
            successMsg: '',
            sendForm(e) {
                this.submitting = true;
                const form = e.target;
                const data = new FormData(form);

                fetch('{{ route('inquiry.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'Accept': 'application/json'
                    },
                    body: data
                })
                .then(r => r.json())
                .then(res => {
                    this.submitting = false;
                    if (res.success) {
                        this.successMsg = res.message;
                        form.reset();
                        if (res.wa_url) {
                            setTimeout(() => {
                                window.open(res.wa_url, '_blank');
                            }, 1000);
                        }
                    }
                })
                .catch(err => {
                    this.submitting = false;
                    form.submit();
                });
            }
         }">
    
    <!-- Background Ambient Lighting -->
    <div class="absolute -bottom-20 -left-20 w-96 h-96 bg-cyan-600/15 rounded-full blur-3xl pointer-events-none"></div>
    <div class="absolute -top-20 -right-20 w-96 h-96 bg-blue-600/15 rounded-full blur-3xl pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        
        <div class="glass-panel rounded-3xl p-8 sm:p-12 neon-border">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-center">
                
                <!-- Left Pitch / Benefits -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-cyan-300 text-xs font-bold uppercase tracking-widest">
                        <i class="fa-solid fa-car-side text-cyan-400"></i>
                        <span>FREE TEST DRIVE KE RUMAH / KANTOR</span>
                    </div>

                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                        Rasakan Kemewahan &amp; Performa EV BYD Hari Ini
                    </h2>

                    <p class="text-slate-300 text-sm sm:text-base leading-relaxed">
                        Konsultasikan kebutuhan armada atau kendaraan pribadi Anda langsung dengan Senior Sales Consultant resmi. Kami siap membawakan unit test drive ke lokasi Anda di wilayah Jabodetabek &amp; sekitarnya.
                    </p>

                    <!-- Service Checklist -->
                    <div class="space-y-3 pt-2">
                        <div class="flex items-center space-x-3 text-sm text-slate-200">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span>Gratis konsultasi harga OTR, promo &amp; simulasi kredit</span>
                        </div>
                        <div class="flex items-center space-x-3 text-sm text-slate-200">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span>Unit Test Drive lengkap (Seal, Atto 3, Dolphin, M6)</span>
                        </div>
                        <div class="flex items-center space-x-3 text-sm text-slate-200">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span>Bantuan Trade-in mobil lama dengan harga tertinggi</span>
                        </div>
                        <div class="flex items-center space-x-3 text-sm text-slate-200">
                            <span class="w-6 h-6 rounded-full bg-emerald-500/20 text-emerald-400 flex items-center justify-center text-xs">
                                <i class="fa-solid fa-check"></i>
                            </span>
                            <span>Proses STNK &amp; plat nomor resmi cepat &amp; aman</span>
                        </div>
                    </div>

                    <!-- Direct Hotline Card -->
                    <div class="p-4 rounded-2xl bg-slate-900/90 border border-slate-800 flex items-center space-x-4">
                        <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 flex items-center justify-center text-xl">
                            <i class="fa-solid fa-phone"></i>
                        </div>
                        <div>
                            <p class="text-xs text-slate-400">Hubungi Langsung Sales Consultant</p>
                            <p class="text-base font-extrabold text-white">{{ $salesProfile?->name ?? 'Sales BYD Official' }}</p>
                            <p class="text-xs text-cyan-400 font-bold">{{ $salesProfile?->phone ?? $settings['dealer_phone'] ?? '+62 812-8899-7722' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Right Lead Form -->
                <div class="lg:col-span-7 bg-[#0A1022] rounded-2xl p-6 sm:p-8 border border-slate-800 shadow-2xl">
                    
                    <!-- Success Notification -->
                    <div x-show="successMsg" 
                         x-transition 
                         class="mb-6 p-4 rounded-xl bg-emerald-950/80 border border-emerald-500 text-emerald-300 text-sm flex items-center space-x-3" 
                         style="display: none;">
                        <i class="fa-solid fa-circle-check text-lg"></i>
                        <span x-text="successMsg"></span>
                    </div>

                    <form @submit.prevent="sendForm($event)" class="space-y-4">
                        @csrf

                        <!-- Inquiry Type Tabs -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                Jenis Keperluan
                            </label>
                            <div class="grid grid-cols-3 gap-2">
                                <button type="button" 
                                        @click="inquiryType = 'test_drive'"
                                        :class="inquiryType === 'test_drive' ? 'bg-cyan-500 text-black font-extrabold' : 'bg-slate-900 text-slate-300 border border-slate-700'"
                                        class="py-2.5 rounded-xl text-xs font-semibold transition-all">
                                    Test Drive
                                </button>
                                <button type="button" 
                                        @click="inquiryType = 'promo'"
                                        :class="inquiryType === 'promo' ? 'bg-cyan-500 text-black font-extrabold' : 'bg-slate-900 text-slate-300 border border-slate-700'"
                                        class="py-2.5 rounded-xl text-xs font-semibold transition-all">
                                    Klaim Promo
                                </button>
                                <button type="button" 
                                        @click="inquiryType = 'simulasi_kredit'"
                                        :class="inquiryType === 'simulasi_kredit' ? 'bg-cyan-500 text-black font-extrabold' : 'bg-slate-900 text-slate-300 border border-slate-700'"
                                        class="py-2.5 rounded-xl text-xs font-semibold transition-all">
                                    Simulasi DP
                                </button>
                            </div>
                            <input type="hidden" name="inquiry_type" :value="inquiryType">
                        </div>

                        <!-- Name & Phone -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Nama Lengkap *
                                </label>
                                <input type="text" name="name" required placeholder="Contoh: Budi Santoso"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-cyan-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Nomor WhatsApp / HP *
                                </label>
                                <input type="tel" name="phone" required placeholder="Contoh: 081234567890"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-cyan-400 focus:outline-none">
                            </div>
                        </div>

                        <!-- Model interested & City -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Pilih Model Mobil BYD
                                </label>
                                <select name="car_model_id" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                                    <option value="">-- Pilih Model --</option>
                                    @foreach($carModels as $cm)
                                        <option value="{{ $cm->id }}">{{ $cm->name }} ({{ $cm->category }})</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Kota / Domisili
                                </label>
                                <input type="text" name="city" placeholder="Contoh: Tangerang Selatan / Jakarta"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-cyan-400 focus:outline-none">
                            </div>
                        </div>

                        <!-- Date & Time (Conditional for test drive) -->
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4" x-show="inquiryType === 'test_drive'">
                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Rencana Tanggal Test Drive
                                </label>
                                <input type="date" name="preferred_date" min="{{ date('Y-m-d') }}"
                                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                            </div>

                            <div>
                                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                    Waktu / Jam
                                </label>
                                <select name="preferred_time" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                                    <option value="Pagi (09.00 - 12.00)">Pagi (09.00 - 12.00)</option>
                                    <option value="Siang (13.00 - 15.00)">Siang (13.00 - 15.00)</option>
                                    <option value="Sore (15.00 - 18.00)">Sore (15.00 - 18.00)</option>
                                </select>
                            </div>
                        </div>

                        <!-- Notes -->
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                                Catatan Tambahan (Opsional)
                            </label>
                            <textarea name="notes" rows="2" placeholder="Tuliskan jika ingin tukar tambah / test drive ke rumah..."
                                      class="w-full px-4 py-2.5 rounded-xl bg-slate-900 border border-slate-700 text-white placeholder-slate-500 text-sm focus:border-cyan-400 focus:outline-none"></textarea>
                        </div>

                        <!-- Submit Button -->
                        <button type="submit" 
                                :disabled="submitting"
                                class="w-full py-4 rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-blue-700 hover:from-cyan-400 hover:to-blue-600 text-white font-black text-sm uppercase tracking-wider shadow-lg shadow-cyan-500/25 flex items-center justify-center transition-all disabled:opacity-50">
                            <span x-show="!submitting" class="flex items-center">
                                <i class="fa-solid fa-paper-plane mr-2"></i>
                                Kirim &amp; Teruskan ke WhatsApp Sales
                            </span>
                            <span x-show="submitting" style="display: none;" class="flex items-center">
                                <i class="fa-solid fa-circle-notch fa-spin mr-2"></i>
                                Memproses...
                            </span>
                        </button>
                    </form>

                </div>

            </div>
        </div>

    </div>
</section>

{{-- ========================================== --}}
{{-- 8. MAPS & SHOWROOM LOCATION SECTION        --}}
{{-- ========================================== --}}
<section id="location" class="py-20 bg-[#070B16] relative border-t border-cyan-900/30">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <div class="text-center max-w-3xl mx-auto mb-14">
            <div class="inline-flex items-center space-x-2 px-3 py-1 rounded-full bg-cyan-950/80 border border-cyan-500/30 text-cyan-300 text-xs font-bold uppercase tracking-widest mb-3">
                <i class="fa-solid fa-map-location-dot text-cyan-400"></i>
                <span>EXPERIENCE CENTER RESMI</span>
            </div>
            <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight">
                Lokasi Dealer &amp; Fasilitas Showroom
            </h2>
            <p class="text-slate-400 mt-2 text-sm sm:text-base">
                Kunjungi Experience Center kami untuk melihat langsung display unit, pengisian baterai DC Fast Charging, dan mencoba test drive.
            </p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-center">
            
            <!-- Left: Showroom Facilities & Address details -->
            <div class="lg:col-span-5 glass-panel rounded-3xl p-6 sm:p-8 space-y-6 neon-border">
                
                <div>
                    <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">DEALER RESMI BYD</span>
                    <h3 class="text-2xl font-black text-white mt-1">
                        {{ $settings['dealer_name'] ?? 'BYD Arista BSD City Experience Center' }}
                    </h3>
                </div>

                <div class="space-y-4 text-sm">
                    <div class="flex items-start space-x-3 text-slate-300">
                        <i class="fa-solid fa-location-dot text-cyan-400 mt-1 text-base"></i>
                        <span>{{ $settings['dealer_address'] ?? 'Jl. BSD Grand Boulevard No. 8, Tangerang Selatan' }}</span>
                    </div>

                    <div class="flex items-center space-x-3 text-slate-300">
                        <i class="fa-regular fa-clock text-cyan-400 text-base"></i>
                        <span>{{ $settings['opening_hours'] ?? 'Senin - Minggu: 08:30 - 20:00 WIB' }}</span>
                    </div>

                    <div class="flex items-center space-x-3 text-slate-300">
                        <i class="fa-solid fa-phone text-cyan-400 text-base"></i>
                        <span>{{ $salesProfile?->phone ?? $settings['dealer_phone'] ?? '+62 812-8899-7722' }}</span>
                    </div>
                </div>

                <!-- Showroom Highlights Badges -->
                <div class="pt-2 border-t border-slate-800">
                    <p class="text-xs font-bold uppercase tracking-wider text-slate-400 mb-3">Fasilitas Showroom:</p>
                    <div class="grid grid-cols-2 gap-2 text-xs text-slate-300">
                        <div class="p-2.5 rounded-xl bg-slate-900/90 border border-slate-800 flex items-center space-x-2">
                            <i class="fa-solid fa-charging-station text-cyan-400"></i>
                            <span>DC Fast Charger 150kW</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-900/90 border border-slate-800 flex items-center space-x-2">
                            <i class="fa-solid fa-mug-saucer text-cyan-400"></i>
                            <span>VIP Customer Lounge</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-900/90 border border-slate-800 flex items-center space-x-2">
                            <i class="fa-solid fa-car text-cyan-400"></i>
                            <span>Test Drive Fleet Ready</span>
                        </div>
                        <div class="p-2.5 rounded-xl bg-slate-900/90 border border-slate-800 flex items-center space-x-2">
                            <i class="fa-solid fa-wrench text-cyan-400"></i>
                            <span>Bengkel Resmi 3S</span>
                        </div>
                    </div>
                </div>

                <!-- Google Maps Direction Button -->
                <div class="pt-2">
                    <a href="{{ $settings['maps_link'] ?? 'https://maps.google.com/?q=BSD+City+Tangerang' }}" 
                       target="_blank"
                       class="w-full py-3.5 rounded-xl bg-slate-800 hover:bg-slate-700 text-cyan-300 border border-cyan-500/30 hover:border-cyan-400 font-bold text-xs uppercase tracking-wider text-center flex items-center justify-center transition-all">
                        <i class="fa-solid fa-diamond-turn-right mr-2 text-sm"></i>
                        Petunjuk Arah Google Maps
                    </a>
                </div>

            </div>

            <!-- Right: Interactive Google Maps Iframe -->
            <div class="lg:col-span-7 glass-panel rounded-3xl p-3 sm:p-4 neon-border overflow-hidden">
                <div class="relative w-full h-[380px] sm:h-[450px] rounded-2xl overflow-hidden bg-slate-900">
                    <iframe src="{{ $settings['maps_embed_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3965.736691456187!2d106.643322!3d-6.301389!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69fb7a28e93231%3A0xa615f8d68962ffaa!2sBSD%20City!5e0!3m2!1sid!2sid!4v1700000000000' }}" 
                            width="100%" 
                            height="100%" 
                            style="border:0; filter: invert(90%) hue-rotate(180deg);" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                    </iframe>
                </div>
            </div>

        </div>

    </div>
</section>

@endsection
