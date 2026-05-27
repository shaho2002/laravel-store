<div class="grid grid-cols-1 gap-6 p-3 ">
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
<div>
    <div class="panel">
        @include('admin.layouts.loading')<div x-data="{}">
            <div class="flex items-center justify-between mb-5">
                <h5 class="text-lg font-semibold dark:text-white-light">
                    {{ isset($footer_value) ? 'ویرایش فوتر' : 'ایجاد فوتر' }}
                </h5>
            </div>

            <form wire:submit.prevent="{{ isset($footer_value) ? 'updateFooter' : 'createFooter' }}">
                <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">

                    {{-- Mobile --}}
                    <div>
                        <label for="mobile" class="block text-sm font-medium text-gray-700 dark:text-white-light">
                            موبایل
                        </label>
                        <input
                            type="text"
                            id="mobile"
                            wire:model="mobile"
                            placeholder="مثال: 09123456789"
                            class="form-input mt-1 w-full @error('mobile') border-red-500 @enderror"
                        />
                        @error('mobile')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Email --}}
                    <div>
                        <label for="emailAddress" class="block text-sm font-medium text-gray-700 dark:text-white-light">
                            ایمیل
                        </label>
                        <input
                            type="email"
                            id="emailAddress"
                            wire:model="emailAddress"
                            placeholder="مثال: info@example.com"
                            class="form-input mt-1 w-full @error('emailAddress') border-red-500 @enderror"
                        />
                        @error('emailAddress')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- Address --}}
                    <div class="sm:col-span-2">
                        <label for="address" class="block text-sm font-medium text-gray-700 dark:text-white-light">
                            آدرس
                        </label>
                        <textarea
                            id="address"
                            wire:model="address"
                            rows="3"
                            placeholder="آدرس را وارد کنید..."
                            class="form-textarea mt-1 w-full @error('address') border-red-500 @enderror"
                        ></textarea>
                        @error('address')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    {{-- About Us --}}
                    <div class="sm:col-span-2">
                        <label for="aboutUs" class="block text-sm font-medium text-gray-700 dark:text-white-light">
                            درباره ما
                        </label>
                        <textarea
                            id="aboutUs"
                            wire:model="aboutUs"
                            rows="4"
                            placeholder="متن درباره ما را وارد کنید..."
                            class="form-textarea mt-1 w-full @error('aboutUs') border-red-500 @enderror"
                        ></textarea>
                        @error('aboutUs')
                            <p class="mt-1 text-xs text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="flex items-center gap-3 mt-6">
                    <button type="submit" class="btn btn-primary">
                        {{ isset($footer_value) ? 'بروزرسانی' : 'ذخیره' }}
                    </button>
                    @if(isset($footer_value))
                        <button type="button" wire:click="resetForm" class="btn btn-outline-danger">
                            انصراف
                        </button>
                    @endif
                </div>

            </form>
        </div>

    </div>
</div>
    </div>

    <script>
        document.addEventListener('livewire:init', () => {
            Livewire.on('sweetAlert', (data) => {
                const alertMessage = data['message']
                const alertType = data['type']
                showAlert(alertMessage, alertType);
            });
        });
    </script>


</div>
