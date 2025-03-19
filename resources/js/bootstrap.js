import axios from 'axios';

window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

document.addEventListener("DOMContentLoaded", function () {
    const themeKey = "user-theme";
    const root = document.documentElement;
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    const sunIcon = document.getElementById("sun");
    const moonIcon = document.getElementById("moon");
    const checkbox = document.querySelector('input[type="checkbox"]');

    function setTheme(theme) {
        root.setAttribute("data-theme", theme);
        localStorage.setItem(themeKey, theme);
        updateIcons(theme);
    }

    function updateIcons(theme) {
        if (theme === "dim") {
            sunIcon.style.display = "block";
            moonIcon.style.display = "none";
            checkbox.checked = true;  // Set checkbox to "checked" for dark theme
        } else {
            sunIcon.style.display = "none";
            moonIcon.style.display = "block";
            checkbox.checked = false;  // Set checkbox to "unchecked" for light theme
        }
    }

    function toggleTheme() {
        const currentTheme = root.getAttribute("data-theme");
        const newTheme = currentTheme === "dim" ? "lofi" : "dim";
        setTheme(newTheme);
    }

    // Load saved theme or fallback to system preference
    const savedTheme = localStorage.getItem(themeKey);
    if (savedTheme) {
        setTheme(savedTheme);
    } else {
        setTheme(prefersDark ? "dim" : "lofi");
    }

    // Expose toggle function globally
    window.toggleTheme = toggleTheme;
});
