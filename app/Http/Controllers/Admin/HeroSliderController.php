<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlider;
use Illuminate\Http\Request;

class HeroSliderController extends Controller
{
    public function index()
    {
        $sliders = HeroSlider::orderBy('order')->get();
        return view('admin.sliders.index', compact('sliders'));
    }

    public function create()
    {
        return view('admin.sliders.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
        ]);

        $image = 'images/sliders/slider-seal.svg';
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/sliders', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        HeroSlider::create([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'badge' => $validated['badge'] ?? null,
            'image' => $image,
            'button_text' => $validated['button_text'] ?? 'Konsultasi Sekarang',
            'button_link' => $validated['button_link'] ?? '#cars',
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Hero Slider berhasil ditambahkan!');
    }

    public function edit(HeroSlider $slider)
    {
        return view('admin.sliders.edit', compact('slider'));
    }

    public function update(Request $request, HeroSlider $slider)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:500',
            'badge' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_link' => 'nullable|string|max:255',
            'order' => 'required|integer',
            'is_active' => 'boolean',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
        ]);

        $image = $slider->image;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/sliders', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        $slider->update([
            'title' => $validated['title'],
            'subtitle' => $validated['subtitle'] ?? null,
            'badge' => $validated['badge'] ?? null,
            'image' => $image,
            'button_text' => $validated['button_text'] ?? 'Konsultasi Sekarang',
            'button_link' => $validated['button_link'] ?? '#cars',
            'order' => $validated['order'] ?? 0,
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.sliders.index')->with('success', 'Hero Slider berhasil diperbarui!');
    }

    public function destroy(HeroSlider $slider)
    {
        $slider->delete();
        return redirect()->route('admin.sliders.index')->with('success', 'Hero Slider berhasil dihapus!');
    }
}
