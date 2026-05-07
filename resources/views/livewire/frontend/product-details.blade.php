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
                <button wire:click="set_category_id( {{ $this->product->category->id }})"
                    class="inline-flex items-center text-sm text-gray-700 gap-x-1 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                    {{ $this->product->category->name }}
                </button>
            </li>
            <li aria-current="page">
                <div class="flex items-center">
                    <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                        xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="m1 9 4-4-4-4" />
                    </svg>
                    <span class="text-sm text-gray-500 ms-1 md:ms-2 dark:text-gray-400">جزییات محصول</span>
                </div>
            </li>
        </ol>
    </nav>
    <!-- PRODUCT DETAILS SECTION -->
    <section
        class="flex flex-col items-start gap-4 mt-5 lg:flex-row child:rounded-lg child:bg-white child:dark:bg-gray-800 child:shadow child:p-4">
        <!-- IMAGE & INFO BOX Container -->
        <div class="w-full lg:w-3/4">
            <div class="flex flex-col items-start justify-start md:flex-row gap-x-8 xl:gap-x-2">
                <!-- IMAGE SLIDER -->
                <div class="flex-col items-center justify-center hidden w-2/4 md:flex gap-y-4">
                    <span class="open-sliderModal">
                        <img src="{{ url('images/products/' . $this->product->image) }}"
                            class="object-cover cursor-pointer" alt="">
                    </span>
                    <div
                        class="grid grid-cols-12 child:col-span-3 child:app-border gap-x-4 child:size-16 child:rounded-lg child:cursor-pointer">
                        @foreach ($this->product->ProductGallery as $gallery)
                            @if ($loop->last)
                                <div class="relative overflow-hidden open-sliderModal">
                                    <svg class="absolute z-10 text-gray-100 size-8 top-4 left-4">
                                        <use href="#ellipsis"></use>
                                    </svg>
                                    <img src="{{ url('images/gallery/' . $gallery->name) }}"
                                        class="object-cover rounded-lg blur-sm">
                                </div>
                            @else
                                <div class="p-1 open-sliderModal">
                                    <img src="{{ url('images/gallery/' . $gallery->name) }}"
                                        class="object-cover rounded-lg">
                                </div>
                            @endif
                        @endforeach

                    </div>
                </div>
                <div class="slider-modal" wire:ignore>
                    <div class="flex items-center justify-between w-full h-fit">
                        <h1 class="text-lg font-DanaMedium">
                            تصاویر گوشی موبایل اپل مدل iPhone 16 دو سیم کارت
                        </h1>
                        <svg class="cursor-pointer size-6 close-sliderModal">
                            <use href="#x-mark"></use>
                        </svg>
                    </div>

                    <div class="relative px-10 swiper ProductDetailsSlider mt-14 w-96">
                        <div class="swiper-wrapper w-[50%] child:w-full child:rounded-lg child:overflow-hidden">
                            <div class="swiper-slide">
                                <img src="{{ url('images/products/' . $this->product->image) }}" alt="">
                            </div>
                            @foreach ($this->product->ProductGallery as $gallery)
                                <div class="swiper-slide">
                                    <img src="{{ url('images/gallery/' . $gallery->name) }}" alt="">
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button
                        class="slider-navigate_btn absolute right-40 top-[17rem] border dark:border-gray-700 border-gray-200 button-prev-ProductDetailsSlider z-20">
                        <svg class="-rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                    <button
                        class="slider-navigate_btn absolute left-40 top-[17rem] border dark:border-gray-700 border-gray-200 button-next-ProductDetailsSlider z-10">
                        <svg class="rotate-90 size-6">
                            <use href="#chevron" />
                        </svg>
                    </button>
                </div>
                <!-- INFOS -->
                <div class="flex flex-col w-full md:w-3/4 gap-y-7">
                    <div class="flex items-center justify-between">
                        <a href="shop.html" class="font-DanaMedium text-sky-400">{{ $this->product->category->name }}
                            /{{ $this->product->name }}</a>
                        <div class="items-center hidden md:flex gap-x-2">
                            <div class="tooltip">
                                <button class="rounded-full p-1.5 app-border app-hover">
                                    <svg class="size-4 md:size-5">
                                        <use href="#share"></use>
                                    </svg>
                                </button>
                                <div class="tooltiptext">
                                    اشتراک‌گذازی
                                </div>
                            </div>
                            <div class="tooltip" wire:click="addToFavorite({{ $this->product->id }})">
                                <button class="rounded-full p-1.5 app-border app-hover">
                                    <svg class="size-4 md:size-5">
                                        <use href="#heart"></use>
                                    </svg>
                                </button>
                                <div class="tooltiptext">
                                    علاقه مندی
                                </div>
                            </div>
                            <div class="tooltip">
                                <button class="rounded-full p-1.5 app-border app-hover">
                                    <svg class="size-4 md:size-5">
                                        <use href="#arrows-up-down"></use>
                                    </svg>
                                </button>
                                <div class="tooltiptext">
                                    مقایسه
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- MOBILE SLIDER -->
                    <div class="flex md:hidden">
                        <div class="w-full swiper MobileProductSlider">
                            <div class="w-full swiper-wrapper child:w-full child:overflow-hidden child:rounded-lg">
                                <div class="swiper-slide">
                                    <img src="{{ url('images/products/' . $this->product->image) }}" alt="">
                                </div>
                                @foreach ($this->product->ProductGallery as $gallery)
                                    <div class="swiper-slide">
                                        <img src="{{ url('images/gallery/' . $gallery->name) }}" alt="">
                                    </div>
                                @endforeach

                            </div>
                            <div class="swiper-pagination MobileProductSlider-pagination"></div>
                        </div>
                    </div>

                    <div class="flex flex-col gap-y-3">
                        <p class="text-lg font-DanaDemiBold dark:text-gray-300">
                            {{ $this->product->name }}
                        </p>
                        <p class="text-sm text-gray-300 dark:text-gray-500">
                            {{ $this->product->e_name }}
                        </p>
                        <div class="flex items-center gap-x-2">
                            <span class="flex items-center text-sm gap-x-1">
                                <svg class="size-4 text-yellow-400 mb-1.5">
                                    <use href="#star"></use>
                                </svg>
                                4.4 <span class="text-gray-300 dark:text-gray-500">(امتیاز 849 خریدار)</span>
                            </span>

                            <span
                                class="flex items-center justify-center h-6 px-2 pt-1 text-xs text-gray-400 rounded-full bg-slate-100 dark:bg-slate-700 dark:text-gray-400 font-DanaMedium">
                                410 دیدگاه
                            </span>

                        </div>
                    </div>
                    <!-- COLOR -->
                    <div class="flex flex-col gap-y-4">
                        <h1 class="text-lg font-DanaDemiBold dark:text-gray-200"> رنگ :
                            {{ $selectedColor->name }}</h1>
                        <div class="flex items-center gap-x-3 child:rounded-full child:size-9 child:p-1">

                            @foreach ($this->product->colors as $color)
                                <button
                                    class="transition-all duration-300 ease-in-out color-select-btn ring-1 ring-gray-400"
                                    wire:click="selectColor('{{ $color->id }}')">
                                    <span class="flex w-full h-full rounded-full"
                                        style="background-color: {{ $color->code }};">
                                    </span>
                                </button>
                            @endforeach
                        </div>
                    </div>
                    <!-- Features Box  -->
                    <div class="flex flex-col w-full gap-y-4">
                        <h1 class="text-lg font-DanaDemiBold dark:text-gray-200">ویژگی‌ها</h1>
                        <div
                            class="grid grid-cols-12 gap-2 child:p-2 child:h-16 child:bg-gray-100 dark:child:bg-gray-900 child:rounded-lg child:flex child:flex-col child:gap-y-1.5">

                            @foreach ($product_infos as $product_info)
                                <div class="col-span-12 md:col-span-6 xl:col-span-4">
                                    <p class="text-sm text-gray-500">{{ $product_info->category_feature->name }}</p>
                                    <p
                                        class="text-sm line-clamp-1 font-DanaDemiBold text-slate-800 dark:text-slate-200">
                                        {{ $product_info->name }}</p>
                                </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
            <div
                class="grid grid-cols-12 mt-10 lg:mr-2 child:col-span-6 xl:child:col-span-3 gap-x-1 gap-y-2 lg:gap-4 child:border child:text-gray-400 child:dark:border-white/20 child:border-gray-200 child:rounded-lg child:h-12 child:p-2 child:flex child:items-center child:gap-x-1 lg:child:gap-x-2 child:text-sm lg:text-base">
                <span>
                    <svg class="w-4 h-4 lg:w-6 lg:h-6">
                        <use href="#arrow-path-rounded-square"></use>
                    </svg>
                    <p>ضمانت بازگشت کالا</p>
                </span>
                <span>
                    <svg class="w-4 h-4 lg:w-6 lg:h-6">
                        <use href="#check-badge"></use>
                    </svg>
                    <p>
                        تضمین اصالت کالا
                    </p>
                </span>
                <span>
                    <svg class="w-4 h-4 lg:w-6 lg:h-6">
                        <use href="#calender-day"></use>
                    </svg>
                    <p>پشتیبانی کل هفته</p>
                </span>
                <span>
                    <svg class="w-4 h-4 lg:w-6 lg:h-6">
                        <use href="#truke"></use>
                    </svg>
                    <p>ارسال به سراسر ایران </p>
                </span>
            </div>
        </div>
        <!-- PRICE & ADD TO CART BOX -->
        @if ($this->product->count > 0 && $this->product->count >= $this->product->max_sell && $this->product->max_sell > 0)
            <div class="flex flex-col w-full lg:w-1/4 lg:sticky top-5 gap-y-6">
                <!-- PRICE -->
                <div class="flex items-center gap-x-1">
                    <p class="text-2xl font-DanaDemiBold">{{ number_format($price) }}</p>
                    <p class="">تومان</p>
                </div>
                <button
                    class="flex items-center justify-between w-full px-3 py-2 border border-gray-200 rounded-lg gap-x-1 dark:border-white/20">
                    <svg class="w-6 h-6 text-green-600 " wire:click="plus">
                        <use href="#plus"></use>
                    </svg>
                    <input type="number" min="1" max="20"
                        class="mr-4 text-lg bg-transparent custom-input" wire:model="count">
                    <svg class="w-6 h-6 text-red-500 " wire:click="minus">
                        <use href="#minus"></use>
                    </svg>
                </button>

                <button
                    class="flex items-center justify-between w-full px-2 py-2 text-sm transition-all bg-gray-100 rounded-lg gap-x-1 dark:bg-gray-900 dark:text-gray-400 xl:px-3 font-DanaMedium xl:text-base">
                    <p>مجموع خرید :</p>
                    <p>{{ number_format($price * $this->count) }}</p>
                </button>

                <div class="relative overflow-hidden text-sm text-right font-DanaDemiBold">
                    <div id="slider-text" class="transition-all duration-700 ease-in-out">
                        <p>🔥 ۱۰۰۰+ فروش در هفته گذشته</p>
                    </div>
                </div>
                <button
                    class="flex items-center justify-center w-full py-2 text-white transition-all bg-blue-500 rounded-lg shadow gap-x-1 hover:bg-blue-600"
                    wire:click="addToCart">
                    افزودن به سبد
                    <svg class="w-5 h-5">
                        <use href="#shopping-bag"></use>
                    </svg>
                </button> 

                <div class="flex text-sm text-gray-400 xl:items-center gap-x-1">
                    <svg class="w-5 h-5">
                        <use href="#info"></use>
                    </svg>
                    <p>ارسال رایگان برای خریدهای بالای 400 هزار تومان</p>
                </div>
            </div>
        @else
            <div class="flex flex-col w-full lg:w-1/4 lg:sticky top-5 gap-y-6">
                <!-- PRICE -->
                <div class="flex items-center gap-x-1">
                    <p class="text-2xl font-DanaDemiBold">ناموجود</p>
                </div>
                <div class="relative overflow-hidden text-sm text-right font-DanaDemiBold">
                    <div id="slider-text" class="transition-all duration-700 ease-in-out">
                        <p>🔥 ۱۰۰۰+ فروش در هفته گذشته</p>
                    </div>
                </div>
                <button
                    class="flex items-center justify-center w-full py-2 text-white transition-all bg-blue-500 rounded-lg shadow gap-x-1 hover:bg-blue-600">
                    درحال حاضر این کالا موجود نیست
                    <svg class="w-3.5 h-3.5" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11V5H9v2h2zm0 2H9v4h2v-4z"
                            clip-rule="evenodd"></path>
                    </svg>
                </button>

                <div class="flex text-sm text-gray-400 xl:items-center gap-x-1">
                    <svg class="w-5 h-5">
                        <use href="#info"></use>
                    </svg>
                    <p>ارسال رایگان برای خریدهای بالای 400 هزار تومان</p>
                </div>
            </div>
            </div>
        @endif


    </section>

    <!-- Best-selling products -->
    <section class="mx-4 mt-10 lg:mt-20">
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
                        <span class="text-blue-600 dark:text-blue-500">مرتبط</span>
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
                <a href="#"
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
                @foreach ($this->relatedProducts as $relatedProduct)
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
                                <div class="tooltip">
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
                            @if ($relatedProduct->discount)
                                <span class="product-card_badge">{{ $relatedProduct->discount }}% تخفیف‌</span>
                            @endif
                        </div>
                        <!-- product img -->
                        <a href="{{ route('product.details', $relatedProduct->slug) }}">
                            <img class="absolute product-card_img group-hover:opacity-0"
                                src="{{ asset('images/products/' . $relatedProduct->image) }}"
                                alt="{{ $relatedProduct->name }}">
                            <img class="opacity-0 product-card_img group-hover:opacity-100"
                                src="{{ asset('images/products/' . $relatedProduct->image) }}"
                                alt="{{ $relatedProduct->name }}">
                        </a>
                        <!--  product footer -->
                        <div class="space-y-2">
                            <a href="{{ route('product.details', $relatedProduct->slug) }}"
                                class="product-card_link">
                                {{ $relatedProduct->name }}
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
                                    @if ($relatedProduct->discount)
                                        <del>{{ number_format($relatedProduct->price) }}<h6>تومان</h6></del>
                                        <p>{{ number_format($relatedProduct->price - ($relatedProduct->price * $relatedProduct->discount) / 100) }}
                                        </p>
                                        <span>تومان</span>
                                    @else
                                        <p>{{ number_format($relatedProduct->price) }}
                                        <h6>تومان</h6>
                                        </p>
                                    @endif

                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </section>

    <section class="relative flex flex-col items-start gap-4 p-4 mt-10 bg-white rounded-lg shadow dark:bg-gray-800">
        <div
            class="z-10 flex items-center w-full py-3 border-b gap-x-6 child:font-DanaMedium tab-buttons border-gray-600/20 dark:border-b-gray-200/20">
            <button class="text-blue-500 tab-btn" data-target="tab1">معرفی محصول</button>
            <button class="text-gray-500 tab-btn dark:text-gray-300" data-target="tab2">مشخصات</button>
            <button class="text-gray-500 tab-btn dark:text-gray-300" data-target="tab3">دیدگاه‌ها</button>
        </div>
        <div class="block tab-content tab1">
            <h2 class="p-1 text-lg border-b-2 border-blue-500 font-DanaDemiBold w-fit">معرفی</h2>
            <p class="mt-4 leading-8">
                {{ $this->product->description }}
                <a href="#" class="flex items-center text-blue-400 gap-x-1">
                    مشاهده بیشتر
                    <svg class="size-4">
                        <use href="#chevron-left" />
                    </svg>
                </a>
            </p>
        </div>
        <div class="tab-content tab2 hidden w-full lg:w-[50%]">
            <h2 class="p-1 text-lg border-b-2 border-blue-500 font-DanaDemiBold w-fit">مشخصات کلی
            </h2>

            <div class="w-full p-4 mx-auto my-5">
                <ul class="divide-y divide-gray-200 dark:divide-gray-700">
                    @foreach ($product_infos as $product_info)
                        <li class="flex justify-between py-2">
                            <span
                                class="text-gray-500 dark:text-gray-300">{{ $product_info->category_feature->name ?? '-' }}</span>
                            <span
                                class="text-gray-800 dark:text-gray-200 font-DanaMedium">{{ $product_info->name ?? '-' }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>

            <a href="#" class="flex items-center text-blue-400 gap-x-1">
                مشاهده بیشتر
                <svg class="size-4">
                    <use href="#chevron-left" />
                </svg>
            </a>
        </div>

        @livewire('frontend.comments',['product_id'=>$this->product->id])
        
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