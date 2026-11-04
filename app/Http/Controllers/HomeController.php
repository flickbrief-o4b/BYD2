<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use App\Models\HeroSlider;
use App\Models\Inquiry;
use App\Models\NewsArticle;
use App\Models\Promo;
use App\Models\SalesProfile;
use App\Models\Setting;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $settings = Setting::getAll();
        $salesProfile = SalesProfile::where('is_active', true)->first();
        $sliders = HeroSlider::where('is_active', true)->orderBy('order')->get();
        $carModels = CarModel::with(['types' => function ($q) {
            $q->where('is_active', true)->orderBy('order');
        }])->where('is_active', true)->orderBy('order')->get();
        $promos = Promo::where('is_active', true)->orderBy('order')->get();
        $articles = NewsArticle::where('is_published', true)->orderByDesc('published_at')->take(6)->get();

        return view('home', compact(
            'settings',
            'salesProfile',
            'sliders',
            'carModels',
            'promos',
            'articles'
        ));
    }

    public function modelDetail(string $slug)
    {
        $settings = Setting::getAll();
        $salesProfile = SalesProfile::where('is_active', true)->first();
        $car = CarModel::with(['types' => function ($q) {
            $q->where('is_active', true)->orderBy('order');
        }])->where('slug', $slug)->where('is_active', true)->firstOrFail();

        $otherCars = CarModel::where('id', '!=', $car->id)->where('is_active', true)->take(3)->get();

        return view('model-detail', compact('settings', 'salesProfile', 'car', 'otherCars'));
    }

    public function newsDetail(string $slug)
    {
        $settings = Setting::getAll();
        $salesProfile = SalesProfile::where('is_active', true)->first();
        $article = NewsArticle::where('slug', $slug)->where('is_published', true)->firstOrFail();
        $recentArticles = NewsArticle::where('id', '!=', $article->id)->where('is_published', true)->orderByDesc('published_at')->take(4)->get();

        return view('news-detail', compact('settings', 'salesProfile', 'article', 'recentArticles'));
    }

    public function storeInquiry(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:150',
            'phone' => 'required|string|max:30',
            'email' => 'nullable|email|max:150',
            'car_model_id' => 'nullable|exists:car_models,id',
            'inquiry_type' => 'required|string|in:test_drive,promo,simulasi_kredit,umum',
            'preferred_date' => 'nullable|date',
            'preferred_time' => 'nullable|string|max:50',
            'city' => 'nullable|string|max:100',
            'notes' => 'nullable|string|max:1000',
        ]);

        $inquiry = Inquiry::create($validated);

        // Fetch sales person for direct WA redirect
        $salesProfile = SalesProfile::where('is_active', true)->first();
        $salesWa = $salesProfile ? $salesProfile->whatsapp : Setting::get('dealer_whatsapp', '6281288997722');
        $phoneClean = preg_replace('/[^0-9]/', '', $salesWa);
        if (str_starts_with($phoneClean, '0')) {
            $phoneClean = '62' . substr($phoneClean, 1);
        }

        $carName = $inquiry->carModel ? $inquiry->carModel->name : 'BYD EV';
        $typeLabel = match ($inquiry->inquiry_type) {
            'test_drive' => 'Booking Test Drive',
            'promo' => 'Klaim Promo Spesial',
            'simulasi_kredit' => 'Simulasi Kredit & DP',
            default => 'Konsultasi Mobil BYD',
        };

        $waMessage = "Halo {$salesProfile?->name}, saya baru mengirim formulir {$typeLabel} di website.\n\n" .
            "Nama: {$inquiry->name}\n" .
            "No. Telp/WA: {$inquiry->phone}\n" .
            "Model Mobil: {$carName}\n" .
            ($inquiry->preferred_date ? "Jadwal: " . $inquiry->preferred_date->format('d M Y') . " " . ($inquiry->preferred_time ?? '') . "\n" : "") .
            ($inquiry->city ? "Domisili: {$inquiry->city}\n" : "") .
            ($inquiry->notes ? "Catatan: {$inquiry->notes}\n" : "") .
            "\nMohon informasi lebih lanjut. Terima kasih!";

        $waUrl = "https://wa.me/{$phoneClean}?text=" . urlencode($waMessage);

        if ($request->wantsJson() || $request->ajax()) {
            return response()->json([
                'success' => true,
                'message' => 'Permintaan Anda telah berhasil dikirim! Sales Consultant kami akan segera menghubungi Anda.',
                'wa_url' => $waUrl,
            ]);
        }

        return redirect()->away($waUrl);
    }
}
