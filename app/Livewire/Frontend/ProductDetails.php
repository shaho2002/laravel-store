<?php

namespace App\Livewire\Frontend;

use App\Models\Cart;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductInfo;
use App\Models\ProductPrice;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;


class ProductDetails extends Component
{
    public $product;
    public $selectedColor;
    public $product_infos;
    public $count = 1;
    public $alertMessage;
    public $alertType;
    public $alertTitle;

    public function mount($slug)
    {
        $this->product = Product::query()->where('slug', $slug)->with('category', 'colors', 'ProductGallery', 'product_infos')->first();

        $this->selectedColor = $this->product->colors->first();

        $this->product_infos = ProductInfo::query()->where('product_id', $this->product->id)->with('category_feature')->get();
    }
    public function selectColor($color_id)
    {
        $this->count = 1;
        $this->selectedColor = Color::query()->where('id', $color_id)->first();
    }
    #[Computed(persist: true)]
    public function relatedProducts()
    {
        return Product::query()->where('category_id', $this->product->category_id)->where('id', '!=', $this->product->id)->get();
    }
    public function addToCart()
    {
        if (Auth::user()) {

            $cart = Cart::query()->where('user_id', auth::user()->id)
                ->where('product_id', $this->product->id)
                ->where('warranty_id', $this->product->warranties->first()->id)
                ->where('color_id', $this->selectedColor->id)->first();

            if ($cart) {
                $cart->update([
                    'count' => $cart->count + $this->count
                ]);
                $this->alertType = 'success';
                $this->alertTitle = 'موفقیت آمیز';
                $this->alertMessage = 'به سبد خرید شما اضافه شد';
                $this->dispatch(
                    'sweetAlert',
                    message: $this->alertMessage,
                    type: $this->alertType,
                    title: $this->alertTitle
                );
            } else {
                Cart::query()->create([
                    'count' => $this->count,
                    'user_id' => auth::user()->id,
                    'product_id' => $this->product->id,
                    'color_id' => $this->selectedColor->id,
                    'warranty_id' => $this->product->warranties->first()->id

                ]);
                $this->count = 1;
                $this->alertType = 'success';
                $this->alertTitle = 'موفقیت آمیز';
                $this->alertMessage = 'به سبد خرید شما اضافه شد';
                $this->dispatch(
                    'sweetAlert',
                    message: $this->alertMessage,
                    type: $this->alertType,
                    title: $this->alertTitle
                );
            }
        } else {
            return redirect(route('login'));
        }
    }
    public function plus()
    {
        $productPrice = ProductPrice::query()
            ->where('product_id', $this->product->id)
            ->where('color_id', $this->selectedColor->id)
            ->first();

        if ($productPrice) {
            $maxSell = $productPrice->max_sell;
        } else {
            $maxSell = $this->product->max_sell;
        }
        if ($this->count < $maxSell) {
            $this->count = $this->count + 1;
        }
    }
    public function minus()
    {
        if ($this->count > 1) {
            $this->count = $this->count - 1;
        }
    }
    public function set_category_id($category_id)
    {
        session()->put('category_id', $category_id);
        return redirect()->route('shop');
    }
    public function addToFavorite($product_id)
    {
        if (auth::user()) {
            $user = User::query()
                ->with('favorite_products')
                ->findOrFail(auth::user()->id);
            if ($user->favorite_products()->where('product_id', $product_id)->exists()) {
                $this->alertType = 'warning';
                $this->alertTitle = 'هشدار';
                $this->alertMessage = 'این مورد از قبل در لیست علاقه‌مندی ها وجود دارد';
                $this->dispatch(
                    'sweetAlert',
                    message: $this->alertMessage,
                    type: $this->alertType,
                    title: $this->alertTitle
                );
            } else {
                $user->favorite_products()->syncWithoutDetaching($product_id);
                $this->alertType = 'success';
                $this->alertTitle = 'موفقیت آمیز';
                $this->alertMessage = 'به لیست‌ علاقه‌مندی های شما اضافه شد';
                $this->dispatch(
                    'sweetAlert',
                    message: $this->alertMessage,
                    type: $this->alertType,
                    title: $this->alertTitle
                );
            }
        } else {
            return redirect()->route('login');
        }
    }

    #[Layout('frontend.master'), Title('جزئیات محصول')]
    public function render()
    {

        $selectedProductPrice = ProductPrice::query()
            ->where('color_id', $this->selectedColor->id)
            ->where('product_id', $this->product->id)
            ->first();
        if ($selectedProductPrice) {

            if ($this->product->discount) {
                $price = $selectedProductPrice->price - ($selectedProductPrice->price * $this->product->discount / 100);
            } else {
                $price = $selectedProductPrice;
            }
        } else {
            if ($this->product->discount) {
                $price = $this->product->price - ($this->product->price * $this->product->discount) / 100;
            } else {
                $price = $this->product->price;
            }
        }



        return view('livewire.frontend.product-details', compact('price'));
    }
}
