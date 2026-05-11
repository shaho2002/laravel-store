<?php

namespace App\Livewire\Admin\HomeSlider;

use App\Models\HomeSlider as ModelsHomeSlider;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class HomeSlider extends Component
{
    public $sliderIndex;
    public $searchedData;

    #[Layout('admin.master'), Title('مدیریت برندها')]

    public function render()
    {
        if ($this->searchedData) {
            $slides = ModelsHomeSlider::query()
            ->where('name', 'like', '%' . $this->searchedData . '%')
            ->paginate(10);
        } else {
            $slides = ModelsHomeSlider::query()->
            paginate(10);
        }
        return view('livewire.admin.home-slider.home-slider', compact('slides'));
    }
}
