<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CarModel;
use App\Models\Inquiry;
use App\Models\NewsArticle;
use App\Models\Promo;
use App\Models\SalesProfile;

class DashboardController extends Controller
{
    public function index()
    {
        $totalModels = CarModel::count();
        $totalPromos = Promo::where('is_active', true)->count();
        $totalArticles = NewsArticle::count();
        $totalInquiries = Inquiry::count();
        $newInquiriesCount = Inquiry::where('status', 'baru')->count();

        $recentInquiries = Inquiry::with('carModel')->latest()->take(8)->get();
        $salesProfile = SalesProfile::first();

        return view('admin.dashboard', compact(
            'totalModels',
            'totalPromos',
            'totalArticles',
            'totalInquiries',
            'newInquiriesCount',
            'recentInquiries',
            'salesProfile'
        ));
    }
}
