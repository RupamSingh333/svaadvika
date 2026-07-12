@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>Checkout</span>
            </nav> 
          </div>
        </div>
      </section>
 <section class="checkout-section py-5">

    <div class="container">

        <div class="row g-4">

            <!--=====================================
                    Billing Details
            ======================================-->

            <div class="col-lg-8">

                <div class="checkout-card">

                    <div class="card-title">

                        <h3>Billing Details</h3>

                    </div>

                    <form method="POST" action="{{ route('checkout.process') }}" id="checkoutForm">
                        @csrf
                        
                        @if(isset($addresses) && $addresses->isNotEmpty())
                        <div class="mb-4">
                            <h5>Saved Addresses</h5>
                            <div class="row g-3 mt-2">
                                @foreach($addresses as $address)
                                <div class="col-md-6">
                                    <label class="border p-3 rounded w-100 h-100" style="cursor: pointer;">
                                        <input type="radio" name="address_id" value="{{ $address->id }}" class="form-check-input me-2 address-selector">
                                        <strong>{{ ucfirst($address->type) }}</strong><br>
                                        <small>{{ $address->address }}, {{ $address->city }}, {{ $address->state }}, {{ $address->postal_code }}, {{ $address->country }}</small>
                                    </label>
                                </div>
                                @endforeach
                                <div class="col-md-6">
                                    <label class="border p-3 rounded w-100 h-100" style="cursor: pointer;">
                                        <input type="radio" name="address_id" value="" class="form-check-input me-2 address-selector" checked>
                                        <strong>New Address</strong><br>
                                        <small>Enter a new address below</small>
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endif

                        <div class="row g-4">

                            <!-- First Name -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    First Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="first_name"
                                    class="form-control"
                                    placeholder="Enter First Name"
                                    required>

                            </div>

                            <!-- Last Name -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Last Name <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="last_name"
                                    class="form-control"
                                    placeholder="Enter Last Name"
                                    required>

                            </div>

                            <!-- Email -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Email Address <span>*</span>
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    placeholder="Enter Email Address"
                                    required>

                            </div>

                            <!-- Phone -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Phone Number <span>*</span>
                                </label>

                                <input
                                    type="tel"
                                    name="phone"
                                    pattern="[0-9]*"
                                    class="form-control"
                                    placeholder="Enter Phone Number"
                                    required>

                            </div>

                            <!-- Country -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Country <span>*</span>
                                </label>

                                <select name="country" class="form-select" required>

                                    <option value="">
                                        Select Country
                                    </option>

                                    <option>
                                        India
                                    </option>

                                    <option>
                                        United States
                                    </option>

                                    <option>
                                        United Kingdom
                                    </option>

                                </select>

                            </div>

                            <!-- State -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    State <span>*</span>
                                </label>

                                <select name="state" class="form-select" required>

                                    <option value="">
                                        Select State
                                    </option>

                                    <option>
                                        Rajasthan
                                    </option>

                                    <option>
                                        Delhi
                                    </option>

                                    <option>
                                        Uttar Pradesh
                                    </option>

                                </select>

                            </div>

                            <!-- Address -->

                            <div class="col-12">

                                <label class="form-label">
                                    Street Address <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="address"
                                    class="form-control mb-3"
                                    placeholder="House No., Building Name"
                                    required>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Apartment, Suite, Unit (Optional)">

                            </div>

                            <!-- City -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    City <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="city"
                                    class="form-control"
                                    placeholder="Enter City"
                                    required>

                            </div>

                            <!-- Zip -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Postcode / ZIP <span>*</span>
                                </label>

                                <input
                                    type="text"
                                    name="postal_code"
                                    pattern="[0-9]*"
                                    class="form-control"
                                    placeholder="Enter ZIP Code"
                                    required>

                            </div>
                           
                            <!-- Notes -->

                            <div class="col-12">

                                <label class="form-label">
                                    Order Notes
                                </label>

                                <textarea
                                    name="notes"
                                    class="form-control"
                                    rows="5"
                                    placeholder="Write your order notes here..."></textarea>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

            <!--=====================================
                Order Summary
                (Part 2 me aayega)
            ======================================-->

            <div class="col-lg-4">
                <div class="checkout-summary">

                    <div class="card-title">
                        <h3>Order Summary</h3>
                    </div>

                    <!-- Products -->
                    <div class="order-products">
                        @php
                            $checkout_subtotal = 0;
                            $checkout_tax = 0;
                        @endphp
                        @forelse($cart->items as $item)
                        @php
                            $product = $item->product;
                            $price = $product->sale_price ?: $product->price;
                            $productTax = $product->tax ? $product->tax->percentage : 0;
                            $taxAmount = ($price * $productTax) / 100;
                            $itemTotal = ($price + $taxAmount) * $item->quantity;
                            
                            $checkout_subtotal += $price * $item->quantity;
                            $checkout_tax += $taxAmount * $item->quantity;
                        @endphp
                        <div class="product-item">
                            <div>
                                <h6>{{ $product->name }}</h6>
                                <span>Qty : {{ $item->quantity }}</span>
                            </div>
                            <strong>₹{{ number_format(round($itemTotal), 0) }}</strong>
                        </div>
                        @empty
                        <div class="product-item">
                            <div><h6>Your cart is empty</h6></div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Coupon Code -->
                    <div class="coupon-box mb-4">
                        <div class="input-group">
                            <input type="text" id="coupon_code" class="form-control" placeholder="Enter Coupon Code" 
                                   {{ session('applied_coupon_id') ? 'readonly' : '' }}>
                            <button class="btn btn-dark" type="button" id="apply_coupon_btn" 
                                    style="{{ session('applied_coupon_id') ? 'display: none;' : '' }}">Apply</button>
                            <button class="btn btn-danger" type="button" id="remove_coupon_btn" 
                                    style="{{ session('applied_coupon_id') ? '' : 'display: none;' }}">Remove</button>
                        </div>
                        <small id="coupon_message" class="text-success mt-1 d-block" style="{{ session('applied_coupon_id') ? '' : 'display: none;' }}">
                            Coupon applied successfully!
                        </small>
                    </div>

                    <!-- Price Summary -->

                    <div class="summary-list" id="checkoutSummaryList" 
                        data-min-order="{{ isset($deliverySettings) ? $deliverySettings->min_order_amount : 0 }}"
                        data-delivery-charge="{{ isset($deliverySettings) ? $deliverySettings->standard_delivery_charge : 0 }}"
                        data-free-delivery="{{ isset($deliverySettings) && $deliverySettings->free_delivery_threshold ? $deliverySettings->free_delivery_threshold : 0 }}">

                        <div class="summary-item">

                            <span>Subtotal</span>

                            <strong id="summarySubtotal">₹{{ number_format(round($subtotal), 0) }}</strong>

                        </div>

                        <div class="summary-item">

                            <span>Shipping</span>

                            <strong id="summaryShipping">{{ $deliveryCharge > 0 ? '₹' . number_format(round($deliveryCharge), 0) : 'Free' }}</strong>

                        </div>

                        <div class="summary-item">

                            <span>Tax</span>

                            <strong id="summaryTax">₹{{ number_format(round($taxAmount), 0) }}</strong>

                        </div>

                        <div class="summary-item">
                            <span>Discount</span>
                            <strong id="summaryDiscount" class="text-success">- ₹0</strong>
                        </div>

                        <div class="summary-item total">

                            <span>Grand Total</span>

                            <strong id="summaryGrandTotal">₹{{ number_format(round($total), 0) }}</strong>

                        </div>

                    </div>

                    <!-- Payment -->

                    <div class="payment-box">

                        <h5 class="payment-title">

                            Payment Method

                        </h5>

                        <div class="payment-option">

                            <input
                                type="radio"
                                id="cod"
                                name="payment"
                                checked>

                            <label for="cod">

                                Cash On Delivery

                            </label>

                        </div>

                        <div class="payment-option">

                            <input
                                type="radio"
                                id="razorpay"
                                name="payment">

                            <label for="razorpay">

                                Razorpay

                            </label>

                        </div>

                        <div class="payment-option">

                            <input
                                type="radio"
                                id="payu"
                                name="payment">

                            <label for="payu">

                                PayU

                            </label>

                        </div>

                    </div>

                    <!-- Terms -->

                    <div class="terms-box">

                        <div class="form-check">

                            <input
                                class="form-check-input"
                                type="checkbox"
                                id="terms"
                                required>

                            <label
                                class="form-check-label"
                                for="terms">

                                I have read and agree to the

                                <a href="#">

                                    Terms & Conditions

                                </a>

                            </label>

                        </div>

                    </div>

                    <!-- Button -->

                    <button
                        type="submit"
                        form="checkoutForm"
                        class="btn btn-green w-100 place-order-btn">

                        <i class="bi bi-bag-check"></i>

                        Place Order

                    </button>

                    <div class="secure-checkout">

                        <i class="bi bi-shield-lock-fill"></i>

                        100% Secure Checkout

                    </div>

                </div>

            </div>

        </div>

    </div>

