@extends('admin.layouts.admin')

@section('title', 'Edit ' . $car->name)
@section('header_title', 'Edit Model &amp; Varian: ' . $car->name)

@section('content')

<div class="space-y-10">

    <!-- 1. MODEL INFORMATION FORM -->
    <div class="max-w-4xl admin-card rounded-2xl p-6 sm:p-8">
        <form action="{{ route('admin.cars.update', $car) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            <div class="border-b border-slate-800 pb-4 flex items-center justify-between">
                <div>
                    <h3 class="text-base font-bold text-white">Spesifikasi Model Induk ({{ $car->name }})</h3>
                    <p class="text-xs text-slate-400 mt-0.5">Ubah data utama model kendaraan di bawah.</p>
                </div>
                <a href="{{ route('model.detail', $car->slug) }}" target="_blank" class="text-xs text-cyan-400 hover:underline">
                    Lihat di Frontend &rarr;
                </a>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Nama Model *
                    </label>
                    <input type="text" name="name" value="{{ old('name', $car->name) }}" required
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Kategori Bodi *
                    </label>
                    <select name="category" required class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                        <option value="Sedan" {{ $car->category === 'Sedan' ? 'selected' : '' }}>Sedan</option>
                        <option value="SUV" {{ $car->category === 'SUV' ? 'selected' : '' }}>SUV</option>
                        <option value="MPV" {{ $car->category === 'MPV' ? 'selected' : '' }}>MPV</option>
                        <option value="Hatchback" {{ $car->category === 'Hatchback' ? 'selected' : '' }}>Hatchback</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Tagline Promosi
                    </label>
                    <input type="text" name="tagline" value="{{ old('tagline', $car->tagline) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Harga Mulai (OTR Rp) *
                    </label>
                    <input type="number" name="starting_price" value="{{ old('starting_price', $car->starting_price) }}" required step="1000000"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-cyan-400 font-bold text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Jarak Tempuh (Range)
                    </label>
                    <input type="text" name="range_km" value="{{ old('range_km', $car->range_km) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Akselerasi 0-100 km/h
                    </label>
                    <input type="text" name="acceleration" value="{{ old('acceleration', $car->acceleration) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Kapasitas Baterai
                    </label>
                    <input type="text" name="battery_capacity" value="{{ old('battery_capacity', $car->battery_capacity) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Tenaga / Torsi Motor
                    </label>
                    <input type="text" name="max_power" value="{{ old('max_power', $car->max_power) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Kecepatan Fast Charging
                    </label>
                    <input type="text" name="charging_time" value="{{ old('charging_time', $car->charging_time) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Tipe Baterai
                    </label>
                    <input type="text" name="battery_type" value="{{ old('battery_type', $car->battery_type) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Deskripsi Lengkap Mobil
                </label>
                <textarea name="description" rows="3"
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">{{ old('description', $car->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                    Daftar Fitur Unggulan (Satu fitur per baris)
                </label>
                <textarea name="features" rows="4"
                          class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-xs font-mono focus:border-cyan-400 focus:outline-none">{{ old('features', is_array($car->features) ? implode("\n", $car->features) : '') }}</textarea>
            </div>

            <!-- Image & Brochure Preview & Upload -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                        Foto / Grafik Mobil
                    </label>
                    <div class="h-24 bg-black/60 rounded-lg p-2 flex items-center justify-center">
                        <img src="{{ asset($car->image) }}" class="max-h-20 w-auto object-contain">
                    </div>
                    <div>
                        <label class="block text-[11px] text-slate-400 mb-1">Ganti Foto Mobil:</label>
                        <input type="file" name="image_file" accept=".png,.jpg,.jpeg,.webp,.svg"
                               class="block w-full text-xs text-slate-400 file:mr-2 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-cyan-500/10 file:text-cyan-400 hover:file:bg-cyan-500/20 cursor-pointer">
                    </div>
                    <div>
                        <input type="text" name="image_url" value="{{ old('image_url', $car->image) }}" placeholder="Atau ganti path gambar..."
                               class="w-full px-3 py-1.5 rounded-lg bg-slate-950 border border-slate-800 text-white text-xs">
                    </div>
                </div>

                <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-3">
                    <label class="block text-xs font-bold uppercase tracking-wider text-cyan-300">
                        Brosur Spesifikasi (PDF)
                    </label>
                    <div class="p-3 bg-black/60 rounded-lg text-xs text-slate-400">
                        @if($car->brochure_file)
                            <p class="text-emerald-400 font-bold mb-1"><i class="fa-solid fa-file-pdf mr-1"></i> File brosur aktif:</p>
                            <a href="{{ asset($car->brochure_file) }}" target="_blank" class="text-cyan-400 hover:underline break-all">{{ $car->brochure_file }}</a>
                        @else
                            <p class="text-slate-500">Belum ada file brosur yang diunggah.</p>
                        @endif
                    </div>
                    <div>
                        <label class="block text-[11px] text-slate-400 mb-1">Unggah PDF Brosur Baru:</label>
                        <input type="file" name="brochure_file" accept=".pdf"
                               class="block w-full text-xs text-slate-400 file:mr-2 file:py-1 file:px-2.5 file:rounded-xl file:border-0 file:text-xs file:font-semibold file:bg-blue-500/10 file:text-blue-400 hover:file:bg-blue-500/20 cursor-pointer">
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-3 gap-4 items-center">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Urutan Tampil
                    </label>
                    <input type="number" name="order" value="{{ old('order', $car->order) }}"
                           class="w-full px-4 py-3 rounded-xl bg-slate-900 border border-slate-700 text-white text-sm focus:border-cyan-400 focus:outline-none">
                </div>

                <div class="pt-5">
                    <label class="inline-flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_featured" value="1" {{ $car->is_featured ? 'checked' : '' }} class="rounded bg-slate-900 border-slate-700 text-cyan-500">
                        <span class="text-xs font-semibold text-slate-300">Favorit</span>
                    </label>
                </div>

                <div class="pt-5">
                    <label class="inline-flex items-center space-x-2 cursor-pointer">
                        <input type="checkbox" name="is_active" value="1" {{ $car->is_active ? 'checked' : '' }} class="rounded bg-slate-900 border-slate-700 text-cyan-500">
                        <span class="text-xs font-semibold text-slate-300">Aktif</span>
                    </label>
                </div>
            </div>

            <div class="flex justify-between items-center pt-4 border-t border-slate-800">
                <a href="{{ route('admin.cars.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Kembali ke Daftar Model</a>
                <button type="submit" class="px-6 py-3 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider">
                    Simpan Perubahan Model
                </button>
            </div>
        </form>
    </div>

    <!-- 2. SUB-TYPES / TRIMS MANAGEMENT SECTION -->
    <div class="max-w-4xl admin-card rounded-2xl p-6 sm:p-8 space-y-6">
        <div class="border-b border-slate-800 pb-4 flex items-center justify-between">
            <div>
                <h3 class="text-base font-bold text-white flex items-center">
                    <i class="fa-solid fa-list-check text-cyan-400 mr-2"></i>
                    Daftar Tipe / Varian (Trims) untuk {{ $car->name }}
                </h3>
                <p class="text-xs text-slate-400 mt-0.5">Setiap tipe memiliki spesifikasi drivetrain, range, dan harga OTR masing-masing.</p>
            </div>
            <span class="px-2.5 py-1 rounded-full bg-cyan-950 text-cyan-300 font-bold text-xs border border-cyan-500/30">
                {{ $car->types->count() }} Tipe Terdaftar
            </span>
        </div>

        <!-- Existing Types Table -->
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider">
                        <th class="pb-3 font-semibold">Nama Varian / Trim</th>
                        <th class="pb-3 font-semibold">Harga OTR</th>
                        <th class="pb-3 font-semibold">Drivetrain</th>
                        <th class="pb-3 font-semibold">Jarak Tempuh</th>
                        <th class="pb-3 font-semibold">Kapasitas</th>
                        <th class="pb-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($car->types as $trim)
                        <tr class="hover:bg-slate-900/40">
                            <td class="py-3 font-bold text-white">
                                {{ $trim->name }}
                                @if($trim->highlights)
                                    <p class="text-[11px] font-normal text-slate-400 mt-0.5">{{ $trim->highlights }}</p>
                                @endif
                            </td>
                            <td class="py-3 font-bold text-cyan-400">
                                {{ $trim->formatted_price }}
                            </td>
                            <td class="py-3 text-slate-300">
                                <span class="px-2 py-0.5 rounded bg-slate-900 border border-slate-700">{{ $trim->drivetrain }}</span>
                            </td>
                            <td class="py-3 text-slate-300">
                                {{ $trim->range_km ?? '-' }}
                            </td>
                            <td class="py-3 text-slate-400">
                                {{ $trim->seats ?? '5-Seater' }}
                            </td>
                            <td class="py-3 text-right">
                                <form action="{{ route('admin.cars.types.destroy', [$car, $trim]) }}" method="POST" class="inline" onsubmit="return confirm('Hapus varian tipe ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-1.5 rounded-lg bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 text-xs">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="py-6 text-center text-slate-500">
                                Belum ada rincian tipe untuk model ini. Silakan tambahkan di formulir bawah.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Add New Type Form -->
        <div class="pt-6 border-t border-slate-800">
            <h4 class="text-sm font-bold text-cyan-400 mb-4 flex items-center">
                <i class="fa-solid fa-plus-circle mr-2"></i> Tambah Varian / Tipe Baru
            </h4>

            <form action="{{ route('admin.cars.types.store', $car) }}" method="POST" class="space-y-4 bg-slate-900/60 p-5 rounded-2xl border border-slate-800">
                @csrf

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Nama Tipe *
                        </label>
                        <input type="text" name="type_name" required placeholder="Contoh: Performance AWD"
                               class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Harga OTR (Rp) *
                        </label>
                        <input type="number" name="type_price" required step="1000000" placeholder="719000000"
                               class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-cyan-400 font-bold text-xs focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Drivetrain
                        </label>
                        <select name="type_drivetrain" class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:border-cyan-400 focus:outline-none">
                            <option value="FWD">FWD (Front-Wheel Drive)</option>
                            <option value="RWD">RWD (Rear-Wheel Drive)</option>
                            <option value="Dual Motor AWD">Dual Motor AWD</option>
                        </select>
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Jarak Tempuh (Range)
                        </label>
                        <input type="text" name="type_range_km" placeholder="Contoh: 580 km (NEDC)"
                               class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Baterai
                        </label>
                        <input type="text" name="type_battery_capacity" placeholder="Contoh: 82.56 kWh"
                               class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                            Kapasitas Kursi
                        </label>
                        <input type="text" name="type_seats" placeholder="Contoh: 5-Seater / 7-Seater"
                               class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:border-cyan-400 focus:outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-300 mb-1">
                        Keunggulan / Catatan Trim
                    </label>
                    <input type="text" name="type_highlights" placeholder="Contoh: Akselerasi 3.8s, panoramic roof, audio Dynaudio 12 speaker..."
                           class="w-full px-3.5 py-2.5 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs focus:border-cyan-400 focus:outline-none">
                </div>

                <div class="flex justify-end pt-2">
                    <button type="submit" class="px-5 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider">
                        + Tambahkan Varian Ini
                    </button>
                </div>
            </form>
        </div>
    </div>

</div>

@endsection
