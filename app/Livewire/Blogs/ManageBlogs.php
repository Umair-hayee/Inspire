<?php

namespace App\Livewire\Blogs;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Illuminate\Support\Facades\Auth;

class ManageBlogs extends Component
{
    use WithFileUploads;

    public $blogs;
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
        $this->loadBlogs();
    }

    public function loadBlogs()
    {
        $this->blogs = Blog::where('user_id', Auth::id())->latest()->get();
    }

    public function save()
    {
        $this->validate();

        $imagePath = null;
        if ($this->featured_image) {
            $imagePath = $this->featured_image->store('blogs', 'public');
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
            Blog::find($this->editingId)->update($data);
        } else {
            Blog::create($data);
        }

        $this->reset(['title', 'content', 'featured_image', 'is_published', 'showForm', 'isEditing', 'editingId']);
        $this->loadBlogs();
    }

    public function edit(Blog $blog)
    {
        $this->isEditing = true;
        $this->editingId = $blog->id;
        $this->title = $blog->title;
        $this->content = $blog->content;
        $this->is_published = $blog->is_published;
        $this->showForm = true;
    }

    public function delete(Blog $blog)
    {
        $blog->delete();
        $this->loadBlogs();
    }

    public function render()
    {
        return view('livewire.blogs.manage-blogs');
    }
} 