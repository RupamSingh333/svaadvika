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

                                        <!-- Product 1 -->

                                        <tr>

                                            <td>

                                                <img src="images/product1.jpg') }}" class="img-fluid product-img" alt="">

                                            </td>

                                            <td>

                                                <h6 class="product-title">
                                                    Sulemani Hakik Crystal Bracelet
                                                </h6>

                                            </td>

                                            <td>

                                                <span class="price">
                                                    ₹2,400
                                                </span>

                                            </td>

                                            <td>

                                                ₹72 (₹3%)

                                            </td>

                                            <td>

                                                <div class="qty-box">

                                                    <button class="qty-btn minus">
                                                        -
                                                    </button>

                                                    <input type="text" value="1" readonly>

                                                    <button class="qty-btn plus">
                                                        +
                                                    </button>

                                                </div>

                                            </td>

                                            <td>

                                                <strong>
                                                    ₹2,400
                                                </strong>

                                            </td>

                                            <td>

                                                <button class="remove-btn">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </td>

                                        </tr>

                                        <!-- Product 2 -->

                                        <tr>

                                            <td>

                                                <img src="images/product2.jpg') }}" class="img-fluid product-img" alt="">

                                            </td>

                                            <td>

                                                <h6 class="product-title">
                                                    COSMIC ROGE NEVARAN YANTRA
                                                </h6>

                                            </td>

                                            <td>

                                                <span class="price">
                                                    ₹25,000
                                                </span>

                                            </td>

                                            <td>

                                                ₹4,500 (₹18%)

                                            </td>

                                            <td>

                                                <div class="qty-box">

                                                    <button class="qty-btn minus">
                                                        -
                                                    </button>

                                                    <input type="text" value="1" readonly>

                                                    <button class="qty-btn plus">
                                                        +
                                                    </button>

                                                </div>

                                            </td>

                                            <td>

                                                <strong>
                                                    ₹25,000
                                                </strong>

                                            </td>

                                            <td>

                                                <button class="remove-btn">

                                                    <i class="bi bi-trash"></i>

                                                </button>

                                            </td>

                                        </tr>

                                        

                                    </tbody>

                                </table>

                            </div>

                        </div>

                        <!-- Continue Shopping -->

                        <div class="mt-5">

                            <a href="#" class="btn btn-green w-100">

                                CONTINUE SHOPPING

                            </a>

                        </div>

                    </div>

                    <!--==============================
                Cart Summary
            ===============================-->

                    <div class="col-lg-3">

                        <div class="summary-card">

                            <h4 class="summary-title">
                                Summary
                            </h4>

                            <div class="summary-item">

                                <span>Sub-Total</span>

                                <span>₹27,400</span>

                            </div>

                            <div class="summary-item">

                                <span>Tax</span>

                                <span>₹4,572</span>

                            </div>

                            <hr>

                            <div class="summary-item total">

                                <span>Total Amount</span>

                                <span>₹31,972</span>

                            </div>

                            <button class="btn btn-green w-100">

                                Check Out

                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </section>
@endsection