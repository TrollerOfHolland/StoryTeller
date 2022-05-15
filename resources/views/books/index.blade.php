@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Összes könyv</div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Kép</th>
                                    <th scope="col">Cím</th>
                                    <th scope="col">Szerző</th>
                                    <th scope="col">Korhatár</th>
                                    <th scope="col">Kiállítás dátuma</th>
                                    <th scope="col">Értékelés</th>
                                    <th scope="col">Értékelések száma</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <td><img src="{{ asset($book->coverPhoto ? 'storage/thumbnails/' . $book->coverPhoto : 'images/logo.png') }}"
                                                class="min-h-48 h-48 max-h-48 object-cover">
                                        </td>
                                        <td>{{ $book->title }}</td>
                                        <td>{{ $book->author }}</td>
                                        <td>{{ $book->ageLimit }}</td>
                                        <td>{{ $book->created_at }}</td>
                                        <td>{{ $book->rating }}</td>
                                        <td>{{ $book->numOfRates }}</td>
                                        <td> <a href="{{ route('books.read', $book) }}"
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
