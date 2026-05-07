<?php

namespace App\Livewire\Admin\Articles;

use App\Enums\ArticleCategoryStatus;
use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class EditArticle extends Component
{
    use WithFileUploads;
    public $category_id;
    public $title;
    public $slug;
    public $image;
    public $status;
    public $alertMessage;
    public $alertType;
    public $article;
    public $selectedArticle;
    public function mount(Article $article)
    {
        $this->selectedArticle = $article;
        $this->category_id = $article->articleCategory->id;
        $this->title = $article->title;
        $this->slug = $article->slug;
        $this->article = $article->article;
        $this->status = $article->status;
    }
    public function updateArticle()
    {
        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/articles', $imageName, 'public');
            $oldImagePath = public_path('images/articles/' . $this->selectedArticle->image);
            if (file_exists($oldImagePath)) {
                
                unlink($oldImagePath);
            }
        } else {
            $imageName = $this->selectedArticle->image;
        }
        Article::query()
            ->findOrFail($this->selectedArticle->id)->update([
                'category_id' => $this->category_id,
                'title' => $this->title,
                'image' => $imageName,
                'slug' => $this->slug ? Str::slug($this->slug, '-', null) : $this->article->slug,
                'article' => $this->article,
                'status' => $this->status
            ]);
        session()->flash('success','success');
        return redirect()->route('admin.article.list');
    }

    #[Layout('admin.master'), Title('ویرایش مقاله')]

    public function render()
    {
        $articleCategories = ArticleCategory::query()
            ->where('status', ArticleCategoryStatus::Active->value)
            ->get();
        return view('livewire.admin.articles.edit-article', compact('articleCategories'));
    }
}
