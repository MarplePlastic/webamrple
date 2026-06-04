/* Marple Chile — interacciones del sitio */
(function () {
  "use strict";

  // --- Menú móvil -------------------------------------------------------
  const toggle = document.getElementById("menu-toggle");
  const menu = document.getElementById("mobile-menu");
  if (toggle && menu) {
    toggle.addEventListener("click", function () {
      const open = menu.classList.toggle("hidden") === false;
      toggle.setAttribute("aria-expanded", String(open));
    });
    // Cierra el menú al hacer clic en un enlace
    menu.querySelectorAll("a").forEach(function (a) {
      a.addEventListener("click", function () {
        menu.classList.add("hidden");
        toggle.setAttribute("aria-expanded", "false");
      });
    });
  }

  // --- Sombra del header al hacer scroll --------------------------------
  const header = document.getElementById("site-header");
  if (header) {
    const onScroll = function () {
      if (window.scrollY > 8) {
        header.classList.add("border-brand-100", "shadow-card");
      } else {
        header.classList.remove("border-brand-100", "shadow-card");
      }
    };
    window.addEventListener("scroll", onScroll, { passive: true });
    onScroll();
  }

  // --- Animaciones al entrar en viewport --------------------------------
  const reveals = document.querySelectorAll(".reveal");
  if (reveals.length) {
    // Aparición escalonada: retrasa los hermanos .reveal del mismo contenedor
    const groupCount = new Map();
    reveals.forEach(function (el) {
      const p = el.parentElement;
      const i = groupCount.get(p) || 0;
      if (i > 0) el.style.transitionDelay = Math.min(i * 90, 540) + "ms";
      groupCount.set(p, i + 1);
    });
    if ("IntersectionObserver" in window) {
      const io = new IntersectionObserver(
        function (entries) {
          entries.forEach(function (entry) {
            if (entry.isIntersecting) {
              entry.target.classList.add("in-view");
              io.unobserve(entry.target);
            }
          });
        },
        { threshold: 0.12, rootMargin: "0px 0px -40px 0px" }
      );
      reveals.forEach(function (el) {
        io.observe(el);
      });
    } else {
      // Fallback: muestra todo si no hay soporte
      reveals.forEach(function (el) {
        el.classList.add("in-view");
      });
    }
  }

  // --- Postulación: precarga el cargo al pulsar "Postular" --------------
  const applyBtns = document.querySelectorAll(".js-apply");
  const cargoSelect = document.getElementById("cargo");
  if (applyBtns.length && cargoSelect) {
    applyBtns.forEach(function (btn) {
      btn.addEventListener("click", function () {
        const cargo = btn.getAttribute("data-cargo");
        if (cargo) {
          for (let i = 0; i < cargoSelect.options.length; i++) {
            if (cargoSelect.options[i].value === cargo) { cargoSelect.selectedIndex = i; break; }
          }
        }
      });
    });
  }

  // --- Contadores animados (count-up) -----------------------------------
  const counters = document.querySelectorAll("[data-count]");
  if (counters.length && "IntersectionObserver" in window) {
    const animate = function (el) {
      const target = parseFloat(el.getAttribute("data-count"));
      const suffix = el.getAttribute("data-suffix") || "";
      const dur = 1200;
      const start = performance.now();
      const step = function (now) {
        const p = Math.min((now - start) / dur, 1);
        const eased = 1 - Math.pow(1 - p, 3); // easeOutCubic
        el.textContent = Math.round(target * eased) + suffix;
        if (p < 1) requestAnimationFrame(step);
      };
      requestAnimationFrame(step);
    };
    const cObs = new IntersectionObserver(
      function (entries) {
        entries.forEach(function (e) {
          if (e.isIntersecting) { animate(e.target); cObs.unobserve(e.target); }
        });
      },
      { threshold: 0.5 }
    );
    counters.forEach(function (el) { cObs.observe(el); });
  }

  // --- Acordeón de FAQ --------------------------------------------------
  document.querySelectorAll(".faq-item").forEach(function (item) {
    const btn = item.querySelector(".faq-trigger");
    if (!btn) return;
    btn.addEventListener("click", function () {
      const open = item.classList.toggle("open");
      btn.setAttribute("aria-expanded", String(open));
    });
  });

  // --- Barra de progreso de lectura + botón volver arriba ---------------
  const progress = document.getElementById("scroll-progress");
  const toTop = document.getElementById("to-top");
  if (progress || toTop) {
    const onScrollUi = function () {
      const h = document.documentElement;
      const scrolled = h.scrollTop;
      const height = h.scrollHeight - h.clientHeight;
      const pct = height > 0 ? (scrolled / height) * 100 : 0;
      if (progress) progress.style.width = pct + "%";
      if (toTop) toTop.classList.toggle("is-visible", scrolled > 500);
    };
    window.addEventListener("scroll", onScrollUi, { passive: true });
    onScrollUi();
  }
  if (toTop) {
    toTop.addEventListener("click", function () {
      window.scrollTo({ top: 0, behavior: "smooth" });
    });
  }

  // --- Lightbox de la galería -------------------------------------------
  const lb = document.getElementById("lightbox");
  const lbImg = document.getElementById("lightbox-img");
  if (lb && lbImg) {
    const open = function (src, alt) {
      lbImg.src = src;
      lbImg.alt = alt || "";
      lb.classList.add("open");
      lb.setAttribute("aria-hidden", "false");
      document.body.style.overflow = "hidden";
    };
    const close = function () {
      lb.classList.remove("open");
      lb.setAttribute("aria-hidden", "true");
      lbImg.removeAttribute("src");
      document.body.style.overflow = "";
    };
    document.querySelectorAll("[data-lightbox]").forEach(function (el) {
      el.addEventListener("click", function () {
        open(el.getAttribute("data-lightbox"), el.getAttribute("data-alt"));
      });
      el.addEventListener("keydown", function (e) {
        if (e.key === "Enter" || e.key === " ") { e.preventDefault(); open(el.getAttribute("data-lightbox"), el.getAttribute("data-alt")); }
      });
    });
    lb.addEventListener("click", function (e) {
      if (e.target === lb || e.target.closest(".lightbox-close")) close();
    });
    document.addEventListener("keydown", function (e) {
      if (e.key === "Escape" && lb.classList.contains("open")) close();
    });
  }

  // --- Año dinámico (por si se usa en algún sitio) ----------------------
  const year = document.querySelector("[data-year]");
  if (year) year.textContent = new Date().getFullYear();
})();
