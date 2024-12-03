@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h1>Profile</h1>
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $user->name }}</h5>
                        <p class="card-text">Email: {{ $user->email }}</p>
                        <p class="card-text">Joined: {{ $user->created_at->diffForHumans() }}</p>
                    </div>
                </div>
            </div>
             <div class="col-md-4">
                <h1>Ratings</h1>
                <ul class="list-group">
                    @foreach($user->reviews as $review)
                        <li class="list-group-item">
                            <a href="{{ route('book.show', $review->book->id) }}">{{ $review->book->title }}</a>
                            <br>
                            <small>{{ $review->created_at->diffForHumans() }}</small>
                            <br>
                            <span class="text-muted">{{ $review->comment }}</span>
                            <span class="badge badge-primary">{{ $review->rating }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            </div>
    </div>
@endsection