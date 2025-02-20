<?php

namespace App\Livewire\Articles;

use App\Models\Article; 
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class ManageArticles extends Component
{
    use WithFileUploads;

    public $articles;
    public $showForm = false;
    public $isEditing = false;
    public $editingId = null;

    #[Rule('required|min:3')]
    public $title = '';

    #[Rule('required|min:10')]
    public $content = '';

    #[Rule('nullable|image|max:1024')]
    public $featured_image;

    public $is_published = false;

    public function mount()
    {
        $this->loadArticles();
    }

    public function loadArticles()
    {
        $this->articles = Article::where('user_id', Auth::id())->latest()->get();
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('articles', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'is_published' => $this->is_published,
            'user_id' => Auth::id(),
            'published_at' => $this->is_published ? now() : null,
        ];

        if ($imagePath) {
            $data['featured_image'] = $imagePath;
        }

        if ($this->isEditing) {
            Article::find($this->editingId)->update($data);
        } else {
            Article::create($data);
        }

        $this->reset(['title', 'content', 'featured_image', 'is_published', 'showForm', 'isEditing', 'editingId']);
        $this->loadArticles();
    }

    public function edit(Article $article)
    {
        $this->isEditing = true;
        $this->editingId = $article->id;
        $this->title = $article->title;
        $this->content = $article->content;
        $this->is_published = $article->is_published;
        $this->showForm = true;
    }

    public function delete(Article $article)
    {
        $article->delete();
        $this->loadArticles();
    }

    public function render()
    {
        return view('livewire.articles.manage-articles');
    }
} 