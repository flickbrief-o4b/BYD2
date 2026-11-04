@extends('layouts.app')

@section('title', $article->title . ' | ' . ($settings['dealer_name'] ?? 'BYD Sales Indonesia'))
@section('meta_description', Str::limit(strip_tags($article->summary ?? $article->content), 160))
@section('og_title', $article->title)
@section('og_image', asset($article->image))

@section('content')

@php
    $salesWaNum = preg_replace('/[^0-9]/', '', $salesProfile?->whatsapp ?? $salesProfile?->phone ?? '6281288997722');
    if (str_starts_with($salesWaNum, '0')) { $salesWaNum = '62' . substr($salesWaNum, 1); }
@endphp

<!-- Breadcrumbs -->
<div class="bg-[#070B16] border-b border-slate-800 py-4">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 flex items-center space-x-2 text-xs text-slate-400">
        <a href="{{ route('home') }}" class="hover:text-cyan-400 transition-colors">Beranda</a>
        <span class="text-slate-600">/</span>
        <a href="{{ route('home') }}#news" class="hover:text-cyan-400 transition-colors">Berita</a>
        <span class="text-slate-600">/</span>
        <span class="text-cyan-400 font-bold truncate max-w-xs">{{ $article->title }}</span>
    </div>
</div>

<article class="py-12 lg:py-16 bg-[#050811] relative">
    <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">
        
        <!-- Header -->
        <div class="space-y-4 text-center">
            <span class="px-3.5 py-1.5 rounded-full bg-cyan-950 text-cyan-300 text-xs font-bold uppercase tracking-wider border border-cyan-500/30">
                {{ $article->category }}
            </span>

            <h1 class="text-3xl sm:text-4xl lg:text-5xl font-black text-white tracking-tight leading-tight">
                {{ $article->title }}
            </h1>

            <div class="flex items-center justify-center space-x-4 text-xs text-slate-400 pt-2">
                <span><i class="fa-regular fa-user mr-1 text-cyan-400"></i> {{ $article->author }}</span>
                <span>&bull;</span>
                <span><i class="fa-regular fa-calendar mr-1 text-cyan-400"></i> {{ $article->published_at ? $article->published_at->format('d F Y') : date('d F Y') }}</span>
            </div>
        </div>

        <!-- Featured Image -->
        <div class="mt-8 rounded-3xl overflow-hidden glass-panel neon-border shadow-2xl">
            <img src="{{ asset($article->image) }}" 
                 alt="{{ $article->title }}" 
                 class="w-full h-auto max-h-[480px] object-cover"
                 onerror="this.src='{{ asset('images/news/news-m6.svg') }}'">
        </div>

        <!-- Content Body -->
        <div class="mt-10 text-slate-300 space-y-6 text-base sm:text-lg leading-relaxed whitespace-pre-line border-b border-slate-800 pb-12">
            {{ $article->content }}
        </div>

        <!-- Author / Sales Rep Follow-Up Card -->
        <div class="mt-12 glass-panel rounded-3xl p-6 sm:p-8 neon-border flex flex-col sm:flex-row items-center justify-between gap-6">
            <div class="flex items-center space-x-4">
                <img src="{{ asset($salesProfile?->photo ?? 'images/sales/sales-consultant.svg') }}" 
                     alt="{{ $salesProfile?->name }}" 
                     class="w-16 h-16 rounded-2xl object-cover border border-cyan-400/40"
                     onerror="this.src='{{ asset('images/sales/sales-consultant.svg') }}'">
                <div>
                    <p class="text-xs text-cyan-400 font-bold uppercase tracking-wider">Konsultasikan Bersama Ahlinya</p>
                    <p class="text-lg font-extrabold text-white">{{ $salesProfile?->name ?? 'Sales Specialist BYD' }}</p>
                    <p class="text-xs text-slate-400">{{ $salesProfile?->title }}</p>
                </div>
            </div>

            <a href="https://wa.me/{{ $salesWaNum }}?text={{ urlencode('Halo ' . ($salesProfile?->name ?? 'Sales') . ', saya baru membaca artikel \'' . $article->title . '\'. Boleh konsultasi info mobil listrik BYD?') }}" 
               target="_blank"
               class="px-6 py-3.5 rounded-xl bg-gradient-to-r from-cyan-500 to-blue-600 hover:from-cyan-400 hover:to-blue-500 text-white font-bold text-xs uppercase tracking-wider flex items-center shadow-lg shadow-cyan-500/20 whitespace-nowrap">
                <i class="fa-brands fa-whatsapp text-base mr-2"></i>
                Konsultasi WhatsApp
            </a>
        </div>

        <!-- Related News -->
        @if($recentArticles->count() > 0)
            <div class="mt-16">
                <h3 class="text-2xl font-black text-white tracking-tight mb-6">
                    Artikel &amp; Berita Terkait Lainnya
                </h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    @foreach($recentArticles as $rec)
                        <a href="{{ route('news.detail', $rec->slug) }}" class="p-4 rounded-2xl glass-panel border border-slate-800 hover:border-cyan-500/40 transition-all flex items-center space-x-4 group">
                            <img src="{{ asset($rec->image) }}" class="w-20 h-20 rounded-xl object-cover shrink-0" onerror="this.src='{{ asset('images/news/news-m6.svg') }}'">
                            <div>
                                <span class="text-[10px] font-bold text-cyan-400 uppercase">{{ $rec->category }}</span>
                                <h4 class="text-sm font-bold text-white group-hover:text-cyan-400 line-clamp-2 mt-0.5">{{ $rec->title }}</h4>
                            </div>
                        </a>
                    @endforeach
                </div>
            </div>
        @endif

    </div>
</article>

@endsection
