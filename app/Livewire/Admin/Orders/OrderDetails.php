<?php

namespace App\Livewire\Admin\Orders;

use App\Enums\OrderDetailsStatus;
use App\Models\OrderDetail;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class OrderDetails extends Component
{
    use WithPagination;
    public $order_id;

    public function mount($order)
    {
        $this->order_id = $order;
    }
    public function change_status($id)
    {
        $order_detail = OrderDetail::query()->where('id', $id)->first();
        if($order_detail->status === 'in_progress')
        {
            $order_detail->update([
                'status' => OrderDetailsStatus::Sent->value
            ]);

        }elseif($order_detail->status === 'canceled')
        {
            $order_detail->update([
                'status' => OrderDetailsStatus::InProgress->value
            ]);
        }elseif($order_detail->status === 'sent')
        {
            $order_detail->update([
                'status' => OrderDetailsStatus::Canceled->value
            ]);
        }
    }


    #[Layout('admin.master'), Title('جزئیات سفارش')]
    public function render()
    {
        $details = OrderDetail::with(['product','color','warranty'])
            ->where('order_id', $this->order_id)
            ->paginate(10);
        return view('livewire.admin.orders.order-details', compact('details'));
    }
}
