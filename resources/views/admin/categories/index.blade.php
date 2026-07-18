@extends('admin.layouts.master')

@section('title', 'Categories')
@section('page_title', 'Categories')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Categories</h5>
                @hasPermission('categories', 'create')
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                    <i class="fa-solid fa-plus me-2"></i> Add New Category
                </a>
                @endhasPermission
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>#</th>
                                <th>Category Name</th>
                                <th>Parent</th>
                                <th>Slug</th>
                                <th>Status</th>
                                <th>Featured</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($categories as $category)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold d-flex align-items-center">
                                        @if($category->image)
                                            <img src="{{ Storage::url($category->image) }}" alt="Img" class="img-thumbnail me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        @elseif($category->icon_class)
                                            <div class="bg-light text-muted d-flex align-items-center justify-content-center me-2 border rounded" style="width: 40px; height: 40px; font-size: 1.2rem;">
                                                <i class="bi {{ $category->icon_class }}"></i>
                                            </div>
                                        @else
                                            <div class="bg-light text-muted d-flex align-items-center justify-content-center me-2 border rounded" style="width: 40px; height: 40px;">
                                                <i class="fa-regular fa-folder"></i>
                                            </div>
                                        @endif
                                        {{ $category->name }}
                                    </td>
                                    <td>
                                        @if($category->parent)
                                            <span class="badge bg-secondary-subtle text-secondary">{{ $category->parent->name }}</span>
                                        @else
                                            <span class="text-muted">-</span>
                                        @endif
                                    </td>
                                    <td><code>{{ $category->slug }}</code></td>
                                    <td>
                                        @if($category->is_active)
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="form-check form-switch">
                                            <input class="form-check-input toggle-featured" type="checkbox" role="switch" data-id="{{ $category->id }}" {{ $category->is_featured ? 'checked' : '' }}>
                                        </div>
                                    </td>
                                    <td class="text-end">
                                        @hasPermission('categories', 'edit')
                                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>
                                        @endhasPermission
                                        @hasPermission('categories', 'delete')
                                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" class="d-inline-block" onsubmit="confirmFormSubmit(event, this, '')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border shadow-sm">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                        @endhasPermission
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <div class="mb-3"><i class="fa-solid fa-folder-open fa-3x text-light-gray"></i></div>
                                        No categories found. Create one to get started!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const featureToggles = document.querySelectorAll('.toggle-featured');
    
    featureToggles.forEach(toggle => {
        toggle.addEventListener('change', function() {
            const categoryId = this.dataset.id;
            const isFeatured = this.checked;
            
            fetch(`/admin/categories/${categoryId}/toggle-featured`, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                }
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Optional: show a success toast here
                    console.log('Featured status updated');
                } else {
                    // Revert UI if error
                    this.checked = !isFeatured;
                    alert('Error updating featured status.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                // Revert UI on network error
                this.checked = !isFeatured;
                alert('Network error. Could not update featured status.');
            });
        });
    });
});
</script>
@endpush
@endsection
