<?php

namespace App\Livewire\Admin\Products;

use App\Models\ProductPrice;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

class EditProductPrice extends Component
{
    public $name;
    public $main_name;
    public $e_name;
    public $main_price;
    public $price;
    public $discount;
    public $count;
    public $max_sell;
    public $color_id;
    public $warranty_id;
    public $status;
    public $product;
    public $productPrice;

    public function mount(ProductPrice $productPrice)
    {
        $this->product = $productPrice->product;
        $this->main_name = $this->product->name;
        $this->main_price = $this->product->price;
        $this->productPrice = $productPrice;
        $this->name = $productPrice->name;
        $this->e_name = $productPrice->e_name;
        $this->price = $productPrice->price;
        $this->count = $productPrice->count;
        $this->discount = $productPrice->discount;
        $this->max_sell = $productPrice->max_sell;
        $this->color_id = $productPrice->color_id;
        $this->warranty_id = $productPrice->warranty_id;
        $this->status = $productPrice->status;
    }
    public function updateFeature()
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
        $this->productPrice->update([
            'name'        => $this->name,
            'e_name'      => $this->e_name,
            'color_id'    => $this->color_id,
            'warranty_id' => $this->warranty_id,
            'price'       => $this->price,
            'count'       => $this->count,
            'discount'    => $this->discount,
            'max_sell'    => $this->max_sell,
            'status'      => $this->status,
        ]);
        if($this->price < $this->product->price)
        {
            $this->product->update([
                'price' => $this->price
            ]);
        }
        session()->flash('success', 'ویژگی محصول با موفقیت ویرایش شد');
        session()->flash('alertType', 'success');

        return redirect()->route('admin.product.prices',$this->product->id);
    }

    #[Layout('admin.master'), Title('ویرایش ویژگی')]
    public function render()
    {
        $colors = $this->product->colors()->get();
        $warranties = $this->product->warranties()->get();
        return view('livewire.admin.products.edit-product-prices', compact('colors', 'warranties'));
    }
}
