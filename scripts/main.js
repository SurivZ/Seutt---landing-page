// Modales del equipo
function initTeamModals() {
  const teamMembers = document.querySelectorAll(".team-member");
  const modals = document.querySelectorAll(".modal");
  const closeButtons = document.querySelectorAll(".modal-close");

  // Abrir modal al hacer clic en un miembro
  teamMembers.forEach((member) => {
    member.addEventListener("click", function () {
      const modalId = this.getAttribute("data-modal");
      const modal = document.getElementById(modalId);

      if (modal) {
        document.body.classList.add("no-scroll");
        modal.classList.add("active");
      }
    });
  });

  // Cerrar modal al hacer clic en el botón de cerrar
  closeButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const modal = this.closest(".modal");
      closeModal(modal);
    });
  });

  // Cerrar modal al hacer clic fuera del contenido
  modals.forEach((modal) => {
    modal.addEventListener("click", function (e) {
      if (e.target === this) {
        closeModal(this);
      }
    });
  });

  // Cerrar modal con la tecla Escape
  document.addEventListener("keydown", function (e) {
    if (e.key === "Escape") {
      const activeModal = document.querySelector(".modal.active");
      if (activeModal) {
        closeModal(activeModal);
      }
    }
  });

  function closeModal(modal) {
    if (modal) {
      modal.classList.remove("active");
      document.body.classList.remove("no-scroll");
    }
  }
}

// Función principal para manejar la navegación
function updateActiveNav() {
  const navLinks = document.querySelectorAll(".nav-link");
  const currentPath = window.location.pathname;
  const currentHash = window.location.hash;

  // Resetear todos los enlaces
  navLinks.forEach((link) => link.classList.remove("active"));

  // Caso 1: Estamos en la página "Nosotros"
  if (currentPath.includes("/about")) {
    document.querySelector('.nav-link[href="/about"]')?.classList.add("active");
    return;
  }

  // Caso 2: Estamos en la página de inicio
  if (currentPath === "/" || currentPath === "/home" || currentPath === "") {
    // Si hay un hash en la URL
    if (currentHash) {
      const sectionId = currentHash.substring(1); // Eliminar el #
      document
        .querySelector(`.nav-link[href="/${currentHash}"]`)
        ?.classList.add("active");
    }
    // Si no hay hash (parte superior de la página)
    else {
      document.querySelector('.nav-link[href="/"]')?.classList.add("active");
    }
  }
}

// Función para manejar el scroll y actualizar el hash
function handleScroll() {
  if (
    window.location.pathname !== "/" &&
    window.location.pathname !== "/home" &&
    window.location.pathname !== ""
  )
    return;

  const scrollPosition = window.scrollY + 100;
  const sections = document.querySelectorAll("section[id]");
  let currentSection = "";

  sections.forEach((section) => {
    const sectionTop = section.offsetTop;
    const sectionBottom = sectionTop + section.offsetHeight;

    if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
      currentSection = section.id;
    }
  });

  // Parte superior de la página
  if (scrollPosition < 100) {
    if (window.location.hash !== "") {
      history.replaceState(null, null, window.location.pathname);
      updateActiveNav();
    }
    return;
  }

  // Actualizar hash si es diferente al actual
  if (currentSection && `#${currentSection}` !== window.location.hash) {
    history.replaceState(null, null, `/#${currentSection}`);
    updateActiveNav();
  }
}

// Función para manejar clics en enlaces
function handleNavLinks() {
  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", function (e) {
      // Solo manejar enlaces que comienzan con /
      if (this.getAttribute("href").startsWith("/")) {
        // Cerrar menú móvil si está abierto
        const menuToggle = document.getElementById("menu-toggle");
        const navMenu = document.getElementById("nav-menu");
        if (navMenu.classList.contains("active")) {
          menuToggle.classList.remove("active");
          navMenu.classList.remove("active");
          document.body.classList.remove("no-scroll");
        }

        // Actualizar navegación después de un breve retraso
        setTimeout(updateActiveNav, 100);
      }
    });
  });
}

// Inicialización
document.addEventListener("DOMContentLoaded", function () {
  initTeamModals();
  handleNavLinks();
  updateActiveNav();

  // Configurar eventos
  window.addEventListener("scroll", function () {
    clearTimeout(window.scrollTimer);
    window.scrollTimer = setTimeout(handleScroll, 50);
  });

  window.addEventListener("hashchange", updateActiveNav);
  window.addEventListener("popstate", updateActiveNav);

  // ... (resto del código existente: menú móvil, theme switcher, etc.)
  // Mobile menu toggle
  const menuToggle = document.getElementById("menu-toggle");
  const navMenu = document.getElementById("nav-menu");

  menuToggle.addEventListener("click", function () {
    this.classList.toggle("active");
    navMenu.classList.toggle("active");
    document.body.classList.toggle("no-scroll");
  });

  // Theme switcher
  const themeSwitch = document.getElementById("theme-switch");
  const savedTheme = localStorage.getItem("theme") || "dark";

  // Apply saved theme
  document.documentElement.setAttribute("data-theme", savedTheme);
  themeSwitch.checked = savedTheme === "light";

  // Theme switch event
  themeSwitch.addEventListener("change", function () {
    const theme = this.checked ? "light" : "dark";
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
  });

  // Back to top button
  const backToTop = document.querySelector(".back-to-top");

  window.addEventListener("scroll", function () {
    if (window.scrollY > 300) {
      backToTop.removeAttribute("hidden");
    } else {
      backToTop.setAttribute("hidden", "");
    }
  });

  backToTop.addEventListener("click", function (e) {
    e.preventDefault();
    window.scrollTo({
      top: 0,
      behavior: "smooth",
    });
  });

  // 404 page countdown
  const countdownElement = document.getElementById("countdown");
  if (countdownElement) {
    let countdown = 10;
    const countdownInterval = setInterval(() => {
      countdown--;
      countdownElement.textContent = countdown;

      if (countdown <= 0) {
        clearInterval(countdownInterval);
        window.location.href = "/";
      }
    }, 1000);
  }

  // Form submission
  const contactForm = document.getElementById("contactForm");
  if (contactForm) {
    contactForm.addEventListener("submit", function (e) {
      e.preventDefault();
      alert(
        "Gracias por tu mensaje. Nos pondremos en contacto contigo pronto."
      );
      this.reset();
    });
  }

  // Header scroll effect
  const header = document.getElementById("header");
  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });

  // Initialize scroll position
  if (window.scrollY > 50) {
    header.classList.add("scrolled");
  }
});
