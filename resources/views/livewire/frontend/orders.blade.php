<main class="container relative">
       
        <div class="flex flex-col mt-10 lg:flex-row gap-x-8">
            <!-- SIDE MENU -->
            <div class="flex-col items-center hidden p-4 mb-8 bg-white rounded-lg shadow lg:sticky top-1 h-fit lg:w-1/4 lg:flex gap-y-4 dark:bg-gray-800">
                 <!-- NAME AND AVATAR  -->
                 <div class="flex items-center justify-between w-full py-3 border-b border-gray-200 dark:border-white/20">
                    <div class="flex items-center gap-x-3">
                        <img src="{{ url('frontend/images/svg/user.png') }}" class="rounded-full size-10 ring-2 ring-gray-400/20" alt="AVATAR">
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
                <li class="text-blue-500 bg-blue-500/10">
                    <svg class="w-6 h-6 ">
                        <use href="#shopping-bag"></use>
                    </svg>
                    <a href="{{ route('orders') }}">
                        سفارش ها
                    </a>
                </li>
                <li class="hover:text-blue-500">
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
                    <button class="flex items-center p-2 mr-2 text-sm text-white bg-blue-500 rounded-lg open-user-menu gap-x-1 font-DanaMedium">
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
                        <li class="text-blue-500 bg-blue-500/10">
                            <svg class="w-6 h-6 ">
                                <use href="#shopping-bag"></use>
                            </svg>
                            <a href="{{ route('orders') }}">
                                سفارش ها
                            </a>
                        </li>
                        <li class="hover:text-blue-500">
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
                            <a href="{{ route('logout') }}">خروج</a>
                        </li>
                        </ul>
                    </div>
                </div>
               <div class="flex flex-col p-4 mt-5 bg-white rounded-lg shadow dark:bg-gray-800 lg:mt-0">
               <span class="flex items-center justify-between">
                 <span class="flex items-center gap-x-2">
                    <img src="frontend/images/svg/status-delivered.svg" class="w-10" alt="">
                    <h2 class="text-lg font-DanaMedium">سفارش های من :</h2>
                </span>
               </span>
                <div class="relative mt-5 overflow-x-auto border border-gray-200 rounded-lg dark:border-gray-700">
                    <table class="w-full text-sm text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 bg-gray-100 dark:bg-gray-900 dark:text-gray-200">
                            <tr>
                                <th scope="col" class="px-6 py-3.5">
                                    نام محصول
                                </th>
                                <th scope="col" class="px-6 py-3.5">
                                    تاریخ سفارش
                                </th>
                                <th scope="col" class="px-6 py-3.5">
                                    قیمت
                                </th>
                                <th scope="col" class="px-6 py-3.5">
                                    وضعیت
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($this->orders as $order)
                                @foreach ($order->order_details as $order_detail)
                                    <tr
                                        class="transition-all bg-white border-b cursor-pointer dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                                        <th scope="row"
                                            class="flex items-center px-6 py-5 font-medium text-gray-900 whitespace-nowrap dark:text-white gap-x-2">
                                            <img class="object-cover w-10"
                                                src="{{ 'images/products/' . $order_detail->product->image }}"
                                                alt="{{ $order_detail->product->name }}">
                                            {{ $order_detail->product->name }}
                                        </th>
                                        <td class="px-6 py-5">
                                            {{ Hekmatinasser\Verta\Verta::instance($order_detail->created_at)->formatJalaliDate() }}
                                        </td>
                                        <td class="px-6 py-5">
                                            {{ number_format($order_detail->final_price) . ' تومان ' }} * {{ $order_detail->count }}
                                        </td>
                                        @if ($order_detail->status === 'in_progress')
                                            <td class="px-6 py-5 text-yellow-500 font-DanaDemiBold">
                                                درحال بررسی
                                            </td>
                                        @elseif($order_detail->status === 'canceled')
                                            <td class="px-6 py-5 text-red-500 font-DanaDemiBold">
                                                لغو شده
                                            </td>
                                        @else($order_detail->status === 'sent')
                                            <td class="px-6 py-5 text-green-500 font-DanaDemiBold">
                                                ارسال شده
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
               </div>
            </div>
        </div>
    </main>