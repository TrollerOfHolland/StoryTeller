<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\User;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }
    /**
     * Displays all the books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }
    /**
     * Displays all the owned books.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $books = User::find($id)->books;
        return view('books.show', compact('books'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.store');
    }
    /**
     * Store a newly created resource in storage.
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
            'content' => 'required|file|mimes:txt,pdf',
        ], [
            'title.required' => 'A könyv címének megadása kötelező',
            'title.max' => 'A könyv címének hossza max 255 karakter lehet',
            'author.required' => 'Az író nevének megadása kötelező',
            'author.max' => 'Az író nevének hossza max 128 karakter lehet',
            'ageLimit.required' => 'A korhatár megadása kötelező',
            'ageLimit.min' => 'A korhatárnak legalább 1-nek kell lennie',
            'coverPhoto.file' => 'Csak .png és .jpg állományt lehet feltölteni' ,
            'coverPhoto.mimes' => 'Csak .png és .jpg állományt lehet feltölteni' ,
            'coverPhoto.max' => 'A feltöltött kép max mérete 2MB lehet',
            'content.required' => 'A könyv tartalmának megadása kötelező',
            'content.file' => 'Csak .txt és .pdf állományt lehet feltölteni' ,
            'content.mimes' => 'Csak .txt és .pdf állományt lehet feltölteni' ,

        ]);

        $data['disable_comments'] = false;
        if ($request->has('disable_comments')) {
            $data['disable_comments'] = true;
        }

        $data['disable_ratings'] = false;
        if ($request->has('disable_ratings')) {
            $data['disable_ratings'] = true;
        }

        if ($request->hasFile('coverPhoto')) {
            $file = $request->file('coverPhoto');
            $data['coverPhoto'] = $file->hashName();
            Storage::disk('public')->put('thumbnails/' . $data['coverPhoto'], $file->get());
        }

        if ($request->hasFile('content')) {
            $file = $request->file('content');
            $data['content'] = $file->hashName();
            Storage::disk('public')->put('contents/' . $data['content'], $file->get());
        }

        $book = Book::create($data);
        $book->save();
        $book->owners()->attach(Auth::user());
        $request->session()->flash('book_created', true);
        return redirect()->route('books.index');
    }
    /**
     * Returns the view form for a specific book
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function read($id)
    {
        $book = Book::find($id);
        $type = mime_content_type('storage/contents/'. $book->content);
        return view('books.read', compact('book', 'type'));
    }
    /**
     * Downloads the specific resource from the Storage
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function download($id)
    {
        $book = Book::find($id);
        if ($book === null || $book->content === null) {
            return abort(404);
        }
        return Storage::disk('public')->download('contents/' . $book['content']);
    }

    public function addToOwnedBooks($id)
    {
        $book = Book::find($id);
        $book->owners()->attach(Auth::user());

        return redirect()->route('books.index');
    }

}
