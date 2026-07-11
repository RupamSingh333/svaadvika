<!-- Header -->
<header class="header glass-effect">
    <div class="d-flex align-items-center">
        <button class="btn sidebar-toggle me-3 d-lg-none">
            <i class="fa-solid fa-bars"></i>
        </button>
        <h4 class="mb-0 page-title">@yield('page_title', 'Dashboard')</h4>
    </div>
    
    <div class="header-right d-flex align-items-center">
        <!-- Theme Toggle -->
        <button class="btn btn-icon me-2" id="theme-toggle" title="Toggle Dark/Light Mode">
            <i class="fa-solid fa-moon"></i>
        </button>

        <div class="notifications dropdown me-3">
            <button class="btn btn-icon position-relative" data-bs-toggle="dropdown">
                <i class="fa-regular fa-bell"></i>
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                    3
                </span>
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><h6 class="dropdown-header">Notifications</h6></li>
                <li><a class="dropdown-item" href="#">New order received</a></li>
                <li><a class="dropdown-item" href="#">User registered</a></li>
            </ul>
        </div>
        
        <div class="user-profile dropdown">
            <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" data-bs-toggle="dropdown">
                <div class="avatar rounded-circle bg-primary text-white d-flex align-items-center justify-content-center me-2">
                    {{ substr(Auth::user()->name ?? 'A', 0, 1) }}
                </div>
                <div class="user-info d-none d-sm-block text-dark">
                    <span class="d-block fw-semibold">{{ Auth::user()->name ?? 'Admin' }}</span>
                    <small class="text-muted">{{ Auth::user()->id === 1 ? 'Super Admin' : 'Admin User' }}</small>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="#"><i class="fa-regular fa-user me-2"></i> Profile</a></li>
                <li><a class="dropdown-item" href="#"><i class="fa-solid fa-cog me-2"></i> Settings</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="fa-solid fa-sign-out-alt me-2"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</header>
