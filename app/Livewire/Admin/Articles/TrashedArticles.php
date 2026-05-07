<?php

namespace App\Livewire\Admin\Articles;

use App\Enums\ArticleCategoryStatus;
use App\Models\Article;
use App\Models\ArticleCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedArticles extends Component
{
    use WithPagination;
    public $searchedData;
    public $alertMessage;
    public $alertType;
    public $selectedCategory = 'allCategories';
    public $selectedCategory_id;

    #[On('restoreArticle')]
    public function restoreArticle($article_id)
    {
        $article = Article::onlyTrashed()
            ->findOrFail($article_id);
        $article->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'مقاله مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[On('hardDeleteArticle')]
    public function hardDeleteArticle($article_id)
    {
        $article = Article::query()
            ->onlyTrashed()
            ->findOrFail($article_id);

        if ($article->image) {
            $imagePath = public_path('images/articles/' . $article->image);
            unlink($imagePath);
        }
        $article->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = ' مقاله به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function setCategoryFilter()
    {
        $this->selectedCategory_id = $this->selectedCategory;
    }
    public function search()
    {
        $this->resetPage();
    }
    #[Layout('admin.master'), Title('لیست مقالات')]

    public function render()
    {
        if ($this->selectedCategory !== 'allCategories') {
            if ($this->searchedData) {

                $articles = Article::query()
                    ->onlyTrashed()
                    ->where('title', 'like', '%' . $this->searchedData . '%')
                    ->where('article_category_id', $this->selectedCategory_id)
                    ->with('articleCategory')
                    ->paginate(10);
            } else {
                $articles = Article::query()
                    ->onlyTrashed()
                    ->with('articleCategory')
                    ->where('article_category_id', $this->selectedCategory_id)
                    ->paginate(10);
            }
        } else {
            if ($this->searchedData) {
                $articles = Article::query()
                    ->onlyTrashed()
                    ->where('title', 'like', '%' . $this->searchedData . '%')
                    ->with('articleCategory')
                    ->paginate(10);
            } else {
                $articles = Article::query()
                    ->onlyTrashed()
                    ->with('articleCategory')
                    ->paginate(10);
            }
        }
        $articleCategories = ArticleCategory::query()
            ->where('status', ArticleCategoryStatus::Active->value)
            ->pluck('name', 'id');

        return view('livewire.admin.articles.trashed-articles', compact('articleCategories', 'articles'));
    }
}
