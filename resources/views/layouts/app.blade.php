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
    </div>
</body>
</html>
