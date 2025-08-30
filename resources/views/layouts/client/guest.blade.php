<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'NOS') }}</title>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
</head>

<body class="antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div>
            <a href="/">
                <img src="{{ asset('assets/images/logo.webp') }}" alt="logo" width="100px">
            </a>
             <!-- toggle dark mode -->
             {{-- <div class="fixed top-10 right-12">
                <!-- <button class="btn btn-outline btn-circle" type="button"> -->
                    <label class="swap swap-rotate btn btn-circle btn-outline border-dashed">
                        <!-- this hidden checkbox controls the state -->
                        <input type="checkbox" class="themeSetter hidden" value="synthwave" />

                        <!-- sun icon -->
                        <svg class="swap-off fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M5.64,17l-.71.71a1,1,0,0,0,0,1.41,1,1,0,0,0,1.41,0l.71-.71A1,1,0,0,0,5.64,17ZM5,12a1,1,0,0,0-1-1H3a1,1,0,0,0,0,2H4A1,1,0,0,0,5,12Zm7-7a1,1,0,0,0,1-1V3a1,1,0,0,0-2,0V4A1,1,0,0,0,12,5ZM5.64,7.05a1,1,0,0,0,.7.29,1,1,0,0,0,.71-.29,1,1,0,0,0,0-1.41l-.71-.71A1,1,0,0,0,4.93,6.34Zm12,.29a1,1,0,0,0,.7-.29l.71-.71a1,1,0,1,0-1.41-1.41L17,5.64a1,1,0,0,0,0,1.41A1,1,0,0,0,17.66,7.34ZM21,11H20a1,1,0,0,0,0,2h1a1,1,0,0,0,0-2Zm-9,8a1,1,0,0,0-1,1v1a1,1,0,0,0,2,0V20A1,1,0,0,0,12,19ZM18.36,17A1,1,0,0,0,17,18.36l.71.71a1,1,0,0,0,1.41,0,1,1,0,0,0,0-1.41ZM12,6.5A5.5,5.5,0,1,0,17.5,12,5.51,5.51,0,0,0,12,6.5Zm0,9A3.5,3.5,0,1,1,15.5,12,3.5,3.5,0,0,1,12,15.5Z" />
                        </svg>

                        <!-- moon icon -->
                        <svg class="swap-on fill-current w-6 h-6" xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 24 24">
                            <path
                                d="M21.64,13a1,1,0,0,0-1.05-.14,8.05,8.05,0,0,1-3.37.73A8.15,8.15,0,0,1,9.08,5.49a8.59,8.59,0,0,1,.25-2A1,1,0,0,0,8,2.36,10.14,10.14,0,1,0,22,14.05,1,1,0,0,0,21.64,13Zm-9.5,6.69A8.14,8.14,0,0,1,7.08,5.22v.27A10.15,10.15,0,0,0,17.22,15.63a9.79,9.79,0,0,0,2.1-.22A8.11,8.11,0,0,1,12.14,19.73Z" />
                        </svg>

                    </label>
                <!-- </button> -->
            </div> --}}
            <!-- end toggle dark mode -->
            
        </div>

        <div
            class="w-full sm:max-w-md mt-6 px-6 py-4 bg-base-300 text-base-content shadow-md overflow-hidden sm:rounded-lg">

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            {{ $slot }}
        </div>
    </div>

    <script>
        // THEME SETTER DILETAKAN DISINI (BUKAN DI FILE JS PADA FOLDER resources/js) AGAR TIDAK BLINK DARI MODE DARK KE MODE LIGHT SAAT DALAM MODE LIGHT MUNGKIN KARENA LANGSUNG TERLOAD
        // DOM elements
        // const themeSetter = document.querySelector(".themeSetter");
        // const html = document.querySelector("html");

        // // Check the browser preferred color scheme, and sets the defaultTheme based of that
        // const prefersDarkMode = window.matchMedia("(prefers-color-scheme: dark)").matches;
        // const defaultTheme = prefersDarkMode ? "coffee" : "nord";
        // const preferredTheme = localStorage.getItem("theme")


        // // Check if the localStorage item is set, if not set it to the default theme
        // if (!preferredTheme) {
        //     localStorage.setItem("theme", defaultTheme);
        // }

        // // Sets the theme of the site either the preferredTheme or the defaultTheme (based on localStorage)
        // setTheme(preferredTheme || defaultTheme)

        // themeSetter.addEventListener("change", (e) => {
        //     const newTheme = e.target.checked ? 'coffee' : 'nord';
        //     // Changes the theme to the newTheme
        //     localStorage.setItem("theme", newTheme);
        //     setTheme(newTheme)
        // });

        // function setTheme(theme) {
        //     html.setAttribute('data-theme', theme)
            
        //     if (theme == 'nord') {
        //         html.classList.remove('dark')
        //         themeSetter.checked = false
        //     } else {
        //         html.classList.add('dark')
        //         themeSetter.checked = true
        //     }
        // }
    </script>
</body>

</html>
