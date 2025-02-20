<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
    @forelse($articles as $article)
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg transform transition duration-300 hover:scale-105">
            @if($article->featured_image)
                <img src="{{ Storage::url($article->featured_image) }}" 
                     alt="{{ $article->title }}" 
                     class="w-full h-48 object-cover">
            @endif
            
            <div class="p-6">
                <h3 class="text-xl font-semibold mb-2">{{ $article->title }}</h3>
                <p class="text-gray-600 mb-4">
                    {{ Str::limit($article->content, 100) }}
                </p>
                
                <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                    <span>{{ $article->published_at->format('M d, Y') }}</span>
                    <span>By {{ $article->user->name }}</span>
                </div>
                
                <a href="{{ route('articles.show', $article->slug) }}" 
                   class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
                    Read More
                </a>
            </div>
        </div>
    @empty
        <div class="col-span-3 text-center py-12">
            <p class="text-gray-500">No articles available yet.</p>
        </div>
    @endforelse
</div> 