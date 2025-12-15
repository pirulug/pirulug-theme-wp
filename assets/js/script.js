const toggleBtn = document.getElementById("themeToggle");
const body = document.body;
const sunIcon = document.getElementById("icon-sun");
const moonIcon = document.getElementById("icon-moon");

// detectar preferencia del sistema
const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;

// cargar tema guardado o usar el del sistema
let savedTheme = localStorage.getItem("theme");
if (!savedTheme) {
  savedTheme = prefersDark ? "dark" : "light";
  localStorage.setItem("theme", savedTheme);
}

// aplicar tema inicial
body.setAttribute("data-theme", savedTheme);
updateIcons(savedTheme);

// evento click toggle
toggleBtn.addEventListener("click", () => {
  let currentTheme = body.getAttribute("data-theme");
  let newTheme = currentTheme === "light" ? "dark" : "light";

  body.setAttribute("data-theme", newTheme);
  localStorage.setItem("theme", newTheme);
  updateIcons(newTheme);
});

function updateIcons(theme) {
  if (theme === "light") {
    sunIcon.style.display = "inline";
    moonIcon.style.display = "none";
  } else {
    sunIcon.style.display = "none";
    moonIcon.style.display = "inline";
  }
}
 

// Menu

// Código pequeño y robusto para togglear el submenu con clic, y cerrar al clicar fuera
document.addEventListener('click', function (e) {
  const toggle = e.target.closest('.has-sub');

  // Si hicimos clic en un toggle de submenú
  if (toggle) {
    e.preventDefault();
    const li = toggle.parentElement;
    const isOpen = li.classList.contains('open');

    // Cerrar otros abiertos (opcional)
    document.querySelectorAll('.menu li.open').forEach(node => {
      if (node !== li) {
        node.classList.remove('open');
        node.querySelector('.has-sub')?.setAttribute('aria-expanded', 'false');
      }
    });

    li.classList.toggle('open', !isOpen);
    toggle.setAttribute('aria-expanded', String(!isOpen));
    return;
  }

  // clic fuera del menú: cerrar todo
  if (!e.target.closest('.menu')) {
    document.querySelectorAll('.menu li.open').forEach(node => {
      node.classList.remove('open');
      node.querySelector('.has-sub')?.setAttribute('aria-expanded', 'false');
    });
  }
});

// Cerrar con ESC
document.addEventListener('keydown', function (e) {
  if (e.key === 'Escape') {
    document.querySelectorAll('.menu li.open').forEach(node => {
      node.classList.remove('open');
      node.querySelector('.has-sub')?.setAttribute('aria-expanded', 'false');
    });
  }
});
