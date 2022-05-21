<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{!! asset('images/logo.png') !!}" />

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>StoryTeller</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <style>
        .logo {
            max-width: 50%;
        }

        .links>a {
            color: #636b6f;
            padding: 1vw;
            font-size: 1vw;
            font-weight: 600;
            text-decoration: none;
            text-transform: uppercase;
        }

        .navbar-brand {
            font-size: 1vw;
        }

        body {
            background-color:aliceblue;
            color: black;
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <!-- Left side -->
            <ul class="nav navbar-nav">
                <img src="{{ asset('images/logo.png') }}" alt="logó" class="logo">
            </ul>
            @auth
                <ul class="nav navbar-nav mx-auto">
                    <li class="nav-item links"><a href="{{ route('books.index') }}">Összes könyv</a></li>
                    <li class="nav-item links"><a href="{{ route('books.show', Auth::user()->id) }}">Könyveim</a></li>
                    <li class="nav-item links"><a href="{{ route('books.create') }}">Könyv létrehozása</a></li>
                    <li class="nav-item links"><a href="{{ route('stories.index') }}">Összes történet</a></li>
                    <li class="nav-item links"><a href="{{ route('stories.show', Auth::user()->id) }}">Történeteim</a></li>
                    <li class="nav-item links"><a href="{{ route('stories.create') }}">Történet létrehozása</a></li>
                    <li class="nav-item links"><a href="{{ url('/logout') }}">Kijelentkezés</a></li>
                </ul>
            @endauth
            <!-- Right side -->
            <ul class="nav navbar-nav ms-auto">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Vissza a Főoldalra
                </a>
                <!-- Authentication Links -->
                @guest
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Bejelentkezés') }}</a>
                    </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register') }}">{{ __('Regisztráció') }}</a>
                        </li>
                    @endif
                @endguest
            </ul>
        </nav>
        <main class="py-4">
            @yield('content')
        </main>
    </div>
</body>

</html>
