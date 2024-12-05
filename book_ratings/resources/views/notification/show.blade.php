@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                Notification Details
            </div>
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <a href="{{ route('users.show', $notification->data['reviews_user_userid']) }}" class="text-decoration-none text-dark">
                    {{ $notification->data['reviews_user_username'] }}
                    </a>
                </h5>
                <p class="card-text">{{ $notification->data['reviews_content'] }}</p>
                <div class="mb-3">
                    <span class="badge bg-warning text-dark">{{ $notification->data['reviews_rating'] }}</span>
                </div>
                <a href="{{ route('books.show', $notification->data['reviews_book_id']) }}" >
                <img src="{{ filter_var($notification->data['reviews_book_image_url'], FILTER_VALIDATE_URL) ? $notification->data['reviews_book_image_url'] : Storage::url($notification->data['reviews_book_image_url']) }}"
                     alt="{{ $notification->data['reviews_book_title'] }} Cover" class="img-fluid rounded mb-3" style="max-width: 100%; max-height: 100px; object-fit: cover;">
                </a>
                <div class="mb-3">
                    <a href="{{ route('books.show', $notification->data['reviews_book_id']) }}" class="text-decoration-none text-dark">
                    <p class="card-text"><small class="text-muted">Book: {{ $notification->data['reviews_book_title'] }}</small></p>
                    </a>
                    <p class="card-text"><small class="text-muted">Created at: {{ $notification->created_at->toFormattedDateString() }}</small></p>
                </div>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ url('/notifications') }}" class="btn btn-outline-secondary">Back to Notifications</a>
        </div>
    </div>
@endsection