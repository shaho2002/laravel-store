<?php

namespace App\Livewire\Frontend;

use App\Enums\ArticleCategoryStatus;
use App\Enums\ArticleStatus;
use App\Models\Article;
use App\Models\ArticleCategory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ArticlesList extends Component
{
    use WithPagination;
    public $order = 'newest';
    public $selected_category_id = null;

    public function orderBy($data)
    {
        $this->order = $data;
        $this->resetPage();
    }
    #[Computed(persist: true)]
    public function categories()
    {
        return ArticleCategory::query()
            ->where('status', ArticleCategoryStatus::Active->value)
            ->get();
    }
    public function setCategory($category_id)
    {
        $this->selected_category_id = $category_id;
    }
    #[Layout('frontend.master'), Title(content: 'لیست مقالات')]

    public function render()
    {
        if ($this->selected_category_id !== null) {
            $query = Article::query()
                ->where('status', ArticleStatus::Active->value)
                ->where('article_category_id', $this->selected_category_id);
        } else {
            $query = Article::query()
                ->where('status', ArticleStatus::Active->value);
        }

        if ($this->order == 'newest') {
            $articles = $query
                ->orderBy('created_at', 'desc')
                ->paginate(18);
        } elseif ($this->order == 'oldest') {
            $articles = $query
                ->orderBy('created_at', 'asc')
                ->paginate(18);
        } elseif ($this->order == 'mostView') {
            $articles = $query
                ->orderBy('view', 'desc')
                ->paginate(18);
        }
        return view('livewire.frontend.articles-list', compact('articles'));
    }
}
