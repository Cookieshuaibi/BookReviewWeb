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
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $imageName);
        $book = new Books();
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        $book->image = $imageName;
        $book->save();
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
            'title' => 'required',
            'author' => 'required',
            'description' => 'required',
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $book = Books::find($id);
        $book->title = $request->title;
        $book->author = $request->author;
        $book->description = $request->description;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $book->image = $imageName;
        }
        $book->save();
        return redirect()->route('admin.books.index')->with('success', 'Book updated successfully');
    }

    public function destroy($id)
    {
        $book = Books::find($id);
        $book->delete();
        return redirect()->route('admin.books.index')->with('success', 'Book deleted successfully');
    }

}
