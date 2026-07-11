@extends('frontend.layouts.master')

@section('content')
<section class="recipes-hero">
        <div class="container-xl">
          <div class="recipes-hero-copy reveal-up">
            <nav class="details-breadcrumb recipes-breadcrumb" aria-label="breadcrumb">
              <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
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
              <div class="recipe-filter-head"><h2>Filter Recipes</h2><i class="bi bi-sliders"></i></div>
              <div id="recipeFilters"></div>
              <div class="recipe-filter-actions"><button class="btn btn-green" type="button" data-recipe-apply>Apply Filters</button><button class="clear-filter" type="button" data-recipe-clear>Clear All <i class="bi bi-arrow-counterclockwise"></i></button></div>
            </aside>

            <div class="recipe-results">
              <div class="recipes-toolbar reveal-up">
                <div><h2>All Recipes <span id="recipeCount">(24)</span></h2></div>
                <div class="recipe-search-sort">
                  <label class="recipe-search"><i class="bi bi-search"></i><input id="recipeSearch" type="search" placeholder="Search recipes..." aria-label="Search recipes"></label>
                  <select id="recipeSort" aria-label="Sort recipes">
                    <option value="latest">Sort by: Latest</option>
                    <option value="popular">Popular</option>
                    <option value="time">Cooking Time</option>
                    <option value="rated">Highest Rated</option>
                    <option value="az">Alphabetical</option>
                    <option value="newest">Newest</option>
                  </select>
                </div>
              </div>
              <div class="recipe-grid" id="recipeGrid" aria-live="polite"></div>
              <div class="no-products-found" id="noRecipesFound" hidden><i class="bi bi-search-heart"></i><h3>No Recipes Found</h3><p>Try changing your filters or search.</p></div>
              <nav class="catalog-pagination recipe-pagination" id="recipePagination" aria-label="Recipe pagination"></nav>
            </div>
          </div>

          <section class="recipe-newsletter reveal-up">
            <div class="recipe-news-icon"><i class="bi bi-envelope"></i></div>
            <div><h2>Stay Updated with Delicious Recipes!</h2><p>Subscribe to our newsletter for new recipes, cooking tips and exclusive updates.</p></div>
            <form id="recipeNewsletter" class="needs-validation" novalidate><label class="visually-hidden" for="recipeNewsletterEmail">Email address</label><input id="recipeNewsletterEmail" type="email" placeholder="Enter your email address" required><button type="submit">Subscribe</button><div class="invalid-feedback">Please enter a valid email.</div></form>
          </section>
        </div>
      </section>
@endsection