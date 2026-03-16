<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'SecureVault') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/css/custom.css', 'resources/js/app.js'])
    </head>
    <body class="app-body">
        <div class="app-wrapper">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="page-header">
                    <div class="container">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="page-content">
                <div class="container">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </body>
</html>
