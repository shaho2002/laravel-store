<main class="container">
    <!-- Breadcrumb -->
    <nav class="flex mt-8" aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
            <li class="inline-flex items-center">
                <a href="{{ route('mainPage') }}"
                    class="inline-flex items-center text-sm text-gray-700 gap-x-1 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    <svg class="size-4 mb-0.5">
                        <use href="#home" />
                    </svg>
                    صفحه اصلی
                </a>
            </li>
            <li class="inline-flex items-center">
                <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 9 4-4-4-4" />
                </svg>
                <a href="{{ route('cart') }}"
                    class="inline-flex items-center text-sm text-gray-700 gap-x-1 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    سبد خرید
                </a>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="text-sm text-gray-500 ms-1 md:ms-2 dark:text-gray-400">
                        آدرس و زمان ارسال
                    </span>
                </div>
            </li>
        </ol>
    </nav>

    @if ($this->carts->count() > 0)
        <section class="flex flex-col items-start justify-between gap-4 mt-5 lg:flex-row">
            <!-- Form -->
            <div
                class="flex flex-col w-full lg:w-3/4 gap-y-4 child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4">
                <div class="flex flex-col w-full">
                    <span class="flex items-center gap-x-2">
                        <a href="shopping-cart.html">
                            <svg class="size-5">
                                <use href="#arrow-right"></use>
                            </svg>
                        </a>
                        <p class="text-lg font-DanaDemiBold">آدرس و زمان ارسال</p>
                    </span>
                    <p class="mt-4 mb-8 text-sm text-gray-500 dark:text-gray-400 font-DanaMedium lg:text-base">
                        لطفا اطلاعات خود را به درستی وارد نمایید
                    </p>
                    <div class="flex flex-col items-start lg:flex-row ">
                        <form class="grid w-full grid-cols-12 gap-4">

                            <div class="flex flex-col col-span-6">
                                <input type="text" placeholder="نام*" wire:model="name"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11
                      @error('name') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('name')
                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col col-span-6">
                                <input type="text" placeholder="نام خانوادگی*" wire:model="family"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11
                      @error('family') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('family')
                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col col-span-6">
                                <input type="text" placeholder="استان*" wire:model="province"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11
                      @error('province') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('province')
                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col col-span-6">
                                <input type="text" placeholder="شهر*" wire:model="city"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11
                      @error('city') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('city')
                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col col-span-12">
                                <input type="text" placeholder="آدرس کامل و شماره پلاک*" wire:model="address"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all h-11
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400
                      @error('address') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('address')
                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col col-span-6">
                                <input type="text" placeholder="تلفن*(09181234567)" wire:model="mobile"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11
                      @error('mobile') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('mobile')
                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col col-span-6">
                                <input type="text" placeholder="کد پستی*" wire:model="postcode"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400 h-11
                      @error('postcode') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('postcode')
                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="flex flex-col col-span-12">
                                <input type="text" placeholder="توضیحات(اختیاری)" wire:model="description"
                                    class="block w-full py-1.5 px-3 text-base outline dark:outline-none outline-1 -outline-offset-1 placeholder:text-gray-400 transition-all
                      text-gray-800 dark:text-gray-100 dark:bg-gray-900 bg-slate-100 border border-transparent hover:border-slate-200 appearance-none rounded-md outline-none focus:bg-white focus:border-indigo-400 focus:ring-2 focus:ring-indigo-100 dark:focus:ring-blue-400
                      @error('description') border-red-500 dark:border-red-600 ring-red-100 dark:ring-red-400 ring-2 @enderror">
                                @error('description')

                                    <span class="mt-1 text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
                                @enderror
                            </div>

                        </form>

                    </div>
                </div>
                <div>
                    <span class="flex items-center gap-x-1">
                        <a href="shopping-cart.html">
                            <svg class="mb-1 size-5">
                                <use href="#truck"></use>
                            </svg>
                        </a>
                        <h1 class="font-DanaDemiBold">نوع ارسال : {{ $this->send_type?->name }}</h1>
                    </span>
                    <div
                        class="grid grid-cols-12 gap-2 mt-4 child:col-span-12 child:w-full child:flex child:items-center child:gap-x-2 child:rounded-lg child:p-3 child:duration-300 child:border child:border-gray-300 child:dark:border-gray-300/20 child:transition-all child:text-gray-600 child:dark:text-gray-300 child:font-DanaMedium child:text-base">
                        @foreach ($this->sendTypes as $sendType)
                            <button
                                wire:click="sendType({{ $sendType->id }})"
                                wire:model="send_type"
                                class=" group ring-transparent ring-1 focus:ring-blue-500 dark:ring-white/20 dark:focus:ring-blue-400">
                                <span
                                    class="w-4 h-4 transition-all duration-300 border border-gray-400 rounded-full group-focus:bg-blue-400 group-focus:border-blue-500"></span>
                                {{ $sendType->name }} : {{ number_format($sendType->cost) . ' تومان ' }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div>
                    <h1 class="text-lg font-DanaDemiBold">خلاصه سفارش</h1>
                    <div class="mt-8">
                        <span class="flex items-center gap-x-1.5">
                            <a href="shopping-cart.html">
                                <svg class="mb-1 text-red-500 size-6">
                                    <use href="#truck"></use>
                                </svg>
                            </a>
                            <h1 class="text-lg font-DanaMedium">جمعه ۲ خرداد-بازه ۹ - ۲۲</h1>
                        </span>

                        <div class="grid grid-cols-1 mt-8 sm:grid-cols-3 lg:grid-cols-3 gap-x-4">
                            @foreach ($this->carts as $cart)
                                <div class="flex flex-col items-start gap-y-2">
                                    <img src="{{ url('images/products/' . $cart->product->image) }}"
                                        class="h-20 w-36" alt="{{ $cart->product->name }}">
                                    <ul
                                        class="flex flex-col items-start mt-1 mr-3 text-gray-600 gap-y-1 font-DanaMedium dark:text-gray-200">
                                        <li class="flex items-center gap-x-1.5">
                                            <p class="text-sm text-gray-400">
                                                {{ $cart->count . 'عدد-' . $cart->product->name }}</p>
                                        </li>
                                        <li>
                                            <p>مبلغ:
                                                @php
                                                    if ($cart->product->productPrices) {
                                                        $product_price = $cart->product->productPrices
                                                            ->where('color_id', $cart->color_id)
                                                            ->where('warranty_id', $cart->warranty_id)
                                                            ->first();
                                                        if ($product_price) {
                                                            echo number_format(
                                                                ($product_price->price -
                                                                    ($product_price->price * $product_price->discount) /
                                                                        100) *
                                                                    $cart->count,
                                                            );
                                                        } else {
                                                            echo number_format(
                                                                ($cart->product->price -
                                                                    ($cart->product->price * $cart->product->discount) /
                                                                        100) *
                                                                    $cart->count,
                                                            );
                                                        }
                                                    }
                                                @endphp
                                            </p>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <!-- PRICE BOX -->
            <div
                class="flex flex-col w-full p-4 bg-white rounded-lg shadow lg:w-1/4 lg:sticky top-5 gap-y-4 dark:bg-gray-800">
                <!-- PRICE -->
                <ul class="space-y-8 child:flex child:items-center child:justify-between">
                    <li>
                        <p>قیمت کالاها({{ $this->count }})</p>
                        <p class="flex text-gray-600 gap-x-1 dark:text-gray-300 ">{{ number_format($this->realCost) }}
                            <span class="hidden xl:flex">تومان</span>
                        </p>
                    </li>
                    <li class="text-red-500 dark:text-red-400">
                        <p>تخفیف </p>
                        <p class="font-DanaMedium ">{{ number_format($this->discount) }} </p>
                    </li>
                    <li class="pt-8 border-t-2 border-gray-400 border-dashed">
                        <p> مبلغ نهایی :</p>
                        <p>{{ number_format($this->finalCost) }}</p>
                    </li>
                </ul>

                <button wire:click="payment"
                    class="flex items-center justify-center w-full py-2 mt-4 text-white transition-all bg-blue-500 rounded-lg shadow gap-x-1 hover:bg-blue-600">
                    پرداخت نهایی
                    <svg class="w-5 h-5">
                        <use href="#shopping-bag"></use>
                    </svg>
                </button>

            </div>
        </section>
    @else
        <section
            class="flex flex-col items-start justify-between gap-4 mt-5 lg:flex-row child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4">
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
        </section>
    @endif
</main>
