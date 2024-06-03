<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'NOS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <script src="https://kit.fontawesome.com/8e04c6a931.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased">

    <div class="loadingScreen fixed w-screen h-screen z-[9999] bg-base-300 flex justify-center items-center">
        @include('components_custom.loader')
    </div>

    @include('layouts.client.navbar')
<!-- Page Content -->
    <main class="pt-28 pb-4 px-4 transition-all">
        {{ $slot }}
    </main>
    
    @include('layouts.client.footer')

    <script>
        // This will hide the loading screen once the DOM is fully loaded
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelector('.loadingScreen').style.display = 'none';
        });

        // Alternatively, use the window load event to ensure all resources are loaded
        // window.addEventListener('load', function() {
        //     document.querySelector('.loadingScreen').style.display = 'none';
        // });

        // THEME SETTER DILETAKAN DISINI (BUKAN DI FILE JS PADA FOLDER resources/js) AGAR TIDAK BLINK DARI MODE DARK KE MODE LIGHT SAAT DALAM MODE LIGHT MUNGKIN KARENA LANGSUNG TERLOAD
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
        }

        // Sets the theme of the site either the preferredTheme or the defaultTheme (based on localStorage)
        setTheme(preferredTheme || defaultTheme)

        themeSetter.addEventListener("change", (e) => {
            const newTheme = e.target.checked ? 'coffee' : 'nord';
            // Changes the theme to the newTheme
            localStorage.setItem("theme", newTheme);
            setTheme(newTheme)
        });

        function setTheme(theme) {
            html.setAttribute('data-theme', theme)
            
            if (theme == 'nord') {
                html.classList.remove('dark')
                themeSetter.checked = false
            } else {
                html.classList.add('dark')
                themeSetter.checked = true
            }
        }
    </script>

    @stack('scripts')
</body>

</html>
