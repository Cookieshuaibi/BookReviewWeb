@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Notification Details
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $notification->data['reviews_user_username'] }}</h5>
            <p class="card-text">{{ $notification->data['reviews_content'] }}</p>
            <p class="card-text"><small class="text-muted">Created at: {{ $notification->created_at->toFormattedDateString() }}</small></p>
        </div>
    </div>
    <div class="mt-3">
        <a href="{{ url('/notifications') }}" class="btn btn-secondary">Back to Notifications</a>
    </div>
</div>
@endsection