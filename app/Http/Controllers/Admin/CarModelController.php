<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\CarType;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CarModelController extends Controller
{
    public function index()
    {
        $cars = CarModel::withCount('types')->orderBy('order')->get();
        return view('admin.cars.index', compact('cars'));
    }

    public function create()
    {
        return view('admin.cars.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'tagline' => 'nullable|string|max:200',
            'starting_price' => 'required|numeric|min:0',
            'range_km' => 'nullable|string|max:100',
            'acceleration' => 'nullable|string|max:100',
            'battery_type' => 'nullable|string|max:150',
            'battery_capacity' => 'nullable|string|max:100',
            'max_power' => 'nullable|string|max:150',
            'charging_time' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'features' => 'nullable|string', // comma or line separated
            'order' => 'required|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
            'brochure_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $image = 'images/cars/byd-seal.svg';
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/cars', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        $brochure = null;
        if ($request->hasFile('brochure_file')) {
            $bPath = $request->file('brochure_file')->store('uploads/brochures', 'public');
            $brochure = 'storage/' . $bPath;
        }

        $featuresArray = [];
        if (!empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $validated['features'])))));
        }

        $slug = Str::slug($validated['name']);
        // Ensure slug uniqueness
        $count = CarModel::where('slug', 'like', "{$slug}%")->count();
        if ($count > 0) {
            $slug .= '-' . ($count + 1);
        }

        $car = CarModel::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'category' => $validated['category'],
            'tagline' => $validated['tagline'] ?? null,
            'starting_price' => $validated['starting_price'],
            'image' => $image,
            'brochure_file' => $brochure,
            'range_km' => $validated['range_km'] ?? null,
            'acceleration' => $validated['acceleration'] ?? null,
            'battery_type' => $validated['battery_type'] ?? 'BYD Blade Battery (LFP)',
            'battery_capacity' => $validated['battery_capacity'] ?? null,
            'max_power' => $validated['max_power'] ?? null,
            'charging_time' => $validated['charging_time'] ?? null,
            'description' => $validated['description'] ?? null,
            'features' => $featuresArray,
            'order' => $validated['order'] ?? 0,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.cars.edit', $car)->with('success', 'Model Mobil berhasil ditambahkan! Silakan tambahkan tipe / varian spesifik di bawah.');
    }

    public function edit(CarModel $car)
    {
        $car->load('types');
        return view('admin.cars.edit', compact('car'));
    }

    public function update(Request $request, CarModel $car)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'category' => 'required|string|max:50',
            'tagline' => 'nullable|string|max:200',
            'starting_price' => 'required|numeric|min:0',
            'range_km' => 'nullable|string|max:100',
            'acceleration' => 'nullable|string|max:100',
            'battery_type' => 'nullable|string|max:150',
            'battery_capacity' => 'nullable|string|max:100',
            'max_power' => 'nullable|string|max:150',
            'charging_time' => 'nullable|string|max:150',
            'description' => 'nullable|string',
            'features' => 'nullable|string',
            'order' => 'required|integer',
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'image_file' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'image_url' => 'nullable|string|max:500',
            'brochure_file' => 'nullable|file|mimes:pdf|max:10240',
        ]);

        $image = $car->image;
        if ($request->hasFile('image_file')) {
            $path = $request->file('image_file')->store('uploads/cars', 'public');
            $image = 'storage/' . $path;
        } elseif (!empty($validated['image_url'])) {
            $image = $validated['image_url'];
        }

        $brochure = $car->brochure_file;
        if ($request->hasFile('brochure_file')) {
            $bPath = $request->file('brochure_file')->store('uploads/brochures', 'public');
            $brochure = 'storage/' . $bPath;
        }

        $featuresArray = [];
        if (!empty($validated['features'])) {
            $featuresArray = array_values(array_filter(array_map('trim', explode("\n", str_replace("\r", "", $validated['features'])))));
        }

        $car->update([
            'name' => $validated['name'],
            'category' => $validated['category'],
            'tagline' => $validated['tagline'] ?? null,
            'starting_price' => $validated['starting_price'],
            'image' => $image,
            'brochure_file' => $brochure,
            'range_km' => $validated['range_km'] ?? null,
            'acceleration' => $validated['acceleration'] ?? null,
            'battery_type' => $validated['battery_type'] ?? 'BYD Blade Battery (LFP)',
            'battery_capacity' => $validated['battery_capacity'] ?? null,
            'max_power' => $validated['max_power'] ?? null,
            'charging_time' => $validated['charging_time'] ?? null,
            'description' => $validated['description'] ?? null,
            'features' => $featuresArray,
            'order' => $validated['order'] ?? 0,
            'is_featured' => $request->has('is_featured'),
            'is_active' => $request->has('is_active'),
        ]);

        return redirect()->route('admin.cars.edit', $car)->with('success', 'Data Model Mobil berhasil diperbarui!');
    }

    public function destroy(CarModel $car)
    {
        $car->delete();
        return redirect()->route('admin.cars.index')->with('success', 'Model Mobil berhasil dihapus!');
    }

    /**
     * Store new type / trim for a model
     */
    public function storeType(Request $request, CarModel $car)
    {
        $validated = $request->validate([
            'type_name' => 'required|string|max:100',
            'type_price' => 'required|numeric|min:0',
            'type_range_km' => 'nullable|string|max:100',
            'type_battery_capacity' => 'nullable|string|max:100',
            'type_drivetrain' => 'nullable|string|max:50',
            'type_power' => 'nullable|string|max:100',
            'type_seats' => 'nullable|string|max:50',
            'type_highlights' => 'nullable|string|max:500',
            'type_order' => 'nullable|integer',
        ]);

        $car->types()->create([
            'name' => $validated['type_name'],
            'price' => $validated['type_price'],
            'range_km' => $validated['type_range_km'] ?? null,
            'battery_capacity' => $validated['type_battery_capacity'] ?? null,
            'drivetrain' => $validated['type_drivetrain'] ?? 'FWD',
            'power' => $validated['type_power'] ?? null,
            'seats' => $validated['type_seats'] ?? '5-Seater',
            'highlights' => $validated['type_highlights'] ?? null,
            'order' => $validated['type_order'] ?? 0,
            'is_active' => true,
        ]);

        return redirect()->route('admin.cars.edit', $car)->with('success', 'Tipe varian baru berhasil ditambahkan!');
    }

    /**
     * Destroy a child type
     */
    public function destroyType(CarModel $car, CarType $type)
    {
        $type->delete();
        return redirect()->route('admin.cars.edit', $car)->with('success', 'Tipe varian berhasil dihapus!');
    }
}
