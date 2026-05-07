<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Warranty;
use Illuminate\Support\Str;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class EditProduct extends Component
{
     use WithPagination, WithFileUploads;

    public $product;
    public $name;
    public $e_name;
    public $slug;
    public $price;
    public $discount = 0;
    public $count = 0;
    public $max_sell = 0;
    public $image;
    public $old_product_image;
    public $description;
    public $status;
    public $category_id;
    public $selectedCategory;
    public $brand_id;
    public $selectedBrand;
    public $colors_id = [];
    public $selectedColors = [];
    public $warranties_id = [];
    public $selectedWarranties = [];
    public $alertMessage;
    public $alertType;

    public function mount(Product $product)
    {
        $this->product = $product;
        $this->name = $product->name;
        $this->slug = $product->slug;
        $this->e_name = $product->e_name;
        $this->category_id = $product->category_id;
        $this->brand_id = $product->brand_id;
        $this->colors_id = $product->colors->pluck('id')->toArray();
        $this->warranties_id = $product->warranties->pluck('id')->toArray();
        $this->old_product_image =$product->image;
        $this->description = $product->description;
        $this->price = $product->price;
        $this->count = $product->count;
        $this->discount = $product->discount;
        $this->max_sell = $product->max_sell;
        $this->status = $product->status;       

    }
    public function saveStep1()
    {
        $this->validate([
            'name' => 'required|unique:products,name,'.$this->product->id.'|string|max:50|min:3',
            'e_name' => 'required|string|max:50|min:3',
            'slug' => 'string|max:50|unique:products,slug,'.$this->product->id,
            'category_id' =>'required',
            'brand_id' =>'required',
            'warranties_id' =>'required',
            'colors_id' =>'required',
            'image' => 'nullable|max:2048|mimes:jpeg,png,jpg'
        ]);
        return true;
    }

    public function saveStep2()
    {
        $this->validate([
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:0',
        ]);
        return true;
    }

    public function updateProduct()
    {

       $oldImage = $this->product->image;

    if ($this->image) {
        $imageName = $this->image->hashName();
        $this->image->storeAs('images/products', $imageName, 'public');

        if ($oldImage) {
            $oldImagePath = public_path('images/products/' . $oldImage);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
    } else {
        $imageName = $oldImage;
    }
        $product = Product::query()->findOrFail($this->product->id);
        $product->update([
            'name' => $this->name,
            'e_name' => $this->e_name,
            'slug' =>$this->slug?Str::slug($this->slug, '-', null):Str::slug($this->name, '-', null),
            'category_id' => $this->category_id,
            'brand_id' => $this->brand_id,
            'image' => $imageName,
            'status' =>$this->status,
            'description' => $this->description,
            'price' => $this->price,
            'discount' => $this->discount,
            'count' => $this->count,
            'max_sell' => $this->max_sell,
        ]);


        $product->colors()->sync($this->colors_id);
        $product->warranties()->sync($this->warranties_id);

        

        $this->reset();
        $this->reset(['category_id', 'brand_id', 'colors_id', 'warranties_id']);
        session()->flash('success', 'محصول با موفقیت ویرایش شد');
        session()->flash('alertType', 'success');
        return $this->redirect(route('admin.products.list'));
    }

    public function resetForm()
    {
        $this->reset();

    }



    #[Layout('admin.master'), Title('ویرایش محصول')]

    public function render()
    {
        $categories = Category::query()->select('id', 'name')->get();
        $colors = Color::query()->select('id', 'name', 'code')->get();
        $brands = Brand::query()->select('id', 'name')->get();
        $warranties = Warranty::query()->select('id', 'name')->get();
        //
        if ($this->category_id) {
            $this->selectedCategory = Category::query()->find($this->category_id)->name;
        }
        if ($this->brand_id) {
            $this->selectedBrand = Brand::query()->find($this->brand_id)->name;
        }
        if ($this->colors_id) {
            $this->selectedColors = Color::query()->whereIn('id', $this->colors_id)->pluck('name')->toArray();
        }
        if ($this->warranties_id) {
            $this->selectedWarranties = Warranty::query()->whereIn('id', $this->warranties_id)->pluck('name')->toArray();
        }
        return view('livewire.admin.products.edit-product',compact('colors', 'brands', 'categories', 'warranties'));
    }
}
