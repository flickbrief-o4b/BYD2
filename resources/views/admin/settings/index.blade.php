@extends('admin.layouts.admin')

@section('title', 'Pengaturan Website & Branding')
@section('header_title', 'Pengaturan Logo, Favicon, OG Graph & Kontak')

@section('content')

<form action="{{ route('admin.settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
    @csrf

    <!-- 1. BRANDING & MEDIA UPLOAD (Logo, Favicon, Open Graph) -->
    <div class="admin-card rounded-2xl p-6 sm:p-8 space-y-6">
        <div class="border-b border-slate-800 pb-4">
            <h3 class="text-lg font-bold text-white flex items-center">
                <i class="fa-solid fa-photo-film text-cyan-400 mr-2.5"></i>
                Identitas Branding (Upload Logo, Favicon &amp; OG Graph)
            </h3>
            <p class="text-xs text-slate-400 mt-1">
                Unggah berkas gambar untuk logo header, favicon browser tab, dan Open Graph preview media sosial.
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            
            <!-- Upload Logo -->
            <div class="p-5 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Logo Website
                </label>
                
                <!-- Current Preview -->
                <div class="h-28 rounded-xl bg-[#050811] border border-slate-800 p-3 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset($settings['logo_path'] ?? 'images/byd-logo.svg') }}" 
                         alt="Current Logo" 
                         class="max-h-16 w-auto object-contain"
                         onerror="this.src='{{ asset('images/byd-logo.svg') }}'">
                </div>

                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Ganti File Logo (SVG, PNG, JPG, WebP):</label>
                    <input type="file" name="logo" accept=".svg,.png,.jpg,.jpeg,.webp"
                           class="block w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                    <p class="text-[10px] text-slate-500 mt-1">Disarankan format SVG atau PNG transparan (maks. 3MB)</p>
                </div>
            </div>

            <!-- Upload Favicon -->
            <div class="p-5 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Favicon Tab Browser
                </label>
                
                <!-- Current Preview -->
                <div class="h-28 rounded-xl bg-[#050811] border border-slate-800 p-3 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset($settings['favicon_path'] ?? 'images/favicon.svg') }}" 
                         alt="Current Favicon" 
                         class="w-12 h-12 object-contain"
                         onerror="this.src='{{ asset('images/favicon.svg') }}'">
                </div>

                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Ganti Favicon (.svg, .ico, .png):</label>
                    <input type="file" name="favicon" accept=".svg,.ico,.png,.jpg"
                           class="block w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                    <p class="text-[10px] text-slate-500 mt-1">Ukuran ideal 64x64 atau SVG (maks. 1MB)</p>
                </div>
            </div>

            <!-- Upload Open Graph (OG) Image -->
            <div class="p-5 rounded-2xl bg-slate-900/90 border border-slate-800 space-y-4">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Open Graph (Share Preview)
                </label>
                
                <!-- Current Preview -->
                <div class="h-28 rounded-xl bg-[#050811] border border-slate-800 p-2 flex items-center justify-center overflow-hidden">
                    <img src="{{ asset($settings['og_image_path'] ?? 'images/og-image.svg') }}" 
                         alt="Current OG Graph" 
                         class="max-h-24 w-full object-cover rounded-lg"
                         onerror="this.src='{{ asset('images/og-image.svg') }}'">
                </div>

                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Ganti Gambar Banner OG Graph:</label>
                    <input type="file" name="og_image" accept=".jpg,.jpeg,.png,.webp,.svg"
                           class="block w-full text-xs text-slate-400 file:mr-3 file:py-2 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                    <p class="text-[10px] text-slate-500 mt-1">Rasio 1200x630 px untuk preview WhatsApp &amp; medsos (maks. 4MB)</p>
                </div>
            </div>

        </div>
    </div>

    <!-- 2. SEO & META DETAILS -->
    <div class="admin-card rounded-2xl p-6 sm:p-8 space-y-5">
        <div class="border-b border-slate-800 pb-3">
            <h3 class="text-base font-bold text-white flex items-center">
                <i class="fa-solid fa-magnifying-glass text-cyan-400 mr-2.5"></i>
                SEO &amp; Meta Title
            </h3>
        </div>

        <div class="grid grid-cols-1 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Judul Website (SEO Title) *
                </label>
                <input type="text" name="site_title" value="{{ old('site_title', $settings['site_title'] ?? '') }}" required
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Deskripsi Meta (SEO &amp; WhatsApp Share Description)
                </label>
                <textarea name="meta_description" rows="2"
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">{{ old('meta_description', $settings['meta_description'] ?? '') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Kata Kunci (Keywords)
                </label>
                <input type="text" name="meta_keywords" value="{{ old('meta_keywords', $settings['meta_keywords'] ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- 3. DEALER & CONTACT DETAILS -->
    <div class="admin-card rounded-2xl p-6 sm:p-8 space-y-5">
        <div class="border-b border-slate-800 pb-3">
            <h3 class="text-base font-bold text-white flex items-center">
                <i class="fa-solid fa-building text-cyan-400 mr-2.5"></i>
                Informasi Dealer &amp; Kontak Resmi
            </h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Nama Dealer Resmi *
                </label>
                <input type="text" name="dealer_name" value="{{ old('dealer_name', $settings['dealer_name'] ?? '') }}" required
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Tagline / Sub-nama Showroom
                </label>
                <input type="text" name="dealer_tagline" value="{{ old('dealer_tagline', $settings['dealer_tagline'] ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Nomor WhatsApp Sales / Dealer *
                </label>
                <input type="text" name="dealer_whatsapp" value="{{ old('dealer_whatsapp', $settings['dealer_whatsapp'] ?? '') }}" required
                       placeholder="Contoh: 6281288997722"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                <p class="text-[10px] text-slate-500 mt-1">Gunakan format tanpa tanda hubung (contoh: 6281288997722)</p>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Nomor Telepon Kantor
                </label>
                <input type="text" name="dealer_phone" value="{{ old('dealer_phone', $settings['dealer_phone'] ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Email Resmi
                </label>
                <input type="email" name="dealer_email" value="{{ old('dealer_email', $settings['dealer_email'] ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Jam Operasional Showroom
                </label>
                <input type="text" name="opening_hours" value="{{ old('opening_hours', $settings['opening_hours'] ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div class="sm:col-span-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Alamat Lengkap Showroom
                </label>
                <input type="text" name="dealer_address" value="{{ old('dealer_address', $settings['dealer_address'] ?? '') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- 4. GOOGLE MAPS EMBED -->
    <div class="admin-card rounded-2xl p-6 sm:p-8 space-y-4">
        <div class="border-b border-slate-800 pb-3">
            <h3 class="text-base font-bold text-white flex items-center">
                <i class="fa-solid fa-map-location-dot text-cyan-400 mr-2.5"></i>
                Integrasi Google Maps
            </h3>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                Google Maps Embed URL (Iframe src)
            </label>
            <input type="text" name="maps_embed_url" value="{{ old('maps_embed_url', $settings['maps_embed_url'] ?? '') }}"
                   placeholder="https://www.google.com/maps/embed?pb=..."
                   class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs font-mono focus:border-cyan-400 focus:outline-none">
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                Link Direct Google Maps (Navigasi Pengunjung)
            </label>
            <input type="url" name="maps_link" value="{{ old('maps_link', $settings['maps_link'] ?? '') }}"
                   placeholder="https://maps.google.com/?q=..."
                   class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
        </div>
    </div>

    <!-- 5. SOCIAL MEDIA LINKS -->
    <div class="admin-card rounded-2xl p-6 sm:p-8 space-y-4">
        <div class="border-b border-slate-800 pb-3">
            <h3 class="text-base font-bold text-white flex items-center">
                <i class="fa-solid fa-share-nodes text-cyan-400 mr-2.5"></i>
                Media Sosial
            </h3>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Instagram URL
                </label>
                <input type="url" name="social_instagram" value="{{ old('social_instagram', $settings['social_instagram'] ?? '') }}"
                       placeholder="https://instagram.com/..."
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    TikTok URL
                </label>
                <input type="url" name="social_tiktok" value="{{ old('social_tiktok', $settings['social_tiktok'] ?? '') }}"
                       placeholder="https://tiktok.com/@..."
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Facebook URL
                </label>
                <input type="url" name="social_facebook" value="{{ old('social_facebook', $settings['social_facebook'] ?? '') }}"
                       placeholder="https://facebook.com/..."
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    YouTube URL
                </label>
                <input type="url" name="social_youtube" value="{{ old('social_youtube', $settings['social_youtube'] ?? '') }}"
                       placeholder="https://youtube.com/@..."
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>
        </div>
    </div>

    <!-- Submit Save Button -->
    <div class="flex justify-end pt-4">
        <button type="submit" 
                class="px-8 py-4 rounded-xl bg-gradient-to-r from-cyan-500 via-blue-600 to-blue-700 hover:from-cyan-400 hover:to-blue-600 text-white font-black text-sm uppercase tracking-wider shadow-lg shadow-cyan-500/25 flex items-center transition-all">
            <i class="fa-solid fa-floppy-disk mr-2"></i>
            Simpan Semua Pengaturan
        </button>
    </div>

</form>

@endsection
