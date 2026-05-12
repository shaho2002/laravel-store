<?php

namespace App\Livewire\Admin\HomeSlider;

use App\Enums\HomeSlideStatus;
use App\Models\HomeSlider as ModelsHomeSlider;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
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
