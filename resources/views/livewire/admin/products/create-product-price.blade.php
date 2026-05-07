<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- Add categories --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light"> افزودن تنوع قیمت محصول
        </div>
        <div class="mb-5">
            <form class="space-y-5" wire:submit.prevent="createFeature">

                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">

                    <div>
                        <label for="productName">نام اصلی محصول</label>
                        <input wire:model="main_name" id="productName" type="text" class="form-input" disabled>
                        {{-- No validation error needed for disabled fields --}}
                    </div>

                    <div>
                        <label for="productPrice">قیمت پایه محصول</label>
                        <input wire:model="main_price" id="productPrice" type="number" class="form-input" disabled>
                        {{-- No validation error needed for disabled fields --}}
                    </div>

                    <div>
                        <label>نام تنوع قیمت <span class="text-danger">*</span></label>
                        <input wire:model="name" type="text" class="form-input">
                        {{-- Error message for 'name' --}}
                        <p class="mt-1 text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label>نام انگلیسی تنوع قیمت <span class="text-danger">*</span></label>
                        <input wire:model="e_name" type="text" class="form-input">
                        {{-- Error message for 'e_name' --}}
                        <p class="mt-1 text-danger">
                            @error('e_name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label>رنگ <span class="text-danger">*</span></label>
                        <div wire:ignore>
                            <select id="colorsSelect" class="selectize" wire:model="color_id">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}">{{ $color->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Error message for 'color_id' --}}
                        <p class="mt-1 text-danger">
                            @error('color_id')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label>گارانتی <span class="text-danger">*</span></label>
                        <div wire:ignore>
                            <select id="warrantySelect" class="selectize" wire:model="warranty_id">
                                @foreach ($warranties as $warranty)
                                    <option value="{{ $warranty->id }}">{{ $warranty->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        {{-- Error message for 'warranty_id' --}}
                        <p class="mt-1 text-danger">
                            @error('warranty_id')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label>قیمت <span class="text-danger">*</span></label>
                        <input wire:model="price" type="number" class="form-input">
                        {{-- Error message for 'price' --}}
                        <p class="mt-1 text-danger">
                            @error('price')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label>تخفیف</label>
                        <input wire:model="discount" type="number" class="form-input">
                        {{-- Error message for 'discount' --}}
                        <p class="mt-1 text-danger">
                            @error('discount')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label>تعداد <span class="text-danger">*</span></label>
                        <input wire:model="count" type="number" class="form-input">
                        {{-- Error message for 'count' --}}
                        <p class="mt-1 text-danger">
                            @error('count')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label>حداکثر فروش <span class="text-danger">*</span></label>
                        <input wire:model="max_sell" type="number" class="form-input">
                        {{-- Error message for 'max_sell' --}}
                        <p class="mt-1 text-danger">
                            @error('max_sell')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label class="block mb-2">وضعیت </label>
                        <div class="flex items-center gap-3">
                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model="status" value="active" name="status"
                                    class="form-radio text-success">
                                <span>فعال</span>
                            </label>

                            <label class="inline-flex items-center gap-2 cursor-pointer">
                                <input type="radio" wire:model="status" value="notActive" name="status"
                                    class="form-radio text-danger">
                                <span>غیرفعال</span>
                            </label>
                        </div>
                        {{-- Error message for 'status' --}}
                        <p class="mt-1 text-danger">
                            @error('status')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                </div>

                <button type="submit" class="btn btn-primary !mt-6">
                    ثبت تنوع قیمت
                </button>

            </form>
        </div>
    </div>
    <script>
        // Script for Livewire and Selectize initialization
        document.addEventListener('livewire:init', () => {
            Livewire.on('sweetAlert', (data) => {
                const alertMessage = data['message'];
                const alertType = data['type'];
                // Assuming showAlert is a globally defined function
                if (typeof showAlert === 'function') {
                    showAlert(alertMessage, alertType);
                } else {
                    console.error("showAlert function is not defined.");
                    alert(`${alertType.toUpperCase()}: ${alertMessage}`); // Fallback
                }
            });
        });

        document.addEventListener("DOMContentLoaded", function(e) {
            // Initialize NiceSelect for colors
            var colorsSelect = document.getElementById("colorsSelect");
            if (colorsSelect) {
                NiceSelect.bind(colorsSelect, {
                    searchable: true
                });
            }

            // Initialize NiceSelect for warranty
            var warrantySelect = document.getElementById("warrantySelect");
            if (warrantySelect) {
                NiceSelect.bind(warrantySelect, {
                    searchable: true
                });
            }
        });

        // Alpine.js initialization (if used elsewhere or for other components)
        // This part might be redundant if the NiceSelect initialization is already handled in DOMContentLoaded
        // or if you are not using Alpine.js for these specific selects.
        document.addEventListener('alpine:init', () => {
            Alpine.data('myComponent', () => ({
                activeTab: 1,
                init() {
                    // It's generally better to initialize plugins once, either in DOMContentLoaded or here, but not both if they target the same elements.
                    // If these Alpine refs are used for other purposes, keep them.
                    // If only for NiceSelect, the DOMContentLoaded approach is sufficient.
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
</div>
