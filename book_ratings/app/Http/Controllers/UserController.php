<?php
namespace App\Http\Controllers;

//use App\Models\Role;
use App\Models\Books;
use App\Models\Reviews;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function Profile(Request $request)
    {
        $user_id = Auth::user()->id;
//        $user = User::with(['reviews','reviews.reviewable','books'])->where('id',$user_id)->paginate(10);
//        dd($user);exit;
        $user = User::find($user_id);
        $reviews = Reviews::with('reviewable')->where('user_id', $user_id)->paginate(10);
        $books = Books::where('user_id', $user_id)->paginate(10);
        return view('user.profile', compact('user','reviews', 'books'));
    }
    public function myReviews(Request $request){
        $user_id = Auth::user()->id;
        $user = User::with(['reviews','reviews.reviewable'])->find($user_id);
        $reviews = Reviews::with('reviewable')->where('user_id', $user_id)->paginate(10);
        return view('user.my_reviews', compact('user','reviews'));
    }

    public function show(Request $request, User $user)
    {
        if (!$user) {
            abort(404);
        }

       $booksPublished = $user->books()->paginate(5, ['*'], 'books_page'); // 使用 'books_page' 作为页码参数

       $bookReviews = $user->reviews()->with('reviewable')->paginate(5, ['*'], 'reviews_page'); // 使用 'reviews_page' 作为页码参数

        return view('user.show', compact('user', 'booksPublished', 'bookReviews'));
    }
}