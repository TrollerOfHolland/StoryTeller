<!DOCTYPE html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{!! asset('images/logo.png') !!}" />

    <title>Gyakran Ismételt Kérdések</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    <style>

        .logo {
            max-width: 40%;
        }

        .faq_question {
            margin-top: 1vh;
            padding: 0px 0px 5px 0px;
            display: inline-block;
            cursor: pointer;
            font-weight: bold;
            font-size: 2vw;
        }

        b {
            font-size: 1vw;
            font-weight: 600;
        }

    </style>

</head>
@extends('layouts.app')
@section('content')
    <div class="jumbotron p-2">
        <h1>Gyakran Ismételt Kérdések</h1>
    </div>
    <div class="container ml-0">
        <div class="faq">
            <div class="faq_question open">Mi az a StoryTeller?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">A StoryTeller egy olyan oldal, amelyen interaktív történeteket és elekronikus
                    könyveket lehet készíteni, illetve olvasni. Nem kell mást tenned, mint regisztrálni, majd bejelentkezés
                    után szabadon válogathatsz a mások által írt történetek és könyvek között. Amennyiben pedig van egy jó ötleted,
                    megalkothatod az elképzelt történetedet.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Hogyan tudok történetet olvasni?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">Először regisztrálnod kell az oldalra, majd bejelentkezés után az <b>Összes Történet</b> opcióra kattintani. <br>
                    Itt az <b>Elolvas</b> gombra kattintva tudod elkezdeni annak olvasását vagy <b>A hozzáadás a történeteimhez</b> gombal feliratkozni rá.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Hogyan tudok történetet létrehozni?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">Először regisztrálnod kell az oldalra, majd bejelentkezés után a <b>Történet Létrehozása</b>
                    opcióra kattintani. Itt az alap adatok megadása után kezdheted el a saját történeted írását.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Hogyan tudok könyvet olvasni?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">Először regisztrálnod kell az oldalra, majd bejelentkezés után az <b>Összes Könyv</b>opcióra kattintani. <br>
                    Itt az <b>Elolvas</b> gombra kattintva tudod elkezdeni annak olvasását vagy <b>A hozzáadás a könyveimhez</b> gombal feliratkozni rá.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Hogyan tudok könyvet feltölteni?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">Először regisztrálnod kell az oldalra, majd bejelentkezés után a <b>Könyv Létrehozása</b>
                    opcióra kattintani. Itt az alap adatok megadása után feltöltheted a könyvedet.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Milyen formátumban lehet könyvet feltölteni?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">Könyv feltöltésénél csak <b>.txt</b> és <b>.pdf</b> formátumú file-okat tudsz feltölteni mint tartalom.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Hogyan tudok regisztrálni?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">A Regisztráció menüre kattintva. Meg kell adndod egy nevet, e-mail címet, egy
                    jelszót valamint a születési dátumod és a Regisztárlásra kattintva már tagja is vagy az oldalnak.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Hogyan tudok bejelentkezni?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">A Bejelentkezés menüre kattintva. Az e-mail címeddel és a jelszavaddal tudsz
                    belépni az oldalra.</div>
            </div>
        </div>
        <div class="faq">
            <div class="faq_question">Mit tegyek, ha elfelejtettem a jelszavam?</div>
            <div class="faq_answer_container">
                <div class="faq_answer">Az Elfelejtett jelszó opcióra kattintva tudsz új jelszót igényelni.</div>
            </div>
        </div>
    </div>
@endsection
