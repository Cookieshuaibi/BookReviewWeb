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
                            <tr>
                                <th>Book Title</th>
                                <th>Rating</th>
                                <th>Comment</th>
                                <th>Date</th>
                            </tr>
                            @foreach($reviews as $review)
                                <tr>
                                    <td>{{ $review->book->title }}</td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->created_at->diffForHumans() }}</td>
                                </tr>
                            @endforeach
                        </table>
                    @else
                        <p>You haven't reviewed any books yet.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection