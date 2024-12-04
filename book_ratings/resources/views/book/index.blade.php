@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1 class="mb-0">Books List</h1>
            @if(Auth::check() && (Auth::user()->hasRoles('author') || Auth::user()->hasRoles('admin')))
                <a href="{{ route('books.create') }}" class="btn btn-primary">Add New Book</a>
            @endif
        </div>
        <div class="row">
            @foreach ($books as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('books.show', $book) }}" class="text-decoration-none">
                            <img src="{{ filter_var($book->image_url, FILTER_VALIDATE_URL) ? $book->image_url : Storage::url($book->image_url) }}"
                                 alt="{{ $book->title }} Cover" class="card-img-top" style="max-width: 100%; max-height: 300px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text"><small class="text-muted">By {{ $book->author }}</small></p>
                            <p class="card-text"><small class="text-muted">{{ $book->genre }} • {{ $book->year }}</small></p>
                            <p class="card-text"><strong>Average Rating:</strong> {{ $book->average_rating }}</p>
                        </div>
                        <div class="card-footer d-flex justify-content-between">
                            @if(Auth::check() && (Auth::user()->hasRoles('admin') || Auth::id() == $book->user_id))
                                <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                </form>
                                <div class="d-flex">
                                    <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="d-flex justify-content-center">
            {{ $books->links() }}
        </div>
    </div>
@endsection