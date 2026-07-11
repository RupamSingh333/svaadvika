<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\SettingController;

Route::middleware(['auth', \App\Http\Middleware\CheckUserPermission::class])->group(function () {
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
});
