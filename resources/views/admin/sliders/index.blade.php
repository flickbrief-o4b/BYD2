@extends('admin.layouts.admin')

@section('title', 'Hero Sliders')
@section('header_title', 'Hero Sliders Carousel')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-xs text-slate-400">Kelola banner slider utama pada bagian atas website.</p>
    <a href="{{ route('admin.sliders.create') }}" 
       class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider flex items-center shadow-md">
        <i class="fa-solid fa-plus mr-2"></i> Tambah Slider
    </a>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($sliders as $slider)
        <div class="admin-card rounded-2xl overflow-hidden flex flex-col justify-between">
            <div>
                <div class="relative h-44 bg-slate-900 overflow-hidden">
                    <img src="{{ asset($slider->image) }}" class="w-full h-full object-cover" onerror="this.src='{{ asset('images/sliders/slider-seal.svg') }}'">
                    <div class="absolute top-3 left-3">
                        <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $slider->is_active ? 'bg-emerald-500 text-black' : 'bg-slate-700 text-slate-300' }}">
                            {{ $slider->is_active ? 'Aktif' : 'Non-aktif' }}
                        </span>
                    </div>
                    <div class="absolute top-3 right-3 px-2 py-0.5 rounded bg-black/70 text-slate-300 text-[10px] font-mono">
                        Urutan: {{ $slider->order }}
                    </div>
                </div>

                <div class="p-5 space-y-2">
                    @if($slider->badge)
                        <span class="text-[10px] font-bold text-cyan-400 uppercase tracking-wider">{{ $slider->badge }}</span>
                    @endif
                    <h3 class="font-bold text-white text-base line-clamp-2">{{ $slider->title }}</h3>
                    <p class="text-xs text-slate-400 line-clamp-2">{{ $slider->subtitle }}</p>
                </div>
            </div>

            <div class="p-5 pt-0 flex items-center justify-between border-t border-slate-800/80 mt-2">
                <a href="{{ route('admin.sliders.edit', $slider) }}" class="text-xs font-bold text-cyan-400 hover:text-cyan-300">
                    <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                </a>

                <form action="{{ route('admin.sliders.destroy', $slider) }}" method="POST" onsubmit="return confirm('Hapus slider ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-xs font-semibold text-rose-400 hover:text-rose-300">
                        <i class="fa-solid fa-trash mr-1"></i> Hapus
                    </button>
                </form>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12 admin-card rounded-2xl text-slate-500 text-sm">
            Belum ada slider yang dibuat.
        </div>
    @endforelse
</div>

@endsection
