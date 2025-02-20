<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manage Blog Posts</h2>
        <button wire:click="$toggle('showForm')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
            {{ $showForm ? 'Close Form' : 'New Post' }}
        </button>
    </div>

    @if($showForm)
    <div class="bg-white p-6 rounded-lg shadow-lg mb-6">
        <form wire:submit="save" class="space-y-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Title</label>
                <input type="text" wire:model="title" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm">
                @error('title') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Content</label>
                <textarea wire:model="content" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></textarea>
                @error('content') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700">Featured Image</label>
                <input type="file" wire:model="featured_image" class="mt-1 block w-full">
                @error('featured_image') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center">
                <input type="checkbox" wire:model="is_published" class="rounded border-gray-300 text-blue-600">
                <label class="ml-2 text-sm text-gray-700">Publish immediately</label>
            </div>

            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                {{ $isEditing ? 'Update Post' : 'Create Post' }}
            </button>
        </form>
    </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($posts as $post)
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            @if($post->featured_image)
            <img src="{{ Storage::url($post->featured_image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover">
            @endif
            <div class="p-4">
                <h3 class="text-xl font-semibold mb-2">{{ $post->title }}</h3>
                <p class="text-gray-600 mb-4">{{ Str::limit($post->content, 100) }}</p>
                <div class="flex justify-between items-center">
                    <span class="text-sm text-gray-500">{{ $post->created_at->format('M d, Y') }}</span>
                    <div class="space-x-2">
                        <button wire:click="edit({{ $post->id }})" class="text-blue-500 hover:text-blue-700">Edit</button>
                        <button wire:click="delete({{ $post->id }})" class="text-red-500 hover:text-red-700">Delete</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div> 