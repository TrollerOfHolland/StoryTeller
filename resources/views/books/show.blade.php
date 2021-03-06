@extends('layouts.app')

<link href="{{ URL::asset('css/list.css') }}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="title">
                            Könyveim
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col" class="text-center">Kép</th>
                                    <th scope="col" class="text-center">Cím</th>
                                    <th scope="col" class="text-center">Szerző</th>
                                    <th scope="col" class="text-center">Korhatár</th>
                                    <th scope="col" class="text-center">Kiállítás dátuma</th>
                                    <th scope="col" class="text-center">Értékelés</th>
                                    <th scope="col" class="text-center">Értékelések száma</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td><img src="{{ asset($book->coverPhoto ? 'storage/thumbnails/' . $book->coverPhoto : 'images/logo.png') }}"
                                                style="max-width: 100%">
                                        </td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->ageLimit }}</td>
                                        <td>{{ $book->created_at }}</td>
                                        @if (count($book->ratings) > 0)
                                            <td>{{ floor($book->ratings->sum('rating') / count($book->ratings)) }} / 5</td>
                                        @else
                                            <td>
                                                Nincs értékelve!
                                            </td>
                                        @endif
                                        <td>{{ count($book->ratings) }}</td>
                                        <td> <a href="{{ route('books.read', $book->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Elolvas
                                                <i class="fas fa-angle-right"></i>
                                            </a></td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
