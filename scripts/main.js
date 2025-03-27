function initTeamModals() {
  const teamMembers = document.querySelectorAll(".team-member");
  const modals = document.querySelectorAll(".modal");
  const closeButtons = document.querySelectorAll(".modal-close");

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

  closeButtons.forEach((button) => {
    button.addEventListener("click", function () {
      const modal = this.closest(".modal");
      closeModal(modal);
    });
  });

  modals.forEach((modal) => {
    modal.addEventListener("click", function (e) {
      if (e.target === this) {
        closeModal(this);
      }
    });
  });

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

function updateActiveNav() {
  const navLinks = document.querySelectorAll(".nav-link");
  const currentPath = window.location.pathname;
  const currentHash = window.location.hash;

  navLinks.forEach((link) => link.classList.remove("active"));

  if (currentPath.includes("/about")) {
    document.querySelector('.nav-link[href="/about"]')?.classList.add("active");
    return;
  }

  if (currentPath === "/" || currentPath === "/home" || currentPath === "") {
    if (currentHash) {
      const sectionId = currentHash.substring(1);
      document
        .querySelector(`.nav-link[href="/${currentHash}"]`)
        ?.classList.add("active");
    }
    else {
      document.querySelector('.nav-link[href="/"]')?.classList.add("active");
    }
  }
}

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

  if (scrollPosition < 100) {
    if (window.location.hash !== "") {
      history.replaceState(null, null, window.location.pathname);
      updateActiveNav();
    }
    return;
  }

  if (currentSection && `#${currentSection}` !== window.location.hash) {
    history.replaceState(null, null, `/#${currentSection}`);
    updateActiveNav();
  }
}

function handleNavLinks() {
  document.querySelectorAll(".nav-link").forEach((link) => {
    link.addEventListener("click", function (e) {
      if (this.getAttribute("href").startsWith("/")) {
        const menuToggle = document.getElementById("menu-toggle");
        const navMenu = document.getElementById("nav-menu");
        if (navMenu.classList.contains("active")) {
          menuToggle.classList.remove("active");
          navMenu.classList.remove("active");
          document.body.classList.remove("no-scroll");
        }

        setTimeout(updateActiveNav, 100);
      }
    });
  });
}

document.addEventListener("DOMContentLoaded", function () {
  initTeamModals();
  handleNavLinks();
  updateActiveNav();

  window.addEventListener("scroll", function () {
    clearTimeout(window.scrollTimer);
    window.scrollTimer = setTimeout(handleScroll, 50);
  });

  window.addEventListener("hashchange", updateActiveNav);
  window.addEventListener("popstate", updateActiveNav);

  const menuToggle = document.getElementById("menu-toggle");
  const navMenu = document.getElementById("nav-menu");

  menuToggle.addEventListener("click", function () {
    this.classList.toggle("active");
    navMenu.classList.toggle("active");
    document.body.classList.toggle("no-scroll");
  });

  const themeSwitch = document.getElementById("theme-switch");
  const savedTheme = localStorage.getItem("theme") || "dark";

  document.documentElement.setAttribute("data-theme", savedTheme);
  themeSwitch.checked = savedTheme === "light";

  themeSwitch.addEventListener("change", function () {
    const theme = this.checked ? "light" : "dark";
    document.documentElement.setAttribute("data-theme", theme);
    localStorage.setItem("theme", theme);
  });

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

  const header = document.getElementById("header");
  window.addEventListener("scroll", function () {
    if (window.scrollY > 50) {
      header.classList.add("scrolled");
    } else {
      header.classList.remove("scrolled");
    }
  });

  if (window.scrollY > 50) {
    header.classList.add("scrolled");
  }
});
