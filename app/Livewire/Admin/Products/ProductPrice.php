<?php

namespace App\Livewire\Admin\Products;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductPrice as ModelsProductPrice;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class ProductPrice extends Component
{
    use WithPagination;

    public $product;
    public $searchedData;
    public $selectedCategory = 'allProducts';
    public $alertType;
    public $alertMessage;
    public function search()
    {
        $this->resetPage();
    }

    public function setCategoryFilter()
    {
        $this->searchedData = null;
        $this->resetPage();
    }
    #[On('destroyProduct')]
    public function destroyProduct($product_id)
    {

        Product::query()->findOrFail($product_id)->delete();
        $this->alertType = 'success';
        $this->alertMessage = 'محصول مورد نظر با موفقیت حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function mount(Product $product)
    {
        $this->product = $product;

        if (session()->has('success')) {
            $this->alertMessage = session('success');
            $this->alertType = session('alertType', 'success');
            $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
            session()->forget(['success', 'alertType']);
        }
    }
    #[on('hardDeleteProductFeature')]
    public function hardDeleteProductFeature($productFeature_id)
    {
        ModelsProductPrice::query()->findOrFail($productFeature_id)->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'ویژگی محصول به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    #[Layout('admin.master'), Title(' ویژگی محصولات')]

    public function render()
    {
        $allCategories = Category::query()->pluck('name', 'id');

        $query = ModelsProductPrice::query();
        if ($this->searchedData) {
            $query->where('name', 'like', '%' . $this->searchedData . '%');
        }

        
        $productPrices = $query->with('color','warranty')->where('product_id',$this->product->id)->paginate(10);
        return view('livewire.admin.products.product-prices', compact('productPrices', 'allCategories'));
    }
}
