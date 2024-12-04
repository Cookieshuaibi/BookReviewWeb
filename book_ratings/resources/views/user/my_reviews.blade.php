@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">My Reviews</div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if(count($reviews) > 0)
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th scope="col">Book Title</th>
                                    <th scope="col">Book Image</th>
                                    <th scope="col">Rating</th>
                                    <th scope="col">Comment</th>
                                    <th scope="col">Date</th>
                                    <th scope="col">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($reviews as $review)
                                    <tr>
                                        <td>{{ $review->reviewable->title }}</td>
                                        <td>
                                            <a href="{{ route('books.show', $review->reviewable->id) }}">
                                                <img src="{{ filter_var($review->reviewable->image_url, FILTER_VALIDATE_URL) ? $review->reviewable->image_url : Storage::url($review->reviewable->image_url) }}"
                                                     alt="{{ $review->reviewable->title }} Cover" class="img-fluid" style="max-width: 100px; max-height: 150px;">
                                            </a>
                                        </td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ $review->comment }}</td>
                                        <td>{{ $review->created_at->diffForHumans() }}</td>
                                        <td>
                                            <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                            <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                            <div class="d-flex justify-content-center">
                                {{ $reviews->links() }}
                            </div>
                        @else
                            <p class="text-center">You haven't reviewed any books yet.</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection