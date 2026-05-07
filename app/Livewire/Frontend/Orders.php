<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Orders extends Component
{

    #[Computed(persist: true)]
    public function orders()
    {
        return Order::query()
            ->where('user_id', Auth::user()->id)
            ->with(['order_details', 'order_details.product'])
            ->orderBy('created_at', 'desc')
            ->get();
    }

    #[Layout('frontend.master'), Title('جزئیات محصول')]

    public function render()
    {
        return view('livewire.frontend.orders');
    }
}
