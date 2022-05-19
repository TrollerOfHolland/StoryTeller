@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <div class="col-md-12 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="card-header">{{ $story->title }} </div>
                        <div class="card-body">
                            <form action="{{ route('nodes.update', $node->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input name="story_id" value="{{ $story->id }}" type="hidden" />
                                <div>
                                    <label for="content" class="block text-lg font-medium text-gray-700"
                                        style="padding-left: 10px">
                                        Cselekmény</label>
                                    <textarea rows="8" name="content" id="content" style="width: 100%"
                                        class="mt-1 focus:ring-blue-500 focus:border-blue-500 block w-full shadow-sm sm:text-sm ">{{ $node->content }}
                                    </textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="option_one_text" class="block text-lg font-medium text-gray-700">Első
                                        opció</label><br>
                                    <input type="text" name="option_one_text" id="option_one_text"
                                        value="{{ $node->option_one_text }}" style="width: 70%;"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('option_one_text') border-red-400 @else border-gray-400 @enderror">
                                    @error('option_one_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if (empty($node1->content))
                                        <a href="{{ route('nodes.create', $node1->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Első
                                            történetszál folytatása
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('nodes.edit', $node1->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Első
                                            történetszál folytatása
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="mb-5">
                                    <label for="option_two_text" class="block text-lg font-medium text-gray-700">Második
                                        opció</label><br>
                                    <input type="text" name="option_two_text" id="option_two_text"
                                        value="{{ $node->option_two_text }}" style="width: 70%;"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('option_two_text') border-red-400 @else border-gray-400 @enderror">
                                    @error('option_two_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if (empty($node2->content))
                                        <a href="{{ route('nodes.create', $node2->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Második
                                            történetszál folytatása
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('nodes.edit', $node2->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Második
                                            történetszál folytatása
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @endif
                                </div>
                                <div class="mb-5">
                                    <label for="option_three_text" class="block text-lg font-medium text-gray-700">Harmadik
                                        opció</label><br>
                                    <input type="text" name="option_three_text" id="option_three_text"
                                        value="{{ $node->option_three_text }}" style="width: 70%;"
                                        class="mt-2 focus:ring-blue-500 focus:border-blue-500 block shadow-sm sm:text-sm @error('option_three_text') border-red-400 @else border-gray-400 @enderror">
                                    @error('option_three_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if (empty($node3->content))
                                        <a href="{{ route('nodes.create', $node3->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Harmadik
                                            történetszál folytatása
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('nodes.edit', $node3->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Harmadik
                                            történetszál folytatása
                                            <i class="fas fa-angle-right"></i>
                                        </a>
                                    @endif
                                </div>
                                <button type="submit"
                                    class="mt-6 bg-blue-500 hover:bg-blue-600 text-gray-100 font-semibold px-2 py-1 text-xl">Mentés</button>
                                @if (!Session::has('story_created'))
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
