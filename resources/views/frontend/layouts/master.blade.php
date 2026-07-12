<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', ($settings['site_name'] ?? 'Svaadvika') . ' | Premium Indian Ready-to-Cook Food')</title>
    <meta name="description" content="@yield('meta_description', $settings['site_description'] ?? 'Svaadvika brings authentic Indian biryani kits, marinades and premium recipes to modern family kitchens with restaurant-quality taste.')">
    <link rel="canonical" href="{{ url()->current() }}">
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700;800;900&family=Inter:wght@300;400;500;600;700;800&family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" rel="stylesheet">
    
    <link href="{{ asset('frontend/assets/css/variables.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/dark.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/animations.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsive.css') }}" rel="stylesheet">
    
    @if(isset($settings['header_seo_content']))
        {!! $settings['header_seo_content'] !!}
    @endif

    @stack('styles')
  </head>
  <body class="@yield('body_class', 'home')">
    
    <div class="page-loader" aria-hidden="true">
      <div class="loader-mark">
        @if(isset($settings['site_logo']) && $settings['site_logo'])
            <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Svaadvika' }}" style="height: 60px; margin-bottom: 15px; border-radius: 4px; animation: pulse 2s infinite;">
        @else
            <span>{{ substr($settings['site_name'] ?? 'S', 0, 1) }}</span>
        @endif
        <small>{{ $settings['site_name'] ?? 'Svaadvika' }}</small>
      </div>
    </div>

    <!-- Header -->
    @include('frontend.layouts.header')

    <!-- Mobile Menu -->
    @include('frontend.layouts.mobile_menu')

    <!-- Search Popup -->
    @include('frontend.layouts.search_popup')

    <!-- Main Content -->
    <main>
      @yield('content')
    </main>

    <!-- Quick View Modal -->
    <div class="modal fade product-quick-modal" id="quickViewModal" tabindex="-1" aria-labelledby="quickViewTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          <div class="modal-body" id="quickViewBody"></div>
        </div>
      </div>
    </div>

    <!-- Cart Toast -->
    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1080;">
      <div id="cartToast" class="toast premium-toast" role="status" aria-live="polite" aria-atomic="true" data-bs-delay="2400">
        <div class="toast-body"><i class="bi bi-check-circle-fill"></i><span>Added to cart successfully.</span></div>
      </div>
    </div>

    <!-- Footer -->
    @include('frontend.layouts.footer')

    <a class="float-whatsapp" href="https://wa.me/{{ $settings['whatsapp_number'] ?? '919999999999' }}" aria-label="Chat on WhatsApp"><i class="bi bi-whatsapp"></i><span>WhatsApp</span></a>
    <a class="float-call" href="tel:{{ $settings['contact_phone'] ?? '+919999999999' }}" aria-label="Call Svaadvika"><i class="bi bi-telephone"></i></a>
    <button class="back-top" type="button" aria-label="Back to top"><i class="bi bi-arrow-up"></i></button>

    <nav class="mobile-bottom" aria-label="Mobile quick navigation">
      <a class="{{ request()->routeIs('home') ? 'active' : '' }}" href="{{ route('home') }}"><i class="bi bi-house"></i><span>Home</span></a>
      <a href="#products"><i class="bi bi-grid"></i><span>Products</span></a>
      <a class="shop" href="#products"><i class="bi bi-bag"></i><span>Shop</span></a>
      <a href="https://wa.me/{{ $settings['whatsapp_number'] ?? '919999999999' }}"><i class="bi bi-whatsapp"></i><span>WhatsApp</span></a>
      <a href="tel:{{ $settings['contact_phone'] ?? '+919999999999' }}"><i class="bi bi-telephone"></i><span>Call</span></a>
    </nav>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('frontend/assets/js/theme.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slider.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/mobile.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/animation.js') }}"></script>
    @stack('before_scripts')
    @stack('scripts')
    <script src="{{ asset('frontend/assets/js/main.js') }}"></script>
  </body>
</html>
