<?php

namespace App\Livewire\Frontend;

use App\Enums\productStatus;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class Shop extends Component
{
    use WithPagination;
    public $order = 'all';
    public $categories;
    public $selected_category_id = null;
    public $just_exists = 'false';
    public $alertMessage;
    public $alertType;
    public $alertTitle;

    public function mount()
    {
        if (session('category_id')) {
            $this->selected_category_id = session('category_id');
        }
        $this->categories = Category::query()
            ->where('parent_id', '!=', 0)
            ->get();
    }
    public function orderBy($data)
    {
        $this->order = $data;
        $this->resetPage();
    }
    public function setCategory($category_id)
    {
        $this->selected_category_id = $category_id;
    }
    public function exist_products()
    {
        if ($this->just_exists == 'false') {
            $this->just_exists = 'true';
        } elseif ($this->just_exists == 'true') {
            $this->just_exists = 'false';
        }
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


    #[Layout('frontend.master'), Title('فروشگاه ')]
    public function render()
    {

        if ($this->just_exists == 'false') {
            $query = Product::query();
        } else {
            $query = Product::query()
                ->where('count', '>', 0)
                ->where('max_Sell', '>', 0)
                ->where('count', '>', 'max_sell');
        }
        if ($this->selected_category_id) {
            if ($this->order === 'all') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->where('category_id', $this->selected_category_id)
                    ->paginate(18);
            } elseif ($this->order === 'mostExpensive') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->where('category_id', $this->selected_category_id)
                    ->orderBy('price', 'desc')
                    ->paginate(18);
            } elseif ($this->order === 'popular') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->where('category_id', $this->selected_category_id)
                    ->orderBy('count', 'asc')
                    ->paginate(18);
            } elseif ($this->order === 'bestSeller') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->where('category_id', $this->selected_category_id)
                    ->orderBy('sold', 'desc')
                    ->paginate(18);
            } elseif ($this->order === 'cheaper') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->where('category_id', $this->selected_category_id)
                    ->orderBy('sold', 'asc')
                    ->paginate(18);
            }
        } else {
            if ($this->order === 'all') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->orderBy('count', 'desc')
                    ->paginate(18);
            } elseif ($this->order === 'mostExpensive') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->orderBy('price', 'desc')
                    ->paginate(18);
            } elseif ($this->order === 'popular') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->orderBy('count', 'asc')
                    ->paginate(18);
            } elseif ($this->order === 'bestSeller') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->orderBy('sold', 'desc')
                    ->paginate(18);
            } elseif ($this->order === 'cheaper') {
                $products = $query
                    ->where('status', productStatus::Active->value)
                    ->orderBy('price', 'asc')
                    ->paginate(18);
            }
        }

        return view('livewire.frontend.shop', compact('products'));
    }
}
