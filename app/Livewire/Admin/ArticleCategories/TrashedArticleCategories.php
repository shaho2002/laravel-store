<?php

namespace App\Livewire\Admin\Articlecategories;

use App\Models\ArticleCategory;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedArticleCategories extends Component
{
    use WithPagination;
    public $alertMessage;
    public $alertType;
    public $searchedData;
    

    #[On('restoreArticleCategory')]
    public function restoreArticleCategory($articleCategory_id)
    {
        $category = ArticleCategory::onlyTrashed()->findOrFail($articleCategory_id);
        $category->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[On('hardDeleteArticleCategory')]
    public function hardDeleteArticleCategory($articleCategory_id)
    {
        $articleCategory = ArticleCategory::query()->onlyTrashed()->findOrFail($articleCategory_id);

        $articleCategory->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته بندی به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    
    public function search()
    {
        $this->resetPage();
    }


    #[Layout('admin.master'), Title('دسته‌بندی‌ مقالات حذف شده حذف شده')]

    public function render()
    {
        if($this->searchedData)
        {
            $articleCategories = ArticleCategory::query()
            ->where('name', 'like', '%' . $this->searchedData . '%')
            ->onlyTrashed()
            ->paginate(10);
        }else{
            $articleCategories = ArticleCategory::query()
            ->onlyTrashed()
            ->paginate(10);
        }
        return view('livewire.admin.article-categories.trashed-article-categories', compact('articleCategories'));
    }
}
