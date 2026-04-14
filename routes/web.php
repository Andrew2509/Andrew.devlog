<?php

use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/portofolio', [App\Http\Controllers\HomeController::class, 'portfolio'])->name('portfolio');
Route::get('/templates', [App\Http\Controllers\HomeController::class, 'templates'])->name('templates');
Route::get('/harga', [App\Http\Controllers\HomeController::class, 'harga'])->name('harga');
Route::get('/pesan', [App\Http\Controllers\HomeController::class, 'pesan'])->name('pesan');
Route::get('/blog', [App\Http\Controllers\BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [App\Http\Controllers\BlogController::class, 'show'])->name('blog.show');
Route::get('/sitemap.xml', [App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

Route::get('/me', function () { return view('page.sosmed'); })->name('sosmed');
Route::get('/privacy', function () { return view('page.privacy'); })->name('privacy');
Route::get('/terms', function () { return view('page.terms'); })->name('terms');
Route::post('/inquiry', [App\Http\Controllers\InquiryController::class, 'store'])->name('inquiry.store');
Route::get('/api/search', [App\Http\Controllers\SearchController::class, 'index'])->name('api.search');

// Auth Routes
Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('admin.dashboard');

    // Portfolio CRUD
    Route::resource('portfolio', App\Http\Controllers\Admin\PortfolioController::class)->names('admin.portfolio');
    
    // Pricing CRUD
    Route::resource('pricing', App\Http\Controllers\Admin\PriceController::class)->names('admin.pricing');
    Route::post('pricing/{pricing}/toggle/{field}', [App\Http\Controllers\Admin\PriceController::class, 'toggleStatus'])->name('admin.pricing.toggle');

    // Service Categories
    Route::resource('service-categories', App\Http\Controllers\Admin\ServiceCategoryController::class)->names('admin.service_categories');

    // Website Settings
    Route::get('/settings', [App\Http\Controllers\Admin\SettingController::class, 'index'])->name('admin.settings.index');
    Route::post('/settings', [App\Http\Controllers\Admin\SettingController::class, 'update'])->name('admin.settings.update');

    // Clients (Trusted By)
    Route::resource('clients', App\Http\Controllers\Admin\ClientController::class)->names('admin.clients');
    Route::post('clients/{client}/toggle/{field}', [App\Http\Controllers\Admin\ClientController::class, 'toggle'])->name('admin.clients.toggle');

    // Inquiries
    Route::get('/inquiries', [App\Http\Controllers\Admin\InquiryController::class, 'index'])->name('admin.inquiries.index');
    Route::get('/inquiries/{inquiry}', [App\Http\Controllers\Admin\InquiryController::class, 'show'])->name('admin.inquiries.show');
    Route::delete('/inquiries/{inquiry}', [App\Http\Controllers\Admin\InquiryController::class, 'destroy'])->name('admin.inquiries.destroy');

    // Blogger Management
    Route::get('/blogger', [App\Http\Controllers\Admin\BloggerController::class, 'index'])->name('admin.blogger.index');

    // Sosmed Management
    Route::get('/sosmed/about', [App\Http\Controllers\Admin\SosmedController::class, 'about'])->name('admin.sosmed.about');
    Route::post('/sosmed/about', [App\Http\Controllers\Admin\SosmedController::class, 'updateAbout'])->name('admin.sosmed.about.update');
    Route::get('/sosmed/services', [App\Http\Controllers\Admin\SosmedController::class, 'services'])->name('admin.sosmed.services');
    Route::post('/sosmed/services', [App\Http\Controllers\Admin\SosmedController::class, 'updateServices'])->name('admin.sosmed.services.update');
    Route::get('/sosmed/links', [App\Http\Controllers\Admin\SosmedController::class, 'links'])->name('admin.sosmed.links');
    Route::post('/sosmed/links', [App\Http\Controllers\Admin\SosmedController::class, 'updateLinks'])->name('admin.sosmed.links.update');
});
