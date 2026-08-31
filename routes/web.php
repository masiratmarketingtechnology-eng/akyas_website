<?php

use App\Http\Controllers\ContactController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\BlogController;
use App\Http\Controllers\Admin\EnquiryController;
use App\Http\Controllers\Admin\ProductCategoryController;
use App\Http\Controllers\Admin\BlogCategoryController;
use App\Http\Controllers\Admin\CertificateController;
use App\Http\Controllers\Admin\StaffUserController;
use Illuminate\Support\Facades\Route;

// Public Routes
Route::get('/', [SiteController::class, 'home'])->name('home');
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::get('/about', [SiteController::class, 'about'])->name('about');
Route::get('/products', [SiteController::class, 'products'])->name('products.index');
Route::get('/products/{slug}', [SiteController::class, 'product'])->name('products.show');
Route::get('/certificates', [SiteController::class, 'certificates'])->name('certificates');
Route::get('/certificates/{certificate}/view', [SiteController::class, 'viewCertificate'])->name('certificates.view');
Route::get('/blog', [SiteController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [SiteController::class, 'blogPost'])->name('blog.show');
Route::get('/contact', [SiteController::class, 'contact'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    // Auth Routes
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    // Protected Admin Routes
    Route::middleware(['auth', 'admin'])->group(function () {
        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Products
        Route::resource('products', ProductController::class);
        Route::post('/products/{product}/set-primary/{image}', [ProductController::class, 'setPrimary'])->name('products.set-primary');

        // Blog Posts
        Route::resource('blog', BlogController::class)->parameters(['blog' => 'post']);

        // Certificates
        Route::resource('certificates', CertificateController::class)->except(['show']);

        // Admin-only routes
        Route::middleware('admin.only')->group(function () {
            // Profile Settings
            Route::get('/profile', [AuthController::class, 'showProfile'])->name('profile');
            Route::put('/profile', [AuthController::class, 'updateProfile'])->name('profile.update');

            // Product Categories
            Route::resource('product-categories', ProductCategoryController::class)->except(['show']);

            // Blog Categories
            Route::resource('blog-categories', BlogCategoryController::class)->except(['show']);

            // Enquiries
            Route::get('/enquiries', [EnquiryController::class, 'index'])->name('enquiries.index');
            Route::get('/enquiries/{id}', [EnquiryController::class, 'show'])->name('enquiries.show');
            Route::delete('/enquiries/{id}', [EnquiryController::class, 'destroy'])->name('enquiries.destroy');
            Route::patch('/enquiries/{id}/read', [EnquiryController::class, 'markAsRead'])->name('enquiries.read');

            // Staff Users
            Route::resource('staff-users', StaffUserController::class)->except(['show']);
        });
    });
});
