<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>StoryTeller</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .center {
                position: absolute;
                right: 10px;
                top: 18px;

                margin-left: 10px;
            }

            .top-left {
                position: absolute;
                left: 10px;
                top: 10px;
            }

            .title {
                font-size: 150px;
                position: absolute;
                top: 10px;
                margin-left: 300px;
                text-align: center;
            }

            .links > a {
                color: #636b6f;
                padding: 10px 120px;
                font-size: 40px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
                border: 2px solid grey;
            }
            .links {
                position: absolute;
                top: 50%;
                width: 100%;
                text-align: center;
            }


            .m-b-md {
                margin-bottom: 30px;
            }
            .extras > a {
                position: relative;
                top: 300px;
                color: #636b6f;
                padding: 0 25px;
                font-size: 20px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
        </style>
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
                        <a href="{{ url('/home') }}">Főoldal</a>
                        <a href="{{ url('/home') }}">Könyveim</a>
                        <a href="{{ url('/create_book') }}">Könyv létrehozása</a>
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
                    <a href="{{ url('/aff') }}">Általános felhasználási feltételek</a>
                    <a href="{{ url('/dss') }}">Adatvédelmi tájékoztató</a>
                    <a href="{{ url('/gyik') }}">GyIK</a>
                    <a href="https://github.com/szodom/StoryTeller">GitHub</a>
                </div>
        </div>
    </body>
</html>
