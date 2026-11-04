@extends('admin.layouts.admin')

@section('title', 'Berita & Artikel')
@section('header_title', 'Kelola Berita &amp; Artikel EV')

@section('content')

<div class="flex items-center justify-between mb-6">
    <p class="text-xs text-slate-400">Daftar artikel teknologi, ulasan baterai, dan informasi peluncuran.</p>
    <a href="{{ route('admin.news.create') }}" 
       class="px-4 py-2.5 rounded-xl bg-cyan-500 hover:bg-cyan-400 text-black font-extrabold text-xs uppercase tracking-wider flex items-center shadow-md">
        <i class="fa-solid fa-plus mr-2"></i> Tulis Artikel Baru
    </a>
</div>

<div class="admin-card rounded-2xl overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left text-xs">
            <thead>
                <tr class="border-b border-slate-800 text-slate-400 uppercase tracking-wider bg-slate-900/50">
                    <th class="py-3.5 px-6 font-semibold">Artikel</th>
                    <th class="py-3.5 px-6 font-semibold">Kategori</th>
                    <th class="py-3.5 px-6 font-semibold">Penulis</th>
                    <th class="py-3.5 px-6 font-semibold">Tanggal Terbit</th>
                    <th class="py-3.5 px-6 font-semibold">Status</th>
                    <th class="py-3.5 px-6 font-semibold text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-800/60">
                @forelse($articles as $article)
                    <tr class="hover:bg-slate-900/40">
                        <td class="py-4 px-6 flex items-center space-x-3">
                            <img src="{{ asset($article->image) }}" class="w-14 h-10 object-cover rounded bg-slate-950 border border-slate-800" onerror="this.src='{{ asset('images/news/news-m6.svg') }}'">
                            <div>
                                <p class="font-extrabold text-white text-sm line-clamp-1">{{ $article->title }}</p>
                                <p class="text-[11px] text-slate-400 line-clamp-1">{{ $article->summary }}</p>
                            </div>
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-full bg-blue-950 text-blue-300 font-semibold border border-blue-500/30 text-[10px] uppercase">
                                {{ $article->category }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-slate-300 font-medium">
                            {{ $article->author }}
                        </td>
                        <td class="py-4 px-6 text-slate-400">
                            {{ $article->published_at ? $article->published_at->format('d M Y') : '-' }}
                        </td>
                        <td class="py-4 px-6">
                            <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase {{ $article->is_published ? 'bg-emerald-950 text-emerald-400 border border-emerald-500/30' : 'bg-slate-800 text-slate-400' }}">
                                {{ $article->is_published ? 'Terbit' : 'Draft' }}
                            </span>
                        </td>
                        <td class="py-4 px-6 text-right space-x-3">
                            <a href="{{ route('admin.news.edit', $article) }}" class="text-xs font-bold text-cyan-400 hover:text-cyan-300">
                                <i class="fa-solid fa-pen-to-square mr-1"></i> Edit
                            </a>
                            <form action="{{ route('admin.news.destroy', $article) }}" method="POST" class="inline" onsubmit="return confirm('Hapus artikel ini?')">
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
                        <td colspan="6" class="py-8 text-center text-slate-500">
                            Belum ada artikel yang dibuat.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
