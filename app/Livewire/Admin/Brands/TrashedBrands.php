<?php

namespace App\Livewire\Admin\Brands;

use App\Models\Brand;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedBrands extends Component
{
    use WithPagination;

    public $alertMessage;
    public $alertType;
    public $searchedData;

    #[On('restoreBrand')]
    public function restoreBrand($brand_id)
    {
        $brand = Brand::onlyTrashed()->findOrFail($brand_id);
        $brand->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'برند مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[On('hardDeleteBrand')]
    public function hardDeleteBrand($brand_id)
    {
        $brand = Brand::query()->onlyTrashed()->findOrFail($brand_id);
        $imagePath = 'images/brands/' . $brand->image;
        if ($brand->image && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $brand->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'دسته بندی به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
        $this->resetPage();
    }

    #[Layout('admin.master'), Title('برندهای حذف شده')]
    public function render()
    {
        if ($this->searchedData) {
            $brands = Brand::where('name', 'like', '%' . $this->searchedData . '%')->onlyTrashed()->paginate(10);
        } else {
            $brands = Brand::query()->onlyTrashed()->paginate(10);
        }
        return view('livewire.admin.brands.trashed-brands', compact('brands'));
    }
}