(function () {
  const revealItems = document.querySelectorAll(".reveal-up, .reveal-right");
  const counters = document.querySelectorAll("[data-counter]");
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      entry.target.classList.add("is-visible");
      observer.unobserve(entry.target);
    });
  }, { threshold: 0.16 });
  revealItems.forEach((item) => observer.observe(item));

  const counterObserver = new IntersectionObserver((entries) => {
    entries.forEach((entry) => {
      if (!entry.isIntersecting) return;
      const node = entry.target;
      const target = Number(node.dataset.counter || 0);
      let current = 0;
      const step = Math.max(1, Math.ceil(target / 70));
      const timer = window.setInterval(() => {
        current += step;
        if (current >= target) {
          current = target;
          window.clearInterval(timer);
        }
        node.textContent = current.toLocaleString("en-IN") + (target > 1000 ? "+" : "");
      }, 22);
      counterObserver.unobserve(node);
    });
  }, { threshold: 0.6 });
  counters.forEach((counter) => counterObserver.observe(counter));

  document.querySelectorAll(".btn").forEach((button) => {
    button.addEventListener("click", (event) => {
      const ripple = document.createElement("span");
      const rect = button.getBoundingClientRect();
      ripple.className = "ripple";
      ripple.style.left = `${event.clientX - rect.left}px`;
      ripple.style.top = `${event.clientY - rect.top}px`;
      button.appendChild(ripple);
      window.setTimeout(() => ripple.remove(), 700);
    });
  });
})();
