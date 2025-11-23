@if(session('success'))
    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4">
        {{ session('success') }}
    </div>
@endif

@if ($errors->any())
    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif 

@extends('layouts.app')

@section('content')
<div class="space-y-6">
    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-gray-500">Total Books</h3>
            <p class="text-2xl font-bold">{{ \App\Models\Book::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-gray-500">Total Categories</h3>
            <p class="text-2xl font-bold">{{ \App\Models\Category::count() }}</p>
        </div>
        <div class="bg-white p-4 shadow rounded">
            <h3 class="text-gray-500">Static Card</h3>
            <p class="text-2xl font-bold">42</p>
        </div>
    </div>

    <!-- Add Book Form -->
    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Add New Book</h2>
        <form action="{{ route('books.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Title</label>
                <input type="text" name="title" class="w-full border p-2 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Author</label>
                <input type="text" name="author" class="w-full border p-2 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Category</label>
                <select name="category_id" class="w-full border p-2 rounded">
                    <option value="">Select Category</option>
                    @foreach(\App\Models\Category::all() as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Add Book</button>
        </form>
    </div>

    <!-- Books Table -->
    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Books</h2>
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Title</th>
                    <th class="border p-2">Author</th>
                    <th class="border p-2">Category</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Book::all() as $book)
                <tr>
                    <td class="border p-2">{{ $book->title }}</td>
                    <td class="border p-2">{{ $book->author }}</td>
                    <td class="border p-2">{{ $book->category?->name ?? 'N/A' }}</td>
                    <td class="border p-2 space-x-2">
                        <a href="{{ route('books.edit', $book->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Delete this book?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
