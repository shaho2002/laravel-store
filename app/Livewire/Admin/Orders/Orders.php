<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderStatus;
use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Orders extends Component
{
    use WithPagination;

    public $searchedData;
    
     public function search()
    {
        $this->resetPage();
    }


    #[Layout('admin.master'), Title('سفارشات')]
    public function render()
    {
        if($this->searchedData)
        {
            $orders = Order::query()
            ->with(['user', 'user_address'])
            ->where('status', OrderStatus::Successful->value)
            ->where('user_name', 'like', '%' . $this->searchedData . '%')->paginate(10);
            
        }else{
            $orders =  Order::query()
            ->with(['user', 'user_address'])
            ->where('status', OrderStatus::Successful->value)
            ->paginate(10);
        }
        
        return view('livewire.admin.orders.orders', compact('orders'));
    }
}
