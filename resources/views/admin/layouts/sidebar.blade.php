<!-- Sidebar -->
<nav class="sidebar glass-effect">
    <div class="sidebar-header">
        <a href="{{ route('admin.dashboard') }}" class="brand-logo">
            <i class="fa-solid fa-utensils"></i>
            <span>{{ config('app.name') }}</span>
        </a>
    </div>
    
    <div class="sidebar-menu">
        <ul class="nav flex-column mb-0">
            @hasPermission('dashboard', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            @endhasPermission

            @if(auth()->user()->hasPermissionTo('products', 'view') || auth()->user()->hasPermissionTo('categories', 'view'))
            <li class="nav-item-header">Food Management</li>
            @endif

            @hasPermission('products', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box-open"></i>
                    <span>Products</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('categories', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-list"></i>
                    <span>Categories</span>
                </a>
            </li>
            @endhasPermission

            @if(auth()->user()->hasPermissionTo('orders', 'view') || auth()->user()->hasPermissionTo('coupons', 'view'))
            <li class="nav-item-header">Sales & Business</li>
            @endif

            @hasPermission('orders', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Orders</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('coupons', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.coupons.index') }}" class="nav-link {{ request()->routeIs('admin.coupons.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Coupons</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('posts', 'view')
            <li class="nav-item-header">Content Management</li>
            <li class="nav-item">
                <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-file-alt"></i>
                    <span>CMS & Blogs</span>
                </a>
            </li>
            @endhasPermission

            @if(auth()->user()->hasPermissionTo('customers', 'view') || auth()->user()->hasPermissionTo('users', 'view') || auth()->user()->hasPermissionTo('settings', 'view') || auth()->user()->hasPermissionTo('audit-logs', 'view'))
            <li class="nav-item-header">System Settings</li>
            @endif

            @hasPermission('customers', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-tag"></i>
                    <span>Customers</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('users', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Users Managers</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('audit-logs', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.audit-logs.index') }}" class="nav-link {{ request()->routeIs('admin.audit-logs.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-clipboard-list"></i>
                    <span>Audit Logs</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('settings', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-gear"></i>
                    <span>General Settings</span>
                </a>
            </li>
            @endhasPermission

        </ul>
    </div>
</nav>
