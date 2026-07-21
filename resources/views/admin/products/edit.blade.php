@extends('admin.layouts.master')

@section('title', 'Edit Product')
@section('page_title', 'Edit Product')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="row">
                <!-- Main Info -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Product Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Product Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Short Description</label>
                                <textarea name="short_description" class="form-control richtext @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description', $product->short_description) }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Long Description</label>
                                <textarea name="long_description" class="form-control richtext @error('long_description') is-invalid @enderror" rows="6">{{ old('long_description', $product->long_description) }}</textarea>
                                @error('long_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <!-- <div class="mb-4">
                                <label class="form-label fw-semibold">Ingredients</label>
                                <textarea name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" rows="3">{{ old('ingredients', $product->ingredients) }}</textarea>
                                @error('ingredients')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div> -->
                        </div>
                    </div>
                    
                    <!-- Dynamic Content -->
                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Dynamic Details</h5>
                        </div>
                        <div class="card-body p-4">
                            <!-- Video URL -->
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Video URL</label>
                                <input type="url" name="video_url" id="videoUrlInput" class="form-control" placeholder="YouTube, Instagram, or MP4 Video Link" value="{{ old('video_url', $product->video_url) }}">
                                <div id="videoPreviewContainer" class="mt-3" style="display: none; border-radius: 8px; overflow: hidden; background: #000; width: 100%; max-width: 500px;"></div>
                            </div>

                            <hr class="my-4">

                            <!-- Kit Items -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">What's Inside the Kit?</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addKitItem()">+ Add Item</button>
                                </div>
                                <div id="kitItemsContainer">
                                    @php $kitItems = old('kit_items', $product->kit_items ?? []); @endphp
                                    @foreach($kitItems as $item)
                                    <div class="input-group mb-2 kit-item-row">
                                        <input type="text" name="kit_items[]" class="form-control" placeholder="e.g. Basmati Rice" value="{{ $item }}">
                                        <button type="button" class="btn btn-outline-danger" onclick="this.closest('.kit-item-row').remove()"><i class="fa fa-trash"></i></button>
                                    </div>
                                    @endforeach
                                    @if(empty($kitItems))
                                    <div class="input-group mb-2 kit-item-row">
                                        <input type="text" name="kit_items[]" class="form-control" placeholder="e.g. Basmati Rice">
                                        <button type="button" class="btn btn-outline-danger" onclick="this.closest('.kit-item-row').remove()"><i class="fa fa-trash"></i></button>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Features -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">Features (Icon Strip)</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFeature()">+ Add Feature</button>
                                </div>
                                <div id="featuresContainer">
                                    @php $features = old('features', $product->features ?? []); $featureCount = 0; @endphp
                                    @foreach($features as $feature)
                                    <div class="row g-2 mb-2 feature-row">
                                        <div class="col-md-3">
                                            <input type="text" name="features[{{ $featureCount }}][icon]" class="form-control" placeholder="Icon class" value="{{ $feature['icon'] ?? '' }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="features[{{ $featureCount }}][title]" class="form-control" placeholder="Title" value="{{ $feature['title'] ?? '' }}">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="features[{{ $featureCount }}][subtitle]" class="form-control" placeholder="Subtitle" value="{{ $feature['subtitle'] ?? '' }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.feature-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @php $featureCount++; @endphp
                                    @endforeach
                                    @if(empty($features))
                                    <div class="row g-2 mb-2 feature-row">
                                        <div class="col-md-3">
                                            <input type="text" name="features[0][icon]" class="form-control" placeholder="Icon class (e.g. bi bi-fire)">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="features[0][title]" class="form-control" placeholder="Title (e.g. Authentic Recipe)">
                                        </div>
                                        <div class="col-md-4">
                                            <input type="text" name="features[0][subtitle]" class="form-control" placeholder="Subtitle (e.g. Traditional flavours)">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.feature-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Ingredients (with Icon) -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">Ingredients List</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addIngredient()">+ Add Ingredient</button>
                                </div>
                                <div id="ingredientsContainer">
                                    @php $ingredientsList = old('ingredients_list', $product->ingredients_list ?? []); $ingredientCount = 0; @endphp
                                    @foreach($ingredientsList as $ingredient)
                                    <div class="row g-2 mb-2 ingredient-row">
                                        <div class="col-md-4">
                                            <input type="text" name="ingredients_list[{{ $ingredientCount }}][icon]" class="form-control" placeholder="Icon class" value="{{ $ingredient['icon'] ?? '' }}">
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="ingredients_list[{{ $ingredientCount }}][name]" class="form-control" placeholder="Ingredient Name" value="{{ $ingredient['name'] ?? '' }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.ingredient-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @php $ingredientCount++; @endphp
                                    @endforeach
                                    @if(empty($ingredientsList))
                                    <div class="row g-2 mb-2 ingredient-row">
                                        <div class="col-md-4">
                                            <input type="text" name="ingredients_list[0][icon]" class="form-control" placeholder="Icon class (e.g. bi bi-circle)">
                                        </div>
                                        <div class="col-md-7">
                                            <input type="text" name="ingredients_list[0][name]" class="form-control" placeholder="Ingredient Name">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.ingredient-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Nutrition Information -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">Nutrition Information</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addNutrition()">+ Add Nutrition Info</button>
                                </div>
                                <div id="nutritionContainer">
                                    @php $nutritionInfo = old('nutrition_info', $product->nutrition_info ?? []); $nutritionCount = 0; @endphp
                                    @foreach($nutritionInfo as $nutrition)
                                    <div class="row g-2 mb-2 nutrition-row">
                                        <div class="col-md-5">
                                            <input type="text" name="nutrition_info[{{ $nutritionCount }}][name]" class="form-control" placeholder="Name" value="{{ $nutrition['name'] ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="nutrition_info[{{ $nutritionCount }}][value]" class="form-control" placeholder="Value" value="{{ $nutrition['value'] ?? '' }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.nutrition-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @php $nutritionCount++; @endphp
                                    @endforeach
                                    @if(empty($nutritionInfo))
                                    <div class="row g-2 mb-2 nutrition-row">
                                        <div class="col-md-5">
                                            <input type="text" name="nutrition_info[0][name]" class="form-control" placeholder="Name (e.g. Energy)">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="nutrition_info[0][value]" class="form-control" placeholder="Value (e.g. 350 kcal)">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.nutrition-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>

                            <hr class="my-4">

                            <!-- Frequently Asked Questions (FAQ) -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">Frequently Asked Questions</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addFaq()">+ Add FAQ</button>
                                </div>
                                <div id="faqsContainer">
                                    @php $faqs = old('faqs', $product->faqs ?? []); $faqCount = 0; @endphp
                                    @foreach($faqs as $faq)
                                    <div class="row g-2 mb-2 faq-row">
                                        <div class="col-md-5">
                                            <input type="text" name="faqs[{{ $faqCount }}][question]" class="form-control" placeholder="Question" value="{{ $faq['question'] ?? '' }}">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="faqs[{{ $faqCount }}][answer]" class="form-control" placeholder="Answer" value="{{ $faq['answer'] ?? '' }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.faq-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @php $faqCount++; @endphp
                                    @endforeach
                                    @if(empty($faqs))
                                    <div class="row g-2 mb-2 faq-row">
                                        <div class="col-md-5">
                                            <input type="text" name="faqs[0][question]" class="form-control" placeholder="Question">
                                        </div>
                                        <div class="col-md-6">
                                            <input type="text" name="faqs[0][answer]" class="form-control" placeholder="Answer">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.faq-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Pricing & Inventory</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Regular Price (₹) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
                                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Sale Price (₹)</label>
                                    <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price', $product->sale_price) }}">
                                    @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">SKU <span class="text-danger">*</span></label>
                                    <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku) }}" required>
                                    @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity', $product->stock_quantity) }}" required>
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 me-2" type="checkbox" name="is_out_of_stock" value="1" {{ old('is_out_of_stock', $product->is_out_of_stock) ? 'checked' : '' }} aria-label="Mark as Out of Stock Manually">
                                            <span style="font-size: 0.85rem;">Out of Stock</span>
                                        </div>
                                    </div>
                                    @error('stock_quantity')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Rating (0-5)</label>
                                    <input type="number"  min="0" max="5" step="0.1" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $product->rating) }}">
                                    @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Reviews Count</label>
                                    <input type="number" name="reviews_count" class="form-control @error('reviews_count') is-invalid @enderror" value="{{ old('reviews_count', $product->reviews_count) }}">
                                    @error('reviews_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Weight</label>
                                    <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight', $product->weight) }}" placeholder="e.g. 250g pack">
                                    @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Search Engine Optimization (SEO)</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Meta Title</label>
                                <input type="text" name="meta_title" class="form-control @error('meta_title') is-invalid @enderror" value="{{ old('meta_title', $product->meta_title) }}" placeholder="Leave blank to auto-generate from product name">
                                @error('meta_title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Meta Description</label>
                                <textarea name="meta_description" class="form-control @error('meta_description') is-invalid @enderror" rows="3" placeholder="Leave blank to auto-generate from product description">{{ old('meta_description', $product->meta_description) }}</textarea>
                                @error('meta_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Meta Keywords</label>
                                <input type="text" name="meta_keywords" class="form-control @error('meta_keywords') is-invalid @enderror" value="{{ old('meta_keywords', $product->meta_keywords) }}" placeholder="e.g. biryani, ready to cook, indian food">
                                @error('meta_keywords')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Schema Markup (JSON-LD)</label>
                                <textarea name="schema_markup" class="form-control @error('schema_markup') is-invalid @enderror" rows="4" placeholder='<script type="application/ld+json">{...}</script>'>{{ old('schema_markup', $product->schema_markup) }}</textarea>
                                @error('schema_markup')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <small class="text-muted d-block mt-1">Add structured data for rich snippets in search engines.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Publishing & Media</h5>
                        </div>
                        <div class="card-body p-4">
                            @if($product->featuredImage)
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Current Featured Image</label>
                                <div class="position-relative d-inline-block">
                                    <img src="{{ Storage::url($product->featuredImage->image_path) }}" alt="Featured" class="img-thumbnail" style="max-height: 150px;">
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 shadow-sm" onclick="confirmFormSubmit(event, document.getElementById(''), '')">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </div>
                            </div>
                            @endif
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Update Featured Image</label>
                                <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">Upload a new image to replace the current featured image.</small>
                                @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            @if($product->images->where('is_featured', false)->count() > 0)
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Current Gallery Images</label>
                                <div class="d-flex flex-wrap gap-2">
                                    @foreach($product->images->where('is_featured', false) as $image)
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ Storage::url($image->image_path) }}" alt="Gallery" class="img-thumbnail" style="max-height: 80px;">
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 shadow-sm px-1 py-0" style="font-size: 0.7rem;" onclick="confirmFormSubmit(event, document.getElementById(''), '')">
                                            <i class="fa-solid fa-xmark"></i>
                                        </button>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                            @endif
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Add Gallery Images</label>
                                <input type="file" name="gallery_images[]" class="form-control @error('gallery_images.*') is-invalid @enderror" accept="image/*" multiple>
                                <small class="text-muted">Select multiple images to add to the product gallery.</small>
                                @error('gallery_images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <hr class="my-4">

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('status', $product->status) == 'active' ? 'selected' : '' }}>Active (Visible)</option>
                                    <option value="draft" {{ old('status', $product->status) == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Tax Settings</label>
                                <select name="tax_id" class="form-select @error('tax_id') is-invalid @enderror">
                                    <option value="">No Tax (0%)</option>
                                    @foreach($taxes as $tax)
                                        <option value="{{ $tax->id }}" {{ old('tax_id', $product->tax_id) == $tax->id ? 'selected' : '' }}>{{ $tax->name }} ({{ $tax->percentage }}%)</option>
                                    @endforeach
                                </select>
                                @error('tax_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch mb-2">
                                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeatured" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="isFeatured">Featured Product</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_out_of_stock" value="1" id="isOutOfStock" {{ old('is_out_of_stock', $product->is_out_of_stock) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold text-danger" for="isOutOfStock">Mark as Out of Stock</label>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i> Update Product</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-light border">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>

<!-- Image Delete Forms -->
@foreach($product->images as $image)
<form id="delete-image-{{ $image->id }}" action="{{ route('admin.product-images.destroy', $image->id) }}" method="POST" class="d-none">
    @csrf
    @method('DELETE')
</form>
@endforeach

@endsection

@push('scripts')
<script>
    let featureCount = {{ isset($featureCount) ? max(1, $featureCount) : 1 }};
    let ingredientCount = {{ isset($ingredientCount) ? max(1, $ingredientCount) : 1 }};
    let nutritionCount = {{ isset($nutritionCount) ? max(1, $nutritionCount) : 1 }};
    let faqCount = {{ isset($faqCount) ? max(1, $faqCount) : 1 }};

    function addKitItem() {
        const html = `
            <div class="input-group mb-2 kit-item-row">
                <input type="text" name="kit_items[]" class="form-control" placeholder="e.g. Basmati Rice">
                <button type="button" class="btn btn-outline-danger" onclick="this.closest('.kit-item-row').remove()"><i class="fa fa-trash"></i></button>
            </div>
        `;
        document.getElementById('kitItemsContainer').insertAdjacentHTML('beforeend', html);
    }

    function addFeature() {
        const html = `
            <div class="row g-2 mb-2 feature-row">
                <div class="col-md-3">
                    <input type="text" name="features[${featureCount}][icon]" class="form-control" placeholder="Icon class (e.g. bi bi-fire)">
                </div>
                <div class="col-md-4">
                    <input type="text" name="features[${featureCount}][title]" class="form-control" placeholder="Title (e.g. Authentic Recipe)">
                </div>
                <div class="col-md-4">
                    <input type="text" name="features[${featureCount}][subtitle]" class="form-control" placeholder="Subtitle (e.g. Traditional flavours)">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.feature-row').remove()"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        `;
        document.getElementById('featuresContainer').insertAdjacentHTML('beforeend', html);
        featureCount++;
    }

    function addIngredient() {
        const html = `
            <div class="row g-2 mb-2 ingredient-row">
                <div class="col-md-4">
                    <input type="text" name="ingredients_list[${ingredientCount}][icon]" class="form-control" placeholder="Icon class (e.g. bi bi-circle)">
                </div>
                <div class="col-md-7">
                    <input type="text" name="ingredients_list[${ingredientCount}][name]" class="form-control" placeholder="Ingredient Name">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.ingredient-row').remove()"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        `;
        document.getElementById('ingredientsContainer').insertAdjacentHTML('beforeend', html);
        ingredientCount++;
    }

    function addNutrition() {
        const html = `
            <div class="row g-2 mb-2 nutrition-row">
                <div class="col-md-5">
                    <input type="text" name="nutrition_info[${nutritionCount}][name]" class="form-control" placeholder="Name (e.g. Energy)">
                </div>
                <div class="col-md-6">
                    <input type="text" name="nutrition_info[${nutritionCount}][value]" class="form-control" placeholder="Value (e.g. 350 kcal)">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.nutrition-row').remove()"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        `;
        document.getElementById('nutritionContainer').insertAdjacentHTML('beforeend', html);
        nutritionCount++;
    }

    function addFaq() {
        const html = `
            <div class="row g-2 mb-2 faq-row">
                <div class="col-md-5">
                    <input type="text" name="faqs[${faqCount}][question]" class="form-control" placeholder="Question">
                </div>
                <div class="col-md-6">
                    <input type="text" name="faqs[${faqCount}][answer]" class="form-control" placeholder="Answer">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.faq-row').remove()"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        `;
        document.getElementById('faqsContainer').insertAdjacentHTML('beforeend', html);
        faqCount++;
    }

    // Video Preview Logic
    let videoInput = document.getElementById('videoUrlInput');
    function updateVideoPreview() {
        let url = videoInput.value.trim();
        let container = document.getElementById('videoPreviewContainer');
        
        if (!url) {
            container.style.display = 'none';
            container.innerHTML = '';
            return;
        }

        container.style.display = 'block';
        container.style.aspectRatio = '16/9';
        
        // YouTube
        let ytMatch = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/);
        if (ytMatch) {
            container.innerHTML = `<iframe width="100%" height="100%" src="https://www.youtube.com/embed/${ytMatch[1]}" frameborder="0" allowfullscreen></iframe>`;
            return;
        }

        // Instagram Reels/Posts
        if (url.includes('instagram.com')) {
            container.innerHTML = `<iframe width="100%" height="100%" src="${url}/embed" frameborder="0" scrolling="no" allowtransparency="true"></iframe>`;
            return;
        }

        // Direct Video
        if (url.match(/\.(mp4|webm|ogg)$/i)) {
            container.innerHTML = `<video width="100%" height="100%" controls style="object-fit:cover"><source src="${url}" type="video/mp4"></video>`;
            return;
        }

        // Fallback / Unknown
        container.innerHTML = `<div class="d-flex align-items-center justify-content-center h-100 text-white p-3 text-center">Cannot generate preview for this URL format.</div>`;
    }
    
    videoInput.addEventListener('input', updateVideoPreview);
    
    // Trigger on load if there's a value
    if (videoInput.value) {
        updateVideoPreview();
    }
</script>
@endpush
