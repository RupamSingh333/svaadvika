@extends('frontend.layouts.master')
@push('seo_tags')
<!-- Schema Markup -->
<script type="application/ld+json">
@verbatim
{
  "@context": "https://schema.org",
  "@type": "FAQPage",
  "mainEntity": [
    {
      "@type": "Question",
      "name": "What's the difference between ready-to-eat and ready-to-cook?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Ready-to-eat means just heat it and you're done. Ready-to-cook means we've done the prep and marination, you finish it on the stove, and take the credit for cooking."
      }
    },
    {
      "@type": "Question",
      "name": "Is this actually healthy, or just convenient?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Both, honestly. No artificial colors, no preservatives, ISO and FSSAI certified. Convenience doesn't have to mean cutting corners."
      }
    },
    {
      "@type": "Question",
      "name": "What makes Svaadvika different from other ready-to-eat brands?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "Real recipes collected from real homes across India, tested with a chef until they tasted right, not just fine. No artificial colors, no preservatives, and certifications you can actually verify."
      }
    },
    {
      "@type": "Question",
      "name": "Can I return a product if something's wrong?",
      "acceptedAnswer": {
        "@type": "Answer",
        "text": "We can't accept general returns since it's food, but if anything arrives damaged, wrong, or expired, we'll replace it or refund you, no argument. Just reach out within 48 hours with a photo."
      }
    }
  ]
}
@endverbatim
</script>
@endpush
@section('content')
<section class="hero-section" id="home">
  <div class="hero-bg" aria-hidden="true"></div>
  <div class="container-xl">
    <div class="row align-items-center min-vh-100 gy-5">
      <div class="col-lg-6 hero-copy reveal-up">
        <p class="eyebrow">Authentic Indian Taste</p>
        <h1>Crafted For <span>Modern</span> Families</h1>
        <p class="hero-text">Experience restaurant-quality Indian food at home in just minutes with premium ingredients, chef-led recipes and authentic regional flavour.</p>
        <div class="hero-actions">
          <a class="btn btn-gold" href="{{ route('frontend.products') }}">Make it Meal <i class="bi bi-arrow-right"></i></a>
        </div>
        <!-- <div class="hero-stats">
                <div><strong data-counter="25000">0</strong><small>Happy Families</small></div>
                <div><strong data-counter="120">0</strong><small>Recipes Tested</small></div>
                <div><strong data-counter="18">0</strong><small>Regions</small></div>
              </div> -->
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
      <article><i class="fa-solid fa-certificate"></i><span><strong>FSSAI</strong></span></article>
      <article><i class="bi bi-flower2"></i><span><strong>Made In</strong><small>India</small></span></article>
      <article><i class="bi bi-flask"></i><span><strong>No Artificial</strong><small>Color Preservatives</small></span></article>
      <article><i class="bi bi-person-check"></i><span><strong>Tradition </strong><small>Recipes</small></span></article>
      <article><i class="bi bi-award"></i><span><strong>Crafted With</strong><small>Chef Precision</small></span></article>
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
      <a class="text-link" href="{{ route('frontend.products') }}">View All Products <i class="bi bi-arrow-right"></i></a>
    </div>
    <div class="slider-wrap">
      <button class="slider-nav prev" type="button" aria-label="Previous products"><i class="bi bi-chevron-left"></i></button>
      <div class="product-slider" tabindex="0">
        @foreach($featuredProducts as $product)
        <article class="product-card reveal-up">
          @php
          $imageUrl = 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85';
          if ($product->featuredImage) {
          $imageUrl = asset('storage/' . $product->featuredImage->image_path);
          } elseif ($product->images && $product->images->isNotEmpty()) {
          $imageUrl = asset('storage/' . $product->images->first()->image_path);
          }
          @endphp
          @if($product->is_out_of_stock)
          <span class="tag" style="background-color: #dc3545; color: white; border-color: #dc3545;">Out of Stock</span>
          @elseif($product->sale_price)
          <span class="tag">Sale</span>
          @endif
          <a href="{{ route('frontend.product_details', $product->slug) }}">
            <img src="{{ $imageUrl }}" alt="{{ $product->name }}">
          </a>
          <div class="product-info">
            <h3><a href="{{ route('frontend.product_details', $product->slug) }}" style="color: inherit; text-decoration: none;">{{ $product->name }}</a></h3>
            @php
                $approvedReviews = $product->reviews()->where('is_approved', true)->get();
                $reviewsCount = $approvedReviews->count();
                $averageRating = $reviewsCount > 0 ? round($approvedReviews->avg('rating'), 1) : 0;
            @endphp
            <div class="rating">
                @for($i = 1; $i <= 5; $i++)
                    @if($i <= $averageRating)
                        <i class="bi bi-star-fill text-warning"></i>
                    @elseif($i - 0.5 <= $averageRating)
                        <i class="bi bi-star-half text-warning"></i>
                    @else
                        <i class="bi bi-star text-warning"></i>
                    @endif
                @endfor
                <span>({{ $reviewsCount }})</span>
            </div>
            <div class="price-row">
              <strong>
                @if($product->sale_price)
                ₹{{ (float)$product->sale_price }}
                <small class="text-muted text-decoration-line-through">₹{{ (float)($product->regular_price ?? $product->price) }}</small>
                @php
                $base_price = $product->regular_price ?? $product->price;
                $discount = $base_price > 0 ? round((($base_price - $product->sale_price) / $base_price) * 100) : 0;
                @endphp
                <span class="badge bg-success ms-1" style="font-size: 0.75rem;">{{ $discount }}% Off</span>
                @else
                ₹{{ (float)($product->regular_price ?? $product->price) }}
                @endif
              </strong>
              @if($product->is_out_of_stock)
              <button aria-label="Out of stock {{ $product->name }}" disabled style="opacity: 0.5; cursor: not-allowed; border: none; background: none; color: inherit;"><i class="bi bi-bag-x"></i></button>
              @else
              <button aria-label="Add {{ $product->name }} to cart" data-add-cart="{{ $product->id }}" style="position: relative; z-index: 2;"><i class="bi bi-bag-plus"></i></button>
              @endif
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
        <h2>It Started With a Craving <br><span>We</span> Couldn't Satisfy</h2>
        <p>You know that 11 PM feeling. Hotels are closed, you return from work and all you want is one meal that you can call home, without paying a fortune for something that barely tasted good.</p>
        <div class="story-actions">
          <a class="btn btn-green" href="{{ route('about') }}">Stock Your Pantry <i class="bi bi-arrow-right"></i></a>
          <!-- <button class="video-btn dark" type="button"><i class="bi bi-play-fill"></i><span>Watch Our Journey</span></button> -->
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
          <article><i class="bi bi-egg-fried"></i>
            <h3>Authentic Recipes</h3>
          </article>
          <article><i class="bi bi-flower1"></i>
            <h3>Premium Ingredients</h3>
          </article>
          <article><i class="bi bi-hourglass-split"></i>
            <h3>Easy Cooking</h3>
          </article>
          <article><i class="bi bi-patch-check"></i>
            <h3>Certified Quality</h3>
          </article>
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
        <a class="btn btn-gold" href="{{ route('recipes') }}">Limited Batch Claim Yours! <i class="bi bi-arrow-right"></i></a>
      </div>
    </div>
  </div>
