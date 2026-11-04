@extends('admin.layouts.admin')

@section('title', 'Detail Prospek #' . $inquiry->id)
@section('header_title', 'Detail Prospek: ' . $inquiry->name)

@section('content')

@php
    $phoneClean = preg_replace('/[^0-9]/', '', $inquiry->phone);
    if(str_starts_with($phoneClean, '0')) { $phoneClean = '62' . substr($phoneClean, 1); }
    $waMsg = "Halo {$inquiry->name}, saya Sales Consultant resmi BYD Indonesia. Terkait formulir {$inquiry->inquiry_type} unit " . ($inquiry->carModel?->name ?? 'BYD') . " yang Anda ajukan di website, apakah berkenan jika saya informasikan rincian penawaran dan jadwalnya?";
@endphp

<div class="max-w-3xl admin-card rounded-2xl p-6 sm:p-8 space-y-6">
    <div class="border-b border-slate-800 pb-4 flex items-center justify-between">
        <div>
            <span class="text-xs font-bold uppercase tracking-wider text-cyan-400">ID PROSPEK #{{ $inquiry->id }}</span>
            <h2 class="text-xl font-black text-white mt-1">{{ $inquiry->name }}</h2>
        </div>

        <a href="https://wa.me/{{ $phoneClean }}?text={{ urlencode($waMsg) }}" 
           target="_blank"
           class="px-4 py-2.5 rounded-xl bg-gradient-to-r from-emerald-600 to-green-500 hover:from-emerald-500 hover:to-green-400 text-white font-bold text-xs uppercase tracking-wider flex items-center shadow-lg shadow-green-500/20">
            <i class="fa-brands fa-whatsapp text-sm mr-2"></i> Hubungi via WhatsApp
        </a>
    </div>

    <!-- Status Switcher -->
    <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <p class="text-xs text-slate-400">Status Prospek Saat Ini:</p>
            <p class="text-sm font-black uppercase text-cyan-400 mt-0.5">{{ $inquiry->status }}</p>
        </div>

        <form action="{{ route('admin.inquiries.status', $inquiry) }}" method="POST" class="flex items-center space-x-2">
            @csrf
            @method('PATCH')
            <select name="status" class="px-3 py-2 rounded-xl bg-slate-950 border border-slate-700 text-white text-xs font-semibold focus:border-cyan-400 focus:outline-none">
                <option value="baru" {{ $inquiry->status === 'baru' ? 'selected' : '' }}>Baru</option>
                <option value="dihubungi" {{ $inquiry->status === 'dihubungi' ? 'selected' : '' }}>Dihubungi</option>
                <option value="dijadwalkan" {{ $inquiry->status === 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                <option value="selesai" {{ $inquiry->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                <option value="batal" {{ $inquiry->status === 'batal' ? 'selected' : '' }}>Batal</option>
            </select>
            <button type="submit" class="px-4 py-2 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider">
                Update
            </button>
        </form>
    </div>

    <!-- Detailed Customer Information -->
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 text-sm">
        <div class="space-y-1">
            <span class="text-xs text-slate-400">Nomor Telepon / WhatsApp:</span>
            <p class="font-bold text-white text-base">
                <a href="tel:{{ $inquiry->phone }}" class="hover:text-cyan-400">{{ $inquiry->phone }}</a>
            </p>
        </div>

        <div class="space-y-1">
            <span class="text-xs text-slate-400">Model Mobil yang Diminati:</span>
            <p class="font-bold text-cyan-400 text-base">
                {{ $inquiry->carModel?->name ?? 'Semua Model / Konsultasi Umum' }}
            </p>
        </div>

        <div class="space-y-1">
            <span class="text-xs text-slate-400">Jenis Permintaan:</span>
            <p class="font-bold text-white uppercase text-xs">
                {{ str_replace('_', ' ', $inquiry->inquiry_type) }}
            </p>
        </div>

        <div class="space-y-1">
            <span class="text-xs text-slate-400">Kota / Domisili:</span>
            <p class="font-bold text-white">{{ $inquiry->city ?? '-' }}</p>
        </div>

        @if($inquiry->preferred_date)
            <div class="space-y-1">
                <span class="text-xs text-slate-400">Jadwal Test Drive:</span>
                <p class="font-bold text-white">
                    {{ $inquiry->preferred_date->format('l, d F Y') }} ({{ $inquiry->preferred_time ?? 'Waktu Bebas' }})
                </p>
            </div>
        @endif

        <div class="space-y-1">
            <span class="text-xs text-slate-400">Waktu Masuk Sistem:</span>
            <p class="font-bold text-slate-300">{{ $inquiry->created_at->format('d F Y, H:i:s') }} WIB</p>
        </div>
    </div>

    @if($inquiry->notes)
        <div class="p-4 rounded-xl bg-slate-900 border border-slate-800 space-y-1">
            <span class="text-xs font-bold text-slate-400">Catatan dari Pelanggan:</span>
            <p class="text-sm text-slate-200 leading-relaxed whitespace-pre-line">{{ $inquiry->notes }}</p>
        </div>
    @endif

    <div class="flex justify-between items-center pt-4 border-t border-slate-800">
        <a href="{{ route('admin.inquiries.index') }}" class="text-xs text-slate-400 hover:text-white">&larr; Kembali ke Inbox</a>
        
        <form action="{{ route('admin.inquiries.destroy', $inquiry) }}" method="POST" onsubmit="return confirm('Hapus permanen prospek ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="px-4 py-2 rounded-xl bg-rose-500/10 hover:bg-rose-500/20 text-rose-400 font-bold text-xs">
                Hapus Data Prospek
            </button>
        </form>
    </div>
</div>

@endsection
