<?php

use App\Http\Controllers\FrontendController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\Admin\MotorcycleController as AdminMotorcycleController;
use App\Http\Controllers\Admin\TourPackageController as AdminTourPackageController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\FaqController as AdminFaqController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;
use App\Http\Controllers\Admin\TransactionController as AdminTransactionController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

/* |-------------------------------------------------------------------------- | Frontend Routes |-------------------------------------------------------------------------- */

Route::get('/', [FrontendController::class , 'index'])->name('home');
Route::post('/bookings', [BookingController::class , 'store'])->name('bookings.store');

Route::get('/rental-mobil', [FrontendController::class , 'cars'])->name('cars.index');
Route::get('/rental-mobil/{car:slug}', [FrontendController::class , 'carDetail'])->name('cars.show');

Route::get('/rental-motor', [FrontendController::class , 'motorcycles'])->name('motorcycles.index');
Route::get('/rental-motor/{motorcycle:slug}', [FrontendController::class , 'motorcycleDetail'])->name('motorcycles.show');

Route::get('/paket-wisata', [FrontendController::class , 'tours'])->name('tours.index');
Route::get('/paket-wisata/{tourPackage:slug}', [FrontendController::class , 'tourDetail'])->name('tours.show');

Route::get('/tentang-kami', [FrontendController::class , 'about'])->name('about');
Route::get('/faq', [FrontendController::class , 'faq'])->name('faq');
Route::get('/kontak', [FrontendController::class , 'contact'])->name('contact');
Route::post('/kontak', [ContactController::class, 'store'])->name('contact.store');
Route::get('/testimoni', [FrontendController::class, 'testimonials'])->name('testimonials');
Route::get('/pencarian', [FrontendController::class, 'search'])->name('search');
Route::get('/kebijakan-privasi', [FrontendController::class, 'privacyPolicy'])->name('privacy-policy');
Route::get('/syarat-ketentuan', [FrontendController::class, 'termsOfService'])->name('terms-of-service');

Route::get('/post', [\App\Http\Controllers\PostController::class , 'index'])->name('posts.index');
Route::get('/post/{post:slug}', [\App\Http\Controllers\PostController::class , 'show'])->name('posts.show');

Route::get('/sitemap.xml', [FrontendController::class , 'sitemap'])->name('sitemap');


/* |-------------------------------------------------------------------------- | User Dashboard |-------------------------------------------------------------------------- */

Route::get('/dashboard', function () {
    return auth()->user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('profile.edit');
})
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


/* |-------------------------------------------------------------------------- | Admin Routes |-------------------------------------------------------------------------- */

Route::middleware(['auth', 'admin']) // ← DIUBAH DARI 'is_admin' KE 'admin'
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/', [AdminDashboardController::class , 'index'])
            ->name('dashboard');

        Route::resource('cars', AdminCarController::class)->except(['show']);
        Route::resource('motorcycles', AdminMotorcycleController::class)->except(['show']);
        Route::resource('tour-packages', AdminTourPackageController::class)->except(['show']);
        Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->except(['show']);
        Route::resource('testimonials', AdminTestimonialController::class)->except(['show']);
        Route::resource('faqs', AdminFaqController::class)->except(['show']);
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);
        Route::get('activity-logs', [\App\Http\Controllers\Admin\ActivityLogController::class, 'index'])->name('activity-logs.index');

        Route::get('transactions/export/csv', [AdminTransactionController::class , 'exportCsv'])
            ->name('transactions.export.csv');
        Route::get('transactions/export/excel', [AdminTransactionController::class , 'exportExcel'])
            ->name('transactions.export.excel');
        Route::get('transactions/export/pdf', [AdminTransactionController::class , 'exportPdf'])
            ->name('transactions.export.pdf');
        
        Route::get('transactions/{transaction}/invoice', [AdminTransactionController::class, 'printInvoice'])->name('transactions.invoice');
        Route::get('customers', [\App\Http\Controllers\Admin\CustomerController::class, 'index'])->name('customers.index');
        Route::get('customers/{phone}', [\App\Http\Controllers\Admin\CustomerController::class, 'show'])->name('customers.show');
        
        Route::resource('transactions', AdminTransactionController::class);

        // Settings biasanya hanya 1 data global
        Route::get('settings', [AdminSettingController::class , 'index'])
            ->name('settings.index');
        Route::put('settings', [AdminSettingController::class , 'update'])
            ->name('settings.update');
    });


/* |-------------------------------------------------------------------------- | Profile Routes |-------------------------------------------------------------------------- */

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class , 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class , 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class , 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
