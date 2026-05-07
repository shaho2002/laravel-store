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

class ArticlesList extends Component
{
    use WithPagination;
    public $searchedData;
    public $alertMessage;
    public $alertType;
    public $selectedCategory = 'allCategories';
    public $selectedCategory_id;

    public function mount()
    {
        if (session('success')) {
            $this->alertType = 'success';
            $this->alertMessage = 'مقاله مورد نظر با موفقیت ویرایش شد';
            $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
        }
    }

    #[On('destroyArticle')]
    public function destroyArticle($article_id)
    {
        $article = Article::query()
            ->findOrFail($article_id);
        $article->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'مقاله مورد نظر با موفقیت حذف شد';
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
                    ->where('title', 'like', '%' . $this->searchedData . '%')
                    ->where('article_category_id', $this->selectedCategory_id)
                    ->with('articleCategory')
                    ->paginate(10);
            } else {
                $articles = Article::query()
                    ->with('articleCategory')
                    ->where('article_category_id', $this->selectedCategory_id)
                    ->paginate(10);
            }
        } else {
            if ($this->searchedData) {
                $articles = Article::query()
                    ->where('title', 'like', '%' . $this->searchedData . '%')
                    ->with('articleCategory')
                    ->paginate(10);
            } else {
                $articles = Article::query()
                    ->with('articleCategory')
                    ->paginate(10);
            }
        }


        $articleCategories = ArticleCategory::query()
            ->where('status', ArticleCategoryStatus::Active->value)
            ->pluck('name', 'id');
        return view('livewire.admin.articles.articles-list', compact('articles', 'articleCategories'));
    }
}
