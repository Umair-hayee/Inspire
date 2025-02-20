<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Manage Blogs</h2>
        <button wire:click="$toggle('showForm')" class="bg-blue-500 text-white px-4 py-2 rounded">
            {{ $showForm ? 'Close Form' : 'Add New Blog' }}
        </button>
    </div>

    @if($showForm)
        <form wire:submit="save" class="mb-6 bg-white p-6 rounded-lg shadow-md">
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                    Title
                </label>
                <input wire:model="title" type="text" id="title" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('title') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="content">
                    Content
                </label>
                <textarea wire:model="content" id="content" rows="4"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
                @error('content') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="featured_image">
                    Featured Image
                </label>
                <input wire:model="featured_image" type="file" id="featured_image" 
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                @error('featured_image') <span class="text-red-500 text-xs">{{ $message }}</span> @enderror
            </div>

            <div class="mb-4">
                <label class="flex items-center">
                    <input wire:model="is_published" type="checkbox" class="form-checkbox">
                    <span class="ml-2">Publish</span>
                </label>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">
                {{ $isEditing ? 'Update' : 'Create' }} Blog
            </button>
        </form>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($blogs as $blog)
            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                @if($blog->featured_image)
                    <img src="{{ Storage::url($blog->featured_image) }}" alt="{{ $blog->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-4">
                    <h3 class="font-bold text-xl mb-2">{{ $blog->title }}</h3>
                    <p class="text-gray-700 mb-4">{{ Str::limit($blog->content, 100) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">
                            {{ $blog->is_published ? 'Published' : 'Draft' }}
                        </span>
                        <div class="space-x-2">
                            <button wire:click="edit({{ $blog->id }})" class="text-blue-500 hover:text-blue-700">
                                Edit
                            </button>
                            <button wire:click="delete({{ $blog->id }})" class="text-red-500 hover:text-red-700"
                                onclick="return confirm('Are you sure you want to delete this blog?')">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div> 