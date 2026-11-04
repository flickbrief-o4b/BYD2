@extends('admin.layouts.admin')

@section('title', 'Prospek & Test Drive')
@section('header_title', 'Inbox Prospek &amp; Booking Test Drive')

@section('content')

<!-- Filter Tabs -->
<div class="flex flex-wrap items-center justify-between gap-4 mb-6">
    <div class="flex items-center space-x-2 text-xs">
        <a href="{{ route('admin.inquiries.index') }}" 
           class="px-3.5 py-2 rounded-xl {{ !request('status') ? 'bg-cyan-500 text-black font-extrabold' : 'bg-slate-900 text-slate-300 border border-slate-800' }}">
            Semua ({{ \App\Models\Inquiry::count() }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'baru']) }}" 
           class="px-3.5 py-2 rounded-xl {{ request('status') === 'baru' ? 'bg-cyan-500 text-black font-extrabold' : 'bg-slate-900 text-slate-300 border border-slate-800' }}">
            Baru ({{ \App\Models\Inquiry::where('status', 'baru')->count() }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'dihubungi']) }}" 
           class="px-3.5 py-2 rounded-xl {{ request('status') === 'dihubungi' ? 'bg-cyan-500 text-black font-extrabold' : 'bg-slate-900 text-slate-300 border border-slate-800' }}">
            Dihubungi ({{ \App\Models\Inquiry::where('status', 'dihubungi')->count() }})
        </a>
        <a href="{{ route('admin.inquiries.index', ['status' => 'selesai']) }}" 
           class="px-3.5 py-2 rounded-xl {{ request('status') === 'selesai' ? 'bg-cyan-500 text-black font-extrabold' : 'bg-slate-900 text-slate-300 border border-slate-800' }}">
            Selesai ({{ \App\Models\Inquiry::where('status', 'selesai')->count() }})
        </a>
    </div>
</div>

<div class="admin-card rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider bg-slate-900/50">
                    <th class="py-3.5 px-6 font-semibold">Nama &amp; Kontak</th>
                    <th class="py-3.5 px-6 font-semibold">Model Minat</th>
                    <th class="py-3.5 px-6 font-semibold">Keperluan</th>
                    <th class="py-3.5 px-6 font-semibold">Jadwal / Kota</th>
                    <th class="py-3.5 px-6 font-semibold">Status</th>
                    <th class="py-3.5 px-6 font-semibold">Tanggal Masuk</th>
                    <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60">
                @forelse($inquiries as $inq)
                    @php
                        $phoneClean = preg_replace('/[^0-9]/', '', $inq->phone);
                        if(str_starts_with($phoneClean, '0')) { $phoneClean = '62' . substr($phoneClean, 1); }
                        $waMsg = "Halo {$inq->name}, terima kasih telah mengisi formulir di website BYD Sales. Saya ingin mengonfirmasi permintaan {$inq->inquiry_type} untuk unit " . ($inq->carModel?->name ?? 'BYD') . ". Apakah ada waktu luang untuk berdiskusi?";
                    @endphp
                    <tr class="hover:bg-slate-900/40">
                        <td class="py-4 px-6">
                            <p class="font-bold text-white text-sm">{{ $inq->name }}</p>
                            <p class="text-[11px] text-slate-400">{{ $inq->phone }}</p>
                        </td>
                        <td class="py-4 px-6 font-semibold text-cyan-300">
                            {{ $inq->carModel?->name ?? 'Umum / Belum Pilih' }}
                        </td>
                        <td class="py-4 px-6 uppercase text-[10px] font-bold text-slate-300">
                            {{ str_replace('_', ' ', $inq->inquiry_type) }}
                        </td>
                        <td class="py-4 px-6 text-slate-300">
                            @if($inq->preferred_date)
                                <p class="font-semibold">{{ $inq->preferred_date->format('d M Y') }}</p>
                                <p class="text-[11px] text-slate-400">{{ $inq->preferred_time ?? '' }}</p>
                            @else
                                <p>{{ $inq->city ?? '-' }}</p>
                            @endif
                        </td>
                        <td class="py-4 px-6">
                            <!-- Quick Status Switcher Form -->
                            <form action="{{ route('admin.inquiries.status', $inq) }}" method="POST" class="inline">
                                @csrf
                                @method('PATCH')
                                <select name="status" onchange="this.form.submit()" 
                                        class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase cursor-pointer
                                            @if($inq->status === 'baru') bg-cyan-950 text-cyan-400 border border-cyan-500/40
                                            @elseif($inq->status === 'dihubungi') bg-amber-950 text-amber-400 border border-amber-500/40
                                            @elseif($inq->status === 'dijadwalkan') bg-blue-950 text-blue-400 border border-blue-500/40
                                            @elseif($inq->status === 'selesai') bg-emerald-950 text-emerald-400 border border-emerald-500/40
                                            @else bg-rose-950 text-rose-400 border border-rose-500/40 @endif">
                                    <option value="baru" {{ $inq->status === 'baru' ? 'selected' : '' }}>Baru</option>
                                    <option value="dihubungi" {{ $inq->status === 'dihubungi' ? 'selected' : '' }}>Dihubungi</option>
                                    <option value="dijadwalkan" {{ $inq->status === 'dijadwalkan' ? 'selected' : '' }}>Dijadwalkan</option>
                                    <option value="selesai" {{ $inq->status === 'selesai' ? 'selected' : '' }}>Selesai</option>
                                    <option value="batal" {{ $inq->status === 'batal' ? 'selected' : '' }}>Batal</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-4 px-6 text-slate-400">
                            {{ $inq->created_at->format('d M Y, H:i') }}
                        </td>
                        <td class="py-4 px-6 text-right space-x-2">
                            <a href="https://wa.me/{{ $phoneClean }}?text={{ urlencode($waMsg) }}" 
                               target="_blank"
                               class="px-2.5 py-1.5 rounded-lg bg-emerald-600/20 hover:bg-emerald-600/30 text-emerald-400 border border-emerald-500/40 font-bold inline-flex items-center text-[11px]">
                                <i class="fa-brands fa-whatsapp mr-1"></i> WA
                            </a>
                            <a href="{{ route('admin.inquiries.show', $inq) }}" 
                               class="px-2.5 py-1.5 rounded-lg bg-slate-800 hover:bg-slate-700 text-slate-200 inline-flex items-center text-[11px]">
                                Detail
                            </a>
                            <form action="{{ route('admin.inquiries.destroy', $inq) }}" method="POST" class="inline" onsubmit="return confirm('Hapus data prospek ini?')">
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
                        <td colspan="7" class="py-8 text-center text-slate-500">
                            Tidak ada data prospek yang sesuai filter.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($inquiries->hasPages())
        <div class="p-4 border-t border-slate-800">
            {{ $inquiries->links() }}
        </div>
    @endif
</div>

@endsection
