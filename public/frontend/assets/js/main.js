(function () {
  window.updateCartCount = function(count) {
    document.querySelectorAll(".cart-count-badge").forEach((node) => node.textContent = String(count));
  };
  window.updateWishlistCount = function(count) {
    document.querySelectorAll(".wishlist-count-badge").forEach((node) => node.textContent = String(count));
  };
  window.showToast = function(text) {
    const cartToast = document.querySelector("#cartToast");
    if (cartToast) {
      cartToast.querySelector("span").textContent = text;
      window.bootstrap?.Toast.getOrCreateInstance(cartToast).show();
    }
  };

  window.handleCommerceClick = function(event) {
      const wish = event.target.closest("[data-wishlist]");
      const add = event.target.closest("[data-add-cart]");
      const plus = event.target.closest("[data-qty-plus]");
      const minus = event.target.closest("[data-qty-minus]");
      if (wish) {
        const btn = wish;
        fetch('/api/wishlist/toggle', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({ product_id: wish.dataset.wishlist })
        })
        .then(res => res.json())
        .then(data => {
            if(data.status === 'success') {
                window.updateWishlistCount(data.count);
                document.querySelectorAll(`[data-wishlist="${wish.dataset.wishlist}"]`).forEach((item) => item.classList.toggle("wishlist-active", data.action === 'added'));
            }
        });
      }
      if (add) {
        const btn = add;
        const originalText = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        btn.disabled = true;

        let qty = 1;
        const qtySpan = add.closest(".catalog-card, .quick-view-content, .product-details-page")?.querySelector(".qty-control span");
        if (qtySpan) {
            qty = Number(qtySpan.textContent) || 1;
        } else {
            const qtyInput = add.closest("tr, .product-item")?.querySelector("input.qty-input");
            if (qtyInput) qty = Number(qtyInput.value) || 1;
        }

        fetch('/api/cart/add', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
            },
            body: JSON.stringify({ product_id: add.dataset.addCart, quantity: qty })
        })
        .then(res => res.json())
        .then(data => {
            btn.innerHTML = originalText;
            btn.disabled = false;
            if(data.status === 'success') {
                window.updateCartCount(data.count);
                window.showToast("Product added to cart.");
            }
        })
        .catch(err => {
            btn.innerHTML = originalText;
            btn.disabled = false;
        });
      }
      if (plus || minus) {
        const control = (plus || minus).closest(".qty-control");
        if (control) {
            const value = control.querySelector("span");
            if (value) {
                value.textContent = String(plus ? Number(value.textContent) + 1 : Math.max(1, Number(value.textContent) - 1));
            }
        }
      }
  };
  document.addEventListener("click", window.handleCommerceClick);

  const header = document.querySelector("#siteHeader");
  const backTop = document.querySelector(".back-top");
  const loader = document.querySelector(".page-loader");
  const searchPopup = document.querySelector("#searchPopup");
  const searchInput = document.querySelector("#desktopSearchInput");

  function onScroll() {
    const active = window.scrollY > 80;
    header?.classList.toggle("scrolled", active);
    backTop?.classList.toggle("show", window.scrollY > 600);
  }

  window.addEventListener("scroll", onScroll, { passive: true });
  window.addEventListener("load", () => {
    loader?.classList.add("loaded");
    onScroll();
  });

  backTop?.addEventListener("click", () => window.scrollTo({ top: 0, behavior: "smooth" }));

  function openSearch() {
    if (!searchPopup) return;
    searchPopup.classList.add("active");
    searchPopup.setAttribute("aria-hidden", "false");
    document.body.classList.add("search-lock");
    window.setTimeout(() => searchInput?.focus(), 120);
  }

  function closeSearch() {
    if (!searchPopup) return;
    searchPopup.classList.remove("active");
    searchPopup.setAttribute("aria-hidden", "true");
    document.body.classList.remove("search-lock");
  }

  document.querySelectorAll(".search-open").forEach((button) => {
    button.addEventListener("click", openSearch);
  });

  document.querySelectorAll("[data-search-close]").forEach((item) => {
    item.addEventListener("click", closeSearch);
  });

  document.addEventListener("keydown", (event) => {
    if (event.key === "Escape" && searchPopup?.classList.contains("active")) closeSearch();
  });

  searchPopup?.querySelector(".search-form")?.addEventListener("submit", (event) => {
    event.preventDefault();
  });

  const form = document.querySelector("#newsletterForm");
  form?.addEventListener("submit", (event) => {
    event.preventDefault();
    const email = form.querySelector("input[type='email']");
    const message = form.querySelector(".form-message");
    if (!email.checkValidity()) {
      message.textContent = "Please enter a valid email address.";
      message.style.color = "var(--danger)";
      email.focus();
      return;
    }
    message.textContent = "Thank you. Your welcome offer is on its way.";
    message.style.color = "var(--success)";
    form.reset();
  });

  const contactForm = document.querySelector("#contactForm");
  // contactForm?.addEventListener("submit", (event) => {
  //   event.preventDefault();
  //   const message = contactForm.querySelector(".contact-form-message");
  //   if (!contactForm.checkValidity()) {
  //     message.innerHTML = '<i class="bi bi-exclamation-circle"></i> Please complete the required fields correctly.';
  //     message.style.color = "var(--danger)";
  //     contactForm.reportValidity();
  //     return;
  //   }
  //   message.innerHTML = '<i class="bi bi-check-circle"></i> Thank you. Our team will contact you within 24 hours.';
  //   message.style.color = "var(--success)";
  //   contactForm.reset();
  // });




  document.querySelectorAll("[data-product-category]").forEach((button) => {
    button.addEventListener("click", () => {
      document.querySelectorAll("[data-product-category]").forEach((item) => item.classList.remove("active"));
      button.classList.add("active");
    });
  });

  function svaadvikaCatalogProducts() {
    return [].map((item, index) => ({ id: item[0], category: item[1], title: item[2], description: item[3], rating: item[4], reviews: item[5], price: item[6], oldPrice: item[7], discount: item[8], stock: true, newest: index }));
  }

  function catalogStars(rating) {
    return Array.from({ length: 5 }, (_, index) => `<i class="bi bi-star${rating >= index + 1 ? "-fill" : rating > index ? "-half" : ""}"></i>`).join("");
  }

  function catalogLabel(category) {
    return category.split("-").map((part) => part[0].toUpperCase() + part.slice(1)).join(" ");
  }

  function slugFromTitle(title) {
    const aliases = {
      "tandoori-chicken-marinade": "tandoori-marinade"
    };
    const slug = title.toLowerCase().replace(/[^a-z0-9]+/g, "-").replace(/(^-|-$)/g, "");
    return aliases[slug] || slug;
  }

  const quickBody = document.querySelector("#quickViewBody");
  const cartToast = document.querySelector("#cartToast");
  function rupee(value) { return `₹${value}`; }
  function labelFor(category) { return category.split("-").map((part) => part[0].toUpperCase() + part.slice(1)).join(" "); }
  function stars(rating) { return Array.from({ length: 5 }, (_, index) => `<i class="bi bi-star${rating >= index + 1 ? "-fill" : rating > index ? "-half" : ""}"></i>`).join(""); }
  function quickView(product) {
    if (!quickBody) return;

    let carouselHtml = '';
    let indicatorsHtml = '';
    if (product.images && product.images.length > 0) {
      carouselHtml = product.images.map((img, idx) => `
          <div class="carousel-item ${idx === 0 ? 'active' : ''}">
            <div class="quick-view-image" style="background-image: url('${img.src}'); background-size: cover; background-position: center; border-radius: 1rem; height: 100%;"></div>
          </div>
        `).join('');
      indicatorsHtml = product.images.length > 1 ? product.images.map((img, idx) => `
          <button type="button" data-bs-target="#quickViewCarousel-${product.id}" data-bs-slide-to="${idx}" class="${idx === 0 ? 'active' : ''}" aria-current="true" aria-label="Slide ${idx + 1}"></button>
        `).join('') : '';
    } else {
      carouselHtml = `
          <div class="carousel-item active">
            <div class="quick-view-image" style="background-image: url('${product.image}'); background-size: cover; background-position: center; border-radius: 1rem; height: 100%;"></div>
          </div>
        `;
    }

    quickBody.innerHTML = `
        <div class="quick-view-layout">
          <div id="quickViewCarousel-${product.id}" class="carousel slide h-100" data-bs-ride="carousel">
            <div class="carousel-indicators">
              ${indicatorsHtml}
            </div>
            <div class="carousel-inner h-100">
              ${carouselHtml}
            </div>
            ${product.images && product.images.length > 1 ? `
            <button class="carousel-control-prev" type="button" data-bs-target="#quickViewCarousel-${product.id}" data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#quickViewCarousel-${product.id}" data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
            ` : ''}
          </div>
          <div class="quick-view-content">
            <p class="eyebrow">${labelFor(product.category)}</p>
            <h2 id="quickViewTitle">${product.title}</h2>
            <div class="catalog-rating">${stars(product.rating)}<small>(${product.reviews} reviews)</small></div>
            <div class="price-line"><strong>${rupee(product.price)}</strong><del>${rupee(product.oldPrice)}</del><span>${product.discount}</span></div>
            <p>${product.description}</p>
            <ul><li>Ingredients: ${product.ingredients}</li><li>Weight: ${product.weight}</li><li>Status: ${product.stock ? "In stock" : "Out of Stock"}</li></ul>
            <div class="quick-view-actions">
               <button class="icon-btn wishlist-active-state d-none" type="button" data-wishlist="${product.id}" aria-label="Toggle ${product.title} wishlist"><i class="bi bi-heart"></i></button>
              <div class="catalog-actions"><div class="qty-control"><button type="button" data-qty-minus>-</button><span>1</span><button type="button" data-qty-plus>+</button></div><button class="add-cart" type="button" data-add-cart="${product.id}">Add To Cart</button></div>
            </div>
          </div>
        </div>`;
    window.bootstrap?.Modal.getOrCreateInstance(document.querySelector("#quickViewModal")).show();
    if (product.images && product.images.length > 1) {
      new window.bootstrap.Carousel(document.getElementById(`quickViewCarousel-${product.id}`));
    }
  }
  window.openQuickViewModal = quickView;

  const newProductPage = document.querySelector("[data-new-product-page]");
  if (newProductPage) {
    const products = window.SvaadvikaProducts || [];
    const grid = document.querySelector("#newProductGrid");
    const pagination = document.querySelector("#newProductPagination");
    const countText = document.querySelector("#productCountText");
    const searchField = document.querySelector("#productLiveSearch");
    const priceRange = document.querySelector("#productPriceRange");
    const priceValue = document.querySelector("#priceRangeValue");
    const ratingFilter = document.querySelector("#productRatingFilter");
    const sortSelect = document.querySelector("#productSortSelect");
    const noProducts = document.querySelector("#noProductsFound");

    const perPage = 12;


    let state = { category: "all", search: "", price: 600, rating: 0, sort: "best-selling", page: 1 };

    function rupee(value) { return `₹${value}`; }
    function labelFor(category) { return category.split("-").map((part) => part[0].toUpperCase() + part.slice(1)).join(" "); }
    function stars(rating) {
      return Array.from({ length: 5 }, (_, index) => `<i class="bi bi-star${rating >= index + 1 ? "-fill" : rating > index ? "-half" : ""}"></i>`).join("");
    }
    function highlight(text) {
      if (!state.search) return text;
      return text.replace(new RegExp(`(${state.search.replace(/[.*+?^${}()|[\]\\]/g, "\\$&")})`, "ig"), "<mark>$1</mark>");
    }
    function filteredProducts() {
      const query = state.search.toLowerCase();
      const sorted = products.filter((product) => {
        const haystack = `${product.title} ${product.category} ${product.description}`.toLowerCase();
        return (state.category === "all" || product.category === state.category)
          && (!query || haystack.includes(query))
          && product.price <= state.price
          && product.rating >= state.rating;
      });
      sorted.sort((a, b) => {
        if (state.sort === "price-low") return a.price - b.price;
        if (state.sort === "price-high") return b.price - a.price;
        if (state.sort === "az") return a.title.localeCompare(b.title);
        if (state.sort === "za") return b.title.localeCompare(a.title);
        if (state.sort === "highest-rating") return b.rating - a.rating;
        if (state.sort === "most-reviewed") return b.reviews - a.reviews;
        if (state.sort === "newest") return b.newest - a.newest;
        return (b.reviews + b.rating * 20) - (a.reviews + a.rating * 20);
      });
      return sorted;
    }
    function updateUrl(replace = false) {
      const params = new URLSearchParams();
      if (state.category !== "all") params.set("category", state.category);
      if (state.search) params.set("search", state.search);
      if (state.price < 600) params.set("price", `100-${state.price}`);
      if (state.rating) params.set("rating", state.rating);
      if (state.sort !== "best-selling") params.set("sort", state.sort);
      if (state.page > 1) params.set("page", state.page);
      history[replace ? "replaceState" : "pushState"](state, "", `${location.pathname}${params.toString() ? `?${params}` : ""}`);
    }
    function readUrl() {
      const params = new URLSearchParams(location.search);
      state = {
        category: params.get("category") || "all",
        search: params.get("search") || "",
        price: Number((params.get("price") || "100-600").split("-")[1] || 600),
        rating: Number(params.get("rating") || 0),
        sort: params.get("sort") || "best-selling",
        page: Number(params.get("page") || 1)
      };
      searchField.value = state.search;
      priceRange.value = state.price;
      priceValue.textContent = rupee(state.price);
      ratingFilter.value = String(state.rating);
      sortSelect.value = state.sort;
      document.querySelectorAll("[data-filter-category]").forEach((button) => button.classList.toggle("active", button.dataset.filterCategory === state.category));
    }
    function productCard(product) {
      return `
        <article class="catalog-card reveal-up is-visible" data-product-id="${product.id}">
          <div class="catalog-image" style="background-image: url('${product.image}'); background-size: cover; background-position: center;">
            <a href="/product/${product.id}" style="position: absolute; inset: 0; z-index: 1;" aria-label="View ${product.title} details"></a>
            ${product.oldPrice > product.price ? '<span>Sale</span>' : ''}
            <button class="wishlist-icon wishlist-active-state d-none" type="button" data-wishlist="${product.id}" aria-label="Toggle ${product.title} wishlist"><i class="bi bi-heart"></i></button>
            <button class="quick-view-icon" type="button" data-quick-view="${product.id}" aria-label="Quick View ${product.title}"><i class="bi bi-eye"></i></button>
          </div>
          <div class="catalog-body">
            <div class="catalog-meta"><span class="catalog-category">${labelFor(product.category)}</span><span class="stock-pill">${product.stock ? "In Stock" : "Out of Stock"}</span></div>
            <h3><a href="/product/${product.id}">${highlight(product.title)}</a></h3>
            <div class="catalog-rating">${stars(product.rating)}<small>(${product.reviews})</small></div>
            <p>${highlight(product.description)}</p>
            <div class="price-line"><strong>${rupee(product.price)}</strong><del>${rupee(product.oldPrice)}</del><span>${product.discount} Off</span></div>
            <div class="catalog-actions">
              <div class="qty-control"><button type="button" data-qty-minus>-</button><span>1</span><button type="button" data-qty-plus>+</button></div>
              <button class="add-cart" type="button" data-add-cart="${product.id}">Add To Cart</button>
            </div>
          </div>
        </article>`;
    }
    function render() {
      grid.classList.add("is-filtering");
      window.setTimeout(() => {
        const list = filteredProducts();
        const totalPages = Math.max(1, Math.ceil(list.length / perPage));
        state.page = Math.min(state.page, totalPages);
        const start = (state.page - 1) * perPage;
        const visible = list.slice(start, start + perPage);
        grid.innerHTML = visible.map(productCard).join("");
        if (noProducts) noProducts.hidden = list.length !== 0;
        if (countText) countText.textContent = `Showing ${visible.length} of ${list.length} Products`;
        if (pagination) pagination.innerHTML = list.length ? paginationMarkup(totalPages) : "";
        grid.classList.remove("is-filtering");
      }, 120);
    }
    function paginationMarkup(totalPages) {
      const pages = Array.from({ length: totalPages }, (_, index) => index + 1);
      return `<button type="button" data-page="${Math.max(1, state.page - 1)}" aria-label="Previous page"><i class="bi bi-chevron-left"></i></button>${pages.map((page) => `<button type="button" class="${page === state.page ? "active" : ""}" data-page="${page}">${page}</button>`).join("")}<button type="button" data-page="${Math.min(totalPages, state.page + 1)}" aria-label="Next page"><i class="bi bi-chevron-right"></i></button>`;
    }




    newProductPage.addEventListener("click", (event) => {
      const category = event.target.closest("[data-filter-category]");
      const page = event.target.closest("[data-page]");
      const quick = event.target.closest("[data-quick-view]");
      if (category) { state.category = category.dataset.filterCategory; state.page = 1; readControls(false); updateUrl(); render(); }
      if (page) { state.page = Number(page.dataset.page); updateUrl(); render(); }
      if (quick) quickView(products.find((product) => product.id === quick.dataset.quickView));
    });
    function readControls(resetPage = true) {
      state.search = searchField.value.trim();
      state.price = Number(priceRange.value);
      state.rating = Number(ratingFilter.value);
      state.sort = sortSelect.value;
      if (resetPage) state.page = 1;
      priceValue.textContent = rupee(state.price);
      document.querySelectorAll("[data-filter-category]").forEach((button) => button.classList.toggle("active", button.dataset.filterCategory === state.category));
    }
    [searchField, priceRange, ratingFilter, sortSelect].forEach((control) => {
      control.addEventListener("input", () => { readControls(); updateUrl(); render(); });
      control.addEventListener("change", () => { readControls(); updateUrl(); render(); });
    });
    window.addEventListener("popstate", () => { readUrl(); render(); });
    readUrl();
    updateUrl(true);
    render();
  }

  document.addEventListener("click", (event) => {
    const card = event.target.closest(".catalog-card");
    const quickBtn = event.target.closest("[data-quick-view]");

    if (quickBtn) {
      const id = quickBtn.dataset.quickView;
      let p = window.SvaadvikaRelatedProducts?.find(x => String(x.id) === String(id));
      if (!p) p = window.SvaadvikaProducts?.find(x => String(x.id) === String(id) || String(x.slug) === String(id));
      if (!p) p = svaadvikaCatalogProducts().find(x => String(x.id) === String(id));
      if (p) {
        // Need to dispatch a custom event or call a global function
        window.openQuickViewModal(p);
      }
      return;
    }

    if (!card) return;
    if (event.target.closest("button, .qty-control, .add-cart, [data-wishlist], [data-quick-view]")) return;
    const productId = card.dataset.productId || slugFromTitle(card.querySelector("h3")?.textContent || "");
    if (productId) {
      window.location.href = `/product/${encodeURIComponent(productId)}`;
    }
  });

  const detailsPage = document.querySelector("[data-product-details-page]");
  if (detailsPage) {
    const product = window.SvaadvikaProduct || {};
    const relatedProducts = window.SvaadvikaRelatedProducts || [];
    const cartToast = document.querySelector("#cartToast");
    const carouselElement = document.querySelector("#productGalleryCarousel");
    const modalCarouselElement = document.querySelector("#galleryModalCarousel");
    const mainImage = document.querySelector("#detailsMainImage");
    const modalGallery = document.querySelector("#galleryModal");
    const thumbs = document.querySelector("#detailsThumbs");
    const modalThumbs = document.querySelector("#modalThumbs");


    let activeSlide = 0;
    let lastTap = 0;

    function rupee(value) { return `\u20B9${value}`; }
    function setText(selector, value) {
      const node = document.querySelector(selector);
      if (node) node.textContent = value;
    }
    function renderBreadcrumb(item) {
      const breadcrumb = document.querySelector("#detailsBreadcrumb");
      if (!breadcrumb) return;
      const categoryLabel = catalogLabel(item.category);
      breadcrumb.innerHTML = `
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="/products">Products</a></li>
        <li class="breadcrumb-item"><a href="/products?category=${encodeURIComponent(item.category)}">${categoryLabel}</a></li>
        <li class="breadcrumb-item active" aria-current="page">${item.title}</li>`;
    }
    function galleryImages(item) {
      return item.images || [{ src: item.image, label: 'Hero image', alt: item.title }];
    }
    function renderCarousel(container, images) {
      container.innerHTML = images.map((image, index) => `
        <div class="carousel-item${index === activeSlide ? " active" : ""}">
          <img src="${image.src}" alt="${image.alt}" loading="lazy" draggable="false">
        </div>`).join("");
    }
    function renderThumbs(container, images, target) {
      container.innerHTML = images.map((image, index) => `
        <button class="${index === activeSlide ? "active" : ""}" type="button" data-gallery-thumb="${index}" data-gallery-target="${target}" aria-label="${image.label}">
          <img src="${image.src}" alt="${image.alt}" loading="lazy">
        </button>`).join("");
    }
    function updateThumbs(index) {
      activeSlide = index;
      document.querySelectorAll("[data-gallery-thumb]").forEach((button) => {
        button.classList.toggle("active", Number(button.dataset.galleryThumb) === index);
      });
      mainImage?.classList.remove("is-zoomed");
      modalCarouselElement?.classList.remove("is-zoomed");
    }

    function addCurrentProduct(btn) {
      if (btn) {
        btn.dataset.originalText = btn.innerHTML;
        btn.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...';
        btn.disabled = true;
      }
      const qty = Number(detailsPage.querySelector(".details-actions .qty-control span")?.textContent || 1);
      fetch('/api/cart/add', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json',
          'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content')
        },
        body: JSON.stringify({ product_id: product.id, quantity: qty })
      })
        .then(res => res.json())
        .then(data => {
          if (btn) {
            btn.innerHTML = btn.dataset.originalText;
            btn.disabled = false;
          }
          if (data.status === 'success') {
            window.updateCartCount(data.count);
            window.showToast(`${product.title} added to cart.`);
          }
        })
        .catch(err => {
          if (btn) {
            btn.innerHTML = btn.dataset.originalText;
            btn.disabled = false;
          }
        });
    }

    const images = galleryImages(product);
    // document.title = `${product.title} | Svaadvika`; // Blade handles this
    // Blade handles rendering the breadcrumbs, title, description, and pricing

    const carousel = window.bootstrap?.Carousel.getOrCreateInstance(carouselElement, { interval: false, touch: true, ride: false });
    const modalCarousel = window.bootstrap?.Carousel.getOrCreateInstance(modalCarouselElement, { interval: false, touch: true, ride: false });
    carouselElement?.addEventListener("slide.bs.carousel", (event) => updateThumbs(event.to));
    modalCarouselElement?.addEventListener("slide.bs.carousel", (event) => {
      updateThumbs(event.to);
      carousel?.to(event.to);
    });
    document.querySelectorAll("[data-gallery-thumb]").forEach((button) => {
      button.addEventListener("click", () => {
        const index = Number(button.dataset.galleryThumb);
        updateThumbs(index);
        carousel?.to(index);
        modalCarousel?.to(index);
      });
    });
    document.querySelector("[data-gallery-fullscreen]")?.addEventListener("click", () => {
      modalCarousel?.to(activeSlide);
      window.bootstrap?.Modal.getOrCreateInstance(modalGallery).show();
    });
    document.querySelector("[data-gallery-zoom]")?.addEventListener("click", () => {
      modalCarouselElement?.classList.toggle("is-zoomed");
    });
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

    document.addEventListener("keydown", (event) => {
      if (!detailsPage) return;
      if (event.key === "ArrowLeft") carousel?.prev();
      if (event.key === "ArrowRight") carousel?.next();
    });
    document.querySelector(".mobile-detail-bar")?.addEventListener("click", (event) => {
      const target = event.target.closest("[data-details-add-cart], [data-details-buy]");
      if (target) addCurrentProduct(target);
    });

    detailsPage.addEventListener("click", (event) => {
      const target = event.target.closest("[data-details-add-cart], [data-details-buy]");
      if (target) {
          addCurrentProduct(target);
          if (target.hasAttribute("data-details-buy")) {
              window.showToast("Ready for checkout.");
          }
      }
    });

    const relatedGrid = document.querySelector("#detailsRelatedGrid");
    if (relatedGrid && relatedProducts.length === 0) {
      // If JS related products array is empty, keep existing HTML from blade
    } else if (relatedGrid) {
      relatedGrid.innerHTML = relatedProducts.slice(0, 4).map((item) => {
        return `
        <article class="catalog-card reveal-up is-visible" data-product-id="${item.id}">
          <div class="catalog-image" style="background-image: url('${item.image}'); background-size: cover; background-position: center;">
            <a href="/product/${item.id}" style="position: absolute; inset: 0; z-index: 1;" aria-label="View ${item.title} details"></a>
            ${item.oldPrice > item.price ? '<span>Sale</span>' : ''}
            <button class="wishlist-icon wishlist-active-state  d-none" type="button" data-wishlist="${item.id}" aria-label="Toggle ${item.title} wishlist"><i class="bi bi-heart"></i></button>
            <button class="quick-view-icon" type="button" data-quick-view="${item.id}" aria-label="Quick View ${item.title}"><i class="bi bi-eye"></i></button>
          </div>
          <div class="catalog-body">
            <div class="catalog-meta"><span class="catalog-category">${labelFor(item.category)}</span><span class="stock-pill">${item.stock ? "In Stock" : "Out of Stock"}</span></div>
            <h3><a href="/product/${item.id}">${item.title}</a></h3>
            <div class="catalog-rating">${stars(item.rating)}<small>(${item.reviews})</small></div>
            <p>${item.description}</p>
            <div class="price-line"><strong>${rupee(item.price)}</strong><del>${rupee(item.oldPrice)}</del><span>${item.discount} Off</span></div>
            <div class="catalog-actions">
              <div class="qty-control"><button type="button" data-qty-minus>-</button><span>1</span><button type="button" data-qty-plus>+</button></div>
              <button class="add-cart" type="button" data-add-cart="${item.id}">Add To Cart</button>
            </div>
          </div>
        </article>`;
      }).join("");
    }
  }

  const recipesPage = document.querySelector("[data-recipes-page]");
  if (recipesPage) {
  }

  const hero = document.querySelector(".hero-visual");
  if (hero && window.matchMedia("(min-width: 992px)").matches) {
    hero.addEventListener("mousemove", (event) => {
      const rect = hero.getBoundingClientRect();
      const x = (event.clientX - rect.left - rect.width / 2) / rect.width;
      const y = (event.clientY - rect.top - rect.height / 2) / rect.height;
      hero.style.transform = `translate(${x * 10}px, ${y * 10}px)`;
    });
    hero.addEventListener("mouseleave", () => {
      hero.style.transform = "translate(0, 0)";
    });
  }
})();

