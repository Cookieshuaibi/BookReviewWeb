<?php
namespace App\Services;

use Illuminate\Support\Facades\Http;

class BookService
{
    public function searchBooks($query,$page=1)
    {
        return Http::get('https://api.itbook.store/1.0/search/' . $query."/". $page);
    }
}