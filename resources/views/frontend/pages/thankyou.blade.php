@extends('frontend.layouts.master')

@section('content')
<section class="products-hero">
    <div class="container-xl">
        <div class="products-hero-copy reveal-up text-center w-100">
            <h1 class="mb-4">Thank <span>You!</span></h1>
            <p>Your order has been placed successfully.</p>
        </div>
    </div>
</section>

<section class="py-5 text-center">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <i class="bi bi-check-circle-fill text-success" style="font-size: 5rem;"></i>
                <h2 class="mt-4">Order Confirmed</h2>
                <p class="lead">Order Number: <strong>{{ $order->order_number }}</strong></p>
                <p>We've received your order and are getting it ready for you. You will receive an email confirmation shortly.</p>
                
                <div class="card mt-4 text-start">
                    <div class="card-body bg-light">
                        <h5>Order Details:</h5>
                        <p class="mb-1"><strong>Total Amount:</strong> ₹{{ number_format(round($order->total_amount), 0) }}</p>
                        <p class="mb-1"><strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}</p>
                        <p class="mb-1"><strong>Shipping Address:</strong> {{ $order->shipping_address }}</p>
                    </div>
                </div>

                <div class="mt-5">
                    <a href="{{ route('home') }}" class="btn btn-gold me-3">Continue Shopping</a>
                    <a href="{{ route('customer.dashboard') }}" class="btn btn-dark">View My Orders</a>
                    <a href="{{ route('customer.order.details', $order->id) }}" class="btn btn-outline-dark ms-3">View Order Details</a>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
