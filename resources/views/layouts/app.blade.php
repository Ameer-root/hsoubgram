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
        <!--Arabic Fonts-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=IBM+Plex+Sans+Arabic:wght@400;700&display=swap" rel="stylesheet">
        <!-- Icons -->
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 dark:bg-neutral-950">
            @include('layouts.navigation')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white dark:bg-neutral-800 shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="max-w-5xl mx-auto mt-8 px-0 md:px-4">
                {{ $slot }}
            </main>
        </div>
        <script>
            const darkModeButton = document.getElementById('darkModeButton');
            const sunIcon = document.getElementById('sunIcon');
            const moonIcon = document.getElementById('moonIcon');
            const darkMode = localStorage.getItem('darkMode');

            if (darkMode === 'enabled') {
                sunIcon.style.display = 'none';
                moonIcon.style.display = 'inline';
                document.body.classList.add('dark');
            } else {
                sunIcon.style.display = 'inline';
                moonIcon.style.display = 'none';
                document.body.classList.remove('dark');
            }

            darkModeButton.addEventListener('click', function() {
                if (sunIcon.style.display === 'inline') {
                    sunIcon.style.display = 'none';
                    moonIcon.style.display = 'inline';
                    document.body.classList.add('dark');
                    localStorage.setItem('darkMode', 'enabled');
                } else {
                    sunIcon.style.display = 'inline';
                    moonIcon.style.display = 'none';
                    document.body.classList.remove('dark');
                    localStorage.setItem('darkMode', 'disabled');
                }
            });
        </script>

        @livewireScripts
        @livewire('wire-elements-modal')
    </body>
</html>
