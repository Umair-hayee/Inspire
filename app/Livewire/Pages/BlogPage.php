<?php

namespace App\Livewire\Pages;

use App\Models\Blog;
use Livewire\Component;

class BlogPage extends Component
{
    public function render()
    {
        $blogs = Blog::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->get();

        return view('livewire.pages.blog-page', [
            'blogs' => $blogs
        ]);
    }
} 