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
                                {{ $story->title }}
                            </div>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('nodes.update', $node->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <input name="story_id" value="{{ $story->id }}" type="hidden" />
                                <div>
                                    <label for="content" class="label">Cselekmény</label>
                                    <textarea rows="8" name="content" id="content" class="content" class="">{{ $node->content }}
                                    </textarea>
                                </div>
                                <div class="mb-5">
                                    <label for="option_one_text" class="label">Első opció</label><br>
                                    <input type="text" name="option_one_text" id="option_one_text"
                                        value="{{ $node->option_one_text }}" class="input">
                                    @error('option_one_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if ($node->option_one_text != null)
                                        @if (empty($node1->content))
                                            <a href="{{ route('nodes.create', $node1->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Első
                                                történetszál elkészítése
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('nodes.edit', $node1->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Első
                                                történetszál folytatása
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="mb-5">
                                    <label for="option_two_text" class="label">Második opció</label><br>
                                    <input type="text" name="option_two_text" id="option_two_text"
                                        value="{{ $node->option_two_text }}" class="input">
                                    @error('option_two_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if ($node->option_two_text != null)
                                        @if (empty($node2->content))
                                            <a href="{{ route('nodes.create', $node2->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Második
                                                történetszál elkészítése
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('nodes.edit', $node2->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Második
                                                történetszál folytatása
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                <div class="mb-5">
                                    <label for="option_three_text" class="label">Harmadik opció</label><br>
                                    <input type="text" name="option_three_text" id="option_three_text"
                                        value="{{ $node->option_three_text }}" class="input">
                                    @error('option_three_text')
                                        <p class="text-red-500">{{ $message }}</p>
                                    @enderror
                                    @if ($node->option_three_text != null)
                                        @if (empty($node3->content))
                                            <a href="{{ route('nodes.create', $node3->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Harmadik
                                                történetszál elkészítése
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('nodes.edit', $node3->id) }}"
                                                class="bg-blue-500 hover:bg-blue-600 px-1.5 py-1 text-black mt-3 font-semibold text-center">Harmadik
                                                történetszál folytatása
                                                <i class="fas fa-angle-right"></i>
                                            </a>
                                        @endif
                                    @endif
                                </div>
                                @if (!$node->parent_id == null)
                                    <div class="options">
                                        <label for="end">
                                            Történetszál vége
                                        </label>
                                        <input type="checkbox" id="end" name="end">
                                    </div>
                                @endif

                                @if (!$node->fixpoint)
                                    <div class="options">
                                        <label for="fixpoint">
                                            Megjelölés fixpontként
                                        </label>
                                        <input type="checkbox" id="fixpoint" name="fixpoint">
                                    </div>
                                @elseif(!$node->fixpoint && !$node->parent_id != null)
                                    <div class="options">
                                        <label for="fixpoint">
                                            Fixpont eltávolítása
                                        </label>
                                        <input type="checkbox" id="remove_fixpoint" name="remove_fixpoint">
                                    </div>
                                @endif
                                @if (!Session::has('story_created'))
                                    @if ($node->parent_id != null)
                                        <a href="{{ route('nodes.edit', $node->parent_id) }}" class="text-black"
                                            style="padding: 1vw">
                                            Vissza az előző ponthoz </a>
                                    @endif
                                @endif
                                @if (!$node->parent_id == null)
                                    <a href="{{ route('nodes.getFixpointWithoutDelete', $node->id) }}"
                                        class="text-black" style="padding: 1vw">
                                        Vissza a legkorábbi fixponthoz </a>
                                @endif
                                @if ($can_delete)
                                    <a href="{{ route('nodes.destroy', $node->id) }}" class="text-black"
                                        style="padding: 1vw">
                                        Pont törlése és visszaugrás az előző pontra </a>
                                @endif
                                <button type="submit" class="button">Mentés</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
