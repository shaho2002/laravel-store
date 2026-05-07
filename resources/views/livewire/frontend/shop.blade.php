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
                    <span class="text-sm text-gray-500 ms-1 md:ms-2 dark:text-gray-400">فروشگاه</span>
                </div>
            </li>
        </ol>
    </nav>

    <div class="flex flex-col gap-4 mt-5 lg:flex-row">
        <!-- SIDE FILTER BOX -->
        <div
            class="flex-col items-center hidden py-4 bg-white rounded-lg shadow lg:sticky top-1 h-fit lg:w-1/4 lg:flex gap-y-4 dark:bg-gray-800">
            <!-- TITLE -->
            <div class="flex items-center justify-between w-full px-2 xl:px-4">
                <span class="flex items-center gap-x-1">
                    <p class="text-lg text-gray-700 font-DanaMedium dark:text-gray-200">فیلترها
                    </p>
                </span>
                <p class="text-sm text-blue-500 cursor-pointer dark:text-blue-400"> حذف فیلتر‌ها</p>
            </div>
            <!-- FILTERS -->
            <div class="w-full divide-y divide-slate-200 dark:divide-gray-700/20">
                <!-- Accordion -->
                <div class="">
                    <button onclick="toggleAccordion(1)"
                        class="flex items-center justify-between w-full px-2 pt-4 mb-4 text-gray-800 xl:px-4 dark:text-gray-100">
                        <span>دسته بندی </span>
                        <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                            <svg class="transition-transform duration-300 size-4">
                                <use href="#chevron-left"></use>
                            </svg>
                        </span>
                    </button>
                    <div id="content-1" class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
                        <div class="pb-3 text-gray-700 dark:text-gray-300 w-full flex flex-col gap-y-1.5">
                            <!-- item -->
                            <div class="inline-flex items-center mr-2.5" wire:click="setCategory(null)">
                                <label class="mr-1 text-gray-800 cursor-pointer dark:text-gray-400" for="ripple-2">
                                    همه
                                </label>
                            </div>
                            <!-- item -->
                            @foreach ($this->categories as $category)
                                <div class="inline-flex items-center mr-2.5"
                                    wire:click="setCategory({{ $category->id }})">
                                    <label class="mr-1 text-gray-800 cursor-pointer dark:text-gray-400" for="ripple-2">
                                        {{ $category->name }}
                                    </label>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
                <!-- TOGGLE SWITCH -->
                <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4" dir="ltr" >
                    <label for="hs-valid-toggle-switch" class="relative inline-block h-6 cursor-pointer w-11">
                        <input type="checkbox" id="hs-valid-toggle-switch" class="sr-only peer" wire:click="exist_products">
                        <span
                            class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span
                            class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                    </label>
                    <label for="hs-valid-toggle-switch" class="text-gray-800 dark:text-gray-100" >
                        فقط کالا های موجود
                    </label>
                </div>
                <!-- TOGGLE SWITCH -->
                <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4" dir="ltr">
                    <label for="hs-valid-toggle-switch2" class="relative inline-block h-6 cursor-pointer w-11">
                        <input type="checkbox" id="hs-valid-toggle-switch2" class="sr-only peer">
                        <span
                            class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span
                            class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                    </label>
                    <label for="hs-valid-toggle-switch2"
                        class="flex items-center text-gray-800 dark:text-gray-100 gap-x-2">
                        <img class="size-5" src="./images/svg/time.png" alt="">
                        ارسال امروز
                    </label>
                </div>
                <!-- Accordion -->
                <div class="">
                    <button onclick="toggleAccordion(2)"
                        class="flex items-center justify-between w-full px-2 py-4 text-gray-800 xl:px-4 dark:text-gray-100">
                        <span>محدوده قیمت</span>
                        <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                            <svg class="transition-transform duration-300 size-4">
                                <use href="#chevron-left"></use>
                            </svg>
                        </span>
                    </button>
                    <div id="content-2"
                        class="overflow-hidden transition-all duration-300 ease-in-out price-slider max-h-0">
                        <div class="w-full px-4 pb-3 text-gray-700 dark:text-gray-300">
                            <div class="mt-5 wrapper">
                                <div class="slider-bar">
                                    <div class="progress"></div>
                                </div>
                                <div class="range-input">
                                    <input type="range" min="0" max="100000" value="0"
                                        class="min-range" />
                                    <input type="range" min="0" max="100000" value="35000"
                                        class="max-range" />
                                </div>
                                <div class="mt-4 text-gray-800 price-input dark:text-gray-500">
                                    <div class="justify-start field">
                                        <span class="mr-2 text-sm font-DanaMedium">تومان</span>
                                        <p class="min-input">0</p>
                                    </div>
                                    <div class="justify-end field">
                                        <span class="mr-2 text-sm font-DanaMedium">تومان</span>
                                        <p class="max-input">350,000</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- TOGGLE SWITCH -->
                <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4" dir="ltr">
                    <label for="hs-valid-toggle-switch3" class="relative inline-block h-6 cursor-pointer w-11">
                        <input type="checkbox" id="hs-valid-toggle-switch3" class="sr-only peer">
                        <span
                            class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span
                            class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                    </label>
                    <label for="hs-valid-toggle-switch3"
                        class="flex items-center text-gray-800 dark:text-gray-100 gap-x-2">
                        <img class="size-5" src="./images/svg/Seller.svg" alt="">
                        ارسال فروشنده
                    </label>
                </div>
                <!-- TOGGLE SWITCH -->
                <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4" dir="ltr">
                    <label for="hs-valid-toggle-switch4" class="relative inline-block h-6 cursor-pointer w-11">
                        <input type="checkbox" id="hs-valid-toggle-switch4" class="sr-only peer">
                        <span
                            class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                        <span
                            class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                    </label>
                    <label for="hs-valid-toggle-switch4"
                        class="flex items-center text-gray-800 dark:text-gray-100 gap-x-1">
                        <img class="size-5" src="./images/svg/shop.png" alt="">
                        خرید حضوری در تهران
                    </label>
                </div>
            </div>
        </div>
        <!-- TOP FILTER BOX & PRODUCT & PAGINATION -->
        <div class="lg:w-3/4">
            <!-- MOBILE FILTERS -->
            <div class="flex items-center lg:hidden gap-x-2">
                <!-- SORT BTN -->
                <button
                    class="sort-modal-open text-sm mb-4 py-1.5 px-3 app-border rounded-full flex items-center gap-x-1">
                    <svg class="text-gray-400 size-4">
                        <use href="#sort-list"></use>
                    </svg>
                    <p>مرتب‌ سازی</p>
                </button>
                <!-- SORT MODAL -->
                <div class="sort-modal">
                    <div class="flex justify-between sort-modal-close">
                        <p>مرتب سازی بر اساس </p>
                        <svg class="text-gray-800 size-5 dark:text-gray-300">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>
                    <ul
                        class="flex flex-col items-center justify-center w-full divide-y divide-gray-300 child:w-full child:text-center dark:divide-gray-200/20 child:py-3">
                        <li wire:click="orderBy('all')"
                            class="{{ $this->order === 'all' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            همه
                        </li>

                        <li wire:click="orderBy('popular')"
                            class="{{ $this->order === 'popular' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            محبوب‌ترین
                        </li>

                        <li wire:click="orderBy('bestSeller')"
                            class="{{ $this->order === 'bestSeller' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            پرفروش‌ترین
                        </li>

                        <li wire:click="orderBy('cheaper')"
                            class="{{ $this->order === 'cheaper' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            ارزان‌ترین
                        </li>

                        <li wire:click="orderBy('mostExpensive')"
                            class="{{ $this->order === 'mostExpensive' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            گران‌ترین
                        </li>
                    </ul>
                </div>
                <!-- FILTER BTN -->
                <button
                    class="filter-modal-open text-sm mb-4 py-1.5 px-3 app-border rounded-full flex items-center gap-x-1">
                    <svg class="text-gray-400 size-4">
                        <use href="#filter"></use>
                    </svg>
                    <p>فیلتر</p>
                </button>
                <!-- Filter MODAL -->
                <div class="filter-modal">
                    <div class="flex justify-between filter-modal-close">
                        <p>فیلتر</p>
                        <svg class="text-gray-800 size-5 dark:text-gray-300">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>
                    <!-- FILTERS -->
                    <div class="w-full divide-y divide-slate-200 dark:divide-gray-700/20">
                        <!-- Accordion -->
                        <div class="">
                            <button onclick="toggleAccordion(3)"
                                class="flex items-center justify-between w-full px-2 pt-4 mb-4 text-gray-800 xl:px-4 dark:text-gray-100">
                                <span>دسته بندی </span>
                                <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                                    <svg class="transition-transform duration-300 size-4">
                                        <use href="#chevron-left"></use>
                                    </svg>
                                </span>
                            </button>
                            <div id="content-3"
                                class="overflow-hidden transition-all duration-300 ease-in-out max-h-0">
                                <div class="pb-3 text-gray-700 dark:text-gray-300 w-full flex flex-col gap-y-1.5">
                                    <!-- item -->
                                    <div class="inline-flex items-center mr-2.5 mt-1">
                                        <label class="mr-1 text-gray-800 cursor-pointer dark:text-gray-400"
                                        wire:click="setCategory(null)"
                                            for="ripple-5">
                                            همه کالاها
                                        </label>
                                    </div>
                                    <!-- item -->
                                    @foreach ($this->categories as $category )
                                        <div class="inline-flex items-center mr-2.5">
                                            <label class="mr-1 text-gray-800 cursor-pointer dark:text-gray-400" wire:click="setCategory({{ $category->id }})"
                                                for="ripple-6">
                                                {{ $category->name }}
                                            </label>
                                        </div>
                                    @endforeach
                                    
                                </div>
                            </div>
                        </div>
                        <!-- TOGGLE SWITCH -->
                        <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4"
                            dir="ltr">
                            <label for="hs-valid-toggle-switch5"
                                class="relative inline-block h-6 cursor-pointer w-11">
                                <input type="checkbox" id="hs-valid-toggle-switch5" class="sr-only peer">
                                <span
                                    class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                <span
                                    class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                            </label>
                            <label for="hs-valid-toggle-switch5" class="text-gray-800 dark:text-gray-100">
                                فقط کالا های موجود
                            </label>
                        </div>
                        <!-- TOGGLE SWITCH -->
                        <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4"
                            dir="ltr">
                            <label for="hs-valid-toggle-switch6"
                                class="relative inline-block h-6 cursor-pointer w-11">
                                <input type="checkbox" id="hs-valid-toggle-switch6" class="sr-only peer">
                                <span
                                    class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                <span
                                    class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                            </label>
                            <label for="hs-valid-toggle-switch6"
                                class="flex items-center text-gray-800 dark:text-gray-100 gap-x-2">
                                <img class="size-5" src="./images/svg/time.png" alt="">
                                ارسال امروز
                            </label>
                        </div>
                        <!-- Accordion -->
                        <div class="">
                            <button onclick="toggleAccordion(4)"
                                class="flex items-center justify-between w-full px-2 py-4 text-gray-800 xl:px-4 dark:text-gray-100">
                                <span>محدوده قیمت</span>
                                <span id="icon-1" class="text-gray-800 dark:text-gray-100">
                                    <svg class="transition-transform duration-300 size-4">
                                        <use href="#chevron-left"></use>
                                    </svg>
                                </span>
                            </button>
                            <div id="content-4"
                                class="overflow-hidden transition-all duration-300 ease-in-out price-slider max-h-0">
                                <div class="w-full px-4 pb-3 text-gray-700 dark:text-gray-300">
                                    <div class="mt-5 wrapper">
                                        <div class="slider-bar">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <input type="range" min="0" max="100000" value="0"
                                                class="min-range" />
                                            <input type="range" min="0" max="100000" value="35000"
                                                class="max-range" />
                                        </div>
                                        <div class="mt-4 text-gray-800 price-input dark:text-gray-500">
                                            <div class="justify-start field">
                                                <span class="mr-2 text-sm font-DanaMedium">تومان</span>
                                                <p class="min-input">0</p>
                                            </div>
                                            <div class="justify-end field">
                                                <span class="mr-2 text-sm font-DanaMedium">تومان</span>
                                                <p class="max-input">350,000</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- TOGGLE SWITCH -->
                        <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4"
                            dir="ltr">
                            <label for="hs-valid-toggle-switch7"
                                class="relative inline-block h-6 cursor-pointer w-11">
                                <input type="checkbox" id="hs-valid-toggle-switch7" class="sr-only peer">
                                <span
                                    class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                <span
                                    class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                            </label>
                            <label for="hs-valid-toggle-switch7"
                                class="flex items-center text-gray-800 dark:text-gray-100 gap-x-2">
                                <img class="size-5" src="./images/svg/Seller.svg" alt="">
                                ارسال فروشنده
                            </label>
                        </div>
                        <!-- TOGGLE SWITCH -->
                        <div class="flex items-center justify-between w-full px-2 py-4 gap-x-3 xl:px-4"
                            dir="ltr">
                            <label for="hs-valid-toggle-switch8"
                                class="relative inline-block h-6 cursor-pointer w-11">
                                <input type="checkbox" id="hs-valid-toggle-switch8" class="sr-only peer">
                                <span
                                    class="absolute inset-0 transition-colors duration-200 ease-in-out bg-gray-200 rounded-full peer-checked:bg-blue-500 dark:bg-neutral-700 dark:peer-checked:bg-blue-500 peer-disabled:opacity-50 peer-disabled:pointer-events-none"></span>
                                <span
                                    class="absolute top-1/2 start-0.5 -translate-y-1/2 size-5 bg-white rounded-full shadow-xs transition-transform duration-200 ease-in-out peer-checked:translate-x-full dark:bg-neutral-400 dark:peer-checked:bg-white"></span>
                            </label>
                            <label for="hs-valid-toggle-switch8"
                                class="flex items-center text-gray-800 dark:text-gray-100 gap-x-1">
                                <img class="size-5" src="./images/svg/shop.png" alt="">
                                خرید حضوری در تهران
                            </label>
                        </div>
                    </div>
                </div>
                <span class="text-sm text-gray-400 ms-auto py-1.5 px-4">۱3,۰۴۰ کالا </span>
            </div>
            <!-- TOP FILTER BOX -->
            <div class="items-center justify-between hidden mb-6 lg:flex">
                <div class="flex items-center gap-x-5">
                    <div class="flex items-center gap-x-2">
                        <svg class="text-gray-400 size-6">
                            <use href="#sort-list"></use>
                        </svg>
                        <h2 class="text-gray-400 font-DanaDemiBold">مرتب سازی :</h2>
                    </div>
                    <ul
                        class="flex items-center gap-x-1 lg:gap-x-4 child:transition-all child:cursor-pointer child:rounded-lg child:px-1 child:py-1 child:text-sm child:lg:text-base">

                        <li wire:click="orderBy('all')"
                            class="{{ $this->order === 'all' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            همه
                        </li>

                        <li wire:click="orderBy('popular')"
                            class="{{ $this->order === 'popular' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            محبوب‌ترین
                        </li>

                        <li wire:click="orderBy('bestSeller')"
                            class="{{ $this->order === 'bestSeller' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            پرفروش‌ترین
                        </li>

                        <li wire:click="orderBy('cheaper')"
                            class="{{ $this->order === 'cheaper' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            ارزان‌ترین
                        </li>

                        <li wire:click="orderBy('mostExpensive')"
                            class="{{ $this->order === 'mostExpensive' ? 'text-blue-500' : 'text-gray-400 hover:text-blue-500' }}">
                            گران‌ترین
                        </li>
                    </ul>

                </div>
                <span class="text-sm text-gray-400 end">{{ $products->count() }} کالا</span>
            </div>
            <!-- PRODUCTS -->
            <div
                class="grid grid-cols-1 gap-3 xxs:grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 xs:gap-2 sm:gap-4">
                <!-- PRODUCT ITEM -->
                @foreach ($products as $product)
                    @if ($product->count > 0 && $product->count >= $product->max_sell && $product->max_sell > 0)
                        <div class="swiper-slide product-card group">
                            <!-- product header -->
                            <div class="product-card_header">
                                <div class="flex items-center gap-x-2">
                                    <div class="tooltip" wire:click="addToCart({{ $product->id }})">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#shopping-cart"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            سبد خرید
                                        </div>
                                    </div>
                                    <div class="tooltip" wire:click="addToFavorite({{ $product->id }})">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#heart"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            علاقه مندی
                                        </div>
                                    </div>
                                    <div class="tooltip">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#arrows-up-down"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            مقایسه
                                        </div>
                                    </div>
                                </div>
                                <!-- badge offer -->
                                @if ($product->discount)
                                    <span class="product-card_badge">{{ $product->discount }}% تخفیف‌</span>
                                @endif
                            </div>
                            <!-- product img -->
                            <a href="{{ route('product.details', $product->slug) }}">
                                <img class="absolute product-card_img group-hover:opacity-0"
                                    src="{{ asset('images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                                <img class="opacity-0 product-card_img group-hover:opacity-100"
                                    src="{{ asset('images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                            </a>
                            <!--  product footer -->
                            <div class="space-y-2">
                                <a href="{{ route('product.details', $product->slug) }}" class="product-card_link">
                                    {{ $product->name }}
                                </a>
                                <!-- Rate and Price -->
                                <div class="product-card_price-wrapper">
                                    <!-- RATE -->
                                    <div class="product-card_rate">
                                        <span class="flex items-center gap-x-0.5">
                                            <svg class="size-4 text-blue-500 mb-0.5">
                                                <use href="#rocket"></use>
                                            </svg>
                                            <p class="text-xs">ارسال امروز</p>
                                        </span>
                                        <span class="text-gray-400 flex items-center text-sm gap-x-0.5">
                                            <p> 5.0 </p>
                                            <svg class="mb-1 size-4">
                                                <use href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <!-- Price -->
                                    <div class="mt-5 product-card_price">
                                        @if ($product->discount)
                                            <del>{{ number_format($product->price) }}<h6>تومان</h6></del>
                                            <p>{{ number_format($product->price - ($product->price * $product->discount) / 100) }}
                                            </p>
                                            <span>تومان</span>
                                        @else
                                            <p>{{ number_format($product->price) }}
                                            <h6>تومان</h6>
                                            </p>
                                        @endif

                                    </div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="swiper-slide product-card group">
                            <!-- product header -->
                            <div class="product-card_header">
                                <div class="flex items-center gap-x-2">
                                    <div class="tooltip">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#shopping-cart"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            سبد خرید
                                        </div>
                                    </div>
                                    <div class="tooltip" wire:click="addToFavorite({{ $product->id }})">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#heart"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            علاقه مندی
                                        </div>
                                    </div>
                                    <div class="tooltip">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#arrows-up-down"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            مقایسه
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- product img -->
                            <a href="{{ route('product.details', $product->slug) }}">
                                <img class="absolute product-card_img group-hover:opacity-0"
                                    src="{{ asset('images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                                <img class="opacity-0 product-card_img group-hover:opacity-100"
                                    src="{{ asset('images/products/' . $product->image) }}"
                                    alt="{{ $product->name }}">
                            </a>
                            <!--  product footer -->
                            <div class="space-y-2">
                                <a href="{{ route('product.details', $product->slug) }}" class="product-card_link">
                                    {{ $product->name }}
                                </a>
                                <!-- Rate and Price -->
                                <div class="product-card_price-wrapper">
                                    <!-- RATE -->
                                    <div class="product-card_rate">
                                        <span class="flex items-center gap-x-0.5">
                                            <svg class="size-4 text-blue-500 mb-0.5">
                                                <use href="#rocket"></use>
                                            </svg>
                                            <p class="text-xs">ارسال امروز</p>
                                        </span>
                                        <span class="text-gray-400 flex items-center text-sm gap-x-0.5">
                                            <p> 5.0 </p>
                                            <svg class="mb-1 size-4">
                                                <use href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <!-- Price -->
                                    <div
                                        class="inline-flex items-center gap-1.5 px-3 py-1.5 bg-red-100 text-gray-500 
                                        text-xs font-medium rounded-full">
                                        <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5H9v2h2zm0 2H9v4h2v-4z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        نا موجود
                                    </div>

                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach


            </div>
            <!-- PAGINATION -->

            {{ $products->links('frontend.layouts.front_pagination') }}

        </div>
    </div>
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