<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 ">
        <div class="flex items-center" x-data="{ show: false }" x-show="show" x-init="setTimeout(() => show = true, 1000)"
            x-transition:enter="transition ease-out duration-500 transform"
            x-transition:enter-start="-translate-y-full opacity-0" x-transition:enter-end="translate-y-0 opacity-100"
            >
            <img src="{{ asset('assets/images/bpomri_without_label.png') }}" alt="Logo BPOM" width="90px">
            <div class="flex flex-col">
                <h2 class="text-accent text-2xl sm:text-4xl md:text-5xl font-semibold font-serif">ASIK <span
                        class="text-primary btn-ghost rounded-sm px-1 py-2">CUAN</span></h2>
                <p>Aplikasi Kegiatan Mencakup Pertanggungjawaban</p>
            </div>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-base-300 shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
