@extends('layouts.app')

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
                        <div class="card-header">Történet pont létrehozása a(z) {{ $story->title }} történethez</div>
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
                                    <label for="content" class="block text-lg font-medium text-gray-700"
                                        style="padding-left: 10px">
                                        Cselekmény</label>
                                    @if (!Session::has('story_created') && $story->node_id != null)
                                        @if ($node->parent_id != null)
                                            <textarea rows="8" name="content" id="content" style="width: 100%"
                                                class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm "> {{ $node->content }}
                                            </textarea>
                                        @endif
                                    @else
                                        <textarea rows="8" name="content" id="content" style="width: 100%"
                                            class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm ">
                                        </textarea>
                                    @endif

                                </div>
                                <div class="mb-5">
                                    <label for="option_one_text" class="block text-lg font-medium text-gray-700">Első
                                        opció</label><br>
                                    <input type="text" name="option_one_text" id="option_one_text"
                                        value="{{ old('option_one_text') }}" style="width: 70%;"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('option_one_text') border-red-400 @else border-gray-400 @enderror">
                                    @error('option_one_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="option_two_text" class="block text-lg font-medium text-gray-700">Második
                                        opció</label><br>
                                    <input type="text" name="option_two_text" id="option_two_text"
                                        value="{{ old('option_two_text') }}" style="width: 70%;"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('option_two_text') border-red-400 @else border-gray-400 @enderror">
                                    @error('option_two_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <div class="mb-5">
                                    <label for="option_three_text" class="block text-lg font-medium text-gray-700">Harmadik
                                        opció</label><br>
                                    <input type="text" name="option_three_text" id="option_three_text"
                                        value="{{ old('option_three_text') }}" style="width: 70%;"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('option_three_text') border-red-400 @else border-gray-400 @enderror">
                                    @error('option_three_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                                <button type="submit"
                                    class="mt-6 bg-blue-500 hover:bg-blue-600 text-gray-100 font-semibold px-2 py-1 text-xl">Létrehozás</button>
                                @if (!Session::has('story_created') && $story->node_id != null)
                                    @if ($node->parent_id != null)
                                        <a href="{{ route('nodes.edit', $node->parent_id) }}" class="btn btn-default">
                                            Vissza az előző ponthoz </a>
                                    @endif
                                @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
