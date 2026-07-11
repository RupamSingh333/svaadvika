@extends('frontend.layouts.master')

@section('content')
<section class="contactmain-contact-hero">
        <div class="container-xl">
          <div class="contact-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>Login</span>
            </nav> 
          </div>
        </div>
      </section>
<section class="dashboard-section py-5">

    <div class="container">

        <!-- Mobile Menu Button -->

        <div class="d-lg-none mb-4">

            <button class="btn btn-dark"
                    data-bs-toggle="offcanvas"
                    data-bs-target="#dashboardSidebar">

                <i class="bi bi-list"></i>
                Dashboard Menu

            </button>

        </div>

        <div class="row g-4">

            <!--====================================
                    Sidebar
            =====================================-->

            <div class="col-lg-3 d-none d-lg-block">

                <div class="dashboard-sidebar">

                    <h2 class="dashboard-title">
                        Dashboard
                    </h2>

                    <ul class="dashboard-menu">

                        <li>

                            <a href="#"
                               class="active menu-link"
                               data-target="dashboard-content">

                                <i class="bi bi-grid"></i>

                                Dashboard

                            </a>

                        </li>

                        <li>

                            <a href="#"
                               class="menu-link"
                               data-target="orders-content">

                                <i class="bi bi-bag"></i>

                                Orders

                            </a>

                        </li>

                        <li>

                            <a href="#"
                               class="menu-link"
                               data-target="account-content">

                                <i class="bi bi-person"></i>

                                Account Details

                            </a>

                        </li>

                        <li>

                            <a href="#"
                               class="menu-link"
                               data-target="address-content">

                                <i class="bi bi-geo-alt"></i>

                                Address

                            </a>

                        </li>

                        <li>

                            <a href="#"
                               class="menu-link"
                               data-target="wishlist-content">

                                <i class="bi bi-heart"></i>

                                Wishlist

                            </a>

                        </li>

                        <li>

                            <a href="#"
                               class="menu-link">

                                <i class="bi bi-box-arrow-right"></i>

                                Logout

                            </a>

                        </li>

                    </ul>

                </div>

            </div>

            <!--====================================
                Mobile Sidebar
            =====================================-->

            <div class="offcanvas offcanvas-start"
                 tabindex="-1"
                 id="dashboardSidebar">

                <div class="offcanvas-header">

                    <h5>Dashboard</h5>

                    <button class="btn-close"
                            data-bs-dismiss="offcanvas"></button>

                </div>

                <div class="offcanvas-body">

                    <ul class="dashboard-menu mobile-menu">

                        <li>
                            <a href="#" class="active menu-link" data-target="dashboard-content">
                                Dashboard
                            </a>
                        </li>

                        <li>
                            <a href="#" class="menu-link" data-target="orders-content">
                                Orders
                            </a>
                        </li>

                        <li>
                            <a href="#" class="menu-link" data-target="account-content">
                                Account Details
                            </a>
                        </li>

                        <li>
                            <a href="#" class="menu-link" data-target="address-content">
                                Address
                            </a>
                        </li>

                        <li>
                            <a href="#" class="menu-link" data-target="wishlist-content">
                                Wishlist
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                Logout
                            </a>
                        </li>

                    </ul>

                </div>

            </div>

            <!--====================================
                    Right Content
            =====================================-->

            <div class="col-lg-9">

                <!-- Dashboard Content -->

                <div id="dashboard-content" class="dashboard-page active-page">

                    <!-- Cover -->

                    <div class="profile-cover">

                        <img src="https://scontent.fjai1-1.fna.fbcdn.net/v/t39.30808-6/736493949_1048296358148832_1576313786120375488_n.jpg?stp=dst-jpg_tt6&cstp=mx1942x809&ctp=s960x960&_nc_cat=106&ccb=1-7&_nc_sid=cc71e4&_nc_ohc=x44XCB8Sk6gQ7kNvwHdFI9S&_nc_oc=AdowRxoZ572n8dHcbpRJFTdiLks77F_gCbsjJf13nYp_yGIzTQJRwoRR2ORI-Gl7SL2bhKFGHW6NPAoDqgPfIEDU&_nc_zt=23&_nc_ht=scontent.fjai1-1.fna&_nc_gid=zFjleI2GQxFvqRcL3Qprow&_nc_ss=7b2a8&oh=00_AQA-NOrG0lXS_1aEucYCG4iol85cHQGgRHvUABSkrSbhlw&oe=6A53C8C7"
                             alt="Cover">

                        <button class="btn btn-primary edit-btn">

                            <i class="bi bi-pencil"></i>

                            Edit Detail

                        </button>

                    </div>

                    <!-- Profile -->

                    <div class="profile-wrapper">

                        <div class="profile-image">

                            <img src="https://scontent.fjai1-4.fna.fbcdn.net/v/t39.30808-1/734313874_1048293371482464_7043703285326087481_n.jpg?stp=dst-jpg_tt6&cstp=mx1254x1254&ctp=s200x200&_nc_cat=110&ccb=1-7&_nc_sid=2d3e12&_nc_ohc=6pGx0oS_QJkQ7kNvwGkLDzJ&_nc_oc=AdpPSEV2YbatFTj9_Ao_W4goqjJAFNXrLX1oK2j4YE5niYg3y-odd1mkrYaFgyeI7JU_RhD9JncUIQ1-YnWQ1o2H&_nc_zt=24&_nc_ht=scontent.fjai1-4.fna&_nc_gid=zFjleI2GQxFvqRcL3Qprow&_nc_ss=7b2a8&oh=00_AQDeppeCkYzu8G7NE4zK12QGghygadDyDFfTe-DWcb2Mxw&oe=6A53B4DC"
                                 alt="Profile">

                        </div>

                        <div class="profile-info">

                            <h3>Surendra Singh</h3>

                            <p>

                                Premium Customer

                            </p>

                        </div>

                    </div>

                    <hr class="my-5">

                    <h3 class="section-heading">

                        Account Information

                    </h3>

                    <div class="row g-4">

                        <div class="col-md-6">

                            <div class="info-card">

                                <p><strong>First Name :</strong> Surendra</p>

                                <p><strong>Last Name :</strong> Singh</p>

                                <p><strong>Email :</strong> demo@gmail.com</p>

                                <p><strong>Phone :</strong> +91 9876543210</p>

                            </div>

                        </div>

                        <div class="col-md-6">

                            <div class="info-card">

                                <p><strong>Street :</strong> Jaipur</p>

                                <p><strong>City :</strong> Jaipur</p>

                                <p><strong>State :</strong> Rajasthan</p>

                                <p><strong>Zip Code :</strong> 302001</p>

                            </div>

                        </div>

                    </div>

                </div>

                <!-- Other Sections Part 2 me aayenge -->
