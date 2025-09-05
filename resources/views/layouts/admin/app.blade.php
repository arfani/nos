<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Admin - {{ config('app.name', 'NOS') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/css/admin/index.css'])
    @stack('styles')
    <script src="https://kit.fontawesome.com/8e04c6a931.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/icon?family=Material+Symbols+Outlined" rel="stylesheet">
</head>

<body class="antialiased">
    @include('layouts.admin.sidebar')
    <div id="mainContent">
        @include('layouts.admin.navbar')
        <!-- Page Content -->
        <main class="py-12">
            {{-- ntar hapus session2 handler di masing2 halaman jika ada component ini sudah cukup untuk semua halaman ADMIN --}}
            <x-ar.alert />

            {{-- <div class="overflow-hidden shadow-sm sm:rounded-lg"> --}}
            {{-- <div class="p-6 bg-base-200 mx-2 sm:mx-4 lg:mx-6 rounded"> --}}
            {{ $slot }}
            {{-- </div> --}}
            {{-- </div> --}}
        </main>
        {{-- <button class="btn btn-primary themeSetter" to="coffee">coffee</button>
        <button class="btn btn-primary themeSetter" to="autumn">autumn</button> --}}
        @include('layouts.admin.footer')
    </div>
    @stack('scripts')
    {{-- <script>
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
    </script> --}}
</body>

</html>
