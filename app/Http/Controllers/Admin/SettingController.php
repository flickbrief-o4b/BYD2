<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::getAll();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_title' => 'required|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'meta_keywords' => 'nullable|string|max:500',
            'dealer_name' => 'required|string|max:255',
            'dealer_tagline' => 'nullable|string|max:255',
            'dealer_address' => 'nullable|string|max:500',
            'dealer_city' => 'nullable|string|max:100',
            'dealer_phone' => 'nullable|string|max:50',
            'dealer_whatsapp' => 'required|string|max:50',
            'dealer_email' => 'nullable|email|max:100',
            'opening_hours' => 'nullable|string|max:255',
            'maps_embed_url' => 'nullable|string',
            'maps_link' => 'nullable|string|max:500',
            'social_instagram' => 'nullable|url|max:255',
            'social_facebook' => 'nullable|url|max:255',
            'social_tiktok' => 'nullable|url|max:255',
            'social_youtube' => 'nullable|url|max:255',
            'logo' => 'nullable|file|mimes:png,jpg,jpeg,svg,webp|max:3072',
            'favicon' => 'nullable|file|mimes:png,jpg,ico,svg|max:1024',
            'og_image' => 'nullable|file|mimes:png,jpg,jpeg,webp,svg|max:4096',
        ]);

        // Process File Uploads: Logo
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('uploads/branding', 'public');
            Setting::set('logo_path', 'storage/' . $logoPath);
        }

        // Process File Uploads: Favicon
        if ($request->hasFile('favicon')) {
            $favPath = $request->file('favicon')->store('uploads/branding', 'public');
            Setting::set('favicon_path', 'storage/' . $favPath);
        }

        // Process File Uploads: OG Graph Image
        if ($request->hasFile('og_image')) {
            $ogPath = $request->file('og_image')->store('uploads/branding', 'public');
            Setting::set('og_image_path', 'storage/' . $ogPath);
        }

        // Save text fields
        $textFields = [
            'site_title',
            'meta_description',
            'meta_keywords',
            'dealer_name',
            'dealer_tagline',
            'dealer_address',
            'dealer_city',
            'dealer_phone',
            'dealer_whatsapp',
            'dealer_email',
            'opening_hours',
            'maps_embed_url',
            'maps_link',
            'social_instagram',
            'social_facebook',
            'social_tiktok',
            'social_youtube',
        ];

        foreach ($textFields as $field) {
            if ($request->has($field)) {
                Setting::set($field, $request->input($field));
            }
        }

        return redirect()->route('admin.settings.index')
            ->with('success', 'Pengaturan website, Logo, Favicon & OG Graph berhasil diperbarui!');
    }
}
