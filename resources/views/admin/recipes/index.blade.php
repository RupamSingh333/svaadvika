@extends('admin.layouts.master')

@section('title', 'Recipes')
@section('page_title', 'Recipes')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect mb-4">
            <div class="card-body">
                <form action="{{ route('admin.recipes.index') }}" method="GET" class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label">Search</label>
                        <input type="text" name="search" class="form-control" placeholder="Search by title..." value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Category</label>
                        <select name="category" class="form-select">
                            <option value="">All Categories</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat }}" {{ request('category') == $cat ? 'selected' : '' }}>{{ $cat }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">Status</label>
                        <select name="status" class="form-select">
                            <option value="">All Status</option>
                            <option value="Draft" {{ request('status') == 'Draft' ? 'selected' : '' }}>Draft</option>
                            <option value="Published" {{ request('status') == 'Published' ? 'selected' : '' }}>Published</option>
                            <option value="Featured" {{ request('status') == 'Featured' ? 'selected' : '' }}>Featured</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn btn-primary w-100">Filter</button>
                    </div>
                </form>
            </div>
        </div>

        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Recipes</h5>
                @hasPermission('recipes', 'create')
                <a href="{{ route('admin.recipes.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                    <i class="fa-solid fa-plus me-2"></i> Add New Recipe
                </a>
                @endhasPermission
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>#</th>
                                <th>Recipe</th>
                                <th>Category</th>
                                <th>Duration</th>
                                <th>Diet Type</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recipes as $recipe)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold d-flex align-items-center">
                                        @if($recipe->featured_image)
                                            <img src="{{ Storage::url($recipe->featured_image) }}" alt="Img" class="img-thumbnail me-2" style="width: 48px; height: 48px; object-fit: cover;">
                                        @else
                                            <div class="bg-light text-muted d-flex align-items-center justify-content-center me-2 border rounded" style="width: 48px; height: 48px;">
                                                <i class="fa-regular fa-image"></i>
                                            </div>
                                        @endif
                                        <div>
                                            {{ $recipe->title }}
                                        </div>
                                    </td>
                                    <td><span class="badge bg-secondary-subtle text-secondary">{{ $recipe->category }}</span></td>
                                    <td><span class="text-muted"><i class="fa-regular fa-clock me-1"></i>{{ $recipe->duration }}</span></td>
                                    <td>
                                        @if($recipe->diet_type == 'Vegetarian')
                                            <span class="badge bg-success-subtle text-success">Vegetarian</span>
                                        @elseif($recipe->diet_type == 'Vegan')
                                            <span class="badge bg-success text-white">Vegan</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Non-Veg</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($recipe->status == 'Published')
                                            <span class="badge bg-primary-subtle text-primary">Published</span>
                                        @elseif($recipe->status == 'Featured')
                                            <span class="badge bg-warning-subtle text-warning">Featured</span>
                                        @else
                                            <span class="badge bg-secondary-subtle text-secondary">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-muted">{{ $recipe->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        @hasPermission('recipes', 'edit')
                                        <a href="{{ route('admin.recipes.edit', $recipe->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>
                                        @endhasPermission
                                        @hasPermission('recipes', 'delete')
                                        <form action="{{ route('admin.recipes.destroy', $recipe->id) }}" method="POST" class="d-inline-block" onsubmit="confirmFormSubmit(event, this, '')">
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
                                    <td colspan="8" class="text-center py-4 text-muted">
                                        <div class="mb-3"><i class="fa-solid fa-utensils fa-3x text-light-gray"></i></div>
                                        No recipes found. Add one to get started!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="d-flex justify-content-end mt-3">
                    {{ $recipes->withQueryString()->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