// Custom
document.querySelectorAll('.faq-item h4').forEach(item => {
  item.addEventListener('click', function () {

    const faq = this.parentElement;
    faq.classList.toggle('active');

    const icon = this.querySelector('i');

    if (faq.classList.contains('active')) {
      icon.classList.remove('bi-plus-lg');
      icon.classList.add('bi-dash-lg');
    } else {
      icon.classList.remove('bi-dash-lg');
      icon.classList.add('bi-plus-lg');
    }

  });
});

/*=========================================
Shopping Cart Script
=========================================*/

document.addEventListener("DOMContentLoaded", function () {

  // Quantity Buttons
  const qtyBoxes = document.querySelectorAll(".qty-box");

  qtyBoxes.forEach((box) => {

    const minus = box.querySelector(".minus");
    const plus = box.querySelector(".plus");
    const input = box.querySelector("input");

    plus.addEventListener("click", function () {

      let value = parseInt(input.value);
      value++;
      input.value = value;

      updateCart();

    });

    minus.addEventListener("click", function () {

      let value = parseInt(input.value);

      if (value > 1) {
        value--;
        input.value = value;

        updateCart();
      }

    });

  });

  // Remove Product
  const removeBtns = document.querySelectorAll(".remove-btn");

  removeBtns.forEach((btn) => {

    btn.addEventListener("click", function () {

      if (confirm("Remove this product from cart?")) {

        this.closest("tr").remove();

        updateCart();

      }

    });

  });

  // Checkout Button
  const checkoutBtn = document.querySelector(".checkout-btn");

  checkoutBtn?.addEventListener("click", function () {

    alert("Proceeding to Checkout...");

  });

});


