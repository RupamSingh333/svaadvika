@extends('frontend.layouts.master')

@section('title', $product->meta_title ?: $product->name . ' - Premium Quality')
@section('canonical_url', url()->current())
@section('meta_description', $product->meta_description ?: 'Buy ' . $product->name . '. ' . Str::limit(strip_tags($product->short_description), 150))

@push('styles')
   @if(
    !empty(trim($product->schema_markup ?? '')) &&
    str_contains($product->schema_markup, 'application/ld+json')
)
    {!! $product->schema_markup !!}
@endif

    
    @php
        $keywords = $product->meta_keywords;
        if (!$keywords && !empty($product->ingredients_list)) {
            $keywords = implode(', ', array_column($product->ingredients_list, 'name'));
        } elseif (!$keywords) {
            $keywords = $product->name . ', biryani, ready to cook, premium food';
        }
    @endphp
    <meta name="keywords" content="{{ $keywords }}">
@endpush

@section('content')
<section class="products-hero">
    <div class="container-xl">
        <div class="products-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb" id="detailsBreadcrumb">
                <a href="/">Home</a>
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('frontend.products') }}">Products</a>
                @if($product->category)
                <i class="bi bi-chevron-right"></i>
                <a href="{{ route('frontend.products') }}?category={{ $product->category->slug }}">{{ $product->category->name }}</a>
                @endif
                <i class="bi bi-chevron-right"></i>
                <span>{{ $product->name }}</span>
            </nav>
            <h1>{{ $product->name }}</h1>
            <p>Authentic flavours, premium ingredients crafted for your kitchen.</p>
            <span class="products-divider" aria-hidden="true"></span>
        </div>
    </div>
</section>

