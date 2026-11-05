@extends('admin.layouts.admin')

@section('title', 'SEO & Meta Tags')

@section('content')
<div class="space-y-8" x-data="{
    title: '{{ addslashes($settings['site_title'] ?? '') }}',
    description: '{{ addslashes($settings['meta_description'] ?? '') }}',
    ogTitle: '{{ addslashes($settings['og_title'] ?? '') }}',
    ogDescription: '{{ addslashes($settings['og_description'] ?? '') }}',
    serpMode: 'desktop',
    currentTab: 'serp',
    get effectiveOgTitle() {
        return this.ogTitle.trim() ? this.ogTitle : (this.title.trim() ? this.title : 'BYD Sales Indonesia | Dealer Resmi Mobil Listrik');
    },
    get effectiveOgDesc() {
        return this.ogDescription.trim() ? this.ogDescription : (this.description.trim() ? this.description : 'Informasi spesifikasi, harga OTR terbaru, promo DP ringan, dan booking test drive BYD.');
    }
}">
    <!-- Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div>
            <h1 class="text-2xl font-black text-white flex items-center space-x-3">
                <span class="w-10 h-10 rounded-xl bg-cyan-500/10 border border-cyan-500/30 flex items-center justify-center text-cyan-400">
                    <i class="fa-solid fa-magnifying-glass-chart"></i>
                </span>
                <span>Optimasi Mesin Pencari (SEO) &amp; Meta Tags</span>
            </h1>
            <p class="text-sm text-slate-400 mt-1">
                Kelola metadata Google SERP, Open Graph sosial media (WhatsApp/FB), Webmaster, dan Skrip Pelacak Analitik.
            </p>
        </div>

        <div class="flex items-center space-x-3">
            <a href="{{ route('sitemap') }}" target="_blank" 
               class="px-3.5 py-2 rounded-xl bg-slate-900 border border-slate-700 hover:border-cyan-500 text-xs font-semibold text-slate-300 hover:text-white transition-colors flex items-center space-x-2">
                <i class="fa-solid fa-sitemap text-cyan-400"></i>
                <span>Sitemap XML</span>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-500"></i>
            </a>

            <a href="{{ route('robots') }}" target="_blank" 
               class="px-3.5 py-2 rounded-xl bg-slate-900 border border-slate-700 hover:border-cyan-500 text-xs font-semibold text-slate-300 hover:text-white transition-colors flex items-center space-x-2">
                <i class="fa-solid fa-robot text-cyan-400"></i>
                <span>Robots.txt</span>
                <i class="fa-solid fa-arrow-up-right-from-square text-[10px] text-slate-500"></i>
            </a>
        </div>
    </div>

    <!-- SEO Health & Audit Overview Card -->
    <div class="admin-card rounded-2xl p-6 border border-slate-800 bg-[#0B1124] relative overflow-hidden">
        <div class="absolute -top-12 -right-12 w-64 h-64 bg-cyan-500/5 rounded-full blur-3xl pointer-events-none"></div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-center">
            <!-- Score Meter -->
            <div class="lg:col-span-3 flex items-center space-x-5 lg:border-r border-slate-800/80 pr-4">
                <div class="relative w-24 h-24 flex items-center justify-center">
                    <svg class="w-24 h-24 transform -rotate-90" viewBox="0 0 100 100">
                        <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="8" class="text-slate-800" fill="transparent" />
                        <circle cx="50" cy="50" r="40" stroke="currentColor" stroke-width="8" 
                                class="{{ $score >= 80 ? 'text-emerald-400' : ($score >= 50 ? 'text-cyan-400' : 'text-amber-400') }}" 
                                stroke-dasharray="251.2" 
                                stroke-dashoffset="{{ 251.2 - (251.2 * $score / 100) }}"
                                stroke-linecap="round" 
                                fill="transparent" />
                    </svg>
                    <div class="absolute inset-0 flex flex-col items-center justify-center text-center">
                        <span class="text-2xl font-black text-white">{{ $score }}%</span>
                        <span class="text-[10px] uppercase font-bold text-slate-400">Skor SEO</span>
                    </div>
                </div>

                <div>
                    <span class="inline-block px-2.5 py-0.5 rounded-full text-xs font-bold {{ $score >= 80 ? 'bg-emerald-500/10 text-emerald-400 border border-emerald-500/30' : ($score >= 50 ? 'bg-cyan-500/10 text-cyan-400 border border-cyan-500/30' : 'bg-amber-500/10 text-amber-400 border border-amber-500/30') }}">
                        {{ $score >= 80 ? 'Optimal' : ($score >= 50 ? 'Cukup Baik' : 'Perlu Dioptimalkan') }}
                    </span>
                    <p class="text-xs text-slate-400 mt-1.5 leading-relaxed">
                        {{ $score >= 80 ? 'Konfigurasi SEO website sudah sangat baik dan siap diindeks Google.' : 'Lengkapi checklist SEO di samping untuk memaksimalkan ranking pencarian.' }}
                    </p>
                </div>
            </div>

            <!-- Checklist Status -->
            <div class="lg:col-span-9 grid grid-cols-2 md:grid-cols-4 gap-3 text-xs">
                <div class="p-3 rounded-xl bg-slate-900/60 border {{ $checks['title'] ? 'border-emerald-500/30 text-slate-300' : 'border-rose-500/30 text-rose-300' }} flex items-center space-x-2.5">
                    <i class="fa-solid {{ $checks['title'] ? 'fa-circle-check text-emerald-400' : 'fa-circle-xmark text-rose-400' }} text-base"></i>
                    <div>
                        <p class="font-bold">Meta Title</p>
                        <p class="text-[11px] text-slate-500">{{ $checks['title'] ? 'Terisi' : 'Kosong' }}</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/60 border {{ $checks['description'] ? 'border-emerald-500/30 text-slate-300' : 'border-amber-500/30 text-amber-300' }} flex items-center space-x-2.5">
                    <i class="fa-solid {{ $checks['description'] ? 'fa-circle-check text-emerald-400' : 'fa-triangle-exclamation text-amber-400' }} text-base"></i>
                    <div>
                        <p class="font-bold">Meta Description</p>
                        <p class="text-[11px] text-slate-500">{{ $checks['description'] ? 'Ideal (>= 50 chars)' : 'Terlalu pendek' }}</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/60 border {{ $checks['og_image'] ? 'border-emerald-500/30 text-slate-300' : 'border-rose-500/30 text-rose-300' }} flex items-center space-x-2.5">
                    <i class="fa-solid {{ $checks['og_image'] ? 'fa-circle-check text-emerald-400' : 'fa-circle-xmark text-rose-400' }} text-base"></i>
                    <div>
                        <p class="font-bold">OG Image Share</p>
                        <p class="text-[11px] text-slate-500">{{ $checks['og_image'] ? 'Tersedia' : 'Belum Ada' }}</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/60 border {{ $checks['analytics'] ? 'border-emerald-500/30 text-slate-300' : 'border-slate-800 text-slate-400' }} flex items-center space-x-2.5">
                    <i class="fa-solid {{ $checks['analytics'] ? 'fa-circle-check text-emerald-400' : 'fa-circle-dot text-slate-500' }} text-base"></i>
                    <div>
                        <p class="font-bold">GA4 / GTM</p>
                        <p class="text-[11px] text-slate-500">{{ $checks['analytics'] ? 'Terpasang' : 'Opsional' }}</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/60 border {{ $checks['keywords'] ? 'border-emerald-500/30 text-slate-300' : 'border-slate-800 text-slate-400' }} flex items-center space-x-2.5">
                    <i class="fa-solid {{ $checks['keywords'] ? 'fa-circle-check text-emerald-400' : 'fa-circle-dot text-slate-500' }} text-base"></i>
                    <div>
                        <p class="font-bold">Keywords</p>
                        <p class="text-[11px] text-slate-500">{{ $checks['keywords'] ? 'Terisi' : 'Kosong' }}</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/60 border {{ $checks['webmaster'] ? 'border-emerald-500/30 text-slate-300' : 'border-slate-800 text-slate-400' }} flex items-center space-x-2.5">
                    <i class="fa-solid {{ $checks['webmaster'] ? 'fa-circle-check text-emerald-400' : 'fa-circle-dot text-slate-500' }} text-base"></i>
                    <div>
                        <p class="font-bold">Google Search Console</p>
                        <p class="text-[11px] text-slate-500">{{ $checks['webmaster'] ? 'Terverifikasi' : 'Belum Verifikasi' }}</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/60 border border-cyan-500/30 text-slate-300 flex items-center space-x-2.5">
                    <i class="fa-solid fa-car text-cyan-400 text-base"></i>
                    <div>
                        <p class="font-bold">Model Terindeks</p>
                        <p class="text-[11px] text-cyan-400">{{ $totalCars }} Model Mobil</p>
                    </div>
                </div>

                <div class="p-3 rounded-xl bg-slate-900/60 border border-cyan-500/30 text-slate-300 flex items-center space-x-2.5">
                    <i class="fa-solid fa-newspaper text-cyan-400 text-base"></i>
                    <div>
                        <p class="font-bold">Artikel Terindeks</p>
                        <p class="text-[11px] text-cyan-400">{{ $totalArticles }} Berita</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Configuration Form -->
    <form action="{{ route('admin.seo.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
        @csrf

        <!-- Navigation Tabs -->
        <div class="flex flex-wrap items-center gap-2 border-b border-slate-800 pb-3 text-sm font-semibold">
            <button type="button" @click="currentTab = 'serp'" 
                    :class="currentTab === 'serp' ? 'bg-cyan-500/10 text-cyan-400 border-cyan-500/40' : 'text-slate-400 hover:text-white border-transparent'"
                    class="px-4 py-2.5 rounded-xl border transition-all flex items-center space-x-2">
                <i class="fa-brands fa-google"></i>
                <span>Google SERP &amp; Meta Utama</span>
            </button>

            <button type="button" @click="currentTab = 'social'" 
                    :class="currentTab === 'social' ? 'bg-cyan-500/10 text-cyan-400 border-cyan-500/40' : 'text-slate-400 hover:text-white border-transparent'"
                    class="px-4 py-2.5 rounded-xl border transition-all flex items-center space-x-2">
                <i class="fa-solid fa-share-nodes"></i>
                <span>Social Share (Open Graph &amp; WA)</span>
            </button>

            <button type="button" @click="currentTab = 'webmaster'" 
                    :class="currentTab === 'webmaster' ? 'bg-cyan-500/10 text-cyan-400 border-cyan-500/40' : 'text-slate-400 hover:text-white border-transparent'"
                    class="px-4 py-2.5 rounded-xl border transition-all flex items-center space-x-2">
                <i class="fa-solid fa-shield-halved"></i>
                <span>Webmaster &amp; Verifikasi</span>
            </button>

            <button type="button" @click="currentTab = 'analytics'" 
                    :class="currentTab === 'analytics' ? 'bg-cyan-500/10 text-cyan-400 border-cyan-500/40' : 'text-slate-400 hover:text-white border-transparent'"
                    class="px-4 py-2.5 rounded-xl border transition-all flex items-center space-x-2">
                <i class="fa-solid fa-chart-line"></i>
                <span>Analytics &amp; Pixel Tracker</span>
            </button>

            <button type="button" @click="currentTab = 'custom'" 
                    :class="currentTab === 'custom' ? 'bg-cyan-500/10 text-cyan-400 border-cyan-500/40' : 'text-slate-400 hover:text-white border-transparent'"
                    class="px-4 py-2.5 rounded-xl border transition-all flex items-center space-x-2">
                <i class="fa-solid fa-code"></i>
                <span>Custom Skrip &amp; Header</span>
            </button>
        </div>

        <!-- TAB 1: Google SERP & Meta Utama -->
        <div x-show="currentTab === 'serp'" class="space-y-6">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Form Fields -->
                <div class="lg:col-span-7 space-y-6 admin-card rounded-2xl p-6">
                    <h3 class="text-base font-bold text-white border-b border-slate-800 pb-3 flex items-center space-x-2">
                        <i class="fa-solid fa-file-lines text-cyan-400"></i>
                        <span>Metadata Penelusuran Mesin Pencari</span>
                    </h3>

                    <!-- Site / Meta Title -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                Meta Title / Judul Halaman <span class="text-rose-400">*</span>
                            </label>
                            <span class="text-xs font-mono" :class="title.length >= 50 && title.length <= 65 ? 'text-emerald-400' : (title.length > 65 ? 'text-rose-400' : 'text-amber-400')">
                                <span x-text="title.length">0</span> / 60 Karakter
                            </span>
                        </div>
                        <input type="text" name="site_title" x-model="title" required
                               placeholder="Contoh: BYD Sales Indonesia | Dealer Resmi Mobil Listrik BYD"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm">
                        <p class="text-[11px] text-slate-400 mt-1.5">
                            Judul utama yang muncul di tab browser dan hasil pencarian Google. Disarankan antara 50 - 60 karakter.
                        </p>
                    </div>

                    <!-- Meta Description -->
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <label class="text-xs font-bold uppercase tracking-wider text-slate-300">
                                Meta Description / Cuplikan Deskripsi <span class="text-rose-400">*</span>
                            </label>
                            <span class="text-xs font-mono" :class="description.length >= 120 && description.length <= 160 ? 'text-emerald-400' : (description.length > 160 ? 'text-rose-400' : 'text-amber-400')">
                                <span x-text="description.length">0</span> / 160 Karakter
                            </span>
                        </div>
                        <textarea name="meta_description" x-model="description" rows="3" required
                                  placeholder="Contoh: Promo spesial mobil listrik BYD Seal, Atto 3, Dolphin, dan M6. DP ringan, bunga 0%, garansi baterai 8 tahun. Hubungi kami untuk jadwal test drive sekarang!"
                                  class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm leading-relaxed"></textarea>
                        <p class="text-[11px] text-slate-400 mt-1.5">
                            Rangkuman singkat penawaran yang muncul di bawah judul pada hasil pencarian Google. Disarankan 120 - 160 karakter.
                        </p>
                    </div>

                    <!-- Meta Keywords -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Meta Keywords / Kata Kunci Fokus (Pisahkan dengan koma)
                        </label>
                        <input type="text" name="meta_keywords" 
                               value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}"
                               placeholder="BYD Indonesia, Mobil Listrik BYD, Harga BYD Seal, Promo BYD M6, Test Drive BYD"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm">
                        <p class="text-[11px] text-slate-400 mt-1.5">
                            Kata kunci utama penargetan lokal SEO penjualan mobil listrik.
                        </p>
                    </div>

                    <!-- Indexing & Robots Control -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                Robots Meta Tag <span class="text-rose-400">*</span>
                            </label>
                            <select name="seo_robots" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm">
                                <option value="index, follow" {{ ($settings['seo_robots'] ?? 'index, follow') == 'index, follow' ? 'selected' : '' }}>
                                    index, follow (Sangat Direkomendasikan)
                                </option>
                                <option value="noindex, follow" {{ ($settings['seo_robots'] ?? '') == 'noindex, follow' ? 'selected' : '' }}>
                                    noindex, follow (Jangan tampilkan di Google)
                                </option>
                                <option value="index, nofollow" {{ ($settings['seo_robots'] ?? '') == 'index, nofollow' ? 'selected' : '' }}>
                                    index, nofollow (Index tanpa ikuti tautan)
                                </option>
                                <option value="noindex, nofollow" {{ ($settings['seo_robots'] ?? '') == 'noindex, nofollow' ? 'selected' : '' }}>
                                    noindex, nofollow (Tutup total dari crawler)
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                Canonical URL (Kustom)
                            </label>
                            <input type="url" name="seo_canonical_url" 
                                   value="{{ old('seo_canonical_url', $settings['seo_canonical_url'] ?? '') }}"
                                   placeholder="{{ url('/') }}"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm">
                        </div>
                    </div>
                </div>

                <!-- Right: Live Google SERP Simulator -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="admin-card rounded-2xl p-6 border border-cyan-500/20 bg-slate-950/80 sticky top-24">
                        <div class="flex items-center justify-between border-b border-slate-800 pb-3 mb-4">
                            <h3 class="text-sm font-bold text-white flex items-center space-x-2">
                                <i class="fa-brands fa-google text-cyan-400"></i>
                                <span>Pratinjau Langsung Google SERP</span>
                            </h3>
                            <div class="flex items-center space-x-1 bg-slate-900 p-1 rounded-lg border border-slate-800 text-xs">
                                <button type="button" @click="serpMode = 'desktop'" 
                                        :class="serpMode === 'desktop' ? 'bg-cyan-500/20 text-cyan-300 font-bold' : 'text-slate-400'"
                                        class="px-2 py-1 rounded">
                                    <i class="fa-solid fa-laptop"></i> Desktop
                                </button>
                                <button type="button" @click="serpMode = 'mobile'" 
                                        :class="serpMode === 'mobile' ? 'bg-cyan-500/20 text-cyan-300 font-bold' : 'text-slate-400'"
                                        class="px-2 py-1 rounded">
                                    <i class="fa-solid fa-mobile-screen"></i> Mobile
                                </button>
                            </div>
                        </div>

                        <!-- Google Snippet Simulator Box -->
                        <div class="p-4 rounded-xl bg-white text-slate-800 font-sans shadow-lg transition-all"
                             :class="serpMode === 'mobile' ? 'max-w-[340px] mx-auto text-xs' : 'text-sm'">
                            <!-- URL / Breadcrumb -->
                            <div class="flex items-center space-x-2 text-[12px] text-[#202124] mb-1">
                                <div class="w-5 h-5 rounded-full bg-slate-100 flex items-center justify-center overflow-hidden border border-slate-200">
                                    <img src="{{ asset($settings['favicon_path'] ?? 'images/favicon.svg') }}" 
                                         alt="Favicon" class="w-3.5 h-3.5 object-contain">
                                </div>
                                <div class="truncate">
                                    <span class="font-medium text-[#202124]">{{ parse_url(url('/'), PHP_URL_HOST) ?? 'byd-sales.id' }}</span>
                                    <span class="text-[#5f6368] text-[11px] block truncate">{{ url('/') }}</span>
                                </div>
                            </div>

                            <!-- Title Link -->
                            <h4 class="text-[#1a0dab] hover:underline font-medium text-base leading-snug cursor-pointer line-clamp-2 mt-1"
                                x-text="title ? title : 'BYD Sales Indonesia | Dealer Resmi Mobil Listrik BYD'">
                                BYD Sales Indonesia | Dealer Resmi Mobil Listrik BYD
                            </h4>

                            <!-- Description Snippet -->
                            <p class="text-[#4d5156] text-[13px] leading-relaxed mt-1 line-clamp-3"
                               x-text="description ? description : 'Informasi spesifikasi lengkap mobil listrik BYD Seal, Atto 3, Dolphin, dan M6. Simulasi kredit DP murah, bunga 0%, dan booking test drive resmi.'">
                                Informasi spesifikasi lengkap mobil listrik BYD Seal, Atto 3, Dolphin, dan M6. Simulasi kredit DP murah, bunga 0%, dan booking test drive resmi.
                            </p>
                        </div>

                        <!-- SERP Quality Tips -->
                        <div class="mt-4 p-3 rounded-xl bg-slate-900/60 border border-slate-800 text-xs text-slate-400 space-y-1">
                            <p class="font-bold text-slate-300 flex items-center space-x-1.5">
                                <i class="fa-solid fa-lightbulb text-amber-400"></i>
                                <span>Tips SEO Otomotif:</span>
                            </p>
                            <p>• Cantumkan nama brand ("BYD"), wilayah / kota ("Jakarta / Jabodetabek"), dan kata aksi ("Promo", "Harga OTR", "Test Drive").</p>
                            <p>• Pastikan judul tidak melebihi 65 karakter agar tidak terpotong (...) oleh Google.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 2: Social Media & WhatsApp Sharing (Open Graph) -->
        <div x-show="currentTab === 'social'" class="space-y-6" style="display: none;">
            <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Left: Form Fields -->
                <div class="lg:col-span-7 space-y-6 admin-card rounded-2xl p-6">
                    <h3 class="text-base font-bold text-white border-b border-slate-800 pb-3 flex items-center space-x-2">
                        <i class="fa-solid fa-share-nodes text-cyan-400"></i>
                        <span>Pengaturan Open Graph &amp; Tampilan Link Medsos</span>
                    </h3>

                    <!-- OG Title -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            OG Title (Judul saat dishare ke WhatsApp / Facebook)
                        </label>
                        <input type="text" name="og_title" x-model="ogTitle"
                               placeholder="Biarkan kosong untuk memakai Meta Title di atas"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm">
                    </div>

                    <!-- OG Description -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            OG Description (Deskripsi cuplikan WhatsApp / Medsos)
                        </label>
                        <textarea name="og_description" x-model="ogDescription" rows="3"
                                  placeholder="Biarkan kosong untuk memakai Meta Description di atas"
                                  class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm leading-relaxed"></textarea>
                    </div>

                    <!-- OG Banner Image Upload -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Upload Banner Open Graph (OG Image)
                        </label>
                        <input type="file" name="og_image" accept="image/png,image/jpeg,image/webp,image/svg+xml"
                               class="w-full text-xs text-slate-400 file:mr-4 file:py-2.5 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                        <p class="text-[11px] text-slate-400 mt-1.5">
                            Rekomendasi rasio 1.91:1 (Resolusi ideal: <strong>1200 x 630 px</strong>). Maksimal ukuran file 4 MB.
                        </p>
                    </div>

                    <!-- Twitter Card Format -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                Twitter / X Card Style
                            </label>
                            <select name="twitter_card" class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm">
                                <option value="summary_large_image" {{ ($settings['twitter_card'] ?? 'summary_large_image') == 'summary_large_image' ? 'selected' : '' }}>
                                    summary_large_image (Gambar Besar - Rekomendasi)
                                </option>
                                <option value="summary" {{ ($settings['twitter_card'] ?? '') == 'summary' ? 'selected' : '' }}>
                                    summary (Kotak Thumbnail Kecil)
                                </option>
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                                Akun Twitter / X Dealer
                            </label>
                            <input type="text" name="twitter_site" 
                                   value="{{ old('twitter_site', $settings['twitter_site'] ?? '@bydindonesia') }}"
                                   placeholder="@bydindonesia"
                                   class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm">
                        </div>
                    </div>
                </div>

                <!-- Right: Social Share Card Simulator (WhatsApp / Facebook Preview) -->
                <div class="lg:col-span-5 space-y-6">
                    <div class="admin-card rounded-2xl p-6 border border-slate-800 bg-slate-950/80 sticky top-24">
                        <h3 class="text-sm font-bold text-white flex items-center space-x-2 border-b border-slate-800 pb-3 mb-4">
                            <i class="fa-brands fa-whatsapp text-emerald-400 text-base"></i>
                            <span>Pratinjau Tautan WhatsApp / Medsos</span>
                        </h3>

                        <!-- WhatsApp / Facebook Share Bubble -->
                        <div class="bg-[#0c1317] p-3 rounded-2xl max-w-sm mx-auto border border-emerald-900/30 shadow-xl">
                            <div class="rounded-xl overflow-hidden bg-[#1f2c34] border border-slate-700/60">
                                <!-- Image Preview -->
                                <div class="w-full h-44 bg-slate-900 relative flex items-center justify-center overflow-hidden">
                                    <img src="{{ asset($settings['og_image_path'] ?? 'images/og-image.svg') }}" 
                                         alt="OG Banner" 
                                         class="w-full h-full object-cover">
                                    <span class="absolute top-2 right-2 px-2 py-0.5 rounded bg-black/70 text-[10px] font-bold text-white uppercase tracking-wider backdrop-blur-sm">
                                        1200 x 630
                                    </span>
                                </div>

                                <!-- Card Content -->
                                <div class="p-3">
                                    <p class="text-[11px] text-slate-400 font-medium uppercase tracking-wider">
                                        {{ parse_url(url('/'), PHP_URL_HOST) ?? 'byd-sales.id' }}
                                    </p>
                                    <h4 class="text-sm font-bold text-slate-100 line-clamp-2 mt-1 leading-snug"
                                        x-text="effectiveOgTitle">
                                        BYD Sales Indonesia | Dealer Resmi Mobil Listrik
                                    </h4>
                                    <p class="text-xs text-slate-400 line-clamp-2 mt-1 leading-relaxed"
                                       x-text="effectiveOgDesc">
                                        Informasi spesifikasi, harga OTR terbaru, promo DP ringan, dan booking test drive BYD.
                                    </p>
                                </div>
                            </div>
                            <div class="flex justify-end mt-1 text-[10px] text-slate-500 space-x-1">
                                <span>10:45</span>
                                <i class="fa-solid fa-check-double text-cyan-400"></i>
                            </div>
                        </div>

                        <p class="text-xs text-slate-400 text-center mt-3">
                            Format pratinjau saat tautan web dibagikan melalui WhatsApp, Facebook, iMessage, atau LinkedIn.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- TAB 3: Webmaster & Verifikasi Mesin Pencari -->
        <div x-show="currentTab === 'webmaster'" class="space-y-6" style="display: none;">
            <div class="admin-card rounded-2xl p-6 max-w-4xl space-y-6">
                <h3 class="text-base font-bold text-white border-b border-slate-800 pb-3 flex items-center space-x-2">
                    <i class="fa-solid fa-shield-halved text-cyan-400"></i>
                    <span>Verifikasi Kepemilikan Webmaster (Google &amp; Bing)</span>
                </h3>

                <!-- Google Search Console -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Google Search Console Verification Meta Tag / Key
                    </label>
                    <div class="relative">
                        <input type="text" name="google_site_verification" 
                               value="{{ old('google_site_verification', $settings['google_site_verification'] ?? '') }}"
                               placeholder="Contoh: aBcDeFg1234567890XYZ (Kode dari meta name='google-site-verification')"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm font-mono">
                    </div>
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        Masukkan kode token verifikasi kepemilikan domain dari konsol Google Search Console untuk monitoring kata kunci dan performa indeks.
                    </p>
                </div>

                <!-- Bing Webmaster Tools -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Bing Webmaster Verification Code
                    </label>
                    <input type="text" name="bing_site_verification" 
                           value="{{ old('bing_site_verification', $settings['bing_site_verification'] ?? '') }}"
                           placeholder="Contoh: 1234567890ABCDEF1234567890ABCDEF"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm font-mono">
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        Kode verifikasi meta tag dari Microsoft Bing Webmaster Tools.
                    </p>
                </div>

                <!-- Structured Data / Schema.org Notification -->
                <div class="p-4 rounded-xl bg-cyan-500/5 border border-cyan-500/20 text-xs text-slate-300 space-y-2">
                    <div class="flex items-center space-x-2 font-bold text-cyan-400">
                        <i class="fa-solid fa-code"></i>
                        <span>Schema.org JSON-LD (Auto-Generated)</span>
                    </div>
                    <p class="leading-relaxed">
                        Sistem website ini secara otomatis menyematkan schema terstruktur <code>AutoDealer</code> dan <code>Car</code> untuk semua varian mobil BYD, mencakup harga OTR, ketersediaan unit, jam buka showroom, dan nomor kontak WhatsApp resmi sales.
                    </p>
                </div>
            </div>
        </div>

        <!-- TAB 4: Analytics & Pixel Tracking -->
        <div x-show="currentTab === 'analytics'" class="space-y-6" style="display: none;">
            <div class="admin-card rounded-2xl p-6 max-w-4xl space-y-6">
                <h3 class="text-base font-bold text-white border-b border-slate-800 pb-3 flex items-center space-x-2">
                    <i class="fa-solid fa-chart-line text-cyan-400"></i>
                    <span>Pelacakan Kunjungan &amp; Konversi Iklan (GA4, GTM, Pixel)</span>
                </h3>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Google Analytics 4 -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Google Analytics 4 Measurement ID
                        </label>
                        <input type="text" name="google_analytics_id" 
                               value="{{ old('google_analytics_id', $settings['google_analytics_id'] ?? '') }}"
                               placeholder="G-XXXXXXXXXX"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm font-mono">
                        <p class="text-[11px] text-slate-400 mt-1.5">
                            Melacak total pengunjung, sumber traffic (Google Ads, Social, Direct), dan perilaku calon pembeli mobil.
                        </p>
                    </div>

                    <!-- Google Tag Manager -->
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                            Google Tag Manager (GTM) Container ID
                        </label>
                        <input type="text" name="gtm_container_id" 
                               value="{{ old('gtm_container_id', $settings['gtm_container_id'] ?? '') }}"
                               placeholder="GTM-XXXXXXX"
                               class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm font-mono">
                        <p class="text-[11px] text-slate-400 mt-1.5">
                            Jika Anda menggunakan Google Tag Manager untuk manajemen semua event tag &amp; trigger.
                        </p>
                    </div>
                </div>

                <!-- Meta Pixel (Facebook Ads) -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Meta Pixel ID (Facebook &amp; Instagram Ads)
                    </label>
                    <input type="text" name="meta_pixel_id" 
                           value="{{ old('meta_pixel_id', $settings['meta_pixel_id'] ?? '') }}"
                           placeholder="Contoh: 123456789012345"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-sm font-mono">
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        Melacak klik tombol WhatsApp dan pengisian formulir test drive untuk optimasi kampanye iklan FB &amp; IG.
                    </p>
                </div>
            </div>
        </div>

        <!-- TAB 5: Custom Skrip & Header -->
        <div x-show="currentTab === 'custom'" class="space-y-6" style="display: none;">
            <div class="admin-card rounded-2xl p-6 max-w-4xl space-y-6">
                <h3 class="text-base font-bold text-white border-b border-slate-800 pb-3 flex items-center space-x-2">
                    <i class="fa-solid fa-code text-cyan-400"></i>
                    <span>Injeksi Skrip Kustom (Header &amp; Footer)</span>
                </h3>

                <!-- Custom Header Scripts -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Custom Scripts di dalam Tag &lt;head&gt;
                    </label>
                    <textarea name="custom_header_scripts" rows="5"
                              placeholder="<!-- Sisipkan tag <script> atau <meta> tambahan di sini -->"
                              class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-xs font-mono leading-relaxed">{{ old('custom_header_scripts', $settings['custom_header_scripts'] ?? '') }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        Skrip ini akan dimuat sebelum konten halaman dirender (misalnya Heatmap Hotjar, Microsoft Clarity, dsb).
                    </p>
                </div>

                <!-- Custom Footer Scripts -->
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-2">
                        Custom Scripts sebelum Tag Penutup &lt;/body&gt;
                    </label>
                    <textarea name="custom_footer_scripts" rows="5"
                              placeholder="<!-- Sisipkan skrip JavaScript eksternal di sini -->"
                              class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 focus:border-cyan-400 focus:outline-none text-white text-xs font-mono leading-relaxed">{{ old('custom_footer_scripts', $settings['custom_footer_scripts'] ?? '') }}</textarea>
                    <p class="text-[11px] text-slate-400 mt-1.5">
                        Skrip ini akan dieksekusi di akhir pemuatan halaman website.
                    </p>
                </div>
            </div>
        </div>

        <!-- Save Button Footer -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-800">
            <div class="text-xs text-slate-400">
                <i class="fa-solid fa-circle-info text-cyan-400 mr-1"></i> Perubahan metadata akan langsung diaplikasikan ke halaman publik dan XML Sitemap.
            </div>

            <button type="submit" 
                    class="px-8 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-black font-extrabold text-sm transition-all shadow-lg shadow-cyan-500/20 flex items-center space-x-2">
                <i class="fa-solid fa-floppy-disk"></i>
                <span>Simpan Pengaturan SEO</span>
            </button>
        </div>
    </form>
</div>
@endsection
