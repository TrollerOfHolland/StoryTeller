@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-9 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="card-header">{{ $book->title }}</div>
                        <div class="card-body">
                            @if ($type == 'text/plain')
                                @php
                                    $text = file_get_contents('storage/contents/' . $book->content);
                                    $text = nl2br($text);
                                    echo '<pre>'.$text.'</pre>';
                                @endphp
                            @else
                                <iframe src="{{ asset('storage/contents/' . $book->content) }}" width="100%"
                                    height="600"></iframe>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <h2 class="font-semibold text-3xl my-2">Értekelje a könyvet vagy szóljon hozzá</h2>
                    <div class="grid grid-cols-1 gap-3">
                        @auth
                            @if (!$book->disable_ratings && !$book->disable_comments)
                                <div class="border px-2.5 py-2 border-gray-400">
                                    <form action="{{ route('ratings.store') }}" method="POST">
                                        @csrf
                                        <input name="id" value="{{ $book->id }}" type="hidden" />
                                        @if (!$book->disable_ratings)
                                        <p style="padding-left: 10px"> Mennyire értékeled a könyvet? </p>
                                            <div class="mb-5" style="padding-left: 20px">
                                                <input type="radio" id="1" name="rating" value="1">
                                                <label for="1">1</label><br>
                                                <input type="radio" id="2" name="rating" value="2">
                                                <label for="2">2</label><br>
                                                <input type="radio" id="3" name="rating" value="3">
                                                <label for="3">3</label><br>
                                                <input type="radio" id="4" name="rating" value="4">
                                                <label for="4">4</label><br>
                                                <input type="radio" id="5" name="rating" value="5">
                                                <label for="5">5</label><br>
                                                @error('rating')
                                                    <p class="text-red-500">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        @else
                                            <div class="col-span-1 px-2 py-4 bg-blue-100">
                                                Ennél a könyvnél le vannak tiltva az értéklelések!
                                            </div>
                                        @endif
                                        @if (!$book->disable_comments)
                                            <div class="mb-5">
                                                <label for="text" class="block text-lg font-medium text-gray-700" style="padding-left: 10px">
                                                    Egyéb megjegyzések</label>
                                                <textarea rows="4" name="comment" id="comment" style="width: 90%"
                                                    class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm ">{{ old('comment') }}</textarea>
                                            </div>
                                        @else
                                            <div class="col-span-1 px-2 py-4 bg-blue-100">
                                                Ennél a könyvnél le vannak tiltva a kommentek!
                                            </div>
                                        @endif
                                        <button type="submit"
                                            class="mt-6 bg-blue-500 hover:bg-blue-600 text-gray-100 font-semibold px-2 py-1 text-xl">Elküld</button>
                                    </form>
                                    @if (Session::has('rating_created'))
                                        <div class="px-3 py-5 mb-5 bg-green-500 text-blue font-semibold">
                                            Az értékelés sikeresen megtörtént!
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endauth
                    </div>
                    <div class="my-3">
                        <h3 class="font-semibold text-xl">Tartalom letöltése</h3>
                        <a href="{{ route('books.download', ['id' => $book->id]) }}" class="text-blue-400 hover:text-blue-600 hover:underline"><i class="fas fa-download">Letöltés</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
