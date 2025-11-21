<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <title>@yield('title')</title>
    <meta name="description" content="@yield('meta_description')">
    @hasSection('meta_keywords')
        <meta name="keywords" content="@yield('meta_keywords')">
    @endif
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Quicksand:wght@300..700&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    @vite([
        'resources/css/public/app.css',
        'resources/css/public/app.mediascreen.css',
        'resources/js/public/app.js'
    ])
    @stack('head')
</head>
<body>

@include('partials.header')

@yield('content')

@include('partials.footer')

</body>
</html>
