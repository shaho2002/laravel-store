<?php

namespace App\Livewire\Admin\Colors;

use Livewire\Attributes\Layout;
use App\Models\Color; 
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;

class Colors extends Component
{
    use WithPagination;

    #[Validate('required')]
    public $colorName;
    #[Validate('required|unique:colors,code')]
    public $colorCode;
    public $colorIndex;
    public $alertMessage;
    public $alertType;
    public $searchedData;

    public function createColor()
    {
        $this->validate();
        
        Color::query()->create([
            'name' => $this->colorName,
            'code' => $this->colorCode,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'رنگ با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editColor($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->colorIndex = $id;
        $color = Color::query()->findOrFail($id);
        $this->colorName = $color->name;
        $this->colorCode = $color->code;
    }

    public function updateColor()
    {
        $color = Color::query()->findOrFail($this->colorIndex);
        $this->validate([
            'colorName' => 'required',
            'colorCode' => 'required|unique:colors,code,' . $color->id,
        ]);

        $color->update([
            'name' => $this->colorName,
            'code' => $this->colorCode,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'رنگ با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('destroyColor')]
    public function destroyColor($color_id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        Color::query()->findOrFail($color_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'رنگ مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
        $this->resetPage();
    }

    #[Layout('admin.master'), Title('مدیریت رنگ‌ها')]
    public function render()
    {
        if ($this->searchedData) {
            $colors = Color::query()->where('name', 'like', '%' . $this->searchedData . '%')->paginate(10);
        } else {
            $colors = Color::query()->paginate(10);
        }

        return view('livewire.admin.colors.colors', compact('colors'));
    }
}