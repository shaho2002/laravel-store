<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- Add categories --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light">افزودن مقاله جدید</h5>
        </div>
        <div class="mb-5">
            <form class="space-y-5" wire:submit.prevent="updateArticle">
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
                        <div>
                            <label>عنوان<span class="text-danger">*</span></label>
                            <input wire:model="title" type="text" class="form-input" placeholder="یک عنوان برای مقاله بنویسید">
                            <p class="mt-1 text-danger">@error('title') {{ $message }} @enderror</p>
                        </div>

                        <div>
                            <label>اسلاگ</label>
                            <input wire:model="slug" type="text" class="form-input" placeholder="نام مستعار(اختیاری)">
                            <p class="mt-1 text-danger">@error('slug') {{ $message }} @enderror</p>
                        </div>

                        <div>
                            <label>دسته‌‌بندی <span class="text-danger">*</span></label>
                            <div wire:ignore>
                                <select id="colorsSelect" class="selectize" wire:model="category_id">
                                    @foreach ($articleCategories as $category)
                                        <option value="{{ $category->id }}" {{ $this->category_id == $category->id ?'selected':''}}>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <p class="mt-1 text-danger">@error('category_id') {{ $message }} @enderror</p>
                        </div>

                        <div>
                            <label for="image">عکس مقاله</label>
                            <input id="image" type="file" wire:model="image" x-ref="imageInput"
                                x-on:change="if (!$event.target.files || !$event.target.files.length) {
                                    uploading = false; progress = 0; message = ''; messageType = '';
                                }" class="p-0 form-input file:py-2 file:px-4 file:border-0 file:font-semibold file:bg-primary/90 ltr:file:mr-5 rtl:file:ml-5 file:text-white file:hover:bg-primary" />
                            <p class="mt-1 text-danger">@error('image') {{ $message }} @enderror</p>

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
                                <div class="mt-1 text-xs" x-show="uploading" x-text="progress + '%'"></div>
                            </div>

                            <div class="mt-2" x-show="message" x-transition>
                                <p x-text="message"
                                    x-bind:class="{ 'text-green-500': messageType === 'success', 'text-red-500': messageType === 'error', 'text-gray-500': messageType === 'info' }"
                                    class="flex items-center"></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="md:col-span-2">
                        <label for="productDescription">مقاله <span class="text-danger">*</span></label>
                        <textarea wire:model="article" id="productDescription" rows="5" placeholder="متن کامل را اینجا بنویسید ... " class="form-input"></textarea>
                        <p class="mt-1 text-danger">@error('article') {{ $message }} @enderror</p>
                    </div>
                    
                    <div>
                        <label class="block mb-2">وضعیت </label>
                        <div class="flex items-center gap-3">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model="status" value="active" name="status" class="form-radio text-success">
                                <span>فعال</span>
                            </label>

                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model="status" value="notActive" name="status" class="form-radio text-danger">
                                <span>غیرفعال</span>
                            </label>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-success !mt-6">ویرایش</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Script for Livewire and Selectize initialization
        document.addEventListener('livewire:init', () => {
            Livewire.on('sweetAlert', (data) => {
                const alertMessage = data['message'];
                const alertType = data['type'];
                if (typeof showAlert === 'function') {
                    showAlert(alertMessage, alertType);
                } else {
                    console.error("showAlert function is not defined.");
                    alert(`${alertType.toUpperCase()}: ${alertMessage}`); // Fallback
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function(e) {
            var colorsSelect = document.getElementById("colorsSelect");
            if (colorsSelect) {
                NiceSelect.bind(colorsSelect, { searchable: true });
            }
        });
    </script>
</div>