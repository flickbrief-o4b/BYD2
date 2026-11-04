@extends('admin.layouts.admin')

@section('title', 'Dashboard Overview')
@section('header_title', 'Dashboard Kontrol Sales BYD')

@section('content')

<!-- KPI Cards -->
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    
    <!-- Prospek Baru -->
    <div class="admin-card rounded-2xl p-6 relative overflow-hidden">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Prospek / Leads Masuk</p>
                <p class="text-3xl font-black text-cyan-400 mt-2">{{ $totalInquiries }}</p>
                <p class="text-[11px] text-emerald-400 mt-1 flex items-center">
                    <span class="w-2 h-2 rounded-full bg-emerald-400 inline-block mr-1"></span>
                    {{ $newInquiriesCount }} belum dihubungi
                </p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-cyan-500/10 border border-cyan-500/30 text-cyan-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-users"></i>
            </div>
        </div>
    </div>

    <!-- Model & Varian Mobil -->
    <div class="admin-card rounded-2xl p-6 relative overflow-hidden">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Model Mobil Aktif</p>
                <p class="text-3xl font-black text-white mt-2">{{ $totalModels }}</p>
                <p class="text-[11px] text-slate-400 mt-1">Seal, Atto 3, Dolphin, M6, dsb.</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-blue-500/10 border border-blue-500/30 text-blue-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-car"></i>
            </div>
        </div>
    </div>

    <!-- Promo Aktif -->
    <div class="admin-card rounded-2xl p-6 relative overflow-hidden">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Promo &amp; Kampanye</p>
                <p class="text-3xl font-black text-cyan-400 mt-2">{{ $totalPromos }}</p>
                <p class="text-[11px] text-slate-400 mt-1">DP Ringan, Bunga 0%, Wallbox</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-tags"></i>
            </div>
        </div>
    </div>

    <!-- Berita & Artikel -->
    <div class="admin-card rounded-2xl p-6 relative overflow-hidden">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs font-bold uppercase tracking-wider text-slate-400">Artikel &amp; Edukasi EV</p>
                <p class="text-3xl font-black text-white mt-2">{{ $totalArticles }}</p>
                <p class="text-[11px] text-slate-400 mt-1">Blade battery &amp; teknologi</p>
            </div>
            <div class="w-12 h-12 rounded-xl bg-purple-500/10 border border-purple-500/30 text-purple-400 flex items-center justify-center text-xl">
                <i class="fa-solid fa-newspaper"></i>
            </div>
        </div>
    </div>

</div>

