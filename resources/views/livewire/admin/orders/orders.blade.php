{{-- show orders --}}
<div class="grid grid-cols-1 gap-6 p-3 ">
    @include('admin.layouts.loading')
    <div class="panel">
        <div class="flex items-center justify-between mb-5">
            <div class="grid grid-cols-1 gap-5 md:grid-cols-3">
                <h5 class="text-lg font-semibold dark:text-white-light">لیست محصولات</h5>
                {{-- search box --}}
                <div class="sm:ltr:mr-auto sm:rtl:ml-auto" x-data="{ search: false }" @click.outside="search = false">
                    <form wire:submit.prevent="search"
                        class="absolute inset-x-0 z-10 hidden mx-4 -translate-y-1/2 top-1/2 sm:relative sm:top-0 sm:mx-0 sm:block sm:translate-y-0"
                        :class="{ '!block': search }" @submit.prevent="search = false">
                        <div class="relative">
                            <input type="text" wire:model="searchedData"
                                class="bg-gray-100 peer form-input placeholder:tracking-widest ltr:pl-9 ltr:pr-9 rtl:pr-9 rtl:pl-9 sm:bg-transparent ltr:sm:pr-4 rtl:sm:pl-4"
                                placeholder="جستجو" />
                            <button type="submit"
                                class="absolute inset-0 appearance-none h-9 w-9 peer-focus:text-primary ltr:right-auto rtl:left-auto">
                                <svg class="mx-auto" width="16" height="16" viewBox="0 0 24 24" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor"
                                        stroke-width="1.5" opacity="0.5" />
                                    <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                        stroke-linecap="round" />
                                </svg>
                            </button>
                        </div>
                    </form>
                    <button type="button"
                        class="p-2 rounded-full search_btn bg-white-light/40 hover:bg-white-light/90 dark:bg-dark/40 dark:hover:bg-dark/60 sm:hidden"
                        @click="search = ! search">
                        <svg class="mx-auto h-4.5 w-4.5 dark:text-[#d0d2d6]" width="20" height="20"
                            viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="11.5" cy="11.5" r="9.5" stroke="currentColor" stroke-width="1.5"
                                opacity="0.5" />
                            <path d="M18.5 18.5L22 22" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" />
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @if ($orders->isEmpty())
            <hr class="mb-4">
            <div class="text-center text-gray-500 ">موردی یافت نشد</div>
        @else
            <div class="mb-5">
                <div class="mt-3 table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>نام کاربر</th>
                                <th>آدرس</th>
                                <th>کد سفارش</th>
                                <th>کد تراکنش</th>
                                <th>نوع ارسال</th>
                                <th>مبلغ کل</th>
                                <th>جزئیات سفارش</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($orders as $index => $order)
                                <tr>
                                    <td>{{ $orders->firstItem() + $index }}</td>
                                    <td>{{ $order->user->name }}</td>
                                    <td>{{ $order->user->address->address }}</td>
                                    <td>{{ $order->order_code }}</td>
                                    <td>{{ $order->transaction_id }}</td>
                                    <td>{{ $order->send_type }}</td>
                                    <td>{{ number_format($order->total_cost) }} تومان</td>
                                    <td>
                                        <a href="{{ route('admin.order.details',$order->id) }}" class="rounded-full btn btn-outline-primary btn-sm ">جزئیات سفارش</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- pagination --}}
                    <div class="panel">
                        <div class="flex flex-col justify-center w-full">
                            {{ $orders->links('admin.layouts.admin_pagination') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>

