<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Frontend\FrontendController;

Route::get('/', [FrontendController::class, 'index'])->name('home');
Route::get('/about', [FrontendController::class, 'about'])->name('about');
Route::get('/contact', [FrontendController::class, 'contact'])->name('contact');
Route::get('/products', [FrontendController::class, 'products'])->name('frontend.products');
Route::get('/product/{slug}', [FrontendController::class, 'productDetails'])->name('frontend.product_details');
Route::get('/recipes', [FrontendController::class, 'recipes'])->name('recipes');
Route::get('/cart', [FrontendController::class, 'cart'])->name('cart');
Route::get('/checkout', [FrontendController::class, 'checkout'])->name('checkout');
Route::get('/blog', [FrontendController::class, 'blog'])->name('blog');
Route::get('/blog/{slug}', [FrontendController::class, 'blogDetails'])->name('blog.details');
Route::get('/page/{slug}', [FrontendController::class, 'page'])->name('page.details');



require __DIR__.'/auth.php';
