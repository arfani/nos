<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'ASIKCUAN') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
    <script src="https://kit.fontawesome.com/8e04c6a931.js" crossorigin="anonymous"></script>
</head>

<body class="antialiased">
    @include('layouts.admin.sidebar')
    <div id="mainContent">
        @include('layouts.admin.navbar')
        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
        {{-- <button class="btn btn-primary themeSetter" to="coffee">coffee</button>
    <button class="btn btn-primary themeSetter" to="autumn">autumn</button> --}}
        @include('layouts.admin.footer')
    </div>
    @stack('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            const sidebar = document.getElementById('sidebar');
            const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
            const burgerIcon = document.getElementById('burgerIcon');
            const closeIcon = document.getElementById('closeIcon');
            const masterBtn = document.getElementById('masterBtn');
            const submenuMaster = document.getElementById('submenuMaster');
            const caretIconMaster = document.getElementById('caretIconMaster');
            const mainContent = document.getElementById('mainContent');
            const navbar = document.getElementById('navbar');

            // Toggle sidebar
            toggleSidebarBtn.addEventListener('click', () => {
                sidebar.classList.toggle('sidebar-hidden');
                sidebar.classList.toggle('sidebar-visible');
                mainContent.classList.toggle('content-shift');
                navbar.classList.toggle('navbar-shift');
                burgerIcon.classList.toggle('hidden');
                closeIcon.classList.toggle('hidden');
                toggleSidebarBtn.classList.toggle('active');
            });

            // Toggle submenuMaster with animation
            masterBtn.addEventListener('click', () => {
                submenuMaster.classList.toggle('submenu-visible');
                caretIconMaster.classList.toggle('rotate-180');
            });




            
            // Check URL for active submenu
            const path = window.location.hash;
            if (path.startsWith('#settings')) {
                submenu.classList.add('submenu-visible');
                caretIconMaster.classList.add('rotate-180');
            }
        });
    </script>
</body>

</html>
