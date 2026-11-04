<?php

use App\Http\Controllers\Admin\CarModelController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\HeroSliderController;
use App\Http\Controllers\Admin\InquiryController;
use App\Http\Controllers\Admin\NewsArticleController;
use App\Http\Controllers\Admin\PromoController;
use App\Http\Controllers\Admin\SalesProfileController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Frontend Routes
|--------------------------------------------------------------------------
*/
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/model/{slug}', [HomeController::class, 'modelDetail'])->name('model.detail');
Route::get('/berita/{slug}', [HomeController::class, 'newsDetail'])->name('news.detail');
Route::post('/inquiry', [HomeController::class, 'storeInquiry'])->name('inquiry.store');

/*
|--------------------------------------------------------------------------
| Admin Authentication Routes
|--------------------------------------------------------------------------
*/
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/login', fn() => redirect()->route('login'))->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('admin.login.submit');
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

/*
|--------------------------------------------------------------------------
| Protected Admin Routes
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // General Settings (Logo, Favicon, OG Graph, Dealer & Contact info, Maps)
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Sales Profile Management
    Route::get('/sales-profile', [SalesProfileController::class, 'edit'])->name('sales.edit');
    Route::put('/sales-profile', [SalesProfileController::class, 'update'])->name('sales.update');

    // Hero Sliders CRUD
    Route::resource('sliders', HeroSliderController::class)->except(['show']);

    // Car Models & Child Types CRUD
    Route::resource('cars', CarModelController::class);
    Route::post('/cars/{car}/types', [CarModelController::class, 'storeType'])->name('cars.types.store');
    Route::delete('/cars/{car}/types/{type}', [CarModelController::class, 'destroyType'])->name('cars.types.destroy');

    // Promos CRUD
    Route::resource('promos', PromoController::class)->except(['show']);

    // News & Articles CRUD
    Route::resource('news', NewsArticleController::class)->except(['show']);

    // Inquiries / Leads & Test Drive Requests
    Route::get('/inquiries', [InquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}', [InquiryController::class, 'show'])->name('inquiries.show');
    Route::patch('/inquiries/{inquiry}/status', [InquiryController::class, 'updateStatus'])->name('inquiries.status');
    Route::delete('/inquiries/{inquiry}', [InquiryController::class, 'destroy'])->name('inquiries.destroy');
});
