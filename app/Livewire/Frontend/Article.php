<?php

namespace App\Livewire\Frontend;

use App\Enums\ArticleStatus;
use App\Models\Article as ModelsArticle;
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

    #[Layout('frontend.master'), Title(content: 'مقاله')]

    public function render()
    {
        return view('livewire.frontend.article');
    }
}
