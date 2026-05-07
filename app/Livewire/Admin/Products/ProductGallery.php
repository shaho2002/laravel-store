<?php

namespace App\Livewire\Admin\Products;

use App\Models\Product;
use App\Models\ProductGallery as ModelsProductGallery;
use Illuminate\Support\Facades\Storage ;
use Livewire\Attributes\Layout;
use Livewire\Attributes\On;
use Livewire\Attributes\Title;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Livewire\WithFileUploads;

use function Livewire\store;

class ProductGallery extends Component
{
    use WithFileUploads;
    #[Validate([
        'images' => 'required|array|max:5', // حداکثر 5 فایل
        'images.*' => 'image|mimes:jpeg,png,jpg|max:2048', // هر فایل حداکثر 2MB
    ])]
    public $images = [];

    public $getMimeType = 'jpeg,png,jpg';
    public $alertMessage;
    public $alertType;
    public Product $product;

    public function addImage()
    {
        $this->validateOnly('images.*');
        foreach ($this->images as $image) {
            $imageName = $image->hashName();
            $image->storeAs('images/gallery', $imageName, 'public');

            ModelsProductGallery::query()->create([
                'name' => $imageName,
                'product_id' => $this->product->id
            ]);
            $this->images = [];
            $this->alertType = 'success';
            $this->alertMessage = 'تصاویر با موفقیت اضافه شدند';
            $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
        }
    }
    #[On('hardDeleteGallery')]
    public function hardDeleteGallery($gallery_id)
    {
        $product_image = ModelsProductGallery::query()->findOrFail($gallery_id);
        $image='images/gallery/'.$product_image->name;
        Storage::disk('public')->delete($image);
        $product_image->forceDelete();
        $this->alertType = 'success';
        $this->alertMessage = 'عکس مورد نظر با موفقیت از پایگاه داده حذف شد';
        $this->dispatch('sweetAlert', message: $this->alertMessage, type: $this->alertType);
    }
    #[Layout('admin.master'), Title(' ویژگی محصولات')]

    public function render()
    {
        $product_images = ModelsProductGallery::query()->where('product_id', $this->product->id)->get();
        return view('livewire.admin.products.product-gallery', compact('product_images'));
    }
}
