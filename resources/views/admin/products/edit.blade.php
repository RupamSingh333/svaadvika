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

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Ingredients</label>
                                <textarea name="ingredients" class="form-control @error('ingredients') is-invalid @enderror" rows="3">{{ old('ingredients', $product->ingredients) }}</textarea>
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
                                    <input type="number" step="0.1" name="rating" class="form-control @error('rating') is-invalid @enderror" value="{{ old('rating', $product->rating) }}">
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
                                    <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 shadow-sm" onclick="if(confirm('Delete featured image?')) document.getElementById('delete-image-{{ $product->featuredImage->id }}').submit();">
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
                                        <button type="button" class="btn btn-danger btn-sm position-absolute top-0 end-0 m-1 shadow-sm px-1 py-0" style="font-size: 0.7rem;" onclick="if(confirm('Delete gallery image?')) document.getElementById('delete-image-{{ $image->id }}').submit();">
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
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" name="is_featured" value="1" id="isFeatured" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                                    <label class="form-check-label fw-semibold" for="isFeatured">Featured Product</label>
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
