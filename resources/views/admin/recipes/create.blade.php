@extends('admin.layouts.master')

@section('title', 'Create Recipe')
@section('page_title', 'Create Recipe')

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <form action="{{ route('admin.recipes.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="row">
                <!-- Main Info -->
                <div class="col-lg-8">
                    <div class="card border-0 shadow-sm glass-effect mb-4">
                        <div class="card-header bg-transparent border-0 pt-4 pb-0">
                            <h5 class="fw-semibold mb-0">Recipe Information</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Recipe Title <span class="text-danger">*</span></label>
                                <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
                                @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Short Description</label>
                                <textarea name="short_description" class="form-control @error('short_description') is-invalid @enderror" rows="3">{{ old('short_description') }}</textarea>
                                @error('short_description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Full Description (Ingredients, Steps, Tips, etc.)</label>
                                <textarea name="description" class="form-control richtext @error('description') is-invalid @enderror" rows="10">{{ old('description') }}</textarea>
                                @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <hr class="my-4">
                            <h5 class="fw-semibold mb-3">Additional Details</h5>
                            <div class="row">
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Difficulty <span class="text-danger">*</span></label>
                                    <select name="difficulty" class="form-select @error('difficulty') is-invalid @enderror" required>
                                        @foreach($difficulties as $diff)
                                            <option value="{{ $diff }}" {{ old('difficulty') == $diff ? 'selected' : '' }}>{{ $diff }}</option>
                                        @endforeach
                                    </select>
                                    @error('difficulty')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Diet Type <span class="text-danger">*</span></label>
                                    <select name="diet_type" class="form-select @error('diet_type') is-invalid @enderror" required>
                                        @foreach($dietTypes as $diet)
                                            <option value="{{ $diet }}" {{ old('diet_type') == $diet ? 'selected' : '' }}>{{ $diet }}</option>
                                        @endforeach
                                    </select>
                                    @error('diet_type')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Spice Level <span class="text-danger">*</span></label>
                                    <select name="spice_level" class="form-select @error('spice_level') is-invalid @enderror" required>
                                        @foreach($spiceLevels as $spice)
                                            <option value="{{ $spice }}" {{ old('spice_level') == $spice ? 'selected' : '' }}>{{ $spice }}</option>
                                        @endforeach
                                    </select>
                                    @error('spice_level')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                </div>
                                <div class="col-md-6 mb-4">
                                    <label class="form-label fw-semibold">Duration (e.g. 45 mins) <span class="text-danger">*</span></label>
                                    <input type="text" name="duration" class="form-control @error('duration') is-invalid @enderror" value="{{ old('duration') }}" required>
                                    @error('duration')<div class="invalid-feedback">{{ $message }}</div>@enderror
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
                                <label class="form-label fw-semibold">Status <span class="text-danger">*</span></label>
                                <select name="status" class="form-select @error('status') is-invalid @enderror" required>
                                    @foreach($statuses as $status)
                                        <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>{{ $status }}</option>
                                    @endforeach
                                </select>
                                @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Category <span class="text-danger">*</span></label>
                                <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{ $category }}" {{ old('category') == $category ? 'selected' : '' }}>{{ $category }}</option>
                                    @endforeach
                                </select>
                                @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>
                            
                            <hr class="my-4">

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Featured Image <span class="text-danger">*</span></label>
                                <input type="file" name="featured_image" class="form-control @error('featured_image') is-invalid @enderror" accept="image/*" required>
                                @error('featured_image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">Gallery Images (Optional)</label>
                                <input type="file" name="gallery_images[]" class="form-control @error('gallery_images.*') is-invalid @enderror" accept="image/*" multiple>
                                @error('gallery_images.*')<div class="invalid-feedback">{{ $message }}</div>@enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold">YouTube Video URL (Optional)</label>
                                <input type="url" id="youtube_url" name="youtube_url" class="form-control @error('youtube_url') is-invalid @enderror" value="{{ old('youtube_url') }}" placeholder="https://youtube.com/watch?v=... or shorts URL">
                                @error('youtube_url')<div class="invalid-feedback">{{ $message }}</div>@enderror
                                <div id="yt-preview-container" class="mt-2 d-none">
                                    <label class="form-label text-muted small">Video Preview</label>
                                    <div class="ratio ratio-16x9">
                                        <iframe id="yt-preview-iframe" src="" allowfullscreen></iframe>
                                    </div>
                                </div>
                            </div>
                            
                            <hr class="my-4">
                            <div class="d-grid gap-2">
                                <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i> Save Recipe</button>
                                <a href="{{ route('admin.recipes.index') }}" class="btn btn-light border">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
        </form>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ytInput = document.getElementById('youtube_url');
        const previewContainer = document.getElementById('yt-preview-container');
        const previewIframe = document.getElementById('yt-preview-iframe');

        function updatePreview() {
            const url = ytInput.value.trim();
            let videoId = '';
            if (url) {
                const watchMatch = url.match(/youtube\.com\/watch\?v=([^\&\?\/]+)/);
                const embedMatch = url.match(/youtube\.com\/embed\/([^\&\?\/]+)/);
                const vMatch = url.match(/youtube\.com\/v\/([^\&\?\/]+)/);
                const shortMatch = url.match(/youtu\.be\/([^\&\?\/]+)/);
                const reelMatch = url.match(/youtube\.com\/shorts\/([^\&\?\/]+)/);
                
                if (watchMatch) videoId = watchMatch[1];
                else if (embedMatch) videoId = embedMatch[1];
                else if (vMatch) videoId = vMatch[1];
                else if (shortMatch) videoId = shortMatch[1];
                else if (reelMatch) videoId = reelMatch[1];
            }

            if (videoId) {
                previewIframe.src = 'https://www.youtube.com/embed/' + videoId;
                previewContainer.classList.remove('d-none');
            } else {
                previewIframe.src = '';
                previewContainer.classList.add('d-none');
            }
        }

        ytInput.addEventListener('input', updatePreview);
        updatePreview(); // initial check
    });
</script>
@endpush
@endsection
