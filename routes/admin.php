<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\AdminAuthController;

// Admin Auth Routes (Guest)
Route::middleware('guest:web')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
});

// Admin Logout
Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout')->middleware('auth');

Route::middleware(['auth', \App\Http\Middleware\CheckUserPermission::class])->group(function () {
    Route::get('/', function () {
        return redirect()->route('admin.dashboard');
    });
    
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Settings
    Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');

    // Categories
    Route::post('categories/{category}/toggle-featured', [\App\Http\Controllers\Admin\CategoryController::class, 'toggleFeatured'])->name('categories.toggle-featured');
    Route::resource('categories', \App\Http\Controllers\Admin\CategoryController::class)->except(['show']);

    // Customers
    Route::resource('customers', \App\Http\Controllers\Admin\CustomerController::class)->only(['index', 'show', 'destroy']);
    Route::post('customers/{customer}/toggle-block', [\App\Http\Controllers\Admin\CustomerController::class, 'toggleBlock'])->name('customers.toggle-block');

    // Users
    Route::get('users/{user}/permissions', [\App\Http\Controllers\Admin\UserController::class, 'permissions'])->name('users.permissions');
    Route::post('users/{user}/permissions', [\App\Http\Controllers\Admin\UserController::class, 'updatePermissions'])->name('users.permissions.update');
    Route::resource('users', \App\Http\Controllers\Admin\UserController::class)->except(['show']);

    // Recipes
    Route::resource('recipes', \App\Http\Controllers\Admin\RecipeController::class)->except(['show']);

    // Products
    Route::resource('products', \App\Http\Controllers\Admin\ProductController::class)->except(['show']);
    Route::delete('product-images/{productImage}', [\App\Http\Controllers\Admin\ProductController::class, 'destroyImage'])->name('product-images.destroy');

    // Orders
    Route::resource('orders', \App\Http\Controllers\Admin\OrderController::class)->only(['index', 'show', 'update']);

    // Coupons
    Route::resource('coupons', \App\Http\Controllers\Admin\CouponController::class)->except(['show']);

    // Posts / CMS
    Route::resource('posts', \App\Http\Controllers\Admin\PostController::class)->except(['show']);

    // Audit Logs
    Route::get('audit-logs', [\App\Http\Controllers\Admin\AuditLogController::class, 'index'])->name('audit-logs.index');
    Route::get('audit-logs/{auditLog}', [\App\Http\Controllers\Admin\AuditLogController::class, 'show'])->name('audit-logs.show');

    // Contact Inquiries
    Route::resource('contacts', \App\Http\Controllers\Admin\ContactController::class)->only(['index', 'show', 'destroy']);
});
