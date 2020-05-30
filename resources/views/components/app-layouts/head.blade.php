
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

@hasSection('title')
    <title>@yield('title') - {{ config('app.name') }}</title>
@else
    <title>{{ config('app.name') }}</title>
@endif

<!-- Styles -->
<link href="{{ mix('css/app.css') }}" rel="stylesheet">
@stack('css')

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Scripts -->
<script src="{{ mix('js/manifest.js') }}"></script>
<script src="{{ mix('js/vendor.js') }}"></script>
<script src="{{ mix('js/app.js') }}"></script>
<x-app-layouts.notification-channel/>
@stack('scripts')

<!-- CSRF -->
<meta name="csrf-token" content="{{ csrf_token() }}">
