<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductPrice;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class CreateProductPrice extends Component
{
    public $name;
    public $main_name;
    public $e_name;
    public $main_price;
    public $price;
    public $discount ;
    public $count ;
    public $status = 'active';
    public $max_sell ;
    public $color_id ;
    public $warranty_id ;

    public $product;
    public function mount(Product $product)
    {
        $this->product = $product;
        $this->main_name = $product->name;
        $this->main_price = $product->price;
    }
    public function createFeature()
    {

         $this->validate([
            'name' => 'required|string|max:30|min:3',
            'e_name' => 'required|string|max:30|min:3',
            'price' => 'required',
            'count' =>'required',
            'max_sell' =>'required',
            'warranty_id' =>'required',
            'color_id' =>'required',
        ]);
        ProductPrice::query()->create([
            'name' => $this->name,
            'e_name' => $this->e_name,
            'color_id' => $this->color_id,
            'warranty_id' => $this->warranty_id,
            'price' => $this->price,
            'count' => $this->count,
            'discount' => $this->discount,
            'max_sell' => $this->max_sell,
            'status' => $this->status,
            'main_price' => $this->product->price,
            'product_id' => $this->product->id,
        ]);
        if($this->price < $this->product->price)
        {
            $this->product->update([
                'price' => $this->price
            ]);
        }
        session()->flash('success', 'ویژگی محصول با موفقیت ایجاد شد');
        session()->flash('alertType', 'success');
        return $this->redirect(route('admin.product.prices',$this->product->id));
    }

    #[Layout('admin.master'), Title('افزودن ویژگی')]
    public function render()
    {
        $colors = $this->product->colors()->get();
        $warranties = $this->product->warranties()->get();
        return view('livewire.admin.products.create-product-price', compact('colors', 'warranties'));
    }
}
