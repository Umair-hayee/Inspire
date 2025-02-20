<?php

namespace App\Livewire\Posts;

use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;

class ManagePosts extends Component
{
    use WithFileUploads;

    public $posts;
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
        $this->loadPosts();
    }

    public function loadPosts()
    {
        $this->posts = Post::where('user_id', auth()->id())->latest()->get();
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('posts', 'public');
        }

        $data = [
            'title' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'is_published' => $this->is_published,
            'user_id' => auth()->id(),
            'published_at' => $this->is_published ? now() : null,
        ];

        if ($imagePath) {
            $data['featured_image'] = $imagePath;
        }

        if ($this->isEditing) {
            Post::find($this->editingId)->update($data);
        } else {
            Post::create($data);
        }

        $this->reset(['title', 'content', 'featured_image', 'is_published', 'showForm', 'isEditing', 'editingId']);
        $this->loadPosts();
    }

    public function edit(Post $post)
    {
        $this->isEditing = true;
        $this->editingId = $post->id;
        $this->title = $post->title;
        $this->content = $post->content;
        $this->is_published = $post->is_published;
        $this->showForm = true;
    }

    public function delete(Post $post)
    {
        $post->delete();
        $this->loadPosts();
    }

    public function render()
    {
        return view('livewire.posts.manage-posts');
    }
} 