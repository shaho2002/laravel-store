<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- Add categories --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">
                {{ $this->categoryIndex ? 'ویرایش دسته‌بندی' : 'افزودن دسته‌بندی جدید' }}</h5>
        </div>
        <div class="mb-5">
            <form class="space-y-5" wire:submit.prevent="createCategory">
                <div x-data="{ uploading: false, progress: 0, message: '', messageType: '' }" x-on:livewire-upload-start="uploading = true; message = ''; messageType = ''"
                    x-on:livewire-upload-finish="
            uploading = false;
            if (!$refs.imageInput || !$refs.imageInput.files || !$refs.imageInput.files.length) {
                // اگر فایلی انتخاب نشده باشد، نوار و پیام پاک شود
                progress = 0; message = ''; messageType = '';
            } else {
                message = 'آپلود با موفقیت انجام شد!'; messageType = 'success';
            }"
                    x-on:livewire-upload-cancel="uploading = false; message = 'آپلود لغو شد.'; messageType = 'info'"
                    x-on:livewire-upload-error="uploading = false; message = 'خطا در آپلود، لطفاً دوباره تلاش کنید.'; messageType = 'error'"
                    x-on:livewire-upload-progress="progress = $event.detail.progress"
                    x-effect="
            // اگر مقدار image در Livewire خالی شد (مثلاً بعد از reset فرم)، نوار و پیام را پاک کن
            (!$wire.get('image')) && (uploading = false, progress = 0, message = '', messageType = '');
        ">
                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <div class="">
                            <label for="customCategoryName">نام دسته‌بندی
                                <span class=" text-danger">*</span>
                            </label>
                            <input wire:model="categoryName" id="customCategoryName" type="text"
                                placeholder="نام دسته‌بندی را وارد کنید" class="form-input">
                            <p class="mt-1 text-danger">
                                @error('categoryName')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="">
                            <label for="categorySlug">نام مستعار</label>
                            <input wire:model="categorySlug" id="categorySlug" type="text"
                                placeholder="نام مستعار مدنظر را وارد کنید" class="form-input">
                            <p class="mt-1 text-danger">
                                @error('categorySlug')
                                    {{ $message }}
                                @enderror
                            </p>
                        </div>
                        <div class="">
                            <div>
                                <label for="ctnSelect1">ایجاد به عنوان زیر دسته یا دسته بندی اصلی</label>
                                <select id="ctnSelect1" class="form-select text-white-dark" wire:model="parent_id">
                                    <option value='0'>دسته‌بندی جدید</option>
                                    @foreach ($allCategories as $key => $value)
                                        <option value="{{ $key }}">{{ $value }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="">
                            <label for="image">عکس دسته‌بندی</label>
                            <input id="image" type="file" wire:model="image" x-ref="imageInput"
                                x-on:change="
                        if (!$event.target.files || !$event.target.files.length) {
                            uploading = false; progress = 0; message = ''; messageType = '';
                        }"
                                class="p-0 form-input file:py-2 file:px-4 file:border-0 file:font-semibold file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />

                            <p class="mt-1 text-danger">
                                @error('image')
                                    {{ $message }}
                                @enderror
                            </p>
                            <!-- Progress Bar (shows while uploading and after finish/error with status color) -->
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
                                <div class="mt-1 text-xs" x-show="uploading" x-text="progress + '%'"></div>
                            </div>

                            <!-- Message Display -->
                            <div class="mt-2" x-show="message" x-transition>
                                <p x-text="message"
                                    x-bind:class="{ 'text-green-500': messageType === 'success', 'text-red-500': messageType === 'error', 'text-gray-500': messageType === 'info' }"
                                    class="flex items-center">
                                </p>
                            </div>
                        </div>
                    </div>

                    @if ($categoryIndex)
                        <div class="flex gap-4">
                            <button type="button" wire:click="updateCategory" class="btn btn-success !mt-6">ویرایش
                                دسته‌بندی</button>
                            <button type="button" wire:click="editCancel" class="btn btn-danger !mt-6">لغو</button>
                        </div>
                    @else
                        <button type="submit" class="btn btn-primary !mt-6">ثبت دسته‌بندی</button>
                    @endif
                </div>
            </form>
        </div>
    </div>

    {{-- show categories --}}
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <h5 class="text-lg font-semibold dark:text-white-light">لیست دسته‌بندی‌ها</h5>
                <form>
                    <select wire:model="selectedCategory" wire:change="setParent" class="form-select text-white-dark">
                        <option value='originalCategories'>دسته‌بندی‌های اصلی</option>
                        <option value='subCategories'>زیردسته‌ها</option>
                        @foreach ($allCategories as $key => $value)
                            <option value="{{ $key }}">{{ $value }}</option>
                        @endforeach
                    </select>
                </form>
                {{-- search box --}}
                <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                    <form wire:submit.prevent="search"
                        class="absolute inset-x-0 z-10 hidden mx-4 -translate-y-1/2 top-1/2 sm:relative sm:top-0 sm:mx-0 sm:block sm:translate-y-0"
                        :class="{ '!block': search }" @submit.prevent="search = false">
                        <div class="relative">
                            <input type="text" wire:model="searchedData"
                                class="bg-gray-100 peer form-input placeholder:tracking-widest ltr:pl-9 ltr:pr-9 rtl:pr-9 rtl:pl-9 sm:bg-transparent ltr:sm:pr-4 rtl:sm:pl-4"
                                placeholder="جستجو" />
                            <button type="submit" wire:model="searchedData"
                                class="absolute inset-0 appearance-none h-9 w-9 peer-focus:text-primary ltr:right-auto rtl:left-auto">
                                <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor"
                                        stroke-width="1.5" opacity="0.5" />
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                            <button type="submit"
                                class="absolute block -translate-y-1/2 top-1/2 hover:opacity-80 ltr:right-2 rtl:left-2 sm:hidden">
                                <svg width="20" height="20" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle opacity="0.5" cx="12" cy="12" r="10"
                                        stroke="currentColor" stroke-width="1.5" />
                                    <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="currentColor"
                                        stroke-width="1.5" stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button type="button"
                        class="p-2 rounded-full search_btn bg-white-light/40 hover:bg-white-light/90 dark:bg-dark/40 dark:hover:bg-dark/60 sm:hidden"
                        @click="search = ! search">
                        <svg class="mx-auto h-4.5 w-4.5 dark:text-[#d0d2d6]" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                opacity="0.5" />
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
            <a href="{{ route('admin.trashed.categories.list') }}" type="button" class="btn btn-danger">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ltr:mr-1.5 rtl:ml-1.5">
                    <circle cx="12" cy="12" r="3" stroke="currentColor" stroke-width="1.5"></circle>
                    <path opacity="0.5"
                        d="m20.25 7.5-.625 10.632a2.25 2.25 0 0 1-2.247 2.118H6.622a2.25 2.25 0 0 1-2.247-2.118L3.75 7.5m6 4.125 2.25 2.25m0 0 2.25 2.25M12 13.875l2.25-2.25M12 13.875l-2.25 2.25M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 "
                        stroke="currentColor" stroke-width="1.5"></path>
                </svg>
                حذف شده‌ها
            </a>
        </div>
        @if ($categories->isEmpty())
            <hr class="mb-4">
            <div class="text-center text-gray-500 ">موردی یافت نشد</div>
        @else
            <div class="mb-5">
                <div class="mt-3 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام دسته‌بندی</th>
                                <th>نام مستعار</th>
                                <th>عکس</th>
                                <th>وضعیت</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $index => $category)
                                <tr>
                                    <td>{{ $categories->firstItem() + $index }}</td>
                                    <td>{{ $category->name }}</td>
                                    <td>{{ $category->slug }}</td>
                                    <td>
                                        @if ($category->image)
                                            <img src="{{ asset('images/categories/' . $category->image) }}"
                                                alt="{{ $category->name }}"
                                                class="object-contain w-16 h-16 mx-auto rounded-md">
                                        @else
                                            <img src="{{ asset('images/noImage/noImage.png') }}"
                                                alt="{{ $category->name }}"
                                                class="object-contain w-16 h-16 mx-auto rounded-md">
                                        @endif
                                    </td>
                                    <td>{{ $category->status }}</td>
                                    <td class="border-b border-[#ebedf2] p-3 text-center dark:border-[#191e3a]">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <!-- Product Feature -->
                                            <a href="{{ route('admin.category.feature', $category->id) }}"
                                                x-tooltip="مدیریت ویژگی‌ها">
                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M2.5 6.5C2.5 4.29086 4.29086 2.5 6.5 2.5C8.70914 2.5 10.5 4.29086 10.5 6.5C10.5 8.70914 8.70914 10.5 6.5 10.5C4.29086 10.5 2.5 8.70914 2.5 6.5Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                    <path
                                                        d="M13.5 17.5C13.5 15.2909 15.2909 13.5 17.5 13.5C19.7091 13.5 21.5 15.2909 21.5 17.5C21.5 19.7091 19.7091 21.5 17.5 21.5C15.2909 21.5 13.5 19.7091 13.5 17.5Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                    <path
                                                        d="M21.5 6.5C21.5 4.61438 21.5 3.67157 20.9142 3.08579C20.3284 2.5 19.3856 2.5 17.5 2.5C15.6144 2.5 14.6716 2.5 14.0858 3.08579C13.5 3.67157 13.5 4.61438 13.5 6.5C13.5 8.38562 13.5 9.32843 14.0858 9.91421C14.6716 10.5 15.6144 10.5 17.5 10.5C19.3856 10.5 20.3284 10.5 20.9142 9.91421C21.5 9.32843 21.5 8.38562 21.5 6.5Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                    <path
                                                        d="M10.5 17.5C10.5 15.6144 10.5 14.6716 9.91421 14.0858C9.32843 13.5 8.38562 13.5 6.5 13.5C4.61438 13.5 3.67157 13.5 3.08579 14.0858C2.5 14.6716 2.5 15.6144 2.5 17.5C2.5 19.3856 2.5 20.3284 3.08579 20.9142C3.67157 21.5 4.61438 21.5 6.5 21.5C8.38562 21.5 9.32843 21.5 9.91421 20.9142C10.5 20.3284 10.5 19.3856 10.5 17.5Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </a>
                                            <!-- Delete Button -->
                                            <button type="button" x-tooltip="حذف"
                                                wire:click="$dispatch('deleteConfirm',{ category_id : {{ $category->id }} })"
                                                class="p-1.5 rounded hover:bg-red-50 dark:hover:bg-red-900/20 text-red-600 dark:text-red-400 transition-colors">
                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    class="w-5 h-5">
                                                    <path d="M20.5001 6H3.5" stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round"></path>
                                                    <path
                                                        d="M18.8334 8.5L18.3735 15.3991C18.1965 18.054 18.108 19.3815 17.243 20.1907C16.378 21 15.0476 21 12.3868 21H11.6134C8.9526 21 7.6222 21 6.75719 20.1907C5.89218 19.3815 5.80368 18.054 5.62669 15.3991L5.16675 8.5"
                                                        stroke="currentColor" stroke-width="1.5"
                                                        stroke-linecap="round"></path>
                                                    <path opacity="0.5" d="M9.5 11L10 16" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round"></path>
                                                    <path opacity="0.5" d="M14.5 11L14 16" stroke="currentColor"
                                                        stroke-width="1.5" stroke-linecap="round"></path>
                                                    <path opacity="0.5"
                                                        d="M6.5 6C6.55588 6 6.58382 6 6.60915 5.99936C7.43259 5.97849 8.15902 5.45491 8.43922 4.68032C8.44784 4.65649 8.45667 4.62999 8.47434 4.57697L8.57143 4.28571C8.65431 4.03708 8.69575 3.91276 8.75071 3.8072C8.97001 3.38607 9.37574 3.09364 9.84461 3.01877C9.96213 3 10.0932 3 10.3553 3H13.6447C13.9068 3 14.0379 3 14.1554 3.01877C14.6243 3.09364 15.03 3.38607 15.2493 3.8072C15.3043 3.91276 15.3457 4.03708 15.4286 4.28571L15.5257 4.57697C15.5433 4.62992 15.5522 4.65651 15.5608 4.68032C15.841 5.45491 16.5674 5.97849 17.3909 5.99936C17.4162 6 17.4441 6 17.5 6"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </button>
                                            <!-- Edit Button -->
                                            <button type="button" x-tooltip="Edit"
                                                wire:click="editCategory({{ $category->id }})"
                                                @click="scrollToTop()">
                                                <svg width="24" height="24" viewBox="0 0 24 24"
                                                    fill="none" xmlns="http://www.w3.org/2000/svg"
                                                    class="h-4.5 w-4.5 ltr:mr-2 rtl:ml-2">
                                                    <path
                                                        d="M15.2869 3.15178L14.3601 4.07866L5.83882 12.5999L5.83881 12.5999C5.26166 13.1771 4.97308 13.4656 4.7249 13.7838C4.43213 14.1592 4.18114 14.5653 3.97634 14.995C3.80273 15.3593 3.67368 15.7465 3.41556 16.5208L2.32181 19.8021L2.05445 20.6042C1.92743 20.9852 2.0266 21.4053 2.31063 21.6894C2.59466 21.9734 3.01478 22.0726 3.39584 21.9456L4.19792 21.6782L7.47918 20.5844L7.47919 20.5844C8.25353 20.3263 8.6407 20.1973 9.00498 20.0237C9.43469 19.8189 9.84082 19.5679 10.2162 19.2751C10.5344 19.0269 10.8229 18.7383 11.4001 18.1612L11.4001 18.1612L19.9213 9.63993L20.8482 8.71306C22.3839 7.17735 22.3839 4.68748 20.8482 3.15178C19.3125 1.61607 16.8226 1.61607 15.2869 3.15178Z"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                    <path opacity="0.5"
                                                        d="M14.36 4.07812C14.36 4.07812 14.4759 6.04774 16.2138 7.78564C17.9517 9.52354 19.9213 9.6394 19.9213 9.6394M4.19789 21.6777L2.32178 19.8015"
                                                        stroke="currentColor" stroke-width="1.5"></path>
                                                </svg>
                                            </button>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    <div class="panel">
                        <div class="flex flex-col justify-center w-full">
                            {{ $categories->links('admin.layouts.admin_pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('sweetAlert', (data) => {
                const alertMessage = data['message']
                const alertType = data['type']
                showAlert(alertMessage, alertType);
            });
            Livewire.on('deleteConfirm', (event) => {
                const category_id = event.category_id;
                deleteCategory(category_id);
            });
        });
    </script>


</div>
