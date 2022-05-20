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
                    <div class="card-header">Összes történet</div>
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
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($stories as $story)
                                    <tr>
                                        <td><img src="{{ asset($story->coverPhoto ? 'storage/thumbnails/' . $story->coverPhoto : 'images/logo.png') }}"
                                                style="max-width: 100%">
                                        </td>
                                        <td>{{ $story->title }}</td>
                                        <td>{{ $story->author }}</td>
                                        <td>{{ $story->ageLimit }}</td>
                                        <td>{{ $story->created_at }}</td>
                                        @if (count($story->ratings) > 0)
                                            <td>{{ floor($story->ratings->sum('rating') / count($story->ratings)) }} / 5
                                            </td>
                                        @else
                                            <td>
                                                Nincs értékelve!
                                            </td>
                                        @endif

                                        <td>{{ count($story->ratings) }}</td>

                                        @if($story->owners->contains(Auth::user()))
                                            <td> <a href="{{ route('stories.readStory', $story->id) }}" class="text-black">Elolvas </a> </td>
                                        @else
                                            <td> <a href="{{ route('stories.addToOwnedStories', $story->id) }}" class="text-black">Hozzáadás a történeteimhez </a> </td>
                                        @endif
                                        @if(Auth::id() == $story->creator_id)
                                            @if(!($story->node_id == null))
                                                <td> <a href="{{ route('nodes.edit', $story->node_id) }}" class="text-black">Szerkesztés </a> </td>
                                            @else
                                                <td> <a href="{{ route('stories.getStory', $story->id) }}" class="text-black">Szerkesztés </a> </td>
                                            @endif
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
