@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        {{ __('Reviews') }}
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{ __('Book Title') }}</th>
                                    <th scope="col">{{ __('Book Author') }}</th>
                                    <th scope="col">{{ __('Book Image') }}</th>
                                    <th scope="col">{{ __('Rating') }}</th>
                                    <th scope="col">{{ __('Comment') }}</th>
                                    <th scope="col">{{ __('Date') }}</th>
                                    <th scope="col">{{ __('Action') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($reviews as $review)
                                    <tr>
                                        <th scope="row">{{ $review->id }}</th>
                                        <td>{{ $review->reviewable->title }}</td>
                                        <td><a href="{{ route('books.show', $review->reviewable->id) }}">
                                                <img src="{{ filter_var($review->reviewable->image_url, FILTER_VALIDATE_URL) ? $review->reviewable->image_url : Storage::url($book->image_url) }}"
                                                     alt="{{ $review->reviewable->title }} Cover" class="card-img-top" style="max-width: 100%; max-height: 300px; object-fit: cover;">
                                            </a></td>
                                        <td>{{ $review->reviewable->author }}</td>
                                        <td>{{ $review->rating }}</td>
                                        <td>{{ $review->comment }}</td>
                                        <td>{{ $review->created_at }}</td>
                                        <td>
                                            <form action="{{ route('admin.reviews.destroy', $review->id) }}" method="POST" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">{{ __('Delete') }}</button>
                                                </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                        {{ $reviews->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection