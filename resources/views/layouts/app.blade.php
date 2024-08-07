<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/es6-promise@4/dist/es6-promise.auto.js" defer></script>

    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <script>
        window.User = {
            'name': '{{ auth()->user() ? auth()->user()->firstname : '' }} {{ auth()->user() ? auth()->user()->lastname : '' }}',
            'id': '{{ auth()->id() }}',
            'role': '{{ auth()->user() ? auth()->user()->roles->first()->name : '' }}',
            'rank': '{{ auth()->user() ? auth()->user()->roles->first()->rank : '' }}'
        };

        window.urlBase = '{{ env('APP_URL') }}';
    </script>
</head>
<body>
    <div id="app" class="relative">
        <header class=" border-b border-gray-300">
            <nav class="flex container mx-auto items-center">
                @include('layouts.partials._lang-switcher')

                @auth
                    <div class="ml-auto">
                        <nav-dropdown />
                    </div>
                @endauth
            </nav>
        </header>

        <main class="container mx-auto">
            @yield('content')
        </main>
    </div>
</body>
</html>
