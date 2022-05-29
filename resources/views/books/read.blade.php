@extends('layouts.app')

<!-- Styles -->
<link href="{{ URL::asset('css/read.css') }}" rel="stylesheet">

@section('content')
    <div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <!-- Left-sidebar -->
                @if (!$book->disable_comments)
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="sidebar_title">Eddigi megjegyzések a könyvhöz</div><br>
                        @foreach ($book->comments as $comment)
                            <div class="comment">- {{ $comment->commentText }} </div><br>
                        @endforeach
                    </div>
                @else
                    <div class="col-md-3 col-sm-3 col-xs-3">
                        <div class="sidebar_title">Ennél a könyvnél le vannak tiltva a kommentek</div>
                    </div>
                @endif
                <!-- Content -->
                <div class="col-md-6 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="title">{{ $book->title }}</div>
                        </div>
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
                <!-- Right-sidebar -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                    @if (!$book->disable_ratings || !$book->disable_comments)
                        <div class="sidebar_title">Értekelje a könyvet vagy szóljon hozzá</div>
                        <div class="grid grid-cols-1 gap-3">
                            @auth
                                <div class="border px-3 py-2 border-gray-400">
                                    <form action="{{ route('ratings.store') }}" method="POST">
                                        @csrf
                                        <input name="id" value="{{ $book->id }}" type="hidden" />
                                        @if (!$book->disable_ratings)
                                            <div class="rating">
                                                <input type="radio" name="rating" value="5" id="5">
                                                <label for="5">☆</label>
                                                <input type="radio" name="rating" value="4" id="4">
                                                <label for="4">☆</label>
                                                <input type="radio" name="rating" value="3" id="3">
                                                <label for="3">☆</label>
                                                <input type="radio" name="rating" value="2" id="2">
                                                <label for="2">☆</label>
                                                <input type="radio" name="rating" value="1" id="1">
                                                <label for="1">☆</label>

                                            </div><br>
                                            @error('rating')
                                                <div class="alert alert-danger" style="margin-top: 2vw">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="col-span-1 px-2 py-4 bg-blue-100" style="font-weight:600">
                                                Ennél a történetnél le vannak tiltva az értéklelések!
                                            </div>
                                            <input name="rating" value="5" type="hidden" />
                                        @endif
                                        @if (!$book->disable_comments)
                                            <div class="comment-area">
                                                <textarea class="form-control" id="comment" name="comment" placeholder="Mi a véleménye a könyvről?"
                                                    rows="4"></textarea>
                                            </div>
                                        @else
                                            <div class="col-span-1 px-2 py-4 bg-blue-100">
                                                Ennél a könyvnél le vannak tiltva a megjegyzések!
                                            </div>
                                        @endif
                                        <div class="button_div">
                                            <button type="submit" class="submit"> Elküld </button>
                                        </div>
                                    </form>
                                    @if (Session::has('rating_created'))
                                        <div class="px-3 py-5 mb-5 bg-green-500 text-blue font-semibold">
                                            Az értékelés sikeresen megtörtént!
                                        </div>
                                    @endif
                                </div>
                            @endauth
                        </div>
                    @else
                        <div>
                            <div class="sidebar_title">Ennél a könyvnél le vannak tiltva az értékelések</div>
                        </div>
                    @endif
                    <div class="my-3">
                        <h3 class="font-semibold text-xl">Tartalom letöltése</h3>
                        <a href="{{ route('books.download', ['id' => $book->id]) }}"
                            class="text-blue-400 hover:text-blue-600 hover:underline"><i
                                class="fas fa-download">Letöltés</i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
