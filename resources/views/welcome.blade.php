<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{!! asset('images/logo.png') !!}" />

    <title>StoryTeller</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ URL::asset('css/welcome.css') }}" rel="stylesheet">
</head>

<body>
    <div class="flex-center position-ref full-height">
        <header>
            <div class="top-left logo">
                <img src="images/logo.png" alt="logo">
            </div>
            <div class="title m-b-md">
                StoryTeller
            </div>
        </header>
        @if (Route::has('login'))
            <div class="center links">
                @auth
                <div class="grid-container">
                    <div class="grid-item"><a href="{{ url('/all_books') }}">Összes könyv</a></div>
                    <div class="grid-item"><a href="{{ url('/my_books') }}">Könyveim</a></div>
                    <div class="grid-item"><a href="{{ url('/create_book') }}">Könyv létrehozása</a></div>
                    <div class="grid-item"><a href="{{ url('/all_stories') }}">Összes történet</a></div>
                    <div class="grid-item"><a href="{{ url('/my_stories') }}">Történeteim</a></div>
                    <div class="grid-item"><a href="{{ url('/create_story') }}">Történet létrehozása</a></div>
                    <div class="grid-item"><a class="logout" href="{{ url('/logout') }}">Kijelentkezés</a></div>
                </div>
                @else
                    <a href="{{ route('login') }}">Bejelentkezés</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Regisztráció</a>
                    @endif
                @endauth
            </div>
        @endif
        <div class="extras">
            <a href="https://github.com/szodom/StoryTeller/blob/main/README.md">Dokumentáció</a>
            <a href="{{ url('/gyik') }}">GyIK</a>
            <a href="https://github.com/DominikSzol/StoryTeller">GitHub</a>
        </div>
    </div>
</body>

</html>
