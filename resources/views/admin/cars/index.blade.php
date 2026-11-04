@extends('admin.layouts.admin')

@section('title', 'Model & Varian Mobil')
@section('header_title', 'Kelola Model Mobil &amp; Tipe Varian')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-xs text-slate-400">Daftar lini mobil listrik BYD beserta tipe/trim yang tampil di showroom frontend.</p>
    <a href="{{ route('admin.cars.create') }}" 
       class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider flex items-center shadow-md">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Model Mobil
    </a>
</div>

<div class="admin-card rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider bg-slate-900/50">
                    <th class="py-3.5 px-6 font-semibold">Mobil</th>
                    <th class="py-3.5 px-6 font-semibold">Kategori</th>
                    <th class="py-3.5 px-6 font-semibold">Harga Mulai (OTR)</th>
                    <th class="py-3.5 px-6 font-semibold">Spesifikasi Kunci</th>
                    <th class="py-3.5 px-6 font-semibold">Jumlah Tipe</th>
                    <th class="py-3.5 px-6 font-semibold">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60">
                @forelse($cars as $car)
                    <tr class="hover:bg-slate-900/40">
                        <td class="py-4 px-6 flex items-center space-x-3">
                            <img src="{{ asset($car->image) }}" class="w-16 h-10 object-contain rounded bg-slate-950 p-1 border border-slate-800" onerror="this.src='{{ asset('images/cars/byd-seal.svg') }}'">
                            <div>
                                <p class="font-extrabold text-white text-sm">{{ $car->name }}</p>
                                <p class="text-[11px] text-slate-400">{{ $car->tagline }}</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-full bg-cyan-950 text-cyan-300 font-semibold border border-cyan-500/30 text-[10px] uppercase">
                                {{ $car->category }}
                            </span>
                        </td>
                        <td class="py-4 px-6 font-bold text-cyan-400">
                            {{ $car->formatted_price }}
                        </td>
                        <td class="py-4 px-6 text-slate-300">
                            <p class="font-semibold">{{ $car->range_km }}</p>
                            <p class="text-[11px] text-slate-400">0-100: {{ $car->acceleration }}</p>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2 py-0.5 rounded-full bg-slate-800 text-slate-200 font-bold text-[11px]">
                                {{ $car->types_count }} Tipe Varian
                            </span>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $car->is_active ? 'bg-emerald-950 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                {{ $car->is_active ? 'Aktif' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="{{ route('admin.cars.edit', $car) }}" class="text-xs font-bold text-cyan-400 hover:text-cyan-300">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Kelola &amp; Tipe
                            </a>
                            <form action="{{ route('admin.cars.destroy', $car) }}" method="POST" class="inline" onsubmit="return confirm('Hapus model ini beserta seluruh tipenya?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-xs font-semibold text-rose-400 hover:text-rose-300">
                                    <i class="fa-solid fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="py-8 text-center text-slate-500">
                            Belum ada model mobil yang terdaftar.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
