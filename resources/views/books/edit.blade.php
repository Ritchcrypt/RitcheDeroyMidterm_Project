@extends('layouts.app')

@section('content')
<h2>Edit Book</h2>

<form action="{{ route('books.update', $book->id) }}" method="POST">
    @csrf
    @method('PUT')

    <input type="text" name="title" value="{{ old('title', $book->title) }}" required>
    <input type="text" name="author" value="{{ old('author', $book->author) }}">
    <select name="category_id">
        <option value="">Select Category</option>
        @foreach(\App\Models\Category::all() as $category)
            <option value="{{ $category->id }}" 
                {{ $book->category_id == $category->id ? 'selected' : '' }}>
                {{ $category->name }}
            </option>
        @endforeach
    </select>

    <button type="submit">Update Book</button>
</form>
@endsection
