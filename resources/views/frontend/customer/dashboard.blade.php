@extends('frontend.layouts.master')

@section('title', 'My Dashboard | Svaadvika')
@section('page_title', 'Dashboard')

@section('content')
<style>
    body.dark-mode .dashboard-sidebar, body.dark-mode .info-card, body.dark-mode .content-card {
        background-color: var(--cream-2, #12241a);
        border-color: var(--border, rgba(200, 155, 35, 0.28)) !important;
        color: var(--text, #ffffff);
    }
    body.dark-mode .dashboard-section h2,
    body.dark-mode .dashboard-section h3,
    body.dark-mode .dashboard-section h5,
    body.dark-mode .dashboard-section p,
    body.dark-mode .dashboard-section label,
    body.dark-mode .dashboard-section th,
    body.dark-mode .dashboard-section td,
    body.dark-mode .dashboard-section strong,
    body.dark-mode .dashboard-section span,
    body.dark-mode .dashboard-section div {
        color: #ffffff !important;
    }
    body.dark-mode .dashboard-menu a { color: var(--text, #ffffff) !important; }
    body.dark-mode .dashboard-menu a:hover, body.dark-mode .dashboard-menu a.active { background: rgba(255,255,255,0.1); color: #c89b23 !important; }
    body.dark-mode .bg-light { background-color: var(--cream, #08140e) !important; color: var(--text, #ffffff) !important; }
    body.dark-mode .bg-white { background-color: var(--cream-2, #12241a) !important; }
    body.dark-mode .address-item { background-color: var(--cream-2, #12241a) !important; border-color: var(--border, rgba(200, 155, 35, 0.28)) !important; }
    body.dark-mode .form-control, body.dark-mode .form-select { background-color: var(--cream, #08140e) !important; border-color: var(--border, rgba(200, 155, 35, 0.28)) !important; color: var(--text, #ffffff) !important; }
    body.dark-mode .form-control:focus, body.dark-mode .form-select:focus { background-color: var(--cream-2, #12241a) !important; border-color: #c89b23 !important; color: var(--text, #ffffff) !important; }
    body.dark-mode .text-dark { color: #ffffff !important; }
    body.dark-mode .text-muted { color: var(--muted, #d9d9d9) !important; }
</style>
<section class="page-title-section pt-5 pb-3 mt-5">
    <div class="container-xl">
        <nav class="breadcrumb-nav" aria-label="Breadcrumb">
            <a href="{{ route('home') }}">Home</a>
            <i class="bi bi-chevron-right"></i>
            <span>Dashboard</span>
        </nav>
    </div>
</section>

<section class="dashboard-section pt-3 pb-5">
    <div class="container">
        <!-- Mobile Menu Button -->
        <div class="d-lg-none mb-4">
            <button class="btn btn-dark" data-bs-toggle="offcanvas" data-bs-target="#dashboardSidebar">
                <i class="bi bi-list"></i> Dashboard Menu
            </button>
        </div>

        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif
        
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row g-4">
            <!-- Sidebar -->
            <div class="col-lg-3 d-none d-lg-block">
                <div class="dashboard-sidebar">
                    <h2 class="dashboard-title">Dashboard</h2>
                    <ul class="dashboard-menu">
                        <li><a href="#" class="active menu-link" data-target="dashboard-content"><i class="bi bi-grid"></i> Dashboard</a></li>
                        <li><a href="#" class="menu-link" data-target="orders-content"><i class="bi bi-bag"></i> Orders</a></li>
                        <li><a href="#" class="menu-link" data-target="account-content"><i class="bi bi-person"></i> Account Details</a></li>
                        <li><a href="#" class="menu-link" data-target="address-content"><i class="bi bi-geo-alt"></i> Addresses</a></li>
                        <li><a href="#" class="menu-link" data-target="wishlist-content"><i class="bi bi-heart"></i> Wishlist</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')) { document.getElementById('logout-form').submit(); }">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Mobile Sidebar -->
            <div class="offcanvas offcanvas-start" tabindex="-1" id="dashboardSidebar">
                <div class="offcanvas-header">
                    <h5>Dashboard</h5>
                    <button class="btn-close" data-bs-dismiss="offcanvas"></button>
                </div>
                <div class="offcanvas-body">
                    <ul class="dashboard-menu mobile-menu">
                        <li><a href="#" class="active menu-link" data-target="dashboard-content" data-bs-dismiss="offcanvas">Dashboard</a></li>
                        <li><a href="#" class="menu-link" data-target="orders-content" data-bs-dismiss="offcanvas">Orders</a></li>
                        <li><a href="#" class="menu-link" data-target="account-content" data-bs-dismiss="offcanvas">Account Details</a></li>
                        <li><a href="#" class="menu-link" data-target="address-content" data-bs-dismiss="offcanvas">Addresses</a></li>
                        <li><a href="#" class="menu-link" data-target="wishlist-content" data-bs-dismiss="offcanvas">Wishlist</a></li>
                        <li>
                            <a href="#" onclick="event.preventDefault(); if(confirm('Are you sure you want to logout?')) { document.getElementById('logout-form').submit(); }">Logout</a>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- Right Content -->
            <div class="col-lg-9">
                <!-- Dashboard Content -->
                <div id="dashboard-content" class="dashboard-page active-page">
                    <!-- Cover removed as requested -->
                    <div class="profile-wrapper">
                        <div class="profile-image">
                            @if(auth('customer')->user()->image)
                                <img src="{{ asset('storage/' . auth('customer')->user()->image) }}" alt="Profile" style="width:120px;height:120px;object-fit:cover;border-radius:50%;">
                            @else
                                <div class="avatar bg-primary text-white d-flex justify-content-center align-items-center" style="width: 120px; height: 120px; border-radius: 50%; font-size: 40px; border: 4px solid #fff;">
                                    {{ strtoupper(substr(auth('customer')->user()->name, 0, 1)) }}
                                </div>
                            @endif
                        </div>
                        <div class="profile-info">
                            <h3>{{ auth('customer')->user()->name }}</h3>
                            <p>Svaadvika Customer</p>
                        </div>
                    </div>
                    <hr class="my-5">
                    <h3 class="section-heading">Account Information</h3>
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="info-card border p-3 rounded h-100">
                                <p><strong>Name :</strong> {{ auth('customer')->user()->first_name }} {{ auth('customer')->user()->last_name }}</p>
                                <p><strong>Email :</strong> {{ auth('customer')->user()->email }}</p>
                                <p><strong>Phone :</strong> {{ auth('customer')->user()->phone ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="info-card border p-3 rounded h-100">
                                @if(auth('customer')->user()->addresses->count() > 0)
                                    @php $defaultAddress = auth('customer')->user()->addresses->first(); @endphp
                                    <p><strong>Street :</strong> {{ $defaultAddress->address }}</p>
                                    <p><strong>City :</strong> {{ $defaultAddress->city }}</p>
                                    <p><strong>State :</strong> {{ $defaultAddress->state ?? 'N/A' }}</p>
                                    <p><strong>Zip Code :</strong> {{ $defaultAddress->postal_code }}</p>
                                @else
                                    <p class="text-muted">No address added yet.</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Orders Section -->
                <div id="orders-content" class="dashboard-page d-none">
                    <div class="content-card">
                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <h3 class="section-heading mb-0">My Orders</h3>
                            <a href="{{ route('frontend.products') }}" class="btn btn-gold"><i class="bi bi-cart"></i> Shop Now</a>
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
                                        <td colspan="5" class="text-center py-4 text-muted">You haven't placed any orders yet.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Account Details -->
                <div id="account-content" class="dashboard-page d-none">
                    <div class="content-card">
                        <h3 class="section-heading">Account Details</h3>
                        <form action="{{ route('customer.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row g-4">
                                <div class="col-md-12 mb-3">
                                    <label>Profile Image</label>
                                    <div class="d-flex align-items-center gap-3">
                                        @if(auth('customer')->user()->image)
                                            <img src="{{ asset('storage/' . auth('customer')->user()->image) }}" alt="Profile" class="rounded-circle" style="width: 60px; height: 60px; object-fit: cover;">
                                        @else
                                            <div class="avatar bg-light text-secondary rounded-circle d-flex justify-content-center align-items-center" style="width: 60px; height: 60px; font-size: 24px; border: 1px solid #ddd;">
                                                <i class="bi bi-person"></i>
                                            </div>
                                        @endif
                                        <input type="file" name="image" class="form-control form-control-sm w-auto" accept="image/*">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label>First Name</label>
                                    <input type="text" name="first_name" class="form-control" value="{{ auth('customer')->user()->first_name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Last Name</label>
                                    <input type="text" name="last_name" class="form-control" value="{{ auth('customer')->user()->last_name }}" required>
                                </div>
                                <div class="col-md-6">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control bg-light" value="{{ auth('customer')->user()->email }}" readonly style="cursor: not-allowed;">
                                    <small class="text-muted">Email cannot be changed.</small>
                                </div>
                                <div class="col-md-6">
                                    <label>Phone</label>
                                    <input type="tel" name="phone" class="form-control" value="{{ old('phone', auth('customer')->user()->phone) }}" pattern="[0-9]{1,12}" maxlength="12" title="Please enter only numbers up to 12 digits">
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label>New Password (Optional)</label>
                                    <div class="input-group">
                                        <input type="password" name="password" id="password" class="form-control">
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-md-6 mt-4">
                                    <label>Confirm Password</label>
                                    <div class="input-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
                                        <button class="btn btn-outline-secondary toggle-password" type="button" data-target="password_confirmation">
                                            <i class="bi bi-eye"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="col-12 mt-4">
                                    <button type="submit" class="btn btn-gold">Save Changes</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Address Section (Flipkart style) -->
                <div id="address-content" class="dashboard-page d-none">
                    <div class="content-card">
                        <h3 class="section-heading d-flex justify-content-between align-items-center">
                            Manage Addresses
                            <button class="btn btn-sm btn-gold" onclick="document.getElementById('new-address-form').classList.toggle('d-none')">
                                + ADD A NEW ADDRESS
                            </button>
                        </h3>

                        <!-- Add New Address Form -->
                        <div id="new-address-form" class="bg-light p-4 rounded mb-4 {{ $errors->has('address') ? '' : 'd-none' }}">
                            <h5 class="mb-3 text-primary">ADD A NEW ADDRESS</h5>
                            <form action="{{ route('customer.address.store') }}" method="POST">
                                @csrf
                                <div class="row g-3">
                                    <div class="col-md-12">
                                        <label class="form-label">Address Type</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type_home" value="home" checked>
                                            <label class="form-check-label" for="type_home">Home</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type_work" value="work">
                                            <label class="form-check-label" for="type_work">Work</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type" id="type_other" value="other">
                                            <label class="form-check-label" for="type_other">Other</label>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Address (Area and Street)</label>
                                        <textarea class="form-control" name="address" rows="3" required></textarea>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">City/District/Town</label>
                                        <input type="text" class="form-control" name="city" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">State</label>
                                        <select class="form-select" name="state" required>
                                            <option value="">Select State</option>
                                            <option value="Andhra Pradesh">Andhra Pradesh</option>
                                            <option value="Arunachal Pradesh">Arunachal Pradesh</option>
                                            <option value="Assam">Assam</option>
                                            <option value="Bihar">Bihar</option>
                                            <option value="Chhattisgarh">Chhattisgarh</option>
                                            <option value="Goa">Goa</option>
                                            <option value="Gujarat">Gujarat</option>
                                            <option value="Haryana">Haryana</option>
                                            <option value="Himachal Pradesh">Himachal Pradesh</option>
                                            <option value="Jharkhand">Jharkhand</option>
                                            <option value="Karnataka">Karnataka</option>
                                            <option value="Kerala">Kerala</option>
                                            <option value="Madhya Pradesh">Madhya Pradesh</option>
                                            <option value="Maharashtra">Maharashtra</option>
                                            <option value="Manipur">Manipur</option>
                                            <option value="Meghalaya">Meghalaya</option>
                                            <option value="Mizoram">Mizoram</option>
                                            <option value="Nagaland">Nagaland</option>
                                            <option value="Odisha">Odisha</option>
                                            <option value="Punjab">Punjab</option>
                                            <option value="Rajasthan">Rajasthan</option>
                                            <option value="Sikkim">Sikkim</option>
                                            <option value="Tamil Nadu">Tamil Nadu</option>
                                            <option value="Telangana">Telangana</option>
                                            <option value="Tripura">Tripura</option>
                                            <option value="Uttar Pradesh">Uttar Pradesh</option>
                                            <option value="Uttarakhand">Uttarakhand</option>
                                            <option value="West Bengal">West Bengal</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Country</label>
                                        <select class="form-select" name="country" required>
                                            <option value="India" selected>India</option>
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label">Pincode</label>
                                        <input type="text" class="form-control" name="postal_code" required>
                                    </div>
                                    <div class="col-12 mt-4">
                                        <button type="submit" class="btn btn-gold">SAVE</button>
                                        <button type="button" class="btn btn-light ms-2" onclick="document.getElementById('new-address-form').classList.add('d-none')">CANCEL</button>
                                    </div>
                                </div>
                            </form>
                        </div>

                        <!-- Saved Addresses -->
                        <div class="saved-addresses mt-4">
                            @forelse(auth('customer')->user()->addresses as $address)
                                <div class="address-item border rounded p-3 mb-3 bg-white position-relative shadow-sm">
                                    <div class="d-flex justify-content-between">
                                        <span class="badge bg-light text-dark border mb-2 text-uppercase">{{ $address->type }}</span>
                                        <form action="{{ route('customer.address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this address?');">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-link text-danger p-0" title="Delete Address"><i class="bi bi-trash"></i></button>
                                        </form>
                                    </div>
                                    <p class="mb-1 fw-bold">{{ auth('customer')->user()->name }} &nbsp;&nbsp;&nbsp; {{ auth('customer')->user()->phone }}</p>
                                    <p class="mb-0 text-muted">
                                        {{ $address->address }}, {{ $address->city }}, {{ $address->state }} - <span class="fw-bold">{{ $address->postal_code }}</span>
                                    </p>
                                </div>
                            @empty
                                <div class="text-center py-4">
                                    <img src="https://rukminim2.flixcart.com/www/800/800/promos/16/05/2019/d438a32e-765a-4d8b-b4a6-520b560971e8.png?q=90" alt="No Addresses" style="height: 120px; opacity: 0.5; margin-bottom: 20px;">
                                    <p class="text-muted">No Addresses found in your account!</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>

                <!-- Wishlist -->
                <div id="wishlist-content" class="dashboard-page d-none">
                    <div class="content-card">
                        <h3 class="section-heading">Wishlist</h3>
                        <div class="row g-4 mt-2">
                            @forelse($wishlistItems ?? collect() as $item)
                                @php
                                    $product = $item->product;
                                    $price = $product->sale_price ?: $product->price;
                                    $imageUrl = 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85';
                                    if ($product->featuredImage) {
                                        $imageUrl = asset('storage/' . $product->featuredImage->image_path);
                                    } elseif ($product->images->isNotEmpty()) {
                                        $imageUrl = asset('storage/' . $product->images->first()->image_path);
                                    }
                                @endphp
                                <div class="col-lg-4 col-md-6">
                                    <div class="wishlist-card border rounded p-3 text-center position-relative">
                                        <button class="btn btn-sm btn-link text-danger position-absolute" style="top:5px; right:5px;" onclick="removeFromWishlist({{ $item->product_id }})">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                        <img src="{{ $imageUrl }}" class="img-fluid rounded" style="height:150px; object-fit:cover;">
                                        <h5 class="mt-3">{{ $product->name }}</h5>
                                        <p class="fw-bold">₹{{ number_format($price, 2) }}</p>
                                        <button class="btn btn-green w-100" data-add-cart="{{ $product->id }}">Add to Cart</button>
                                    </div>
                                </div>
                            @empty
                            <div class="text-center py-5 text-muted col-12">
                                <i class="bi bi-heart" style="font-size: 3rem;"></i>
                                <p class="mt-3">Your wishlist is empty.</p>
                            </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const menuLinks = document.querySelectorAll('.menu-link');
        const dashboardPages = document.querySelectorAll('.dashboard-page');

        menuLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                const targetId = this.getAttribute('data-target');
                if(!targetId) return;

                // Update active state in menu
                menuLinks.forEach(m => m.classList.remove('active'));
                
                // Add active to all links with same target (desktop + mobile)
                document.querySelectorAll(`.menu-link[data-target="${targetId}"]`).forEach(el => el.classList.add('active'));

                // Hide all pages, show target
                dashboardPages.forEach(page => {
                    page.classList.add('d-none');
                    page.classList.remove('active-page');
                });
                
                const targetPage = document.getElementById(targetId);
                if(targetPage) {
                    targetPage.classList.remove('d-none');
                    targetPage.classList.add('active-page');
                }
            });
        });
        
        // If there's an error on the address form, switch to the address tab
        @if($errors->has('address') || $errors->has('city') || $errors->has('postal_code'))
            document.querySelector('.menu-link[data-target="address-content"]').click();
        @endif
        
        // If there's a general profile error
        @if($errors->has('first_name') || $errors->has('last_name') || $errors->has('email') || $errors->has('image'))
            document.querySelector('.menu-link[data-target="account-content"]').click();
        @endif
        
        // Toggle Password functionality
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', function() {
                const targetId = this.getAttribute('data-target');
                const input = document.getElementById(targetId);
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('bi-eye');
                    icon.classList.add('bi-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('bi-eye-slash');
                    icon.classList.add('bi-eye');
                }
            });
        });
    });

    function removeFromWishlist(productId) {
        if(confirm('Are you sure you want to remove this from your wishlist?')) {
            fetch('/api/wishlist/toggle', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ product_id: productId })
            })
            .then(res => res.json())
            .then(data => {
                if(data.status === 'success') {
                    window.location.reload();
                }
            });
        }
    }
</script>
@endpush
