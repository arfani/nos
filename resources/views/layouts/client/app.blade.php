@props(['sosmed'])

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'NOS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

    <script src="https://kit.fontawesome.com/8e04c6a931.js" crossorigin="anonymous"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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

            const searchInput = document.getElementById('search-input');
            const searchButton = document.getElementById('search-button');

            const redirectToSearch = () => {
                const query = searchInput.value;

                if (query == '') {
                    alert('ketik yang ingin anda cari di kolom pencarian terlebih dahulu !');
                    searchInput.focus();
                    return
                }

                const url = `/products?q=${encodeURIComponent(query)}`;
                window.location.href = url;
            };

            // Function to get the query parameter value
            const getQueryParam = (param) => {
                const urlParams = new URLSearchParams(window.location.search);
                return urlParams.get(param);
            };

            // Set the input value from the query parameter on page load
            const searchQuery = getQueryParam('q');
            if (searchQuery) {
                searchInput.value = decodeURIComponent(searchQuery);
            }

            // Event listener for the search button click
            searchButton.addEventListener('click', redirectToSearch);

            // Event listener for Enter key press in the input field
            searchInput.addEventListener('keydown', (event) => {
                if (event.key === 'Enter') {
                    redirectToSearch();
                }
            });
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
