@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
            <div class="container-xl">
                <div class="contact-hero-copy reveal-up">
                    <nav class="breadcrumb-nav" aria-label="Breadcrumb">
                        <a href="{{ route('home') }}">Home</a>
                        <i class="bi bi-chevron-right"></i>
                        <span>Cart</span>
                    </nav>
                </div>
            </div>
        </section>
        <section class="cart-section py-5">

            <div class="container">

                <div class="row g-4">

                    <!--==============================
                Cart Table
            ===============================-->

                    <div class="col-lg-9">

                        <div class="cart-table">

                            <div class="table-responsive">

                                <table class="table align-middle">

                                    <thead>

                                        <tr>
                                            <th width="110">Image</th>
                                            <th>Product</th>
                                            <th width="140">Price</th>
                                            <th width="150">Tax</th>
                                            <th width="160">Quantity</th>
                                            <th width="140">Total</th>
                                            <th width="90">Remove</th>
                                        </tr>

                                    </thead>

                                    <tbody>
                                        @forelse($cartItems as $item)
                                        @php
                                            $product = $item->product;
                                            $price = $product->sale_price ?: $product->price;
                                            $tax = $product->tax ? $product->tax->percentage : 0;
                                            $taxAmount = ($price * $tax) / 100;
                                            $total = ($price + $taxAmount) * $item->quantity;
                                            
                                            $imageUrl = 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85';
                                            if ($product->featuredImage) {
                                                $imageUrl = asset('storage/' . $product->featuredImage->image_path);
                                            } elseif ($product->images->isNotEmpty()) {
                                                $imageUrl = asset('storage/' . $product->images->first()->image_path);
                                            }
                                        @endphp
                                        <tr data-item-id="{{ $item->id }}">
                                            <td>
                                                <img src="{{ $imageUrl }}" class="img-fluid product-img" alt="{{ $product->name }}">
                                            </td>
                                            <td>
                                                <h6 class="product-title">{{ $product->name }}</h6>
                                            </td>
                                            <td>
                                                <span class="price">₹{{ number_format($price, 2) }}</span>
                                            </td>
                                            <td>
                                                ₹{{ number_format($taxAmount, 2) }} ({{ $tax }}%)
                                            </td>
                                            <td>
                                                <div class="qty-box" data-item-id="{{ $item->id }}">
                                                    <button class="qty-btn minus">-</button>
                                                    <input type="text" value="{{ $item->quantity }}" readonly>
                                                    <button class="qty-btn plus">+</button>
                                                </div>
                                            </td>
                                            <td>
                                                <strong>₹{{ number_format($total, 2) }}</strong>
                                            </td>
                                            <td>
                                                <button class="remove-btn" data-item-id="{{ $item->id }}">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center py-4">Your cart is empty.</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Continue Shopping -->
                        <div class="mt-5">
                            <a href="{{ route('frontend.products') }}" class="btn btn-green w-100">CONTINUE SHOPPING</a>
                        </div>
                    </div>

                    <!--==============================
                Cart Summary
            ===============================-->
                    <div class="col-lg-3">
                        <div class="summary-card">
                            <h4 class="summary-title">Summary</h4>
                            
                            @php
                                $subtotal = 0;
                                $totalTax = 0;
                                foreach($cartItems as $item) {
                                    $price = $item->product->sale_price ?: $item->product->price;
                                    $tax = $item->product->tax ? $item->product->tax->percentage : 0;
                                    $taxAmount = ($price * $tax) / 100;
                                    
                                    $subtotal += $price * $item->quantity;
                                    $totalTax += $taxAmount * $item->quantity;
                                }
                                $grandTotal = $subtotal + $totalTax;
                            @endphp

                            <div class="summary-item">
                                <span>Sub-Total</span>
                                <span id="cartSubtotal">₹{{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="summary-item">
                                <span>Tax</span>
                                <span id="cartTax">₹{{ number_format($totalTax, 2) }}</span>
                            </div>
                            <hr>
                            <div class="summary-item total">
                                <span>Total Amount</span>
                                <span id="cartGrandTotal">₹{{ number_format($grandTotal, 2) }}</span>
                            </div>
                            <a href="{{ route('checkout') }}" class="btn btn-green w-100 {{ $cartItems->isEmpty() ? 'disabled' : '' }}">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const qtyBoxes = document.querySelectorAll(".qty-box");
    qtyBoxes.forEach((box) => {
        const minus = box.querySelector(".minus");
        const plus = box.querySelector(".plus");
        const input = box.querySelector("input");
        const itemId = box.dataset.itemId;

        const updateBackend = (quantity) => {
            fetch('/api/cart/update', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ item_id: itemId, quantity: quantity })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    window.location.reload(); // simple reload to update all totals correctly
                }
            });
        };

        plus.addEventListener("click", function () {
            let value = parseInt(input.value);
            value++;
            input.value = value;
            updateBackend(value);
        });

        minus.addEventListener("click", function () {
            let value = parseInt(input.value);
            if (value > 1) {
                value--;
                input.value = value;
                updateBackend(value);
            }
        });
    });

    const removeBtns = document.querySelectorAll(".remove-btn");
    removeBtns.forEach((btn) => {
        btn.addEventListener("click", function () {
            if (confirm("Remove this product from cart?")) {
                const itemId = btn.dataset.itemId;
                fetch('/api/cart/remove', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify({ item_id: itemId })
                })
                .then(res => res.json())
                .then(data => {
                    if(data.status === 'success') {
                        window.location.reload();
                    }
                });
            }
        });
    });
});
</script>
@endpush