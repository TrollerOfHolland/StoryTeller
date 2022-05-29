<?php

namespace App\Http\Controllers;

use App\Models\Node;
use Illuminate\Http\Request;
use App\Models\Story;
use App\Models\StoryComment;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class StoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Displays all the stories from the database.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stories = Story::all();
        return view('stories.index', compact('stories'));
    }

    /**
     * Show the form for creating a new story.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('stories.store');
    }

    /**
     * Store a newly created story in the database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:128',
            'ageLimit' => 'required|min:1',
            'coverPhoto' => 'nullable|file|mimes:jpg,png|max:2048',
        ], [
            'title.required' => 'A történet címének megadása kötelező',
            'title.max' => 'A történet címének hossza max 255 karakter lehet',
            'author.required' => 'Az író nevének megadása kötelező',
            'author.max' => 'Az író nevének hossza max 128 karakter lehet',
            'ageLimit.required' => 'A korhatár megadása kötelező',
            'ageLimit.min' => 'A korhatárnak legalább 1-nek kell lennie',
            'coverPhoto.file' => 'Csak .png és .jpg állományt lehet feltölteni' ,
            'coverPhoto.mimes' => 'Csak .png és .jpg állományt lehet feltölteni' ,
            'coverPhoto.max' => 'A feltöltött kép max mérete 2MB lehet',

        ]);

        if ($request->hasFile('coverPhoto')) {
            $file = $request->file('coverPhoto');
            $data['coverPhoto'] = $file->hashName();
            Storage::disk('public')->put('thumbnails/' . $data['coverPhoto'], $file->get());
        }
        $data['creator_id'] = Auth::id();
        $story = Story::create($data);

        if ($request->has('disable_comments')) {
            $story['disable_comments'] = true;
        }

        if ($request->has('disable_ratings')) {
            $story['disable_ratings'] = true;
        }

        $story->save();
        $story->owners()->attach(Auth::user());


        $request->session()->flash('story_created', true);
        return view('nodes.store', compact('story'));
    }

    /**
     * Displays all the stories that are owned by the currently logged in user.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stories = User::find($id)->stories;
        return view('stories.show', compact('stories'));
    }

    /**
     * Returns the view for reading a story
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function readStory($id)
    {
        $node = Node::find($id);
        $story = Story::find($node->story_id);
        $comments = StoryComment::where('story_id', '=', $story->id)->get();

        if($node->content == null) {
            return view('stories.end', compact('story', 'node', 'comments'));
        }
        return view('stories.read', compact('story', 'node', 'comments'));
    }

    /**
     * Adds the specified story the owned books of the currently logged in user
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function addToOwnedStories($id)
    {
        $story = Story::find($id);
        $story->owners()->attach(Auth::user());

        return redirect()->route('stories.index');
    }

    /**
     * Returns the story when creating a new node
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getStory($id)
    {
        $story = Story::find($id);
        return view('nodes.store', compact('story'));
    }

    /**
     * Finds the closest fixpoint from the current node - for reading
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getFixpoint($id) {
        $current_node = Node::find($id);
        while(!$current_node->fixpoint) {
            $current_node = Node::find($current_node->parent_id);
        }
        return redirect()->route('stories.readStory', $current_node->id);
    }
}
