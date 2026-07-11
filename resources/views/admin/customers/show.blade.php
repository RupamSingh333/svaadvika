@extends('admin.layouts.master')

@section('title', 'Customer Profile')
@section('page_title', 'Customer Profile')

@section('content')
<div class="row">
    <div class="col-md-4 mb-4">
        <div class="card border-0 shadow-sm glass-effect h-100">
            <div class="card-body text-center p-4">
                <div class="avatar bg-primary-subtle text-primary fw-bold rounded-circle d-flex justify-content-center align-items-center mx-auto mb-3" style="width: 100px; height: 100px; font-size: 2.5rem;">
                    {{ strtoupper(substr($customer->first_name ?? $customer->email, 0, 1)) }}
                </div>
                <h4 class="fw-semibold mb-1">{{ $customer->first_name }} {{ $customer->last_name }}</h4>
                <p class="text-muted mb-3">{{ $customer->email }}</p>
                
                <div class="d-flex justify-content-center gap-2 mb-4">
                    @if($customer->is_blocked)
                        <span class="badge bg-danger-subtle text-danger px-3 py-2">Account Blocked</span>
                    @else
                        <span class="badge bg-success-subtle text-success px-3 py-2">Active Customer</span>
                    @endif
                </div>

                <ul class="list-group list-group-flush text-start">
                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fa-solid fa-phone me-2"></i>Phone</span>
                        <span class="fw-semibold">{{ $customer->phone ?? 'N/A' }}</span>
                    </li>
                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fa-solid fa-calendar me-2"></i>Joined</span>
                        <span class="fw-semibold">{{ $customer->created_at->format('M d, Y') }}</span>
                    </li>
                    <li class="list-group-item bg-transparent d-flex justify-content-between align-items-center px-0">
                        <span class="text-muted"><i class="fa-solid fa-clock me-2"></i>Last Login</span>
                        <span class="fw-semibold">{{ $customer->last_login_at ? $customer->last_login_at->format('M d, Y H:i') : 'Never' }}</span>
                    </li>
                </ul>

                <div class="mt-4 pt-3 border-top">
                    <form action="{{ route('admin.customers.toggle-block', $customer->id) }}" method="POST" class="d-inline-block w-100">
                        @csrf
                        <button type="submit" class="btn {{ $customer->is_blocked ? 'btn-success' : 'btn-warning' }} w-100 shadow-sm">
                            <i class="fa-solid {{ $customer->is_blocked ? 'fa-unlock' : 'fa-lock' }} me-2"></i>
                            {{ $customer->is_blocked ? 'Unblock Customer' : 'Block Customer' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8 mb-4">
        <div class="card border-0 shadow-sm glass-effect mb-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="fw-semibold mb-0"><i class="fa-solid fa-location-dot me-2 text-primary"></i> Saved Addresses</h5>
            </div>
            <div class="card-body mt-3">
                @if($customer->addresses && $customer->addresses->count() > 0)
                    <div class="row">
                        @foreach($customer->addresses as $address)
                            <div class="col-md-6 mb-3">
                                <div class="card border {{ $address->is_default ? 'border-primary' : 'border-light' }} h-100 bg-light">
                                    <div class="card-body">
                                        <div class="d-flex justify-content-between mb-2">
                                            <span class="badge {{ $address->type == 'home' ? 'bg-info' : ($address->type == 'work' ? 'bg-secondary' : 'bg-dark') }}">
                                                {{ ucfirst($address->type) }}
                                            </span>
                                            @if($address->is_default)
                                                <span class="badge bg-primary-subtle text-primary">Default</span>
                                            @endif
                                        </div>
                                        <h6 class="fw-semibold">{{ $address->name }}</h6>
                                        <p class="text-muted small mb-1">{{ $address->phone }}</p>
                                        <p class="text-muted small mb-0">
                                            {{ $address->address_line_1 }}<br>
                                            @if($address->address_line_2) {{ $address->address_line_2 }}<br> @endif
                                            {{ $address->city }}, {{ $address->state }} {{ $address->pincode }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-4 text-muted">
                        <i class="fa-regular fa-map fa-2x mb-2 text-light-gray"></i>
                        <p class="mb-0">No saved addresses found.</p>
                    </div>
                @endif
            </div>
        </div>

        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="fw-semibold mb-0"><i class="fa-solid fa-clock-rotate-left me-2 text-primary"></i> Login History</h5>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>Date & Time</th>
                                <th>IP Address</th>
                                <th>Device / Browser</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($customer->loginHistory as $history)
                                <tr>
                                    <td>{{ $history->created_at->format('M d, Y H:i:s') }}</td>
                                    <td><code>{{ $history->ip_address }}</code></td>
                                    <td><small class="text-muted">{{ Str::limit($history->user_agent, 50) }}</small></td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">
                                        No login history found.
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
