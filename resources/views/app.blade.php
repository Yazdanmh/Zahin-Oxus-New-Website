<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        
        @if(request()->is('admin/*'))
            <!-- Admin-specific styles -->
            <link rel="stylesheet" href="{{ asset('backend/assets/vendor/fonts/boxicons.css') }}" />
            <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/core.css') }}" />
            <link rel="stylesheet" href="{{ asset('backend/assets/vendor/css/theme-default.css') }}" />
            <link rel="stylesheet" href="{{ asset('backend/assets/css/demo.css') }}" />
            
            <!-- Vendors CSS -->
            <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css') }}" />
            <link rel="stylesheet" href="{{ asset('backend/assets/vendor/libs/apex-charts/apex-charts.css') }}" />

            <script src="{{ asset('backend/assets/vendor/js/helpers.js') }}"></script>
            <script src="{{ asset('backend/assets/js/config.js') }}"></script>
        @endif

        @routes
        @vite(['resources/js/app.ts', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="font-sans antialiased">
        @inertia

        @if(request()->is('admin/*'))
            <!-- Admin-specific scripts -->
            <script src="{{ asset('backend/assets/vendor/libs/jquery/jquery.js') }}"></script>
            <script src="{{ asset('backend/assets/vendor/libs/popper/popper.js') }}"></script>
            <script src="{{ asset('backend/assets/vendor/js/bootstrap.js') }}"></script>
            <script src="{{ asset('backend/assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
            <script src="{{ asset('backend/assets/vendor/js/menu.js') }}"></script>

            <!-- Admin Vendors JS -->
            <script src="{{ asset('backend/assets/vendor/libs/apex-charts/apexcharts.js') }}"></script>
            <script src="{{ asset('backend/assets/js/main.js') }}"></script>
            <script src="{{ asset('backend/assets/js/dashboards-analytics.js') }}"></script>
        @endif
        <script src="{{ mix('js/app.ts') }}"></script>
    </body>
</html>
