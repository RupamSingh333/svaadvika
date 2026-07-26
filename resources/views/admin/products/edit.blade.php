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

                            <!-- <hr class="my-4"> -->

                            <!-- Kit Items -->
                            <!-- <div class="mb-4">
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
                            </div> -->

                            <!-- <hr class="my-4"> -->

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
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="{{ $feature['icon'] ?? 'bi bi-fire' }}"></i></span>
                                                <input type="text" name="features[{{ $featureCount }}][icon]" class="form-control px-2" placeholder="Icon class" value="{{ $feature['icon'] ?? '' }}" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                                                <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                                            </div>
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
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="bi bi-fire"></i></span>
                                                <input type="text" name="features[0][icon]" class="form-control px-2" placeholder="Icon class" value="bi bi-fire" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                                                <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                                            </div>
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
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="{{ $ingredient['icon'] ?? 'bi bi-circle' }}"></i></span>
                                                <input type="text" name="ingredients_list[{{ $ingredientCount }}][icon]" class="form-control px-2" placeholder="Icon class" value="{{ $ingredient['icon'] ?? '' }}" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                                                <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                                            </div>
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
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="bi bi-circle"></i></span>
                                                <input type="text" name="ingredients_list[0][icon]" class="form-control px-2" placeholder="Icon class" value="bi bi-circle" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                                                <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                                            </div>
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

                            <!-- Cooking Steps -->
                            <div class="mb-4">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label fw-semibold mb-0">Cooking Steps</label>
                                    <button type="button" class="btn btn-sm btn-outline-primary" onclick="addCookingStep()">+ Add Step</button>
                                </div>
                                <div id="cookingStepsContainer">
                                    @php $cookingSteps = old('cooking_steps', $product->cooking_steps ?? []); $cookingStepCount = 0; @endphp
                                    @foreach($cookingSteps as $step)
                                    <div class="row g-2 mb-2 cooking-step-row">
                                        <div class="col-md-3">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="{{ $step['icon'] ?? 'bi bi-hand-index' }}"></i></span>
                                                <input type="text" name="cooking_steps[{{ $cookingStepCount }}][icon]" class="form-control px-2" placeholder="Icon class" value="{{ $step['icon'] ?? '' }}" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                                                <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="cooking_steps[{{ $cookingStepCount }}][title]" class="form-control" placeholder="Step Title" value="{{ $step['title'] ?? '' }}">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="cooking_steps[{{ $cookingStepCount }}][description]" class="form-control" placeholder="Description" value="{{ $step['description'] ?? '' }}">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.cooking-step-row').remove()"><i class="fa fa-trash"></i></button>
                                        </div>
                                    </div>
                                    @php $cookingStepCount++; @endphp
                                    @endforeach
                                    @if(empty($cookingSteps))
                                    <div class="row g-2 mb-2 cooking-step-row">
                                        <div class="col-md-3">
                                            <div class="input-group input-group-sm">
                                                <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="bi bi-hand-index"></i></span>
                                                <input type="text" name="cooking_steps[0][icon]" class="form-control px-2" placeholder="Icon class" value="bi bi-hand-index" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                                                <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <input type="text" name="cooking_steps[0][title]" class="form-control" placeholder="Step Title (e.g. Marinate)">
                                        </div>
                                        <div class="col-md-5">
                                            <input type="text" name="cooking_steps[0][description]" class="form-control" placeholder="Description (e.g. Marinate meat...)">
                                        </div>
                                        <div class="col-md-1">
                                            <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.cooking-step-row').remove()"><i class="fa fa-trash"></i></button>
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
                                <!-- FUTURE USE: Manual rating overrides
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Rating (0-5)</label>
                                    <input type="number"  min="0" max="5" step="0.1" name="rating" class="form-control" value="{{ old('rating', $product->rating) }}">
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Reviews Count</label>
                                    <input type="number" name="reviews_count" class="form-control" value="{{ old('reviews_count', $product->reviews_count) }}">
                                </div>
                                -->
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


<!-- Icon Chooser Modal -->
<div class="modal fade" id="iconModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Choose an Icon</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="text" id="iconSearch" class="form-control mb-3" placeholder="Search icons...">
                <div class="row g-2" id="iconGrid">
                    <!-- Icons will be injected here via JS -->
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')

