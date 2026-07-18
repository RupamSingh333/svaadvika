@extends('admin.layouts.master')

@section('title', 'Tax Manager')
@section('page_title', 'Tax Manager')

@section('content')
<div class="row">
    <div class="col-12 col-xl-8">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Taxes</h5>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>#</th>
                                <th>Tax Name</th>
                                <th>Percentage</th>
                                <th>Status</th>
                                <th>Created Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($taxes as $tax)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td class="fw-semibold">
                                        {{ $tax->name }}
                                        @if($tax->description)
                                            <div class="small text-muted fw-normal">{{ Str::limit($tax->description, 30) }}</div>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="badge bg-primary-subtle text-primary">{{ $tax->percentage }}%</span>
                                    </td>
                                    <td>
                                        @if($tax->status === 'active')
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td>{{ $tax->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        @hasPermission('taxes', 'edit')
                                        <button type="button" class="btn btn-sm btn-light border shadow-sm edit-tax-btn" 
                                            data-id="{{ $tax->id }}" 
                                            data-name="{{ $tax->name }}" 
                                            data-percentage="{{ $tax->percentage }}" 
                                            data-description="{{ $tax->description }}" 
                                            data-status="{{ $tax->status }}" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editTaxModal">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </button>
                                        @endhasPermission
                                        @hasPermission('taxes', 'delete')
                                        <form action="{{ route('admin.taxes.destroy', $tax->id) }}" method="POST" class="d-inline-block" onsubmit="confirmFormSubmit(event, this, '')">
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
                                        No taxes found. Create one to get started!
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                
                <div class="mt-4">
                    {{ $taxes->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
    </div>

    <div class="col-12 col-xl-4 mt-4 mt-xl-0">
        @hasPermission('taxes', 'create')
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="fw-semibold mb-0">Add New Tax</h5>
            </div>
            <div class="card-body mt-3">
                <form action="{{ route('admin.taxes.store') }}" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tax Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" placeholder="e.g. GST 5%" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Percentage <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" max="100" name="percentage" class="form-control @error('percentage') is-invalid @enderror" value="{{ old('percentage') }}" required>
                            <span class="input-group-text">%</span>
                            @error('percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="2">{{ old('description') }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" class="form-select @error('status') is-invalid @enderror">
                            <option value="active" {{ old('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        </select>
                        @error('status')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i> Save Tax</button>
                    </div>
                </form>
            </div>
        </div>
        @endhasPermission
    </div>
</div>

<!-- Edit Tax Modal -->
<div class="modal fade" id="editTaxModal" tabindex="-1" aria-labelledby="editTaxModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content glass-effect border-0 shadow">
            <div class="modal-header border-bottom border-light">
                <h5 class="modal-title fw-semibold" id="editTaxModalLabel">Edit Tax</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTaxForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Tax Name <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="edit_name" class="form-control" required>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Percentage <span class="text-danger">*</span></label>
                        <div class="input-group">
                            <input type="number" step="0.01" min="0" max="100" name="percentage" id="edit_percentage" class="form-control" required>
                            <span class="input-group-text">%</span>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Description</label>
                        <textarea name="description" id="edit_description" class="form-control" rows="2"></textarea>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Status</label>
                        <select name="status" id="edit_status" class="form-select">
                            <option value="active">Active</option>
                            <option value="inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-top border-light">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Tax</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const editBtns = document.querySelectorAll('.edit-tax-btn');
    const editForm = document.getElementById('editTaxForm');
    
    editBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            const id = this.dataset.id;
            editForm.action = `/admin/taxes/${id}`;
            
            document.getElementById('edit_name').value = this.dataset.name;
            document.getElementById('edit_percentage').value = this.dataset.percentage;
            document.getElementById('edit_description').value = this.dataset.description;
            document.getElementById('edit_status').value = this.dataset.status;
        });
    });
});
</script>
@endpush
@endsection
