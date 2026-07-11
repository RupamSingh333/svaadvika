    <footer class="site-footer" id="contact">
      <div class="container-xl">
        <div class="row gy-4">
          <div class="col-lg-3">
            <a class="brand footer-brand" href="{{ route('home') }}"><span class="brand-emblem">S</span><span><strong>SVAADVIKA</strong><small>Flavours of India, Made Perfect</small></span></a>
            <div class="socials">
              <a href="#" aria-label="Instagram"><i class="bi bi-instagram"></i></a>
              <a href="#" aria-label="Facebook"><i class="bi bi-facebook"></i></a>
              <a href="#" aria-label="YouTube"><i class="bi bi-youtube"></i></a>
              <a href="#" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>
            </div>
          </div>
          <div class="col-6 col-lg-2"><h3>Company</h3><a href="{{ route('about') }}">About Us</a><a href="{{ route('about') }}">Our Story</a><a href="{{ route('contact') }}">Careers</a><a href="{{ route('contact') }}">Contact Us</a></div>
          <div class="col-6 col-lg-2"><h3>Shop</h3><a href="{{ route('frontend.products') }}">All Products</a><a href="{{ route('frontend.products') }}">Biryani Kits</a><a href="{{ route('frontend.products') }}">Marinades</a><a href="{{ route('frontend.products') }}">Combos</a></div>
          <div class="col-6 col-lg-2"><h3>Help</h3><a href="{{ route('contact') }}">FAQs</a><a href="{{ route('contact') }}">Shipping Policy</a><a href="{{ route('contact') }}">Refund Policy</a><a href="{{ route('contact') }}">Privacy Policy</a></div>
          <div class="col-6 col-lg-2"><h3>Recipes</h3><a href="{{ route('recipes') }}">All Recipes</a><a href="{{ route('recipes') }}">Biryani Recipes</a><a href="{{ route('recipes') }}">Veg Recipes</a><a href="{{ route('recipes') }}">Video Recipes</a></div>
          <div class="col-lg-1 certs"><i class="bi bi-patch-check"></i><i class="fa-solid fa-certificate"></i><i class="bi bi-award"></i></div>
        </div>
        <div class="footer-bottom">© {{ date('Y') }} {{ config('app.name') }}. All Rights Reserved.</div>
      </div>
    </footer>
