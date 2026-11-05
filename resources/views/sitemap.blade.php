{!! '<' . '?xml version="1.0" encoding="UTF-8"?' . '>' !!}
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <!-- Home Page -->
    <url>
        <loc>{{ route('home') }}</loc>
        <lastmod>{{ now()->toAtomString() }}</lastmod>
        <changefreq>daily</changefreq>
        <priority>1.0</priority>
    </url>

    <!-- Car Models -->
    @foreach($cars as $car)
    <url>
        <loc>{{ route('model.detail', $car->slug) }}</loc>
        <lastmod>{{ $car->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
        <changefreq>weekly</changefreq>
        <priority>0.9</priority>
    </url>
    @endforeach

    <!-- News & Promos -->
    @foreach($articles as $article)
    <url>
        <loc>{{ route('news.detail', $article->slug) }}</loc>
        <lastmod>{{ $article->updated_at?->toAtomString() ?? now()->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    @endforeach
</urlset>
