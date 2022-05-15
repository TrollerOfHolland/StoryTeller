<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    public function index()
    {
        $books = Book::all();
        return view('books.index', compact('books'));
    }

    public function show($id)
    {
        $books = Book::where('author_id', $id)->get();
        return view('books.show', compact('books'));
    }

    public function create() {
        return view('books.store');
    }

    public function store(Request $request)
    {

        $data = $request->validate([
            'title' => 'required|max:255',
            'author' => 'required|max:128',
            'ageLimit' => 'required|min:1',
            'coverPhoto' => 'nullable|file|mimes:jpg,png|max:2048',
        ], [
            'title.required' => 'A film cím megadása kötelező',
        ]);

        $data['disable_comments'] = false;
        if ($request->has('disable_comments')) {
            $data['disable_comments'] = true;
        }

        $data['author_id'] = Auth::id();

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
        $request->session()->flash('book_created', true);
        return redirect()->route('books.index');
    }

    public function read(Book $book) {

        return view('books.read');
    }
}
