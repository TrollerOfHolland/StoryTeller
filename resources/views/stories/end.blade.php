@extends('layouts.app')

<!-- Styles -->
<link href="{{ URL::asset('css/read.css') }}" rel="stylesheet">
<style>

</style>
@section('content')
    <div>
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="row">
                <!-- Left-sidebar -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="sidebar_title">Eddigi megjegyzések a történethez</div><br>
                    @foreach ($story->comments as $comment)
                        <div class="comment">- {{ $comment->commentText }} </div><br>
                    @endforeach
                </div>
                <div class="col-md-6 col-sm-9 col-xs-9">
                    <div class="card">
                        <div class="card-header"><div class="title">{{ $story->title }}</div></div>
                        <div class="card-body">
                            <p>Elérted az adott történetszál végét!</p>
                            @if ($node->parent_id != null)
                                <div class="return">
                                    <a href="{{ route('stories.readStory', $node->parent_id) }}" class="button"> Kattints ide a visszalépéshez </a>
                                    <a href="{{ route('stories.readStory', $story->node_id) }}" class="button" > Kattints ide ha visszaszeretnél menni a történet elejére </a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right-sidebar -->
                <div class="col-md-3 col-sm-3 col-xs-3">
                    <div class="sidebar_title">Értekelje a történetet vagy szóljon hozzá</div>
                    <div class="grid grid-cols-1 gap-3">
                        @auth
                            @if (!$story->disable_ratings && !$story->disable_comments)
                                <div class="border px-3 py-2 border-gray-400">
                                    <form action="{{ route('story_ratings.store') }}" method="POST">
                                        @csrf
                                        <input name="story_id" value="{{ $story->id }}" type="hidden" />
                                        <input name="node_id" value="{{ $node->id }}" type="hidden" />
                                        @if (!$story->disable_ratings)
                                            <div class="rating">
                                                <input type="radio" name="rating" value="5" id="5">
                                                <label for="5">☆</label>
                                                <input type="radio" name="rating" value="4" id="4">
                                                <label for="4">☆</label>
                                                <input type="radio" name="rating" value="3" id="3">
                                                <label for="3">☆</label>
                                                <input type="radio" name="rating" value="2" id="2">
                                                <label for="2">☆</label>
                                                <input type="radio" name="rating" value="1" id="1">
                                                <label for="1">☆</label>

                                            </div><br>
                                            @error('rating')
                                                <div class="alert alert-danger" style="margin-top: 2vw">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        @else
                                            <div class="col-span-1 px-2 py-4 bg-blue-100">
                                                Ennél a történetnél le vannak tiltva az értéklelések!
                                            </div>
                                        @endif
                                        @if (!$story->disable_comments)
                                            <div class="comment-area">
                                                <textarea class="form-control" id="comment" name="comment" placeholder="Mi a véleménye a történetről?"
                                                    rows="4"></textarea>
                                            </div>
                                        @else
                                            <div class="col-span-1 px-2 py-4 bg-blue-100">
                                                Ennél a történetnél le vannak tiltva a megjegyzések!
                                            </div>
                                        @endif
                                        <div class="button_div">
                                            <button type="submit" class="submit"> Elküld </button>
                                        </div>
                                    </form>
                                    @if (Session::has('rating_created'))
                                        <div class="px-3 py-5 mb-5 bg-green-500 text-blue font-semibold">
                                            Az értékelés sikeresen megtörtént!
                                        </div>
                                    @endif
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
