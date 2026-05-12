<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Attributes\Layout;
use App\Models\Category;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Illuminate\Support\Str;
use Livewire\WithFileUploads;

class Categories extends Component
{
    use WithPagination, WithFileUploads;

    #[Validate('required')]
    public $categoryName;
    #[Validate('nullable|unique:categories,slug')]
    public $categorySlug;
    #[Validate('nullable|mimes:jpeg,png,jpg,webp|max:2048')]
    public $image;
    public $parent_id;
    public $categoryIndex;
    public $alertMessage;
    public $alertType;
    public $selectedCategory = 'originalCategories';
    public $searchedData;

    public function createCategory()
    {
        $this->validate();
        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/categories', $imageName, 'public');
        }

        Category::query()->create([
            'name' => $this->categoryName,
            'slug' => $this->categorySlug ? str::slug($this->categorySlug, '-', null) : str::slug($this->categoryName, '-', null),
            'image' => $this->image ? $imageName : null,
            'parent_id' => $this->parent_id ? $this->parent_id : '0',
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editCategory($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->categoryIndex = $id;
        $category = Category::query()->findOrFail($id);
        $this->categoryName = $category->name;
        $this->categorySlug = $category->slug;
    }

    public function updateCategory()
    {
        $category = Category::query()->findOrFail($this->categoryIndex);
        $this->validate([
            'categoryName' => 'required',
            'categorySlug' => 'nullable|unique:categories,slug,' . $category->id,
        ]);

        $oldImage = $category->image;

        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/categories', $imageName, 'public');

            if ($oldImage) {
                $oldImagePath = public_path('images/categories/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $imageName = $oldImage;
        }

        $category->update([
            'name' => $this->categoryName,
            'slug' => $this->categorySlug,
            'image' => $imageName
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('destroyCategory')]
    public function destroyCategory($category_id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        Category::query()->findOrFail($category_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته‌بندی مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function search()
    {
        $this->resetPage();
    }

    public function setParent()
    {
        $this->searchedData = null;
        $this->resetPage();
    }

    #[Layout('admin.master'), Title('مدیریت دسته‌بندی‌ها')]
    public function render()
    {
        if ($this->searchedData) {
            $categories = Category::query()->where('name', 'like', '%' . $this->searchedData . '%')->paginate(10);
        } else {
            if ($this->selectedCategory === 'originalCategories') {
                $categories = Category::query()->where('parent_id', 0)->paginate(10);
            } elseif ($this->selectedCategory === 'subCategories') {
                $categories = Category::query()->where('parent_id', '!=', 0)->paginate(10);
            } else {
                $categories = Category::query()->where('parent_id', $this->selectedCategory)->paginate(10);
            }
        }

        $allCategories = Category::query()->where('parent_id', 0)->pluck('name', 'id');
        return view('livewire.admin.categories.categories', compact('allCategories', 'categories'));
    }
}
