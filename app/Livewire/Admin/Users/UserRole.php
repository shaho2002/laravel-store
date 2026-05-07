<?php

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class UserRole extends Component
{
    public $name;
    public $alertMessage;
    public $alertType;
    public $selectedPermissionId;
    public $selected_permissions=[];
    public $selected_role;

    public function createRole()
    {
        $this->validate([
            'name' => 'required|string|max:30|min:3',
        ]);

        Role::create([
            'name' => $this->name,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = ' نقش با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function editRole($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();
        $role = Role::findOrFail($id);
        $this->selectedPermissionId = $id;
        $this->name = $role->name;
    }

    public function updateRole()
    {
        $this->validate([
            'name' => 'required|string|max:30|min:3',
        ]);

        $Role = Role::findOrFail($this->selectedPermissionId);
        $Role->update([
            'name' => $this->name,
        ]);

        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = ' نقش با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editCancel()
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[On('hardDeleteRole')]
    public function hardDeleteRole($role_id)
    {
        Role::findOrFail($role_id)->forceDelete();
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'نقش  با موفقیت از پایگاه داده حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function selectedRole($role_id)
    {
        $this->name = '';
        $this->selectedPermissionId = '';
        $this->selected_role = Role::findOrFail($role_id);
        $this->selected_permissions = $this->selected_role->permissions->pluck('name');
    }
    public function save_role_permission()
    {
        $this->selected_role->syncPermissions($this->selected_permissions);

        $this->alertType = 'success';
        $this->alertMessage = 'مجوزها برای نقش موردنظر ثبت شدند';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[Layout('admin.master'), Title('مدیریت نقش‌ها')]
    public function render()
    {
        $roles = Role::query()->paginate(10);
        $permissions = Permission::query()->get();
        return view('livewire.admin.users.user-role', compact('roles','permissions'));
    }
}
