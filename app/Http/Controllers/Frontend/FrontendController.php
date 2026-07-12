<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;

class FrontendController extends Controller
{
    public function index()
    {
        $categories = Category::where('parent_id', null)->get();
        $featuredProducts = Product::where('status', 'active')
                                   ->where('is_featured', true)
                                   ->take(4)
                                   ->get();
                                   
        return view('frontend.pages.home', compact('categories', 'featuredProducts'));
    }

    public function about()
    {
        return view('frontend.pages.about_us');
    }

    public function contact()
    {
        return view('frontend.pages.contact_us');
    }

    public function products()
    {
        $products = Product::with(['category', 'images', 'featuredImage'])->where('status', 'active')->get();
        
        $formattedProducts = $products->map(function ($product, $index) {
            $discount = '';
            if ($product->sale_price && $product->price > $product->sale_price) {
                $discount = round((($product->price - $product->sale_price) / $product->price) * 100) . '%';
            }

            $imageUrl = 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85';
            if ($product->featuredImage) {
                $imageUrl = asset('storage/' . $product->featuredImage->image_path);
            } elseif ($product->images->isNotEmpty()) {
                $imageUrl = asset('storage/' . $product->images->first()->image_path);
            }

            $imagesArray = $product->images->map(function($img) use ($product) {
                return [
                    'src' => asset('storage/' . $img->image_path),
                    'label' => 'Product Image',
                    'alt' => $product->name
                ];
            })->toArray();
            
            if (empty($imagesArray)) {
                $imagesArray = [[
                    'src' => $imageUrl,
                    'label' => 'Default Image',
                    'alt' => $product->name
                ]];
            }

            return [
                'id' => $product->slug,
                'category' => $product->category ? $product->category->slug : 'other',
                'title' => $product->name,
                'description' => $product->short_description ?? '',
                'rating' => (float) ($product->rating ?? 4.5),
                'reviews' => (int) ($product->reviews_count ?? 120),
                'price' => (float) ($product->sale_price ?: $product->price),
                'oldPrice' => (float) $product->price,
                'discount' => $discount ? $discount . ' Off' : '',
                'stock' => !$product->is_out_of_stock && $product->stock_quantity > 0,
                'newest' => $index,
                'image' => $imageUrl,
                'images' => $imagesArray,
                'ingredients' => $product->ingredients ?? 'premium spices, herbs and recipe base',
                'weight' => $product->weight ?? '250g pack'
            ];
        });

        // We also need regular pagination if the view uses it, but the JS handles its own pagination.
        $paginatedProducts = Product::with(['category', 'images', 'featuredImage'])->where('status', 'active')->paginate(12);

        $categories = \App\Models\Category::where('is_active', true)->get();

        return view('frontend.pages.new_product', [
            'products' => $paginatedProducts,
            'jsProducts' => $formattedProducts,
            'categories' => $categories
        ]);
    }

    public function productDetails($slug)
    {
        $product = Product::with(['category', 'images', 'featuredImage'])->where('slug', $slug)->firstOrFail();
        $relatedProducts = Product::with(['category', 'images', 'featuredImage'])
                                  ->where('category_id', $product->category_id)
                                  ->where('id', '!=', $product->id)
                                  ->where('status', 'active')
                                  ->take(4)
                                  ->get();
                                  
        $formatProduct = function ($prod, $idx = 0) {
            $discount = '';
            if ($prod->sale_price && $prod->price > $prod->sale_price) {
                $discount = round((($prod->price - $prod->sale_price) / $prod->price) * 100) . '%';
            }
            $imageUrl = 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85';
            if ($prod->featuredImage) {
                $imageUrl = asset('storage/' . $prod->featuredImage->image_path);
            } elseif ($prod->images->isNotEmpty()) {
                $imageUrl = asset('storage/' . $prod->images->first()->image_path);
            }
            $imagesArray = $prod->images->map(function($img) use ($prod) {
                return ['src' => asset('storage/' . $img->image_path), 'label' => 'Product Image', 'alt' => $prod->name];
            })->toArray();
            if (empty($imagesArray)) {
                $imagesArray = [['src' => $imageUrl, 'label' => 'Default Image', 'alt' => $prod->name]];
            }
            return [
                'id' => $prod->slug,
                'category' => $prod->category ? $prod->category->slug : 'other',
                'title' => $prod->name,
                'description' => $prod->short_description ?? '',
                'rating' => (float) ($prod->rating ?? 4.5),
                'reviews' => (int) ($prod->reviews_count ?? 120),
                'price' => (float) ($prod->sale_price ?: $prod->price),
                'oldPrice' => (float) $prod->price,
                'discount' => $discount ? $discount . ' Off' : '',
                'stock' => !$prod->is_out_of_stock && $prod->stock_quantity > 0,
                'newest' => $idx,
                'image' => $imageUrl,
                'images' => $imagesArray,
                'ingredients' => $prod->ingredients ?? 'premium spices, herbs and recipe base',
                'weight' => $prod->weight ?? '250g pack'
            ];
        };

        $jsProduct = $formatProduct($product);
        $jsRelatedProducts = $relatedProducts->map(function($p, $i) use ($formatProduct) { return $formatProduct($p, $i); })->toArray();

        return view('frontend.pages.product_details', compact('product', 'relatedProducts', 'jsProduct', 'jsRelatedProducts'));
    }

