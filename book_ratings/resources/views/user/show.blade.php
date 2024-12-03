@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-md-4">
            <img src="https://via.placeholder.com/640x480.png/00cc77?text=est" alt="{{ $user->name }}'s Profile" class="img-fluid rounded">
        </div>
        <div class="col-md-8">
            <h1>{{ $user->name }}</h1>
            <p><strong>Email:</strong> {{ $user->email }}</p>
            <p><strong>Joined:</strong> {{ $user->created_at->toFormattedDateString() }}</p>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">
                    Published Books
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Title</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($booksPublished as $book)
                                <tr>
                                    <td>{{ $book->title }}</td>
                                    <td>{{ $book->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{ $booksPublished->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card mt-3">
                <div class="card-header">
                    Reviews
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Book Title</th>
                                <th>Book Image</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Published At</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($bookReviews as $review)
                                <tr>
                                    <td>{{ $review->reviewable->title }}</td>
                                    <td>
                                        <img src="{{ filter_var($review->reviewable->image_url, FILTER_VALIDATE_URL) ? $review->reviewable->image_url : Storage::url($review->reviewable->image_url) }}" 
                                             alt="{{ $review->reviewable->title }} Cover" 
                                             class="img-fluid rounded d-block mx-auto" 
                                             style="max-width: 100%; max-height: 100px;">
                                    </td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->reviewable->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <div class="card-footer">
                        {{ $bookReviews->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection