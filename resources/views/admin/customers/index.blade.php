@extends('admin.layouts.master')

@section('title', 'Customers')
@section('page_title', 'Customers Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Customers</h5>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Status</th>
                                <th>Joined Date</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customers as $customer)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="avatar bg-primary-subtle text-primary fw-bold rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 40px; height: 40px;">
                                                {{ strtoupper(substr($customer->name ?? $customer->email, 0, 1)) }}
                                            </div>
                                            <div class="fw-semibold">{{ $customer->name }}</div>
                                        </div>
                                    </td>
                                    <td>{{ $customer->email }}</td>
                                    <td>{{ $customer->phone ?? '-' }}</td>
                                    <td>
                                        @if($customer->is_blocked)
                                            <span class="badge bg-danger-subtle text-danger">Blocked</span>
                                        @else
                                            <span class="badge bg-success-subtle text-success">Active</span>
                                        @endif
                                    </td>
                                    <td>{{ $customer->created_at->format('M d, Y') }}</td>
                                    <td class="text-end">
                                        @hasPermission('customers', 'view')
                                        <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-sm btn-light border shadow-sm" title="View Profile">
                                            <i class="fa-solid fa-eye text-primary"></i>
                                        </a>
                                        @endhasPermission
                                        @hasPermission('customers', 'edit')
                                        <a href="{{ route('admin.customers.edit', $customer->id) }}" class="btn btn-sm btn-light border shadow-sm" title="Edit Profile">
                                            <i class="fa-solid fa-pen text-primary"></i>
                                        </a>
                                        @endhasPermission
                                        @hasPermission('customers', 'edit')
                                        <form action="{{ route('admin.customers.toggle-block', $customer->id) }}" method="POST" class="d-inline-block">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-light border shadow-sm" title="{{ $customer->is_blocked ? 'Unblock' : 'Block' }}">
                                                <i class="fa-solid {{ $customer->is_blocked ? 'fa-unlock text-success' : 'fa-lock text-warning' }}"></i>
                                            </button>
                                        </form>
                                        @endhasPermission
                                        @hasPermission('customers', 'delete')
                                        <form action="{{ route('admin.customers.destroy', $customer->id) }}" method="POST" class="d-inline-block" onsubmit="confirmFormSubmit(event, this, '')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-light border shadow-sm" title="Delete">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </button>
                                        </form>
                                        @endhasPermission
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">
                                        <div class="mb-3"><i class="fa-solid fa-users fa-3x text-light-gray"></i></div>
                                        No customers found.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="mt-3">
                    {{ $customers->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
