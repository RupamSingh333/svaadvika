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

            @hasPermission('contacts', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.contacts.index') }}" class="nav-link {{ request()->routeIs('admin.contacts.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-envelope"></i>
                    <span>Contact Inquiries</span>
                </a>
            </li>
            @endhasPermission


            @hasPermission('recipes', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.recipes.index') }}" class="nav-link {{ request()->routeIs('admin.recipes.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-utensils"></i>
                    <span>Recipe Manager</span>
                </a>
            </li>
            @endhasPermission



            @hasPermission('customers', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.customers.index') }}" class="nav-link {{ request()->routeIs('admin.customers.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-user-tag"></i>
                    <span>Customers</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('taxes', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.taxes.index') }}" class="nav-link {{ request()->routeIs('admin.taxes.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-percent"></i>
                    <span>Tax Manager</span>
                </a>
            </li>
            @endhasPermission

            @hasPermission('delivery-settings', 'view')
            <li class="nav-item">
                <a href="{{ route('admin.delivery-settings.index') }}" class="nav-link {{ request()->routeIs('admin.delivery-settings.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-truck"></i>
                    <span>Delivery Settings</span>
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