</section>

<!-- <section class="video-band" id="recipes">
  <img src="https://images.unsplash.com/photo-1604909052743-94e838986d24?auto=format&fit=crop&w=1800&q=85" alt="Chef tossing biryani in a premium Indian kitchen" loading="lazy">
  <div class="video-content reveal-up">
    <p class="eyebrow">Cook Like A Chef</p>
    <h2>A Culinary Experience</h2>
    <p>That brings families together</p>
  </div>
  <button class="play-large" type="button" aria-label="Play culinary experience video"><i class="bi bi-play-fill"></i></button>
</section> -->

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
      <div class="col-lg-6">
        <div class="owl-carousel testimonial-slider">

        @if(isset($testimonials) && count($testimonials) > 0)
          @foreach($testimonials as $testimonial)
          <article class="testimonial-card">
            <p class="eyebrow">What Our Customers Say</p>

            @if($testimonial->avatar)
                <img src="{{ asset('storage/' . $testimonial->avatar) }}" alt="Customer {{ $testimonial->name }}" loading="lazy" style="object-fit: cover;">
            @else
                <img src="https://ui-avatars.com/api/?name={{ urlencode($testimonial->name) }}&background=0A3D2E&color=fff" alt="Customer {{ $testimonial->name }}" loading="lazy">
            @endif

            <div class="rating text-start">
              @for($i=1; $i<=5; $i++)
                  <i class="bi bi-star{{ $i <= $testimonial->rating ? '-fill' : '' }}"></i>
              @endfor
            </div>

            <blockquote>
              “{{ $testimonial->message }}”
            </blockquote>

            <strong>{{ $testimonial->name }}</strong>
            @if($testimonial->designation)
                <small>{{ $testimonial->designation }}</small>
            @endif
          </article>
          @endforeach
        @endif

        </div>

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
      <!-- <div class="col-lg-3">
        <form class="newsletter-card reveal-up" id="newsletterForm" novalidate>
          <p class="eyebrow">Join The Svaadvika Family</p>
          <h3>Get exclusive offers, recipes and more!</h3>
          <label class="visually-hidden" for="email">Email address</label>
          <input id="email" type="email" placeholder="Enter your email" required>
          <button class="btn btn-green w-100" type="submit">Subscribe Now <i class="bi bi-arrow-right"></i></button>
          <small class="form-message" role="status">We respect your privacy.</small>
        </form>
      </div> -->
      <div class="col-lg-3">
        <aside class="service-list reveal-right" aria-label="Store benefits">
          <article><i class="bi bi-truck"></i><span><strong>Free Delivery</strong><small>On orders above ₹499<br>Below that, a flat ₹49 delivery charge applies</small></span></article>
          <article><i class="bi bi-shield-lock"></i><span><strong>Secure Payment</strong><small>100% protected</small></span></article>
          <article><i class="bi bi-box-seam"></i><span><strong>Easy Returns</strong><small>Hassle free returns</small></span></article>
        </aside>
      </div>
    </div>
  </div>
</section>
<section class="contact-faq-section" id="faq">
  <div class="container-xl">
    <div class="contact-panel reveal-up">

      <div class="section-head contact-faq-head">
        <div>
          <h2>Frequently Asked Questions</h2>
        </div>
        <!-- <a class="text-link" href="#faq">
          View All FAQs <i class="bi bi-arrow-right"></i>
        </a> -->
      </div>

      <div class="accordion" id="faqAccordion">

        <!-- FAQ 1 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseOne"
              aria-expanded="true"
              aria-controls="collapseOne">
             What's the difference between ready-to-eat and ready-to-cook?
            </button>
          </h2>

          <div id="collapseOne"
            class="accordion-collapse collapse show"
            aria-labelledby="headingOne"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Ready-to-eat means just heat it and you're done. Ready-to-cook means we've done the prep and marination, you finish it on the stove, and take the credit for cooking.
            </div>
          </div>
        </div>

        <!-- FAQ 2 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingTwo">
            <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseTwo"
              aria-expanded="false"
              aria-controls="collapseTwo">
              Is this actually healthy, or just convenient?
            </button>
          </h2>

          <div id="collapseTwo"
            class="accordion-collapse collapse"
            aria-labelledby="headingTwo"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Both, honestly. No artificial colors, no preservatives, ISO and FSSAI certified. Convenience doesn't have to mean cutting corners, that was the whole point of building Svaadvika.
            </div>
          </div>
        </div>

        <!-- FAQ 3 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingThree">
            <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseThree"
              aria-expanded="false"
              aria-controls="collapseThree">
              What makes Svaadvika different from other ready-to-eat brands?
            </button>
          </h2>

          <div id="collapseThree"
            class="accordion-collapse collapse"
            aria-labelledby="headingThree"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              Real recipes collected from real homes across India, tested with a chef until they tasted right, not just fine. No artificial colors, no preservatives, and certifications you can actually verify.
            </div>
          </div>
        </div>

        <!-- FAQ 4 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFour">
            <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseFour"
              aria-expanded="false"
              aria-controls="collapseFour">
              Can I return a product if something's wrong?
            </button>
          </h2>

          <div id="collapseFour"
            class="accordion-collapse collapse"
            aria-labelledby="headingFour"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              We can't accept general returns since it's food, but if anything arrives damaged, wrong, or expired, we'll replace it or refund you, no argument. Just reach out within 48 hours with a photo.
            </div>
          </div>
        </div>

      </div>

    </div>
  </div>
</section>
</main>
@endsection