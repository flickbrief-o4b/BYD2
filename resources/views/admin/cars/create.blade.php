@extends('admin.layouts.admin')

@section('title', 'Tambah Model Mobil')
@section('header_title', 'Tambah Model Mobil Listrik BYD')

@section('content')

<div class="max-w-4xl admin-card rounded-2xl p-6 sm:p-8">
    <form action="{{ route('admin.cars.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf

        <div class="border-b border-slate-800 pb-4">
            <h3 class="text-base font-bold text-white">Informasi Pokok Mobil</h3>
            <p class="text-xs text-slate-400 mt-0.5">Setelah model disimpan, Anda dapat langsung menambahkan rincian tipe / varian (trims) di bawahnya.</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Nama Model *
                </label>
                <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: BYD Seal"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Kategori Bodi *
                </label>
                <select name="category" required class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                    <option value="Sedan">Sedan</option>
                    <option value="SUV">SUV</option>
                    <option value="MPV">MPV</option>
                    <option value="Hatchback">Hatchback</option>
                </select>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Tagline Promosi
                </label>
                <input type="text" name="tagline" value="{{ old('tagline') }}" placeholder="Contoh: Luxury High-Performance EV Sedan"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Harga Mulai (OTR Rp) *
                </label>
                <input type="number" name="starting_price" value="{{ old('starting_price', 400000000) }}" required step="1000000"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-cyan-400 font-bold text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Jarak Tempuh (Range)
                </label>
                <input type="text" name="range_km" value="{{ old('range_km') }}" placeholder="Contoh: 570 - 650 km"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Akselerasi 0-100 km/h
                </label>
                <input type="text" name="acceleration" value="{{ old('acceleration') }}" placeholder="Contoh: 3.8 detik"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Kapasitas Baterai
                </label>
                <input type="text" name="battery_capacity" value="{{ old('battery_capacity') }}" placeholder="Contoh: 82.56 kWh"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Tenaga / Torsi Motor
                </label>
                <input type="text" name="max_power" value="{{ old('max_power') }}" placeholder="Contoh: 530 PS / 670 Nm"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Kecepatan Fast Charging
                </label>
                <input type="text" name="charging_time" value="{{ old('charging_time') }}" placeholder="Contoh: DC 150kW (30-80% dlm 26 menit)"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Tipe Baterai
                </label>
                <input type="text" name="battery_type" value="{{ old('battery_type', 'BYD Blade Battery (LFP)') }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                Deskripsi Lengkap Mobil
            </label>
            <textarea name="description" rows="3" placeholder="Ulasan kenyamanan kabin, performa motor listrik, teknologi suspensi..."
                      class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">{{ old('description') }}</textarea>
        </div>

        <div>
            <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                Daftar Fitur Unggulan (Satu fitur per baris)
            </label>
            <textarea name="features" rows="4" placeholder="Cell-to-Body (CTB) Technology&#10;Rotatable 15.6 Inch Touchscreen&#10;Panoramic Sunroof&#10;Dynaudio Premium Sound"
                      class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs font-mono focus:border-cyan-400 focus:outline-none">{{ old('features') }}</textarea>
        </div>

        <!-- Image & Brochure Files -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Foto / Grafik Mobil
                </label>
                <input type="file" name="image_file" accept=".png,.jpg,.jpeg,.webp,.svg"
                       class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                <input type="text" name="image_url" value="{{ old('image_url') }}" placeholder="Atau path: images/cars/byd-seal.svg"
                       class="w-full px-3 py-2 rounded-lg bg-slate-950 border border-slate-800 text-white text-xs">
            </div>

            <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-2">
                <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                    Brosur Spesifikasi (PDF)
                </label>
                <input type="file" name="brochure_file" accept=".pdf"
                       class="block w-full text-xs text-slate-400 file:mr-2 file:py-1.5 file:px-3 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-500/10 file:text-blue-400 hover:file:bg-blue-500/20 cursor-pointer">
                <p class="text-[10px] text-slate-500">Maksimal 10MB PDF</p>
            </div>
        </div>

        <div class="grid grid-cols-3 gap-4 items-center">
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Urutan Tampil
                </label>
                <input type="number" name="order" value="{{ old('order', 1) }}"
                       class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
            </div>

            <div class="pt-5">
                <label class="inline-flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_featured" value="1" checked class="rounded bg-slate-900 border-slate-700 text-cyan-500">
                    <span class="text-xs font-semibold text-slate-300">Favorit</span>
                </label>
            </div>

            <div class="pt-5">
                <label class="inline-flex items-center space-x-2 cursor-pointer">
                    <input type="checkbox" name="is_active" value="1" checked class="rounded bg-slate-900 border-slate-700 text-cyan-500">
                    <span class="text-xs font-semibold text-slate-300">Aktif</span>
                </label>
            </div>
        </div>

        <div class="flex justify-between items-center pt-4 border-t border-slate-800">
            <a href="{{ route('admin.cars.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Batal</a>
            <button type="submit" class="px-8 py-3.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider">
                Simpan &amp; Lanjut Tambah Tipe
            </button>
        </div>
    </form>
</div>

@endsection
