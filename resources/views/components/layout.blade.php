<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FlyonUI Laravel Livewire Starter Kit</title>

        <!-- Styles / Scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif

        <livewire:styles />
    </head>
    <body class="bg-base-200 min-h-screen">
        <main>
            {{ $slot }}
        </main>

        <livewire:scripts />

    </body>
</html>
