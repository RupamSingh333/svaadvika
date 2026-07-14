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
                        <h3 class="fw-bold mb-0 mt-1">₹{{ number_format($totalSales, 0) }}</h3>
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
                        <h3 class="fw-bold mb-0 mt-1">{{ number_format($totalOrders) }}</h3>
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
                        <h3 class="fw-bold mb-0 mt-1">{{ number_format($totalCustomers) }}</h3>
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
                        <h3 class="fw-bold mb-0 mt-1">{{ number_format($pendingOrders) }}</h3>
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
                <canvas id="revenueChart" height="100"></canvas>
            </div>
        </div>
    </div>

    <!-- Recent Orders -->
    <div class="col-12 col-xl-4">
        <div class="card border-0 shadow-sm h-100 glass-effect">
            <div class="card-header bg-transparent border-0 d-flex justify-content-between align-items-center pt-4 pb-0">
                <h5 class="fw-semibold mb-0">Recent Orders</h5>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-link text-decoration-none">View All</a>
            </div>
            <div class="card-body">
                <div class="list-group list-group-flush mt-2">
                    @forelse($recentOrders as $order)
                    <div class="list-group-item px-0 border-bottom d-flex justify-content-between align-items-center py-3">
                        <div class="d-flex align-items-center">
                            <div class="avatar-sm bg-primary-subtle text-primary rounded-circle d-flex align-items-center justify-content-center me-3" style="width:40px; height:40px;">
                                <i class="fa-solid fa-bag-shopping"></i>
                            </div>
                            <div>
                                <h6 class="mb-1 fw-semibold"><a href="{{ route('admin.orders.show', $order->id) }}" class="text-decoration-none text-dark">{{ $order->order_number }}</a></h6>
                                <small class="text-muted">{{ $order->customer ? $order->customer->name : 'Guest' }} - {{ $order->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
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
                        <span class="badge bg-{{ $color }} rounded-pill text-white">{{ ucfirst($order->status) }}</span>
                    </div>
                    @empty
                    <div class="text-center p-3 text-muted">
                        No recent orders found.
                    </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const ctx = document.getElementById('revenueChart').getContext('2d');
        const isDark = document.documentElement.getAttribute('data-bs-theme') === 'dark';
        const textColor = isDark ? '#fff' : '#6c757d';
        const gridColor = isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';

        const data = {
            labels: {!! json_encode($chartDates) !!},
            datasets: [{
                label: 'Revenue (₹)',
                data: {!! json_encode($chartData) !!},
                backgroundColor: 'rgba(200, 155, 35, 0.2)',
                borderColor: 'rgba(200, 155, 35, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        };

        const config = {
            type: 'line',
            data: data,
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return '₹' + context.parsed.y.toLocaleString();
                            }
                        }
                    }
                },
                scales: {
                    x: {
                        ticks: { color: textColor },
                        grid: { display: false }
                    },
                    y: {
                        ticks: { color: textColor },
                        grid: { color: gridColor },
                        beginAtZero: true
                    }
                }
            }
        };

        let revenueChart = new Chart(ctx, config);

        // Update on theme change
        document.addEventListener('themeChanged', function(e) {
            const newTextColor = e.detail.isDark ? '#fff' : '#6c757d';
            const newGridColor = e.detail.isDark ? 'rgba(255, 255, 255, 0.1)' : 'rgba(0, 0, 0, 0.1)';
            revenueChart.options.scales.x.ticks.color = newTextColor;
            revenueChart.options.scales.y.ticks.color = newTextColor;
            revenueChart.options.scales.y.grid.color = newGridColor;
            revenueChart.update();
        });
    });
</script>
@endpush