<!-- Recent Leads & Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    
    <!-- Table of Incoming Leads -->
    <div class="lg:col-span-8 admin-card rounded-2xl p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-base font-bold text-white">Prospek &amp; Booking Test Drive Terbaru</h3>
                <p class="text-xs text-slate-400 mt-0.5">Daftar pengunjung yang mengajukan formulir di website</p>
            </div>
            <a href="{{ route('admin.inquiries.index') }}" class="text-xs font-bold text-cyan-400 hover:text-cyan-300">
                Lihat Semua &rarr;
            </a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead>
                    <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider">
                        <th class="pb-3 font-semibold">Nama Prospek</th>
                        <th class="pb-3 font-semibold">Model Minat</th>
                        <th class="pb-3 font-semibold">Keperluan</th>
                        <th class="pb-3 font-semibold">Status</th>
                        <th class="pb-3 font-semibold text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60">
                    @forelse($recentInquiries as $inq)
                        @php
                            $phoneClean = preg_replace('/[^0-9]/', '', $inq->phone);
                            if(str_starts_with($phoneClean, '0')) { $phoneClean = '62' . substr($phoneClean, 1); }
                            $followMsg = "Halo {$inq->name}, terima kasih telah menghubungi dealer BYD. Saya ingin mengonfirmasi permintaan {$inq->inquiry_type} untuk unit " . ($inq->carModel?->name ?? 'BYD') . ". Kapan ada waktu luang untuk berdiskusi?";
                        @endphp
                        <tr class="hover:bg-slate-900/50">
                            <td class="py-3.5 font-bold text-white">
                                {{ $inq->name }}
                                <p class="text-[11px] font-normal text-slate-400">{{ $inq->phone }}</p>
                            </td>
                            <td class="py-3.5 text-cyan-300 font-semibold">
                                {{ $inq->carModel?->name ?? 'Umum' }}
                            </td>
                            <td class="py-3.5 text-slate-300 uppercase text-[10px] font-bold">
                                {{ str_replace('_', ' ', $inq->inquiry_type) }}
                            </td>
                            <td class="py-3.5">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase
                                    @if($inq->status === 'baru') bg-cyan-950 text-cyan-400 border border-cyan-500/30
                                    @elseif($inq->status === 'dihubungi') bg-amber-950 text-amber-400 border border-amber-500/30
                                    @elseif($inq->status === 'selesai') bg-emerald-950 text-emerald-400 border border-emerald-500/30
                                    @else bg-slate-800 text-slate-400 @endif">
                                    {{ $inq->status }}
                                </span>
                            </td>
                            <td class="py-3.5 text-right space-x-2">
                                <a href="https://wa.me/{{ $phoneClean }}?text={{ urlencode($followMsg) }}" 
                                   target="_blank"
                                   title="Chat WhatsApp Prospek"
                                   class="px-2.5 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/40 font-bold inline-flex items-center text-[11px]">
                                    <i class="fa-brands fa-whatsapp mr-1 text-xs"></i> WA
                                </a>
                                <a href="{{ route('admin.inquiries.show', $inq) }}" 
                                   class="px-2.5 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 inline-flex items-center text-[11px]">
                                    Detail
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="py-8 text-center text-slate-500">
                                Belum ada prospek atau test drive baru yang masuk.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Right Side: Quick Shortcuts & Sales Profile Snapshot -->
    <div class="lg:col-span-4 space-y-6">
        
        <!-- Active Sales Snapshot -->
        <div class="admin-card rounded-2xl p-6">
            <h3 class="text-sm font-bold text-white mb-4 flex items-center justify-between">
                <span>Profil Sales Terpasang</span>
                <a href="{{ route('admin.sales.edit') }}" class="text-xs text-cyan-400 hover:underline">Edit</a>
            </h3>

            @if($salesProfile)
                <div class="flex items-center space-x-4">
                    <img src="{{ asset($salesProfile->photo ?? 'images/sales/sales-consultant.svg') }}" 
                         class="w-14 h-14 rounded-2xl object-cover border border-cyan-400/30">
                    <div>
                        <p class="font-extrabold text-white text-sm">{{ $salesProfile->name }}</p>
                        <p class="text-xs text-cyan-300">{{ $salesProfile->title }}</p>
                        <p class="text-[11px] text-slate-400">{{ $salesProfile->phone }}</p>
                    </div>
                </div>
            @endif
        </div>

        <!-- Quick Links Card -->
        <div class="admin-card rounded-2xl p-6 space-y-3">
            <h3 class="text-sm font-bold text-white mb-2">Aksi Cepat</h3>

            <a href="{{ route('admin.cars.create') }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-900 hover:bg-slate-800/80 text-xs text-slate-200 border border-slate-800 transition-colors">
                <span class="flex items-center"><i class="fa-solid fa-plus-circle text-cyan-400 mr-2"></i> Tambah Model Mobil Baru</span>
                <i class="fa-solid fa-chevron-right text-slate-600"></i>
            </a>

            <a href="{{ route('admin.promos.create') }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-900 hover:bg-slate-800/80 text-xs text-slate-200 border border-slate-800 transition-colors">
                <span class="flex items-center"><i class="fa-solid fa-tags text-emerald-400 mr-2"></i> Buat Promo / Diskon Baru</span>
                <i class="fa-solid fa-chevron-right text-slate-600"></i>
            </a>

            <a href="{{ route('admin.sliders.create') }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-900 hover:bg-slate-800/80 text-xs text-slate-200 border border-slate-800 transition-colors">
                <span class="flex items-center"><i class="fa-solid fa-image text-blue-400 mr-2"></i> Tambah Slider Banner</span>
                <i class="fa-solid fa-chevron-right text-slate-600"></i>
            </a>

            <a href="{{ route('admin.settings.index') }}" class="flex items-center justify-between p-3 rounded-xl bg-slate-900 hover:bg-slate-800/80 text-xs text-slate-200 border border-slate-800 transition-colors">
                <span class="flex items-center"><i class="fa-solid fa-palette text-amber-400 mr-2"></i> Ganti Logo, Favicon &amp; OG Graph</span>
                <i class="fa-solid fa-chevron-right text-slate-600"></i>
            </a>
        </div>

    </div>

</div>

@endsection
