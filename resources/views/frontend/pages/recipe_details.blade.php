@extends('frontend.layouts.master')

@section('title', $recipe->meta_title ?: $recipe->title . ' - Recipe')
@section('canonical_url', url()->current())
@section('meta_description', $recipe->meta_description ?: 'Learn how to make ' . $recipe->title . '. ' . Str::limit(strip_tags($recipe->short_description), 150))

@push('styles')
    @if(
    !empty(trim($recipe->schema_markup ?? '')) &&
    str_contains($recipe->schema_markup, 'application/ld+json')
)
    {!! $recipe->schema_markup !!}
@endif
    @php
        $keywords = $recipe->meta_keywords;
        if (!$keywords) {
            $keywords = $recipe->title . ', recipe, ' . strtolower($recipe->category) . ', how to cook';
        }
    @endphp
    <meta name="keywords" content="{{ $keywords }}">
@endpush

@section('content')
<section class="recipes-hero">
    <div class="container-xl">
        <div class="recipes-hero-copy reveal-up">
            <nav class="details-breadcrumb recipes-breadcrumb" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('recipes') }}">Recipes</a></li>
                    @if($recipe->category)
                    <li class="breadcrumb-item"><a href="{{ route('recipes') }}?category={{ $recipe->category }}">{{ $recipe->category }}</a></li>
                    @endif
                    <li class="breadcrumb-item active" aria-current="page">{{ $recipe->title }}</li>
                </ol>
            </nav>
            <h1>{{ $recipe->title }}</h1>
            <p>{{ $recipe->category }} Recipe</p>
            <span class="products-divider" aria-hidden="true"></span>
        </div>
    </div>
</section>

