<header class="header">
    <!-- Desktop -->
    <div class="container flex-col hidden mt-5 gap-y-6 lg:flex">
        <!-- TOPBAR -->
        <div class="flex-between">
            <!-- Search Box -->
            <div class="relative z-20">
                <!-- INPUT -->
                <div
                    class="flex p-1 transition-all rounded-full cursor-pointer search-btn-open gap-x-2 app-border bg-gray-50 dark:bg-gray-700 ring-blue-400 w-84">
                    <svg class="size-6 p-1.5 flex-center text-gray-100 bg-blue-600 rounded-full w-9 h-9">
                        <use href="#search" />
                    </svg>
                    <input placeholder="جستجو در کارین..." type="text">
                </div>
                <!-- Search Modal -->
                <div class="space-y-4 search-modal">
                    <!-- Result -->
                    <div>
                        <span class="flex items-center text-sm text-gray-600 gap-x-1 dark:text-gray-200">
                            <p>نتیجه جستجو : <span class="text-blue-400 font-DanaMedium">iphone</span></p>
                        </span>
                        <ul
                            class="flex flex-col pt-4 text-gray-500 dark:text-gray-300 gap-y-4 child:flex-between child:cursor-pointer">
                            <li>
                                <a href="#" class="flex items-center gap-x-2">
                                    <svg class="size-5">
                                        <use href="#search" />
                                    </svg>
                                    آیفون 14
                                </a>
                                <svg class="size-4">
                                    <use href="#arrow-up-right" />
                                </svg>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-x-2">
                                    <svg class="size-5">
                                        <use href="#search" />
                                    </svg>
                                    قاب آیفون
                                </a>
                                <svg class="size-4">
                                    <use href="#arrow-up-right" />
                                </svg>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-x-2">
                                    <svg class="size-5">
                                        <use href="#search" />
                                    </svg>
                                    کاور ایفون 16
                                </a>
                                <svg class="size-4">
                                    <use href="#arrow-up-right" />
                                </svg>
                            </li>
                        </ul>
                    </div>
                    <!-- Trend -->
                    <div class="pt-4">
                        <span class="flex items-center text-sm text-gray-500 gap-x-1 dark:text-gray-200">
                            <svg class="size-4">
                                <use href="#fire" />
                            </svg>
                            <p>جستجو های پرطرفدار :</p>
                        </span>
                        <ul class="w-full flex items-center gap-1.5 mt-3 child:search-modal-list-item">
                            <li>
                                <a href="#">#آیفون</a>
                            </li>
                            <li>
                                <a href="#">#لپ تاپ</a>
                            </li>
                            <li>
                                <a href="#">#هدفون</a>
                            </li>
                            <li>
                                <a href="#">#هلدر</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- Logo -->
            <a href="index.html" class="flex flex-col ml-20 text-center">
                <span class="flex items-center text-4xl font-MorabbaMedium">
                    <span class="text-blue-500">کارین</span> شاپ
                </span>
                <p class="text-gray-400 font-DanaMedium"> خرید موبایل و لپ‌تاپ</p>
            </a>
            <!--  Action -->
            <div class="flex items-center gap-x-3">
                <!-- LOGIN -->
                <button class="hidden px-4 py-2 rounded-full flex-center app-border app-hover">
                    <a href="#" class="flex items-center gap-x-2">
                        <p>ورود | ثبت‌نام</p>
                        <svg class="size-5">
                            <use href="#arrow-left-end" />
                        </svg>
                    </a>
                </button>
                <!-- Account Btn -->
                <button class="relative px-4 py-2 delay-75 rounded-full group flex-center app-border app-hover">
                    @auth
                        <a href="{{ route('user.profile') }}" class="flex items-center gap-x-1">
                            <svg class="size-5">
                                <use href="#user" />
                            </svg>
                            {{ auth()->user()->name }}
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center gap-x-1">
                            <svg class="size-5">
                                <use href="#user" />
                            </svg>
                            ورود به حساب
                        </a>
                    @endauth
                    @auth
                        <div
                            class="absolute dark:border-none border border-gray-100 w-52 p-2 bg-white text-gray-900 dark:text-gray-100 flex flex-col gap-y-3 opacity-0 invisible group-hover:opacity-100 group-hover:visible group-hover:top-12 transition-all delay-100 dark:bg-gray-700 top-20 rounded-lg text-base shadow child:transition-all duration-300 child:py-1.5 child:px-2 z-30 child:rounded-lg child:w-full">
                            <a href="{{ route('orders') }}"
                                class="flex items-center gap-x-2 hover:bg-blue-500 hover:text-gray-100">
                                <svg class="w-5 h-5">
                                    <use href="#user"></use>
                                </svg>
                                سفارشات من
                            </a>
                            <a href="{{ route('user.profile') }}"
                                class="flex items-center gap-x-2 hover:bg-blue-500 hover:text-gray-100">
                                <svg class="w-5 h-5">
                                    <use href="#envelope"></use>
                                </svg>
                                لیست پیام ها
                            </a>
                            <a href="{{ route('user.profile') }}"
                                class="flex items-center gap-x-2 hover:bg-blue-500 hover:text-gray-100">
                                <svg class="w-5 h-5">
                                    <use href="#cog"></use>
                                </svg>
                                اطلاعات کاربری
                            </a>
                            @if (auth()->user()->hasRole('مدیرکل'))
                                <a href="{{ route('home') }}"
                                    class="flex items-center gap-x-2 hover:bg-blue-500 hover:text-gray-100">
                                    <svg class="w-5 h-5">
                                        <use href="#start"></use>
                                    </svg>
                                    ورود به عنوان ادمین
                                </a>
                            @endif

                            <a href="{{ route('logout') }}"
                                class="flex items-center gap-x-2 hover:bg-red-500 dark:hover:bg-red-500 hover:text-gray-100">
                                <svg class="w-5 h-5">
                                    <use href="#arrow-left-end"></use>
                                </svg>
                                خروج از حساب
                            </a>
                        </div>
                    @endauth

                </button>
                <!-- Toggle theme -->
                <button class="p-2 rounded-full toggle-theme flex-center app-border app-hover">
                    <svg class="inline-block dark:hidden size-6">
                        <use href="#moon" />
                    </svg>
                    <svg class="hidden dark:inline size-6">
                        <use href="#sun" />
                    </svg>
                </button>
                <!-- Shoping cart -->
                <button class="relative p-2 text-gray-100 bg-blue-600 rounded-full flex-center open-cart">
                    <svg class="size-6">
                        <use href="#shopping-bag" />
                    </svg>
                    @auth
                        <span class="absolute flex w-4 h-4 -top-1 -right-1">
                            <span
                                class="absolute inline-flex w-full h-full bg-red-600 rounded-full opacity-75 animate-ping"></span>
                            <span
                                class="relative inline-flex w-4 h-4 pt-1 text-xs text-white bg-red-500 rounded-full flex-center">
                                @if ($this->count > 9)
                                    9+
                                @else
                                    {{ $this->count }}
                                @endif
                            </span>
                        </span>
                    @endauth
                </button>
                <!-- Cart -->
                <div class="cart ">
                    <!-- HEADER -->
                    <div
                        class="flex items-center justify-between pb-2 text-gray-800 border-b-2 border-gray-200 dark:border-gray-600 dark:text-gray-300">
                        <h2 class="text-lg font-DanaMedium">سبد خرید <span class="text-sm text-gray-400 font-Dana">
                                ({{ $this->count }}
                                مورد)</span></h2>
                        <svg class="size-5 cursor-pointer close-cart mb-.5">
                            <use href="#x-mark" />
                        </svg>
                    </div>
                    <!-- MAIN -->
                    <div class="flex flex-col my-4 divide-y-2 divide-gray-200 dark:divide-gray-600">
                        <!-- CART ITEM -->
                        @auth

                            @foreach ($this->carts as $cart)
                                <div class="grid w-full grid-cols-12 py-4 cursor-pointer gap-x-2">
                                    <!-- img -->
                                    <div class="w-24 h-20 col-span-4">
                                        <img src="{{ asset('images/products/' . $cart->product->image) }}"
                                            class="rounded-lg" alt="{{ $cart->product->name }}">
                                    </div>
                                    <!-- detail -->
                                    <div class="flex flex-col justify-between col-span-8">
                                        <h2 class="font-DanaMedium line-clamp-2">
                                            {{ $cart->product->name }}
                                        </h2>
                                        <div class="flex items-center justify-between mt-2 gap-x-2">
                                            <dive
                                                class="flex items-center justify-between w-20 px-2 py-1 border border-gray-200 rounded-lg gap-x-1 dark:border-white/20">

                                                <input type="number" name="customInput" id="customInput" min="0"
                                                    max="20" value="{{ $cart->count }}"
                                                    class="w-4 mr-2 text-sm custom-input" disabled>
                                                عدد
                                            </dive>
                                            <p class="text-lg text-blue-500 dark:text-blue-400 font-DanaMedium">
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

                                                <span class="text-sm font-Dana">تومان</span>
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        @endauth

                    </div>
                    <!-- FOOTER -->
                    @auth
                        @if ($this->carts->count() > 0)
                            <div
                                class="w-[90%] fixed bottom-2 flex items-center justify-between border-t-2 border-gray-200 dark:border-gray-600 pt-4">
                                <div>
                                    <p class="text-sm text-gray-500 dark:text-gray-300">مبلغ قابل پرداخت :</p>
                                    <p class="text-lg text-blue-500 dark:text-blue-400 font-DanaDemiBold">
                                        {{ number_format($this->costWithDiscount) }}
                                        <span class="text-sm font-Dana">تومان</span>
                                    </p>
                                </div>
                                <a href="{{ route('cart') }}"
                                    class="px-4 py-2 text-gray-200 transition-all bg-blue-600 rounded-lg flex-center hover:bg-blue-700">
                                    ثبت سفارش
                                </a>
                            </div>
                        @else
                            <p
                                class="flex items-center justify-center w-full py-12 mt-3 text-sm text-gray-500 sm:text-base">
                                هنوز کالایی به سبد خرید اضافه نکردید
                            </p>
                        @endif
                    @else
                        <a href="{{ route('login') }}"
                            class="px-4 py-2 text-gray-200 transition-all bg-blue-600 rounded-lg flex-center hover:bg-blue-700">
                            ابتدا وارد شوید
                        </a>
                    @endauth

                </div>
            </div>
        </div>
        <!-- NAVBAR -->
        <div class="relative h-16 px-10 text-gray-200 bg-gray-900 rounded-full flex-between dark:bg-gray-800">
            <!-- MENU -->
            <ul class="flex items-center gap-x-8">
                <li class="menu-item">
                    <a href="{{ route('mainPage') }}" class="menu-item_link">
                        صفحه اصلی
                    </a>
                </li>
                <!-- MENU ITEM --- Mega Menu -->
                <li class="menu-item megamenu-link">
                    <a href="" class="flex items-center justify-center menu-item_link gap-x-1">
                        دسته بندی ها
                        <svg class="size-4">
                            <use href="#chevron" />
                        </svg>
                    </a>
                    <div class="megamenu">
                        <!-- RIGHT MENU -->
                        <ul class="megamenu_category">
                            @foreach ($this->categories as $category)
                                <li class="megamenu_category-item ">
                                    <use href="#tv"></use>
                                    <a href="{{ route('shop') }}">{{ $category->name }}</a>
                                </li>
                            @endforeach
                        </ul>

                        <div class="megamenu_left">
                            <a href="shop.html" class="text-blue-400 flex items-center gap-x-0.5 text-sm mb-4">
                                مشاهده همه
                                <svg class="rotate-90 size-4">
                                    <use href="#chevron" />
                                </svg>
                            </a>
                            @foreach ($this->categories as $category)
                                <ul class="megamenu_left-item ">
                                    <div class="megamenu_left-menu">
                                        <h2 class="megamenu_left-title">زیردسته‌ها</h2>

                                        @foreach ($category->childCategory as $childCategory)
                                            <li><button
                                                    wire:click="set_category_id( {{ $childCategory->id }})">{{ $childCategory->name }}</button>
                                            </li>
                                        @endforeach

                                    </div>

                                    <div class="megamenu_left-menu">
                                        <h2 class="megamenu_left-title">لپ‌تاپ بر اساس قیمت</h2>
                                        <li><a href="shop.html">لپ‌تاپ اقتصادی</a></li>
                                        <li><a href="shop.html">لپ‌تاپ تا ۱۰ میلیون تومان</a></li>
                                        <li><a href="shop.html">لپ‌تاپ تا ۲۰ میلیون تومان</a></li>
                                        <li><a href="shop.html">لپ‌تاپ تا ۳۰ میلیون تومان</a></li>
                                        <li><a href="shop.html">لپ‌تاپ تا ۵۰ میلیون تومان</a></li>
                                        <li><a href="shop.html">لپ‌تاپ بالای ۵۰ میلیون تومان</a></li>
                                    </div>

                                    <div class="megamenu_left-menu">
                                        <h2 class="megamenu_left-title">لوازم جانبی لپ‌تاپ</h2>
                                        <li><a href="shop.html">کیف و کوله لپ‌تاپ</a></li>
                                        <li><a href="shop.html">کابل و آداپتور لپ‌تاپ</a></li>
                                        <li><a href="shop.html">استند و پایه خنک‌کننده</a></li>
                                        <li><a href="shop.html">ماوس و کیبورد</a></li>
                                        <li><a href="shop.html">هارد اکسترنال و SSD</a></li>
                                        <li><a href="shop.html">پد ماوس</a></li>
                                    </div>

                                </ul>
                            @endforeach
                        </div>
                    </div>
                </li>

                <li class="menu-item">
                    <a href="{{ route('shop') }}" class="menu-item_link">
                        فروشگاه
                    </a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('articles.list') }}" class="menu-item_link">
                        وبلاگ
                    </a>
                </li>
            </ul>
        </div>
    </div>
    </div>
    <!-- Mobile -->
    <div class="flex justify-center lg:hidden">
        <!-- Top Navbar -->
        <nav
            class="absolute inset-x-0 top-0 flex items-center justify-between w-full h-16 px-4 shadow-sm dark:bg-gray-800">
            <!-- Menu -->
            <button class="p-2 rounded-full open-menu-mobile flex-center app-border">
                <svg class=" size-6">
                    <use href="#bars" />
                </svg>
            </button>
            <div class="z-50 flex flex-col mobile-menu">
                <!--  MENU MOBILE header -->
                <div class="flex items-center justify-between w-full pb-4 border-b-normal">
                    <a href="index.html" class="text-xl font-MorabbaMedium">
                        <span class="text-blue-500">کارین</span> شاپ
                    </a>
                    <button class="close-menu-mobile">
                        <svg class="text-gray-500 size-5 dark:text-gray-200">
                            <use href="#x-mark" />
                        </svg>
                    </button>
                </div>
                <!-- MENU MOBILE CATEGORY & ACTION  -->
                <ul class="flex flex-col mt-4 text-gray-800 gap-y-2 dark:text-gray-100">
                    <li>
                        <span class="open-category mobile-menu-item">
                            <svg class="size-5">
                                <use href="#squares" />
                            </svg>
                            <a href="#">دسته بندی</a>
                        </span>
                        <!-- MENU CATEGORY SLIDE -->
                        <div class="category-slide">
                            <div class="w-full pb-4 border-b-normal">
                                <span class="flex items-center cursor-pointer close-category-slide gap-x-1">
                                    <svg class="size-4">
                                        <use href="#arrow" />
                                    </svg>
                                    دسته بندی
                                </span>
                            </div>
                            <ul class="pt-4 space-y-2 child:flex child:cursor-pointer">
                                @foreach ($this->categories as $category)
                                    <li>
                                        <div class="relative open-detail-category">
                                            <span class="mobile-menu-category-badge">
                                                {{ $category->name }}
                                            </span>
                                            <img src="./images/category/1.webp"
                                                class="object-cover w-full rounded h-28" alt="">
                                        </div>
                                        <!-- Mobile SLIDE -->
                                        <div class="detail-category">
                                            <span
                                                class="p-2 mx-4 bg-gray-100 rounded cursor-pointer close-detail-category flex-center gap-x-1 dark:bg-gray-900">
                                                {{ $category->name }}
                                                <svg class="size-4">
                                                    <use href="#arrow" />
                                                </svg>
                                            </span>
                                            <ul
                                                class="flex flex-col mt-5 divide-y-2 child:py-3 dark:divide-gray-700 child:px-4">

                                                @foreach ($category->childCategory as $childCategory)
                                                    <li>

                                                        <span
                                                            class="flex items-center justify-between group open-submenu">
                                                            <a href="{{ route('shop') }}">{{ $childCategory->name }}
                                                            </a>
                                                            <svg class="rotate-90 size-4">
                                                                <use href="#chevron" />
                                                            </svg>
                                                        </span>

                                                        <ul
                                                            class="menu-category-submenu child:list-disc child-hover:mr-2 child:transition-all child:duration-300">
                                                            <li href="">آیفون</li>
                                                            <li href="">سامسونگ</li>
                                                            <li href="">شیائومی</li>
                                                            <li href="" class="text-red-500">پرفروش‌ها</li>
                                                            <li href="">نوکیا</li>
                                                        </ul>
                                                    </li>
                                                @endforeach

                                            </ul>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </li>
                    <li class="mobile-menu-item">
                        <svg class="size-5">
                            <use href="#user" />
                        </svg>
                        <a href="{{ route('user.profile') }}">حساب کاربری</a>
                    </li>
                    @auth
                        @if (auth()->user()->hasRole('مدیرکل'))
                        <li class="mobile-menu-item">
                        <svg class="size-5">
                            <use href="#start" />
                        </svg>
                        <a href="{{ route('home') }}"> ورود به عنوان ادمین</a>
                    </li>
                    @endif
                    @endauth
                    <li class="mobile-menu-item">
                        <svg class="size-5">
                            <use href="#heart" />
                        </svg>
                        <a href="dashboard-favorite.html">علاقه مندی ها</a>
                    </li>
                    <li class="mobile-menu-item">
                        <svg class="size-5">
                            <use href="#shopping-cart" />
                        </svg>
                        <a href="{{ route('cart') }}">سبد خرید</a>
                    </li>
                    <li class="mobile-menu-item">
                        <svg class="size-5">
                            <use href="#check-badge" />
                        </svg>
                        <a href="#">دربـاره مـا</a>
                    </li>
                    <li class="mobile-menu-item">
                        <svg class="size-5">
                            <use href="#phone" />
                        </svg>
                        <a href="contact-us.html">تـماس بـا مـا</a>
                    </li>
                </ul>
            </div>
            <!-- Logo -->
            <a href="index.html" class="flex flex-col text-center">
                <span class="flex items-center text-3xl font-MorabbaMedium">
                    <span class="text-blue-500">کارین</span> شاپ
                </span>
            </a>
            <!-- Toggle theme -->
            <button class="p-2 rounded-full toggle-theme flex-center app-border ">
                <svg class="inline-block dark:hidden size-6">
                    <use href="#moon" />
                </svg>
                <svg class="hidden dark:inline size-6">
                    <use href="#sun" />
                </svg>
            </button>
        </nav>
        <!-- Search baer -->
        <button class="open-mobile_search-modal">
            <svg class=" size-6">
                <use href="#search" />
            </svg>
            <p>جستجو در <span class="font-MorabbaMedium">کارین شاپ</span></p>
        </button>
        <!-- Search Moadal -->
        <div class="mobile_search-modal">
            <!-- TOP -->
            <div class="flex items-center w-full gap-x-2">
                <button
                    class="flex items-center w-full px-4 py-2 text-gray-500 bg-gray-200 gap-x-1 dark:bg-gray-800 rounded-3xl">
                    <svg class="size-6">
                        <use href="#search" />
                    </svg>
                    <input type="text" placeholder="جستجو در همه کالاها">
                </button>
                <svg class="size-6 close-mobile_search-modal">
                    <use href="#x-mark" />
                </svg>
            </div>
            <div class="w-full space-y-4">
                <!-- Result -->
                <div ">
                        <span class="flex items-center text-sm text-gray-600 gap-x-1 dark:text-gray-200">
                        <p>نتیجه جستجو : <span class="text-blue-400 font-DanaMedium">iphone</span></p>
                        </span>
                        <ul
                            class="flex flex-col pt-4 text-gray-500 dark:text-gray-300 gap-y-4 child:flex-between child:cursor-pointer">
                            <li>
                                <a href="#" class="flex items-center gap-x-2">
                                    <svg class="size-5">
                                        <use href="#search" />
                                    </svg>
                                    آیفون 14
                                </a>
                                <svg class="size-4">
                                    <use href="#arrow-up-right" />
                                </svg>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-x-2">
                                    <svg class="size-5">
                                        <use href="#search" />
                                    </svg>
                                    قاب آیفون
                                </a>
                                <svg class="size-4">
                                    <use href="#arrow-up-right" />
                                </svg>
                            </li>
                            <li>
                                <a href="#" class="flex items-center gap-x-2">
                                    <svg class="size-5">
                                        <use href="#search" />
                                    </svg>
                                    کاور ایفون 16
                                </a>
                                <svg class="size-4">
                                    <use href="#arrow-up-right" />
                                </svg>
                            </li>
                        </ul>
                    </div>
                    <!-- Trend -->
                    <div class="pt-4">
                        <span class="flex items-center text-sm text-gray-500 gap-x-1 dark:text-gray-200">
                            <svg class="size-4">
                                <use href="#fire" />
                            </svg>
                            <p>جستجو های پرطرفدار :</p>
                        </span>
                        <ul class="w-full flex items-center gap-1.5 mt-3 child:search-modal-list-item">
                            <li>
                                <a href="#">#آیفون</a>
                            </li>
                            <li>
                                <a href="#">#لپ تاپ</a>
                            </li>
                            <li>
                                <a href="#">#هدفون</a>
                            </li>
                            <li>
                                <a href="#">#هلدر</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- bottom Navbar-->
            <ul class="bottom-navbar">
                <li class="text-blue-500 dark:text-sky-400 font-DanaMedium">
                    <svg class="size-5">
                        <use href="#home" />
                    </svg>
                    <a href="{{ route('mainPage') }}">خانه</a>
                </li>
                <li>
                    <svg class="size-5">
                        <use href="#squares" />
                    </svg>
                    <a href="{{ route('shop') }}">فروشگاه</a>
                </li>
                <li>
                    <svg class="size-5">
                        <use href="#shopping-bag" />
                    </svg>
                    <a href="{{ route('cart') }}">سبد خرید</a>
                </li>
                <li>
                    <svg class="size-5">
                        <use href="#user" />
                    </svg>
                    <a href="{{ route('user.profile') }}">حساب من</a>
                </li>
            </ul>
        </div>

    </header>
