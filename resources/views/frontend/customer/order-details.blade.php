@extends('frontend.layouts.master')

@section('content')
<style>
    body.dark-mode .dashboard-section, body.dark-mode .dashboard-section * {
        color: #ffffff;
    }
    body.dark-mode .card, body.dark-mode .list-group-item {
        background-color: var(--cream-2, #12241a) !important;
        border-color: var(--border, rgba(200, 155, 35, 0.28)) !important;
    }
    body.dark-mode .table-light, body.dark-mode thead th {
        background-color: var(--cream, #08140e) !important;
        color: #ffffff !important;
        border-color: var(--border, rgba(200, 155, 35, 0.28)) !important;
    }
    body.dark-mode .table td {
        border-color: var(--border, rgba(200, 155, 35, 0.28)) !important;
    }
    body.dark-mode .text-muted {
        color: var(--muted, #d9d9d9) !important;
    }
</style>
<section class="contactmain-contact-hero">
    <div class="container-xl">
        <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">Home</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('customer.dashboard') }}">Dashboard</a>
                <i class="bi bi-chevron-right"></i>
                <span>Order Details</span>
            </nav>
        </div>
    </div>
</section>

<section class="dashboard-section py-5">
    <div class="container">
        <div class="row mb-4">
            <div class="col-12 d-flex justify-content-between align-items-center">
                <h3 class="mb-0">Order #{{ $order->order_number }}</h3>
                <a href="{{ route('customer.dashboard') }}" class="btn btn-dark btn-sm"><i class="bi bi-arrow-left"></i> Back to Dashboard</a>
            </div>
        </div>

        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card shadow-sm border-0 mb-4 h-100">
                    <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                        <h5 class="mb-0">Order Items</h5>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th class="text-end">Total</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                @php
                                                    $imageUrl = 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85';
                                                    if ($item->product) {
                                                        if ($item->product->featuredImage) {
                                                            $imageUrl = asset('storage/' . $item->product->featuredImage->image_path);
                                                        } elseif ($item->product->images->isNotEmpty()) {
                                                            $imageUrl = asset('storage/' . $item->product->images->first()->image_path);
                                                        }
                                                    }
                                                @endphp
                                                <img src="{{ $imageUrl }}" class="rounded me-3" style="width: 50px; height: 50px; object-fit: cover;" alt="{{ $item->product ? $item->product->name : 'Deleted Product' }}">
                                                <div>
                                                    <h6 class="mb-0">{{ $item->product ? $item->product->name : 'Deleted Product' }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>₹{{ number_format($item->price, 0) }}</td>
                                        <td>{{ $item->quantity }}</td>
                                        <td class="text-end fw-bold">₹{{ number_format($item->total, 0) }}</td>
                                        <td class="text-center">
                                            @if($order->status === 'delivered' && $item->product)
                                                @php
                                                    $existingReview = \App\Models\ProductReview::where('product_id', $item->product_id)
                                                        ->where('customer_id', auth('customer')->id())
                                                        ->where('order_id', $order->id)
                                                        ->first();
                                                @endphp
                                                @if(!$existingReview)
                                                    <button type="button" class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#reviewModal{{ $item->id }}">
                                                        Write Review
                                                    </button>

                                                    <!-- Review Modal -->
                                                    <div class="modal fade text-start" id="reviewModal{{ $item->id }}" tabindex="-1" aria-labelledby="reviewModalLabel{{ $item->id }}" aria-hidden="true">
                                                      <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                          <div class="modal-header border-0 pb-0">
                                                            <h5 class="modal-title" id="reviewModalLabel{{ $item->id }}">Review {{ $item->product->name }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                          </div>
                                                          <form action="{{ route('customer.reviews.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="product_id" value="{{ $item->product_id }}">
                                                            <input type="hidden" name="order_id" value="{{ $order->id }}">
                                                            <div class="modal-body">
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Rating</label>
                                                                    <select class="form-select" name="rating" required>
                                                                        <option value="5" selected>5 - Excellent</option>
                                                                        <option value="4">4 - Good</option>
                                                                        <option value="3">3 - Average</option>
                                                                        <option value="2">2 - Poor</option>
                                                                        <option value="1">1 - Terrible</option>
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3">
                                                                    <label class="form-label fw-semibold">Your Review</label>
                                                                    <textarea class="form-control" name="review" rows="4" required placeholder="Tell us what you thought about this product..."></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer border-0 pt-0">
                                                              <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                              <button type="submit" class="btn btn-primary px-4">Submit Review</button>
                                                            </div>
                                                          </form>
                                                        </div>
                                                      </div>
                                                    </div>
                                                @else
                                                    <span class="text-success"><i class="bi bi-check-circle"></i> Reviewed</span>
                                                @endif
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="table-light">
                                    <tr>
                                        <td colspan="4" class="text-end fw-semibold">Subtotal:</td>
                                        <td class="text-end fw-bold">₹{{ number_format($order->subtotal, 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-semibold">Tax:</td>
                                        <td class="text-end fw-bold">₹{{ number_format($order->tax_amount, 0) }}</td>
                                    </tr>
                                    <tr>
                                        <td colspan="4" class="text-end fw-semibold">Delivery Charge:</td>
                                        <td class="text-end fw-bold">{{ $order->delivery_charge > 0 ? '₹' . number_format($order->delivery_charge, 0) : 'Free' }}</td>
                                    </tr>
                                    @if($order->coupon_code)
                                    <tr>
                                        <td colspan="4" class="text-end fw-semibold text-success">
                                            Discount ({{ $order->coupon_code }}):
                                        </td>
                                        <td class="text-end fw-bold text-success">- ₹{{ number_format($order->discount_amount, 0) }}</td>
                                    </tr>
                                    @endif
                                    <tr>
                                        <td colspan="4" class="text-end fw-bold fs-5">Grand Total:</td>
                                        <td class="text-end fw-bold fs-5 text-success">₹{{ number_format($order->total_amount, 0) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                        <h5 class="mb-0">Order Summary</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Order Date</span>
                                <strong>{{ $order->created_at->format('d M Y, h:i A') }}</strong>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Order Status</span>
                                @php
                                    $statusColors = [
                                        'pending' => 'warning',
                                        'processing' => 'info',
                                        'shipped' => 'primary',
                                        'delivered' => 'success',
                                        'cancelled' => 'danger',
                                    ];
                                    $color = $statusColors[$order->status] ?? 'secondary';
                                @endphp
                                <span class="badge bg-{{ $color }} rounded-pill">{{ ucfirst($order->status) }}</span>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Payment Method</span>
                                <span class="badge border text-dark text-uppercase bg-light">{{ $order->payment_method }}</span>
                            </li>
                            <li class="list-group-item px-0 d-flex justify-content-between">
                                <span class="text-muted">Payment Status</span>
                                <span class="badge bg-{{ $order->payment_status == 'paid' ? 'success' : 'warning' }} rounded-pill">{{ ucfirst($order->payment_status) }}</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm border-0 mb-4">
                    <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                        <h5 class="mb-0">Shipping Details</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">{{ $order->shipping_address }}</p>
                    </div>
                </div>

                @if($order->notes)
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                        <h5 class="mb-0">Order Notes</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 text-muted">{{ $order->notes }}</p>
                    </div>
                </div>
                @else
                <div class="card shadow-sm border-0">
                    <div class="card-header bg-transparent border-bottom pt-4 pb-3">
                        <h5 class="mb-0">Order Notes</h5>
                    </div>
                    <div class="card-body">
                        <p class="mb-0 text-muted">No notes provided.</p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
