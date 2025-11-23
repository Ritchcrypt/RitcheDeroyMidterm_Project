@extends('layouts.app')

@section('content')
<h2 class="text-xl font-bold mb-4">Edit Category</h2>

<!-- Success/Error Messages -->
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

<form action="{{ route('categories.update', $category->id) }}" method="POST" class="bg-white p-4 rounded shadow">
    @csrf
    @method('PUT')

    <div class="mb-4">
        <label class="block text-gray-700">Category Name</label>
        <input type="text" name="name" value="{{ old('name', $category->name) }}" 
               class="border p-2 rounded w-full @error('name') border-red-500 @enderror" required>
        @error('name')
            <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
        @enderror
    </div>

    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Update Category</button>
</form>
@endsection
