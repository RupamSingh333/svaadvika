@extends('admin.layouts.master')

@section('title', 'Create Content')
@section('page_title', 'Create Content')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <!-- Main Content -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Content Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Body Content</label>
                                <textarea name="content" class="form-control richtext @error('content') is-invalid @enderror" rows="15">{{ old('content') }}</textarea>
                                @error('content')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-lg-4">
                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Publishing</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Content Type <span class="text-danger">*</span></label>
                                <select name="type" class="form-select @error('type') is-invalid @enderror" required>
                                    <option value="page" {{ old('type') == 'page' ? 'selected' : '' }}>Static Page</option>
                                    <option value="blog" {{ old('type') == 'blog' ? 'selected' : '' }}>Blog Post</option>
                                    <option value="recipe" {{ old('type') == 'recipe' ? 'selected' : '' }}>Recipe</option>
                                </select>
                                @error('type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published</option>
                                    <option value="draft" {{ old('status', 'draft') == 'draft' ? 'selected' : '' }}>Draft</option>
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <hr class="my-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i> Save Content</button>
                                <a href="{{ route('admin.posts.index') }}" class="btn btn-light border">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>
@endsection
