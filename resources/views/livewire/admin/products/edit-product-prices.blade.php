<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- Add categories --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        <div class="flex items-center justify-between mb-5">
            <h5 class="text-lg font-semibold dark:text-white-light"> ویرایش تنوع قیمت محصول
        </div>
        <div class="mb-5">
            <form class="space-y-5" wire:submit.prevent="updateFeature">
                <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                    <div>
                        <label for="productName">نام اصلی محصول
                            <input wire:model="main_name" id="productName" type="text"
                                placeholder="نام محصول را وارد کنید" class="form-input" disabled>
                            <p class="mt-1 text-danger">
                            </p>
                    </div>
                    <div>
                        <label for="productPrice">قیمت پایه محصول
                            <input wire:model="main_price" id="productPrice" type="number"
                                placeholder="قیمت محصول را وارد کنید" class="form-input" disabled>
                            <p class="mt-1 text-danger">
                            </p>
                    </div>
                    {{-- prices --}}
                    <div>
                        <label for="productName">نام تنوع قیمت <span class="text-danger">*</span></label>
                        <input wire:model="name" id="productName" type="text" placeholder="نام محصول را وارد کنید"
                            class="form-input">
                        <p class="mt-1 text-danger">
                            @error('name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div>
                        <label for="productEName">نام انگلیسی تنوع قیمت <span class="text-danger">*</span></label>
                        <input wire:model="e_name" id="productEName" type="text"
                            placeholder="نام انگلیسی محصول را وارد کنید" class="form-input">
                        <p class="mt-1 text-danger">
                            @error('e_name')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <!-- رنگ‌ها -->
                    <div>
                        <label for="colorsSelect">رنگ <span class="text-danger">*</span></label>
                        <div wire:ignore>
                            <select wire:model="color_id" id="colorsSelect" class="selectize" x-ref="colorsSelect">
                                @foreach ($colors as $color)
                                    <option value="{{ $color->id }}"
                                        {{ $this->color_id == $color->id ? 'selected' : '' }}>{{ $color->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p class="mt-1 text-danger">
                            @error('color_id')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <!-- گارانتی -->
                    <div>
                        <label for="warrantySelect">گارانتی <span class="text-danger">*</span></label>
                        <div wire:ignore>
                            <select wire:model="warranty_id" id="warrantySelect" class="selectize"
                                x-ref="warrantySelect">
                                @foreach ($warranties as $warranty)
                                    <option value="{{ $warranty->id }}"
                                        {{ $this->warranty_id == $warranty->id ? 'selected' : '' }}>{{ $warranty->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <p class="mt-1 text-danger">
                            @error('warranty_id')
                                {{ $message }}
                            @enderror
                        </p>

                    </div>
                    <div>
                        <label for="productPrice">قیمت <span class="text-danger">*</span></label>
                        <input wire:model="price" id="productPrice" type="number" placeholder="قیمت محصول را وارد کنید"
                            class="form-input">
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
                        <label for="productCount">تعداد <span class="text-danger">*</span></label> </label>
                        <input wire:model="count" id="productCount" type="number"
                            placeholder="تعداد موجودی محصول را وارد کنید" class="form-input">
                        <p class="mt-1 text-danger">
                            @error('count')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div>
                        <label for="maxSell">حداکثر فروش <span class="text-danger">*</span></label> </label>
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
                </div>

                <button type="submit" class="btn btn-primary !mt-6">ویرایش تنوع قیمت</button>
        </div>
        </form>
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
