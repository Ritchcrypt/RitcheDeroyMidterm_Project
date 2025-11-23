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
    <!-- Add Category Form -->
    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Add New Category</h2>
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700">Name</label>
                <input type="text" name="name" class="w-full border p-2 rounded" required>
            </div>
            <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Add Category</button>
        </form>
    </div>

    <!-- Categories Table -->
    <div class="bg-white p-6 shadow rounded">
        <h2 class="text-xl font-bold mb-4">Categories</h2>
        <table class="w-full border-collapse border">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border p-2">Name</th>
                    <th class="border p-2">Books Count</th>
                    <th class="border p-2">Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach(\App\Models\Category::all() as $category)
                <tr>
                    <td class="border p-2">{{ $category->name }}</td>
                    <td class="border p-2">{{ $category->books->count() }}</td>
                    <td class="border p-2 space-x-2">
                        <a href="{{ route('categories.edit', $category->id) }}" class="text-blue-600">Edit</a>
                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600" onclick="return confirm('Delete this category?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
