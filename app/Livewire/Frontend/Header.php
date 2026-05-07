<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Component;
use Symfony\Component\HttpFoundation\Session\Session;

class Header extends Component
{
    public $realCost;
    public $costWithDiscount;
    public $finalCost;

    public $count = 0;


    #[Computed(persist: true)]
    public function categories()
    {
        return Category::query()->where('parent_id', 0)->with('childCategory')->get();
    }
    #[Computed(persist: true)]
    public function carts()
    {
        if (Auth::user()) {
            return Cart::query()
                ->where('user_id', Auth::user()->id)
                ->with('product.warranties')
                ->with('product.colors')
                ->with('product.productPrices')->get();
        }
    }
    public function set_category_id($category_id)
    {
        session()->put('category_id', $category_id);
        return redirect()->route('shop');
    }

    public function render()
    {
         if (Auth::user()) {
            foreach ($this->carts as $cart) {
                $this->realCost = $this->realCost + $cart->product->price * $cart->count;

                if ($cart->product->productPrices) {
                    $product_price = $cart->product->productPrices
                        ->where('color_id', $cart->color_id)
                        ->where('warranty_id', $cart->warranty_id)->first();
                    if ($product_price) {
                        $this->costWithDiscount = $this->costWithDiscount + ($product_price->price - ($product_price->price * $product_price->discount / 100)) * $cart->count;
                    } else {
                        $this->costWithDiscount = $this->costWithDiscount + ($cart->product->price - ($cart->product->price * $cart->product->discount / 100)) * $cart->count;
                    }
                }

                $this->count = $this->count + $cart->count;
            }
        }
        return view('livewire.frontend.header');
    }
}
