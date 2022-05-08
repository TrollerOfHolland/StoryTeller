<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="{!! asset('images/logo.png') !!}"/>

        <title>Gyakran Ismételt Kérdések</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@200;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }
            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 13px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }
            .logo{
                max-width: 40%;
            }
            .faq_question {
                margin: 0px;
                padding: 0px 0px 5px 0px;
                display: inline-block;
                cursor: pointer;
                font-weight: bold;
            }
            .faq_answer_container {
                display: none;
            }
        </style>
        <script type="text/javascript" src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('.faq_question').click(function() {
                    if ($(this).parent().is('.open')) {
                        $(this).closest('.faq').find('.faq_answer_container').slideUp();
                        $(this).closest('.faq').removeClass('open');
                    } else {
                        $('.faq_answer_container').slideUp();
                        $('.faq').removeClass('open');
                        $(this).closest('.faq').find('.faq_answer_container').slideDown();
                        $(this).closest('.faq').addClass('open');
                    }
                });
            });
        </script>
    </head>
    <body>
        <nav class="navbar navbar-expand">
            <div class="navbar-collapse collapse w-100 order-1 order-md-0 dual-collapse2">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <img src="images\logo.png" alt="logó" class="logo">
                    </li>
                </ul>
            </div>
            <div class="navbar-collapse collapse w-100 order-3 dual-collapse2">
                @if (Route::has('login'))
                    <ul class="navbar-nav ml-auto">
                        @auth
                            <li class="nav-item links">
                                <a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name', 'StoryTeller') }}</a>
                            </li>
                            <li class="nav-item links">
                                <a href="{{ url('/home') }}">Főoldal</a>
                            </li>
                            <li class="nav-item links">
                                <a href="{{ url('/home') }}">Könyveim</a>
                            </li>
                            <li class="nav-item links">
                                <a href="{{ url('/home') }}">Könyv létrehozása</a>
                            </li>
                        @else
                            <li class="nav-item links">
                                <a class="navbar-brand" href="{{ url('/') }}"> {{ config('app.name', 'StoryTeller') }}</a>
                            </li>
                            <li class="nav-item links">
                                <a href="{{ route('login') }}">Bejelentkezés</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item links">
                                    <a href="{{ route('register') }}">Regisztráció</a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                @endif
            </div>
        </nav>
        <div class="jumbotron p-2">
            <h1>Gyakran Ismételt Kérdések</h1>
        </div>
        <div class="container ml-0">
            <div class="faq">
                <div class="faq_question open">Mi az a StoryTeller?</div>
                <div class="faq_answer_container">
                    <div class="faq_answer">A StoryTeller egy olyan oldal, amelyen interaktív történeteket és elekronikus könyveket lehet készíteni, illetve olvasni. Nem kell mást tenned, mint regisztrálni, majd bejelentkezés után szabadon válogathatsz a mások által írt kalandok között. Amennyiben pedig van egy jó ötleted, megalkothatod az elképzelt kalandot.</div>
                </div>
            </div>
            <div class="faq">
                <div class="faq_question">Hogyan tudok kalandot olvasni?</div>
                <div class="faq_answer_container">
                    <div class="faq_answer">Először regisztrálnod kell az oldalra, majd bejelentkezés után a Kaland olvasása opcióra kattintani. Itt az adott kalandra kattintva tudod elkezdeni annak olvasását.</div>
                </div>
            </div>
            <div class="faq">
                <div class="faq_question">Hogyan tudok kalandot létrehozni?</div>
                <div class="faq_answer_container">
                    <div class="faq_answer">Először regisztrálnod kell az oldalra, majd bejelentkezés után a Kaland olvasása opcióra kattintani. Itt az alap adatok megadása után kezdheted el a saját kalandod írását.</div>
                </div>
            </div>
            <div class="faq">
                <div class="faq_question">Hogyan tudok regisztrálni?</div>
                <div class="faq_answer_container">
                    <div class="faq_answer">A Regisztráció menüre kattintva. Meg kell adndod egy nevet, e-mail címet, egy jelszót valamint a születési dátumod és a Regisztárlásra kattintva már tagja is vagy az oldalnak.</div>
                </div>
            </div>
            <div class="faq">
                <div class="faq_question">Hogyan tudok bejelentkezni?</div>
                <div class="faq_answer_container">
                    <div class="faq_answer">A Bejelentkezés menüre kattintva. Az e-mail címeddel és a jelszavaddal tudsz belépni az oldalra.</div>
                </div>
            </div>
            <div class="faq">
                <div class="faq_question">Mit tegyek, ha elfelejtettem a jelszavam?</div>
                <div class="faq_answer_container">
                    <div class="faq_answer">Az Elfelejtett jelszó opcióra kattintva tudsz új jelszót igényelni.</div>
                </div>
            </div>
        </div>
    </body>
</html>
