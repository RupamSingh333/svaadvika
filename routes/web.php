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

// Cart and Wishlist API Routes (Public/Session based)
Route::prefix('api')->name('api.')->group(function () {
    Route::get('/cart/count', [\App\Http\Controllers\Frontend\CartController::class, 'getCount'])->name('cart.count');
    Route::post('/cart/add', [\App\Http\Controllers\Frontend\CartController::class, 'add'])->name('cart.add');
    Route::post('/cart/update', [\App\Http\Controllers\Frontend\CartController::class, 'update'])->name('cart.update');
    Route::post('/cart/remove', [\App\Http\Controllers\Frontend\CartController::class, 'remove'])->name('cart.remove');

    Route::get('/wishlist/count', [\App\Http\Controllers\Frontend\WishlistController::class, 'getCount'])->name('wishlist.count');
    Route::post('/wishlist/toggle', [\App\Http\Controllers\Frontend\WishlistController::class, 'toggle'])->name('wishlist.toggle');
});

require __DIR__.'/auth.php';
