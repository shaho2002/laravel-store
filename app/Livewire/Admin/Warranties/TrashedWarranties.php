<?php

namespace App\Livewire\Admin\Warranties;

use App\Models\Warranty;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedWarranties extends Component
{
    use WithPagination;

    public $alertMessage;
    public $alertType;
    public $searchedData;

    #[On('restoreWarranty')]
    public function restoreWarranty($warranty_id)
    {
        $warranty = Warranty::onlyTrashed()->findOrFail($warranty_id);
        $warranty->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'گارانتی مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    
    #[On('hardDeleteWarranty')]
    public function hardDeleteWarranty($warranty_id)
    {
        $warranty = Warranty::onlyTrashed()->findOrFail($warranty_id);
        $imagePath = 'images/warranties/' . $warranty->image;
        if ($warranty->image && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $warranty->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'گارانتی به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
       $this->resetPage();
    }

    #[Layout('admin.master'), Title('گارانتی‌های حذف شده')]
    public function render()
    {
        if ($this->searchedData) {
            $warranties = Warranty::where('name', 'like', '%' . $this->searchedData . '%')->onlyTrashed()->paginate(10);
        } else {
            $warranties = Warranty::onlyTrashed()->paginate(10);
        }
        
        return view('livewire.admin.warranties.trashed-warranties', compact('warranties'));
    }
}