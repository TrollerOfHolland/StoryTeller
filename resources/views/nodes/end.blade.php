@extends('layouts.app')

<link href="{{ URL::asset('css/node.css') }}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="title">
                                {{ $story->title }}
                            </div>
                        </div>
                        <div class="card-body" style="text-align: center">
                            <div class="content">
                                {{ $node->content }}
                            </div>
                            <form action="{{ route('nodes.end', $node->id) }}" method="GET">
                                @csrf
                                @if (!Session::has('story_created'))
                                    @if ($node->parent_id != null)
                                        <a href="{{ route('nodes.edit', $node->parent_id) }}" class="text-black"
                                            style="padding: 1vw">
                                            <br> Vissza az előző ponthoz </a> <br>
                                    @endif
                                @endif
                                <div class="options">
                                    <label for="open">
                                        Történetszál megnyitása újra?
                                    </label>
                                    <input type="checkbox" id="open" name="open">
                                </div>
                                <button type="submit" class="button">Mentés</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
