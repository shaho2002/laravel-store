<?php

namespace App\Livewire\Admin\Categories;

use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;


class TrashedCategories extends Component
{
    use WithPagination;

    public $alertMessage;
    public $alertType;
    public $searchedData;

    #[On('restoreCategory')]
    public function restoreCategory($category_id)
    {
        $category = Category::onlyTrashed()->findOrFail($category_id);
        $category->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[On('hardDeleteCategory')]
    public function hardDeleteCategory($category_id)
    {
        $category = Category::query()->onlyTrashed()->findOrFail($category_id);
        $imagePath = 'images/categories/' . $category->image;
        if ($category->image && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $category->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته بندی به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function search()
    {
        $this->resetPage();
    }


    #[Layout('admin.master'), Title('دسته‌بندی‌های حذف شده')]
    public function render()
    {
        if ($this->searchedData) {
            $categories = Category::where('name', 'like', '%' . $this->searchedData . '%')
            ->onlyTrashed()
            ->paginate(10);
        } else {
            $categories = Category::query()
            ->onlyTrashed()
            ->paginate(10);
        }
        return view('livewire.admin.categories.trashed-categories', compact('categories'));
    }
}
