<?php

namespace App\Livewire\Admin\Colors;

use App\Models\Color; 
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedColors extends Component
{
    use WithPagination;

    public $alertMessage;
    public $alertType;
    public $searchedData;

    #[On('restoreColor')]
    public function restoreColor($color_id)
    {
        $color = Color::onlyTrashed()->findOrFail($color_id);
        $color->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'رنگ مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    
    #[On('hardDeleteColor')]
    public function hardDeleteColor($color_id)
    {
        $color = Color::onlyTrashed()->findOrFail($color_id);
        $color->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'رنگ به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
       $this->resetPage();
    }

    #[Layout('admin.master'), Title('رنگ‌های حذف شده')]
    public function render()
    {
        if ($this->searchedData) {
            $colors = Color::where('name', 'like', '%' . $this->searchedData . '%')->onlyTrashed()->paginate(10);
        } else {
            $colors = Color::onlyTrashed()->paginate(10);
        }
        
        return view('livewire.admin.colors.trashed-colors', compact('colors'));
    }
}