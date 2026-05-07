<div class="grid grid-cols-1 gap-6 p-3">
    {{-- Add Product --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">ویرایش محصول</h5>
        </div>
        <div class="mb-5" x-data="{ activeTab: 1 }">
            <div class="inline-block w-full">
                <div class="relative z-[1]">
                    <div class="bg-primary w-[15%] h-1 absolute ltr:left-0 rtl:right-0 top-[30px] m-auto -z-[1] transition-[width]"
                        :class="{ 'w-[15%]': activeTab === 1, 'w-[48%]': activeTab === 2, 'w-[81%]': activeTab === 3 }">
                    </div>
                    <ul class="grid grid-cols-3 mb-5">
                        <li class="mx-auto">
                            <a href="javascript:;"
                                class="border-[3px] border-[#f3f2ee] bg-white dark:bg-[#253b5c] dark:border-[#1b2e4b] flex justify-center items-center w-16 h-16 rounded-full"
                                :class="{ '!border-primary !bg-primary text-white': activeTab === 1 }"
                                @click="activeTab = 1">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                    <path opacity="0.5"
                                        d="M2 12.2039C2 9.91549 2 8.77128 2.5192 7.82274C3.0384 6.87421 3.98695 6.28551 5.88403 5.10813L7.88403 3.86687C9.88939 2.62229 10.8921 2 12 2C13.1079 2 14.1106 2.62229 16.116 3.86687L18.116 5.10812C20.0131 6.28551 20.9616 6.87421 21.4808 7.82274C22 8.77128 22 9.91549 22 12.2039V13.725C22 17.6258 22 19.5763 20.8284 20.7881C19.6569 22 17.7712 22 14 22H10C6.22876 22 4.34315 22 3.17157 20.7881C2 19.5763 2 17.6258 2 13.725V12.2039Z"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                    <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>
                            </a>
                            <span class="block mt-2 text-center" :class="{ 'text-primary': activeTab === 1 }"> اطلاعات
                                محصول</span>
                        </li>
                        <li class="mx-auto">
                            <a href="javascript:;"
                                class="border-[3px] border-[#f3f2ee] bg-white dark:bg-[#253b5c] dark:border-[#1b2e4b] flex justify-center items-center w-16 h-16 rounded-full"
                                :class="{ '!border-primary !bg-primary text-white': activeTab === 2 }"
                                @click="activeTab = 2">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                    <path opacity="0.5"
                                        d="M2.25 18.75a60.07 60.07 0 0 1 15.797 2.101c.727.198 1.453-.342 1.453-1.096V18.75M3.75 4.5v.75A.75.75 0 0 1 3 6h-.75m0 0v-.375c0-.621.504-1.125 1.125-1.125H20.25M2.25 6v9m18-10.5v.75c0 .414.336.75.75.75h.75m-1.5-1.5h.375c.621 0 1.125.504 1.125 1.125v9.75c0 .621-.504 1.125-1.125 1.125h-.375m1.5-1.5H21a.75.75 0 0 0-.75.75v.75m0 0H3.75m0 0h-.375a1.125 1.125 0 0 1-1.125-1.125V15m1.5 1.5v-.75A.75.75 0 0 0 3 15h-.75M15 10.5a3 3 0 1 1-6 0 3 3 0 0 1 6 0Zm3 0h.008v.008H18V10.5Zm-12 0h.008v.008H6V10.5Z"
                                        stroke="currentColor" stroke-width="1.5"></path>
                                    <path d="M12 15L12 18" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round"></path>
                                </svg>
                            </a>
                            <span class="block mt-2 text-center" :class="{ 'text-primary': activeTab === 2 }">اطلاعات
                                فروش</span>
                        </li>
                        <li class="mx-auto">
                            <a href="javascript:;"
                                class="border-[3px] border-[#f3f2ee] bg-white dark:bg-[#253b5c] dark:border-[#1b2e4b] flex justify-center items-center w-16 h-16 rounded-full"
                                :class="{ '!border-primary !bg-primary text-white': activeTab === 3 }"
                                @click="activeTab = 3">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg" class="w-5 h-5">
                                    <path
                                        d="M20.9751 12.1852L20.2361 12.0574L20.9751 12.1852ZM20.2696 16.265L19.5306 16.1371L20.2696 16.265ZM6.93776 20.4771L6.19055 20.5417H6.19055L6.93776 20.4771ZM6.1256 11.0844L6.87281 11.0198L6.1256 11.0844ZM13.9949 5.22142L14.7351 5.34269V5.34269L13.9949 5.22142ZM13.3323 9.26598L14.0724 9.38725V9.38725L13.3323 9.26598ZM6.69813 9.67749L6.20854 9.10933H6.20854L6.69813 9.67749ZM8.13687 8.43769L8.62646 9.00585H8.62646L8.13687 8.43769ZM10.518 4.78374L9.79207 4.59542L10.518 4.78374ZM10.9938 2.94989L11.7197 3.13821L11.7197 3.13821L10.9938 2.94989ZM12.6676 2.06435L12.4382 2.77841L12.4382 2.77841L12.6676 2.06435ZM12.8126 2.11093L13.0419 1.39687L13.0419 1.39687L12.8126 2.11093ZM9.86194 6.46262L10.5235 6.81599V6.81599L9.86194 6.46262ZM13.9047 3.24752L13.1787 3.43584V3.43584L13.9047 3.24752ZM11.6742 2.13239L11.3486 1.45675L11.3486 1.45675L11.6742 2.13239ZM20.2361 12.0574L19.5306 16.1371L21.0086 16.3928L21.7142 12.313L20.2361 12.0574ZM13.245 21.25H8.59634V22.75H13.245V21.25ZM7.68497 20.4125L6.87281 11.0198L5.37839 11.149L6.19055 20.5417L7.68497 20.4125ZM19.5306 16.1371C19.0238 19.0677 16.3813 21.25 13.245 21.25V22.75C17.0712 22.75 20.3708 20.081 21.0086 16.3928L19.5306 16.1371ZM13.2548 5.10015L12.5921 9.14472L14.0724 9.38725L14.7351 5.34269L13.2548 5.10015ZM7.18772 10.2456L8.62646 9.00585L7.64728 7.86954L6.20854 9.10933L7.18772 10.2456ZM11.244 4.97206L11.7197 3.13821L10.2678 2.76157L9.79207 4.59542L11.244 4.97206ZM12.4382 2.77841L12.5832 2.82498L13.0419 1.39687L12.897 1.3503L12.4382 2.77841ZM10.5235 6.81599C10.8354 6.23198 11.0777 5.61339 11.244 4.97206L9.79207 4.59542C9.65572 5.12107 9.45698 5.62893 9.20041 6.10924L10.5235 6.81599ZM12.5832 2.82498C12.8896 2.92342 13.1072 3.16009 13.1787 3.43584L14.6306 3.05921C14.4252 2.26719 13.819 1.64648 13.0419 1.39687L12.5832 2.82498ZM11.7197 3.13821C11.7547 3.0032 11.8522 2.87913 11.9998 2.80804L11.3486 1.45675C10.8166 1.71309 10.417 2.18627 10.2678 2.76157L11.7197 3.13821ZM11.9998 2.80804C12.1345 2.74311 12.2931 2.73181 12.4382 2.77841L12.897 1.3503C12.3872 1.18655 11.8312 1.2242 11.3486 1.45675L11.9998 2.80804ZM14.1537 10.9842H19.3348V9.4842H14.1537V10.9842ZM14.7351 5.34269C14.8596 4.58256 14.824 3.80477 14.6306 3.0592L13.1787 3.43584C13.3197 3.97923 13.3456 4.54613 13.2548 5.10016L14.7351 5.34269ZM8.59634 21.25C8.12243 21.25 7.726 20.887 7.68497 20.4125L6.19055 20.5417C6.29851 21.7902 7.34269 22.75 8.59634 22.75V21.25ZM8.62646 9.00585C9.30632 8.42 10.0391 7.72267 10.5235 6.81599L9.20041 6.10924C8.85403 6.75767 8.30249 7.30493 7.64728 7.86954L8.62646 9.00585ZM21.7142 12.313C21.9695 10.8365 20.8341 9.4842 19.3348 9.4842V10.9842C19.9014 10.9842 20.3332 11.4959 20.2361 12.0574L21.7142 12.313ZM12.5921 9.14471C12.4344 10.1076 13.1766 10.9842 14.1537 10.9842V9.4842C14.1038 9.4842 14.0639 9.43901 14.0724 9.38725L12.5921 9.14471ZM6.87281 11.0198C6.84739 10.7258 6.96474 10.4378 7.18772 10.2456L6.20854 9.10933C5.62021 9.61631 5.31148 10.3753 5.37839 11.149L6.87281 11.0198Z"
                                        fill="currentColor"></path>
                                    <path opacity="0.5"
                                        d="M3.9716 21.4709L3.22439 21.5355L3.9716 21.4709ZM3 10.2344L3.74721 10.1698C3.71261 9.76962 3.36893 9.46776 2.96767 9.48507C2.5664 9.50239 2.25 9.83274 2.25 10.2344L3 10.2344ZM4.71881 21.4063L3.74721 10.1698L2.25279 10.299L3.22439 21.5355L4.71881 21.4063ZM3.75 21.5129V10.2344H2.25V21.5129H3.75ZM3.22439 21.5355C3.2112 21.383 3.33146 21.2502 3.48671 21.2502V22.7502C4.21268 22.7502 4.78122 22.1281 4.71881 21.4063L3.22439 21.5355ZM3.48671 21.2502C3.63292 21.2502 3.75 21.3686 3.75 21.5129H2.25C2.25 22.1954 2.80289 22.7502 3.48671 22.7502V21.2502Z"
                                        fill="currentColor"></path>
                                </svg>
                            </a>
                            <span class="block mt-2 text-center" :class="{ 'text-primary': activeTab === 3 }">تایید
                                نهایی</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <!-- Tab 1 -->
                    <div x-show="activeTab === 1">
                        <div class="mb-5">
                            <form class="space-y-5">
                                <div x-data="{ uploading: false, progress: 0, message: '', messageType: '' }"
                                    x-on:livewire-upload-start="uploading = true; message = ''; messageType = ''"
                                    x-on:livewire-upload-finish="
                    uploading = false;
                    if (!$refs.imageInput || !$refs.imageInput.files || !$refs.imageInput.files.length) {
                        progress = 0; message = ''; messageType = '';
                    } else {
                        message = 'آپلود با موفقیت انجام شد!'; messageType = 'success';
                    }"
                                    x-on:livewire-upload-cancel="uploading = false; message = 'آپلود لغو شد.'; messageType = 'info'"
                                    x-on:livewire-upload-error="uploading = false; message = 'خطا در آپلود، لطفاً دوباره تلاش کنید.'; messageType = 'error'"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                                    x-effect="(!$wire.get('image')) && (uploading = false, progress = 0, message = '', messageType = '');">
                                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                        <!-- فیلدهای معمولی -->
                                        <div>
                                            <label for="productName">نام محصول <span
                                                    class="text-danger">*</span></label>
                                            <input wire:model="name" id="productName" type="text"
                                                placeholder="نام محصول را وارد کنید" class="form-input">
                                            <p class="mt-1 text-danger">
                                                @error('name')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>

                                        <div>
                                            <label for="productEName">نام انگلیسی محصول <span
                                                    class="text-danger">*</span></label>
                                            <input wire:model="e_name" id="productEName" type="text"
                                                placeholder="نام انگلیسی محصول را وارد کنید" class="form-input">
                                            <p class="mt-1 text-danger">
                                                @error('e_name')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>

                                        <div>
                                            <label for="productSlug">نام مستعار <span
                                                    class="text-danger">*</span></label>
                                            <input wire:model="slug" id="productSlug" type="text"
                                                placeholder="نام مستعار محصول را وارد کنید" class="form-input">
                                            <p class="mt-1 text-danger">
                                                @error('slug')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>

                                        <div>
                                            <label for="productImage">عکس محصول <span
                                                    class="text-danger">*</span></label>
                                            <input id="productImage" type="file" wire:model="image"
                                                x-ref="imageInput"
                                                class="p-0 form-input file:py-2 file:px-4 file:border-0 file:font-semibold file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                                            <p class="mt-1 text-danger">
                                                @error('image')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                            <!-- Progress Bar -->
                                            <div class="mt-2" x-show="uploading || messageType" x-cloak>
                                                <div class="w-full h-1 bg-[#ebedf2] dark:bg-dark/40 rounded-full flex">
                                                    <div class="h-1 rounded-full"
                                                        x-bind:class="{
                                                            'bg-primary': uploading && !messageType,
                                                            'bg-success': !uploading && messageType === 'success',
                                                            'bg-danger': !uploading && messageType === 'error',
                                                            'bg-warning': !uploading && messageType === 'info'
                                                        }"
                                                        x-bind:style="uploading ? ('width: ' + progress + '%;') : 'width: 100%;'">
                                                    </div>
                                                </div>
                                                <div class="mt-1 text-xs" x-show="uploading" x-text="progress + '%'">
                                                </div>
                                            </div>
                                            <!-- Message Display -->
                                            <div class="mt-2" x-show="message" x-transition>
                                                <p x-text="message"
                                                    x-bind:class="{ 'text-green-500': messageType === 'success', 'text-red-500': messageType === 'error', 'text-gray-500': messageType === 'info' }"
                                                    class="flex items-center"></p>
                                            </div>
                                        </div>

                                        <!-- دسته‌بندی -->
                                        <div>
                                            <label for="categorySelect">دسته‌بندی <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore>
                                                <select wire:model="category_id" id="categorySelect"
                                                    class="selectize" x-ref="categorySelect">
                                                    @foreach ($categories as $category)
                                                        @if ($category->id === $this->category_id)
                                                            <option value="{{ $category->id }}" selected>
                                                                {{ $category->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $category->id }}">{{ $category->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="mt-1 text-danger">
                                                @error('category_id')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>

                                        <!-- برند -->
                                        <div>
                                            <label for="brandSelect">برند <span class="text-danger">*</span></label>
                                            <div wire:ignore>
                                                <select wire:model="brand_id" id="brandSelect" class="selectize"
                                                    x-ref="brandSelect">
                                                    @foreach ($brands as $brand)
                                                        @if ($brand->id === $this->brand_id)
                                                            <option value="{{ $brand->id }}" selected>
                                                                {{ $brand->name }}
                                                            </option>
                                                        @else
                                                            <option value="{{ $brand->id }}">{{ $brand->name }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="mt-1 text-danger">
                                                @error('brand_id')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>

                                        <!-- رنگ‌ها -->
                                        <div>
                                            <label for="colorsSelect">رنگ <span class="text-danger">*</span></label>
                                            <div wire:ignore>
                                                <select wire:model="colors_id" id="colorsSelect" class="selectize"
                                                    multiple='multiple' x-ref="colorsSelect">
                                                    @foreach ($colors as $color)
                                                        <option value="{{ $color->id }}"
                                                            {{ in_array($color->id, $this->colors_id) ? 'selected' : '' }}>
                                                            {{ $color->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="mt-1 text-danger">
                                                @error('colors_id')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>

                                        <!-- گارانتی -->
                                        <div>
                                            <label for="warrantySelect">گارانتی <span
                                                    class="text-danger">*</span></label>
                                            <div wire:ignore>
                                                <select wire:model="warranties_id" id="warrantySelect"
                                                    class="selectize" multiple='multiple' x-ref="warrantySelect">
                                                    @foreach ($warranties as $warranty)
                                                        <option value="{{ $warranty->id }}"
                                                            {{ in_array($warranty->id, $this->warranties_id) ? 'selected' : '' }}>
                                                            {{ $warranty->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <p class="mt-1 text-danger">
                                                @error('warranties_id')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>

                                        <!-- توضیحات -->
                                        <div class="md:col-span-2">
                                            <label for="productDescription">توضیحات</label>
                                            <textarea wire:model="description" id="productDescription" rows="5" placeholder="توضیحات محصول را وارد کنید"
                                                class="form-input"></textarea>
                                            <p class="mt-1 text-danger">
                                                @error('description')
                                                    {{ $message }}
                                                @enderror
                                            </p>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex justify-between mt-4">
                                    <button type="button" class="btn btn-secondary" disabled>قبلی</button>
                                    <button type="button" class="btn btn-primary" wire:click="saveStep1"
                                        x-on:click="
                        $wire.saveStep1().then(function(result) {
                            if (result) {
                                activeTab = 2;
                            }
                        });
                    ">
                                        ثبت و ادامه
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Tab 2 -->
                    <div x-show="activeTab === 2">
                        <div class="mb-5">
                            <form class="space-y-5" wire:submit.prevent="saveStep2">
                                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                                    <div>
                                        <label for="productPrice">قیمت <span class="text-danger">*</span></label>
                                        <input wire:model="price" id="productPrice" type="number"
                                            placeholder="قیمت محصول را وارد کنید" class="form-input">
                                        <p class="mt-1 text-danger">
                                            @error('price')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                    <div>
                                        <label for="productDiscount">تخفیف</label>
                                        <input wire:model="discount" id="productDiscount" type="number"
                                            placeholder="تخفیف محصول را وارد کنید" class="form-input">
                                        <p class="mt-1 text-danger">
                                            @error('discount')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                    <div>
                                        <label for="productCount">تعداد</label>
                                        <input wire:model="count" id="productCount" type="number"
                                            placeholder="تعداد موجودی محصول را وارد کنید" class="form-input">
                                        <p class="mt-1 text-danger">
                                            @error('count')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                    <div>
                                        <label for="maxSell">حداکثر فروش</label>
                                        <input wire:model="max_sell" id="maxSell" type="number"
                                            placeholder="حداکثر فروش محصول را وارد کنید" class="form-input">
                                        <p class="mt-1 text-danger">
                                            @error('max_sell')
                                                {{ $message }}
                                            @enderror
                                        </p>
                                    </div>
                                     <div>
                                        <label class="block mb-2">وضعیت </label>
                                        
                                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                                <input type="radio" wire:model="status" value="active"
                                                    name="status" class="form-radio text-success">
                                                <span>فعال</span>
                                            </label>

                                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                                <input type="radio" wire:model="status" value="notActive"
                                                    name="status" class="form-radio text-danger">
                                                <span>غیرفعال</span>
                                            </label>
                                        
                                    </div>
                                </div>
                        </div>

                        <div class="flex justify-between mt-4">
                            <button type="button" class="btn btn-secondary" @click="activeTab = 1">قبلی</button>
                            <button type="button" class="btn btn-primary" wire:click="saveStep2"
                                x-on:click="
                                        $wire.saveStep2().then(function(result) {
                                            if (result) {
                                                activeTab = 3;
                                            }
                                        });
                                    ">
                                ثبت و ادامه
                            </button>
                        </div>
                        </form>
                    </div>
                </div>
                <!-- Tab 3 -->
                <div x-show="activeTab === 3">
                    <div class="mb-5">
                        <h5 class="text-lg font-semibold">اطلاعات ثبت شده:</h5>
                        <table class="min-w-full border border-collapse border-gray-300">
                            <thead>
                                <tr>
                                    <th class="p-2 text-left border border-gray-300">عنوان</th>
                                    <th class="p-2 text-left border border-gray-300">مقدار</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>نام محصول:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $name }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>نام انگلیسی محصول:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $e_name }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>نام مستعار:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $slug }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>دسته‌بندی:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $this->selectedCategory }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>برند:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $this->selectedBrand }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>رنگ:</strong></td>
                                    <td class="p-2 border border-gray-300">
                                        {{ implode(', ', $this->selectedColors) }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>گارانتی:</strong></td>
                                    <td class="p-2 border border-gray-300">
                                        {{ implode(', ', $this->selectedWarranties) }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>توضیحات:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $description }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>قیمت:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $price }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>تخفیف:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $discount }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>تعداد:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $count }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>حداکثر فروش:</strong></td>
                                    <td class="p-2 border border-gray-300">{{ $max_sell }}</td>
                                </tr>
                                <tr>
                                    <td class="p-2 border border-gray-300"><strong>عکس محصول:</strong></td>
                                    <td class="p-2 border border-gray-300">
                                        @if ($image)
                                            <div class="flex justify-center">
                                                <img src="{{ $image->temporaryUrl() }}" alt="عکس محصول"
                                                    class="object-cover w-20 h-20">
                                            </div>
                                        @elseif($this->old_product_image)
                                            <div class="flex justify-center">
                                                <img src="{{ asset('images/products/' . $this->old_product_image) }}"
                                                    alt="Current Product Image" class="object-cover w-20 h-20">
                                            </div>
                                        @else
                                            <p class="p-4 mt-2 text-center text-gray-500 ">
                                                عکسی وجود ندارد
                                            </p>

                    </div>
                    @endif
                    </td>
                    </tr>
                    </tbody>
                    </table>
                </div>
                <div class="flex justify-between mt-4">
                    <button type="button" class="btn btn-secondary" @click="activeTab = 2">قبلی</button>
                    <button type="button" class="btn btn-primary" wire:click="updateProduct">
                        ویرایش محصول
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('sweetAlert', (data) => {
            const alertMessage = data['message'];
            const alertType = data['type'];
            showAlert(alertMessage, alertType);
        });
    });

    document.addEventListener("DOMContentLoaded", function(e) {
        // Initialize searchable select
        var categorySelect = document.getElementById("categorySelect");
        if (categorySelect) {
            NiceSelect.bind(categorySelect, {
                searchable: true
            });
        }

        var brandSelect = document.getElementById("brandSelect");
        if (brandSelect) {
            NiceSelect.bind(brandSelect, {
                searchable: true
            });
        }

        var colorsSelect = document.getElementById("colorsSelect");
        if (colorsSelect) {
            NiceSelect.bind(colorsSelect, {
                searchable: true
            });
        }

        var warrantySelect = document.getElementById("warrantySelect");
        if (warrantySelect) {
            NiceSelect.bind(warrantySelect, {
                searchable: true
            });
        }
    });

    document.addEventListener('alpine:init', () => {
        Alpine.data('myComponent', () => ({
            activeTab: 1,
            init() {
                if (this.$refs.categorySelect) {
                    NiceSelect.bind(this.$refs.categorySelect, {
                        searchable: true
                    });
                }
                if (this.$refs.brandSelect) {
                    NiceSelect.bind(this.$refs.brandSelect, {
                        searchable: true
                    });
                }
                if (this.$refs.colorsSelect) {
                    NiceSelect.bind(this.$refs.colorsSelect, {
                        searchable: true
                    });
                }
                if (this.$refs.warrantySelect) {
                    NiceSelect.bind(this.$refs.warrantySelect, {
                        searchable: true
                    });
                }
            }
        }));
    });

</script>
