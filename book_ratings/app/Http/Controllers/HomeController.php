<?php

namespace App\Http\Controllers;

use App\Models\Books;
use App\Models\Reviews;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //  $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $latestReviews = Reviews::latest()->with('reviewable')->paginate(6);
        $popularBooks = Books::where('average_rating', '>', 0)->orderBy('average_rating', 'desc')->limit(6)->get();
        return view('home', compact('latestReviews', 'popularBooks'));
    }
}
