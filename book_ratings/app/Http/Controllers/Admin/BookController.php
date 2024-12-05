<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Books;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $books = Books::orderBy('id', 'desc')->paginate(12);
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'average_rating' => 'required|numeric',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2025',
            'publisher' => 'required|string|max:255',
            'language' => 'required|string|max:255|in:en,fr,es,de,it,sp,iu',
            'isbn' => 'required|string|max:25',
        ]);

        $imagePath = $request->file('image_url')->store('public/images');

        $book = new Books();
        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->summary = $request['summary'];
        $book->average_rating = $request['average_rating'];
        $book->image_url = $imagePath;
        $book->description = $request['description'];
        $book->genre = $request['genre'];
        $book->year = $request['year'];
        $book->publisher = $request['publisher'];
        $book->language = $request['language'];
        $book->isbn = $request['isbn'];
        $book->user_id = Auth()->user()->id;
        if($book->save()){
            return redirect()->route('admin.books.index');
        }
        return redirect()->route('admin.books.index')->with('success', 'Book created successfully');
    }

    public function edit($id)
    {
        $book = Books::find($id);
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'summary' => 'required|string|max:255',
            'average_rating' => 'required|numeric',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'description' => 'required|string',
            'genre' => 'required|string|max:255',
            'year' => 'required|integer|min:1900|max:2025',
            'publisher' => 'required|string|max:255',
            'language' => 'required|string|max:255|in:en,fr,es,de,it,sp,iu',
            'isbn' => 'required|string|max:25',
        ]);

        $book = Books::find($id);
        if($request->hasFile('image_url')){
            $imagePath = $request->file('image_url')->store('public/images');
        }else{
            $imagePath = $book->image_url;
        }

        $book->title = $request['title'];
        $book->author = $request['author'];
        $book->summary = $request['summary'];
        $book->average_rating = $request['average_rating'];
        $book->image_url = $imagePath;
        $book->description = $request['description'];
        $book->genre = $request['genre'];
        $book->year = $request['year'];
        $book->publisher = $request['publisher'];
        $book->language = $request['language'];
        $book->isbn = $request['isbn'];
        if($book->save()){
            return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
        }
    }

    public function show($id){
        echo "show";exit;
        $book = Books::find($id);
        return view('admin.books.show', compact('book'));
    }
    public function destroy($id)
    {
        $book = Books::find($id);
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }

}
