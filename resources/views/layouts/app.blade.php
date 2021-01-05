<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Scripts -->


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link rel="stylesheet" href="{{  asset('/css/fontawesome-free-5.15.1-web/css/all.css') }}">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
<div id="app">
    <header class="header">
        @include("layouts.blocks.header")
    </header>

    <main class="py-4">
        @yield('content')
    </main>


    <footer class="container footer">
        @include("layouts.blocks.footer")
    </footer>

</div>
</body>
<script src="
@if(View::hasSection('script'))
    @yield('script')
@else
    {{ asset('/js/app.js') }}
@endif
    " defer></script>
</html>
