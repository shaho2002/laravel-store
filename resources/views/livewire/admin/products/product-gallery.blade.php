<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- Add categories --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">
                گالری</h5>
        </div>
        <div class="mb-5">
            <form wire:submit.prevent="addImage">
                <div x-data="{ uploading: false, progress: 0, message: '', messageType: '' }" x-on:livewire-upload-start="uploading = true; message=''; messageType=''"
                    x-on:livewire-upload-finish="
                uploading = false;
                message = 'عکس های انتخاب شده:';
                messageType = 'success'
            "
                    x-on:livewire-upload-error="
                uploading = false;
                message = 'خطا در آپلود';
                messageType = 'error'
            "
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    class="max-w-4xl mx-auto space-y-3">

                    <div class="flex flex-col items-center">

                        <label for="image" class="block mb-2">عکس‌ها</label>

                        <!-- فیلد + دکمه (هم‌تراز) -->
                        <div class="flex items-center w-full max-w-3xl gap-3">
                            <div class="flex-1">
                                <input id="image" type="file" wire:model="images" multiple
                                    class="w-full p-0 form-input file:py-2 file:px-4 file:border-0 file:font-medium file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                            </div>

                            <button type="submit" class="btn btn-primary shrink-0">
                                ثبت
                            </button>
                        </div>

                        @error('images')
                            <p class="mt-1 text-sm text-danger">{{ $message }}</p>
                        @enderror

                        <!-- Progress bar -->
                        <div x-show="uploading || messageType" x-cloak class="w-full max-w-3xl mt-3">
                            <div class="w-full h-1.5 bg-[#ebedf2] rounded-full">
                                <div class="h-1.5 rounded-full transition-all"
                                    x-bind:class="{
                                        'bg-primary': uploading,
                                        'bg-success': messageType === 'success',
                                        'bg-danger': messageType === 'error'
                                    }"
                                    x-bind:style="uploading ? 'width:' + progress + '%' : 'width:100%'"></div>
                            </div>
                            <div class="mt-1 text-xs text-gray-600" x-show="uploading" x-text="progress + '%'"></div>
                        </div>

                        <!-- Message -->
                        <div x-show="message" x-transition class="w-full max-w-3xl mt-2">
                            <p x-text="message" class="text-sm font-medium"
                                x-bind:class="{
                                    'text-green-500': messageType === 'success',
                                    'text-red-500': messageType === 'error'
                                }">
                            </p>
                        </div>

                        <!-- Preview -->
                        @if (!empty($images))
                            <div class="flex flex-wrap justify-center w-full max-w-3xl gap-2">
                                @foreach ($images as $image)
                                    @php
                                        $isImage = false;
                                        if (method_exists($image, 'getMimeType')) {
                                            $mimeType = $image->getMimeType();
                                            $isImage = in_array($mimeType, ['image/jpeg', 'image/jpg', 'image/png']);
                                        }
                                    @endphp

                                    @if ($isImage)
                                        <img src="{{ $image->temporaryUrl() }}"
                                            class="object-cover border rounded w-14 h-14">
                                    @else
                                        <span class="mt-1 text-sm text-danger">فرمت نامعتبر</span>
                                    @endif
                                @endforeach
                            </div>
                        @endif

                    </div>
                </div>
            </form>
        </div>
    </div>

    {{-- show categories --}}
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <h5 class="text-lg font-semibold dark:text-white-light">لیست عکس‌ها</h5>
            </div>
            <a href="{{route('admin.products.list')}}" type="button" class="btn btn-primary">
                لیست محصولات
            </a>
        </div>
        <div>
            @if ($product_images && $product_images->count() > 0)
                <div class="flex flex-wrap justify-center w-full max-w-3xl gap-2 mx-auto mt-8">
                    @foreach ($product_images as $gallery)
                        <div class="relative group">
                            <span wire:click="$dispatch('deleteConfirm',{ gallery_id : {{ $gallery->id }} })"
                                class="absolute flex items-center justify-center w-5 h-5 bg-white border border-gray-300 rounded shadow-sm cursor-pointer -top-2 -right-2 text-danger hover:bg-gray-100">
                                ×
                            </span>

                            <img src="{{ asset('images/gallery/' . $gallery->name) }}"
                                class="object-cover w-20 h-20 border rounded">
                        </div>
                    @endforeach
                </div>
            @else
                <div class="flex items-center justify-center w-full max-w-3xl gap-2 mx-auto mt-8">
                    <p class="text-gray-500">عکسی برای این محصول ثبت نشده است</p>
                </div>
            @endif
        </div>


    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('sweetAlert', (data) => {
                const alertMessage = data['message']
                const alertType = data['type']
                showAlert(alertMessage, alertType);
            });
            Livewire.on('deleteConfirm', (event) => {
                const gallery_id = event.gallery_id;
                hardDeleteGallery(gallery_id);
            });
        });
    </script>


</div>
