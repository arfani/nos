// DOM elements
const themeSetter = document.querySelector(".themeSetter");
const html = document.querySelector("html");

// Check the browser preferred color scheme, and sets the defaultTheme based of that
const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;
const defaultTheme = prefersDarkMode ? "coffee" : "nord";
const preferredTheme = localStorage.getItem("theme")

// Check if the localStorage item is set, if not set it to the default theme
if (!preferredTheme) {
    localStorage.setItem("theme", defaultTheme);
        themeSetter.checked = true
    if(defaultTheme == 'nord'){
        themeSetter.checked = false
    }
}

// Sets the theme of the site either the preferredTheme or the defaultTheme (based on localStorage)
setTheme(preferredTheme || defaultTheme)

themeSetter.addEventListener("change", (e) => {
        const newTheme = e.target.checked ? 'nord' : 'coffee';
        // Changes the theme to the newTheme
        localStorage.setItem("theme", newTheme);
        setTheme(newTheme)
    });

function setTheme(theme) {
    html.setAttribute('data-theme', theme)
}