@extends('admin.layouts.master')

@section('title', 'Edit Category')
@section('page_title', 'Edit Category')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">Edit Category</h5>
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-light btn-sm border shadow-sm">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body p-4 mt-2">
                <form action="{{ route('admin.categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Category Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Parent Category</label>
                        <select name="parent_id" class="form-select @error('parent_id') is-invalid @enderror">
                            <option value="">None (Top Level)</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <div class="form-text">Select a parent category if this is a subcategory.</div>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="4">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    @if($category->image)
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Current Image</label>
                        <div class="position-relative d-inline-block">
                            <img src="{{ Storage::url($category->image) }}" alt="Category Image" class="img-thumbnail" style="max-height: 120px;">
                        </div>
                    </div>
                    @endif
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Update Image</label>
                        <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                        @error('image')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label fw-semibold">Icon Class Name</label>
                        <input type="text" name="icon_class" class="form-control @error('icon_class') is-invalid @enderror" value="{{ old('icon_class', $category->icon_class) }}" placeholder="e.g. bi-basket2">
                        <small class="text-muted">Bootstrap Icon class for frontend tabs. Overridden by Image if uploaded.</small>
                        @error('icon_class')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-4">
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive" {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                            <label class="form-check-label fw-semibold" for="isActive">Category is Active</label>
                        </div>
                    </div>
                    
                    <hr class="my-4">
                    
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary px-4"><i class="fa-solid fa-save me-2"></i> Update Category</button>
                    </div>
                    
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
