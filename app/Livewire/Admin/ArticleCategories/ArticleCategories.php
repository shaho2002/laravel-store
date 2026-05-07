<?php

namespace App\Livewire\Admin\ArticleCategories;

use App\Enums\ArticleCategoryStatus;
use App\Models\ArticleCategory;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ArticleCategories extends Component
{
    use WithPagination;
    public $name;
    public $slug;
    public $status = ArticleCategoryStatus::Active->value;
    public $alertMessage;
    public $alertType;
    public $searchedData;
    public $ArticleCategoryIndex;


    public function createArticleCategory()
    {
        $this->validate([
            'name' => 'required',
            'slug' => 'unique:article_categories,slug'
        ]);
        // dd($this->status);
        ArticleCategory::query()->create([
            'name' => $this->name,
            'slug' => $this->slug ? Str::slug($this->slug, '-', null) : str::slug($this->name, '-', null),
            'status' => $this->status
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی مقالات با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editArticleCategory($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->ArticleCategoryIndex = $id;
        $articleCategory = ArticleCategory::query()->findOrFail($id);
        $this->name = $articleCategory->name;
        $this->slug = $articleCategory->slug;
        $this->status = $articleCategory->status;
    }
    public function updateArticleCategory()
    {
        $articleCategory = ArticleCategory::query()->findOrFail($this->ArticleCategoryIndex);
        $this->validate([
            'name' => 'required',
            'slug' => 'nullable|unique:categories,slug,' . $articleCategory->id,
        ]);

        $articleCategory->update([
            'name' => $this->name,
            'slug' => $this->slug,
            'status' => $this->status
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی مقالات با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[On('destroyArticleCategory')]
    public function destroyCategory($articleCategory_id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        ArticleCategory::query()->findOrFail($articleCategory_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی مقالات مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function search()
    {
        $this->resetPage();
    }
    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }



    #[Layout('admin.master'), Title('مدیریت دسته‌بندی مقالات')]

    public function render()
    {
        if ($this->searchedData) {
            $articleCategories = ArticleCategory::query()
                ->where('name', 'like', '%' . $this->searchedData . '%')
                ->paginate(10);
        } else {
            $articleCategories = ArticleCategory::query()
            ->paginate(10);
        }
        return view('livewire.admin.article-categories.article-categories', compact('articleCategories'));
    }
}
