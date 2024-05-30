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
    
    <div class="loadingScreen fixed w-screen h-screen z-[9999] bg-base-300 flex justify-center">
        <span class="loading loading-ring loading-lg"></span>
    </div>

    @include('layouts.client.navbar')
    <!-- Page Content -->
    <main class="pt-28 px-4 transition-all">
        {{ $slot }}
    </main>
    {{-- <button class="btn btn-primary themeSetter" to="coffee">coffee</button>
    <button class="btn btn-primary themeSetter" to="autumn">autumn</button> --}}
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
    </script>

    @stack('scripts')
</body>

</html>
