<?php

namespace App\Livewire\Admin\Products;

use App\Models\CategoryFeature;
use App\Models\Product;
use App\Models\ProductInfo as ProductInformation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ProductInfo extends Component
{
    #[Validate('max:20')]
    public $name;
    public $category_feature_id;
    public $product_infoIndex;
    public $product;
    public $alertType;
    public $alertMessage;
    public $category_feature_name;
    public function mount(Product $product)
    {
        $this->product = $product;
    }
    public function editProductInfo($category_feature_id)
    {
        $category_feature = CategoryFeature::query()
            ->where('id', $category_feature_id)->first();
        if ($category_feature) {
            $this->name = $category_feature->product_infos->where('product_id', $this->product->id)->first()?->name;

            $this->category_feature_name = $category_feature->name;

            $this->category_feature_id = $category_feature->id;
        }
    }

    public function updateProductInfo()
    {
        $this->validate();

        $productInfo = ProductInformation::query()
            ->where('product_id', $this->product->id)
            ->where('category_feature_id', $this->category_feature_id)
            ->first();

        if ($productInfo) {

            $productInfo->update([
                'name' => $this->name,
            ]);
        } else {

            ProductInformation::query()->create([
                'product_id' => $this->product->id,
                'category_feature_id' => $this->category_feature_id,
                'name' => $this->name,
            ]);
        }
        $this->name = '';
        $this->category_feature_name = '';
        $this->category_feature_id = '';

        $this->alertType = 'success';
        $this->alertMessage = 'مقدار ویژگی با موفقیت ویرایش شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    public function editCancel()
    {
        $this->name = '';
        $this->category_feature_name = '';
        $this->category_feature_id = '';
        $this->resetErrorBag();
        $this->resetValidation();
    }

    #[Layout('admin.master'), Title(' اطلاعات محصول')]
    public function render()
    {
        $category_features = CategoryFeature::query()->with('product_infos')->where('category_id', $this->product->category->id)->paginate(10);
        return view('livewire.admin.products.product-info', compact('category_features'));
    }
}
