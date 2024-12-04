@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Update Review</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('reviews.edit', $review->id) }}">
                        @csrf
                        @method('PUT')

                        <div class="form-group row">
                            <label for="rating" class="col-md-4 col-form-label text-md-right">Book</label>

                            <div class="col-md-6">
                               <span>{{ $review->reviewable->title }}</span>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="rating" class="col-md-4 col-form-label text-md-right">Rating</label>

                            <div class="col-md-6">
                                <input id="rating" type="number" class="form-control" name="rating" value="{{ $review->rating }}" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="comment" class="col-md-4 col-form-label text-md-right">Comment</label>

                            <div class="col-md-6">
                                <textarea id="comment" class="form-control" name="comment" required>{{ $review->comment }}</textarea>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
