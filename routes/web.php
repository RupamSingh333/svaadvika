<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::post('/contact', [\App\Http\Controllers\Frontend\ContactController::class, 'store'])->name('contact.store');
Route::get('/products', [FrontendController::class, 'products'])->name('frontend.products');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('frontend.product_details');
Route::get('/recipes', [FrontendController::class, 'recipes'])->name('recipes');
Route::get('/recipe/{slug}', [FrontendController::class, 'recipeDetails'])->name('recipe_details');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');

Route::middleware('auth:customer')->prefix('customer')->name('customer.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\Frontend\CustomerDashboardController::class, 'dashboard'])->name('dashboard');
    Route::post('/profile/update', [\App\Http\Controllers\Frontend\CustomerDashboardController::class, 'updateProfile'])->name('profile.update');
    Route::post('/address/store', [\App\Http\Controllers\Frontend\CustomerDashboardController::class, 'storeAddress'])->name('address.store');
    Route::delete('/address/{address}', [\App\Http\Controllers\Frontend\CustomerDashboardController::class, 'destroyAddress'])->name('address.destroy');
});

require __DIR__.'/auth.php';
