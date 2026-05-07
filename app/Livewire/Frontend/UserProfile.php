<?php

namespace App\Livewire\Frontend;

use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class UserProfile extends Component
{
    use WithPagination;

    public $orders_count;
    public $order_details_count;

    #[Computed(persist:true)]
   


    #[Layout('frontend.master'), Title('جزئیات محصول')]
    public function render()
    {
        $query = Order::query()
        ->where('user_id', Auth::user()->id)
        ->with(['order_details','order_details.product'])
        ->orderBy('created_at', 'desc');

        $this->orders_count = $query->get()->count();
        
        $orders = $query
        ->take(3)
        ->get();

        return view('livewire.frontend.user-profile',compact('orders')) ;
    }
}
