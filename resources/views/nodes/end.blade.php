@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="card-header">{{ $story->title }} </div>
                        <div class="card-body" style="text-align: center">
                            {{ $node->content }}
                            <form action="{{ route('nodes.end', $node->id) }}" method="GET">
                                @csrf
                                @if (!Session::has('story_created'))
                                    @if ($node->parent_id != null)
                                        <a href="{{ route('nodes.edit', $node->parent_id) }}" class="text-black"
                                            style="padding: 1vw">
                                            Vissza az előző ponthoz </a>
                                    @endif
                                @endif
                                <label for="open">
                                    Történetszál megnyitása újra?
                                </label>
                                <input type="checkbox" id="open" name="open">
                                <button type="submit"
                                    class="mt-6 bg-blue-500 hover:bg-blue-600 text-gray-100 font-semibold px-2 py-1 text-xl">Mentés</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
