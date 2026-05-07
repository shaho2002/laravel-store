<?php

namespace App\Livewire\Frontend;

use App\Enums\OrderStatus;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;

class Payment extends Component
{
    #[Url]
    public $Authority;
    #[Url]
    public $Status;

    public $order;
    public function mount()
    {
        $this->order = Order::with('order_details.product.ProductPrices')
            ->where('transaction_id', $this->Authority)
            ->first();
        if (!$this->order) {
            return redirect(route('mainPage'));
        }

        DB::transaction(function () {

            if (trim(strtoupper($this->Status)) === 'OK') {
                $this->order->update([
                    'status' => OrderStatus::Successful->value
                ]);

                foreach ($this->order->order_details as $order_detail) {
                    $product = $order_detail->product;

                    $product_price = optional($product->ProductPrices)
                        ->where('color_id', $order_detail->color_id)
                        ->where('warranty_id', $order_detail->warranty_id)
                        ->first();

                    if ($product_price) {
                        $product_price->increment('sold', $order_detail->count);
                        $product_price->decrement('count', $order_detail->count);
                        $product_price->decrement('max_sell', $order_detail->count);
                    }

                    $product->increment('sold', $order_detail->count);
                    $product->decrement('count', $order_detail->count);
                    $product->decrement('max_sell', $order_detail->count);
                    $carts  = Cart::query()->where('user_id', Auth::user()->id)->get();
                    foreach ($carts as $cart) {
                        $cart->delete();
                    }
                }
            } else {
                $this->order->update([
                    'status' => OrderStatus::Failed->value
                ]);
            }
        });
    }
    #[Layout('frontend.master'), Title('نتیجه تراکنش')]
    public function render()
    {
        return view('livewire.frontend.payment');
    }
}
