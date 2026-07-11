@extends('admin.layouts.master')

@section('title', 'Create Product')
@section('page_title', 'Create Product')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
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
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                                @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Short Description</label>
                                <textarea name="short_description" class="form-control richtext @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description') }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Long Description</label>
                                <textarea name="long_description" class="form-control richtext @error('long_description') is-invalid @enderror" rows="6">{{ old('long_description') }}</textarea>
                                @error('long_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Ingredients</label>
                                <textarea name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" rows="3">{{ old('ingredients') }}</textarea>
                                @error('ingredients')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                    <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                                    @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Sale Price (₹)</label>
                                    <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price') }}">
                                    @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">SKU <span class="text-danger">*</span></label>
                                    <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}" required>
                                    @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Stock Quantity <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" name="stock_quantity" class="form-control @error('stock_quantity') is-invalid @enderror" value="{{ old('stock_quantity', 0) }}" required>
                                        <div class="input-group-text">
                                            <input class="form-check-input mt-0 me-2" type="checkbox" name="is_out_of_stock" value="1" {{ old('is_out_of_stock') ? 'checked' : '' }} aria-label="Mark as Out of Stock Manually">
                                            <span style="font-size: 0.85rem;">Out of Stock</span>
                                        </div>
                                    </div>
                                    @error('stock_quantity')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Rating (0-5)</label>
                                    <input type="number" step="0.1" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', '4.5') }}">
                                    @error('rating')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Reviews Count</label>
                                    <input type="number" name="reviews_count" class="form-control @error('reviews_count') is-invalid @enderror" value="{{ old('reviews_count', 120) }}">
                                    @error('reviews_count')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-4 mb-4">
                                    <label class="form-label fw-semibold">Weight</label>
                                    <input type="text" name="weight" class="form-control @error('weight') is-invalid @enderror" value="{{ old('weight') }}" placeholder="e.g. 250g pack">
                                    @error('weight')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
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
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Featured Image</label>
                                <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*">
                                <small class="text-muted">This image will be highlighted as the primary product image.</small>
                                @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Gallery Images</label>
                                <input type="file" name="gallery_images[]" class="form-control @error('gallery_images.*') is-invalid @enderror" accept="image/*" multiple>
                                <small class="text-muted">You can select multiple images to show in the product gallery.</small>
                                @error('gallery_images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <hr class="my-4">

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active (Visible)</option>
                                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Hidden)</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeatured" {{ old('is_featured') ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="isFeatured">Featured Product</label>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i> Save Product</button>
                                <a href="{{ route('admin.products.index') }}" class="btn btn-light border">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
