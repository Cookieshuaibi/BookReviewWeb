@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Books List</h1>
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Image</th>
                <th scope="col">Title</th>
                <th scope="col">Author</th>
                <th scope="col">Genre</th>
                <th scope="col">Year</th>
                <th scope="col">Average Rating</th>
                <th scope="col">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($books as $book)
            <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>
                <img src="{{ filter_var($book->image_url, FILTER_VALIDATE_URL) ? $book->image_url : Storage::url($book->image_url) }}" 
     alt="{{ $book->title }} Cover" 
     class="img-fluid rounded" 
     style="max-width: 100px; max-height: 150px;">
                </td>
                <td>{{ $book->title }}</td>
                <td>{{ $book->author }}</td>
                <td>{{ $book->genre }}</td>
                <td>{{ $book->year }}</td>
                <td>{{ $book->average_rating }}</td>
                <td>
                    <a href="{{ route('books.show', $book) }}" class="btn btn-primary btn-sm">View</a>
                    <!-- Add Edit and Delete buttons if needed -->
                        <a href="{{ route('books.edit', $book) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('books.destroy', $book) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $books->links() }} 
</div>
@endsection

<script>
    function is_local(path) {
        // 检查路径是否以 http(s) 开头
        return !/^https?:\/\//.test(path);
    }
</script>