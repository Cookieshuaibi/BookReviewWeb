@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            Edit Book
        </div>
        <div class="card-body">
            <form method="POST" action="{{ route('books.edit', $book->id) }}" enctype="multipart/form-data">
                @csrf
                <!-- Title -->
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ $book->title }}" required autofocus>
                    @error('title')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Author -->
                <div class="mb-3">
                    <label for="author" class="form-label">Author</label>
                    <input type="text" class="form-control @error('author') is-invalid @enderror" id="author" name="author" value="{{ $book->author }}" required>
                    @error('author')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Summary -->
                <div class="mb-3">
                    <label for="summary" class="form-label">Summary</label>
                    <input type="text" class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" value="{{ $book->summary }}" required>
                    @error('summary')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Average Rating -->
                <div class="mb-3">
                    <label for="average_rating" class="form-label">Average Rating</label>
                    <input type="text" class="form-control @error('average_rating') is-invalid @enderror" id="average_rating" name="average_rating" value="{{ $book->average_rating }}" required>
                    @error('average_rating')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Image URL -->
                <div class="mb-3">
                    <label for="image_url" class="form-label">Image URL</label>
                    <input type="file" class="form-control @error('image_url') is-invalid @enderror" id="image_url" name="image_url">
                    @error('image_url')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3" required>{{ $book->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Genre -->
                <div class="mb-3">
                    <label for="genre" class="form-label">Genre</label>
                    <input type="text" class="form-control @error('genre') is-invalid @enderror" id="genre" name="genre" value="{{ $book->genre }}" required>
                    @error('genre')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Year -->
                <div class="mb-3">
                    <label for="year" class="form-label">Year</label>
                    <input type="number" class="form-control @error('year') is-invalid @enderror" id="year" name="year" value="{{ $book->year }}" required>
                    @error('year')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Publisher -->
                <div class="mb-3">
                    <label for="publisher" class="form-label">Publisher</label>
                    <input type="text" class="form-control @error('publisher') is-invalid @enderror" id="publisher" name="publisher" value="{{ $book->publisher }}" required>
                    @error('publisher')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
               <!-- Language -->
                <div class="mb-3">
                    <label for="language" class="form-label">Language</label>
                    <select class="form-select @error('language') is-invalid @enderror" id="language" name="language" required>
                        <option value="">Select Language</option>
                        <option value="en" {{ $book->language === 'en' ? 'selected' : '' }}>English</option>
                        <option value="fr" {{ $book->language === 'fr' ? 'selected' : '' }}>French</option>
                        <option value="ge" {{ $book->language === 'ge' ? 'selected' : '' }}>German</option>
                        <option value="it" {{ $book->language === 'it' ? 'selected' : '' }}>Italian</option>
                        <option value="sp" {{ $book->language === 'sp' ? 'selected' : '' }}>Spanish</option>
                        <option value="ru" {{ $book->language === 'ru' ? 'selected' : '' }}>Russian</option>
                    </select>
                    @error('language')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                                
                <!-- ISBN -->
                <div class="mb-3">
                    <label for="isbn" class="form-label">ISBN</label>
                    <input type="text" class="form-control @error('isbn') is-invalid @enderror" id="isbn" name="isbn" value="{{ $book->isbn }}" required>
                    @error('isbn')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection