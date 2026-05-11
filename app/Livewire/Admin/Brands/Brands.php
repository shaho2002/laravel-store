<?php

namespace App\Livewire\Admin\Brands;

use Livewire\Attributes\Layout;
use App\Models\Brand;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;

class Brands extends Component
{
    use WithPagination, WithFileUploads;

    #[Validate('required')]
    public $brandName;
    #[Validate('nullable|unique:brands,slug')]
    public $brandSlug;
    #[Validate('nullable|mimes:jpeg,png,jpg|max:2048')]
    public $image;
    public $brandIndex;
    public $alertMessage;
    public $alertType;
    public $searchedData;

    public function createBrand()
    {
        $this->validate();
        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/brands', $imageName, 'public');
        }

        Brand::query()->create([
            'name' => $this->brandName,
            'slug' => $this->brandSlug ? Str::slug($this->brandSlug, '-', null) : Str::slug($this->brandName, '-', null),
            'image' => $this->image ? $imageName : null,
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'برند با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editBrand($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->brandIndex = $id;
        $brand = Brand::query()->findOrFail($id);
        $this->brandName = $brand->name;
        $this->brandSlug = $brand->slug;
    }

    public function updateBrand()
    {
        $brand = Brand::query()->findOrFail($this->brandIndex);
        $this->validate([
            'brandName' => 'required',
            'brandSlug' => 'nullable|unique:brands,slug,' . $brand->id,
        ]);

        $oldImage = $brand->image;

        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/brands', $imageName, 'public');

            if ($oldImage) {
                $oldImagePath = public_path('images/brands/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $imageName = $oldImage;
        }

        $brand->update([
            'name' => $this->brandName,
            'slug' => $this->brandSlug,
            'image' => $imageName
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'برند با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('destroyBrand')]
    public function destroyBrand($brand_id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        Brand::query()->findOrFail($brand_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'برند مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
       $this->resetPage();
    }

    #[Layout('admin.master'), Title('مدیریت برندها')]
    public function render()
    { 
        if ($this->searchedData) {
            $brands = Brand::query()
            ->where('name', 'like', '%' . $this->searchedData . '%')
            ->paginate(10);
        } else {
            $brands = Brand::query()->
            paginate(10);
        }
           
        return view('livewire.admin.brands.brands', compact('brands'));
    }
}