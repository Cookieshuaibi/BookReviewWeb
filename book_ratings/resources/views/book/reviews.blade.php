@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card" style="box-shadow: 0 4px 8px rgba(0,0,0,0.1);">
                    <div class="card-header text-center" style="background-color: #007bff; color: #fff;">
                        <h3 class="mb-0">Reviews for {{ $book->title }}</h3>
                    </div>

                    <div class="card-body">
                        @foreach($reviews as $review)
                            <div class="media mb-3" style="border-bottom: 1px solid #eaeaea; padding-bottom: 20px;">
                                <img class="mr-3 rounded-circle" src="https://via.placeholder.com/50x50" alt="{{ $review->user->name }}" style="width: 50px; height: 50px;">
                                <div class="media-body">
                                    <h5 class="mt-0 mb-1">{{ $review->user->name }}</h5>
                                    <p class="mb-2">{{ $review->comment }}</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="text-muted mb-2">
                                            <small>Rating: {{ $review->rating }}</small>
                                        </div>
                                        <small>{{ $review->created_at->diffForHumans() }}</small>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <div class="d-flex justify-content-center">
                            {{$reviews->links()}}
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('books.show', $book->id) }}" class="btn btn-outline-primary">Back to Books</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection