@extends('frontend.layouts.master')

@section('content')
<div class="details-main" data-product-details-page style="padding-top: 120px;">
    <div class="container-xl">
        <nav class="details-breadcrumb" aria-label="breadcrumb">
          <ol class="breadcrumb" id="detailsBreadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('frontend.products') }}">Products</a></li>
            @if($product->category)
            <li class="breadcrumb-item"><a href="{{ route('frontend.products') }}?category={{ $product->category->slug }}">{{ $product->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
          </ol>
        </nav>

        <section class="details-hero-grid">
          <div class="details-gallery reveal-up">
            <div class="details-main-image" id="detailsMainImage" data-zoom-stage>
              @if($product->sale_price)
                <span class="details-badge">Sale</span>
              @endif
              <button class="gallery-full" type="button" aria-label="View fullscreen" data-gallery-fullscreen><i class="bi bi-arrows-fullscreen"></i></button>
              <div id="productGalleryCarousel" class="carousel slide carousel-fade details-carousel" data-bs-touch="true" data-bs-interval="false">
                <div class="carousel-inner" id="detailsCarouselInner">
                  @foreach($jsProduct['images'] as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="zoom-box">
                          <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" loading="lazy">
                        </div>
                    </div>
                  @endforeach
                </div>
                <button class="carousel-control-prev gallery-nav gallery-prev" type="button" data-bs-target="#productGalleryCarousel" data-bs-slide="prev" aria-label="Previous image"><i class="bi bi-chevron-left"></i></button>
                <button class="carousel-control-next gallery-nav gallery-next" type="button" data-bs-target="#productGalleryCarousel" data-bs-slide="next" aria-label="Next image"><i class="bi bi-chevron-right"></i></button>
              </div>
            </div>
            <div class="details-thumbs" id="detailsThumbs" aria-label="Product images">
              @foreach($jsProduct['images'] as $index => $image)
                <button class="{{ $index === 0 ? 'active' : '' }}" type="button" data-gallery-thumb="{{ $index }}" data-gallery-target="main" aria-label="{{ $image['label'] }}">
                  <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" loading="lazy">
                </button>
              @endforeach
            </div>
          </div>

          <aside class="details-info reveal-right">
            <h1 id="detailsTitle">{{ $product->name }}</h1>
            <div class="details-rating" id="detailsRating"><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-half text-warning"></i><span>({{ $product->reviews_count ?? 120 }} Reviews)</span></div>
            <div id="detailsDescription" class="mt-3 mb-3">{!! $product->short_description !!}</div>
            
            <ul class="list-unstyled mb-4 text-muted">
                <li class="mb-2"><i class="bi bi-info-circle me-2"></i> <strong>Ingredients:</strong> {{ $product->ingredients ?? 'Premium spices, herbs and recipe base' }}</li>
                <li class="mb-2"><i class="bi bi-box me-2"></i> <strong>Weight:</strong> {{ $product->weight ?? '250g pack' }}</li>
            </ul>

            <div class="details-price">
                <strong id="detailsPrice">₹{{ $product->sale_price ?? $product->price }}</strong>
                @if($product->sale_price)
                    <del id="detailsOldPrice">₹{{ $product->price }}</del>
                    @php
                        $discount = $product->price > 0 ? round((($product->price - $product->sale_price) / $product->price) * 100) : 0;
                    @endphp
                    <span id="detailsDiscount">{{ $discount }}% Off</span>
                @endif
            </div>
            <div class="details-actions">
              <div class="qty-control"><button type="button" data-qty-minus>-</button><span>1</span><button type="button" data-qty-plus>+</button></div>
              <button class="add-cart" type="button" data-details-add-cart>Add To Cart</button>
            </div>
            <button class="details-buy" type="button" data-details-buy>Buy Now</button>
            <div class="details-meta"><span>SKU: <strong id="detailsSku">{{ $product->sku ?? 'N/A' }}</strong></span><span>Availability: <strong>{{ $product->stock_quantity > 0 ? 'In Stock' : 'Out of Stock' }}</strong></span></div>
            <div class="details-trust">
              <article><i class="bi bi-truck"></i><strong>Free Shipping</strong><small>On orders above &#8377;699</small></article>
              <article><i class="bi bi-shield-lock"></i><strong>Secure Payment</strong><small>100% secure checkout</small></article>
              <article><i class="bi bi-arrow-repeat"></i><strong>Easy Returns</strong><small>7 days return policy</small></article>
            </div>
            <div class="inside-card">
              <div>
                <h2>What&rsquo;s Inside the Kit?</h2>
                <ul><li>Basmati Rice</li><li>Biryani Masala</li><li>Marinade Paste</li><li>Fried Onions</li><li>Whole Spices</li><li>Ghee</li><li>Saffron</li></ul>
              </div>
              <div class="inside-pack"></div>
            </div>
          </aside>
        </section>

        <section class="details-feature-strip reveal-up">
          <article><i class="bi bi-fire"></i><span><strong>Authentic Recipe</strong><small>Traditional flavours</small></span></article>
          <article><i class="bi bi-basket2"></i><span><strong>Premium Ingredients</strong><small>Handpicked &amp; natural</small></span></article>
          <article><i class="bi bi-heart-pulse"></i><span><strong>No Artificial Colours</strong><small>100% natural</small></span></article>
          <article><i class="bi bi-flower1"></i><span><strong>Made in India</strong><small>Proudly Indian</small></span></article>
        </section>

        <section class="details-panel details-ingredients-grid">
          <div>
            <h2>Ingredients</h2>
            <p>Made with the finest quality ingredients for an authentic taste.</p>
            <div class="ingredient-row">
              <article><i class="bi bi-circle"></i><span>Basmati Rice</span></article>
              <article><i class="bi bi-droplet"></i><span>Biryani Masala</span></article>
              <article><i class="bi bi-cup-hot"></i><span>Marinade Paste</span></article>
              <article><i class="bi bi-flower2"></i><span>Fried Onions</span></article>
              <article><i class="bi bi-stars"></i><span>Whole Spices</span></article>
              <article><i class="bi bi-circle-fill"></i><span>Ghee</span></article>
              <article><i class="bi bi-brightness-high"></i><span>Saffron</span></article>
            </div>
            @if($product->ingredients)
            <p class="mt-3 text-muted"><small><strong>Full List:</strong> {{ $product->ingredients }}</small></p>
            @endif
          </div>
          <aside>
            <h2>Nutrition Information</h2>
            <p>Per 100g (Approx.)</p>
            <table class="table nutrition-table">
              <tbody>
                <tr>
                  <th>Energy</th>
                  <td>350 kcal</td>
                </tr>
                <tr>
                  <th>Protein</th>
                  <td>8 g</td>
                </tr>
                <tr>
                  <th>Carbohydrates</th>
                  <td>58 g</td>
                </tr>
                <tr>
                  <th>Total Fat</th>
                  <td>9 g</td>
                </tr>
                <tr>
                  <th>Sugar</th>
                  <td>2 g</td>
                </tr>
                <tr>
                  <th>Sodium</th>
                  <td>620 mg</td>
                </tr>
              </tbody>
            </table>
          </aside>
        </section>

        @if($product->long_description)
        <section class="details-panel mt-5">
          <h2>Product Description</h2>
          <div class="mt-4">
              {!! $product->long_description !!}
          </div>
        </section>
        @endif

        <section class="details-panel mt-5">
          <h2>Cooking Steps</h2>
          <p>Simple steps to cook delicious biryani at home.</p>
          <div class="cooking-steps">
            <article><i class="bi bi-hand-index"></i><strong>Step 1</strong><h3>Marinate</h3><p>Marinate meat with the paste for 30 minutes.</p></article>
            <article><i class="bi bi-arrow-right"></i></article>
            <article><i class="bi bi-cup-hot"></i><strong>Step 2</strong><h3>Cook Rice</h3><p>Cook basmati rice until 70% done.</p></article>
            <article><i class="bi bi-arrow-right"></i></article>
            <article><i class="bi bi-layers"></i><strong>Step 3</strong><h3>Layer</h3><p>Layer rice and marinated meat, add spices.</p></article>
            <article><i class="bi bi-arrow-right"></i></article>
            <article><i class="bi bi-alarm"></i><strong>Step 4</strong><h3>Dum Cook</h3><p>Cook on low heat for 20-25 minutes.</p></article>
            <article><i class="bi bi-arrow-right"></i></article>
            <article><i class="bi bi-stars"></i><strong>Step 5</strong><h3>Serve</h3><p>Fluff gently and serve hot with raita.</p></article>
          </div>
        </section>

        <section class="details-media-grid">
          <div class="details-panel video-panel">
            <div><h2>Video</h2><p>Watch our chef prepare Hyderabadi Biryani step by step.</p></div>
            <div class="details-video"><button type="button" aria-label="Play video" data-bs-toggle="modal" data-bs-target="#videoModal"><i class="bi bi-play-fill"></i></button></div>
          </div>
          <div class="details-panel">
            <h2>Frequently Asked Questions</h2>
            <div class="accordion details-faq" id="detailsFaq">
              <div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne">Can I make it vegetarian?</button></h3><div id="faqOne" class="accordion-collapse collapse" data-bs-parent="#detailsFaq"><div class="accordion-body">Yes, use paneer, vegetables, soya chunks or mushrooms instead of meat.</div></div></div>
              <div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo">How spicy is the biryani?</button></h3><div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#detailsFaq"><div class="accordion-body">It is medium-spiced and balanced for family meals.</div></div></div>
              <div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree">How much time does it take?</button></h3><div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#detailsFaq"><div class="accordion-body">Most recipes are ready in 35-45 minutes.</div></div></div>
            </div>
          </div>
        </section>

        <section class="details-panel reviews-panel">
          <h2>Customer Reviews</h2>
          <div class="reviews-grid">
            <div class="overall-rating"><strong>4.8</strong><div class="catalog-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i></div><p>Based on 128 reviews</p></div>
            <div class="rating-bars"><span>5 ★ <b></b>102</span><span>4 ★ <b></b>18</span><span>3 ★ <b></b>6</span><span>2 ★ <b></b>1</span><span>1 ★ <b></b>1</span></div>
            <article><img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?auto=format&fit=crop&w=120&q=80" alt="Neha Sharma" loading="lazy"><h3>Neha Sharma</h3><div class="catalog-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div><small>Verified Buyer</small><p>Super easy to cook and taste just like authentic Hyderabadi biryani.</p></article>
            <article><img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?auto=format&fit=crop&w=120&q=80" alt="Rahul Verma" loading="lazy"><h3>Rahul Verma</h3><div class="catalog-rating"><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i></div><small>Verified Buyer</small><p>The flavours are rich and ingredients are of premium quality.</p></article>
          </div>
        </section>

        <section class="details-related" id="detailsRelated">
          <h2>You May Also Like</h2>
          <div class="catalog-grid mt-4" id="detailsRelatedGrid">
              @foreach($relatedProducts as $relProduct)
                  @include('frontend.partials.product_card', ['product' => $relProduct])
              @endforeach
          </div>
        </section>

        <section class="details-feature-strip bottom">
          <article><i class="bi bi-fire"></i><span><strong>Authentic Recipes</strong><small>Traditional flavours</small></span></article>
          <article><i class="bi bi-basket2"></i><span><strong>Premium Ingredients</strong><small>Handpicked &amp; natural</small></span></article>
          <article><i class="bi bi-box-seam"></i><span><strong>Secure Packaging</strong><small>Hygienic &amp; safe</small></span></article>
          <article><i class="bi bi-flower1"></i><span><strong>Made in India</strong><small>Proudly Indian</small></span></article>
        </section>
      </div>
</div>

<div class="modal fade gallery-modal" id="galleryModal" tabindex="-1" aria-labelledby="galleryModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-fullscreen">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="galleryModalTitle">Product Gallery</h2>
        <div class="modal-tools">
          <button class="icon-btn" type="button" data-gallery-zoom aria-label="Zoom image"><i class="bi bi-zoom-in"></i></button>
          <button class="icon-btn" type="button" data-bs-dismiss="modal" aria-label="Close gallery"><i class="bi bi-x-lg"></i></button>
        </div>
      </div>
      <div class="modal-body">
        <div id="galleryModalCarousel" class="carousel slide carousel-fade modal-gallery-carousel" data-bs-touch="true" data-bs-interval="false">
          <div class="carousel-inner" id="modalCarouselInner">
            @foreach($jsProduct['images'] as $index => $image)
              <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                  <div class="zoom-box">
                    <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" loading="lazy">
                  </div>
              </div>
            @endforeach
          </div>
          <button class="carousel-control-prev gallery-nav gallery-prev" type="button" data-bs-target="#galleryModalCarousel" data-bs-slide="prev" aria-label="Previous fullscreen image"><i class="bi bi-chevron-left"></i></button>
          <button class="carousel-control-next gallery-nav gallery-next" type="button" data-bs-target="#galleryModalCarousel" data-bs-slide="next" aria-label="Next fullscreen image"><i class="bi bi-chevron-right"></i></button>
        </div>
        <div class="details-thumbs modal-thumbs" id="modalThumbs" aria-label="Fullscreen product images">
            @foreach($jsProduct['images'] as $index => $image)
              <button class="{{ $index === 0 ? 'active' : '' }}" type="button" data-gallery-thumb="{{ $index }}" data-gallery-target="modal" aria-label="{{ $image['label'] }}">
                <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" loading="lazy">
              </button>
            @endforeach
        </div>
      </div>
    </div>
  </div>
</div>

<div class="modal fade video-modal" id="videoModal" tabindex="-1" aria-labelledby="videoModalTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h2 class="modal-title" id="videoModalTitle">Cooking Video</h2>
        <button class="icon-btn" type="button" data-bs-dismiss="modal" aria-label="Close video"><i class="bi bi-x-lg"></i></button>
      </div>
      <div class="modal-body">
        <div class="details-video modal-video-frame"><button type="button" aria-label="Video preview"><i class="bi bi-play-fill"></i></button></div>
      </div>
    </div>
  </div>
</div>

@push('before_scripts')
<script>
    window.SvaadvikaProduct = {!! json_encode($jsProduct) !!};
    window.SvaadvikaRelatedProducts = {!! json_encode($jsRelatedProducts) !!};
</script>
@endpush
@endsection