<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\NewsArticle;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SeoController extends Controller
{
    public function index()
    {
        $settings = Setting::getAll();
        $totalCars = CarModel::where('is_active', true)->count();
        $totalArticles = NewsArticle::where('is_published', true)->count();

        // Calculate SEO completeness score
        $score = 0;
        $maxScore = 100;
        $checks = [
            'title' => !empty($settings['site_title']),
            'description' => !empty($settings['meta_description']) && strlen($settings['meta_description']) >= 50,
            'keywords' => !empty($settings['meta_keywords']),
            'og_image' => !empty($settings['og_image_path']),
            'og_title' => !empty($settings['og_title']) || !empty($settings['site_title']),
            'analytics' => !empty($settings['google_analytics_id']) || !empty($settings['gtm_container_id']),
            'webmaster' => !empty($settings['google_site_verification']),
            'robots' => !empty($settings['seo_robots'] ?? 'index, follow'),
        ];

        $points = [
            'title' => 20,
            'description' => 20,
            'keywords' => 10,
            'og_image' => 15,
            'og_title' => 10,
            'analytics' => 10,
            'webmaster' => 10,
            'robots' => 5,
        ];

        foreach ($checks as $key => $passed) {
            if ($passed) {
                $score += $points[$key];
            }
        }

        return view('admin.seo.index', compact('settings', 'totalCars', 'totalArticles', 'score', 'checks'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:100',
            'meta_description' => 'required|string|max:300',
            'meta_keywords' => 'nullable|string|max:500',
            'seo_canonical_url' => 'nullable|url|max:255',
            'seo_robots' => ['required', 'string', Rule::in(['index, follow', 'noindex, follow', 'index, nofollow', 'noindex, nofollow'])],
            'og_title' => 'nullable|string|max:100',
            'og_description' => 'nullable|string|max:300',
            'og_image' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
            'twitter_card' => 'required|string|in:summary_large_image,summary',
            'twitter_site' => 'nullable|string|max:100',
            'google_site_verification' => 'nullable|string|max:255',
            'bing_site_verification' => 'nullable|string|max:255',
            'google_analytics_id' => 'nullable|string|max:50',
            'gtm_container_id' => 'nullable|string|max:50',
            'meta_pixel_id' => 'nullable|string|max:50',
            'custom_header_scripts' => 'nullable|string',
            'custom_footer_scripts' => 'nullable|string',
        ]);

        // Process OG Image Upload
        if ($request->hasFile('og_image')) {
            $ogPath = $request->file('og_image')->store('uploads/branding', 'public');
            Setting::set('og_image_path', 'storage/' . $ogPath);
        }

        $fields = [
            'site_title',
            'meta_description',
            'meta_keywords',
            'seo_canonical_url',
            'seo_robots',
            'og_title',
            'og_description',
            'twitter_card',
            'twitter_site',
            'google_site_verification',
            'bing_site_verification',
            'google_analytics_id',
            'gtm_container_id',
            'meta_pixel_id',
            'custom_header_scripts',
            'custom_footer_scripts',
        ];

        foreach ($fields as $field) {
            Setting::set($field, $request->input($field, ''));
        }

        return redirect()->route('admin.seo.index')
            ->with('success', 'Konfigurasi SEO & Meta Tags berhasil diperbarui!');
    }
}
