<article class="catalog-card reveal-up is-visible" data-product-id="{{ $product->slug }}">
    @php
        $imageUrl = 'https://images.unsplash.com/photo-1631515243349-e0cb75fb8d3a?auto=format&fit=crop&w=900&q=85';
        if ($product->featuredImage) {
            $imageUrl = asset('storage/' . $product->featuredImage->image_path);
        } elseif ($product->images && $product->images->isNotEmpty()) {
            $imageUrl = asset('storage/' . $product->images->first()->image_path);
        }
    @endphp
    <div class="catalog-image" style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center;">
      <a href="{{ route('frontend.product_details', $product->slug) }}" style="position: absolute; inset: 0; z-index: 1;" aria-label="View {{ $product->name }} details"></a>
      @if($product->sale_price && $product->price > $product->sale_price)
          <span>Sale</span>
      @endif
      
      {{-- Removed style="position: relative" so CSS absolute positioning works --}}
      <!-- <button aria-label="Add {{ $product->name }} to wishlist" data-wishlist="{{ $product->id }}"><i class="bi bi-heart"></i></button> -->
      <button class="quick-view-icon" type="button" data-quick-view="{{ $product->slug }}" aria-label="Quick View {{ $product->name }}"><i class="bi bi-eye"></i></button>
    </div>
    <div class="catalog-body">
      <div class="catalog-meta">
        <span class="catalog-category">{{ $product->category ? $product->category->name : 'Other' }}</span>
        <span class="stock-pill {{ $product->is_out_of_stock ? 'bg-danger text-white border-danger' : '' }}">{{ $product->is_out_of_stock ? "Out of Stock" : "In Stock" }}</span>
      </div>
      <h3><a href="{{ route('frontend.product_details', $product->slug) }}">{{ $product->name }}</a></h3>
      <div class="catalog-rating">
          <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-half"></i>
          <small>({{ $product->reviews_count ?? 120 }})</small>
      </div>
      <p>{{ $product->short_description ?? '' }}</p>
      <div class="price-line">
          <strong>₹{{ (float)($product->sale_price ?? $product->price) }}</strong>
          @if($product->sale_price && $product->price > $product->sale_price)
              <del>₹{{ (float)$product->price }}</del>
              <span>{{ round((($product->price - $product->sale_price) / $product->price) * 100) }}% Off</span>
          @endif
      </div>
      <div class="catalog-actions">
          <div class="qty-control">
            <button type="button" data-qty-minus>-</button>
            <span>1</span>
            <button type="button" data-qty-plus>+</button>
          </div>
          @if($product->is_out_of_stock)
          <button class="add-cart" type="button" disabled style="background-color: #ccc; cursor: not-allowed; border: none; color: #666;">Out of Stock</button>
          @else
          <button class="add-cart" type="button" data-add-cart="{{ $product->id }}">Add To Cart</button>
          @endif
      </div>
    </div>
</article>
