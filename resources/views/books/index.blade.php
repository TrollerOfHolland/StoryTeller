@extends('layouts.app')
<style>
    table {
        table-layout: fixed;
        width: 100%;
    }

    th {
        text-align: center;
    }

    td {
        width: 25%;
        text-align: center;
        vertical-align: middle;
    }

</style>
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
                                            <td>{{ floor($book->ratings->sum('rating') / count($book->ratings)) }} / 5
                                            </td>
                                        @else
                                            <td>
                                                Nincs értékelve!
                                            </td>
                                        @endif
                                        <td>{{ count($book->ratings) }}</td>

                                        @if($book->owners->contains(Auth::user()))
                                            <td> <a href="{{ route('books.read', $book->id) }}" class="text-black">Elolvas </a></td>
                                        @else
                                            <td> <a href="{{ route('books.addToOwnedBooks', $book->id) }}" class="text-black">Hozzáadás a könyveimhez</a></td>
                                        @endif
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
