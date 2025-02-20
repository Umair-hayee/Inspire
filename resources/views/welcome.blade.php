<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Knowledge Hub</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased">
        <x-layouts.app>
            <div class="min-h-screen bg-gray-100">
                <!-- Hero Section with Background -->
                <div class="relative overflow-hidden bg-cover bg-center bg-no-repeat" 
                     style="background-image: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)), url('https://images.unsplash.com/photo-1507842217343-583bb7270b66?ixlib=rb-1.2.1&auto=format&fit=crop&w=2000&q=80'); height: 600px;">
                    <div class="max-w-7xl mx-auto">
                        <div class="relative z-10 pb-8 sm:pb-16 md:pb-20 lg:w-full lg:pb-28 xl:pb-32">
                            <main class="mt-10 mx-auto max-w-7xl px-4 sm:mt-12 sm:px-6 md:mt-16 lg:mt-20 lg:px-8 xl:mt-28">
                                <div class="text-center max-w-3xl mx-auto">
                                    <h1 class="text-4xl tracking-tight font-extrabold text-white sm:text-5xl md:text-6xl">
                                        <span class="block">Your Daily</span>
                                        <span class="block text-blue-400">Knowledge Hub</span>
                                    </h1>
                                    <p class="mt-3 text-base text-gray-300 sm:mt-5 sm:text-lg sm:max-w-xl sm:mx-auto md:mt-5 md:text-xl">
                                        Explore insightful articles and engaging blog posts. Stay informed with the latest trends, expert opinions, and in-depth analysis on various topics.
                                    </p>
                                    <div class="mt-8 flex justify-center gap-4">
                                        <a href="{{ route('blog') }}" 
                                           class="inline-block bg-blue-600 text-white px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300 transform hover:scale-105">
                                            Explore Blogs
                                        </a>
                                        <a href="{{ route('articles') }}" 
                                           class="inline-block bg-white text-blue-600 px-8 py-3 rounded-lg hover:bg-gray-100 transition duration-300 transform hover:scale-105">
                                            Read Articles
                                        </a>
                                    </div>
                                </div>
                            </main>
                        </div>
                    </div>
                </div>

                <!-- Content Sections -->
                <div class="py-12 mt-5">
                    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                        <!-- Latest Blogs Section -->
                        <section class="mb-16 bg-white rounded-lg shadow-xl p-8 lg:p-12">
                            <div class="flex justify-between items-center mb-10">
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-900">Latest Blog Posts</h2>
                                    <p class="mt-2 text-gray-600">Discover our most recent blog posts and insights</p>
                                </div>
                                <a href="{{ route('blog') }}" 
                                   class="text-blue-500 hover:text-blue-600 flex items-center group">
                                    <span class="mr-2">View All Blogs</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="h-5 w-5 transform transition-transform group-hover:translate-x-1" 
                                         viewBox="0 0 20 20" 
                                         fill="currentColor">
                                        <path fill-rule="evenodd" 
                                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" 
                                              clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                            
                            <!-- Blogs Grid -->
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @forelse($blogs as $blog)
                                    <div class="bg-white overflow-hidden rounded-lg border border-gray-100 shadow-sm transform transition duration-300 hover:scale-105 hover:shadow-lg">
                                        @if($blog->featured_image)
                                            <img src="{{ Storage::url($blog->featured_image) }}" 
                                                 alt="{{ $blog->title }}" 
                                                 class="w-full h-48 object-cover">
                                        @endif
                                        
                                        <div class="p-6">
                                            <h3 class="text-xl font-semibold mb-3 text-gray-900">{{ $blog->title }}</h3>
                                            <p class="text-gray-600 mb-4 line-clamp-3">
                                                {{ Str::limit($blog->content, 150) }}
                                            </p>
                                            
                                            <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $blog->published_at->format('M d, Y') }}
                                                </span>
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $blog->user->name }}
                                                </span>
                                            </div>
                                            
                                            <a href="{{ route('blog.show', $blog->slug) }}" 
                                               class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                                                Read More
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-3 text-center py-12">
                                        <p class="text-gray-500 text-lg">No blog posts available yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </section>

                        <!-- Latest Articles Section -->
                        <section class="bg-white rounded-lg shadow-xl p-8 lg:p-12">
                            <div class="flex justify-between items-center mb-10">
                                <div>
                                    <h2 class="text-3xl font-bold text-gray-900">Latest Articles</h2>
                                    <p class="mt-2 text-gray-600">Discover our most recent articles and insights</p>
                                </div>
                                <a href="{{ route('articles') }}" 
                                   class="text-blue-500 hover:text-blue-600 flex items-center group">
                                    <span class="mr-2">View All Articles</span>
                                    <svg xmlns="http://www.w3.org/2000/svg" 
                                         class="h-5 w-5 transform transition-transform group-hover:translate-x-1" 
                                         viewBox="0 0 20 20" 
                                         fill="currentColor">
                                        <path fill-rule="evenodd" 
                                              d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z" 
                                              clip-rule="evenodd" />
                                    </svg>
                                </a>
                            </div>
                            
                            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                                @forelse($articles as $article)
                                    <div class="bg-white overflow-hidden rounded-lg border border-gray-100 shadow-sm transform transition duration-300 hover:scale-105 hover:shadow-lg">
                                        @if($article->featured_image)
                                            <img src="{{ Storage::url($article->featured_image) }}" 
                                                 alt="{{ $article->title }}" 
                                                 class="w-full h-48 object-cover">
                                        @endif
                                        
                                        <div class="p-6">
                                            <h3 class="text-xl font-semibold mb-3 text-gray-900">{{ $article->title }}</h3>
                                            <p class="text-gray-600 mb-4 line-clamp-3">
                                                {{ Str::limit($article->content, 150) }}
                                            </p>
                                            
                                            <div class="flex justify-between items-center text-sm text-gray-500 mb-4">
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $article->published_at->format('M d, Y') }}
                                                </span>
                                                <span class="flex items-center">
                                                    <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                                        <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"/>
                                                    </svg>
                                                    {{ $article->user->name }}
                                                </span>
                                            </div>
                                            
                                            <a href="{{ route('articles.show', $article->slug) }}" 
                                               class="inline-flex items-center justify-center w-full px-4 py-2 bg-blue-500 text-white rounded-lg hover:bg-blue-600 transition duration-300">
                                                Read More
                                                <svg class="w-4 h-4 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                                </svg>
                                            </a>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-span-3 text-center py-12">
                                        <p class="text-gray-500 text-lg">No articles available yet.</p>
                                    </div>
                                @endforelse
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </x-layouts.app>
    </body>
</html>
