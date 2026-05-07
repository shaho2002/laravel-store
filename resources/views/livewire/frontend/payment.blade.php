 <main class="container h-screen lg:h-auto">
        <!-- Breadcrumb -->
        <nav class="flex mt-8" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-2 rtl:space-x-reverse">
                <li class="inline-flex items-center">
                    <a href="index.html"
                        class="inline-flex items-center text-sm text-gray-700 gap-x-1 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white">
                        <svg class="w-4 h-4 mb-0.5">
                            <use href="#home" />
                        </svg>
                        صفحه اصلی
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <a href="#"
                            class="text-sm text-gray-700 ms-1 hover:text-blue-600 md:ms-2 dark:text-gray-400 dark:hover:text-white">سبد
                            خرید</a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <svg class="w-3 h-3 mx-1 text-gray-400 rtl:rotate-180" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 9 4-4-4-4" />
                        </svg>
                        <span class="text-sm text-gray-500 ms-1 md:ms-2 dark:text-gray-400">پرداخت موفق</span>
                    </div>
                </li>
            </ol>
        </nav>
        @if($this->Status === 'OK')
            <!-- successful payment -->
            <section class="flex items-center justify-center w-full mt-10">
                <div class="relative flex flex-col items-center justify-between px-4 pt-12 pb-4 text-gray-700 bg-white shadow w-96 dark:bg-gray-800 rounded-xl gap-y-4 dark:text-gray-200">
                    <span class="absolute -top-7">
                        <svg class="text-green-500 w-14 h-14">
                            <use href="#check-circle" />
                        </svg>
                    </span>
                    <h2 class="text-xl text-green-500 font-DanaMedium">پرداخت شما موفقیت آمیز بود.</h2>
                    <span >جزئیات تراکنش :</span>
                    <span class="w-full border-b-2 border-gray-200 dark:border-gray-600"></span>
                    <ul class="flex flex-col w-full gap-y-5 child:flex child:items-center child:justify-between">
                        <li>
                            <span class="">گیرنده:</span>
                            <span class="text-gray-400 "> {{ $this->order->user_name }}</span>
                        </li>
                        <li>
                            <span class="">تاریخ تراکنش :</span>
                            <span class="text-gray-400 ">{{ Hekmatinasser\Verta\Verta::instance($this->order->created_at)->formatJalaliDate() }}</span>
                        </li>
                        <li>
                            <span class="">شماره پیگیری :</span>
                            <span class="text-gray-400 ">{{ $this->order->order_code }}</span>
                        </li>
                        <li>
                            <span class="">وضعیت :</span>
                            <span class="text-green-500 ">پرداخت موفق</span>
                        </li>
                    </ul>
                    <div class="flex items-center justify-center w-full mt-4 gap-x-2">
                        <a href="{{ route('mainPage') }}" class="flex items-center justify-center w-1/3 py-2 transition-all bg-blue-500 rounded-lg text-gray-50 hover:bg-blue-600">
                            صفحه اصلی
                        </a>
                        <a href="{{ route('user.profile') }}" class="flex items-center justify-center w-1/3 py-2 text-gray-600 transition-all bg-gray-200 rounded-lg hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-100">
                            وضعیت سفارش
                        </a>
                        
                    </div>
                </div>
            </section>

        @else
            <!-- failed payment -->
            <section class="flex items-center justify-center w-full mt-10">
                <div class="relative flex flex-col items-center justify-between px-4 pt-12 pb-4 text-gray-700 bg-white shadow w-96 dark:bg-gray-800 rounded-xl gap-y-4 dark:text-gray-200">
                    <span class="absolute -top-7">
                        <svg class="text-green-500 w-14 h-14">
                            <use href="#check-circle" />
                        </svg>
                    </span>
                    <h2 class="text-xl text-red-500 font-DanaMedium">پرداخت موفقیت آمیز نبود.</h2>
                    <span >جزئیات تراکنش :</span>
                    <span class="w-full border-b-2 border-gray-200 dark:border-gray-600"></span>
                    <ul class="flex flex-col w-full gap-y-5 child:flex child:items-center child:justify-between">
                        <li>
                            <span class="">تاریخ تراکنش :</span>
                            <span class="text-gray-400 ">{{ Hekmatinasser\Verta\Verta::instance($this->order->created_at)->formatJalaliDate() }}</span>
                        </li>
                        <li>
                            <span class="">شماره پیگیری :</span>
                            <span class="text-gray-400 ">{{ $this->order->order_code }}</span>
                        </li>
                        <li>
                            <span class="">وضعیت :</span>
                            <span class="text-red-500 ">پرداخت ناموفق</span>
                        </li>
                    </ul>
                    <div class="flex items-center justify-center w-full mt-4 gap-x-2">
                        <a href="{{ route('mainPage') }}" class="flex items-center justify-center w-1/3 py-2 transition-all bg-blue-500 rounded-lg text-gray-50 hover:bg-blue-600">
                            صفحه اصلی
                        </a>
                        <a href="{{ route('user.profile') }}" class="flex items-center justify-center w-1/3 py-2 text-gray-600 transition-all bg-gray-200 rounded-lg hover:bg-gray-400 dark:bg-gray-700 dark:text-gray-100">
                            وضعیت سفارش
                        </a>
                        
                    </div>
                </div>
            </section>

        @endif
        
    </main>