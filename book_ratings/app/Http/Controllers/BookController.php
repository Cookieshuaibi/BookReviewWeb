<?php

namespace App\Http\Controllers;

use App\Models\Reviews;
use App\Models\User;
use App\Notifications\NewReviewNotification;
use Illuminate\Http\Request;
use App\Models\Books;
use App\Events\ReviewPosted;
use App\Events\ReviewCreated;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{
    public function show(request $request, $book_id)
    {
        $book = Books::with(['reviews' => function ($query) {
            $query->latest()->take(10); // get latest 10 reviews
        }])->find($book_id);
        return view('book.show', compact('book'));
    }

    public function create(request $request)
    {
        if (Auth::check() && !(Auth::user()->hasRoles('admin') || Auth::user()->hasRoles('author'))) {
            abort(403);
        }
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
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
            $book->title = $validatedData['title'];
            $book->author = $validatedData['author'];
            $book->summary = $validatedData['summary'];
            $book->average_rating = $validatedData['average_rating'];
            $book->image_url = $imagePath;
            $book->description = $validatedData['description'];
            $book->genre = $validatedData['genre'];
            $book->year = $validatedData['year'];
            $book->publisher = $validatedData['publisher'];
            $book->language = $validatedData['language'];
            $book->isbn = $validatedData['isbn'];
            $book->user_id = Auth()->user()->id;
            if ($book->save()) {
                return redirect()->route('books.index');
            }
        }
        return view('book.create');
    }

    public function edit(request $request, $book_id)
    {
        $book = Books::find($book_id);
        if (Auth::check() && !(Auth::user()->hasRoles('admin') || Auth::user()->hasRoles('author'))) {
            abort(403);
        }
        if ($book->user_id !== Auth()->user()->id) {
            abort(403);
        }
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
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

            if ($request->hasFile('image_url')) {
                $imagePath = $request->file('image_url')->store('public/images');
            } else {
                $imagePath = $book->image_url;
            }

            $book->title = $validatedData['title'];
            $book->author = $validatedData['author'];
            $book->summary = $validatedData['summary'];
            $book->average_rating = $validatedData['average_rating'];
            $book->image_url = $imagePath;
            $book->description = $validatedData['description'];
            $book->genre = $validatedData['genre'];
            $book->year = $validatedData['year'];
            $book->publisher = $validatedData['publisher'];
            $book->language = $validatedData['language'];
            $book->isbn = $validatedData['isbn'];
            if ($book->save()) {
                return redirect()->route('books.index');
            }
        }
        return view('book.edit', compact('book'));
    }

    public function delete(request $request, $book_id)
    {
        if (Auth::check() && !(Auth::user()->hasRoles('admin') || Auth::user()->hasRoles('author'))) {
            abort(403);
        }
        $book = Books::find($book_id);
        if ($book->user_id !== Auth()->user()->id) {
            abort(403);
        }
        if ($book->delete()) {
            return redirect('/books');
        }
    }

    public function index(request $request)
    {
        $books = Books::orderBy('id', 'desc')->paginate(12);
        return view('book.index', compact('books'));
    }

    public function add_review(Request $request, $book_id)
    {
        if (Auth::guest()) {
            return response()->json(['success' => false, 'message' => 'You need to login to add review.']);
        }
        $book = Books::find($book_id);
        if ($request->isMethod('post')) {
            $validatedData = $request->validate([
                'rating' => 'required|numeric|min:1|max:5',
                'comment' => 'required|string|max:255',
            ]);

            $review = new Reviews();
            $review->user_id = Auth()->user()->id;
            $review->rating = $validatedData['rating'];
            $review->comment = $validatedData['comment'];

            if ($book->reviews()->save($review)) {
                $user = User::find($review->user_id);
                $review->with('reviewable');
                $user->notify(new NewReviewNotification($review));
                $book->average_rating = $book->reviews()->avg('rating');
                $book->save();
                return response()->json([
                    'success' => true,
                    'message' => 'Review added successfully!',
                    'data' => ['user_url' => route('users.show', $review->user_id), 'rating' => $review->rating, 'comment' => $review->comment, 'user_name' => $review->user->name, 'created_at' => $review->created_at->diffForHumans()],
                    'average_rating' => $book->average_rating,
                ]);
            } else {
                return response()->json(['success' => false, 'message' => 'Failed to add review.']);
            }
        }

        return view('book.add_review', compact('book'));
    }

    public function reviews(Request $request, $book_id)
    {
        $book = Books::find($book_id);
        $reviews = $book->reviews()->paginate(10);
        return view('book.reviews', compact('book', 'reviews'));
    }

}