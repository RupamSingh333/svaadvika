(function () {
  const storageKey = "svaadvika-theme";
  const prefersDark = window.matchMedia("(prefers-color-scheme: dark)");
  const buttons = document.querySelectorAll(".theme-toggle");

  function setTheme(mode) {
    const dark = mode === "dark";
    document.body.classList.toggle("dark-mode", dark);
    buttons.forEach((button) => {
      const icon = button.querySelector("i");
      if (icon) icon.className = dark ? "bi bi-sun" : "bi bi-moon-stars";
      button.setAttribute("aria-label", dark ? "Switch to light mode" : "Switch to dark mode");
    });
  }

  const saved = localStorage.getItem(storageKey);
  setTheme(saved || (prefersDark.matches ? "dark" : "light"));

  buttons.forEach((button) => {
    button.addEventListener("click", () => {
      const next = document.body.classList.contains("dark-mode") ? "light" : "dark";
      localStorage.setItem(storageKey, next);
      setTheme(next);
    });
  });
})();
