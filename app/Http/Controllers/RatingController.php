<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Comment;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RatingController extends Controller
{

    /**
     * Store a newly created rating and comment in the database.
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
        $id = $request->input('id');
        $rating['user_id'] = Auth::id();
        $rating['book_id'] = $id;
        $new_rating = Rating::create($rating);
        $request->session()->flash('rating_created', true);
        if($request->filled('comment')) {
            $comment = [];
            $comment['user_id'] = Auth::id();
            $comment['book_id'] = $id;
            $comment['commentText'] = $request->input('comment');
            $new_comment = Comment::create($comment);
        }
        return redirect()->route('books.read', $id);

    }

}
