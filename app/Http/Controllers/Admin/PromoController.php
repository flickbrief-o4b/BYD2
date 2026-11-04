<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Promo;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::orderBy('order')->get();
        return view('admin.promos.index', compact('promos'));
    }

    public function create()
    {
        return view('admin.promos.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'badge' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:500',
            'terms' => 'nullable|string',
            'valid_until' => 'nullable|date',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
        ]);

        $image = 'images/promos/promo-bunga-nol.svg';
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/promos', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        $slug = Str::slug($validated['title']);
        $count = Promo::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        Promo::create([
            'title' => $validated['title'],
            'slug' => $slug,
            'badge' => $validated['badge'] ?? null,
            'image' => $image,
            'summary' => $validated['summary'] ?? null,
            'terms' => $validated['terms'] ?? null,
            'valid_until' => $validated['valid_until'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil ditambahkan!');
    }

    public function edit(Promo $promo)
    {
        return view('admin.promos.edit', compact('promo'));
    }

    public function update(Request $request, Promo $promo)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:200',
            'badge' => 'nullable|string|max:100',
            'summary' => 'nullable|string|max:500',
            'terms' => 'nullable|string',
            'valid_until' => 'nullable|date',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
        ]);

        $image = $promo->image;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/promos', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        $promo->update([
            'title' => $validated['title'],
            'badge' => $validated['badge'] ?? null,
            'image' => $image,
            'summary' => $validated['summary'] ?? null,
            'terms' => $validated['terms'] ?? null,
            'valid_until' => $validated['valid_until'] ?? null,
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil diperbarui!');
    }

    public function destroy(Promo $promo)
    {
        $promo->delete();
        return redirect()->route('admin.promos.index')->with('success', 'Promo berhasil dihapus!');
    }
}
