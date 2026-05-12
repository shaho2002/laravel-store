<main class="relative">

    <!-- Slider -->
    <div class="w-full px-3 mt-4 lg:container group lg:mt-10">
        <div dir="rtl" class="cursor-pointer swiper header-slider h-52 md:h-96">
            <div class="swiper-wrapper">
                @foreach ($this->slides as $slide )
                    <a href="{{ $slide->link }}" class="swiper-slide">
                    <img src="{{ url('images/slides/' . $slide->image) }}" class="rounded-xl" alt="{{ $slide->name }}">
                </a>
                @endforeach

            </div>
            <div class="swiper-pagination-wrapper">
                <div class="swiper-pagination"></div>
            </div>

            <!-- Swiper Navigation -->
            <div
                class="absolute z-10 items-center invisible hidden transition-all duration-300 opacity-0 bottom-5 group-hover:opacity-100 group-hover:visible right-6 lg:flex gap-x-2 child:flex-center child:w-9 child:h-9 child:cursor-pointer child:bg-white child:dark:bg-gray-800 child:text-gray-700 child:dark:text-gray-200 child:rounded-full child:shadow child-hover:text-blue-600 child-hover:dark:text-blue-500">
                <button class="button-prev">
                    <svg class="-rotate-90 size-5">
                        <use href="#chevron" />
                    </svg>
                </button>
                <button class="button-next">
                    <svg class="rotate-90 size-5">
                        <use href="#chevron" />
                    </svg>
                </button>
            </div>

        </div>
    </div>
    <!-- CATEGORY -->
    <section class="mx-4 mt-20 lg:container">
        <!-- SECTION TITLE -->
        <div class="flex flex-col items-center justify-between w-full text-center gap-y-4 xs:flex-row xs:text-start">
            <div class="flex items-center gap-x-2 sm:gap-x-4">
                <span class="hidden bg-white rounded-lg shadow-lg size-12 xs:flex dark:bg-gray-800 flex-center">
                    <svg class="text-gray-700 size-7 dark:text-gray-100">
                        <use href="#squares"></use>
                    </svg>
                </span>

                <div class="space-y-1 md:space-y-1">
                    <h3 class="text-xl text-gray-800 md:text-2xl font-MorabbaMedium dark:text-gray-50">دسـته بندی
                        هـای
                        <span class="text-blue-600 dark:text-blue-500">محبوب</span>
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-300">جدیدترین و بروزترین دسته بندی ها</p>
                </div>
            </div>
            <div class="flex items-center justify-center w-full xs:w-auto gap-x-2">
                <a href="shop.html"
                    class="group shadow-xl text-sm md:text-base flex gap-x-1.5 items-center px-2 h-10 md:px-3 text-white bg-blue-600 rounded-xl">
                    <p>مشاهده همه</p>
                    <span
                        class="transition-transform duration-300 bg-blue-500 rounded-full w-7 h-7 flex-center md:group-hover:-translate-x-1">
                        <svg class="size-5">
                            <use href="#arrow" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        <!-- ITEMS -->
        <div
            class="flex flex-wrap items-center mt-12 justify-evenly child:mb-8 gap-x-8 child:items-center child:flex-col child:duration-300 child:cursor-pointer child:gap-y-1 child:text-gray-800 child:dark:text-gray-300 child:relative">
            @foreach ($this->categories as $category)
                <a href="shop.html" class="flex group">
                    <img src="{{ url('images/categories/' . $category->image) }}"
                        class="w-[100px] h-[100px] lg:w-[120px] lg:h-[120px] object-cover group-hover:grayscale group-hover:opacity-90 duration-300"
                        alt="{{ $category->name }}" />
                    <p class="pt-1 text-sm lg:text-lg line-clamp-1">
                        {{ $category->name }}
                    </p>
                </a>
            @endforeach

        </div>
    </section>
    <!-- Latest products -->
    <section class="mx-4 mt-10 lg:container lg:mt-20">
        <!-- SECTION TITLE -->
        <div class="flex flex-col items-center justify-between w-full text-center gap-y-4 xs:flex-row xs:text-start">
            <div class="flex items-center gap-x-2 sm:gap-x-4">
                <span class="hidden bg-white rounded-lg shadow-lg size-12 xs:flex dark:bg-gray-800 flex-center">
                    <svg class="text-gray-700 size-7 dark:text-gray-100">
                        <use href="#mobile"></use>
                    </svg>
                </span>
                <div class="space-y-1 md:space-y-1">
                    <h3 class="text-xl text-gray-800 md:text-2xl font-MorabbaMedium dark:text-gray-50">جدید ترین
                        <span class="text-blue-600 dark:text-blue-500">محصولات</span>
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-300">جدیدترین و بروزترین محصولات</p>
                </div>
            </div>
            <div class="flex items-center justify-between w-full xs:w-auto xs:justify-end gap-x-2">
                <div class="flex items-center gap-x-2">
                    <button class="slider-navigate_btn LatestProducts-prev-slide">
                        <svg class="-rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                    <button class="slider-navigate_btn LatestProducts-next-slide">
                        <svg class="rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                </div>
                <a href="shop.html"
                    class="group shadow-xl text-sm md:text-base flex gap-x-1.5 items-center px-2 h-10 md:px-3 text-white bg-blue-600 rounded-xl">
                    <p>مشاهده همه</p>
                    <span
                        class="transition-transform duration-300 bg-blue-500 rounded-full w-7 h-7 flex-center md:group-hover:-translate-x-1">
                        <svg class="size-5">
                            <use href="#arrow" />
                        </svg>
                    </span>
                </a>
            </div>

        </div>
        <!-- Latest products Slider -->
        <div class="w-full mt-5 swiper LatestProducts" wire:ignore>
            <div class="py-5 swiper-wrapper">
                <!-- PRODUCT ITEM -->
                @foreach ($this->newestProducts as $newestProduct)
                    @if ($newestProduct->count > 0 && $newestProduct->count >= $newestProduct->max_sell && $newestProduct->max_sell > 0)
                        <div class="swiper-slide product-card group">
                            <!-- product header -->
                            <div class="product-card_header">
                                <div class="flex items-center gap-x-2">
                                    <div class="tooltip" wire:click="addToCart({{ $newestProduct->id }})">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#shopping-cart"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            سبد خرید
                                        </div>
                                    </div>
                                    <div class="tooltip" wire:click="addToFavorite({{ $newestProduct->id }})">
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
                                @if ($newestProduct->discount)
                                    <span class="product-card_badge">{{ $newestProduct->discount }}% تخفیف‌</span>
                                @endif
                            </div>
                            <!-- product img -->
                            <a href="{{ route('product.details', $newestProduct->slug) }}">
                                <img class="absolute product-card_img group-hover:opacity-0"
                                    src="{{ asset('images/products/' . $newestProduct->image) }}"
                                    alt="{{ $newestProduct->name }}">
                                <img class="opacity-0 product-card_img group-hover:opacity-100"
                                    src="{{ asset('images/products/' . $newestProduct->image) }}"
                                    alt="{{ $newestProduct->name }}">
                            </a>
                            <!--  product footer -->
                            <div class="space-y-2">
                                <a href="{{ route('product.details', $newestProduct->slug) }}"
                                    class="product-card_link">
                                    {{ $newestProduct->name }}
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
                                        @if ($newestProduct->discount)
                                            <del>{{ number_format($newestProduct->price) }}<h6>تومان</h6></del>
                                            <p>{{ number_format($newestProduct->price - ($newestProduct->price * $newestProduct->discount) / 100) }}
                                            </p>
                                            <span>تومان</span>
                                        @else
                                            <p>{{ number_format($newestProduct->price) }}
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
                                    <div class="tooltip" wire:click="addToFavorite({{ $newestProduct->id }})">
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
                            <a href="{{ route('product.details', $newestProduct->slug) }}">
                                <img class="absolute product-card_img group-hover:opacity-0"
                                    src="{{ asset('images/products/' . $newestProduct->image) }}"
                                    alt="{{ $newestProduct->name }}">
                                <img class="opacity-0 product-card_img group-hover:opacity-100"
                                    src="{{ asset('images/products/' . $newestProduct->image) }}"
                                    alt="{{ $newestProduct->name }}">
                            </a>
                            <!--  product footer -->
                            <div class="space-y-2">
                                <a href="{{ route('product.details', $newestProduct->slug) }}"
                                    class="product-card_link">
                                    {{ $newestProduct->name }}
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
        </div>
    </section>

    <!-- BANNER -->
    <section
        class="flex flex-col items-center gap-5 mx-4 mt-10 lg:container lg:mt-20 lg:flex-row child:rounded-xl child:overflow-hidden">
        <a href="shop.html" class="group">
            <img src="{{ url('frontend/images/banner/1.webp') }}"
                class="transition-transform duration-300 group-hover:scale-105" alt="">
        </a>
        <a href="shop.html" class="group">
            <img src="{{ url('frontend/images/banner/2.webp') }}"
                class="transition-transform duration-300 group-hover:scale-105" alt="">
        </a>

    </section>

    <!-- Best-selling products -->
    <section class="mx-4 mt-10 lg:container lg:mt-20">
        <!-- SECTION TITLE -->
        <div class="flex flex-col items-center justify-between w-full text-center gap-y-4 xs:flex-row xs:text-start">
            <div class="flex items-center gap-x-2 sm:gap-x-4">
                <span class="hidden bg-white rounded-lg shadow-lg size-12 xs:flex dark:bg-gray-800 flex-center">
                    <svg class="text-gray-700 size-7 dark:text-gray-100">
                        <use href="#mobile"></use>
                    </svg>
                </span>
                <div class="space-y-1 md:space-y-1">
                    <h3 class="text-xl text-gray-800 md:text-2xl font-MorabbaMedium dark:text-gray-50">محصولات
                        <span class="text-blue-600 dark:text-blue-500">پرفروش </span>
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-300">جدیدترین و بروزترین محصولات</p>
                </div>
            </div>
            <div class="flex items-center justify-between w-full xs:w-auto xs:justify-end gap-x-2">
                <div class="flex items-center gap-x-2">
                    <button class="slider-navigate_btn BestSelling-prev-slide">
                        <svg class="-rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                    <button class="slider-navigate_btn BestSelling-next-slide">
                        <svg class="rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                </div>
                <a href="index.html"
                    class="group shadow-xl text-sm md:text-base flex gap-x-1.5 items-center px-2 h-10 md:px-3 text-white bg-blue-600 rounded-xl">
                    <p>مشاهده همه</p>
                    <span
                        class="transition-transform duration-300 bg-blue-500 rounded-full w-7 h-7 flex-center md:group-hover:-translate-x-1">
                        <svg class="size-5">
                            <use href="#arrow" />
                        </svg>
                    </span>
                </a>
            </div>

        </div>
        <!-- Latest products Slider -->
        <div class="w-full mt-5 swiper BestSelling" wire:ignore>
            <div class="py-5 swiper-wrapper">
                <!-- PRODUCT ITEM -->
                @foreach ($this->bestSellerProducts as $bestSellerProduct)
                    @if (
                        $bestSellerProduct->count > 0 &&
                            $bestSellerProduct->count >= $bestSellerProduct->max_sell &&
                            $bestSellerProduct->max_sell > 0)
                        <div class="swiper-slide product-card group">
                            <!-- product header -->
                            <div class="product-card_header">
                                <div class="flex items-center gap-x-2">
                                    <div class="tooltip" wire:click="addToCart({{ $bestSellerProduct->id }})">
                                        <button class="rounded-full p-1.5 app-border app-hover">
                                            <svg class="size-4">
                                                <use href="#shopping-cart"></use>
                                            </svg>
                                        </button>
                                        <div class="tooltiptext">
                                            سبد خرید
                                        </div>
                                    </div>
                                    <div class="tooltip" wire:click="addToFavorite({{ $bestSellerProduct->id }})">
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
                                @if ($bestSellerProduct->discount)
                                    <span class="product-card_badge">{{ $newestProduct->discount }}% تخفیف‌</span>
                                @endif
                            </div>
                            <!-- product img -->
                            <a href="{{ route('product.details', $bestSellerProduct->slug) }}">
                                <img class="absolute product-card_img group-hover:opacity-0"
                                    src="{{ asset('images/products/' . $bestSellerProduct->image) }}"
                                    alt="{{ $bestSellerProduct->name }}">
                                <img class="opacity-0 product-card_img group-hover:opacity-100"
                                    src="{{ asset('images/products/' . $bestSellerProduct->image) }}"
                                    alt="{{ $bestSellerProduct->name }}">
                            </a>
                            <!--  product footer -->
                            <div class="space-y-2">
                                <a href="{{ route('product.details', $bestSellerProduct->slug) }}"
                                    class="product-card_link">
                                    {{ $bestSellerProduct->name }}
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
                                        @if ($bestSellerProduct->discount)
                                            <del>{{ number_format($bestSellerProduct->price) }}<h6>تومان</h6></del>
                                            <p>{{ number_format($bestSellerProduct->price - ($bestSellerProduct->price * $bestSellerProduct->discount) / 100) }}
                                            </p>
                                            <span>تومان</span>
                                        @else
                                            <p>{{ number_format($bestSellerProduct->price) }}
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
                                    <div class="tooltip" wire:click="addToFavorite({{ $bestSellerProduct->id }})">
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
                            <a href="{{ route('product.details', $bestSellerProduct->slug) }}">
                                <img class="absolute product-card_img group-hover:opacity-0"
                                    src="{{ asset('images/products/' . $bestSellerProduct->image) }}"
                                    alt="{{ $bestSellerProduct->name }}">
                                <img class="opacity-0 product-card_img group-hover:opacity-100"
                                    src="{{ asset('images/products/' . $bestSellerProduct->image) }}"
                                    alt="{{ $bestSellerProduct->name }}">
                            </a>
                            <!--  product footer -->
                            <div class="space-y-2">
                                <a href="{{ route('product.details', $bestSellerProduct->slug) }}"
                                    class="product-card_link">
                                    {{ $bestSellerProduct->name }}
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
        </div>
    </section>

    <!-- BRAND -->
    <section class="mx-4 mt-10 lg:container lg:mt-20">
        <!-- SECTION TITLE -->
        <div class="flex flex-col items-center justify-between w-full text-center gap-y-4 xs:flex-row xs:text-start">
            <div class="flex items-center gap-x-2 sm:gap-x-4">
                <span class="hidden bg-white rounded-lg shadow-lg size-12 xs:flex dark:bg-gray-800 flex-center">
                    <svg class="text-gray-700 size-7 dark:text-gray-100">
                        <use href="#check-badge"></use>
                    </svg>
                </span>
                <div class="space-y-1 md:space-y-1">
                    <h3 class="text-xl text-gray-800 md:text-2xl font-MorabbaMedium dark:text-gray-50">محبوب‌ترین
                        <span class="text-blue-600 dark:text-blue-500">برندها</span>
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-300">جدیدترین و بروزترین برندها</p>
                </div>
            </div>
            <div class="flex items-center justify-between w-full xs:w-auto xs:justify-end gap-x-2">
                <div class="flex items-center gap-x-2">
                    <button class="slider-navigate_btn brand-prev-slide">
                        <svg class="-rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                    <button class="slider-navigate_btn brand-next-slide">
                        <svg class="rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                </div>
                <a href="shop.html"
                    class="group shadow-xl text-sm md:text-base flex gap-x-1.5 items-center px-2 h-10 md:px-3 text-white bg-blue-600 rounded-xl">
                    <p>مشاهده همه</p>
                    <span
                        class="transition-transform duration-300 bg-blue-500 rounded-full w-7 h-7 flex-center md:group-hover:-translate-x-1">
                        <svg class="size-5">
                            <use href="#arrow" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        <!-- BRAND Slider -->
        <div class="w-full mt-5 swiper BrandSlider" wire:ignore>
            <div class="w-full py-5 swiper-wrapper">
                <!-- PRODUCT ITEM -->
                @foreach ($this->brands as $brand)
                    <div class="swiper-slide brand-card group">
                        <img src="{{ asset('images/brands/' . $brand->image) }}" alt="{{ $brand->name }}">
                    </div>
                @endforeach
            </div>
        </div>
    </section>


    <!-- ARTICLE -->
    <section class="mx-4 mt-10 lg:container lg:mt-20">
        <!-- SECTION TITLE -->
        <div class="flex flex-col items-center justify-between w-full text-center gap-y-4 xs:flex-row xs:text-start">
            <div class="flex items-center gap-x-2 sm:gap-x-4">
                <span class="hidden bg-white rounded-lg shadow-lg size-12 xs:flex dark:bg-gray-800 flex-center">
                    <svg class="text-gray-700 size-7 dark:text-gray-100">
                        <use href="#check-badge"></use>
                    </svg>
                </span>
                <div class="space-y-1 md:space-y-1">
                    <h3 class="text-xl text-gray-800 md:text-2xl font-MorabbaMedium dark:text-gray-50">محبوب‌ترین
                        <span class="text-blue-600 dark:text-blue-500">مقالات</span>
                    </h3>
                    <p class="text-sm text-gray-500 dark:text-gray-300">جدیدترین و بروزترین مقالات</p>
                </div>
            </div>
            <div class="flex items-center justify-between w-full xs:w-auto xs:justify-end gap-x-2">
                <div class="flex items-center gap-x-2">
                    <button class="slider-navigate_btn articleSlider-prev-slide">
                        <svg class="-rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                    <button class="slider-navigate_btn articleSlider-next-slide">
                        <svg class="rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                </div>
                <a href="articles.html"
                    class="group shadow-xl text-sm md:text-base flex gap-x-1.5 items-center px-2 h-10 md:px-3 text-white bg-blue-600 rounded-xl">
                    <p>مشاهده همه</p>
                    <span
                        class="transition-transform duration-300 bg-blue-500 rounded-full w-7 h-7 flex-center md:group-hover:-translate-x-1">
                        <svg class="size-5">
                            <use href="#arrow" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        <div class="w-full mt-5 swiper articleSlider">
            <div class="w-full py-5 swiper-wrapper">
                <!-- ITEM -->
                @foreach ($this->articles as $article)
                    <div class="swiper-slide group article-box">
                        <div class="relative overflow-hidden rounded-lg">
                            <img src="{{ asset('images/articles/'.$article->image) }}" class="article-box_img" alt="{{ $article->title }}" />
                            <div
                                class="absolute top-0 bottom-0 left-0 right-0 flex items-center justify-center transition-all duration-300 opacity-0 bg-black/60 group-hover:opacity-100 rounded-bl-3xl rounded-tr-3xl">
                                <a href="{{ route('article', $article->slug) }}"
                                    class="flex items-center px-2 py-1 text-white border-2 border-white rounded-lg gap-x-1 font-DanaMedium">
                                    <p>ادامه مطالب</p>
                                    <svg class="w-4 h-4 rotate-90">
                                        <use href="#chevron"></use>
                                    </svg>
                                </a>
                            </div>
                        </div>
                        <div class="flex flex-col px-1 py-5 gap-y-1">
                            <h2 class="font-DanaDemiBold">{{ $article->title }}</h2>
                        </div>
                        <span class="flex w-full h-1 py-1 border-t border-gray-100 dark:border-white/10"></span>
                        <div class="flex items-center justify-between px-1 text-sm">
                            <span class="flex items-center text-blue-500 gap-x-1 dark:text-sky-400">
                                <svg class="w-4 h-4">
                                    <use href="#calendar"></use>
                                </svg>
                                <p class="mt-1">{{ Hekmatinasser\Verta\Verta::instance($article->created_at)->formatJalaliDate() }}</p>
                            </span>
                            <span class="flex items-start text-gray-300 gap-x-1">
                                <p class="font-DanaDemiBold">120</p>
                                <svg class="w-4 h-4">
                                    <use href="#eye"></use>
                                </svg>
                            </span>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <!-- Features -->
    <div
        class="container flex flex-wrap items-center justify-center w-full gap-6 mt-10 lg:mt-20 md:justify-between child:text-sm child:gap-y-1 child:cursor-pointer">
        <!-- item -->
        <span class="flex-col items-center justify-center hidden md:flex">
            <img class="w-14 h-14" src="{{ url('frontend/images/svg/1.svg ') }}" alt="">
            <p class="text-gray-500 dark:text-gray-300">امکان تحویل اکسپرس</p>
        </span>
        <span class="{{ url('flex flex-col items-center justify-center') }}">
            <img class="w-14 h-14" src="frontend/images/svg/2.svg" alt="">
            <p class="text-gray-500 dark:text-gray-300">ضمانت اصل بودن کالا</p>
        </span>
        <span class="flex flex-col items-center justify-center">
            <img class="w-14 h-14" src="{{ url('frontend/images/svg/3.svg') }}" alt="">
            <p class="text-gray-500 dark:text-gray-300">ضمانت بازگشت کالا</p>
        </span>
        <span class="flex flex-col items-center justify-center">
            <img class="w-14 h-14" src="{{ url('frontend/images/svg/4.svg') }}" alt="">
            <p class="text-gray-500 dark:text-gray-300">پشتیبانی 24 ساعته</p>
        </span>
        <span class="flex flex-col items-center justify-center">
            <img class="w-14 h-14" src="{{ url('frontend/images/svg/5.svg') }}" alt="">
            <p class="text-gray-500 dark:text-gray-300">امکان پرداخت در محل</p>
        </span>
    </div>
</main>
<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('sweetAlert', (data) => {
            const alertMessage = data['message']
            const alertType = data['type']
            const alertTitle = data['title']
            showAlert(alertMessage, alertType, alertTitle);
        });
    });
</script>
