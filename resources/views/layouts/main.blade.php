<!DOCTYPE html>
<html lang="de">
<head>
    @include('partials.head')
</head>
<body>
    @include('partials.header')
    @yield('content')
    @include('partials.footer')
    @stack('scripts')
    <script
            src="https://code.jquery.com/jquery-3.7.1.min.js"
            integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo="
            crossorigin="anonymous"></script>
    @vite('resources/js/public/app.js')
</body>
</html>
