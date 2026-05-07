<main class="container relative">
    <div class="flex flex-col mt-10 lg:flex-row gap-x-8">
        <!-- SIDE MENU -->
        <div
            class="flex-col items-center hidden p-4 mb-8 bg-white rounded-lg shadow lg:sticky top-1 h-fit lg:w-1/4 lg:flex gap-y-4 dark:bg-gray-800">
            <!-- NAME AND AVATAR  -->
            <div class="flex items-center justify-between w-full py-3 border-b border-gray-200 dark:border-white/20">
                <div class="flex items-center gap-x-3">
                    <img src="{{ url('frontend/images/svg/user.png') }}"
                        class="rounded-full size-10 ring-2 ring-gray-400/20" alt="AVATAR">
                    <span class="flex-col felx gap-y-2">
                        <p class="text-lg font-DanaMedium">{{ auth()->user()->name }}</p>
                        <p class="text-gray-400">{{ auth()->user()?->mobile }}</p>
                        <p class="text-gray-400">{{ auth()->user()?->email }}</p>
                    </span>
                </div>
                <span>
                    <svg class="w-6 h-6 text-blue-500 cursor-pointer">
                        <use href="#edit"></use>
                    </svg>
                </span>
            </div>
            <ul
                class="relative w-full space-y-2 text-lg child:duration-300 child:transition-all child:py-3 child:px-2 child:flex child:gap-x-2 child:cursor-pointer child:rounded-lg">
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#squares"></use>
                    </svg>
                    <a href="{{ route('user.profile') }}">داشبورد</a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#shopping-bag"></use>
                    </svg>
                    <a href="{{ route('orders') }}">
                        سفارش ها
                    </a>
                </li>
                <li class="text-blue-500 bg-blue-500/10">
                    <svg class="w-6 h-6 ">
                        <use href="#heart"></use>
                    </svg>
                    <a href="{{ route('favorite.list') }}">علاقه‌مندی ها</a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#map"></use>
                    </svg>
                    <a href="dashboard-address.html">آدرس ها</a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#bell"></use>
                    </svg>
                    <a href="dashboard-messages.html">پیام ها</a>
                </li>
                <li class="hover:text-blue-500">
                    <svg class="w-6 h-6 ">
                        <use href="#cog"></use>
                    </svg>
                    <a href="dashboard-account.html">اطلاعات حساب </a>
                </li>
                <li class="text-red-400">
                    <svg class="w-6 h-6 ">
                        <use href="#arrow-left-end"></use>
                    </svg>
                    <a href="index.html">خروج</a>
                </li>
            </ul>
        </div>
        <!-- TOP FILTER BOX & PRODUCT & PAGINATION -->
        <div class="lg:w-3/4">
            <div class="flex lg:hidden">
                <button
                    class="flex items-center p-2 mr-2 text-sm text-white bg-blue-500 rounded-lg open-user-menu gap-x-1 font-DanaMedium">
                    <svg class="size-5">
                        <use href="#bars-3" />
                    </svg>
                    منوی کاربری
                </button>
                <div class="user-menu">
                    <button class="close-user-menu">
                        <svg class="size-6">
                            <use href="#x-mark" />
                        </svg>
                    </button>
                    <!-- NAME AND AVATAR  -->
                    <div
                        class="flex items-center justify-between w-full py-3 border-b border-gray-200 dark:border-white/20">
                        <div class="flex items-center gap-x-3">
                            <img src="{{ url('frontend/images/svg/user.png') }}" class="rounded-full size-10 ring-2 ring-gray-400/20"
                                alt="AVATAR">
                            <span class="flex-col felx gap-y-2">
                                <p class="text-lg font-DanaMedium">{{ auth()->user()->name }}</p>
                                <p class="text-gray-400">{{ auth()->user()?->mobile }}</p>
                                <p class="text-gray-400">{{ auth()->user()?->email }}</p>
                            </span>
                        </div>
                        <span>
                            <svg class="w-6 h-6 text-blue-500 cursor-pointer">
                                <use href="#edit"></use>
                            </svg>
                        </span>
                    </div>
                    <ul
                        class="relative w-full space-y-2 text-lg child:duration-300 child:transition-all child:py-3 child:px-2 child:flex child:gap-x-2 child:cursor-pointer child:rounded-lg">
                        <li class="hover:text-blue-500">
                            <svg class="w-6 h-6 ">
                                <use href="#squares"></use>
                            </svg>
                            <a href="{{ route('user.profile') }}">داشبورد</a>
                        </li>
                        <li class="hover:text-blue-500">
                            <svg class="w-6 h-6 ">
                                <use href="#shopping-bag"></use>
                            </svg>
                            <a href="{{ route('orders') }}">
                                سفارش ها
                            </a>
                        </li>
                        <li class="text-blue-500 bg-blue-500/10">
                            <svg class="w-6 h-6 ">
                                <use href="#heart"></use>
                            </svg>
                            <a href="{{ route('favorite.list') }}">علاقه‌مندی ها</a>
                        </li>
                        <li class="hover:text-blue-500">
                            <svg class="w-6 h-6 ">
                                <use href="#map"></use>
                            </svg>
                            <a href="dashboard-address.html">آدرس ها</a>
                        </li>
                        <li class="hover:text-blue-500">
                            <svg class="w-6 h-6 ">
                                <use href="#bell"></use>
                            </svg>
                            <a href="dashboard-messages.html">پیام ها</a>
                        </li>
                        <li class="hover:text-blue-500">
                            <svg class="w-6 h-6 ">
                                <use href="#cog"></use>
                            </svg>
                            <a href="dashboard-account.html">اطلاعات حساب </a>
                        </li>
                        <li class="text-red-400">
                            <svg class="w-6 h-6 ">
                                <use href="#arrow-left-end"></use>
                            </svg>
                            <a href="index.html">خروج</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="flex flex-col p-4 mt-5 rounded-lg lg:mt-0">
                <span class="flex items-center justify-between">
                    <span class="flex items-center gap-x-2">
                        <svg class="size-7">
                            <use href="#heart"></use>
                        </svg>
                        <h2 class="text-lg font-DanaMedium">محصولات مورد علاقه من:</h2>
                    </span>
                </span>
                <!-- PRODUCTS -->
                @if ($user->favorite_products->count() > 0)
                    <div
                        class="grid grid-cols-1 gap-3 mt-5 xxs:grid-cols-2 xs:grid-cols-2 sm:grid-cols-2 xl:grid-cols-3 xs:gap-2 sm:gap-4 ">
                    
                    @foreach ($user->favorite_products as $favorite_product)
                        @if (
                            $favorite_product->count > 0 &&
                                $favorite_product->count >= $favorite_product->max_sell &&
                                $favorite_product->max_sell > 0)
                            <div class="swiper-slide product-card group">
                                <!-- product header -->
                                <div class="product-card_header">
                                    <div class="flex items-center gap-x-2">
                                        <div class="tooltip" wire:click="addToCart({{ $favorite_product->id }})">
                                            <button class="rounded-full p-1.5 app-border app-hover">
                                                <svg class="size-4">
                                                    <use href="#shopping-cart"></use>
                                                </svg>
                                            </button>
                                            <div class="tooltiptext">
                                                سبد خرید
                                            </div>
                                        </div>
                                        <div class="tooltip"
                                            wire:click="deleteFromFavorite({{ $favorite_product->id }})">
                                            <button class="rounded-full p-1.5 app-border app-hover">
                                                <svg class="size-4">
                                                    <use href="#x-mark"></use>
                                                </svg>
                                            </button>
                                            <div class="tooltiptext">
                                                حذف علاقه مندی
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
                                    @if ($favorite_product->discount)
                                        <span class="product-card_badge">{{ $favorite_product->discount }}%
                                            تخفیف‌</span>
                                    @endif
                                </div>
                                <!-- product img -->
                                <a href="{{ route('product.details', $favorite_product->slug) }}">
                                    <img class="absolute product-card_img group-hover:opacity-0"
                                        src="{{ asset('images/products/' . $favorite_product->image) }}"
                                        alt="{{ $favorite_product->name }}">
                                    <img class="opacity-0 product-card_img group-hover:opacity-100"
                                        src="{{ asset('images/products/' . $favorite_product->image) }}"
                                        alt="{{ $favorite_product->name }}">
                                </a>
                                <!--  product footer -->
                                <div class="space-y-2">
                                    <a href="{{ route('product.details', $favorite_product->slug) }}"
                                        class="product-card_link">
                                        {{ $favorite_product->name }}
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
                                            @if ($favorite_product->discount)
                                                <del>{{ number_format($favorite_product->price) }}<h6>تومان</h6>
                                                </del>
                                                <p>{{ number_format($favorite_product->price - ($favorite_product->price * $favorite_product->discount) / 100) }}
                                                </p>
                                                <span>تومان</span>
                                            @else
                                                <p>{{ number_format($favorite_product->price) }}
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
                                        <div class="tooltip"
                                            wire:click="deleteFromFavorite({{ $favorite_product->id }})">
                                            <button class="rounded-full p-1.5 app-border app-hover">
                                                <svg class="size-4">
                                                    <use href="#x-mark"></use>
                                                </svg>
                                            </button>
                                            <div class="tooltiptext">
                                                حذف علاقه مندی
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
                                <a href="{{ route('product.details', $favorite_product->slug) }}">
                                    <img class="absolute product-card_img group-hover:opacity-0"
                                        src="{{ asset('images/products/' . $favorite_product->image) }}"
                                        alt="{{ $favorite_product->name }}">
                                    <img class="opacity-0 product-card_img group-hover:opacity-100"
                                        src="{{ asset('images/products/' . $favorite_product->image) }}"
                                        alt="{{ $favorite_product->name }}">
                                </a>
                                <!--  product footer -->
                                <div class="space-y-2">
                                    <a href="{{ route('product.details', $favorite_product->slug) }}"
                                        class="product-card_link">
                                        {{ $favorite_product->name }}
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
                @else
                    <div class="flex items-center justify-center w-full h-full py-12">
                        <div
                            class="w-full max-w-md px-5 py-8 text-center bg-white border border-gray-200 shadow-md dark:bg-gray-800 rounded-xl dark:border-gray-700">
                            <h2 class="text-lg text-gray-700 sm:text-xl font-DanaMedium dark:text-gray-200">
                                علاقه‌مندی شما خالی است ❤️
                            </h2>
                            <p class="mt-3 text-sm text-gray-500 sm:text-base">
                                هنوز کالایی به لیست‌ علاقه‌مندی اضافه نکردید
                            </p>
                        </div>
                    </div>
                @endif



            </div>
        </div>
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
