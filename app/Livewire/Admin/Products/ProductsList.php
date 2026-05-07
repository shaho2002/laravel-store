<?php

namespace App\Livewire\Admin\Products;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Product;
use App\Models\Category; 
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;

class ProductsList extends Component
{
    use WithPagination;

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
    public function mount()
    {
        if (session()->has('success')) {
            $this->alertMessage = session('success');
            $this->alertType = session('alertType', 'success');
            $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
            session()->forget(['success', 'alertType']);
        }
    }

    #[Layout('admin.master'), Title('لیست محصولات')]
    public function render()
    {
        $query = Product::query();

        if ($this->searchedData) {
            $query->where('name', 'like', '%' . $this->searchedData . '%');
        }

        if ($this->selectedCategory !== 'allProducts') {
            $query->where('category_id', $this->selectedCategory);
        }

        $products = $query->with('colors','warranties')->paginate(10);
        $allCategories = Category::pluck('name', 'id'); 

        return view('livewire.admin.products.products-list', compact('allCategories', 'products'));
    }
}