<script>
    let currentIconTarget = null;
    const icons = [
        'bi-activity', 'bi-alarm', 'bi-align-center', 'bi-align-left', 'bi-align-right', 'bi-archive', 'bi-arrow-clockwise', 'bi-arrow-counterclockwise', 'bi-arrow-down', 'bi-arrow-down-circle', 'bi-arrow-down-square', 'bi-arrow-left', 'bi-arrow-left-circle', 'bi-arrow-left-square', 'bi-arrow-right', 'bi-arrow-right-circle', 'bi-arrow-right-square', 'bi-arrow-up', 'bi-arrow-up-circle', 'bi-arrow-up-square', 'bi-arrows-angle-contract', 'bi-arrows-angle-expand', 'bi-arrows-collapse', 'bi-arrows-expand', 'bi-arrows-fullscreen', 'bi-arrows-move', 'bi-aspect-ratio', 'bi-asterisk', 'bi-at', 'bi-award', 'bi-backspace', 'bi-bag', 'bi-bag-check', 'bi-bag-dash', 'bi-bag-plus', 'bi-bag-x', 'bi-bandaid', 'bi-bank', 'bi-bar-chart', 'bi-bar-chart-line', 'bi-bar-chart-steps', 'bi-basket', 'bi-basket2', 'bi-basket3', 'bi-battery', 'bi-battery-charging', 'bi-battery-full', 'bi-battery-half', 'bi-bell', 'bi-bicycle', 'bi-binoculars', 'bi-book', 'bi-book-half', 'bi-bookmark', 'bi-bookmark-check', 'bi-bookmark-dash', 'bi-bookmark-heart', 'bi-bookmark-plus', 'bi-bookmark-star', 'bi-bookmark-x', 'bi-bookmarks', 'bi-bookshelf', 'bi-bootstrap', 'bi-border-all', 'bi-box', 'bi-box-seam', 'bi-braces', 'bi-bricks', 'bi-briefcase', 'bi-brightness-alt-high', 'bi-brightness-alt-low', 'bi-brightness-high', 'bi-brightness-low', 'bi-brush', 'bi-bucket', 'bi-bug', 'bi-building', 'bi-bullseye', 'bi-calculator', 'bi-calendar', 'bi-calendar-check', 'bi-calendar-date', 'bi-calendar-day', 'bi-calendar-event', 'bi-calendar-minus', 'bi-calendar-month', 'bi-calendar-plus', 'bi-calendar-range', 'bi-calendar-week', 'bi-calendar-x', 'bi-camera', 'bi-camera-video', 'bi-camera-video-off', 'bi-capslock', 'bi-card-checklist', 'bi-card-heading', 'bi-card-image', 'bi-card-list', 'bi-card-text', 'bi-caret-down', 'bi-caret-left', 'bi-caret-right', 'bi-caret-up', 'bi-cart', 'bi-cart-check', 'bi-cart-dash', 'bi-cart-plus', 'bi-cart-x', 'bi-cart2', 'bi-cart3', 'bi-cart4', 'bi-cash', 'bi-cash-stack', 'bi-cast', 'bi-chat', 'bi-chat-dots', 'bi-chat-left', 'bi-chat-right', 'bi-chat-square', 'bi-chat-text', 'bi-check', 'bi-check-all', 'bi-check-circle', 'bi-check-square', 'bi-chevron-down', 'bi-chevron-expand', 'bi-chevron-left', 'bi-chevron-right', 'bi-chevron-up', 'bi-circle', 'bi-circle-half', 'bi-circle-square', 'bi-clipboard', 'bi-clipboard-check', 'bi-clipboard-data', 'bi-clipboard-minus', 'bi-clipboard-plus', 'bi-clipboard-x', 'bi-clock', 'bi-clock-history', 'bi-cloud', 'bi-cloud-arrow-down', 'bi-cloud-arrow-up', 'bi-cloud-check', 'bi-cloud-download', 'bi-cloud-drizzle', 'bi-cloud-fog', 'bi-cloud-hail', 'bi-cloud-haze', 'bi-cloud-lightning', 'bi-cloud-moon', 'bi-cloud-plus', 'bi-cloud-rain', 'bi-cloud-slash', 'bi-cloud-sleet', 'bi-cloud-snow', 'bi-cloud-sun', 'bi-cloud-upload', 'bi-code', 'bi-code-slash', 'bi-code-square', 'bi-collection', 'bi-collection-play', 'bi-columns', 'bi-columns-gap', 'bi-command', 'bi-compass', 'bi-cone', 'bi-controller', 'bi-cpu', 'bi-credit-card', 'bi-crop', 'bi-cup', 'bi-cup-hot', 'bi-cursor', 'bi-dash', 'bi-dash-circle', 'bi-dash-square', 'bi-diamond', 'bi-display', 'bi-door-closed', 'bi-door-open', 'bi-download', 'bi-droplet', 'bi-droplet-half', 'bi-earbuds', 'bi-easel', 'bi-egg', 'bi-egg-fried', 'bi-eject', 'bi-envelope', 'bi-envelope-open', 'bi-eraser', 'bi-exclamation', 'bi-exclamation-circle', 'bi-exclamation-diamond', 'bi-exclamation-triangle', 'bi-eye', 'bi-eye-slash', 'bi-eyedropper', 'bi-eyeglasses', 'bi-facebook', 'bi-file', 'bi-file-earmark', 'bi-file-earmark-code', 'bi-file-earmark-image', 'bi-file-earmark-music', 'bi-file-earmark-pdf', 'bi-file-earmark-play', 'bi-file-earmark-text', 'bi-file-earmark-zip', 'bi-files', 'bi-film', 'bi-filter', 'bi-filter-circle', 'bi-flag', 'bi-flower1', 'bi-flower2', 'bi-flower3', 'bi-folder', 'bi-folder-check', 'bi-folder-minus', 'bi-folder-plus', 'bi-folder-symlink', 'bi-folder-x', 'bi-forward', 'bi-fullscreen', 'bi-fullscreen-exit', 'bi-funnel', 'bi-gear', 'bi-gem', 'bi-geo', 'bi-geo-alt', 'bi-gift', 'bi-github', 'bi-globe', 'bi-globe2', 'bi-google', 'bi-graph-down', 'bi-graph-up', 'bi-grid', 'bi-grid-1x2', 'bi-grid-3x2', 'bi-grid-3x3', 'bi-grid-3x3-gap', 'bi-grip-horizontal', 'bi-grip-vertical', 'bi-hammer', 'bi-hand-index', 'bi-hand-thumbs-down', 'bi-hand-thumbs-up', 'bi-handbag', 'bi-hash', 'bi-hdd', 'bi-headphones', 'bi-headset', 'bi-heart', 'bi-heart-half', 'bi-heart-pulse', 'bi-hexagon', 'bi-hexagon-half', 'bi-hourglass', 'bi-house', 'bi-house-door', 'bi-hr', 'bi-image', 'bi-images', 'bi-inbox', 'bi-inboxes', 'bi-info', 'bi-info-circle', 'bi-info-square', 'bi-input-cursor', 'bi-input-cursor-text', 'bi-instagram', 'bi-intersect', 'bi-journal', 'bi-journal-check', 'bi-journal-code', 'bi-journal-text', 'bi-journal-x', 'bi-journals', 'bi-joystick', 'bi-justify', 'bi-justify-left', 'bi-justify-right', 'bi-key', 'bi-keyboard', 'bi-ladder', 'bi-lamp', 'bi-laptop', 'bi-layers', 'bi-life-preserver', 'bi-lightbulb', 'bi-lightbulb-off', 'bi-lightning', 'bi-link', 'bi-link-45deg', 'bi-linkedin', 'bi-list', 'bi-list-check', 'bi-list-ol', 'bi-list-task', 'bi-list-ul', 'bi-lock', 'bi-map', 'bi-markdown', 'bi-mask', 'bi-megaphone', 'bi-menu-app', 'bi-menu-button', 'bi-menu-down', 'bi-menu-up', 'bi-mic', 'bi-mic-mute', 'bi-moon', 'bi-mouse', 'bi-music-note', 'bi-newspaper', 'bi-nut', 'bi-octagon', 'bi-option', 'bi-outlet', 'bi-paint-bucket', 'bi-palette', 'bi-paperclip', 'bi-paragraph', 'bi-patch-check', 'bi-patch-exclamation', 'bi-patch-question', 'bi-pause', 'bi-pause-circle', 'bi-peace', 'bi-pen', 'bi-pencil', 'bi-pencil-square', 'bi-pentagon', 'bi-people', 'bi-percent', 'bi-person', 'bi-person-badge', 'bi-person-check', 'bi-person-circle', 'bi-person-plus', 'bi-person-x', 'bi-phone', 'bi-pie-chart', 'bi-pin', 'bi-pin-map', 'bi-play', 'bi-play-circle', 'bi-plug', 'bi-plus', 'bi-plus-circle', 'bi-plus-square', 'bi-power', 'bi-printer', 'bi-puzzle', 'bi-question', 'bi-question-circle', 'bi-receipt', 'bi-record-circle', 'bi-reply', 'bi-reply-all', 'bi-rss', 'bi-rulers', 'bi-safe', 'bi-save', 'bi-scissors', 'bi-search', 'bi-server', 'bi-share', 'bi-shield', 'bi-shield-check', 'bi-shield-lock', 'bi-shield-slash', 'bi-shield-x', 'bi-shift', 'bi-shop', 'bi-shuffle', 'bi-signpost', 'bi-skip-backward', 'bi-skip-end', 'bi-skip-forward', 'bi-skip-start', 'bi-slack', 'bi-slash', 'bi-slash-circle', 'bi-slash-square', 'bi-sliders', 'bi-smartwatch', 'bi-snow', 'bi-sort-alpha-down', 'bi-sort-alpha-up', 'bi-sort-down', 'bi-sort-numeric-down', 'bi-sort-numeric-up', 'bi-sort-up', 'bi-soundwave', 'bi-speaker', 'bi-speedometer', 'bi-speedometer2', 'bi-spellcheck', 'bi-square', 'bi-square-half', 'bi-star', 'bi-star-half', 'bi-stars', 'bi-stickies', 'bi-sticky', 'bi-stop', 'bi-stop-circle', 'bi-stopwatch', 'bi-subtract', 'bi-suit-club', 'bi-suit-diamond', 'bi-suit-heart', 'bi-suit-spade', 'bi-sun', 'bi-sunglasses', 'bi-symmetry-horizontal', 'bi-symmetry-vertical', 'bi-table', 'bi-tablet', 'bi-tag', 'bi-tags', 'bi-telegram', 'bi-telephone', 'bi-telephone-forward', 'bi-telephone-inbound', 'bi-telephone-minus', 'bi-telephone-outbound', 'bi-telephone-plus', 'bi-telephone-x', 'bi-terminal', 'bi-text-center', 'bi-text-left', 'bi-text-paragraph', 'bi-text-right', 'bi-textarea', 'bi-thermometer', 'bi-thermometer-half', 'bi-thermometer-high', 'bi-thermometer-low', 'bi-thermometer-snow', 'bi-thermometer-sun', 'bi-three-dots', 'bi-three-dots-vertical', 'bi-toggle-off', 'bi-toggle-on', 'bi-toggles', 'bi-tools', 'bi-tornado', 'bi-trash', 'bi-tree', 'bi-triangle', 'bi-triangle-half', 'bi-trophy', 'bi-tropical-storm', 'bi-truck', 'bi-tsunami', 'bi-tv', 'bi-twitch', 'bi-twitter', 'bi-type', 'bi-type-bold', 'bi-type-h1', 'bi-type-h2', 'bi-type-h3', 'bi-type-italic', 'bi-type-strikethrough', 'bi-type-underline', 'bi-ui-checks', 'bi-umbrella', 'bi-unlock', 'bi-upload', 'bi-vector-pen', 'bi-view-list', 'bi-view-stacked', 'bi-voicemail', 'bi-volume-down', 'bi-volume-mute', 'bi-volume-off', 'bi-volume-up', 'bi-wallet', 'bi-watch', 'bi-water', 'bi-whatsapp', 'bi-wifi', 'bi-wifi-off', 'bi-wind', 'bi-window', 'bi-wrench', 'bi-x', 'bi-x-circle', 'bi-x-diamond', 'bi-x-octagon', 'bi-x-square', 'bi-youtube', 'bi-zoom-in', 'bi-zoom-out'
    ];

    function openIconModal(targetInput) {
        currentIconTarget = targetInput;
        renderIcons(icons);
        const iconModal = new bootstrap.Modal(document.getElementById('iconModal'));
        iconModal.show();
    }

    function renderIcons(iconList) {
        const grid = document.getElementById('iconGrid');
        grid.innerHTML = '';
        iconList.forEach(icon => {
            const col = document.createElement('div');
            col.className = 'col-2 col-md-1 text-center mb-3';
            col.innerHTML = `<div class="p-2 border rounded icon-option" style="cursor:pointer; font-size: 1.5rem;" onclick="selectIcon('bi ${icon}')" title="${icon}">
                                <i class="bi ${icon}"></i>
                             </div>`;
            grid.appendChild(col);
        });
    }

    function selectIcon(iconClass) {
        if (currentIconTarget) {
            currentIconTarget.value = iconClass;
            currentIconTarget.dispatchEvent(new Event('input'));
        }
        bootstrap.Modal.getInstance(document.getElementById('iconModal')).hide();
    }

    document.getElementById('iconSearch').addEventListener('input', function(e) {
        const term = e.target.value.toLowerCase();
        const filtered = icons.filter(icon => icon.toLowerCase().includes(term));
        renderIcons(filtered);
    });
