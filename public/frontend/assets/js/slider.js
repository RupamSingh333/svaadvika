(function () {

    const slider = document.querySelector(".product-slider");

    if (!slider) return;

    const prev = document.querySelector(".slider-nav.prev");
    const next = document.querySelector(".slider-nav.next");

    let autoPlay;

    // Cards Per View
    function cardsPerView() {

        const width = window.innerWidth;

        if (width >= 992) {
            return 4; // Desktop
        }

        if (width >= 768) {
            return 2; // Tablet
        }

        return 1; // Mobile
    }

    // Card Width Set
    function updateCardWidth() {

        const cards = slider.querySelectorAll(".product-card");

        if (!cards.length) return;

        const gap = parseInt(getComputedStyle(slider).gap) || 30;

        const perView = cardsPerView();

        const cardWidth = (slider.clientWidth - ((perView - 1) * gap)) / perView;

        cards.forEach(card => {

            card.style.flex = `0 0 ${cardWidth}px`;
            card.style.maxWidth = `${cardWidth}px`;
            card.style.minWidth = `${cardWidth}px`;

        });

    }

    function getScrollAmount() {

        const card = slider.querySelector(".product-card");

        if (!card) return 300;

        const gap = parseInt(getComputedStyle(slider).gap) || 30;

        return card.offsetWidth + gap;

    }

    function scrollCard(direction) {

        slider.scrollBy({
            left: getScrollAmount() * direction,
            behavior: "smooth"
        });

    }

    prev.addEventListener("click", function () {

        scrollCard(-1);

    });

    next.addEventListener("click", function () {

        scrollCard(1);

    });

    // Keyboard Support
    slider.addEventListener("keydown", function (e) {

        if (e.key === "ArrowRight") {
            scrollCard(1);
        }

        if (e.key === "ArrowLeft") {
            scrollCard(-1);
        }

    });

    // Auto Slide
    function startAuto() {

        stopAuto();

        autoPlay = setInterval(function () {

            const end = slider.scrollLeft + slider.clientWidth >= slider.scrollWidth - 5;

            if (end) {

                slider.scrollTo({
                    left: 0,
                    behavior: "smooth"
                });

            } else {

                scrollCard(1);

            }

        }, 4000);

    }

    function stopAuto() {

        clearInterval(autoPlay);

    }

    // Pause on Hover
    slider.addEventListener("mouseenter", stopAuto);
    slider.addEventListener("mouseleave", startAuto);

    // Touch Devices
    slider.addEventListener("touchstart", stopAuto, {
        passive: true
    });

    slider.addEventListener("touchend", startAuto);

    // Resize
    window.addEventListener("resize", function () {

        updateCardWidth();

    });

    // Init
    updateCardWidth();
    startAuto();

})();