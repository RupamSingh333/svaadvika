    <header class="site-header fixed-top" id="siteHeader">
      <nav class="navbar navbar-expand-xl" aria-label="Primary navigation">
        <div class="container-xl">
          <a class="brand" href="{{ route('home') }}" aria-label="Svaadvika home">
            <span class="brand-emblem">S</span>
            <span>
              <strong>SVAADVIKA</strong>
              <small>Flavours of India, Made Perfect</small>
            </span>
          </a>
          <button class="navbar-toggler menu-toggle" type="button" data-bs-toggle="offcanvas" data-bs-target="#mobileMenu" aria-controls="mobileMenu" aria-label="Open menu">
            <i class="bi bi-list"></i>
          </button>
          <div class="collapse navbar-collapse justify-content-center">
            <ul class="navbar-nav main-nav">
              <li class="nav-item"><a class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
              <li class="nav-item"><a class="nav-link {{ request()->routeIs('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
               <li class="nav-item"><a class="nav-link {{ request()->routeIs('products') ? 'active' : '' }}" href="{{ route('frontend.products') }}">Products</a></li>
            
              <li class="nav-item"><a class="nav-link {{ request()->routeIs('recipes') ? 'active' : '' }}" href="{{ route('recipes') }}">Recipes</a></li>
              <!-- <li class="nav-item"><a class="nav-link" href="{{ route('home') }}#manufacturing">Manufacturing</a></li> -->
              <li class="nav-item"><a class="nav-link {{ request()->routeIs('blog*') ? 'active' : '' }}" href="{{ route('blog') }}">Blog</a></li>
              <li class="nav-item"><a class="nav-link {{ request()->routeIs('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
            </ul>
          </div>
          <div class="header-actions d-none d-xl-flex">
            <!-- <button class="icon-btn search-open" type="button" aria-label="Search" aria-haspopup="dialog"><i class="bi bi-search"></i></button>
            <button class="icon-btn" aria-label="Wishlist"><i class="bi bi-heart"></i></button> -->
            <button class="icon-btn cart-btn" aria-label="Cart"><i class="bi bi-bag"></i><span>2</span></button>
            <button class="icon-btn theme-toggle" type="button" aria-label="Toggle dark mode"><i class="bi bi-moon-stars"></i></button>
            @auth
              <a href="{{ route('dashboard') }}" class="icon-btn" aria-label="Dashboard"><i class="bi bi-person-circle"></i></a>
            @else
              <a href="{{ route('login') }}" class="icon-btn" aria-label="Login"><i class="bi bi-person"></i></a>
            @endauth
          </div>
        </div>
      </nav>
    </header>
