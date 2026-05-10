<?php

namespace App\Livewire\Frontend;

use App\Enums\ArticleStatus;
use App\Models\Article as ModelsArticle;
use App\Models\ArticleCategory;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Article extends Component
{
    public $article;
    public function mount($article_slug)
    {
        $this->article = ModelsArticle::query()
            ->where('status', ArticleStatus::Active->value)
            ->where('slug', $article_slug)
            ->with(['articleCategory', 'user'])
            ->firstOrFail();
    }
    #[Computed(persist:true)]
    public function newestArticles()
    {
        return ModelsArticle::query()
        ->where('status', ArticleStatus::Active->value)
        ->orderBy('created_at','desc')->take(10)->get();
    }
    #[Computed(persist:true)]
    public function articleCategories()
    {
        return ArticleCategory::query()
        ->where('status', ArticleStatus::Active->value)
        ->get();
    }
    public function setArticleCategory($article_category_id)
    {
        session()->flash('articleCategory_id', $article_category_id);
        return redirect()->route('articles.list');
    }

    #[Layout('frontend.master'), Title(content: 'مقاله')]

    public function render()
    {
        return view('livewire.frontend.article');
    }
}
