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

                    <form id="checkoutForm">

                        <div class="row g-4">

                            <!-- First Name -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    First Name <span>*</span>
                                </label>

                                <input
                                    type="text"
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
                                    class="form-control"
                                    placeholder="Enter Phone Number"
                                    required>

                            </div>

                            <!-- Country -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Country <span>*</span>
                                </label>

                                <select class="form-select" required>

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

                                <select class="form-select" required>

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
                                    class="form-control"
                                    placeholder="Enter ZIP Code"
                                    required>

                            </div>

                            <!-- Company -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Company Name
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="Company Name (Optional)">

                            </div>

                            <!-- GST -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    GST Number
                                </label>

                                <input
                                    type="text"
                                    class="form-control"
                                    placeholder="GST Number (Optional)">

                            </div>

                            <!-- Notes -->

                            <div class="col-12">

                                <label class="form-label">
                                    Order Notes
                                </label>

                                <textarea
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
                            $subtotal = 0;
                            $tax = 0;
                        @endphp
                        @forelse($cartItems as $item)
                        @php
                            $product = $item->product;
                            $price = $product->sale_price ?: $product->price;
                            $productTax = $product->tax ? $product->tax->percentage : 0;
                            $taxAmount = ($price * $productTax) / 100;
                            $itemTotal = ($price + $taxAmount) * $item->quantity;
                            
                            $subtotal += $price * $item->quantity;
                            $tax += $taxAmount * $item->quantity;
                        @endphp
                        <div class="product-item">
                            <div>
                                <h6>{{ $product->name }}</h6>
                                <span>Qty : {{ $item->quantity }}</span>
                            </div>
                            <strong>₹{{ number_format($itemTotal, 2) }}</strong>
                        </div>
                        @empty
                        <div class="product-item">
                            <div><h6>Your cart is empty</h6></div>
                        </div>
                        @endforelse
                    </div>

                    <!-- Price Summary -->

                    <div class="summary-list" id="checkoutSummaryList" 
                        data-min-order="{{ isset($deliverySettings) ? $deliverySettings->min_order_amount : 0 }}"
                        data-delivery-charge="{{ isset($deliverySettings) ? $deliverySettings->standard_delivery_charge : 0 }}"
                        data-free-delivery="{{ isset($deliverySettings) && $deliverySettings->free_delivery_threshold ? $deliverySettings->free_delivery_threshold : 0 }}">

                        <div class="summary-item">

                            <span>Subtotal</span>

                            <strong id="summarySubtotal">₹27,400</strong>

                        </div>

                        <div class="summary-item">

                            <span>Shipping</span>

                            <strong id="summaryShipping">Free</strong>

                        </div>

                        <div class="summary-item">

                            <span>Tax</span>

                            <strong id="summaryTax">₹4,572</strong>

                        </div>

                        <div class="summary-item">
                            <span>Discount</span>
                            <strong id="summaryDiscount" class="text-success">- ₹0</strong>
                        </div>

                        <div class="summary-item total">

                            <span>Grand Total</span>

                            <strong id="summaryGrandTotal">₹31,972</strong>

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
            return number.toLocaleString("en-IN", { minimumFractionDigits: 2, maximumFractionDigits: 2 });
        }

        function calculateCheckout() {
            const summaryList = document.getElementById('checkoutSummaryList');
            if (!summaryList) return;

            // Use server calculated values
            const subtotal = {{ $subtotal }};
            const tax = {{ $tax }};
            const discount = 0; // Coupon discount placeholder

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
    });
</script>
@endpush