<x-layouts.app :title="'Categories'">
  @section('content')
  <div class="space-y-6">
    <div class="bg-white p-4 rounded shadow">
      <form action="{{ route('categories.store') }}" method="POST" class="flex gap-3">
        @csrf
        <input name="name" placeholder="New category name" class="rounded border-gray-300 flex-1">
        <button class="px-4 py-2 bg-indigo-600 text-white rounded">Add</button>
      </form>
      @error('name')<div class="text-red-500 text-sm mt-2">{{ $message }}</div>@enderror
    </div>

    <div class="bg-white p-4 rounded shadow">
      <table class="w-full">
        <thead>
          <tr class="text-left">
            <th>Name</th>
            <th>Books</th>
            <th class="text-right">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach($categories as $cat)
            <tr class="border-t">
              <td class="p-2">{{ $cat->name }}</td>
              <td>{{ $cat->books_count }} books</td>
              <td class="text-right">
                <button @click="$dispatch('open-edit-cat', { id: '{{ $cat->id }}', name: '{{ addslashes($cat->name) }}' })" class="px-3 py-1 border rounded mr-2">Edit</button>

                <form action="{{ route('categories.destroy', $cat) }}" method="POST" class="inline" onsubmit="return confirm('Delete category?');">
                  @csrf
                  @method('DELETE')
                  <button class="px-3 py-1 bg-red-500 text-white rounded">Delete</button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>

      <div class="mt-4">
        {{ $categories->links() }}
      </div>
    </div>
  </div>

  <!-- edit modal -->
  <div x-data @open-edit-cat.window="open=true; data=$event.detail" x-show="open" x-cloak class="fixed inset-0 flex items-center justify-center z-50">
    <div class="absolute inset-0 bg-black/40" @click="open=false"></div>
    <div class="bg-white p-6 rounded shadow-lg w-1/3" x-show="open">
      <h3 class="text-lg font-bold">Edit Category</h3>

      <form :action="`/categories/${data.id}`" method="POST" class="mt-4">
        @csrf
        @method('PUT')
        <label>Name</label>
        <input name="name" x-model="data.name" class="mt-1 block w-full rounded border-gray-300">
        <div class="mt-4 text-right">
          <button type="button" @click="open=false" class="px-3 py-1 border rounded mr-2">Cancel</button>
          <button type="submit" class="px-3 py-1 bg-indigo-600 text-white rounded">Save</button>
        </div>
      </form>
    </div>
  </div>

  @endsection
</x-layouts.app>