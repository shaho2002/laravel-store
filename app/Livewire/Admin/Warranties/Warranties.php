<?php

namespace App\Livewire\Admin\Warranties;

use Livewire\Attributes\Layout;
use App\Models\Warranty;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Warranties extends Component
{
    use WithPagination, WithFileUploads;

    #[Validate('required')]
    public $warrantyName;
    
    #[Validate('required|unique:warranties,code')]
    public $warrantyCode;
    
    #[Validate('nullable')]
    public $warrantyDescription;
    
    #[Validate('nullable|mimes:jpeg,png,jpg|max:2048')]
    public $image;
    
    public $warrantyIndex;
    public $alertMessage;
    public $alertType;
    public $searchedData;

    public function createWarranty()
    {
        $this->validate();

        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/warranties', $imageName, 'public');
        }

        Warranty::query()->create([
            'name' => $this->warrantyName,
            'code' => $this->warrantyCode,
            'description' => $this->warrantyDescription,
            'image' => $this->image ? $imageName : null,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'گارانتی با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editWarranty($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->warrantyIndex = $id;
        $warranty = Warranty::query()->findOrFail($id);
        $this->warrantyName = $warranty->name;
        $this->warrantyCode = $warranty->code;
        $this->warrantyDescription = $warranty->description;
    }

    public function updateWarranty()
    {
        $warranty = Warranty::query()->findOrFail($this->warrantyIndex);
        
        $this->validate([
            'warrantyName' => 'required',
            'warrantyCode' => 'required|unique:warranties,code,' . $warranty->id,
        ]);

        $oldImage = $warranty->image;

        if ($this->image) {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/warranties', $imageName, 'public');

            if ($oldImage) {
                $oldImagePath = public_path('images/warranties/' . $oldImage);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        } else {
            $imageName = $oldImage;
        }

        $warranty->update([
            'name' => $this->warrantyName,
            'code' => $this->warrantyCode,
            'description' => $this->warrantyDescription,
            'image' => $imageName,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'گارانتی با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('destroyWarranty')]
    public function destroyWarranty($warranty_id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        Warranty::query()->findOrFail($warranty_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'گارانتی مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
        $this->resetPage();
    }

    #[Layout('admin.master'), Title('مدیریت گارانتی‌ها')]
    public function render()
    {
        if ($this->searchedData) {
            $warranties = Warranty::where('name', 'like', '%' . $this->searchedData . '%')
                ->orWhere('code', 'like', '%' . $this->searchedData . '%')
                ->paginate(10);
        } else {
            $warranties = Warranty::query()->paginate(10);
        }

        return view('livewire.admin.warranties.warranties', compact('warranties'));
    }
}