</script>

<script>
    let featureCount = {{ isset($featureCount) ? max(1, $featureCount) : 1 }};
    let ingredientCount = {{ isset($ingredientCount) ? max(1, $ingredientCount) : 1 }};
    let nutritionCount = {{ isset($nutritionCount) ? max(1, $nutritionCount) : 1 }};
    let faqCount = {{ isset($faqCount) ? max(1, $faqCount) : 1 }};
    let cookingStepCount = {{ isset($cookingStepCount) ? max(1, $cookingStepCount) : 1 }};

    function addCookingStep() {
        const html = `
            <div class="row g-2 mb-2 cooking-step-row">
                <div class="col-md-3">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="bi bi-hand-index"></i></span>
                        <input type="text" name="cooking_steps[${cookingStepCount}][icon]" class="form-control px-2" placeholder="Icon class" value="bi bi-hand-index" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                        <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                    </div>
                </div>
                <div class="col-md-3">
                    <input type="text" name="cooking_steps[${cookingStepCount}][title]" class="form-control" placeholder="Step Title (e.g. Marinate)">
                </div>
                <div class="col-md-5">
                    <input type="text" name="cooking_steps[${cookingStepCount}][description]" class="form-control" placeholder="Description (e.g. Marinate meat...)">
                </div>
                <div class="col-md-1">
                    <button type="button" class="btn btn-outline-danger w-100" onclick="this.closest('.cooking-step-row').remove()"><i class="fa fa-trash"></i></button>
                </div>
            </div>
        `;
        document.getElementById('cookingStepsContainer').insertAdjacentHTML('beforeend', html);
        cookingStepCount++;
    }

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
                    <div class="input-group input-group-sm">
                        <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="bi bi-fire"></i></span>
                        <input type="text" name="features[${featureCount}][icon]" class="form-control px-2" placeholder="Icon class" value="bi bi-fire" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                        <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                    </div>
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
                    <div class="input-group input-group-sm">
                        <span class="input-group-text px-2" style="width: 35px; justify-content: center;"><i class="bi bi-circle"></i></span>
                        <input type="text" name="ingredients_list[${ingredientCount}][icon]" class="form-control px-2" placeholder="Icon class" value="bi bi-circle" oninput="this.previousElementSibling.querySelector('i').className = this.value || 'bi bi-question'">
                        <button class="btn btn-outline-secondary px-2" type="button" onclick="openIconModal(this.previousElementSibling)" title="Choose Icon"><i class="bi bi-grid-3x3-gap"></i></button>
                    </div>
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
