<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title inertia>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @routes
        @vite(['resources/js/admin.js', "resources/js/admin/pages/{$page['component']}.vue"])
        @inertiaHead

        @php
            $publicCss = Vite::asset('resources/css/public/app.css');
            $publicCss2 = Vite::asset('resources/css/public/app.mediascreen.css');
        @endphp
        <meta name="public-css-1" content="{{ $publicCss }}">
        <meta name="public-css-2" content="{{ $publicCss2 }}">
        <script src="/vendor/ckeditor/ckeditor.js"></script>
    </head>
    <body class="font-sans antialiased">
        @inertia
    </body>
</html>
