<?php

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;

use Spatie\Permission\Models\Permission;

class UserPermission extends Component
{
    public $name;
    public $alertMessage;
    public $alertType;
    public $selectedPermissionId;

    public function createPermission()
    {
        $this->validate([
            'name' => 'required|string|max:30|min:3',
        ]);

        Permission::create([
            'name' => $this->name,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = ' مجوز با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editPermission($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $Permission = Permission::findOrFail($id);
        $this->selectedPermissionId = $id;
        $this->name = $Permission->name;
    }

    public function updatePermission()
    {
        $this->validate([
            'name' => 'required|string|max:30|min:3',
        ]);

        $Permission = Permission::findOrFail($this->selectedPermissionId);
        $Permission->update([
            'name' => $this->name,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = ' مجوز با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('hardDeletePermission')]
    public function hardDeletePermission($permission_id)
    {
        Permission::findOrFail($permission_id)->forceDelete();
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'مجوز  با موفقیت از پایگاه داده حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[Layout('admin.master'), Title('مدیریت مجوزها')]

    public function render()
    {
        $permissions = Permission::query()->paginate(10);

        return view('livewire.admin.users.user-permission', compact('permissions'));
    }
}
