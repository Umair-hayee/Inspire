<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Article;
use Illuminate\View\View;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     */
    public function index(): View
    {
        $blogs = Blog::where('is_published', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        $articles = Article::where('is_published', true)
            ->latest('published_at')
            ->take(6)
            ->get();

        return view('welcome', compact('blogs', 'articles'));
    }
}
