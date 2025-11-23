<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-gray-100">
    <div class="min-h-screen flex">

        <!-- Sidebar -->
        <div class="w-64 bg-white shadow p-6">
            <div class="text-xl font-bold mb-6">{{ config('app.name', 'Laravel') }}</div>
            <nav class="space-y-2">
                <a href="{{ route('dashboard') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('dashboard') ? 'bg-gray-200 font-bold' : '' }}">
                    Dashboard
                </a>
                <a href="{{ route('categories.index') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('categories.*') ? 'bg-gray-200 font-bold' : '' }}">
                    Categories
                </a>
                <a href="{{ route('books.index') }}" class="block p-2 rounded hover:bg-gray-200 {{ request()->routeIs('books.*') ? 'bg-gray-200 font-bold' : '' }}">
                    Books
                </a>
            </nav>

            <div class="mt-6 border-t pt-4">
                <p class="text-gray-600 mb-2">{{ auth()->user()->name ?? 'Guest' }}</p>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="w-full bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700">
                        Logout
                    </button>
                </form>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 p-6">
            @yield('content')
        </div>
    </div>
</body>
</html>