/*=========================================
    Update Cart Summary
=========================================*/

function updateCart() {
  let subtotal = 0;
  let tax = 0;
  const rows = document.querySelectorAll(".order-page-cart tbody tr");
  if (rows.length === 0) return;

  rows.forEach((row) => {

    const qty = parseInt(row.querySelector("input").value);

    const priceText = row.children[2].innerText
      .replace(/₹/g, "")
      .replace(/,/g, "")
      .trim();

    const taxText = row.children[3].innerText
      .split(" ")[0]
      .replace(/₹/g, "")
      .replace(/,/g, "")
      .trim();

    const price = parseFloat(priceText) || 0;
    const taxAmount = parseFloat(taxText) || 0;

    const total = price * qty;

    row.children[5].innerHTML =
      "<strong>₹" + formatNumber(total) + "</strong>";

    subtotal += total;
    tax += taxAmount * qty;

  });

  const grandTotal = subtotal + tax;

  const summary = document.querySelectorAll(".summary-item");

  if (summary.length >= 3) {

    summary[0].children[1].innerHTML =
      "₹" + formatNumber(subtotal);

    summary[1].children[1].innerHTML =
      "₹" + formatNumber(tax);

    summary[2].children[1].innerHTML =
      "₹" + formatNumber(grandTotal);

  }

}


/*=========================================
    Indian Currency Format
=========================================*/

function formatNumber(number) {

  return number.toLocaleString("en-IN");

}


/*=========================================
    Continue Shopping
=========================================*/

const continueBtn = document.querySelector(".continue-btn");

if (continueBtn) {

  continueBtn.addEventListener("click", function (e) {

    e.preventDefault();

    window.history.back();

  });

}


/*=========================================
    Smooth Hover Animation
=========================================*/

const rows = document.querySelectorAll("tbody tr");

rows.forEach((row) => {

  row.addEventListener("mouseenter", function () {

    this.style.transition = "0.3s";

  });

});


/*=========================================
    Initial Load
=========================================*/

updateCart();




