@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        {{ __('Reviews') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table table-hover">
                            <thead class="thead-light">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">{{ __('Book Title') }}</th>
                                <th scope="col">{{ __('Book Author') }}</th>
                                <th scope="col">{{ __('Book Image') }}</th>
                                <th scope="col">{{ __('Rating') }}</th>
                                <th scope="col">{{ __('Comment') }}</th>
                                <th scope="col">{{ __('Date') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($reviews as $review)
                                <tr>
                                    <th scope="row">{{ $review->id }}</th>
                                    <td>{{ $review->reviewable->title }}</td>
                                    <td>{{ $review->reviewable->author }}</td>
                                    <td>
                                        <a href="{{ route('books.show', $review->reviewable->id) }}">
                                            <img src="{{ filter_var($review->reviewable->image_url, FILTER_VALIDATE_URL) ? $review->reviewable->image_url : Storage::url($review->reviewable->image_url) }}"
                                                 alt="{{ $review->reviewable->title }} Cover" class="img-fluid rounded" style="max-width: 100px; max-height: 150px;">
                                        </a>
                                    </td>
                                    <td>{{ $review->rating }}</td>
                                    <td>{{ $review->comment }}</td>
                                    <td>{{ $review->created_at->format('Y-m-d H:i:s') }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <div class="d-flex justify-content-center">
                            {{ $reviews->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection