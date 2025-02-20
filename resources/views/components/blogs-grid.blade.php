<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($blogs as $blog)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg transform transition duration-300 hover:scale-105">
            @if($blog->featured_image)
                <img src="{{ Storage::url($blog->featured_image) }}" 
                     alt="{{ $blog->title }}" 
                     class="w-full h-48 object-cover">
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $blog->title }}</h3>
                <p class="text-gray-600 mb-4">
                    {{ Str::limit($blog->content, 100) }}
                </p>
                
                <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                    <span>{{ $blog->published_at->format('M d, Y') }}</span>
                    <span>By {{ $blog->user->name }}</span>
                </div>
                
                <a href="{{ route('blog.show', $blog->slug) }}" 
                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Read More
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500">No blog posts available yet.</p>
        </div>
    @endforelse
</div> 