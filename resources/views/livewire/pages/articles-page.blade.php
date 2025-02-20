<div class="py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-900">Astronomy Articles</h1>
            <p class="mt-2 text-gray-600">In-depth analysis of astronomical phenomena</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($articles as $article)
            <article class="bg-white rounded-lg shadow-lg overflow-hidden">
                @if($article->featured_image)
                <img src="{{ Storage::url($article->featured_image) }}" alt="{{ $article->title }}" class="w-full h-48 object-cover">
                @endif
                <div class="p-6">
                    <h2 class="text-xl font-semibold text-gray-900 mb-2">{{ $article->title }}</h2>
                    <p class="text-gray-600 mb-4">{{ Str::limit($article->content, 150) }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-500">{{ $article->published_at->format('M d, Y') }}</span>
                        <a href="#" class="text-blue-600 hover:text-blue-800">Read more →</a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="mt-8">
            {{ $articles->links() }}
        </div>
    </div>
</div> 