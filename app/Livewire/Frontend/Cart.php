<?php

namespace App\Livewire\Frontend;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Cart extends Component
{
    public $realCost;
    public $discount;
    public $finalCost;
    public $count = 0;
    public $carts;
    public $alertMessage;
    public $alertType;
    public $alertTitle;


    public function mount()
    {
        if (session('emptyCart')) {
            $this->dispatch(
                'sweetAlert',
                message: 'محصولات با موفقیت از سبد خرید شما حذف شدند',
                type: 'success',
                title: 'موفقیت آمیز'
            );
        }
         if (session('deleteOneProductFromCart')) {
            $this->dispatch(
                'sweetAlert',
                message: 'محصول مورد نظر از سبد شما حذف شد',
                type: 'success',
                title: 'موفقیت آمیز'
            );
        }

        $this->carts = ModelsCart::query()
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

    public function plus($cart_id)
    {
        $cart = ModelsCart::query()
            ->where('id', $cart_id)
            ->with('product')
            ->first();
        if ($cart->count < $cart->product->count) {
            $cart->update([
                'count' => $cart->count + 1
            ]);
            return redirect(route('cart'));
        }
    }
    public function minus($cart_id)
    {
        $cart = ModelsCart::query()
            ->where('id', $cart_id)
            ->with('product')
            ->first();
        if ($cart->count > 1) {
            $cart->update([
                'count' => $cart->count - 1
            ]);
            return redirect(route('cart'));
        }
    }
    public function deleteFromCart($cart_id)
    {
        ModelsCart::query()
            ->where('id', $cart_id)
            ->first()
            ->delete();
        session()->flash('deleteOneProductFromCart', 'deleteOneProductFromCart');
            return redirect(route('cart'));
        
    }
    public function deleteAllFromCart()
    {

        $carts = ModelsCart::query()
            ->where('user_id', Auth::user()->id)
            ->get();
        foreach ($carts as $cart) {
            $cart->delete();
        }

        session()->flash('emptyCart', 'emptyCart');
        return redirect(route('cart'));
    }

    #[Layout('frontend.master'), Title(content: 'سبد خرید')]

    public function render()
    {
        return view('livewire.frontend.cart');
    }
}
