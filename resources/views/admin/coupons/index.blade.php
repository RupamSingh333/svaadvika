@extends('admin.layouts.master')

@section('title', 'Coupons')
@section('page_title', 'Coupons Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Coupons</h5>
                @hasPermission('coupons', 'create')
                <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary btn-sm px-3 shadow-sm">
                    <i class="fa-solid fa-plus me-2"></i> Add New Coupon
                </a>
                @endhasPermission
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>Code</th>
                                <th>Discount</th>
                                <th>Usage</th>
                                <th>Expires At</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($coupons as $coupon)
                                <tr>
                                    <td><span class="fw-bold px-2 py-1 bg-light border rounded font-monospace">{{ $coupon->code }}</span></td>
                                    <td>
                                        @if($coupon->type == 'fixed')
                                            <span class="text-success fw-bold">₹{{ $coupon->value }}</span>
                                        @else
                                            <span class="text-success fw-bold">{{ $coupon->value }}%</span>
                                        @endif
                                    </td>
                                    <td>
                                        {{ $coupon->used_count }} / {{ $coupon->usage_limit ?? '∞' }}
                                    </td>
                                    <td>
                                        @if($coupon->expires_at)
                                            @if($coupon->expires_at->isPast())
                                                <span class="text-danger">Expired on {{ $coupon->expires_at->format('M d, Y') }}</span>
                                            @else
                                                <span class="text-muted">{{ $coupon->expires_at->format('M d, Y') }}</span>
                                            @endif
                                        @else
                                            <span class="text-muted">Never</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($coupon->is_active)
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @else
                                            <span class="badge bg-danger-subtle text-danger">Inactive</span>
                                        @endif
                                    </td>
                                    <td class="text-end">
                                        @hasPermission('coupons', 'edit')
                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                            <i class="fa-solid fa-pen-to-square text-primary"></i>
                                        </a>
                                        @endhasPermission
                                        @hasPermission('coupons', 'delete')
                                        <form action="{{ route('admin.coupons.destroy', $coupon->id) }}" method="POST" class="d-inline-block" onsubmit="confirmFormSubmit(event, this, '')">
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
                                        <div class="mb-3"><i class="fa-solid fa-ticket fa-3x text-light-gray"></i></div>
                                        No coupons found.
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
