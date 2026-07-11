(function () {
  document.querySelectorAll(".mobile-offcanvas a[href^='#']").forEach((link) => {
    link.addEventListener("click", () => {
      const panel = document.querySelector("#mobileMenu");
      const instance = window.bootstrap?.Offcanvas.getInstance(panel);
      instance?.hide();
    });
  });

  const bottomLinks = document.querySelectorAll(".mobile-bottom a[href^='#']");
  bottomLinks.forEach((link) => {
    link.addEventListener("click", () => {
      bottomLinks.forEach((item) => item.classList.remove("active"));
      link.classList.add("active");
    });
  });
})();
