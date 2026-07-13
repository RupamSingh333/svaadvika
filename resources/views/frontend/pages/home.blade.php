@extends('frontend.layouts.master')

@section('content')
      <section class="hero-section" id="home">
        <div class="hero-bg" aria-hidden="true"></div>
        <div class="container-xl">
          <div class="row align-items-center min-vh-100 gy-5">
            <div class="col-lg-6 hero-copy reveal-up">
              <p class="eyebrow">Test Authentic Indian Taste</p>
              <h1>Crafted For <span>Modern</span> Families</h1>
              <p class="hero-text">Experience restaurant-quality Indian food at home in just minutes with premium ingredients, chef-led recipes and authentic regional flavour.</p>
              <div class="hero-actions">
                <a class="btn btn-gold" href="#products">Explore Collection <i class="bi bi-arrow-right"></i></a>
              </div>
              <div class="hero-stats">
                <div><strong data-counter="25000">0</strong><small>Happy Families</small></div>
                <div><strong data-counter="120">0</strong><small>Recipes Tested</small></div>
                <div><strong data-counter="18">0</strong><small>Regions</small></div>
              </div>
            </div>
            <!-- <div class="col-lg-6 hero-visual reveal-right">
              <div class="steam steam-one"></div>
              <div class="steam steam-two"></div>
              <img class="hero-dish" src="{{ asset('frontend/assets/images/hero-dish-reference.png') }}" alt="Hyderabadi biryani in a copper handi with aromatic steam">
              <div class="product-pack floating">
                <img src="{{ asset('frontend/assets/images/hero-pack-reference.png') }}" alt="Svaadvika Hyderabadi Biryani restaurant style kit">
              </div>
              <div class="auth-badge floating-slow">
                <i class="bi bi-patch-check"></i>
                <span>Authentic<br>Indian Taste</span>
              </div>
            </div> -->
          </div>
        </div>
      </section>

      <section class="feature-strip" aria-label="Brand certifications">
        <div class="container-xl">
          <div class="feature-bar reveal-up">
            <article><i class="bi bi-shield-check"></i><span><strong>ISO</strong><small>Certified</small></span></article>
            <article><i class="fa-solid fa-certificate"></i><span><strong>FSSAI</strong><small>Approved</small></span></article>
            <article><i class="bi bi-flower2"></i><span><strong>Made In</strong><small>India</small></span></article>
            <article><i class="bi bi-flask"></i><span><strong>No Artificial</strong><small>Colours</small></span></article>
            <article><i class="bi bi-person-check"></i><span><strong>Chef</strong><small>Approved</small></span></article>
            <article><i class="bi bi-award"></i><span><strong>100%</strong><small>Authentic Recipes</small></span></article>
          </div>
        </div>
      </section>

      <section class="section product-section" id="products">
        <div class="container-xl">
          <div class="section-head reveal-up">
            <div>
              <p class="eyebrow">Our Bestsellers</p>
              <h2>Featured <span>Collection</span></h2>
            </div>
            <a class="text-link" href="#products">View All Products <i class="bi bi-arrow-right"></i></a>
          </div>
          <div class="slider-wrap">
            <button class="slider-nav prev" type="button" aria-label="Previous products"><i class="bi bi-chevron-left"></i></button>
            <div class="product-slider" tabindex="0">
              @foreach($featuredProducts as $product)
              <article class="product-card reveal-up">
                @if($product->sale_price)
                    <span class="tag">Sale</span>
                @endif
                <!-- <button class="card-icon" aria-label="Add {{ $product->name }} to wishlist"><i class="bi bi-heart"></i></button> -->
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85' }}" alt="{{ $product->name }}">
                <div class="product-info">
                  <h3>{{ $product->name }}</h3>
                  <div class="rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i><span>(1200)</span></div>
                  <div class="price-row">
                      <strong>
                          @if($product->sale_price)
                              ₹{{ $product->sale_price }} <small class="text-muted text-decoration-line-through">₹{{ $product->regular_price }}</small>
                          @else
                              ₹{{ $product->regular_price }}
                          @endif
                      </strong>
                      <button aria-label="Add {{ $product->name }} to cart"><i class="bi bi-bag-plus"></i></button>
                  <a href="{{ route('frontend.product_details', $product->slug) }}" class="quick-view-btn text-decoration-none text-center">View Details</a>
                  </div>
                </div>
              </article>
              @endforeach
            </div>
            <button class="slider-nav next" type="button" aria-label="Next products"><i class="bi bi-chevron-right"></i></button>
          </div>
        </div>
      </section>

      <section class="story-section" id="about">
        <div class="container-fluid px-0">
          <div class="row g-0 align-items-stretch">
            <div class="col-lg-6">
              <img class="story-image" src="{{ asset('frontend/assets/images/story-reference.png') }}" alt="Grandmother and granddaughter cooking together in a warm Indian kitchen" loading="lazy">
            </div>
            <div class="col-lg-6 story-copy reveal-right">
              <p class="eyebrow">Our Story</p>
              <h2>Home Convenience. <br><span>Zero</span> Compromise.</h2>
              <p>Svaadvika started with a simple belief: Indian flavours deserve pure ingredients, measured spice craft and the comfort of family kitchens.</p>
              <div class="story-actions">
                <a class="btn btn-green" href="#about">Know Our Story <i class="bi bi-arrow-right"></i></a>
                <button class="video-btn dark" type="button"><i class="bi bi-play-fill"></i><span>Watch Our Journey</span></button>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section class="section dark-band" id="manufacturing">
        <div class="container-xl">
          <div class="row gy-5 align-items-center">
            <div class="col-lg-5 reveal-up">
              <p class="eyebrow">Why Choose Svaadvika</p>
              <div class="why-grid">
                <article><i class="bi bi-egg-fried"></i><h3>Authentic Recipes</h3></article>
                <article><i class="bi bi-flower1"></i><h3>Premium Ingredients</h3></article>
                <article><i class="bi bi-hourglass-split"></i><h3>Easy Cooking</h3></article>
                <article><i class="bi bi-patch-check"></i><h3>Certified Quality</h3></article>
              </div>
            </div>
            <div class="col-lg-4 reveal-up">
              <p class="eyebrow">Experience Regional India</p>
              <div class="india-map" aria-label="Regional flavour map">
                <span class="pin delhi">Delhi</span>
                <span class="pin lucknow">Lucknow</span>
                <span class="pin mumbai">Mumbai</span>
                <span class="pin hyderabad">Hyderabad</span>
                <span class="pin kerala">Kerala</span>
              </div>
            </div>
            <div class="col-lg-3 reveal-right">
              <p class="region-text">Each region has a story. Click any city to explore its authentic flavours.</p>
              <a class="btn btn-gold" href="#recipes">Explore Now <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </section>

      <section class="video-band" id="recipes">
        <img src="https://images.unsplash.com/photo-1604909052743-94e838986d24?auto=format&fit=crop&w=1800&q=85" alt="Chef tossing biryani in a premium Indian kitchen" loading="lazy">
        <div class="video-content reveal-up">
          <p class="eyebrow">Cook Like A Chef</p>
          <h2>A Culinary Experience</h2>
          <p>That brings families together</p>
        </div>
        <button class="play-large" type="button" aria-label="Play culinary experience video"><i class="bi bi-play-fill"></i></button>
      </section>

      <!-- <section class="section manufacturing-showcase">
        <div class="container-xl">
          <div class="row gy-4 align-items-center">
            <div class="col-lg-6 reveal-up">
              <p class="eyebrow">Hygienic Production</p>
              <h2>Modern Manufacturing With Traditional Care</h2>
              <p>Each kit is developed in clean, quality-controlled facilities with batch traceability, food safety checks and recipe calibration.</p>
              <div class="timeline">
                <span>Ingredient Sourcing</span>
                <span>Quality Testing</span>
                <span>Fresh Packing</span>
              </div>
            </div>
            <div class="col-lg-6 reveal-right">
              <img src="https://images.unsplash.com/photo-1581092160607-ee22731c4af5?auto=format&fit=crop&w=1200&q=85" alt="Modern hygienic food manufacturing facility with stainless steel machinery" loading="lazy">
            </div>
          </div>
        </div>
      </section> -->

      <section class="social-section" id="blog">
        <div class="container-xl">
          <div class="row g-4 align-items-stretch">
            <div class="col-lg-3">
              <article class="testimonial-card reveal-up">
                <p class="eyebrow">What Our Customers Say</p>
                <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=240&q=85" alt="Customer Neha Sharma" loading="lazy">
                <div class="rating text-start"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div>
                <blockquote>“The taste is just like my grandmother’s biryani. Absolutely love it!”</blockquote>
                <strong>Neha Sharma</strong>
                <small>Verified Purchase</small>
              </article>
            </div>
            <div class="col-lg-3">
              <div class="instagram-block reveal-up">
                <p class="eyebrow">From Our Instagram</p>
                <div class="insta-grid">
                  <img src="https://images.unsplash.com/photo-1610057099431-d73a1c9d2f2f?auto=format&fit=crop&w=400&q=80" alt="Indian curry bowl" loading="lazy">
                  <img src="https://images.unsplash.com/photo-1606491956689-2ea866880c84?auto=format&fit=crop&w=400&q=80" alt="Indian chaat and spices" loading="lazy">
                  <img src="https://images.unsplash.com/photo-1601050690597-df0568f70950?auto=format&fit=crop&w=400&q=80" alt="Indian snacks platter" loading="lazy">
                  <img src="https://images.unsplash.com/photo-1626777552726-4a6b54c97e46?auto=format&fit=crop&w=400&q=80" alt="Spiced biryani plate" loading="lazy">
                  <img src="https://images.unsplash.com/photo-1596797038530-2c107229654b?auto=format&fit=crop&w=400&q=80" alt="Fresh herbs and Indian dish" loading="lazy">
                  <img src="https://images.unsplash.com/photo-1589302168068-964664d93dc0?auto=format&fit=crop&w=400&q=80" alt="Indian biryani serving bowl" loading="lazy">
                </div>
              </div>
            </div>
            <div class="col-lg-3">
              <form class="newsletter-card reveal-up" id="newsletterForm" novalidate>
                <p class="eyebrow">Join The Svaadvika Family</p>
                <h3>Get exclusive offers, recipes and more!</h3>
                <label class="visually-hidden" for="email">Email address</label>
                <input id="email" type="email" placeholder="Enter your email" required>
                <button class="btn btn-green w-100" type="submit">Subscribe Now <i class="bi bi-arrow-right"></i></button>
                <small class="form-message" role="status">We respect your privacy.</small>
              </form>
            </div>
            <div class="col-lg-3">
              <aside class="service-list reveal-right" aria-label="Store benefits">
                <article><i class="bi bi-truck"></i><span><strong>Free Shipping</strong><small>On orders above ₹699</small></span></article>
                <article><i class="bi bi-shield-lock"></i><span><strong>Secure Payment</strong><small>100% protected</small></span></article>
                <article><i class="bi bi-box-seam"></i><span><strong>Easy Returns</strong><small>Hassle free returns</small></span></article>
              </aside>
            </div>
          </div>
        </div>
      </section>
    </main>
@endsection
