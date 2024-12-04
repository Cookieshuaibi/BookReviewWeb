@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Profile</h1>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="https://via.placeholder.com/150x150" class="rounded-circle img-thumbnail" alt="{{ $user->name }}">
                            <h5 class="card-title mt-3">{{ $user->name }}</h5>
                            <p class="card-text">Email: {{ $user->email }}</p>
                            <p class="card-text">Joined: {{ $user->created_at->diffForHumans() }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Books and Reviews</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($books as $book)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="{{ filter_var($book->image_url, FILTER_VALIDATE_URL) ? $book->image_url : Storage::url($book->image_url) }}"
                                             alt="{{ $book->title }} Cover"
                                             class="card-img-top img-fluid"
                                             style="max-height: 200px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $book->title }}</h5>
                                            <p class="card-text">{{ $book->author }}</p>
                                            <p class="card-text text-muted">{{ $book->created_at->diffForHumans() }}</p>
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('books.show', $book->id) }}" class="btn btn-primary">View</a>
                                                <div>
                                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary">Edit</a>
                                                    <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $books->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h1 class="mb-0">Reviews</h1>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach($reviews as $review)
                                <div class="col-md-4 mb-4">
                                    <div class="card">
                                        <img src="https://via.placeholder.com/50x50" class="rounded-circle img-thumbnail" alt="{{ $review->user->name }}" style="width: 50px; height: 50px;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $review->user->name }}</h5>
                                            <p class="card-text">{{ $review->comment }}</p>
                                            <p class="card-text text-muted">{{ $review->created_at->diffForHumans() }}</p>
                                            <p class="card-text text-secondary">{{ $review->rating }}</p>
                                            <div class="d-flex justify-content-between">
                                                <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary">Edit</a>
                                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="d-flex justify-content-center mt-3">
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection