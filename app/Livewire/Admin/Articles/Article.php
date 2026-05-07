<?php

namespace App\Livewire\Admin\Articles;

use App\Enums\ArticleCategoryStatus;
use App\Enums\ArticleStatus;
use App\Models\Article as ModelsArticle;
use App\Models\ArticleCategory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class Article extends Component
{
    use WithFileUploads;
    public $category_id;
    public $title;
    public $slug;
    public $image;
    public $article;
    public $status = ArticleStatus::Active->value;
    public $alertMessage;
    public $alertType;

    public function createArticle()
    {
        $this->validate([
            'title' => 'required',
            'slug' => 'nullable|unique:articles,slug',
            'image' => 'required|mimes:jpeg,png,jpg|max:2048',
            'article' => 'required',
            'category_id' => 'required'
        ]);
        $imageName = $this->image->hashName();
        $this->image->storeAs('images/articles', $imageName, 'public');
        ModelsArticle::query()->create([
            'user_id' => Auth::user()->id,
            'article_category_id' => $this->category_id,
            'title' => $this->title,
            'slug' => $this->slug ? Str::slug($this->slug, '-', null) : str::slug($this->title, '-', null),
            'image' => $imageName,
            'article' => $this->article,
            'status' => $this->status
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'مقاله جدید با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[Layout('admin.master'), Title('ایجاد مقاله جدید')]

    public function render()
    {
        $articleCategories = ArticleCategory::query()
            ->where('status', ArticleCategoryStatus::Active->value)
            ->paginate(10);
        return view('livewire.admin.articles.article', compact('articleCategories'));
    }
}
