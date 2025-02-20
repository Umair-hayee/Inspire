<?php

namespace App\Livewire\Pages;

use App\Models\Article;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlesPage extends Component
{
    use WithPagination;

    public function render()
    {
        $articles = Article::where('is_published', true)
            ->orderBy('published_at', 'desc')
            ->paginate(9);

        return view('livewire.pages.articles-page', [
            'articles' => $articles
        ])->layout('layouts.app');
    }
} 