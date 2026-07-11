@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="index.html">Home</a>
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

                        <div class="product-item">

                            <div>

                                <h6>
                                    Sulemani Hakik Crystal Bracelet
                                </h6>

                                <span>
                                    Qty : 1
                                </span>

                            </div>

                            <strong>
                                ₹2,400
                            </strong>

                        </div>

                        <div class="product-item">

                            <div>

                                <h6>
                                    Cosmic Roge Nevaran Yantra
                                </h6>

                                <span>
                                    Qty : 1
                                </span>

                            </div>

                            <strong>
                                ₹25,000
                            </strong>

                        </div>

                    </div>

                    <!-- Price Summary -->

                    <div class="summary-list">

                        <div class="summary-item">

                            <span>Subtotal</span>

                            <strong>₹27,400</strong>

                        </div>

                        <div class="summary-item">

                            <span>Shipping</span>

                            <strong>Free</strong>

                        </div>

                        <div class="summary-item">

                            <span>Tax</span>

                            <strong>₹4,572</strong>

                        </div>

                        <div class="summary-item total">

                            <span>Grand Total</span>

                            <strong>₹31,972</strong>

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