@extends('admin.layouts.master')

@section('title', 'Orders')
@section('page_title', 'Orders Management')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card border-0 shadow-sm glass-effect">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="fw-semibold mb-0">All Orders</h5>
            </div>
            <div class="card-body mt-3">
                <div class="table-responsive">
                    <table class="table table-hover align-middle">
                        <thead class="table-light text-muted">
                            <tr>
                                <th>Order Number</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Total Amount</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th class="text-end">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($orders as $order)
                                <tr>
                                    <td class="fw-semibold">#{{ $order->order_number }}</td>
                                    <td>{{ $order->created_at->format('M d, Y') }}<br><small class="text-muted">{{ $order->created_at->format('h:i A') }}</small></td>
                                    <td>{{ $order->user ? $order->user->name : 'Guest' }}</td>
                                    <td class="fw-bold">₹{{ $order->total_amount }}</td>
                                    <td>
                                        @if($order->payment_status == 'paid')
                                            <span class="badge bg-success-subtle text-success">Paid</span>
                                        @elseif($order->payment_status == 'failed')
                                            <span class="badge bg-danger-subtle text-danger">Failed</span>
                                        @else
                                            <span class="badge bg-warning-subtle text-warning">Pending</span>
                                        @endif
                                        <br><small class="text-muted text-uppercase">{{ $order->payment_method }}</small>
                                    </td>
                                    <td>
                                        @php
                                            $statusColors = [
                                                'pending' => 'warning',
                                                'processing' => 'info',
                                                'shipped' => 'primary',
                                                'delivered' => 'success',
                                                'cancelled' => 'danger'
                                            ];
                                            $color = $statusColors[$order->status] ?? 'secondary';
                                        @endphp
                                        <span class="badge bg-{{ $color }}-subtle text-{{ $color }} text-capitalize">{{ $order->status }}</span>
                                    </td>
                                    <td class="text-end">
                                        <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-light border shadow-sm">
                                            <i class="fa-solid fa-eye text-primary"></i> View
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="text-center py-4 text-muted">
                                        <div class="mb-3"><i class="fa-solid fa-receipt fa-3x text-light-gray"></i></div>
                                        No orders found.
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
