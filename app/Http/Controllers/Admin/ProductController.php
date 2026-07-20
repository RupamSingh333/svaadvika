<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\ProductImage;
use App\Models\Tax;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with(['category', 'featuredImage'])->latest()->get();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $taxes = Tax::where('status', 'active')->get();
        return view('admin.products.create', compact('categories', 'taxes'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'tax_id' => 'nullable|exists:taxes,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products',
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_out_of_stock' => 'boolean',
            'status' => 'required|in:active,draft',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'ingredients' => 'nullable|string',
            'weight' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'kit_items' => 'nullable|array',
            'features' => 'nullable|array',
            'ingredients_list' => 'nullable|array',
            'nutrition_info' => 'nullable|array',
            'faqs' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Clean up arrays to remove empty items
        if (isset($validated['kit_items'])) {
            $validated['kit_items'] = array_values(array_filter($validated['kit_items']));
        }
        if (isset($validated['features'])) {
            $validated['features'] = array_values(array_filter($validated['features'], function($item) {
                return !empty($item['title']) || !empty($item['icon']);
            }));
        }
        if (isset($validated['ingredients_list'])) {
            $validated['ingredients_list'] = array_values(array_filter($validated['ingredients_list'], function($item) {
                return !empty($item['name']);
            }));
        }
        if (isset($validated['nutrition_info'])) {
            $validated['nutrition_info'] = array_values(array_filter($validated['nutrition_info'], function($item) {
                return !empty($item['name']);
            }));
        }
        if (isset($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], function($item) {
                return !empty($item['question']) && !empty($item['answer']);
            }));
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_out_of_stock'] = $request->has('is_out_of_stock');
        
        $product = Product::create($validated);
        
        if ($request->hasFile('featured_image')) {
            $path = $request->file('featured_image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_featured' => true
            ]);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_featured' => false
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully');
    }

    public function edit(Product $product)
    {
        $categories = Category::all();
        $taxes = Tax::where('status', 'active')->get();
        $product->load('images', 'featuredImage', 'tax');
        return view('admin.products.edit', compact('product', 'categories', 'taxes'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'category_id' => 'required|exists:categories,id',
            'tax_id' => 'nullable|exists:taxes,id',
            'name' => 'required|string|max:255',
            'sku' => 'required|string|max:255|unique:products,sku,'.$product->id,
            'short_description' => 'nullable|string',
            'long_description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|min:0',
            'stock_quantity' => 'required|integer|min:0',
            'is_featured' => 'boolean',
            'is_out_of_stock' => 'boolean',
            'status' => 'required|in:active,draft',
            'rating' => 'nullable|numeric|min:0|max:5',
            'reviews_count' => 'nullable|integer|min:0',
            'ingredients' => 'nullable|string',
            'weight' => 'nullable|string|max:255',
            'featured_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'video_url' => 'nullable|url',
            'kit_items' => 'nullable|array',
            'features' => 'nullable|array',
            'ingredients_list' => 'nullable|array',
            'nutrition_info' => 'nullable|array',
            'faqs' => 'nullable|array',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
        ]);

        // Clean up arrays to remove empty items
        if (isset($validated['kit_items'])) {
            $validated['kit_items'] = array_values(array_filter($validated['kit_items']));
        }
        if (isset($validated['features'])) {
            $validated['features'] = array_values(array_filter($validated['features'], function($item) {
                return !empty($item['title']) || !empty($item['icon']);
            }));
        }
        if (isset($validated['ingredients_list'])) {
            $validated['ingredients_list'] = array_values(array_filter($validated['ingredients_list'], function($item) {
                return !empty($item['name']);
            }));
        }
        if (isset($validated['nutrition_info'])) {
            $validated['nutrition_info'] = array_values(array_filter($validated['nutrition_info'], function($item) {
                return !empty($item['name']);
            }));
        }
        if (isset($validated['faqs'])) {
            $validated['faqs'] = array_values(array_filter($validated['faqs'], function($item) {
                return !empty($item['question']) && !empty($item['answer']);
            }));
        }

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_featured'] = $request->has('is_featured');
        $validated['is_out_of_stock'] = $request->has('is_out_of_stock');
        
        $product->update($validated);
        
        if ($request->hasFile('featured_image')) {
            // Optional: remove old featured image
            $oldFeatured = $product->featuredImage;
            if ($oldFeatured) {
                Storage::disk('public')->delete($oldFeatured->image_path);
                $oldFeatured->delete();
            }

            $path = $request->file('featured_image')->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_featured' => true
            ]);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $path = $image->store('products', 'public');
                ProductImage::create([
                    'product_id' => $product->id,
                    'image_path' => $path,
                    'is_featured' => false
                ]);
            }
        }
        
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    public function destroy(Product $product)
    {
        // Delete all associated images from storage
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->image_path);
        }
        
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully');
    }

    public function destroyImage(ProductImage $productImage)
    {
        Storage::disk('public')->delete($productImage->image_path);
        $productImage->delete();
        
        return back()->with('success', 'Image deleted successfully');
    }

    public function updateStock(Request $request, Product $product)
    {
        $request->validate([
            'stock_quantity' => 'required|integer|min:0'
        ]);

        $product->stock_quantity = $request->stock_quantity;
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Stock updated successfully for ' . $product->name);
    }

    public function toggleOutOfStock(Product $product)
    {
        $product->is_out_of_stock = !$product->is_out_of_stock;
        
        // Prevent the booted saving event from resetting is_out_of_stock back to false immediately if stock > 0
        // We will save quietly if we want to bypass events, but the event only sets true if stock <= 0.
        // It doesn't set it to false if stock > 0 in my last update.
        $product->save();

        return redirect()->route('admin.products.index')->with('success', 'Out of stock status updated for ' . $product->name);
    }

    public function toggleFeatured(Product $product)
    {
        $product->is_featured = !$product->is_featured;
        $product->save();
        return back()->with('success', 'Featured status updated for ' . $product->name);
    }

    public function toggleStatus(Product $product)
    {
        $product->status = $product->status == 'active' ? 'draft' : 'active';
        $product->save();
        return back()->with('success', 'Status updated for ' . $product->name);
    }
}
