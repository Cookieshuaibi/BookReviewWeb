@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Add New Book
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('books.create') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required autofocus>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ old('author') }}" required>
                    @error('author')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <input type="text" class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" value="{{ old('summary') }}" required>
                    @error('summary')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="average_rating" class="form-label">Average Rating</label>
                    <input type="text" class="form-control @error('average_rating') is-invalid @enderror" id="average_rating" name="average_rating" value="{{ old('average_rating') }}" required>
                    @error('average_rating')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url" required>
                    @error('image_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" value="{{ old('genre') }}" required>
                    @error('genre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ old('year') }}" required>
                    @error('year')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher" value="{{ old('publisher') }}" required>
                    @error('publisher')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="language" class="form-label">Language</label>
                 <select class="form-select @error('language') is-invalid @enderror" id="language" name="language" required>
                    <option value="">Select Language</option>
                    <option value="en">English</option>
                    <option value="fr">French</option>
                    <option value="ge">German</option>
                    <option value="it">Italian</option>
                    <option value="sp">Spanish</option>
                    <option value="ru">Russian</option>
                </select>
                    @error('language')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ old('isbn') }}" required>
                    @error('isbn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection