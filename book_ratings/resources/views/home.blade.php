@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <!-- Carousel for Featured Books -->
        <div id="featuredBooksCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <a href="{{ route('books.show', $popularBooks[0]->id) }}">
                        <img src="https://via.placeholder.com/800x300?text=Featured+Book+1" class="d-block w-100" alt="Featured Book 1">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="{{ route('books.show', $popularBooks[1]->id) }}">
                        <img src="https://via.placeholder.com/800x300?text=Featured+Book+2" class="d-block w-100" alt="Featured Book 2">
                    </a>
                </div>
                <div class="carousel-item">
                    <a href="{{ route('books.show', $popularBooks[2]->id) }}">
                        <img src="https://via.placeholder.com/800x300?text=Featured+Book+3" class="d-block w-100" alt="Featured Book 3">
                    </a>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#featuredBooksCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#featuredBooksCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <!-- Popular Books Section -->
        <h2 class="mt-5">Popular Books</h2>
        <p class="text-end mb-4"><a href="{{ route('books.index') }}" class="btn btn-outline-primary">More Books</a></p>
        <div class="row">
            @foreach ($popularBooks as $book)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <a href="{{ route('books.show', $book->id) }}">
                            <img src="{{ filter_var($book->image_url, FILTER_VALIDATE_URL) ? $book->image_url : Storage::url($book->image_url) }}"
                                 alt="{{ $book->title }} Cover" class="card-img-top" style="max-width: 100%; max-height: 300px; object-fit: cover;">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">{{ $book->title }}</h5>
                            <p class="card-text">By {{ $book->author }}</p>
                            <p class="card-text"><strong>Average Rating:</strong> {{ $book->average_rating }}</p>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Latest Reviews Section -->
        <h2 class="mt-5">Latest Reviews</h2>
        <div class="row g-4">
            @foreach ($latestReviews as $review)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm">
                        <div class="card-body">
                            <a href="{{ route('books.show', $review->reviewable_id) }}">
                                <img src="{{ $review->reviewable->image_url }}" class="rounded float-start me-3" alt="{{ $review->reviewable->title }}" style="width: 100px; height: 150px;">
                            </a>
                            <h5 class="card-title">{{ $review->reviewable->title }}</h5>
                            <p class="card-text"><small class="text-muted">By {{ $review->reviewable->author }}</small></p>
                            <p class="card-text"><strong>Rating:</strong> {{ $review->rating }}</p>
                            <p class="card-text">{{ Str::limit($review->comment, 150) }}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Simple Pagination -->
        <div class="d-flex justify-content-center mt-4">
            {{ $latestReviews->links() }}
        </div>
    </div>
@endsection