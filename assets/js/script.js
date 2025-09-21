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
