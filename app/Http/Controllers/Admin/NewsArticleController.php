<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsArticle;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsArticleController extends Controller
{
    public function index()
    {
        $articles = NewsArticle::orderByDesc('created_at')->get();
        return view('admin.news.index', compact('articles'));
    }

    public function create()
    {
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'author' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
        ]);

        $image = 'images/news/news-m6.svg';
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/news', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        $slug = Str::slug($validated['title']);
        $count = NewsArticle::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        NewsArticle::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'category' => $validated['category'],
            'author' => $validated['author'] ?? 'Tim Redaksi Sales BYD',
            'image' => $image,
            'summary' => $validated['summary'] ?? null,
            'content' => $validated['content'],
            'is_published' => $request->has('is_published'),
            'published_at' => $validated['published_at'] ?? now(),
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Artikel berita berhasil ditambahkan!');
    }

    public function edit(NewsArticle $news)
    {
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, NewsArticle $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'category' => 'required|string|max:100',
            'author' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:500',
            'content' => 'required|string',
            'is_published' => 'boolean',
            'published_at' => 'nullable|date',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
        ]);

        $image = $news->image;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/news', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        $news->update([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'author' => $validated['author'] ?? 'Tim Redaksi Sales BYD',
            'image' => $image,
            'summary' => $validated['summary'] ?? null,
            'content' => $validated['content'],
            'is_published' => $request->has('is_published'),
            'published_at' => $validated['published_at'] ?? $news->published_at,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Artikel berita berhasil diperbarui!');
    }

    public function destroy(NewsArticle $news)
    {
        $news->delete();
        return redirect()->route('admin.news.index')->with('success', 'Artikel berita berhasil dihapus!');
    }
}
