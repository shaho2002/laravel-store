<div class="grid grid-cols-1 gap-6 p-3 ">
    {{-- Add product_infos --}}
    <div class="panel">
        {{-- include loading --}}
        @include('admin.layouts.loading')
        @if ($this->category_feature_id)
            <div class="flex items-center justify-between mb-5">
                <h5 class="text-lg font-semibold dark:text-white-light"> ویرایش اطلاعات محصول </h5>
            </div>
            <div class="mb-5">
                <form class="space-y-5" wire:submit.prevent="createproduct_info">
                    <div>
                        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                            <div class="">
                                <label for="customproduct_infoName"> ویژگی محصول
                                </label>
                                <input wire:model="category_feature_name" id="customproduct_infoName" type="text"
                                    class="form-input" disabled>
                            </div>
                            <div class="">
                                <label for="product_infoSlug"> مقدار ویژگی</label>
                                <input wire:model="name" id="name" type="text"
                                    placeholder="  مقدار را وارد کنید" class="form-input">
                                <p class="mt-1 text-danger">
                                    @error('name')
                                        {{ $message }}
                                    @enderror
                                </p>
                            </div>
                        </div>

                        <div class="flex gap-4">
                            <button type="button" wire:click="updateProductInfo({{ $this->category_feature_id }})"
                                class="btn btn-success !mt-6">ویرایش</button>
                            <button type="button" wire:click="editCancel" class="btn btn-danger !mt-6">لغو</button>
                        </div>
                    </div>
                </form>
            </div>
    </div>
    @endif
    {{-- show product_infos --}}
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <h5 class="text-lg font-semibold dark:text-white-light"> ویژگی‌های {{ $this->product->name }} در دسته
                    بندی {{ $this->product->category->name }}</h5>

            </div>
        </div>
        @if ($category_features->isEmpty())
            <hr class="mb-4">
            <div class="text-center text-gray-500 ">موردی یافت نشد</div>
        @else
            <div class="mb-5">
                <div class="mt-3 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام ویژگی</th>
                                <th>مقدار</th>
                                <th class="text-center">عملیات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($category_features as $index => $category_feature)
                                <tr>
                                    <td>{{ $category_features->firstItem() + $index }}</td>
                                    <td>{{ $category_feature->name }}</td>

                                    <td>
                                        {{-- show value --}}
                                        @php
                                            $productInfo = $category_feature->product_infos->firstWhere(
                                                'product_id',
                                                $this->product->id,
                                            );
                                        @endphp

                                        @if ($productInfo && !empty($productInfo->name))
                                            {{ $productInfo->name }}
                                        @else
                                            ثبت نشده
                                        @endif

                                    </td>


                                    <td class="border-b border-[#ebedf2] p-3 text-center dark:border-[#191e3a]">
                                        <div class="flex items-center justify-center gap-1.5">
                                            <!-- Edit Button -->
                                            <button type="button" x-tooltip="ویرایش"
                                                wire:click="editProductInfo({{ $category_feature->id }})"
                                                @click="scrollToTop()">
                                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                                    xmlns="http://www.w3.org/2000/svg"
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
                            {{ $category_features->links('admin.layouts.admin_pagination') }}
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
        });
    </script>


</div>
