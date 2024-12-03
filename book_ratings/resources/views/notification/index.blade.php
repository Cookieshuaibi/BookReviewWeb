@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Notifications</h1>
    <div class="list-group mb-3">
        @forelse($notifications as $notification)
            <a href="{{ url('/notifications/' . $notification->id) }}" class="list-group-item list-group-item-action flex-column align-items-start">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-1">{{ $notification->data['reviews_user_username'] }}</h5>
                    @if(!$notification->read_at)
                        <span class="badge bg-danger rounded-pill">New</span>
                    @endif
                </div>
                <small class="text-muted">{{ $notification->data['reviews_content'] }}</small>
                <div class="d-flex w-100 justify-content-between mt-2">
                    <small class="text-muted">{{ $notification->created_at->diffForHumans() }}</small>
                </div>
                <p class="mb-1">{{ $notification->message }}</p>
            </a>
        @empty
            <div class="list-group-item text-center">No notifications found.</div>
        @endforelse
    </div>
    @if($notifications->hasMorePages())
        <div class="mt-3">
            <a href="{{ $notifications->nextPageUrl() }}" class="btn btn-primary">Load More</a>
        </div>
    @endif
</div>
@endsection