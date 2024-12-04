@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="row">
                        <div class="col-md-4">
                            <img src="{{ filter_var($book->image_url, FILTER_VALIDATE_URL) ? $book->image_url : Storage::url($book->image_url) }}"
                                 alt="{{ $book->title }} Cover"
                                 class="img-fluid rounded d-block mx-auto"
                                 style="max-width: 100%; max-height: 300px;">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body">
                                <h1 class="mb-0">{{ $book->title }}</h1>
                                <h5 class="card-title"><strong>Author:</strong> {{ $book->author }}</h5>
                                <p class="card-text"><strong>Description:</strong> {{ $book->description }}</p>
                                <p class="card-text"><strong>Genre:</strong> {{ $book->genre }}</p>
                                <p class="card-text"><strong>Published Date:</strong> {{ $book->year }}</p>
                                <p class="card-text"><strong>Price:</strong> ${{ number_format($book->price, 2) }}</p>
                                <p class="card-text"><strong>Average Rating:</strong> <span id="average-rating">{{ $book->average_rating }}</span></p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <strong>Reviews:</strong> <a href="{{ route('books.get_reviews', $book->id) }}" class="btn btn-link text-decoration-none">See more reviews >></a>
                    </div>
                    <div class="card-body reviews-container">
                        @foreach($book->reviews as $review)
                            <div class="review-card mb-3 p-3 bg-light rounded shadow-sm">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="review-content">
                                        <a href="{{ route('users.show', $review->user->id) }}" class="text-decoration-none">
                                            <h6 class="mb-1">{{ $review->user->name }}</h6>
                                        </a>
                                        <p class="mb-1"><strong>Rating:</strong> {{ $review->rating }}</p>
                                        <p class="mb-1"><strong>Comment:</strong> {{ $review->comment }}</p>
                                    </div>
                                    <small class="text-muted">{{ $review->created_at->diffForHumans() }}</small>
                                </div>
                            </div>
                        @endforeach
                        <form id="reviewForm" method="POST" action="{{ route('books.add_review', $book->id) }}" class="mt-3">
                            @csrf
                            <div class="mb-3">
                                <label for="rating" class="form-label">Rating:</label>
                                <select name="rating" class="form-select" required>
                                    <option value="1">1 (Lowest)</option>
                                    <option value="2">2 (Low)</option>
                                    <option value="3">3 (Average)</option>
                                    <option value="4">4 (Good)</option>
                                    <option value="5">5 (Excellent)</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label">Comment:</label>
                                <textarea name="comment" class="form-control" rows="3" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Submit Review</button>
                        </form>
                    </div>
                </div>

                <div class="mt-3 d-flex justify-content-between">
                    <a href="{{ route('books.index') }}" class="btn btn-secondary">Back</a>
                    @if(Auth::check() && (Auth::user()->hasRoles('admin') || Auth::id() == $book->user_id))
                        <a href="{{ route('books.edit', $book->id) }}" class="btn btn-secondary">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
<script>
$(document).ready(function() {
    $('#reviewForm').on('submit', function(event) {
        event.preventDefault(); // 阻止默认提交

        $.ajax({
            url: $(this).attr('action'), // AJAX 请求的 URL
            method: 'POST',
            data: $(this).serialize(), // 表单数据
            success: function(response) {
                if (response.success) {
                    // 插入新评论到页面
                    var review = response.data;
                    var newCard = '<div class="review-card mb-3 p-3 bg-light rounded shadow-sm">' +
                        '<div class="d-flex justify-content-between align-items-center">' +
                            '<div class="review-content">' +
                                '<a href="' + review.user_url + '" class="text-decoration-none">' +
                                    '<h6 class="mb-1">' + review.user_name + '</h6>' +
                                '</a>' +
                                '<p class="mb-1"><strong>Rating:</strong> ' + review.rating + '</p>' +
                                '<p class="mb-1"><strong>Comment:</strong> ' + review.comment + '</p>' +
                            '</div>' +
                            '<small class="text-muted">' + review.created_at + '</small>' +
                        '</div>' +
                    '</div>';
                    $(".reviews-container").prepend(newCard);
                    // 更新平均评分
                    $('#average-rating').text('Average Rating: ' + response.average_rating);
                    var reviews = $(".reviews-container .review-card").length;
                    if (reviews > 10) {
                        $(".reviews-container .review-card:last").remove();
                    }
                    // 重置表单
                    $('#reviewForm')[0].reset();
                } else {
                    alert(response.message); // 显示失败消息
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred. Please try again.');
            }
        });
    });
});
</script>
@endsection