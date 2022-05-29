@extends('layouts.app')

<link href="{{ URL::asset('css/book.css') }}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="title">
                            Könyv feltöltése
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="container mx-auto p-3 lg:px-36 overflow-hidden min-h-screen">
                            <div class="mb-5">
                                <h3 class="desc">Ezen az oldalon tudsz új könyvet feltölteni az oldalra</h3>
                            </div>
                            <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-5">
                                    <label for="title" class="label">Könyv címe</label>
                                    <input type="text" name="title" id="title" value="{{ old('title') }}"
                                        style="width: 100%;" class="input">
                                    @error('title')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="author" class="label">Könyv szerzője</label>
                                    <input type="text" name="author" id="author" value="{{ old('author') }}"
                                        style="width: 100%;" class="input">
                                    @error('author')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <label for="ageLimit" class="label">Korhatár</label><br>
                                    <input type="number" name="ageLimit" id="ageLimit" min="1"
                                        value="{{ old('ageLimit') }}" style="width: 20%;" class="input">
                                    @error('ageLimit')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="mb-5">
                                    <div class="options">
                                        <label for="disable_comments">
                                            Hozzászólások kikapcsolása
                                        </label>
                                        <input type="checkbox" id="disable_comments" name="disable_comments"
                                            {{ old('disable_comments') ? 'checked' : '' }}>
                                    </div>
                                    <div class="options">
                                        <label for="disable_ratings">
                                            Értékelések kikapcsolása
                                        </label>
                                        <input type="checkbox" id="disable_ratings" name="disable_ratings"
                                            {{ old('disable_ratings') ? 'checked' : '' }}>
                                    </div>
                                    <div class="alert alert-info">
                                        Az értékelések kikapcsolásával, automatikusan 5-ös értékelést kap a könyv ha a
                                        felhasználó kommentet ír hozzá
                                    </div>
                                    <div>
                                        <label for="coverPhoto" class="options" style="width: 100%;">Kép feltöltése a
                                            könyvhöz</label>
                                        <input type="file" class="form-control-file" id="coverPhoto" name="coverPhoto"
                                            title=" " >
                                        @error('coverPhoto')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror

                                        <label for="content" class="options" style="width: 100%;">Könyv tartalmának
                                            feltöltése</label>
                                        <input type="file" class="form-control-file" id="content" name="content" title=" "
                                            >
                                        @error('content')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                    </div>
                                </div>
                                <br><button type="submit" class="button">Létrehozás</button>
                            </form>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>
@endsection
