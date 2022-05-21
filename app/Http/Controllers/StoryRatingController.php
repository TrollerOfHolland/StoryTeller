<?php

namespace App\Http\Controllers;

use App\Models\StoryComment;
use App\Models\StoryRating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StoryRatingController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rating = $request->validate([
            'rating' => 'required|in:1,2,3,4,5'
        ], [
            'rating.required' => 'Kötelező megadni egy értékelést!'
        ]);
        $story_id = $request->input('story_id');
        $node_id = $request->input('node_id');
        $rating['user_id'] = Auth::id();
        $rating['story_id'] = $story_id;
        $new_rating = StoryRating::create($rating);
        $request->session()->flash('rating_created', true);
        if($request->filled('comment')) {
            $comment = [];
            $comment['user_id'] = Auth::id();
            $comment['story_id'] = $story_id;
            $comment['commentText'] = $request->input('comment');
            $new_comment = StoryComment::create($comment);
        }
        return redirect()->route('stories.readStory', $node_id);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

    }
}
