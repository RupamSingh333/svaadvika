@extends('frontend.layouts.master')

@section('content')
<section class="products-hero">
        <div class="container-xl">
          <div class="products-hero-copy reveal-up">
            <nav class="breadcrumb-nav" aria-label="Breadcrumb">
              <a href="{{ route('home') }}">Home</a>
              <i class="bi bi-chevron-right"></i>
              <span>Products</span>
            </nav>
            <h1>Our Products</h1>
            <p>Authentic flavours, premium ingredients crafted for your kitchen.</p>
            <span class="products-divider" aria-hidden="true"></span>
          </div>
        </div>
      </section>

      <section class="product-catalog-section" id="newProductCatalog" data-new-product-page>
        <div class="container-xl">
          <div class="product-category-wrap reveal-up">
            <div class="products-section-title">
              <h2>Shop By Category</h2>
            </div>
            <div class="category-tabs enhanced-category-tabs" aria-label="Product categories">
              <button class="active" type="button" data-filter-category="all"><i class="bi bi-grid"></i><span>All</span></button>
              @foreach($categories as $category)
                  <button type="button" data-filter-category="{{ $category->slug }}">
                      <i class="bi {{ $category->icon_class ?? 'bi-tag' }}"></i>
                      <span>{{ $category->name }}</span>
                  </button>
              @endforeach
            </div>
          </div>

          <div class="product-filter-panel reveal-up">
            <div class="live-search-field">
              <label for="productLiveSearch">Search Products</label>
              <div>
                <i class="bi bi-search"></i>
                <input id="productLiveSearch" type="search" placeholder="Search by product, category or description">
              </div>
            </div>
            <div class="price-filter d-none">
              <label for="productPriceRange">Max Price <strong id="priceRangeValue">&#8377;600</strong></label>
              <input id="productPriceRange" type="range" min="100" max="600" value="600" step="10">
            </div>
            <div class="rating-filter d-none">
              <label for="productRatingFilter">Rating</label>
              <select id="productRatingFilter" aria-label="Filter by rating">
                <option value="0">All Ratings</option>
                <option value="5">★★★★★</option>
                <option value="4">★★★★+</option>
                <option value="3">★★★+</option>
              </select>
            </div>
            <div class="rating-filter">
              <label for="productRatingFilter">Sort products</label>
                  <select id="productSortSelect" aria-label="Sort products">
                <option value="best-selling">Sort by: Best Selling</option>
                <option value="newest">Newest</option>
                <option value="price-low">Price Low → High</option>
                <option value="price-high">Price High → Low</option>
                <option value="az">A → Z</option>
                <option value="za">Z → A</option>
                <!-- <option value="highest-rating">Highest Rating</option>
                <option value="most-reviewed">Most Reviewed</option> -->
              </select>
            </div>
          </div>

          <div class="products-toolbar reveal-up">
            <div>
              <h2>All Products</h2>
              <p id="productCountText">Showing 12 of 30 Products</p>
            </div>
            
          </div>

          <div class="catalog-grid enhanced-catalog-grid" id="newProductGrid" aria-live="polite">
            @forelse($products as $product)
                @include('frontend.partials.product_card', ['product' => $product])
            @empty
                <div class="no-products-found w-100 text-center py-5" id="noProductsFound">
                  <i class="bi bi-search-heart"></i>
                  <h3>No Products Found</h3>
                  <p>Try changing the category, search, price or rating filter.</p>
                  <a href="{{ route('frontend.products') }}" class="btn btn-gold mt-3">Clear Filters</a>
                </div>
            @endforelse
          </div>
          
          @if($products->hasPages())
          <div class="mt-5 d-flex justify-content-center">
              {{ $products->links('pagination::bootstrap-5') }}
          </div>
          @endif
      </section>

@push('before_scripts')
<script>
    window.SvaadvikaProducts = {!! json_encode($jsProducts) !!};
</script>
@endpush

@endsection