<div class="details-main" style="padding-top: 40px;">
    <div class="container-xl">

        <section class="details-hero-grid">
          <div class="details-gallery reveal-up">
            <div class="details-main-image" id="detailsMainImage" data-zoom-stage>
              @php
                  $images = [];
                  $featured = 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=900&q=85';
                  if ($recipe->featured_image) {
                      $featured = asset('storage/' . $recipe->featured_image);
                  }
                  $images[] = $featured;
                  
                  if (!empty($recipe->gallery_images)) {
                      $gallery = is_array($recipe->gallery_images) ? $recipe->gallery_images : json_decode($recipe->gallery_images, true);
                      if(is_array($gallery)) {
                          foreach($gallery as $gImg) {
                              $images[] = asset('storage/' . $gImg);
                          }
                      }
                  }
              @endphp

              <button class="gallery-full" type="button" aria-label="View fullscreen" data-gallery-fullscreen><i class="bi bi-arrows-fullscreen"></i></button>
              <div id="productGalleryCarousel" class="carousel slide carousel-fade details-carousel" data-bs-touch="true" data-bs-interval="false">
                <div class="carousel-inner" id="detailsCarouselInner">
                  @foreach($images as $index => $image)
                    <div class="carousel-item {{ $index === 0 ? 'active' : '' }}">
                        <div class="zoom-box">
                          <img src="{{ $image }}" alt="{{ $recipe->title }}" loading="lazy" style="width: 100%; border-radius: var(--radius-xl); object-fit: cover; aspect-ratio: 1/1;">
                        </div>
                    </div>
                  @endforeach
                </div>
                @if(count($images) > 1)
                <button class="carousel-control-prev gallery-nav gallery-prev" type="button" data-bs-target="#productGalleryCarousel" data-bs-slide="prev" aria-label="Previous image"><i class="bi bi-chevron-left"></i></button>
                <button class="carousel-control-next gallery-nav gallery-next" type="button" data-bs-target="#productGalleryCarousel" data-bs-slide="next" aria-label="Next image"><i class="bi bi-chevron-right"></i></button>
                @endif
              </div>
            </div>
            
            @if(count($images) > 1)
            <div class="details-thumbs mt-3" id="detailsThumbs" aria-label="Recipe images">
              @foreach($images as $index => $image)
                <button class="{{ $index === 0 ? 'active' : '' }}" type="button" data-gallery-thumb="{{ $index }}" data-gallery-target="main" aria-label="Thumbnail {{ $index + 1 }}">
                  <img src="{{ $image }}" alt="{{ $recipe->title }} thumbnail" loading="lazy" style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius-md); border: 2px solid transparent;">
                </button>
              @endforeach
            </div>
            @endif
          </div>

          <aside class="details-info reveal-right">
            <p class="eyebrow" style="color: var(--brand-gold); text-transform: uppercase; font-weight: 700; letter-spacing: 1px;">{{ $recipe->category }}</p>
            <h1>{{ $recipe->title }}</h1>
            <div class="details-rating"><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-fill text-warning"></i><i class="bi bi-star-half text-warning"></i><span>(120 Reviews)</span></div>
            
            <div class="mt-4 mb-4">
                <p>{{ $recipe->short_description ?? strip_tags($recipe->description) }}</p>
            </div>
            
            <div class="row g-3 mb-4 text-muted">
                <div class="col-6 col-md-3">
                    <div class="d-block align-items-center  text-center">
                        <i class="bi bi-clock fs-4 me-2 text-primary"></i>
                        <div>
                            <small class="d-block text-uppercase">Time</small>
                            <strong>{{ $recipe->duration ?? '30 mins' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="d-block align-items-center  text-center">
                        <i class="bi bi-fire fs-4 me-2 text-danger"></i>
                        <div>
                            <small class="d-block text-uppercase">Spice</small>
                            <strong>{{ $recipe->spice_level ?? 'Medium' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="d-block align-items-center  text-center">
                        <i class="bi bi-bar-chart fs-4 me-2 text-success"></i>
                        <div>
                            <small class="d-block text-uppercase">Difficulty</small>
                            <strong>{{ $recipe->difficulty ?? 'Medium' }}</strong>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3">
                    <div class="d-block align-items-center text-center">
                        <i class="bi bi-egg-fried fs-4 me-2 text-warning"></i>
                        <div>
                            <small class="d-block text-uppercase">Diet</small>
                            <strong>{{ $recipe->diet_type ?? 'Vegetarian' }}</strong>
                        </div>
                    </div>
                </div>
            </div>
@if($recipe->youtube_url)
<div class="details-panel">
                        <h2 >Video Guide</h2>
                        <div class="ratio ratio-16x9 mt-4" style="border-radius: var(--radius-xl); overflow: hidden;">
                            @php
                                $videoUrl = $recipe->youtube_url;
                                $videoId = '';
                                if (preg_match('/youtube\.com\/watch\?v=([^\&\?\/]+)/', $videoUrl, $id)) {
                                    $videoId = $id[1];
                                } else if (preg_match('/youtube\.com\/embed\/([^\&\?\/]+)/', $videoUrl, $id)) {
                                    $videoId = $id[1];
                                } else if (preg_match('/youtube\.com\/v\/([^\&\?\/]+)/', $videoUrl, $id)) {
                                    $videoId = $id[1];
                                } else if (preg_match('/youtu\.be\/([^\&\?\/]+)/', $videoUrl, $id)) {
                                    $videoId = $id[1];
                                } else if (preg_match('/youtube\.com\/shorts\/([^\&\?\/]+)/', $videoUrl, $id)) {
                                    $videoId = $id[1];
                                }
                                $embedUrl = $videoId ? "https://www.youtube.com/embed/" . $videoId : $videoUrl;
                            @endphp
                            <iframe src="{{ $embedUrl }}" title="YouTube video" allowfullscreen></iframe>
                        </div>
                    @endif
</div>
            
          </aside>
        </section>

        <section class="details-panel mt-5 pt-4 border-top">
            <div class="row">
                <div class="col-lg-8">
                    <h2>Instructions</h2>
                    <div class="recipe-instructions mt-4" style="line-height: 1.8; font-size: 1.1rem; color: var(--text-base);">
                        {!! $recipe->description !!}
                    </div>
                </div>
                <div class="col-lg-4">
                     
              <div>
                <h2>Ingredients</h2>
                <ul style="padding-left: 1.5rem; line-height: 1.8;">
                    @php
                        $ingredientsList = explode(',', $recipe->ingredients ?? 'No ingridients added yet.');
                    @endphp
                    @foreach($ingredientsList as $ingredient)
                        <li>{{ trim($ingredient) }}</li>
                    @endforeach
                </ul>
              </div>
            </div>
            </div>
        </section>

        @if($relatedRecipes->isNotEmpty())
        <section class="related-products mt-5 pt-5 border-top">
            <div class="section-title text-center mb-5">
                <h2>You May Also Like</h2>
            </div>
            <div class="row g-4">
                @foreach($relatedRecipes as $relRecipe)
                    <div class="col-md-4">
                        <article class="recipe-card reveal-up is-visible" style="opacity: 1; transform: none;">
                            @php
                                $relImageUrl = 'https://images.unsplash.com/photo-1631452180519-c014fe946bc7?auto=format&fit=crop&w=900&q=85';
                                if ($relRecipe->featured_image) {
                                    $relImageUrl = asset('storage/' . $relRecipe->featured_image);
                                }
                            @endphp
                            <div class="recipe-image">
                                <img src="{{ $relImageUrl }}" alt="{{ $relRecipe->title }}" loading="lazy" style="height: 250px; width: 100%; object-fit: cover; border-radius: var(--radius-xl);">
                                <span class="recipe-badge" style="position: absolute; top: 1rem; left: 1rem; background: var(--surface); padding: 4px 12px; border-radius: 20px; font-weight: 600;">{{ $relRecipe->category }}</span>
                            </div>
                            <div class="recipe-card-body mt-3">
                                <h3><a href="{{ route('recipe_details', $relRecipe->slug) }}" class="text-decoration-none text-dark">{{ $relRecipe->title }}</a></h3>
                                <p class="text-muted">{{ Str::limit($relRecipe->short_description ?? strip_tags($relRecipe->description), 80) }}</p>
                                <div class="recipe-meta d-flex justify-content-between text-muted">
                                    <span><i class="bi bi-clock"></i> {{ $relRecipe->duration }}</span>
                                </div>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>
        </section>
        @endif
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carouselElement = document.querySelector("#productGalleryCarousel");
        const mainImage = document.querySelector("#detailsMainImage");
        let activeSlide = 0;
        let lastTap = 0;

        function updateThumbs(index) {
            activeSlide = index;
            document.querySelectorAll("[data-gallery-thumb]").forEach((button) => {
                button.classList.toggle("active", Number(button.dataset.galleryThumb) === index);
            });
            mainImage?.classList.remove("is-zoomed");
        }

        const carousel = window.bootstrap?.Carousel.getOrCreateInstance(carouselElement, { interval: false, touch: true, ride: false });
        
        carouselElement?.addEventListener("slide.bs.carousel", (event) => updateThumbs(event.to));
        
        document.querySelectorAll("[data-gallery-thumb]").forEach((button) => {
            button.addEventListener("click", () => {
                const index = Number(button.dataset.galleryThumb);
                updateThumbs(index);
                carousel?.to(index);
            });
        });

        // Zoom logic
        mainImage?.addEventListener("mousemove", (event) => {
            if (!window.matchMedia("(min-width: 992px)").matches) return;
            const activeImage = mainImage.querySelector(".carousel-item.active img");
            if (!activeImage) return;
            const rect = mainImage.getBoundingClientRect();
            activeImage.style.transformOrigin = `${((event.clientX - rect.left) / rect.width) * 100}% ${((event.clientY - rect.top) / rect.height) * 100}%`;
        });
        
        mainImage?.addEventListener("mouseenter", () => {
            if (window.matchMedia("(min-width: 992px)").matches) mainImage.classList.add("is-zoomed");
        });
        
        mainImage?.addEventListener("mouseleave", () => mainImage.classList.remove("is-zoomed"));
        
        mainImage?.addEventListener("click", () => {
            if (window.matchMedia("(min-width: 992px)").matches) return;
            const now = Date.now();
            if (now - lastTap < 320 || window.matchMedia("(min-width: 768px)").matches) mainImage.classList.toggle("is-zoomed");
            lastTap = now;
        });
    });
</script>
@endpush
@endsection
