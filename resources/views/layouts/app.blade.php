<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <x-app-layouts.head/>
</head>
<body>
    <div id="app">
        <x-app-layouts.header/>
        
        <main class="py-4">
            @yield('content')
        </main>

        <x-app-layouts.footer/>
    </div>
</body>
</html>
