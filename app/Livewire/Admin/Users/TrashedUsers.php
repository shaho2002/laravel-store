<?php

namespace App\Livewire\Admin\Users;

use App\Models\User;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedUsers extends Component
{
    use WithPagination;

    public $alertMessage;
    public $alertType;
    public $searchedData;

    #[On('restoreUser')]
    public function restoreUser($user_id)
    {
        $user = User::onlyTrashed()->findOrFail($user_id);
        $user->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'کاربر مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    #[On('hardDeleteUser')]
    public function hardDeleteUser($user_id)
    {
        $user = User::onlyTrashed()->findOrFail($user_id);

        $user->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'کاربر به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
        $this->resetPage();
    }

    #[Layout('admin.master'), Title('کاربران حذف شده')]
    public function render()
    {
        if ($this->searchedData) {
            $users = User::query()
                ->where('name', 'like', '%' . $this->searchedData . '%')
                ->onlyTrashed()
                ->paginate(10);
        } else {
            $users = User::onlyTrashed()->paginate(10);
        }

        return view('livewire.admin.users.trashed-users', compact('users'));
    }
}
