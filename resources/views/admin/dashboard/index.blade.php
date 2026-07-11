@extends('admin.layouts.master')

@section('title', 'Dashboard')
@section('page_title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <!-- Total Sales -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm glass-effect h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted fw-normal mb-0">Total Sales</h6>
                        <h3 class="fw-bold mb-0 mt-1">$24,500</h3>
                    </div>
                    <div class="icon-box bg-primary-subtle text-primary rounded-circle">
                        <i class="fa-solid fa-dollar-sign"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center text-sm">
                    <span class="text-success fw-bold me-2"><i class="fa-solid fa-arrow-trend-up"></i> +12.5%</span>
                    <span class="text-muted">from last month</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Orders -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm glass-effect h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted fw-normal mb-0">Total Orders</h6>
                        <h3 class="fw-bold mb-0 mt-1">1,254</h3>
                    </div>
                    <div class="icon-box bg-success-subtle text-success rounded-circle">
                        <i class="fa-solid fa-cart-shopping"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center text-sm">
                    <span class="text-success fw-bold me-2"><i class="fa-solid fa-arrow-trend-up"></i> +8.2%</span>
                    <span class="text-muted">from last month</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Total Customers -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm glass-effect h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted fw-normal mb-0">Customers</h6>
                        <h3 class="fw-bold mb-0 mt-1">8,452</h3>
                    </div>
                    <div class="icon-box bg-info-subtle text-info rounded-circle">
                        <i class="fa-solid fa-users"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center text-sm">
                    <span class="text-success fw-bold me-2"><i class="fa-solid fa-arrow-trend-up"></i> +5.4%</span>
                    <span class="text-muted">from last month</span>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Pending Orders -->
    <div class="col-12 col-sm-6 col-xl-3">
        <div class="card stat-card border-0 shadow-sm glass-effect h-100">
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <h6 class="text-muted fw-normal mb-0">Pending Orders</h6>
                        <h3 class="fw-bold mb-0 mt-1">42</h3>
                    </div>
                    <div class="icon-box bg-warning-subtle text-warning rounded-circle">
                        <i class="fa-solid fa-clock"></i>
                    </div>
                </div>
                <div class="d-flex align-items-center text-sm">
                    <span class="text-danger fw-bold me-2"><i class="fa-solid fa-arrow-trend-down"></i> -2.4%</span>
                    <span class="text-muted">from last month</span>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Chart Section -->
    <div class="col-12 col-xl-12">
        <div class="card border-0 shadow-sm h-100 glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">Revenue Overview</h5>
                <div class="dropdown">
                    <button class="btn btn-sm btn-light dropdown-toggle shadow-sm border" type="button" data-bs-toggle="dropdown">
                        This Year
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">This Week</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>
            </div>
            <div class="card-body">
                <div class="text-center p-5 text-muted">
                    <i class="fa-solid fa-chart-line fa-3x mb-3 text-light-gray"></i>
                    <p>Chart functionality will be integrated in the reporting module phase.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm h-100 glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">Recent Orders</h5>
                <a href="#" class="btn btn-sm btn-link text-decoration-none">View All</a>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush mt-2">
                    <div class="list-group-item px-0 border-bottom d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                <i class="fa-solid fa-pizza-slice"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">Order #ORD-001</h6>
                                <small class="text-muted">John Doe - 2 mins ago</small>
                            </div>
                        </div>
                        <span class="badge bg-warning text-dark rounded-pill">Pending</span>
                    </div>
                    <div class="list-group-item px-0 border-bottom d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                <i class="fa-solid fa-burger"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">Order #ORD-002</h6>
                                <small class="text-muted">Jane Smith - 15 mins ago</small>
                            </div>
                        </div>
                        <span class="badge bg-success rounded-pill">Delivered</span>
                    </div>
                    <div class="list-group-item px-0 d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-info-subtle text-info rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                <i class="fa-solid fa-bowl-food"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold">Order #ORD-003</h6>
                                <small class="text-muted">Mike Johnson - 1 hour ago</small>
                            </div>
                        </div>
                        <span class="badge bg-info rounded-pill">Preparing</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
