@extends('admin.layouts.admin')

@section('title', 'Tambah Hero Slider')
@section('header_title', 'Tambah Slider Banner')

@section('content')

<div class="max-w-3xl admin-card rounded-2xl p-6 sm:p-8">
    <form action="{{ route('admin.sliders.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Judul Utama Slider (Headline) *
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: THE POWER OF OCEAN AESTHETICS"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Badge Teks (Opsional)
                </label>
                <input type="text" name="badge" value="{{ old('badge') }}" placeholder="Contoh: FLAGSHIP PERFORMANCE SEDAN"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Sub-Judul / Deskripsi Singkat
                </label>
                <textarea name="subtitle" rows="3" placeholder="Deskripsi daya tarik..."
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">{{ old('subtitle') }}</textarea>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Teks Tombol CTA
                    </label>
                    <input type="text" name="button_text" value="{{ old('button_text', 'Konsultasi Sekarang') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Link Tujuan Tombol
                    </label>
                    <input type="text" name="button_link" value="{{ old('button_link', '#cars') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>
            </div>

            <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Gambar Slider Banner
                </label>
                <div>
                    <label class="block text-[11px] text-slate-400 mb-1">Upload Berkas Gambar (SVG, PNG, JPG, WebP):</label>
                    <input type="file" name="image_file" accept=".png,.jpg,.jpeg,.webp,.svg"
                           class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                </div>
                <div class="pt-1">
                    <label class="block text-[11px] text-slate-400 mb-1">Atau gunakan URL / path gambar:</label>
                    <input type="text" name="image_url" value="{{ old('image_url') }}" placeholder="images/sliders/slider-seal.svg"
                           class="w-full px-3 py-2 rounded-lg bg-slate-950 border border-slate-800 text-white text-xs">
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Urutan Tampilan
                    </label>
                    <input type="number" name="order" value="{{ old('order', 1) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div class="pt-5">
                    <label class="inline-flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded bg-slate-900 border-slate-700 text-cyan-500">
                        <span class="text-xs font-semibold text-slate-300">Aktifkan Slider Ini</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center pt-4 border-t border-slate-800">
            <a href="{{ route('admin.sliders.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Batal</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider">
                Simpan Slider
            </button>
        </div>
    </form>
</div>

@endsection
