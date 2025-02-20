<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h1 class="text-3xl font-bold mb-8">Blog Posts</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($blogs as $blog)
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    @if($blog->featured_image)
                        <img src="{{ Storage::url($blog->featured_image) }}" 
                             alt="{{ $blog->title }}" 
                             class="w-full h-48 object-cover">
                    @endif
                    
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">{{ $blog->title }}</h2>
                        <p class="text-gray-600 mb-4">
                            {{ Str::limit($blog->content, 150) }}
                        </p>
                        
                        <div class="flex justify-between items-center text-sm text-gray-500">
                            <span>
                                {{ $blog->published_at->format('M d, Y') }}
                            </span>
                            <span>
                                By {{ $blog->user->name }}
                            </span>
                        </div>
                        
                        <a href="{{ route('blog.show', $blog->slug) }}" 
                           class="mt-4 inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                            Read More
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        @if($blogs->isEmpty())
            <div class="text-center py-12">
                <p class="text-gray-500 text-lg">No blog posts available yet.</p>
            </div>
        @endif
    </div>
</div> 