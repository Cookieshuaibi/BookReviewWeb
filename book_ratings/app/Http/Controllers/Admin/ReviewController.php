<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Books;
use App\Models\Reviews;

class ReviewController extends Controller
{
    public function index()
    {
        $books = Books::all();
        $reviews = Reviews::with('user')->with('reviewable')->paginate(10);
        return view('admin.reviews.index', compact('books', 'reviews'));
    }

    public function destroy($id)
    {
        $review = Reviews::find($id);
        $review->delete();
        return redirect()->route('admin.reviews.index')->with('success', 'Review deleted successfully');
    }
}