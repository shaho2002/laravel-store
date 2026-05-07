<?php

namespace App\Livewire\Frontend;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class FavoriteList extends Component
{
    public $alertMessage;
    public $alertType;
    public $alertTitle;
    public function deleteFromFavorite($product_id)
    {
        $user = User::query()
            ->findOrFail(Auth::user()->id);
        $user->favorite_products()->detach($product_id);
        $this->alertType = 'success';
        $this->alertTitle = 'موفقیت آمیز';
        $this->alertMessage = 'محصول مورد نظر از علاقه‌مندی ها حذف شد';
        $this->dispatch(
            'sweetAlert',
            message: $this->alertMessage,
            type: $this->alertType,
            title: $this->alertTitle
        );
    }


    #[Layout('frontend.master'), Title('علاقه‌مندی ها ')]

    public function render()
    {
        $user = User::query()
            ->with('favorite_products')
            ->findOrFail(Auth::user()->id);
        return view('livewire.frontend.favorite-list', compact('user'));
    }
}
