@extends('admin.layouts.admin')

@section('title', 'Tambah Promo')
@section('header_title', 'Tambah Program Promo')

@section('content')

<div class="max-w-3xl admin-card rounded-2xl p-6 sm:p-8">
    <form action="{{ route('admin.promos.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="space-y-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Judul Promo *
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required placeholder="Contoh: Paket DP 10% & Bunga 0% BYD Seal"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Badge / Label Promo
                    </label>
                    <input type="text" name="badge" value="{{ old('badge') }}" placeholder="Contoh: SPECIAL FINANCING / HOT DEAL"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Berlaku Hingga Tanggal
                    </label>
                    <input type="date" name="valid_until" value="{{ old('valid_until') }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Ringkasan Promo
                </label>
                <textarea name="summary" rows="3" placeholder="Deskripsi daya tarik promo..."
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">{{ old('summary') }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Syarat &amp; Ketentuan
                </label>
                <textarea name="terms" rows="4" placeholder="1. Berlaku untuk SPK bulan ini...&#10;2. Melalui leasing rekanan..."
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs font-mono focus:border-cyan-400 focus:outline-none">{{ old('terms') }}</textarea>
            </div>

            <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-3">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Banner Promo
                </label>
                <input type="file" name="image_file" accept=".png,.jpg,.jpeg,.webp,.svg"
                       class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                <input type="text" name="image_url" value="{{ old('image_url') }}" placeholder="Atau path: images/promos/promo-bunga-nol.svg"
                       class="w-full px-3 py-2 rounded-lg bg-slate-950 border border-slate-800 text-white text-xs">
            </div>

            <div class="grid grid-cols-2 gap-4 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Urutan
                    </label>
                    <input type="number" name="order" value="{{ old('order', 1) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div class="pt-5">
                    <label class="inline-flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" checked class="rounded bg-slate-900 border-slate-700 text-cyan-500">
                        <span class="text-xs font-semibold text-slate-300">Aktifkan Promo Ini</span>
                    </label>
                </div>
            </div>
        </div>

        <div class="flex justify-between items-center pt-4 border-t border-slate-800">
            <a href="{{ route('admin.promos.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Batal</a>
            <button type="submit" class="px-6 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider">
                Simpan Promo
            </button>
        </div>
    </form>
</div>

@endsection
