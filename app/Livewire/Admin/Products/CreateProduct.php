<?php

namespace App\Livewire\Admin\Products;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\WithFileUploads;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Warranty;
use Illuminate\Support\Str;

class CreateProduct extends Component
{
    use WithPagination, WithFileUploads;

    public $name;
    public $e_name;
    public $slug;
    public $price;
    public $discount = 0;
    public $count = 0;
    public $max_sell = 0;
    public $image;
    public $description;
    public $status = 'active';
    public $category_id;
    public $selectedCategory;
    public $brand_id;
    public $selectedBrand;
    public $colors_id = [];
    public $selectedColors = [];
    public $warranties_id = [];
    public $selectedWarranties = [];
    public $activeTab;
    //required for create product
    public $step1 = 'false';
    public $step2 = 'false';
    //
    public $alertMessage;
    public $alertType;

    public function saveStep1()
    {
        
        
        $this->validate([
            'name' => 'required|string|max:100|min:3',
            'e_name' => 'required|string|max:100|min:3',
            'slug' => 'string|max:100|unique:products,slug',
            'category_id' =>'required',
            'brand_id' =>'required',
            'warranties_id' =>'required',
            'colors_id' =>'required',
            'image' => 'required' 
        ]);
        $this->step1=true;
        return true;
    }

    public function saveStep2()
    {
        $this->validate([
            'price' => 'required|numeric|min:0',
            'count' => 'required|integer|min:0',
        ]);
        $this->step2=true;
        return true;
    }

    public function createProduct()
    {

       if($this->image)
        {
            $imageName = $this->image->hashName();
            $this->image->storeAs('images/products', $imageName, 'public');
        }
        $product = Product::create([
            'name' => $this->name,
            'e_name' => $this->e_name,
            'slug' =>$this->slug?Str::slug($this->slug, '-', null):str::slug($this->name, '-', null),
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
        session()->flash('success', 'محصول با موفقیت ایجاد شد');
        session()->flash('alertType', 'success');
        return $this->redirect(route('admin.products.list'));
    }

    public function resetForm()
    {
        $this->reset();

    }



    #[Layout('admin.master'), Title('افزودن محصول')]
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
            $this->selectedColors = Color::query()
            ->whereIn('id', $this->colors_id)
            ->pluck('name')
            ->toArray();
        }
        if ($this->warranties_id) {
            $this->selectedWarranties = Warranty::query()
            ->whereIn('id', $this->warranties_id)
            ->pluck('name')
            ->toArray();
        }
        return view('livewire.admin.products.create-product', compact('colors', 'brands', 'categories', 'warranties'));
    }
}
