<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Recipe;

class RecipeController extends Controller
{
    public function index(Request $request)
    {
        $query = Recipe::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $recipes = $query->latest()->paginate(10);
        
        $categories = ['Biryani', 'Starters', 'Main Course', 'Snacks', 'Rice', 'Desserts', 'Drinks'];
        
        return view('admin.recipes.index', compact('recipes', 'categories'));
    }

    public function create()
    {
        $categories = ['Biryani', 'Starters', 'Main Course', 'Snacks', 'Rice', 'Desserts', 'Drinks'];
        $difficulties = ['Easy', 'Medium', 'Hard'];
        $dietTypes = ['Vegetarian', 'Non-Vegetarian', 'Vegan'];
        $spiceLevels = ['Mild', 'Medium', 'Hot'];
        $statuses = ['Draft', 'Published', 'Featured'];

        return view('admin.recipes.create', compact('categories', 'difficulties', 'dietTypes', 'spiceLevels', 'statuses'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'featured_image' => 'required|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
            'youtube_url' => 'nullable|url',
            'category' => 'required|in:Biryani,Starters,Main Course,Snacks,Rice,Desserts,Drinks',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'diet_type' => 'required|in:Vegetarian,Non-Vegetarian,Vegan',
            'spice_level' => 'required|in:Mild,Medium,Hot',
            'duration' => 'required|string|max:255',
            'status' => 'required|in:Draft,Published,Featured',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'schema_markup' => 'nullable|string',
        ]);

        $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);

        if ($request->hasFile('featured_image')) {
            $validated['featured_image'] = $request->file('featured_image')->store('recipes', 'public');
        }

        $galleryImages = [];
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('recipes', 'public');
            }
        }
        $validated['gallery_images'] = $galleryImages;

        Recipe::create($validated);

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe created successfully');
    }

    public function edit(Recipe $recipe)
    {
        $categories = ['Biryani', 'Starters', 'Main Course', 'Snacks', 'Rice', 'Desserts', 'Drinks'];
        $difficulties = ['Easy', 'Medium', 'Hard'];
        $dietTypes = ['Vegetarian', 'Non-Vegetarian', 'Vegan'];
        $spiceLevels = ['Mild', 'Medium', 'Hot'];
        $statuses = ['Draft', 'Published', 'Featured'];

        return view('admin.recipes.edit', compact('recipe', 'categories', 'difficulties', 'dietTypes', 'spiceLevels', 'statuses'));
    }

    public function update(Request $request, Recipe $recipe)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'featured_image' => 'nullable|image|max:2048',
            'gallery_images.*' => 'nullable|image|max:2048',
            'youtube_url' => 'nullable|url',
            'category' => 'required|in:Biryani,Starters,Main Course,Snacks,Rice,Desserts,Drinks',
            'difficulty' => 'required|in:Easy,Medium,Hard',
            'diet_type' => 'required|in:Vegetarian,Non-Vegetarian,Vegan',
            'spice_level' => 'required|in:Mild,Medium,Hot',
            'duration' => 'required|string|max:255',
            'status' => 'required|in:Draft,Published,Featured',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
            'meta_keywords' => 'nullable|string',
            'schema_markup' => 'nullable|string',
        ]);

        if ($request->title !== $recipe->title) {
            $validated['slug'] = \Illuminate\Support\Str::slug($validated['title']);
        }

        if ($request->hasFile('featured_image')) {
            if ($recipe->featured_image) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($recipe->featured_image);
            }
            $validated['featured_image'] = $request->file('featured_image')->store('recipes', 'public');
        }

        $galleryImages = $recipe->gallery_images ?? [];
        
        // Handle deletion of old images if needed - assuming simple append for now or replace
        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $image) {
                $galleryImages[] = $image->store('recipes', 'public');
            }
        }
        $validated['gallery_images'] = $galleryImages;

        $recipe->update($validated);

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe updated successfully');
    }

    public function destroy(Recipe $recipe)
    {
        if ($recipe->featured_image) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($recipe->featured_image);
        }
        
        if (!empty($recipe->gallery_images)) {
            foreach ($recipe->gallery_images as $img) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($img);
            }
        }

        $recipe->delete();

        return redirect()->route('admin.recipes.index')->with('success', 'Recipe deleted successfully');
    }
}
