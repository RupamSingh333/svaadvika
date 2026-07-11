@extends('frontend.layouts.master')

@section('content')
<section class="recipes-hero">
        <div class="container-xl">
          <div class="recipes-hero-copy reveal-up">
            <nav class="details-breadcrumb recipes-breadcrumb" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Recipes</li>
              </ol>
            </nav>
            <h1>Our Recipes</h1>
            <h2>From India&apos;s Kitchens to Yours</h2>
            <p>Discover authentic recipes crafted with premium ingredients that bring out the true flavours of India.</p>
            <span class="products-divider" aria-hidden="true"></span>
          </div>
        </div>
      </section>

      <section class="recipes-catalog-section">
        <div class="container-xl">
          <div class="mobile-recipe-tools">
            <button class="btn btn-green" type="button" data-bs-toggle="offcanvas" data-bs-target="#recipeFilterCanvas"><i class="bi bi-sliders"></i> Filter Recipes</button>
          </div>
          <div class="recipes-layout">
            <aside class="recipe-filter-sidebar reveal-up" aria-label="Recipe filters">
              <form action="{{ route('recipes') }}" method="GET" id="recipeFilterForm">
                <div class="recipe-filter-head"><h2>Filter Recipes</h2><i class="bi bi-sliders"></i></div>
                
                <div id="recipeFilters">
                    <!-- Search -->
                    <div class="recipe-filter-group">
                        <h3>Search<i class="bi bi-chevron-up"></i></h3>
                        <div class="mb-3">
                            <input type="text" name="search" class="form-control form-control-sm" placeholder="Search..." value="{{ request('search') }}">
                        </div>
                    </div>

                    <!-- Category -->
                    <div class="recipe-filter-group">
                        <h3>Categories<i class="bi bi-chevron-up"></i></h3>
                        <label class="recipe-check">
                            <input type="radio" name="category" value="all" {{ request('category', 'all') === 'all' ? 'checked' : '' }}>
                            <span>All</span>
                        </label>
                        @foreach($categories as $category)
                            <label class="recipe-check">
                                <input type="radio" name="category" value="{{ $category }}" {{ request('category') === $category ? 'checked' : '' }}>
                                <span>{{ $category }}</span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Difficulty -->
                    <div class="recipe-filter-group">
                        <h3>Difficulty<i class="bi bi-chevron-up"></i></h3>
                        @foreach($difficulties as $difficulty)
                            <label class="recipe-check">
                                <input type="checkbox" name="difficulty[]" value="{{ $difficulty }}" {{ in_array($difficulty, (array)request('difficulty', [])) ? 'checked' : '' }}>
                                <span>{{ $difficulty }}</span>
                            </label>
                        @endforeach
                    </div>

                    <!-- Diet Type -->
                    <div class="recipe-filter-group">
                        <h3>Diet Type<i class="bi bi-chevron-up"></i></h3>
                        @foreach($dietTypes as $diet)
                            <label class="recipe-check">
                                <input type="checkbox" name="diet_type[]" value="{{ $diet }}" {{ in_array($diet, (array)request('diet_type', [])) ? 'checked' : '' }}>
                                <span>{{ $diet }}</span>
                            </label>
                        @endforeach
                    </div>
                </div>

                <div class="recipe-filter-actions">
                    <button class="btn btn-green" type="submit">Apply Filters</button>
                    <a href="{{ route('recipes') }}" class="clear-filter text-decoration-none">Clear All <i class="bi bi-arrow-counterclockwise"></i></a>
                </div>
              </form>
            </aside>

            <div class="recipe-results">
              <div class="recipes-toolbar reveal-up">
                <div><h2>All Recipes <span>({{ $recipes->total() }})</span></h2></div>
                <div class="recipe-search-sort ">
                  <select name="sort" aria-label="Sort recipes" class="form-select form-select-sm" onchange="document.getElementById('recipeFilterForm').sort.value=this.value; document.getElementById('recipeFilterForm').submit();">
                    <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>Sort by: Latest</option>
                    <option value="az" {{ request('sort') == 'az' ? 'selected' : '' }}>Alphabetical (A-Z)</option>
                  </select>
                  <input type="hidden" name="sort" form="recipeFilterForm" value="{{ request('sort', 'latest') }}">
                </div>
              </div>
              
              <div class="recipe-grid" aria-live="polite">
                  @forelse($recipes as $recipe)
                      @php
                          $imageUrl = 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=900&q=85';
                          if ($recipe->featured_image) {
                              $imageUrl = asset('storage/' . $recipe->featured_image);
                          }
                      @endphp
                      <article class="recipe-card reveal-up is-visible">
                        <div class="recipe-image">
                            <img src="{{ $imageUrl }}" alt="{{ $recipe->title }}" loading="lazy">
                            <span class="recipe-badge">{{ $recipe->category }}</span>
                            <div class="recipe-card-actions">
                                <!-- <button type="button" aria-label="Bookmark"><i class="bi bi-bookmark"></i></button> -->
                              <button type="button" aria-label="Quick view" data-bs-toggle="modal" data-bs-target="#recipeQuickModal-{{ $recipe->id }}"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                        <div class="recipe-card-body">
                            <h3><a href="{{ route('recipe_details', $recipe->slug) }}">{{ $recipe->title }}</a></h3>
                            <p>{{ $recipe->short_description ?? Str::limit(strip_tags($recipe->description), 100) }}</p>
                            <div class="recipe-meta">
                                <span><i class="bi bi-clock"></i> {{ $recipe->duration }}</span>
                                <span class="recipe-spice">
                                    @if($recipe->spice_level === 'Hot')
                                        🌶️🌶️🌶️
                                    @elseif($recipe->spice_level === 'Medium')
                                        🌶️🌶️
                                    @else
                                        🌶️
                                    @endif
                                </span>
                            </div>
                        </div>
                      </article>
                  @empty
                      <div class="no-products-found w-100 text-center py-5">
                          <i class="bi bi-search-heart fa-3x"></i>
                          <h3>No Recipes Found</h3>
                          <p>Try changing your filters or search.</p>
                      </div>
                  @endforelse
              </div>
              
              <div class="mt-5 d-flex justify-content-center">
                  {{ $recipes->links('pagination::bootstrap-5') }}
              </div>
            </div>
          </div>

          <section class="recipe-newsletter reveal-up">
            <div class="recipe-news-icon"><i class="bi bi-envelope"></i></div>
            <div><h2>Stay Updated with Delicious Recipes!</h2><p>Subscribe to our newsletter for new recipes, cooking tips and exclusive updates.</p></div>
            <form id="recipeNewsletter" class="needs-validation" novalidate><label class="visually-hidden" for="recipeNewsletterEmail">Email address</label><input id="recipeNewsletterEmail" type="email" placeholder="Enter your email address" required><button type="submit">Subscribe</button><div class="invalid-feedback">Please enter a valid email.</div></form>
          </section>
        </div>
      </section>

      @foreach($recipes as $recipe)
        @php
            $imageUrl = 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=900&q=85';
            if ($recipe->featured_image) {
                $imageUrl = asset('storage/' . $recipe->featured_image);
            }
        @endphp
        <div class="modal fade recipe-quick-modal" id="recipeQuickModal-{{ $recipe->id }}" tabindex="-1" aria-labelledby="recipeQuickTitle-{{ $recipe->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-body">
                        <div class="recipe-quick-layout">
                            <img src="{{ $imageUrl }}" alt="{{ $recipe->title }}" loading="lazy" style="width: 100%; object-fit: cover; border-radius: var(--radius-md);">
                            <div class="recipe-quick-content mt-3">
                                <p class="eyebrow text-uppercase fw-bold" style="color: var(--brand-gold);">{{ $recipe->category }}</p>
                                <h2 id="recipeQuickTitle-{{ $recipe->id }}">{{ $recipe->title }}</h2>
                                <div class="catalog-rating mb-3"><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-half text-warning"></i><small>(120)</small></div>
                                <p>{{ $recipe->short_description ?? Str::limit(strip_tags($recipe->description), 150) }}</p>
                                <ul class="list-unstyled mb-4">
                                    <li class="mb-2"><strong>Time:</strong> {{ $recipe->duration ?? '30 mins' }}</li>
                                    <li class="mb-2"><strong>Difficulty:</strong> {{ $recipe->difficulty ?? 'Medium' }}</li>
                                    <li class="mb-2"><strong>Diet:</strong> {{ $recipe->diet_type ?? 'Vegetarian' }}</li>
                                    <li class="mb-2"><strong>Spice Level:</strong> {{ $recipe->spice_level ?? 'Medium' }}</li>
                                </ul>
                                <a class="btn btn-gold w-100" href="{{ route('recipe_details', $recipe->slug) }}">View Recipe <i class="bi bi-arrow-right ms-2"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
      @endforeach

@endsection