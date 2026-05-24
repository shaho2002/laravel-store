<?php

namespace App\Livewire\Admin\HomeSlider;

use App\Enums\HomeSlideStatus;
use App\Models\HomeSlider as ModelsHomeSlider;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;

class HomeSlider extends Component
{
    use WithFileUploads;
    public $name;
    public $link;
    public $image;
    public $status = HomeSlideStatus::Active->value;
    public $sliderIndex;
    public $searchedData;
    public $alertMessage;
    public $alertType;


    public function createSlide()
    {
        $this->validate([
            'name' => 'required',
            'link' => 'required',
            'image' => 'required | mimes:jpeg,png,jpg,gif|max:2048'
        ]);
        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/slides', $imageName, 'public');
        }

        ModelsHomeSlider::query()->create([
            'name' => $this->name,
            'link' => $this->link,
            'status' => $this->status,
            'image' => $this->image ? $imageName : null,
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'اسلاید جدید با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editSlide($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->sliderIndex = $id;
        $slide = ModelsHomeSlider::query()->findOrFail($id);
        $this->name = $slide->name;
        $this->link = $slide->link;
        $this->status = $slide->status;
    }
    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function updateBrand()
    {
        $slide = ModelsHomeSlider::query()->findOrFail($this->sliderIndex);
        $this->validate([
            'name' => 'required',
            'link' => 'required',
            'image' => 'nullable | mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $oldImage = $slide->image;

        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/slides', $imageName, 'public');

            if ($oldImage) {
                $oldImagePath = public_path('images/slides/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $imageName = $oldImage;
        }

        $slide->update([
            'name' => $this->name,
            'link' => $this->link,
            'image' => $imageName,
            'status' => $this->status,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'اسلاید با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    #[On('destroySlide')]
    public function destroySlide($slide_id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        $slide = ModelsHomeSlider::query()->findOrFail($slide_id);
        if ($slide->image) {
            $image = public_path('images/slides/' . $slide->image);
            if (file_exists($image)) {
                unlink($image);
            }
        }
        $slide->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'اسلاید مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[Layout('admin.master'), Title('مدیریت اسلاید‌ها')]
    public function render()
    {
        if ($this->searchedData) {
            $slides = ModelsHomeSlider::query()
                ->where('name', 'like', '%' . $this->searchedData . '%')
                ->paginate(10);
        } else {
            $slides = ModelsHomeSlider::query()->paginate(10);
        }
        return view('livewire.admin.home-slider.home-slider', compact('slides'));
    }
}
