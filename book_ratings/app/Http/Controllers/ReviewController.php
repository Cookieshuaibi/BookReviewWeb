<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Reviews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function index(Request $request){
        $books = Books::all();
        $reviews = Reviews::with('user')->with('reviewable')->paginate(10);
        return view('reviews.index', compact('books','reviews'));
    }
    public function update_review(Request $request, $id){
        $review = Reviews::with('reviewable')->find($id);
        if(Auth::user()->id!= $review->user_id){
            return redirect()->back();
        }
        if ($request->isMethod('post')|| $request->isMethod('put')) {
            $this->validate($request, [
                'rating' =>'required|integer|min:1|max:5',
               'comment' =>'required|max:255',
            ]);
            $review->rating = $request->rating;
            $review->comment = $request->comment;
            if($review->save())
            {
                return redirect()->route('books.show', $review->reviewable->id);
            }
        }
        return view('reviews.update_review', compact('review'));
    }

    public function delete_review(Request $request, $id){
        $review = Reviews::find($id);
        $review->delete();
        return redirect()->back();
    }
}