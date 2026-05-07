<main class="container">
    <!-- Breadcrumb -->
    <nav class="flex mt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="index.html"
                    class="inline-flex items-center text-sm text-gray-700 gap-x-1 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="size-4 mb-0.5">
                        <use href="#home" />
                    </svg>
                    صفحه اصلی
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="text-sm text-gray-500 ms-1 md:ms-2 dark:text-gray-400">سبد خرید</span>
                </div>
            </li>
        </ol>
    </nav>

    <!-- shopping cart -->
    <section
        class="flex flex-col items-start justify-between gap-4 mt-5 lg:flex-row child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4">
        <!-- products -->
        @if ($this->carts->count() > 0)
            <div class="flex flex-col w-full lg:w-3/4 gap-y-8 ">
                <!-- shopping cart header -->
                <div class="flex items-center justify-between">
                    <span class="flex items-center gap-x-2">
                        <h2 class="text-xl font-DanaMedium">سبد خرید</h2>
                        <p class="text-gray-400">({{ $this->count }} کالا)</p>
                    </span>
                    <span class="flex items-center text-red-600 cursor-pointer gap-x-1 dark:text-white">
                        <p class="mt-1 font-DanaMedium " wire:click="deleteAllFromCart">حذف همه</p>
                        <svg class="w-5 h-5">
                            <use href="#trash"></use>
                        </svg>
                    </span>
                </div>
                <!-- PRODUCT ITEMS -->
                <div class="flex flex-col w-full gap-y-4 child:p-2 lg:child:p-4 ">
                    <!-- PRODUCT ITEM -->

                    @foreach ($this->carts as $cart)
                        <div
                            class="relative flex justify-between w-full border-b-2 border-gray-200 dark:border-white/20 ">
                            <div class="flex flex-col items-center gap-6 sm:flex-row">
                                <!-- IMG AND COUNT BTN -->
                                <div class="flex flex-col w-fit">
                                    <img src="{{ url('images/products/' . $cart->product->image) }}" class="w-36"
                                        alt="">
                                    <button
                                        class="flex items-center justify-between px-2 py-1 border border-gray-200 rounded-lg gap-x-1 dark:border-white/20">
                                        <svg class="w-4 h-4 text-green-600" wire:click="plus({{ $cart->id }})">
                                            <use href="#plus"></use>
                                        </svg>
                                        <input type="number" name="customInput" id="customInput" min="1"
                                            max="20" value="{{ $cart->count }}"
                                            class="mr-8 text-lg bg-transparent custom-input">
                                        <svg class="w-4 h-4 text-red-500 " wire:click="minus({{ $cart->id }})">
                                            <use href="#minus"></use>
                                        </svg>
                                    </button>
                                </div>
                                <!-- information and name product -->
                                <div class="flex flex-col gap-y-4">
                                    <h2 class="font-DanaMedium line-clamp-1">
                                        {{ $cart->product->e_name . ' | ' . $cart->product->name }}
                                    </h2>
                                    <ul
                                        class="space-y-3 child:text-sm text-gray-400 child:flex child:items-center child:gap-x-1.5">
                                        <li>
                                            <span class="rounded-full size-5"
                                                style="background-color: {{ $cart->product->colors->firstWhere('id', $cart->color_id)->code }};">
                                            </span>

                                            <p>
                                                {{ $cart->product->colors->firstWhere('id', $cart->color_id)->name }}
                                            </p>
                                        </li>
                                        <li>
                                            <svg class="w-5 h-5">
                                                <use href="#shield"></use>
                                            </svg>
                                            <p class="mt-1">
                                                {{ $cart->product->warranties->firstWhere('id', $cart->warranty_id)->name }}
                                            </p>
                                        </li>
                                        <li>
                                            <svg class="w-5 h-5">
                                                <use href="#truck"></use>
                                            </svg>
                                            <p class="mt-1">ارسال 1 روز کاری</p>
                                        </li>
                                    </ul>
                                    <span
                                        class="flex items-center mt-4 text-gray-700 gap-x-1 dark:text-gray-300 font-DanaMedium">
                                        <p class="text-xl font-DanaMedium">
                                            @php
                                                if ($cart->product->productPrices) {
                                                    $product_price = $cart->product->productPrices
                                                        ->where('color_id', $cart->color_id)
                                                        ->where('warranty_id', $cart->warranty_id)
                                                        ->first();
                                                    if ($product_price) {
                                                        echo number_format(
                                                            $product_price->price -
                                                                ($product_price->price * $product_price->discount) /
                                                                    100,
                                                        );
                                                    } else {
                                                        echo number_format(
                                                            $cart->product->price -
                                                                ($cart->product->price * $cart->product->discount) /
                                                                    100,
                                                        );
                                                    }
                                                }
                                            @endphp
                                        </p>
                                        <p class="text-lg">تومان</p>
                                    </span>
                                    <span
                                        class="absolute left-0 flex items-center text-sm text-red-500 cursor-pointer bottom-3 sm:hidden gap-x-1">
                                        <p class="hidden sm:flex"wire:click="deleteFromCart({{ $cart->id }})">حذف از
                                            سبد
                                            خرید</p>

                                        <p class="flex sm:hidden"wire:click="deleteFromCart({{ $cart->id }})">حذف
                                            از
                                            سبد خرید</p>

                                        <svg class="w-4 h-4">
                                            <use href="#x-mark"></use>
                                        </svg>
                                    </span>
                                    <svg class="absolute top-0 left-0 flex w-5 h-5 sm:hidden">
                                        <use href="#close"></use>
                                    </svg>
                                </div>
                            </div>
                            <div class="flex-col items-end justify-between hidden sm:flex">

                                <span
                                    class="absolute flex items-center text-sm text-red-500 transition-all duration-300 cursor-pointer bottom-5 hover:ml-2 gap-x-1">
                                    <p class="hidden md:flex"wire:click="deleteFromCart({{ $cart->id }})">حذف از
                                        سبد
                                        خرید</p>

                                    <p class="flex md:hidden"wire:click="deleteFromCart({{ $cart->id }})">حذف از
                                        سبد
                                        خرید</p>

                                    <svg class="w-4 h-4">
                                        <use href="#x-mark"></use>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>

            <!-- PRICE BOX -->
            <div class="flex flex-col w-full lg:w-1/4 lg:sticky top-5 gap-y-4">
                <!-- PRICE -->
                <ul class="space-y-8 child:flex child:items-center child:justify-between">
                    <li>
                        <p>قیمت کالاها({{ $this->count }})</p>
                        <p class="flex text-gray-600 gap-x-1 dark:text-gray-300 ">{{ number_format($this->realCost) }}
                            <span class="hidden xl:flex">تومان</span>
                        </p>
                    </li>
                    <li>
                        <p class="text-red-500 dark:text-red-400">تخفیف </p>
                        <p class="text-red-500 dark:text-red-400">{{ number_format($this->discount) }}</p>
                    </li>
                    <li class="pt-8 border-t-2 border-gray-400 border-dashed">
                        <p> مبلغ نهایی :</p>
                        <p>{{ number_format($this->finalCost) }}</p>
                    </li>
                </ul>

                <a href="{{ route('address') }}"
                    class="flex items-center justify-center w-full py-2 mt-4 text-white transition-all bg-blue-500 rounded-lg shadow gap-x-1 hover:bg-blue-600">
                    تایید و تکمیل سفارش
                    <svg class="w-5 h-5">
                        <use href="#shopping-bag"></use>
                    </svg>
                </a>

            </div>
        @else
            <div class="flex items-center justify-center w-full py-12">
                <div
                    class="w-full max-w-sm px-5 py-8 text-center bg-white border border-gray-200 shadow-md dark:bg-gray-800 rounded-xl dark:border-gray-700">
                    <h2 class="text-lg text-gray-700 sm:text-xl font-DanaMedium dark:text-gray-200">
                        🛒 سبد خرید شما خالی است
                    </h2>
                    <p class="mt-3 text-sm text-gray-500 sm:text-base">
                        هنوز کالایی به سبد خرید اضافه نکردید
                    </p>
                </div>
            </div>

        @endif
    </section>
</main>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('sweetAlert', (data) => {
            const alertMessage = data['message']
            const alertType = data['type']
            const alertTitle= data['title']
            showAlert(alertMessage, alertType, alertTitle);
        });
    });
</script>
