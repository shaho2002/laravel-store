<?php

namespace App\Livewire\Frontend;

use App\Enums\ArticleStatus;
use App\Enums\brandStatus;
use App\Enums\categoryStatus;
use App\Enums\productStatus;
use App\Models\Article;
use App\Models\Brand;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class Homepage extends Component
{
    public $alertMessage;
    public $alertType;
    public $alertTitle;

    #[Computed(persist: true)]
    public function newestProducts()
    {
        return Product::query()
            ->orderBy('created_at', 'desc')
            ->where('status', productStatus::Active->value)->get();
    }

    #[Computed(persist: true)]
    public function bestSellerProducts()
    {
        return Product::query()
            ->orderBy('sold', 'desc')
            ->where('status', productStatus::Active->value)->get();
    }

    #[Computed(persist: true)]
    public function categories()
    {
        return Category::query()
            ->where('parent_id', 0)
            ->with('childCategory')
            ->where('status', categoryStatus::Active->value)->get();
    }

    #[Computed(persist: true)]
    public function brands()
    {
        return Brand::query()
            ->where('status', brandStatus::Active->value)
            ->get();
    }
    #[Computed(persist:true)]
    public function articles()
    {
        return Article::query()
        ->where('status',ArticleStatus::Active->value)->get();
    }
    public function addToCart($product_id)
    {
        $product = Product::query()->findOrFail($product_id);
        if (Auth::user()) {

            $cart = Cart::query()->where('user_id', auth::user()->id)
                ->where('product_id', $product->id)
                ->where('warranty_id', $product->warranties->first()->id)
                ->where('color_id', $product->colors->first()->id)->first();
            if ($cart) {
                $cart->update([
                    'count' => $cart->count + 1
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
                    'count' => 1,
                    'user_id' => Auth::user()->id,
                    'product_id' => $product->id,
                    'color_id' => $product->colors->first()->id,
                    'warranty_id' => $product->warranties->first()->id

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
            }
        } else {
            return redirect(route('login'));
        }
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

    #[Layout('frontend.master'), Title('صفحه اصلی')]
    public function render()
    {
        return view('livewire.frontend.homepage');
    }
}
