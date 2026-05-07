<?php

namespace App\Livewire\Frontend;

use App\Enums\sendTypeStatus;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\SendType;
use App\Models\User;
use App\Models\UserAddress as ModelsUserAddress;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment;

class UserAddress extends Component
{
    public $name;
    public $family;
    public $province;
    public $city;
    public $address;
    public $postcode;
    public $mobile;
    public $description;
    public $realCost;
    public $finalCost;
    public $discount;
    public $count;
    public $user;
    public $send_type;
    public $carts;

    public function mount()
    {
        $this->user = User::query()->where('id', Auth::user()->id)->with('address')->first();
        if ($this->user->address) {
            $userAddress = $this->user->address;
            $this->name = $userAddress->name;
            $this->family = $userAddress->family;
            $this->address = $userAddress->address;
            $this->province = $userAddress->province;
            $this->city = $userAddress->city;
            $this->postcode = $userAddress->postcode;
            $this->mobile = $userAddress->mobile;
            $this->description = $userAddress->description;
        }
        $this->send_type = SendType::query()->first();

        $this->carts = Cart::query()
            ->where('user_id', Auth::user()->id)
            ->with('product.warranties')
            ->with('product.colors')
            ->with('product.productPrices')->get();

        foreach ($this->carts as $cart) {

            if ($cart->product->productPrices) {
                $product_price = $cart->product->productPrices
                    ->where('color_id', $cart->color_id)
                    ->where('warranty_id', $cart->warranty_id)->first();
                if ($product_price) {
                    $this->realCost = $this->realCost + ($product_price->price  * $cart->count);

                    if ($product_price->discount) {
                        $this->discount = $this->discount + ($product_price->price * $product_price->discount / 100) * $cart->count;
                    }
                } else {
                    $this->realCost = ($this->realCost + $cart->product->price * $cart->count);
                    if ($cart->product->discount) {
                        $this->discount = $this->discount + ($cart->product->price * $cart->product->discount / 100) * $cart->count;
                    }
                }
            }

            $this->count = $this->count + $cart->count;
        }
        $this->finalCost = $this->realCost - $this->discount;
    }
    #[Computed(persist: true)]
    public function sendTypes()
    {
        return SendType::query()->where('status', sendTypeStatus::Active->value)->get();
    }

    public function payment()
    {
        // check user adders
        $this->validate([
            'name' => 'required | min:3 | max:30',
            'family' => 'required | min:3 | max:30',
            'address' => 'required | min:10 | max:225',
            'province' => 'required | min:3 | max:30',
            'city' => 'required | min:3 | max:20',
            'postcode' => 'required  | min:10 | max:20 ',
            'mobile' => 'required | min:11 | max:20  ',
            'description' => 'nullable ',
        ]);
        $user = $this->user;
        if (!$user->address) {
            ModelsUserAddress::query()->where('user_id', $user->id)->create([
                'user_id' => $user->id,
                'name' => $this->name,
                'family' => $this->family,
                'address' => $this->address,
                'province' => $this->province,
                'city' => $this->city,
                'postcode' => $this->postcode,
                'mobile' => $this->mobile,
                'description' => $this->description,
            ]);
        } else {
            ModelsUserAddress::query()->where('user_id', $user->id)->update([
                'name' => $this->name,
                'family' => $this->family,
                'province' => $this->province,
                'city' => $this->city,
                'postcode' => $this->postcode,
                'mobile' => $this->mobile,
                'description' => $this->description,
            ]);
        }
        //payment
        DB::beginTransaction();
        try {

            $order = Order::query()->create([
                'user_id' => $this->user->id,
                'user_name' => $this->user->name,
                'user_address_id' => $this->user->address->id,
                'order_code' => '123',
                'transaction_id' => 'not_set',
                'total_cost' => $this->finalCost,
                'send_type' => $this->send_type->name
            ]);
            foreach ($this->carts as $cart) {

                $product_price = $cart->product->productPrices
                    ->where('warranty_id', $cart->warranty_id)
                    ->where('color_id', $cart->color_id)->first();
                if ($product_price) {
                    $main_price = $product_price->price;
                    $discount_price = ($product_price->discount * $product_price->price / 100) * $cart->count;
                    $final_price = ($product_price->price * $cart->count) - $discount_price;
                } else {
                    $main_price = $cart->product->price;
                    $discount_price = ($cart->product->price * $cart->product->discount / 100) * $cart->count;
                    $final_price = ($cart->product->price * $cart->count) - $discount_price;
                };

                OrderDetail::query()->create([
                    'order_id' => $order->id,
                    'product_id' => $cart->product->id,
                    'warranty_id' => $cart->warranty_id,
                    'color_id' => $cart->color_id,
                    'main_price' => $main_price,
                    'final_price' => $final_price,
                    'discount' => $discount_price,
                    'count' => $cart->count,
                    'status',
                ]);
            }
            DB::commit();
            $result = Payment::purchase(
                (new Invoice)->amount($this->finalCost),
                function ($driver, $transactionId) use ($order) {
                    $order->update([
                        'transaction_id' => $transactionId
                    ]);
                }
            )->pay()->toJson();
            return redirect(json_decode($result)->action);
        } catch (\Exception $exception) {
            Log::error($exception->getMessage());
            DB::rollBack();
        }
    }
    public function sendType($id)
    {
        $this->send_type = SendType::query()->where('id', $id)->first();
    }
    

    #[Layout('frontend.master'), Title('جزئیات محصول')]
    public function render()
    {
        return view('livewire.frontend.user-address');
    }
}
