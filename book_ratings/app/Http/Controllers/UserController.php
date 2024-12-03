<?php
namespace App\Http\Controllers;

//use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function Profile(Request $request)
    {
        $user_id = auth()->user()->id;
        $user = User::with('reviews')->find($user_id);
        return view('user.profile', compact('user'));
    }
    public function myReviews(Request $request){
        $user_id = auth()->user()->id;
        $user = User::with('reviews')->find($user_id);
        $reviews = $user->reviews;
        return view('user.my_reviews', compact('user','reviews'));
    }

    public function show(Request $request, User $user)
    {
        if (!$user) {
            abort(404);
        }

       // 获取用户发布的书本
       $booksPublished = $user->books()->paginate(5, ['*'], 'books_page'); // 使用 'books_page' 作为页码参数

       // 获取用户评价，并预加载书本信息
       $bookReviews = $user->reviews()->with('reviewable')->paginate(5, ['*'], 'reviews_page'); // 使用 'reviews_page' 作为页码参数

        return view('user.show', compact('user', 'booksPublished', 'bookReviews'));
    }
}