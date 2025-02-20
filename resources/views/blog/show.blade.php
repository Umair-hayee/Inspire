<x-layouts.app>
    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if($blog->featured_image)
                    <img src="{{ Storage::url($blog->featured_image) }}" 
                         alt="{{ $blog->title }}" 
                         class="w-full h-64 object-cover">
                @endif
                
                <div class="p-6">
                    <h1 class="text-3xl font-bold mb-4">{{ $blog->title }}</h1>
                    
                    <div class="flex justify-between items-center text-sm text-gray-500 mb-8">
                        <span>
                            Published on {{ $blog->published_at?->format('M d, Y') ?? 'Draft' }}
                        </span>
                        <span>
                            By {{ $blog->user->name }}
                        </span>
                    </div>
                    
                    <div class="prose max-w-none">
                        {!! nl2br(e($blog->content)) !!}
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route('blog') }}" 
                           class="text-blue-500 hover:text-blue-600">
                            ← Back to Blogs
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-layouts.app> 