<div class="details-main" data-product-details-page style="padding-top: 40px;">
    <div class="container-xl">

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
              @if($product->is_out_of_stock)
              <button class="add-cart" type="button" disabled style="background-color: #ccc; cursor: not-allowed; border: none; color: #666;">Out of Stock</button>
              @else
              <button class="add-cart" type="button" data-details-add-cart>Add To Cart</button>
              @endif
              <button class="icon-btn wishlist-active-state ms-2" type="button" data-wishlist="{{$product->id}}" aria-label="Toggle {{$product->title}} wishlist" style="width:48px;height:48px;border-radius:50%;border:1px solid #ddd;background:#fff;"><i class="bi bi-heart"></i></button>
            </div>
            @if($product->is_out_of_stock)
            <button class="details-buy" type="button" disabled style="background-color: #ccc; cursor: not-allowed; border: none; color: #666;">Out of Stock</button>
            @else
            <button class="details-buy" type="button" data-details-buy>Buy Now</button>
            @endif
            <div class="details-meta"><span>SKU: <strong id="detailsSku">{{ $product->sku ?? 'N/A' }}</strong></span><span>Availability: <strong class="{{ $product->is_out_of_stock ? 'text-danger' : 'text-success' }}">{{ $product->is_out_of_stock ? 'Out of Stock' : 'In Stock' }}</strong></span></div>
            <div class="details-trust">
              <article><i class="bi bi-truck"></i><strong>Free Shipping</strong><small>On orders above &#8377;699</small></article>
              <article><i class="bi bi-shield-lock"></i><strong>Secure Payment</strong><small>100% secure checkout</small></article>
              <article><i class="bi bi-arrow-repeat"></i><strong>Easy Returns</strong><small>7 days return policy</small></article>
            </div>
            <!-- <div class="inside-card">
              <div>
                <h2>What&rsquo;s Inside the Kit?</h2>
                <ul>
                  @if(is_array($product->kit_items) && count($product->kit_items) > 0)
                    @foreach($product->kit_items as $item)
                      <li>{{ $item }}</li>
                    @endforeach
                  @else
                    <li>Basmati Rice</li><li>Biryani Masala</li><li>Marinade Paste</li><li>Fried Onions</li><li>Whole Spices</li><li>Ghee</li><li>Saffron</li>
                  @endif
                </ul>
              </div>
              <div class="inside-pack"></div>
            </div> -->
          </aside>
        </section>

        <section class="details-feature-strip reveal-up">
          @if(is_array($product->features) && count($product->features) > 0)
            @foreach($product->features as $feature)
              <article><i class="{{ $feature['icon'] ?? 'bi bi-check' }}"></i><span><strong>{{ $feature['title'] ?? '' }}</strong><small>{{ $feature['subtitle'] ?? '' }}</small></span></article>
            @endforeach
          @else
            <article><i class="bi bi-fire"></i><span><strong>Authentic Recipe</strong><small>Traditional flavours</small></span></article>
            <article><i class="bi bi-basket2"></i><span><strong>Premium Ingredients</strong><small>Handpicked &amp; natural</small></span></article>
            <article><i class="bi bi-heart-pulse"></i><span><strong>No Artificial Colours</strong><small>100% natural</small></span></article>
            <article><i class="bi bi-flower1"></i><span><strong>Made in India</strong><small>Proudly Indian</small></span></article>
          @endif
        </section>

        <section class="details-panel details-ingredients-grid">
          <div>
            <h2>Ingredients</h2>
            <p>Made with the finest quality ingredients for an authentic taste.</p>
            <div class="ingredient-row">
              @if(is_array($product->ingredients_list) && count($product->ingredients_list) > 0)
                @foreach($product->ingredients_list as $ingredient)
                  <article><i class="{{ $ingredient['icon'] ?? 'bi bi-circle' }}"></i><span>{{ $ingredient['name'] ?? '' }}</span></article>
                @endforeach
              @else
                <article><i class="bi bi-circle"></i><span>Basmati Rice</span></article>
                <article><i class="bi bi-droplet"></i><span>Biryani Masala</span></article>
                <article><i class="bi bi-cup-hot"></i><span>Marinade Paste</span></article>
                <article><i class="bi bi-flower2"></i><span>Fried Onions</span></article>
                <article><i class="bi bi-stars"></i><span>Whole Spices</span></article>
                <article><i class="bi bi-circle-fill"></i><span>Ghee</span></article>
                <article><i class="bi bi-brightness-high"></i><span>Saffron</span></article>
              @endif
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
                @if(is_array($product->nutrition_info) && count($product->nutrition_info) > 0)
                  @foreach($product->nutrition_info as $nutrition)
                    <tr>
                      <th>{{ $nutrition['name'] ?? '' }}</th>
                      <td>{{ $nutrition['value'] ?? '' }}</td>
                    </tr>
                  @endforeach
                @else
                  <tr><th>Energy</th><td>350 kcal</td></tr>
                  <tr><th>Protein</th><td>8 g</td></tr>
                  <tr><th>Carbohydrates</th><td>58 g</td></tr>
                  <tr><th>Total Fat</th><td>9 g</td></tr>
                  <tr><th>Sugar</th><td>2 g</td></tr>
                  <tr><th>Sodium</th><td>620 mg</td></tr>
                @endif
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
          @if($product->video_url)
          <div class="details-panel video-panel">
            <div><h2>Video</h2><p>Watch our chef prepare {{ $product->name }} step by step.</p></div>
            <div class="details-video"><button type="button" aria-label="Play video" data-bs-toggle="modal" data-bs-target="#videoModal"><i class="bi bi-play-fill"></i></button></div>
          </div>
          @endif
          <div class="details-panel {{ !$product->video_url ? 'w-100' : '' }}">
            <h2>Frequently Asked Questions</h2>
            <div class="accordion details-faq" id="detailsFaq">
              @if(is_array($product->faqs) && count($product->faqs) > 0)
                @foreach($product->faqs as $index => $faq)
                <div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq{{ $index }}">{{ $faq['question'] ?? '' }}</button></h3><div id="faq{{ $index }}" class="accordion-collapse collapse" data-bs-parent="#detailsFaq"><div class="accordion-body">{{ $faq['answer'] ?? '' }}</div></div></div>
                @endforeach
              @else
                <div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqOne">Can I make it vegetarian?</button></h3><div id="faqOne" class="accordion-collapse collapse" data-bs-parent="#detailsFaq"><div class="accordion-body">Yes, use paneer, vegetables, soya chunks or mushrooms instead of meat.</div></div></div>
                <div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqTwo">How spicy is the biryani?</button></h3><div id="faqTwo" class="accordion-collapse collapse" data-bs-parent="#detailsFaq"><div class="accordion-body">It is medium-spiced and balanced for family meals.</div></div></div>
                <div class="accordion-item"><h3 class="accordion-header"><button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faqThree">How much time does it take?</button></h3><div id="faqThree" class="accordion-collapse collapse" data-bs-parent="#detailsFaq"><div class="accordion-body">Most recipes are ready in 35-45 minutes.</div></div></div>
              @endif
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
      <div class="modal-body p-0" style="aspect-ratio: 16/9; background: #000;">
        @if($product->video_url)
          @php
            $url = $product->video_url;
            $ytMatch = preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
          @endphp
          @if($ytMatch && isset($matches[1]))
            <iframe width="100%" height="100%" src="https://www.youtube.com/embed/{{ $matches[1] }}" frameborder="0" allowfullscreen></iframe>
          @elseif(str_contains($url, 'instagram.com'))
            <iframe width="100%" height="100%" src="{{ $url }}/embed" frameborder="0" scrolling="no" allowtransparency="true"></iframe>
          @elseif(preg_match('/\.(mp4|webm|ogg)$/i', $url))
            <video width="100%" height="100%" controls style="object-fit:contain"><source src="{{ $url }}" type="video/mp4"></video>
          @else
            <div class="d-flex align-items-center justify-content-center h-100">
                <a href="{{ $url }}" target="_blank" class="btn btn-outline-light">Watch Video Here</a>
            </div>
          @endif
        @else
          <div class="details-video modal-video-frame h-100 w-100 d-flex align-items-center justify-content-center text-white"><p>No video available.</p></div>
        @endif
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