<!--====================================
        Orders Section
=====================================-->

<div id="orders-content" class="dashboard-page d-none">

    <div class="content-card">

        <div class="d-flex justify-content-between align-items-center mb-4">

            <h3 class="section-heading mb-0">
                My Orders
            </h3>

            <button class="btn btn-green">
                <i class="bi bi-plus-circle"></i>
                New Order
            </button>

        </div>

        <div class="table-responsive">

            <table class="table table-bordered align-middle">

                <thead>

                    <tr>

                        <th>Order ID</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Total</th>
                        <th>Action</th>

                    </tr>

                </thead>

                <tbody>

                    <tr>

                        <td>#1001</td>
                        <td>07 July 2026</td>
                        <td>
                            <span class="badge bg-success">
                                Delivered
                            </span>
                        </td>
                        <td>₹2,450</td>

                        <td>

                            <button class="btn btn-sm btn-primary">

                                View

                            </button>

                        </td>

                    </tr>

                    <tr>

                        <td>#1002</td>
                        <td>03 July 2026</td>

                        <td>

                            <span class="badge bg-warning text-dark">

                                Processing

                            </span>

                        </td>

                        <td>₹4,980</td>

                        <td>

                            <button class="btn btn-sm btn-primary">

                                View

                            </button>

                        </td>

                    </tr>

                </tbody>

            </table>

        </div>

    </div>

</div>

<!--====================================
        Account Details
=====================================-->

<div id="account-content" class="dashboard-page d-none">

    <div class="content-card">

        <h3 class="section-heading">

            Account Details

        </h3>

        <form>

            <div class="row g-4">

                <div class="col-md-6">

                    <label>First Name</label>

                    <input
                        type="text"
                        class="form-control"
                        value="Surendra">

                </div>

                <div class="col-md-6">

                    <label>Last Name</label>

                    <input
                        type="text"
                        class="form-control"
                        value="Singh">

                </div>

                <div class="col-md-6">

                    <label>Email</label>

                    <input
                        type="email"
                        class="form-control"
                        value="demo@gmail.com">

                </div>

                <div class="col-md-6">

                    <label>Phone</label>

                    <input
                        type="text"
                        class="form-control"
                        value="9876543210">

                </div>

                <div class="col-md-6">

                    <label>Password</label>

                    <input
                        type="password"
                        class="form-control">

                </div>

                <div class="col-md-6">

                    <label>Confirm Password</label>

                    <input
                        type="password"
                        class="form-control">

                </div>

                <div class="col-12 mt-4">

                    <button class="btn btn-green">

                        Save Changes

                    </button>

                </div>

            </div>

        </form>

    </div>

</div>

<!--====================================
        Address Section
=====================================-->

<div id="address-content" class="dashboard-page d-none">

    <div class="content-card">

        <h3 class="section-heading">

            Billing Address

        </h3>

        <div class="row g-4">

            <div class="col-md-6">

                <label>Street</label>

                <input
                    class="form-control"
                    type="text">

            </div>

            <div class="col-md-6">

                <label>City</label>

                <input
                    class="form-control"
                    type="text">

            </div>

            <div class="col-md-6">

                <label>State</label>

                <input
                    class="form-control"
                    type="text">

            </div>

            <div class="col-md-6">

                <label>ZIP Code</label>

                <input
                    class="form-control"
                    type="text">

            </div>

            <div class="col-12">

                <button class="btn btn-green">

                    Save Address

                </button>

            </div>

        </div>

    </div>

</div>

<!--====================================
        Wishlist
=====================================-->

<div id="wishlist-content" class="dashboard-page d-none">

    <div class="content-card">

        <h3 class="section-heading">

            Wishlist

        </h3>

        <div class="row g-4">

            <div class="col-lg-4 col-md-6">

                <div class="wishlist-card">

                    <img
                        src="images/product1.jpg') }}"
                        class="img-fluid">

                    <h5 class="mt-3">

                        Product Name

                    </h5>

                    <p>

                        ₹1,250

                    </p>

                    <button class="btn btn-green w-100">

                        Add to Cart

                    </button>

                </div>

            </div>

            <div class="col-lg-4 col-md-6">

                <div class="wishlist-card">

                    <img
                        src="images/product2.jpg') }}"
                        class="img-fluid">

                    <h5 class="mt-3">

                        Product Name

                    </h5>

                    <p>

                        ₹2,450

                    </p>

                    <button class="btn btn-green w-100">

                        Add to Cart

                    </button>

                </div>

            </div>

        </div>

    </div>

</div>
            </div>

        </div>

    </div>

</section>


            </div>

        </div>

    </div>

</section>
@endsection