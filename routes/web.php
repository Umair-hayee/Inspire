<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Pages\BlogPage;
use App\Livewire\Pages\ArticlesPage;
use App\Livewire\Articles\ManageArticles;
use App\Livewire\Blogs\ManageBlogs;
use App\Models\Blog;
use App\Models\Article;

// Add auth routes
Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// Public routes
Route::get('/blog', BlogPage::class)->name('blog');
Route::get('/articles', ArticlesPage::class)->name('articles');

Route::get('/blog/{blog:slug}', function(Blog $blog) {
    if (!$blog->is_published && !Auth::check()) {
        abort(404);
    }
    return view('blog.show', ['blog' => $blog]);
})->name('blog.show');

Route::get('/articles/{article:slug}', function(Article $article) {
    if (!$article->is_published && !Auth::check()) {
        abort(404);
    }
    return view('articles.show', ['article' => $article]);
})->name('articles.show');

// Protected routes
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    
    Route::get('/manage-articles', ManageArticles::class)->name('articles.index');
    Route::get('/manage-blogs', ManageBlogs::class)->name('blogs.index');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
