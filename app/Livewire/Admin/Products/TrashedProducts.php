<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\WithPagination;

class TrashedProducts extends Component
{
    use WithPagination;

    public $alertMessage;
    public $alertType;
    public $searchedData;

    #[On('restoreProduct')]
    public function restoreProduct($product_id)
    {
        $product = Product::onlyTrashed()->findOrFail($product_id);
        $product->restore();
        $this->alertType = 'success';
        $this->alertMessage = 'محصول مورد نظر با موفقیت بازیابی شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    
    #[On('hardDeleteProduct')]
    public function hardDeleteProduct($product_id)
    {
        $product = Product::onlyTrashed()->findOrFail($product_id);
        $imagePath = 'images/products/' . $product->image;

        if ($product->image && Storage::disk('public')->exists($imagePath)) {
            Storage::disk('public')->delete($imagePath);
        }

        $product->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'محصول به طور کامل حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }

    public function search()
    {
        $this->resetPage();
    }

    #[Layout('admin.master'), Title('محصولات حذف شده')]
    public function render()
    {
        if ($this->searchedData) {
            $products = Product::where('name', 'like', '%' . $this->searchedData . '%')->onlyTrashed()->paginate(10);
        } else {
            $products = Product::onlyTrashed()->paginate(10);
        }

        return view('livewire.admin.products.trashed-products', compact('products'));
    }
}