    <div class="search-popup" id="searchPopup" aria-hidden="true">
      <div class="search-backdrop" data-search-close></div>
      <div class="search-dialog" role="dialog" aria-modal="true" aria-labelledby="searchTitle">
        <button class="icon-btn search-close" type="button" aria-label="Close search" data-search-close><i class="bi bi-x-lg"></i></button>
        <p class="eyebrow">Search Svaadvika</p>
        <h2 id="searchTitle">Find Your Favourite Flavour</h2>
        <form class="search-form" role="search" action="{{ url('/') }}">
          <label class="visually-hidden" for="desktopSearchInput">Search products and recipes</label>
          <i class="bi bi-search"></i>
          <input id="desktopSearchInput" name="q" type="search" placeholder="Search biryani kits, recipes, marinades..." autocomplete="off">
          <button class="btn btn-gold" type="submit">Search <i class="bi bi-arrow-right"></i></button>
        </form>
      </div>
    </div>
