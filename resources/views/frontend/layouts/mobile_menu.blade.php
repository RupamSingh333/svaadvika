    <div class="offcanvas offcanvas-start mobile-offcanvas" tabindex="-1" id="mobileMenu" aria-labelledby="mobileMenuLabel">
      <div class="offcanvas-header">
        <a class="brand" id="mobileMenuLabel" href="{{ route('home') }}">
          <span class="brand-emblem">S</span>
          <span><strong>SVAADVIKA</strong><small>Flavours of India</small></span>
        </a>
        <button type="button" class="icon-btn" data-bs-dismiss="offcanvas" aria-label="Close menu"><i class="bi bi-x-lg"></i></button>
      </div>
      <div class="offcanvas-body">
        <!-- <div class="mobile-search">
          <i class="bi bi-search"></i>
          <input type="search" placeholder="Search products" aria-label="Search products">
        </div> -->
        <div class="accordion mobile-accordion" id="navAccordion">
          <a href="{{ route('home') }}" data-bs-dismiss="offcanvas">Home</a>
          <a href="{{ route('about') }}" data-bs-dismiss="offcanvas">About</a>
          <a href="{{ route('frontend.products') }}" data-bs-dismiss="offcanvas">Products</a>
          <a href="{{ route('recipes') }}" data-bs-dismiss="offcanvas">Recipes</a>
          <a href="{{ route('contact') }}" data-bs-dismiss="offcanvas">Contact</a>
        </div>
        <!-- <button class="theme-row theme-toggle" type="button"><i class="bi bi-moon-stars"></i><span>Switch theme</span></button> -->
        <!-- <a class="btn btn-gold w-100" href="#products" data-bs-dismiss="offcanvas">Shop Now</a> -->
        <div class="mobile-quick">
          @auth('customer')
            <a href="{{ route('customer.dashboard') }}" aria-label="My Account"><i class="bi bi-person-circle"></i> Account</a>
            <form method="POST" action="{{ route('logout') }}" class="d-inline" onsubmit="confirmFormSubmit(event, this, '')">
              @csrf
              <button type="submit" class="btn btn-link text-danger text-decoration-none p-0 border-0 d-flex align-items-center gap-2" style="font-weight: 500; padding-top: 10px !important;"><i class="bi bi-box-arrow-right"></i> Logout</button>
            </form>
          @else
            <a href="{{ route('login') }}" aria-label="Login"><i class="bi bi-person"></i> Login</a>
            <a href="{{ route('register') }}" aria-label="Register"><i class="bi bi-person-plus"></i> Register</a>
          @endauth
        </div>
        <div class="mobile-quick mt-3">
          <a href="https://wa.me/919999999999" aria-label="WhatsApp"><i class="bi bi-whatsapp"></i> WhatsApp</a>
          <a href="tel:+919999999999" aria-label="Call Svaadvika"><i class="bi bi-telephone"></i> Call</a>
        </div>
      </div>
    </div>
