<?php

namespace App\Livewire\Admin\Categories;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\CategoryFeature as feature;
use App\Models\Category;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

class CategoryFeature extends Component
{
    use WithPagination;

    public $name;
    public $category_id;
    public $alertMessage;
    public $alertType;
    public $category;
    public $category_name;
    public $selectedFeatureId;



    public function mount(Category $category)
    {
        $this->category = $category;

        $this->category_name = $category->name;
        $this->category_id =$this->category->id;
    }

    public function createFeature()
    {
        $this->validate([
            'name' => 'required|string|max:30|min:3',
        ]);

        Feature::create([
            'name' => $this->name,
            'category_id' => $this->category_id,
        ]);
        $this->name = '';
        $this->selectedFeatureId = '';
        $this->alertType = 'success';
        $this->alertMessage = 'ویژگی دسته‌بندی با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editFeature($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->selectedFeatureId = $id;
        $feature = Feature::findOrFail($id);
        $this->name = $feature->name;
    }

    public function updateFeature()
    {
        $this->validate([
            'name' => 'required|string|max:30|min:3',
        ]);

        $feature = Feature::findOrFail($this->selectedFeatureId);
        $feature->update([
            'name' => $this->name,
            // 'category_id' => $this->category_id,
        ]);

        $this->name = '';
        $this->selectedFeatureId = '';
        $this->selectedFeatureId = '';
        $this->alertType = 'success';
        $this->alertMessage = 'ویژگی دسته‌بندی با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editCancel()
    {
        $this->name = '';
        $this->selectedFeatureId = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('hardDeleteCategoryFeature')]
    public function hardDeleteCategoryFeature($feature_id)
    {
        Feature::findOrFail($feature_id)->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'ویژگی دسته‌بندی با موفقیت از پایگاه داده حذف شد';
        $this->name = '';
        $this->selectedFeatureId = '';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[Layout('admin.master'), Title('مدیریت ویژگی دسته‌بندی‌ها')]

    public function render()
    {
        $features = feature::with('category')->where('category_id',$this->category->id)->paginate(10);
        $categories = Category::pluck('name', 'id');

        return view('livewire.admin.categories.category-feature', compact('categories', 'features'));
    }
}
