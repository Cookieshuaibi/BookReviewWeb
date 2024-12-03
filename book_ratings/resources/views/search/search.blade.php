@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Search for Books</h1>
    <form action="{{ route('search.search') }}" method="POST" class="mb-5">
        @csrf
        <div class="input-group">
        <input type="text" class="form-control" id="query" name="query" value="{{ request('query') }}" placeholder="Search books by title, author, ISBN or keywords" required autofocus>
        <button class="btn btn-primary" type="submit">Search</button>
    </div>
    </form>

    <h1 class="mb-3">Search Results for: {{ $query }}</h1>
    @if($books)
        <div class="list-group mb-5">
            @foreach($books as $book)
            <div class="list-group-item d-flex justify-content-between align-items-start p-3 border rounded">
                <img src="{{ $book['image'] }}" alt="Cover" class="img-fluid me-3" style="max-width:120px; height:auto;">
                <div class="flex-grow-1">
                    <h5 class="mb-1">{{ $book['title'] }}</h5>
                    <p class="mb-1 text-muted">{{ $book['subtitle'] ?? '' }}</p>
                    <p class="mb-1">ISBN: <strong>{{ $book['isbn13'] }}</strong></p>
                    <p class="fs-5 fw-bold">Price: <span class="text-success">{{ $book['price'] }}</span></p>
                </div>
                <div class="d-flex align-items-center">
                    <a href="{{ $book['url'] }}" target="_blank" class="btn btn-info btn-sm">More Info</a>
                </div>
            </div>

            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $paginator->onEachSide(1)->withQueryString()->links() }}
        </div>
    @else
        <p class="text-center">No books found.</p>
    @endif
</div>
@endsection

@push('styles')
<style>
    body {
        font-family: 'Arial', sans-serif;
    }
    .container {
        max-width: 1200px;
    }
    .list-group-item {
        border: 1px solid #dee2e6;
        border-radius: 0.25rem;
    }
    .list-group-item img {
        border: 1px solid #ccc;
    }
    .btn-info {
        background-color: #17a2b8;
        border-color: #17a2b8;
    }
</style>
@endpush