    public function recipeDetails($slug)
    {
        $recipe = \App\Models\Recipe::where('slug', $slug)
            ->whereIn('status', ['Published', 'Featured'])
            ->firstOrFail();

        $relatedRecipes = \App\Models\Recipe::where('category', $recipe->category)
            ->where('id', '!=', $recipe->id)
            ->whereIn('status', ['Published', 'Featured'])
            ->inRandomOrder()
            ->take(3)
            ->get();

        return view('frontend.pages.recipe_details', compact('recipe', 'relatedRecipes'));
    }

    public function recipes(Request $request)
    {
        $query = \App\Models\Recipe::whereIn('status', ['Published', 'Featured']);

        if ($request->filled('search')) {
            $query->where(function($q) use ($request) {
                $q->where('title', 'like', '%' . $request->search . '%')
                  ->orWhere('category', 'like', '%' . $request->search . '%')
                  ->orWhere('ingredients', 'like', '%' . $request->search . '%');
            });
        }

        if ($request->filled('category') && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->filled('difficulty')) {
            $query->whereIn('difficulty', (array) $request->difficulty);
        }

        if ($request->filled('diet_type')) {
            $query->whereIn('diet_type', (array) $request->diet_type);
        }

        $sort = $request->get('sort', 'latest');
        switch ($sort) {
            case 'az':
                $query->orderBy('title', 'asc');
                break;
            case 'newest':
            case 'latest':
                $query->latest();
                break;
        }

        $recipes = $query->paginate(12)->withQueryString();

        $categories = \App\Models\Recipe::whereIn('status', ['Published', 'Featured'])->distinct()->pluck('category')->filter()->toArray();
        $dietTypes = ['Vegetarian', 'Non-Vegetarian', 'Vegan'];
        $difficulties = ['Easy', 'Medium', 'Hard'];

        return view('frontend.pages.recipes', compact('recipes', 'categories', 'dietTypes', 'difficulties'));
    }

    public function cart()
    {
        $cartItems = collect();
        if (\Illuminate\Support\Facades\Auth::guard('customer')->check()) {
            $cart = \App\Models\Cart::with(['items.product'])->where('customer_id', \Illuminate\Support\Facades\Auth::guard('customer')->id())->first();
        } else {
            $cart = \App\Models\Cart::with(['items.product'])->where('session_id', session()->getId())->first();
        }
        
        if ($cart) {
            $cartItems = $cart->items;
        }

        $deliverySettings = \App\Models\DeliverySetting::first();

        return view('frontend.pages.cart', compact('cartItems', 'deliverySettings'));
    }

    public function checkout()
    {
        $cartItems = collect();
        if (\Illuminate\Support\Facades\Auth::guard('customer')->check()) {
            $cart = \App\Models\Cart::with(['items.product'])->where('customer_id', \Illuminate\Support\Facades\Auth::guard('customer')->id())->first();
        } else {
            $cart = \App\Models\Cart::with(['items.product'])->where('session_id', session()->getId())->first();
        }
        
        if ($cart) {
            $cartItems = $cart->items;
        }

        $deliverySettings = \App\Models\DeliverySetting::first();
        return view('frontend.pages.checkout', compact('cartItems', 'deliverySettings'));
    }


}
