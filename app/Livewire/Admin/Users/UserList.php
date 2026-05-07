<?php

namespace App\Livewire\Admin\Users;

use Livewire\Attributes\Layout;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Attributes\Validate;
use Livewire\WithPagination;
use Spatie\Permission\Models\Role;

class UserList extends Component
{
    use WithPagination;

    #[Validate('required')]
    public $name;
    #[Validate('nullable|unique:users,mobile')]
    public $mobile;
    #[Validate('required|unique:users,email')]
    public $email;
    #[Validate('required|min:6')]
    public $password;
    public $userIndex;
    public $searchedData;
    public $selected_roles = [];
    public $selected_user;
    public $alertMessage;
    public $alertType;

    public function createUser()
    {
        $this->validate();
        User::query()->create([
            'name' => $this->name,
            'mobile' => $this->mobile,
            'email' => $this->email,
            'password' => $this->password,
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'کاربر با موفقیت ایجاد شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editUser($id)
    {
        $this->resetErrorBag();
        $this->resetValidation();

        $this->userIndex = $id;
        $user = User::query()->findOrFail($id);
        $this->name = $user->name;
        $this->email = $user->email;
        $this->mobile = $user->mobile;
    }
    public function updateUser()
    {
        $user = User::query()->findOrFail($this->userIndex);
        $this->validate([
            'name' => 'required',
            'mobile' => 'nullable|unique:users,mobile,' . $user->id,
            'email' => 'nullable|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6'
        ]);
        $user->update([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => $this->password ? Hash::make($this->password) : $user->password
        ]);
        $this->reset();
        $this->alertType = 'success';
        $this->alertMessage = 'کاربر با موفقیت ویرایش شد';
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
    #[On('destroyUser')]
    public function destroyColor($user_id)
    {
        $this->reset();
        $this->resetErrorBag();
        $this->resetValidation();
        User::query()->findOrFail($user_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'کاربر مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function selectedUser($user_id)
    {
        // $this->name = '';
        // $this->selectedPermissionId = '';
        $this->selected_user = User::findOrFail($user_id);
        $this->selected_roles = $this->selected_user->roles->pluck('name');
    }
    public function save_user_roles()
    {
        $this->selected_user->syncRoles($this->selected_roles);

        $this->alertType = 'success';
        $this->alertMessage = 'نقش‌ها برای کاربر موردنظر ثبت شدند';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }



    #[Layout('admin.master'), Title('مدیریت کاربران')]

    public function render()
    {
        if ($this->searchedData) {
            $users = User::query()
                ->where('name', 'like', '%' . $this->searchedData . '%')
                ->paginate(10);
        } else {
            $users = User::query()
                ->paginate(10);
        }
        $roles = Role::query()->get();
        return view('livewire.admin.users.user-list', compact('users', 'roles'));
    }
}
