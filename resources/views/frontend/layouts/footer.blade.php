    <footer class="site-footer" id="contact">
      <div class="container-xl">
        <div class="row gy-4">
          <div class="col-lg-3">
            <a class="brand footer-brand" href="{{ route('home') }}">
              @if(isset($settings['site_logo']) && $settings['site_logo'])
              <img src="{{ asset('storage/' . $settings['site_logo']) }}" alt="{{ $settings['site_name'] ?? 'Svaadvika' }}" style="height: 40px; margin-right: 10px; border-radius: 4px;">
              @else
              <span class="brand-emblem">{{ substr($settings['site_name'] ?? 'S', 0, 1) }}</span>
              @endif
              <span><strong>{{ strtoupper($settings['site_name'] ?? 'SVAADVIKA') }}</strong><small>{{ $settings['site_description'] ?? 'Flavours of India, Made Perfect' }}</small></span>
            </a>
              @if(isset($settings['contact_phone']) || isset($settings['contact_email']))
            <div class="mt-4" style="font-size: 0.95rem; line-height: 1.8; color: rgba(255,255,255,0.8);">
              @if(isset($settings['contact_phone']))<div><i class="bi bi-telephone me-2" style="color: var(--gold, #c89b23);"></i>{{ $settings['contact_phone'] }}</div>@endif
              @if(isset($settings['contact_email']))<div><i class="bi bi-envelope me-2" style="color: var(--gold, #c89b23);"></i>{{ $settings['contact_email'] }}</div>@endif
              @if(isset($settings['address']))<div class="mt-2"><i class="bi bi-geo-alt me-2" style="color: var(--gold, #c89b23);"></i>{{ $settings['address'] }}</div>@endif
            </div>
            @endif
            <div class="socials">
              @if(isset($settings['instagram_url']) && $settings['instagram_url'])<a href="{{ $settings['instagram_url'] }}" aria-label="Instagram"><i class="bi bi-instagram"></i></a>@endif
              @if(isset($settings['facebook_url']) && $settings['facebook_url'])<a href="{{ $settings['facebook_url'] }}" aria-label="Facebook"><i class="bi bi-facebook"></i></a>@endif
              @if(isset($settings['youtube_url']) && $settings['youtube_url'])<a href="{{ $settings['youtube_url'] }}" aria-label="YouTube"><i class="bi bi-youtube"></i></a>@endif
              @if(isset($settings['pinterest_url']) && $settings['pinterest_url'])<a href="{{ $settings['pinterest_url'] }}" aria-label="Pinterest"><i class="bi bi-pinterest"></i></a>@endif
              @if(isset($settings['twitter_url']) && $settings['twitter_url'])<a href="{{ $settings['twitter_url'] }}" aria-label="Twitter"><i class="bi bi-twitter"></i></a>@endif
            </div>
          
          </div>
          <div class="col-6 col-lg-3">
            <h3>Information</h3>
            <a href="{{ route('home') }}">Home</a>
            <a href="{{ route('about') }}">About</a>
            <a href="{{ route('frontend.products') }}">Products</a>
            <a href="{{ route('contact') }}">Recipes</a>
            <a href="{{ route('recipes') }}">Contact</a>
          </div>      
          <div class="col-6 col-lg-3">
            <h3>Woocommerce</h3>
            <a href="{{ route('frontend.products') }}">Cart</a>
            <a href="{{ route('frontend.products') }}">Checkout</a>
            <a href="{{ route('frontend.products') }}">Login</a>
            <a href="{{ route('frontend.products') }}">Register</a>
          </div>
          <div class="col-6 col-lg-3">
            <h3>Policies</h3>
            <a href="{{ route('contact') }}">Shipping Policy</a>
            <a href="{{ route('contact') }}">Refund Policy</a>
            <a href="{{ route('contact') }}">Privacy Policy</a>
            <a href="{{ route('contact') }}">Terms & Conditions</a>
            <a href="{{ route('contact') }}">Cancellation Policy</a>
          </div>
        </div>
        <div class="footer-bottom text-center" style="color: rgba(255,255,255,0.72);">© {{ date('Y') }} {{ $settings['site_name'] ?? config('app.name') }}. All Rights Reserved.</div>
      </div>
    </footer>