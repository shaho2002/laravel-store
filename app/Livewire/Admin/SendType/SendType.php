<?php

namespace App\Livewire\Admin\SendType;

use App\Models\SendType as ModelsSendType;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class SendType extends Component
{
    use WithPagination;
    public $name;
    public $cost;
    public $status = 'active';
    public $SendTypeIndex;
    public $alertType;
    public $alertMessage;
    public $searchedData;

    public function createSendType()
    {
        ModelsSendType::query()->create([
            'name' => $this->name,
            'cost' => $this->cost,
            'status' => $this->status,
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'شیوه ارسال با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editSendType($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $this->SendTypeIndex = $id;
        $sendType = ModelsSendType::query()->findOrFail($id);
        $this->name = $sendType->name;
        $this->cost = $sendType->cost;
        $this->status = $sendType->status;
    }
    public function updateCategory()
    {
        $sendType = ModelsSendType::query()->findOrFail($this->SendTypeIndex);
        // $this->validate([
        //     'categoryName' => 'required',
        //     'categorySlug' => 'nullable|unique:categories,slug,' . $category->id,
        // ]);

        $sendType->update([
            'name' => $this->name,
            'cost' => $this->cost,
            'status' => $this->status
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'شیوه ارسال با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }
    public function search()
    {
        $this->resetPage();
    }
    #[On('hardDeleteSendType')]
    public function hardDeleteSendType($sendType_id)
    {
        ModelsSendType::findOrFail($sendType_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = ' شیوه پرداخت با موفقیت از پایگاه داده حذف شد';
        $this->name = '';
        $this->SendTypeIndex = '';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }


    #[Layout('admin.master'), Title('مدیریت شیوه‌های ارسال')]

    public function render()
    {
        if ($this->searchedData) {
            $sendTypes = ModelsSendType::query()->where('name', 'like', '%' . $this->searchedData . '%')->paginate(10);
        } else {
            $sendTypes = ModelsSendType::query()->paginate(10);
        }
        return view('livewire.admin.send-type.send-type', compact('sendTypes'));
    }
}
