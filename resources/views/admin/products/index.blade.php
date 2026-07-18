@extends('admin.layouts.master')

@section('title', 'Products')
@section('page_title', 'Products')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Products</h5>
                @hasPermission('products', 'create')
                <a href="{{ route('admin.products.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                    <i class="fa-solid fa-plus me-2"></i> Add New Product
                </a>
                @endhasPermission
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>#</th>
                                <th>Product Info</th>
                                <th>Pricing & Taxes</th>
                                <th>Stock Management</th>
                                <th>Status & Visibility</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">
                                        <div class="d-flex align-items-center">
                                            @if($product->featuredImage)
                                                <img src="{{ Storage::url($product->featuredImage->image_path) }}" alt="Img" class="img-thumbnail me-2" style="width: 48px; height: 48px; object-fit: cover;">
                                            @elseif($product->images->first())
                                                <img src="{{ Storage::url($product->images->first()->image_path) }}" alt="Img" class="img-thumbnail me-2" style="width: 48px; height: 48px; object-fit: cover;">
                                            @else
                                                <div class="bg-light text-muted d-flex align-items-center justify-content-center me-2 border rounded" style="width: 48px; height: 48px;">
                                                    <i class="fa-regular fa-image"></i>
                                                </div>
                                            @endif
                                            <div>
                                                {{ $product->name }}<br>
                                                <small class="text-muted">SKU: {{ $product->sku }} | Category: {{ $product->category->name }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div>
                                            @if($product->sale_price)
                                                <span class="text-danger fw-bold">₹{{ $product->sale_price }}</span>
                                                <strike class="text-muted small">₹{{ $product->price }}</strike>
                                            @else
                                                <span class="fw-bold">₹{{ $product->price }}</span>
                                            @endif
                                        </div>
                                        @if($product->tax)
                                            <small class="text-muted"><i class="fa-solid fa-receipt me-1"></i>Tax: {{ $product->tax->name }} ({{ $product->tax->rate }}%)</small>
                                        @else
                                            <small class="text-muted">Tax: None</small>
                                        @endif
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.products.update-stock', $product->id) }}" method="POST" class="d-flex align-items-center mb-2">
                                            @csrf
                                            <input type="number" name="stock_quantity" value="{{ $product->stock_quantity }}" class="form-control form-control-sm me-1" style="width: 70px;" min="0">
                                            <button type="submit" class="btn btn-sm btn-light border text-primary" title="Update Stock"><i class="fa-solid fa-save"></i></button>
                                        </form>
                                        <form action="{{ route('admin.products.toggle-out-of-stock', $product->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch form-check-sm mb-0">
                                                <input class="form-check-input" type="checkbox" onchange="this.form.submit()" {{ $product->is_out_of_stock ? 'checked' : '' }} style="cursor: pointer;" id="oos-{{ $product->id }}">
                                                <label class="form-check-label small {{ $product->is_out_of_stock ? 'text-danger fw-bold' : 'text-muted' }}" for="oos-{{ $product->id }}" style="cursor: pointer;">
                                                    {{ $product->is_out_of_stock ? 'Out of Stock' : 'In Stock' }}
                                                </label>
                                            </div>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('admin.products.toggle-status', $product->id) }}" method="POST" class="mb-2">
                                            @csrf
                                            <div class="form-check form-switch form-check-sm mb-0">
                                                <input class="form-check-input" type="checkbox" onchange="this.form.submit()" {{ $product->status == 'active' ? 'checked' : '' }} style="cursor: pointer;" id="status-{{ $product->id }}">
                                                <label class="form-check-label small {{ $product->status == 'active' ? 'text-success fw-bold' : 'text-muted' }}" for="status-{{ $product->id }}" style="cursor: pointer;">
                                                    {{ ucfirst($product->status) }}
                                                </label>
                                            </div>
                                        </form>
                                        <form action="{{ route('admin.products.toggle-featured', $product->id) }}" method="POST">
                                            @csrf
                                            <div class="form-check form-switch form-check-sm mb-0">
                                                <input class="form-check-input" type="checkbox" onchange="this.form.submit()" {{ $product->is_featured ? 'checked' : '' }} style="cursor: pointer;" id="featured-{{ $product->id }}">
                                                <label class="form-check-label small {{ $product->is_featured ? 'text-warning fw-bold' : 'text-muted' }}" for="featured-{{ $product->id }}" style="cursor: pointer;">
                                                    Featured
                                                </label>
                                            </div>
                                        </form>
                                    </td>
                                    <td class="text-end">
                                        @hasPermission('products', 'edit')
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>
                                        @endhasPermission
                                        @hasPermission('products', 'delete')
                                        <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" class="d-inline-block" onsubmit="confirmFormSubmit(event, this, '')">
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
                                        <div class="mb-3"><i class="fa-solid fa-box-open fa-3x text-light-gray"></i></div>
                                        No products found. Add one to get started!
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
@endsection
