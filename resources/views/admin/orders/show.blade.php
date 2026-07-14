@extends('admin.layouts.master')

@section('title', 'Order Details')
@section('page_title', 'Order #' . $order->order_number)

@section('content')
<div class="row">
    <div class="col-12 col-xl-12">
        <div class="card border-0 shadow-sm glass-effect mb-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <div class="d-flex justify-content-between align-items-center">
                    <h5 class="fw-semibold mb-0">Order Items</h5>
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-light btn-sm border shadow-sm">
                        <i class="fa-solid fa-arrow-left me-2"></i> Back
                    </a>
                </div>
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table align-middle">
                        <thead class="table-light">
                            <tr>
                                <th>Product</th>
                                <th>Price</th>
                                <th>Qty</th>
                                <th class="text-end">Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="fw-semibold">{{ $item->product ? $item->product->name : 'Deleted Product' }}</div>
                                </td>
                                <td>₹{{ $item->price }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end fw-bold">₹{{ $item->total }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="3" class="text-end fw-semibold">Subtotal:</td>
                                <td class="text-end fw-bold">₹{{ number_format($order->subtotal, 0) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-semibold">Tax:</td>
                                <td class="text-end fw-bold">₹{{ number_format($order->tax_amount, 0) }}</td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-end fw-semibold">Delivery Charge:</td>
                                <td class="text-end fw-bold">{{ $order->delivery_charge > 0 ? '₹' . number_format($order->delivery_charge, 0) : 'Free' }}</td>
                            </tr>
                            @if($order->coupon_code)
                            <tr>
                                <td colspan="3" class="text-end fw-semibold text-success">
                                    Discount ({{ $order->coupon_code }}):
                                </td>
                                <td class="text-end fw-bold text-success">- ₹{{ number_format($order->discount_amount, 0) }}</td>
                            </tr>
                            @endif
                            <tr>
                                <td colspan="3" class="text-end fw-bold fs-5">Grand Total:</td>
                                <td class="text-end fw-bold fs-5 text-primary">₹{{ number_format($order->total_amount, 0) }}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card border-0 shadow-sm glass-effect mb-4 h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold border-bottom pb-2 mb-3">Customer Details</h6>
                        <p class="mb-1"><strong>Name:</strong> {{ $order->user ? $order->user->name : 'Guest' }}</p>
                        <p class="mb-1"><strong>Email:</strong> {{ $order->user ? $order->user->email : 'N/A' }}</p>
                        <p class="mb-1"><strong>Payment:</strong> <span class="badge bg-secondary text-uppercase">{{ $order->payment_method }}</span></p>
                        @if($order->notes)
                        <div class="mt-3">
                            <h6 class="fw-semibold mb-1">Order Notes:</h6>
                            <p class="text-muted small mb-0">{{ $order->notes }}</p>
                        </div>
                        @else
                        <div class="mt-3">
                            <h6 class="fw-semibold mb-1">Order Notes:</h6>
                            <p class="text-muted small mb-0">No notes provided.</p>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card border-0 shadow-sm glass-effect mb-4 h-100">
                    <div class="card-body p-4">
                        <h6 class="fw-semibold border-bottom pb-2 mb-3">Shipping Address</h6>
                        <p class="mb-0 text-muted">{{ $order->shipping_address ?? 'No shipping address provided.' }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Updates -->
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm glass-effect mb-4">
            <div class="card-header bg-transparent border-0 pt-4 pb-0">
                <h5 class="fw-semibold mb-0">Update Status</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.orders.update', $order->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label class="form-label fw-semibold">Order Status</label>
                        <select name="status" class="form-select">
                            <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="processing" {{ $order->status == 'processing' ? 'selected' : '' }}>Processing</option>
                            <option value="shipped" {{ $order->status == 'shipped' ? 'selected' : '' }}>Shipped</option>
                            <option value="delivered" {{ $order->status == 'delivered' ? 'selected' : '' }}>Delivered</option>
                            <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="form-label fw-semibold">Payment Status</label>
                        <select name="payment_status" class="form-select">
                            <option value="pending" {{ $order->payment_status == 'pending' ? 'selected' : '' }}>Pending</option>
                            <option value="paid" {{ $order->payment_status == 'paid' ? 'selected' : '' }}>Paid</option>
                            <option value="failed" {{ $order->payment_status == 'failed' ? 'selected' : '' }}>Failed</option>
                        </select>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary"><i class="fa-solid fa-save me-2"></i> Update Order</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