</section>
@endsection

@push('scripts')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        function formatNumber(number) {
            return Math.round(number).toLocaleString("en-IN");
        }

        function calculateCheckout() {
            const summaryList = document.getElementById('checkoutSummaryList');
            if (!summaryList) return;

            // Use server calculated values
            const subtotal = {{ $subtotal }};
            const tax = {{ $taxAmount }};
            const discount = {{ $discountAmount ?? 0 }}; // Coupon discount from backend

            const minOrder = parseFloat(summaryList.getAttribute('data-min-order')) || 0;
            const standardDelivery = parseFloat(summaryList.getAttribute('data-delivery-charge')) || 0;
            const freeDeliveryThreshold = parseFloat(summaryList.getAttribute('data-free-delivery')) || 0;

            let deliveryCharge = standardDelivery;
            
            // Check free delivery threshold
            if (freeDeliveryThreshold > 0 && subtotal >= freeDeliveryThreshold) {
                deliveryCharge = 0;
            }

            const grandTotal = subtotal + tax + deliveryCharge - discount;

            // Update DOM
            document.getElementById('summarySubtotal').innerHTML = "₹" + formatNumber(subtotal);
            document.getElementById('summaryTax').innerHTML = "₹" + formatNumber(tax);
            document.getElementById('summaryDiscount').innerHTML = "- ₹" + formatNumber(discount);
            
            if (deliveryCharge === 0) {
                document.getElementById('summaryShipping').innerHTML = "Free";
            } else {
                document.getElementById('summaryShipping').innerHTML = "₹" + formatNumber(deliveryCharge);
            }

            document.getElementById('summaryGrandTotal').innerHTML = "₹" + formatNumber(grandTotal);

            // Validation for minimum order amount
            const placeOrderBtn = document.querySelector('.place-order-btn');
            if (placeOrderBtn) {
                if (subtotal < minOrder) {
                    placeOrderBtn.disabled = true;
                    placeOrderBtn.innerHTML = `<i class="bi bi-x-circle"></i> Minimum order is ₹${formatNumber(minOrder)}`;
                    placeOrderBtn.classList.replace('btn-green', 'btn-secondary');
                } else {
                    placeOrderBtn.disabled = false;
                    placeOrderBtn.innerHTML = `<i class="bi bi-bag-check"></i> Place Order`;
                    placeOrderBtn.classList.replace('btn-secondary', 'btn-green');
                }
            }
        }

        // Run calculation on load
        calculateCheckout();

        // Coupon AJAX logic
        const applyCouponBtn = document.getElementById('apply_coupon_btn');
        const removeCouponBtn = document.getElementById('remove_coupon_btn');
        const couponCodeInput = document.getElementById('coupon_code');
        const couponMessage = document.getElementById('coupon_message');

        if (applyCouponBtn) {
            applyCouponBtn.addEventListener('click', function() {
                const code = couponCodeInput.value.trim();
                if (!code) {
                    alert("Please enter a coupon code");
                    return;
                }

                applyCouponBtn.disabled = true;
                applyCouponBtn.innerText = "Applying...";

                fetch("{{ route('checkout.apply_coupon') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    },
                    body: JSON.stringify({ coupon_code: code })
                })
                .then(response => response.json())
                .then(data => {
                    applyCouponBtn.disabled = false;
                    applyCouponBtn.innerText = "Apply";
                    
                    if (data.success) {
                        couponCodeInput.readOnly = true;
                        applyCouponBtn.style.display = 'none';
                        removeCouponBtn.style.display = 'block';
                        couponMessage.innerText = data.message;
                        couponMessage.className = "text-success mt-1 d-block";
                        
                        document.getElementById('summaryDiscount').innerHTML = "- ₹" + formatNumber(data.discount);
                        document.getElementById('summaryGrandTotal').innerHTML = "₹" + formatNumber(data.total);
                    } else {
                        couponMessage.innerText = data.message;
                        couponMessage.className = "text-danger mt-1 d-block";
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    applyCouponBtn.disabled = false;
                    applyCouponBtn.innerText = "Apply";
                });
            });
        }

        if (removeCouponBtn) {
            removeCouponBtn.addEventListener('click', function() {
                removeCouponBtn.disabled = true;
                removeCouponBtn.innerText = "Removing...";

                fetch("{{ route('checkout.remove_coupon') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    removeCouponBtn.disabled = false;
                    removeCouponBtn.innerText = "Remove";
                    
                    if (data.success) {
                        couponCodeInput.readOnly = false;
                        couponCodeInput.value = "";
                        applyCouponBtn.style.display = 'block';
                        removeCouponBtn.style.display = 'none';
                        couponMessage.innerText = "";
                        couponMessage.className = "d-none";
                        
                        document.getElementById('summaryDiscount').innerHTML = "- ₹" + formatNumber(data.discount);
                        document.getElementById('summaryGrandTotal').innerHTML = "₹" + formatNumber(data.total);
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    removeCouponBtn.disabled = false;
                    removeCouponBtn.innerText = "Remove";
                });
            });
        }
    });
</script>
@endpush