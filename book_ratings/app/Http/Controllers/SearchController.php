<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Services\BookService;
use Illuminate\Pagination\LengthAwarePaginator;

class SearchController extends Controller
{
    /*@var $bookService \App\Services\BookService */
    protected $bookService;

    public function __construct()
    {
        /*@var $bookService \App\Services\BookService */
        $this->bookService = app('bookService');
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $books = [];
        if (!empty($query)) {
            $validator = Validator::make($request->all(), [
                'query' => ['required', 'string', 'max:20', 'min:3', 'regex:/^[a-zA-Z0-9\s]+$/'],
                'page' => ['nullable', 'integer', 'min:1'],
            ]);

            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $response = $this->bookService->searchBooks($query, $request->input('page', 1));
            $books = $response->json()['books'] ?? [];
            $total = $response->json()['total'] ?? 0;
            $page = $response->json()['page'] ?? 1;
            $perPage = 10;
            $paginator = new LengthAwarePaginator(
                $books,
                $total,
                $perPage,
                $page,
                ['path' => $request->url(), 'query' => $request->query()]
            );
            $paginator->setPath($request->url());
            $paginator->appends(['query' => $query]);

            return view('search.search', compact('books', 'query', 'paginator'));
        } else {
            return view('search.search', compact('books', 'query'));
        }
    }
}