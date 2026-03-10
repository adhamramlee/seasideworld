<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\LanguageMiddleware;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\ClientMiddleware;

// Language switch route
Route::post('language/{locale}', function ($locale) {
    if (!in_array($locale, ['en', 'jp'])) {
        abort(400);
    }
    session(['locale' => $locale]);
    return redirect()->back();
})->name('language.switch');

// Public Routes
Route::middleware([LanguageMiddleware::class])->group(function () {
    Route::get('/', [App\Http\Controllers\Public\HomeController::class, 'index'])->name('home');
    Route::get('/about', [App\Http\Controllers\Public\AboutController::class, 'index'])->name('about');
    Route::get('/services', [App\Http\Controllers\Public\ServiceController::class, 'index'])->name('services');
    Route::get('/gallery', [App\Http\Controllers\Public\GalleryController::class, 'index'])->name('gallery');
    Route::get('/gallery/{slug}', [App\Http\Controllers\Public\GalleryController::class, 'show'])->name('gallery.show');
    Route::get('/export-process', function () {
        return view('public.export-process');
    })->name('export-process');
    Route::get('/contact', [App\Http\Controllers\Public\ContactController::class, 'index'])->name('contact');
    Route::post('/contact', [App\Http\Controllers\Public\ContactController::class, 'store'])->name('contact.store');
});

// Authentication Routes (Breeze)
require __DIR__.'/auth.php';

// Admin Routes
Route::prefix('admin')
    ->name('admin.')
    ->middleware(['auth', AdminMiddleware::class, LanguageMiddleware::class])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Admin\DashboardController::class, 'index'])->name('dashboard');
        
        // Pages Management
        Route::resource('pages', App\Http\Controllers\Admin\PageController::class);
        Route::post('pages/{page}/toggle-status', [App\Http\Controllers\Admin\PageController::class, 'toggleStatus'])->name('pages.toggle-status');
        
        // Categories Management
        Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
        Route::post('categories/{category}/toggle-status', [App\Http\Controllers\Admin\CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');
        
        // Vehicles Management
        Route::resource('vehicles', App\Http\Controllers\Admin\VehicleController::class);
        Route::post('vehicles/{vehicle}/toggle-status', [App\Http\Controllers\Admin\VehicleController::class, 'toggleStatus'])->name('vehicles.toggle-status');
        Route::post('vehicles/{vehicle}/set-primary-image/{image}', [App\Http\Controllers\Admin\VehicleController::class, 'setPrimaryImage'])->name('vehicles.set-primary-image');
        Route::delete('vehicles/images/{image}', [App\Http\Controllers\Admin\VehicleController::class, 'deleteImage'])->name('vehicles.delete-image');
        
        // Clients Management
        Route::resource('clients', App\Http\Controllers\Admin\ClientController::class);
        Route::post('clients/{client}/toggle-status', [App\Http\Controllers\Admin\ClientController::class, 'toggleStatus'])->name('clients.toggle-status');
        
        // Documents Management
        Route::resource('documents', App\Http\Controllers\Admin\DocumentController::class);
        Route::post('documents/{document}/toggle-status', [App\Http\Controllers\Admin\DocumentController::class, 'toggleStatus'])->name('documents.toggle-status');
        Route::get('documents/{document}/download', [App\Http\Controllers\Admin\DocumentController::class, 'download'])->name('documents.download');
        Route::post('documents/{document}/assign-client', [App\Http\Controllers\Admin\DocumentController::class, 'assignToClient'])->name('documents.assign-client');
        Route::delete('documents/{document}/remove-client/{client}', [App\Http\Controllers\Admin\DocumentController::class, 'removeFromClient'])->name('documents.remove-client');
        
        // Inquiries Management
        Route::resource('inquiries', App\Http\Controllers\Admin\InquiryController::class)->only(['index', 'show', 'destroy']);
        Route::post('inquiries/{inquiry}/update-status', [App\Http\Controllers\Admin\InquiryController::class, 'update'])->name('inquiries.update-status');
        Route::post('inquiries/{inquiry}/mark-replied', [App\Http\Controllers\Admin\InquiryController::class, 'markAsReplied'])->name('inquiries.mark-replied');
    });

// Client Routes
Route::prefix('client')
    ->name('client.')
    ->middleware(['auth', ClientMiddleware::class, LanguageMiddleware::class])
    ->group(function () {
        // Dashboard
        Route::get('/dashboard', [App\Http\Controllers\Client\DashboardController::class, 'index'])->name('dashboard');
        
        // Documents
        Route::get('/documents', [App\Http\Controllers\Client\DocumentController::class, 'index'])->name('documents.index');
        Route::get('/documents/{document}', [App\Http\Controllers\Client\DocumentController::class, 'show'])->name('documents.show');
        Route::get('/documents/{document}/download', [App\Http\Controllers\Client\DocumentController::class, 'download'])->name('documents.download');
        
        // Inquiries
        Route::get('/inquiries', [App\Http\Controllers\Client\InquiryController::class, 'index'])->name('inquiries.index');
        Route::get('/inquiries/{inquiry}', [App\Http\Controllers\Client\InquiryController::class, 'show'])->name('inquiries.show');
        
        // Profile
        Route::get('/profile', [App\Http\Controllers\Client\ProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [App\Http\Controllers\Client\ProfileController::class, 'update'])->name('profile.update');
    });