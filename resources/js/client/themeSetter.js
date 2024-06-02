// DOM elements
const themeSetter = document.querySelectorAll(".themeSetter");
const html = document.querySelector("html");

// Check the browser preferred color scheme, and sets the defaultTheme based of that
const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;
const defaultTheme = prefersDarkMode ? "coffee" : "autumn";
const preferredTheme = localStorage.getItem("theme")

// Check if the localStorage item is set, if not set it to the default theme
if (!preferredTheme) {
    localStorage.setItem("theme", defaultTheme);
}

// Sets the theme of the site either the preferredTheme or the defaultTheme (based on localStorage)
setTheme(preferredTheme || defaultTheme)

themeSetter.forEach((btnSetter) => {
    btnSetter.addEventListener("click", (e) => {
        const newTheme = e.target.getAttribute('to')
        // Changes the theme to the newTheme
        localStorage.setItem("theme", newTheme);
        setTheme(newTheme)
    });
})

function setTheme(theme) {
    html.setAttribute('data-theme', theme)
}