<div class="pt-5">
            <div class="grid grid-cols-1 gap-6 mb-6 text-white sm:grid-cols-2 xl:grid-cols-4">
                <!-- Users -->
                <div class="panel bg-gradient-to-r from-cyan-500 to-cyan-400">
                    <div class="flex justify-between">
                        <div class="font-semibold text-md ltr:mr-1 rtl:ml-1"> کاربران</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $this->users->count() }}</div>
                    </div>
                    <div class="flex items-center mt-5 font-semibold">
                       در این ماه {{ $this->userInMonth }} کاربر جدید
                    </div>
                </div>

                <!-- inProgressProducts -->
                <div class="panel bg-gradient-to-r from-violet-500 to-violet-400">
                    <div class="flex justify-between">
                        <div class="font-semibold text-md ltr:mr-1 rtl:ml-1">محصولات درحال بررسی</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $this->inProgressProducts }}</div>
                    </div>
                    <div class="flex items-center mt-5 font-semibold">
                        در این ماه {{ $this->inProgressProductsThisMonth }} محصول
                    </div>
                </div>

                <!-- sentProducts -->
                <div class="panel bg-gradient-to-r from-blue-500 to-blue-400">
                    <div class="flex justify-between">
                        <div class="font-semibold text-md ltr:mr-1 rtl:ml-1">مصحولات ارسال شده</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $this->sentProducts }}</div>
                    </div>
                    <div class="flex items-center mt-5 font-semibold">
                       در این ماه {{ $this->sentProductsThisMonth }} محصول
                    </div>
                </div>

                <!-- canceledProducts -->
                <div class="panel bg-gradient-to-r from-fuchsia-500 to-fuchsia-400">
                    <div class="flex justify-between">
                        <div class="font-semibold text-md ltr:mr-1 rtl:ml-1">محصولات لغو شده</div>
                        <div x-data="dropdown" @click.outside="open = false" class="dropdown">
                        </div>
                    </div>
                    <div class="flex items-center mt-5">
                        <div class="text-3xl font-bold ltr:mr-3 rtl:ml-3">{{ $this->canceledProducts }}</div>
                    </div>
                    <div class="flex items-center mt-5 font-semibold">
                        در این ماه {{ $this->canceledProductsThisMonth }} محصول
                    </div>
                </div>
            </div>


</div>
