@extends('layouts.app')

<link href="{{ URL::asset('css/node.css') }}" rel="stylesheet">

@section('content')
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                @if (session()->has('missing_options'))
                    <div class="alert alert-danger">
                        {{ session()->get('missing_options') }}
                    </div>
                @endif
                @if (session()->has('advice'))
                    <div class="alert alert-info">
                        {{ session()->get('advice') }}
                    </div>
                @endif
                <div class="col-md-12 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="card-header">
                            <div class="title">
                                Történet pont létrehozása a(z) {{ $story->title }} történethez
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('nodes.store') }}" method="POST">
                                @csrf
                                @if (!Session::has('story_created') && $story->node_id != null)
                                    @if ($node->parent_id != null)
                                        <input name="node_id" value="{{ $node->id }}" type="hidden" />
                                    @endif
                                @endif
                                <input name="story_id" value="{{ $story->id }}" type="hidden" />
                                <div>
                                    @if (!Session::has('story_created') && $story->node_id != null)
                                        @if ($node->parent_id != null)
                                            <label for="content" class="label">Cselekmény</label>
                                            <textarea rows="8" name="content" id="content" class="content" class="">{{ $node->content }}</textarea>
                                        @endif
                                    @else
                                        <label for="content" class="label">Cselekmény</label>
                                        <textarea rows="8" name="content" id="content" class="content" class="">{{ $node->content }}</textarea>
                                    @endif
                                </div>
                                <div class="mb-5">
                                    <label for="option_one_text" class="label">Első opció</label><br>
                                    <input type="text" name="option_one_text" id="option_one_text"
                                        value="{{ $node->option_one_text }}" class="input">
                                    @error('option_one_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="option_two_text" class="label">Második opció</label><br>
                                    <input type="text" name="option_two_text" id="option_two_text"
                                        value="{{ $node->option_two_text }}" class="input">
                                    @error('option_two_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <div class="mb-5">
                                        <label for="option_three_text" class="label">Harmadik opció</label><br>
                                        <input type="text" name="option_three_text" id="option_three_text"
                                            value="{{ $node->option_three_text }}" class="input">
                                        @error('option_three_text')
                                            <p class="text-red-500">{{ $message }}</p>
                                        @enderror
                                </div>

                                @if (!Session::has('story_created') && $story->node_id != null)
                                    @if ($node->parent_id != null)
                                        <a href="{{ route('nodes.edit', $node->parent_id) }}" class="text-black" style="padding: 1vw">
                                            Vissza az előző ponthoz </a>
                                    @endif
                                @endif
                                <button type="submit" class="button">Létrehozás</button>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
