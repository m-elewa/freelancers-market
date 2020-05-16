<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="h-100">
<head>
    <x-app-layouts.head/>
</head>
<body class="h-100">
    <div id="app" class="h-100">
        <x-app-layouts.header/>
        
        <main class="d-flex flex-column h-100" style="padding-top: 78px;">
            @yield('content')
        </main>

        <x-app-layouts.footer/>
    </div>
    <!-- Scripts -->
    <script src="{{ mix('js/manifest.js') }}"></script>
    <script src="{{ mix('js/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
