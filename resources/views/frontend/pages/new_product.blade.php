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
        <label for="productPriceRange">Max Price: <span id="priceRangeValue">₹2000</span></label>
        <input id="productPriceRange" type="range" min="100" max="2000" value="2000" step="10">
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
        <p id="productCountText">Showing 8 Products</p>
      </div>

    </div>

    <div class="catalog-grid enhanced-catalog-grid" id="newProductGrid" aria-live="polite">
      @forelse($products as $product)
      @include('frontend.partials.product_card', ['product' => $product])
      @empty
      @endforelse
    </div>

    <div class="no-products-found w-100 text-center py-5" id="noProductsFound" hidden>
      <i class="bi bi-search-heart" style="font-size: 3rem; color: #ccc;"></i>
      <h3>No Products Found</h3>
      <p>Try changing the category, search, price or rating filter.</p>
      <a href="{{ route('frontend.products') }}" class="btn btn-gold mt-3">Clear Filters</a>
    </div>

    <div class="mt-5 d-flex justify-content-center catalog-pagination" id="newProductPagination">
      @if($products->hasPages())
      {{ $products->links('pagination::bootstrap-5') }}
      @endif
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
              Why do I need to add my own protein and rice for the biryani kits?
            </button>
          </h2>

          <div id="collapseOne"
            class="accordion-collapse collapse show"
            aria-labelledby="headingOne"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              So you get to choose exactly what goes into your biryani, chicken, mutton, paneer, or vegetables, and how much of it. Our kit takes care of the gravy, masala, fried onions, and tadka, the part that actually takes time and skill.
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
              How long do these products last?
            </button>
          </h2>

          <div id="collapseTwo"
            class="accordion-collapse collapse"
            aria-labelledby="headingTwo"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              [खरी shelf life इथे टाका, lab-tested आकड्यांवर आधारित] Always check the exact date printed on your pack.
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
              How many people does one pack serve?
            </button>
          </h2>

          <div id="collapseThree"
            class="accordion-collapse collapse"
            aria-labelledby="headingThree"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              [इथे प्रत्यक्ष serving size टाका, उदा. "Each biryani kit serves 3-4 people when paired with 500g of protein and rice."]
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
              How spicy are these?
            </button>
          </h2>

          <div id="collapseFour"
            class="accordion-collapse collapse"
            aria-labelledby="headingFour"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              [प्रत्येक product च्या spice level बद्दल एक सर्वसाधारण उत्तर, उदा. "Our Mumbai Biryani runs the spiciest, Hyderabadi and Exotic sit in the middle, and Moghlai is the mildest of the four."]
            </div>
          </div>
        </div>
        <!-- FAQ 5 -->
        <div class="accordion-item">
          <h2 class="accordion-header" id="headingFive">
            <button class="accordion-button collapsed"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#collapseFive"
              aria-expanded="false"
              aria-controls="collapseFive">
              Do the Ready-to-Eat Bhel packs need refrigeration?
            </button>
          </h2>

          <div id="collapseFive"
            class="accordion-collapse collapse"
            aria-labelledby="headingFive"
            data-bs-parent="#faqAccordion">
            <div class="accordion-body">
              [खरं उत्तर द्या — retort pack असल्यास साधारण "No, store in a cool, dry place. Refrigerate only after opening."]
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</section>
@push('before_scripts')
<script>
    window.SvaadvikaProducts = {!! json_encode($jsProducts) !!};
</script>
@endpush

@endsection